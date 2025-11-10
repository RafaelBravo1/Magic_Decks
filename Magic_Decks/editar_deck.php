<?php
$titulo="Edição de Deck";
include('includes/header.php');
// Certifique-se de que a sessão está iniciada
if (session_status() == PHP_SESSION_NONE) {
}


include('conecta.php');

// --- 1. FUNÇÕES DE SUPORTE ADAPTADAS PARA EDIÇÃO ---

/**
 * Busca detalhes da carta de forma segura usando Prepared Statements.
 */
function get_carta_details($conexao, $id_carta)
{
    $query = "SELECT tipo, cinza FROM cartas WHERE id_carta = ?";
    $stmt = mysqli_prepare($conexao, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 's', $id_carta);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if ($resultado) {
            $detalhes = mysqli_fetch_assoc($resultado);
            mysqli_stmt_close($stmt);
            return $detalhes;
        }
        mysqli_stmt_close($stmt);
    }
    return null;
}

/**
 * Calcula o total de cartas no deck em EDIÇÃO.
 */
function get_deck_total_editing()
{
    $total = 0;
    // Garante que a sessão de edição existe
    if (isset($_SESSION['EDIT_STATE']['cards'])) {
        foreach ($_SESSION['EDIT_STATE']['cards'] as $carta) {
            $total += $carta['quantidade'];
        }
    }
    // O Comandante conta como 1 carta
    return $total + (isset($_SESSION['EDIT_STATE']['commander_id']) ? 1 : 0);
}

// --- 2. VARIÁVEIS DE SESSÃO E LÓGICA DE CARREGAMENTO INICIAL ---

$user_id = $_SESSION['user_id'] ?? 1;
$redirecionar_necessario = false;
$editing_deck_id = $_SESSION['EDIT_STATE']['id'] ?? null;
$url_deck_id = $_GET['deck_id'] ?? null;

// A) LÓGICA DE CANCELAMENTO OU LIMPEZA DA SESSÃO DE EDIÇÃO
if (isset($_POST['cancel_editing']) || isset($_POST['update_success'])) {
    unset($_SESSION['EDIT_STATE']);
    // Redireciona para coleção, limpando a URL e avisos
    header("Location: colecao.php");
    exit();
}

// B) LÓGICA DE CARREGAMENTO DECK (APENAS SE UM NOVO ID VIER PELA URL)
if ($url_deck_id && $url_deck_id != $editing_deck_id) {
    // 1. Buscar dados do deck
    $query_load = "SELECT id, nome, commander_id, cartas_json FROM decks WHERE id = ? AND user_id = ?";
    $stmt_load = mysqli_prepare($conexao, $query_load);

    if ($stmt_load) {
        mysqli_stmt_bind_param($stmt_load, 'ii', $url_deck_id, $user_id);
        mysqli_stmt_execute($stmt_load);
        $resultado = mysqli_stmt_get_result($stmt_load);

        if ($deck_data = mysqli_fetch_assoc($resultado)) {
            // Sucesso no carregamento: Inicializa a sessão de edição
            $_SESSION['EDIT_STATE'] = [
                'id' => $deck_data['id'],
                'name' => $deck_data['nome'],
                'commander_id' => $deck_data['commander_id'],
                // Decodifica o JSON das cartas. Se for nulo/inválido, usa array vazio.
                'cards' => json_decode($deck_data['cartas_json'] ?? '[]', true) ?? [],
            ];

            $_SESSION['sucesso'] = "Deck '{$deck_data['nome']}' carregado para edição.";
        } else {
            $_SESSION['erro'] = "Erro: Deck não encontrado ou acesso negado.";
        }
        mysqli_stmt_close($stmt_load);
    } else {
        $_SESSION['erro'] = "Erro interno ao preparar carregamento do deck.";
    }
    // Redireciona para limpar o GET e estabilizar a sessão
    header("Location: editar_deck.php");
    exit();
}

// Verifica se estamos em um estado de edição válido após o carregamento ou ações POST
$is_editing = isset($_SESSION['EDIT_STATE']);
$commander_id = $_SESSION['EDIT_STATE']['commander_id'] ?? null;


// --- 3. LÓGICA DE MANIPULAÇÃO DO DECK (Adicionar/Remover) ---

if ($is_editing) {
    // Lógica para adicionar carta ao deck (LIDA COM QUANTIDADE MÚLTIPLA)
    if (isset($_POST['add_to_deck']) && $commander_id) {
        $carta_id = $_POST['carta_id'];
        $add_qty = (int)($_POST['add_qty'] ?? 1);

        if ($add_qty > 0) {
            $details = get_carta_details($conexao, $carta_id);
            $quantidade_atual = $_SESSION['EDIT_STATE']['cards'][$carta_id]['quantidade'] ?? 0;
            $deck_total_before = get_deck_total_editing();

            // 1. Validação de Limite Total (100 cartas)
            if (($deck_total_before - $quantidade_atual) + ($quantidade_atual + $add_qty) > 100) {
                $_SESSION['aviso'] = "Ação cancelada: Excederia o limite de 100 cartas.";
                $redirecionar_necessario = true;
            } elseif ($details) {
                $is_terreno = ($details['tipo'] == '6');

                // 2. Validação de Limite de Cópia (Não-Terreno)
                if (!$is_terreno && $quantidade_atual + $add_qty > 1) {
                    $_SESSION['aviso'] = "Cartas não-terreno só podem ter 1 cópia.";
                    $redirecionar_necessario = true;
                }
                // 3. Execução da Adição
                else {
                    // Adiciona ou atualiza no deck de edição
                    $_SESSION['EDIT_STATE']['cards'][$carta_id] = [
                        'id' => $carta_id,
                        'nome' => $_POST['carta_nome'],
                        'imagem' => $_POST['carta_imagem'],
                        'quantidade' => $quantidade_atual + $add_qty
                    ];
                    $redirecionar_necessario = true;
                }
            }
        }
    }

    // Lógica para remover carta do deck (Remove apenas 1 por clique)
    if (isset($_POST['remove_from_deck'])) {
        $carta_id = $_POST['carta_id'];
        if (isset($_SESSION['EDIT_STATE']['cards'][$carta_id])) {
            $_SESSION['EDIT_STATE']['cards'][$carta_id]['quantidade']--;

            if ($_SESSION['EDIT_STATE']['cards'][$carta_id]['quantidade'] <= 0) {
                unset($_SESSION['EDIT_STATE']['cards'][$carta_id]);
            }
            $redirecionar_necessario = true;
        }
    }

    // Lógica para ATUALIZAR O DECK no BD
    if (isset($_POST['update_deck'])) {
        $nome_deck = trim($_POST['deck_name']);
        $deck_total = get_deck_total_editing();
        $editing_id = $_SESSION['EDIT_STATE']['id'];

        // Validação básica
        if (empty($nome_deck)) {
            $_SESSION['erro'] = "O nome do deck não pode ser vazio.";
            $redirecionar_necessario = true;
        } elseif (is_null($commander_id)) {
            $_SESSION['erro'] = "Comandante não identificado na sessão de edição.";
            $redirecionar_necessario = true;
        } elseif ($deck_total != 100) {
            $_SESSION['erro'] = "O deck deve ter exatamente 100 cartas (incluindo o Comandante). Total atual: {$deck_total}.";
            $redirecionar_necessario = true;
        } else {
            // Converte o array do deck em formato JSON para salvar no banco
            $deck_json = json_encode($_SESSION['EDIT_STATE']['cards']);

            // USANDO PREPARED STATEMENT PARA ATUALIZAÇÃO
            $query_update = "UPDATE decks SET nome = ?, cartas_json = ? WHERE id = ? AND user_id = ?";
            $stmt_update = mysqli_prepare($conexao, $query_update);

            if ($stmt_update) {
                // Tipo de parâmetros: s (nome), s (json), i (id), i (user_id)
                mysqli_stmt_bind_param($stmt_update, 'ssii', $nome_deck, $deck_json, $editing_id, $user_id);

                if (mysqli_stmt_execute($stmt_update)) {

                    // Ação de Sucesso: Limpa a sessão de edição e redireciona
                    $_SESSION['sucesso'] = "Deck '{$nome_deck}' atualizado com sucesso!";

                    // Usa o cancel_editing para limpar a sessão e redirecionar para colecao.php
                    $_POST['update_success'] = true;
                    $redirecionar_necessario = true;
                } else {
                    $_SESSION['erro'] = "Erro ao salvar o deck: " . mysqli_error($conexao);
                    $redirecionar_necessario = true;
                }
                mysqli_stmt_close($stmt_update);
            } else {
                $_SESSION['erro'] = "Erro interno na preparação da query de atualização.";
                $redirecionar_necessario = true;
            }
        }
    }
}

// 4. **POST-Redirect-GET** (Redireciona para limpar o POST após ações que mantêm na página)
if ($redirecionar_necessario) {
    header("Location: editar_deck.php" . ($is_editing ? "?deck_id={$editing_deck_id}" : ""));
    exit();
}

// --- 5. INÍCIO DO CÓDIGO HTML/APRESENTAÇÃO ---
?>

<div id="editar_deck" style="max-width: 1200px; margin: 0 auto; padding: 20px; background: #f4f4f4; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
    <h1 style="color: #333; border-bottom: 2px solid #ffcc00; padding-bottom: 10px; text-align: center;">
        <?php if ($is_editing): ?>
            EDITANDO: <span style="color: #007bff;"><?= htmlspecialchars($_SESSION['EDIT_STATE']['name']) ?></span>
        <?php else: ?>
            EDITOR DE DECK
        <?php endif; ?>
    </h1>

    <p style="text-align: center;"><a href="colecao.php">Voltar para a Coleção</a></p>

    <!-- Exibição de Mensagens -->
    <?php if (isset($_SESSION['sucesso'])): ?>
        <div style="padding: 10px; background-color: #d4edda; color: green; border: 1px solid #c3e6cb; margin-bottom: 15px; border-radius: 5px;"><?= $_SESSION['sucesso'];
                                                                                                                                                    unset($_SESSION['sucesso']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['erro'])): ?>
        <div style="padding: 10px; background-color: #f8d7da; color: #dc3545; border: 1px solid #f5c6cb; margin-bottom: 15px; border-radius: 5px;"><?= $_SESSION['erro'];
                                                                                                                                                    unset($_SESSION['erro']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['aviso'])): ?>
        <div style="padding: 10px; background-color: #fff3cd; color: orange; border: 1px solid #ffcc00; margin-bottom: 15px; border-radius: 5px;"><?= $_SESSION['aviso'];
                                                                                                                                                    unset($_SESSION['aviso']); ?></div>
    <?php endif; ?>


    <?php if (!$is_editing): ?>
        <div style="text-align: center; padding: 50px; border: 2px dashed #ccc; margin-top: 30px;">
            <p style="font-size: 1.2em;">
                Para começar a editar, por favor, selecione um deck na sua <a href="colecao.php" style="color: #007bff; font-weight: bold;">página de Coleção</a>.
            </p>
        </div>
    <?php else: ?>

        <div style="display: flex; gap: 20px; margin-top: 20px;">

            <!-- COLUNA ESQUERDA: PREVIEW E SALVAMENTO -->
            <div style="flex: 1; min-width: 300px; padding: 15px; background: #fff; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.05);">

                <h2 style="margin-top: 0; color: #333;">Estado Atual da Edição</h2>

                <div class="deck-counter" style="margin-bottom: 15px; padding: 10px; border: 1px solid #ddd; border-radius: 4px; text-align: center;">
                    <p style="margin: 0; font-size: 1.1em;">
                        Contador de Cartas:
                        <span style="color: <?= (get_deck_total_editing() > 100 || get_deck_total_editing() < 100) ? '#dc3545' : '#28a745' ?>; font-size: 1.2em; font-weight: bold;">
                            <?= get_deck_total_editing() ?> / 100
                        </span>
                    </p>
                    <?php if (get_deck_total_editing() != 100): ?>
                        <p style="color: #dc3545; margin: 5px 0 0 0;">🚨 O deck deve ter exatamente 100 cartas para salvar!</p>
                    <?php endif; ?>
                </div>

                <!-- FORMULÁRIO DE SALVAMENTO -->
                <div class="deck-save-form" style="padding: 15px; border: 2px solid #ffcc00; border-radius: 8px;">
                    <h3>Salvar Alterações</h3>
                    <form method="POST" action="editar_deck.php">
                        <input type="hidden" name="deck_id" value="<?= $editing_deck_id ?>">
                        <input type="hidden" name="editing_commander_id" value="<?= $commander_id ?>">

                        <label for="deck_name">Novo Nome do Deck:</label>
                        <input type="text" id="deck_name" name="deck_name" required
                            value="<?= htmlspecialchars($_SESSION['EDIT_STATE']['name']) ?>"
                            style="width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; border: 1px solid #ccc;">

                        <button type="submit" name="update_deck"
                            style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; cursor: pointer; font-size: 1em; font-weight: bold; border-radius: 5px; transition: background-color 0.3s;"
                            <?= (get_deck_total_editing() != 100) ? 'disabled' : '' ?>>
                            Salvar Alterações (<?= get_deck_total_editing() ?>/100)
                        </button>
                    </form>

                    <form method="POST" action="editar_deck.php" style="margin-top: 10px;">
                        <button type="submit" name="cancel_editing"
                            style="width: 100%; padding: 10px; background-color: #6c757d; color: white; border: none; cursor: pointer; font-size: 1em; border-radius: 5px; transition: background-color 0.3s;">
                            Cancelar Edição (Voltar sem salvar)
                        </button>
                    </form>
                </div>

                <div class="deck-preview" style="margin-top: 20px;">
                    <h3 style="color: #007bff;">Comandante: <?= $commander_id ?></h3>
                    <?php
                    // BUSCA IMAGEM DO COMANDANTE APENAS PARA EXIBIÇÃO
                    $query_imagem = "SELECT imagem, nome FROM cartas WHERE id_carta = ?";
                    $stmt_imagem = mysqli_prepare($conexao, $query_imagem);
                    $lider_selecionado = null;
                    if ($stmt_imagem) {
                        mysqli_stmt_bind_param($stmt_imagem, 's', $commander_id);
                        mysqli_stmt_execute($stmt_imagem);
                        $resultado_imagem = mysqli_stmt_get_result($stmt_imagem);
                        if ($resultado_imagem) {
                            $lider_selecionado = mysqli_fetch_assoc($resultado_imagem);
                        }
                        mysqli_stmt_close($stmt_imagem);
                    }
                    if ($lider_selecionado) {
                        echo "<p style='font-weight: bold;'>{$lider_selecionado['nome']}</p>";
                        echo "<img src='{$lider_selecionado['imagem']}' alt='Imagem do Comandante Selecionado' style='max-width: 100%; height: auto; border-radius: 8px;'>";
                    }
                    ?>

                    <h3 style="margin-top: 20px;">Cartas no Deck (Editando):</h3>
                    <ul style="list-style-type: none; padding: 0;">
                        <?php if (!empty($_SESSION['EDIT_STATE']['cards'])): ?>
                            <?php foreach ($_SESSION['EDIT_STATE']['cards'] as $deck_carta): ?>
                                <li style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dotted #eee; padding: 5px 0;">
                                    <span>
                                        <strong><?= $deck_carta['quantidade'] ?>x</strong>
                                        <?= htmlspecialchars($deck_carta['nome']) ?>
                                    </span>

                                    <form method="POST" action="editar_deck.php" style="display: inline-block;">
                                        <input type="hidden" name="carta_id" value="<?= $deck_carta['id'] ?>">
                                        <input type="hidden" name="deck_id" value="<?= $editing_deck_id ?>">
                                        <button type="submit" name="remove_from_deck"
                                            style="background-color: #dc3545; color: white; border: none; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 0.8em;">
                                            -1
                                        </button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>
                                <p>O deck está vazio (além do comandante).</p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- COLUNA DIREITA: LISTA DE CARTAS DISPONÍVEIS (Lógica de Filtragem do montar_deck.php) -->
            <div style="flex: 2; padding: 15px; background: #fff; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.05); overflow-y: auto;">
                <h2 style="margin-top: 0; color: #333;">Cartas Disponíveis (Filtradas)</h2>

                <div class="listas-container">
                    <?php
                    // --- INÍCIO DO BLOCO DE FILTRAGEM DE CARTAS (REAPROVEITADO) ---

                    if ($commander_id) {

                        // 1. BUSCAR AS CORES DO COMANDANTE
                        $query_comandante_cores = "SELECT branco, preto, verde, vermelho, azul, cinza, nome FROM cartas WHERE id_carta = ?";
                        $stmt_cores = mysqli_prepare($conexao, $query_comandante_cores);
                        $cores_comandante = null;

                        if ($stmt_cores) {
                            mysqli_stmt_bind_param($stmt_cores, 's', $commander_id);
                            mysqli_stmt_execute($stmt_cores);
                            $resultado_cores = mysqli_stmt_get_result($stmt_cores);

                            if ($resultado_cores) {
                                $cores_comandante = mysqli_fetch_assoc($resultado_cores);
                            }
                            mysqli_stmt_close($stmt_cores);
                        }


                        if ($cores_comandante) {

                            $cores_disponiveis = ['branco', 'preto', 'verde', 'vermelho', 'azul'];
                            $condicoes_restritivas = [];

                            // 2. CONSTRUIR A CLÁUSULA WHERE RESTRITIVA
                            foreach ($cores_disponiveis as $cor) {
                                if ($cores_comandante[$cor] == 0) {
                                    $condicoes_restritivas[] = "`{$cor}` = 0";
                                }
                            }

                            $clausula_cores_restritivas = implode(" AND ", $condicoes_restritivas);
                            $where_cores = !empty($clausula_cores_restritivas) ? " AND ({$clausula_cores_restritivas})" : "";

                            // 3. EXECUTAR A QUERY DE CARTAS FILTRADAS
                            $query_cartas_filtradas = "
                                SELECT id_carta, nome, tipo, imagem 
                                FROM `cartas` 
                                WHERE 
                                `id_carta` != ?
                                {$where_cores}
                                ORDER BY tipo, nome
                            ";
                            $stmt_filtradas = mysqli_prepare($conexao, $query_cartas_filtradas);
                            $cartas_filtradas_resultado = null;

                            if ($stmt_filtradas) {
                                mysqli_stmt_bind_param($stmt_filtradas, 's', $commander_id);
                                mysqli_stmt_execute($stmt_filtradas);
                                $cartas_filtradas_resultado = mysqli_stmt_get_result($stmt_filtradas);
                            }

                            // --- COMEÇA A EXIBIÇÃO DAS CARTAS ---

                            if ($cartas_filtradas_resultado && mysqli_num_rows($cartas_filtradas_resultado) > 0) {

                                $tipos_cartas = [
                                    '1' => 'Criaturas',
                                    '2' => 'Planeswalkers',
                                    '3' => 'Mágicas Instantâneas',
                                    '4' => 'Feitiços',
                                    '5' => 'Artefatos',
                                    '6' => 'Terrenos',
                                ];

                                $cartas_agrupadas = [];
                                while ($carta = mysqli_fetch_assoc($cartas_filtradas_resultado)) {
                                    $cartas_agrupadas[$carta['tipo']][] = $carta;
                                }
                                mysqli_free_result($cartas_filtradas_resultado);
                                mysqli_stmt_close($stmt_filtradas);

                                // Lista de divs em ordem de exibição
                                $divs_para_atualizar = [
                                    '2' => 'planeswalker',
                                    '1' => 'cartas_criatura',
                                    '3' => 'cartas_magica_insta',
                                    '5' => 'cartas_artefato',
                                    '4' => 'cartas_feitico',
                                    '6' => 'cartas_terreno',
                                ];

                                foreach ($divs_para_atualizar as $tipo_id => $classe_div) {
                                    echo "<div class='{$classe_div}' style='margin-bottom: 20px; border: 1px solid #ffcc00; padding: 10px; border-radius: 5px; background: #fff;'>";

                                    if (isset($cartas_agrupadas[$tipo_id])) {
                                        $titulo = $tipos_cartas[$tipo_id];
                                        echo "<h3 style='color: #007bff;'>{$titulo} disponíveis</h3>";
                                        echo "<ul style='list-style-type: none; padding: 0;'>";

                                        foreach ($cartas_agrupadas[$tipo_id] as $carta) {
                                            $carta_id = $carta['id_carta'];
                                            $is_in_deck = isset($_SESSION['EDIT_STATE']['cards'][$carta_id]);
                                            $is_terreno = ($tipo_id == '6');
                                            $quantidade_no_deck = $is_in_deck ? $_SESSION['EDIT_STATE']['cards'][$carta_id]['quantidade'] : 0;

                                            $deck_total_current = get_deck_total_editing();

                                            // Lógica de Máximo de Adição
                                            $max_add = 0;
                                            if ($is_terreno) {
                                                $max_add = 100 - $deck_total_current + $quantidade_no_deck;
                                                $max_add = max(0, $max_add);
                                            } else {
                                                if ($quantidade_no_deck == 0) {
                                                    $max_add = 1;
                                                    // Limita a 1 se o deck já estiver em 100
                                                    if ($deck_total_current >= 100) {
                                                        $max_add = 0;
                                                    }
                                                }
                                            }

                                            echo "<li style='display: flex; align-items: center; justify-content: space-between; border-bottom: 1px dotted #eee; padding: 5px 0;'>";
                                            echo "<div style='display: flex; align-items: center; gap: 10px;'>";
                                            echo "<img src='{$carta['imagem']}' alt='{$carta['nome']}' style='max-height: 40px; border-radius: 4px;'>";
                                            echo "<span>{$carta['nome']}</span>";

                                            if ($is_in_deck) {
                                                echo "<span style='margin-left: 10px; font-weight: bold; color: #28a745;'>({$quantidade_no_deck} no Deck)</span>";
                                            }
                                            echo "</div>";

                                            // --- FORMULÁRIO DE ADIÇÃO POR QUANTIDADE (POST) ---
                                            echo "<form method='POST' action='editar_deck.php' style='display: inline-flex; align-items: center; gap: 5px;'>";
                                            echo "<input type='hidden' name='deck_id' value='{$editing_deck_id}'>"; // Mantém o ID do deck na requisição
                                            echo "<input type='hidden' name='carta_id' value='{$carta_id}'>";
                                            echo "<input type='hidden' name='carta_nome' value='" . htmlspecialchars($carta['nome']) . "'>";
                                            echo "<input type='hidden' name='carta_imagem' value='" . htmlspecialchars($carta['imagem']) . "'>";

                                            $input_style = 'width: 40px; text-align: center; border: 1px solid #ccc; border-radius: 4px;';
                                            $button_disabled = ($max_add === 0) ? 'disabled' : '';

                                            // O campo de quantidade só é exibido e editável se for Terreno E puder adicionar
                                            if ($is_terreno && $max_add > 0) {
                                                echo "<input type='number' name='add_qty' 
                                                value='1' 
                                                min='1' 
                                                max='{$max_add}' 
                                                style='{$input_style}' 
                                                required>";
                                            } else {
                                                // Se for carta não-terreno ou se for Terreno mas max_add=0,
                                                // enviamos a quantidade 1 por hidden se for possível adicionar (max_add > 0)
                                                if ($max_add > 0) {
                                                    echo "<input type='hidden' name='add_qty' value='1'>";
                                                }
                                            }

                                            echo "<button type='submit' name='add_to_deck' 
                                                    style='padding: 5px 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;'
                                                    {$button_disabled}>
                                                    Adicionar
                                                </button>";

                                            echo "</form>";
                                            // --- FIM DO FORMULÁRIO DE ADIÇÃO ---

                                            echo "</li>";
                                        }
                                        echo "</ul>";
                                    } else {
                                        echo "<p>Nenhuma carta deste tipo disponível com as restrições de cor do Comandante.</p>";
                                    }
                                    echo "</div>";
                                }
                            } else {
                                echo "<div><p>Nenhuma carta comum encontrada para o Comandante {$cores_comandante['nome']} com as restrições de cor.</p></div>";
                            }
                        } else {
                            echo "<div><p>Erro: Não foi possível carregar as cores do Comandante para filtrar as cartas.</p></div>";
                        }
                    }
                    ?>
                </div>

            </div>
        </div>

    <?php endif; ?>
</div>

<?php
include('includes/footer.php');
?>