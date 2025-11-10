<?php
$titulo="Montar Deck";
include('includes/header.php');
include('conecta.php');

// --- 1. FUNÇÕES DE SUPORTE ---

/**
 * Busca detalhes da carta de forma segura usando Prepared Statements.
 */
function get_carta_details($conexao, $id_carta)
{
    // Usando '?' como placeholder
    $query = "SELECT tipo, cinza FROM cartas WHERE id_carta = ?";
    $stmt = mysqli_prepare($conexao, $query);

    if ($stmt) {
        // 's' indica que o parâmetro é uma string
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
 * Calcula o total de cartas no deck.
 */
function get_deck_total()
{
    $total = 0;
    // Garante que a sessão existe antes de tentar acessar
    if (isset($_SESSION['deck'])) {
        foreach ($_SESSION['deck'] as $carta) {
            $total += $carta['quantidade'];
        }
    }
    // O Comandante conta como 1 carta
    return $total + (isset($_SESSION['commander_id']) ? 1 : 0);
}

// --- 2. INICIALIZAÇÃO DE VARIÁVEIS DE SESSÃO ---

// Inicializa o deck e o comandante da sessão
if (!isset($_SESSION['deck'])) {
    $_SESSION['deck'] = [];
}
$id_selecionado = $_SESSION['commander_id'] ?? null;
$deck_is_locked = !empty($_SESSION['deck']);

// --- 3. LÓGICA DE MANIPULAÇÃO DO DECK (Adicionar/Remover com Quantidade) ---

// Esta variável define se um redirecionamento (PRG) deve ocorrer
$redirecionar_necessario = false;

// Lógica para adicionar carta ao deck (LIDA COM QUANTIDADE MÚLTIPLA)
if (isset($_POST['add_to_deck']) && $id_selecionado) {
    $carta_id = $_POST['carta_id'];
    // Captura a quantidade do campo numérico. Se não for enviada, assume 1.
    $add_qty = (int)($_POST['add_qty'] ?? 1);

    if ($add_qty <= 0) {
        // Quantidade inválida, só redireciona para limpar o POST.
        $redirecionar_necessario = true;
    } else {
        $details = get_carta_details($conexao, $carta_id);
        $quantidade_atual = $_SESSION['deck'][$carta_id]['quantidade'] ?? 0;

        // 1. Validação de Limite Total (100 cartas)
        // A lógica de soma foi ajustada para ser mais clara
        if ((get_deck_total() - $quantidade_atual) + ($quantidade_atual + $add_qty) > 100) {
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
                // Adiciona ou atualiza no deck
                $_SESSION['deck'][$carta_id] = [
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
    if (isset($_SESSION['deck'][$carta_id])) {
        $_SESSION['deck'][$carta_id]['quantidade']--;

        if ($_SESSION['deck'][$carta_id]['quantidade'] <= 0) {
            unset($_SESSION['deck'][$carta_id]);
        }
        $redirecionar_necessario = true;
    }
}

// Lógica para Salvar o Deck (COM ALTERAÇÃO DE SESSÃO E REDIRECIONAMENTO)
if (isset($_POST['save_deck'])) {
    $nome_deck = trim($_POST['deck_name']);
    $user_id = $_SESSION['user_id'] ?? 1; // **ASSUMINDO user_id na sessão**
    $deck_total = get_deck_total();

    // Validação básica
    if (empty($nome_deck)) {
        $_SESSION['erro'] = "O nome do deck não pode ser vazio.";
        $redirecionar_necessario = true;
    } elseif (is_null($id_selecionado)) {
        $_SESSION['erro'] = "Você deve selecionar um Comandante para salvar o deck.";
        $redirecionar_necessario = true;
    } elseif ($deck_total != 100) {
        $_SESSION['erro'] = "O deck deve ter exatamente 100 cartas (incluindo o Comandante). Total atual: {$deck_total}.";
        $redirecionar_necessario = true;
    } else {
        // Converte o array do deck em formato JSON para salvar no banco
        $deck_json = json_encode($_SESSION['deck']);
        $commander_id = $_SESSION['commander_id'];

        // USANDO PREPARED STATEMENT PARA SEGURANÇA
        $query_salvar = "INSERT INTO decks (nome, user_id, commander_id, cartas_json) VALUES (?, ?, ?, ?)";
        $stmt_salvar = mysqli_prepare($conexao, $query_salvar);

        if ($stmt_salvar) {
            mysqli_stmt_bind_param($stmt_salvar, 'siss', $nome_deck, $user_id, $commander_id, $deck_json);

            if (mysqli_stmt_execute($stmt_salvar)) {

                // Ação de Sucesso: Limpa a sessão do deck e redireciona
                $_SESSION['sucesso'] = "Deck '{$nome_deck}' salvo com sucesso! Você pode encontrá-lo em Coleção.";

                // Limpa as variáveis de sessão relacionadas ao deck em montagem
                unset($_SESSION['deck']);
                unset($_SESSION['commander_id']);

                // Redireciona para a página de Coleção
                header("Location: colecao.php");
                exit();
            } else {
                $_SESSION['erro'] = "Erro ao salvar o deck: " . mysqli_error($conexao);
                $redirecionar_necessario = true;
            }
            mysqli_stmt_close($stmt_salvar);
        } else {
            $_SESSION['erro'] = "Erro interno na preparação da query.";
            $redirecionar_necessario = true;
        }
    }
}

// 4. **POST-Redirect-GET** (Redireciona para limpar o POST após ações que mantêm na página)
if ($redirecionar_necessario) {
    header("Location: montar_deck.php");
    exit();
}

// 5. **LÓGICA DO COMANDANTE**

$deck_is_locked = !empty($_SESSION['deck']);

if (isset($_POST['commander'])) {
    if (!$deck_is_locked) {
        $id_selecionado = $_POST['commander'];
        $_SESSION['commander_id'] = $id_selecionado;
        // Redireciona (PRG) para limpar o POST da seleção do comandante
        header("Location: montar_deck.php");
        exit();
    } else {
        $id_selecionado = $_SESSION['commander_id'] ?? null;
    }
}

// --- 6. FUNÇÕES DE BUSCA AO BD ---
function comando($conexao)
{
    // *MANTENDO A VERSÃO INSEGURA PARA COMPATIBILIDADE RÁPIDA*
    $r = mysqli_query($conexao, "SELECT * FROM `cartas` WHERE `tipo` = '7'");
    return $r;
}
$comm = comando($conexao);

// --- 7. INÍCIO DO CÓDIGO HTML/APRESENTAÇÃO ---
?>
<div id="montar">
    <h1>MONTAGEM DE DECK</h1>

    <div class="deck-counter">
        <h2>
            Contador de Cartas:
            <span style="color: <?= (get_deck_total() > 100) ? '#dc3545' : '#ffcc00' ?>; font-size: 1.2em;">
                <?= get_deck_total() ?> / 100
            </span>
        </h2>
        <?php if (get_deck_total() > 100): ?>
            <p style="color: #dc3545;">🚨 Alerta: Você excedeu o limite de 100 cartas!</p>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['sucesso'])): ?>
        <p style="color: green; font-weight: bold;"><?= $_SESSION['sucesso'];
                                                    unset($_SESSION['sucesso']); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['erro'])): ?>
        <p style="color: #dc3545; font-weight: bold;"><?= $_SESSION['erro'];
                                                        unset($_SESSION['erro']); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION['aviso'])): ?>
        <p style="color: orange; font-weight: bold;"><?= $_SESSION['aviso'];
                                                        unset($_SESSION['aviso']); ?></p>
    <?php endif; ?>

    <div class="deck-save-form" style="margin-top: 20px; padding: 10px; border: 1px solid #ffcc00;">
        <h3>Salvar o Deck</h3>
        <form method="POST" action="montar_deck.php">
            <label for="deck_name">Nome do Deck:</label>
            <input type="text" id="deck_name" name="deck_name" required
                value="<?= htmlspecialchars($_POST['deck_name'] ?? '') ?>"
                style="padding: 5px; margin-right: 10px; border: 1px solid #ccc;">

            <button type="submit" name="save_deck" class="add-to-deck-btn"
                style="background-color: #28a745; cursor: pointer;"
                <?= (get_deck_total() != 100) ? 'disabled' : '' ?>>
                Salvar Deck (<?= get_deck_total() ?>/100)
            </button>
        </form>
        <?php if (get_deck_total() != 100): ?>
            <p style="color: #dc3545; font-size: 0.9em;">
                ❗ Você só pode salvar o deck com exatamente 100 cartas.
            </p>
        <?php endif; ?>
    </div>

    <div class="carta_comando">
        <h2>Selecione seu Commander</h2>

        <form method="POST" action="montar_deck.php">
            <?php
            $disabled_attribute = $deck_is_locked ? 'disabled' : '';

            if ($deck_is_locked && $id_selecionado) {
                echo "<input type='hidden' name='commander_lock' value='{$id_selecionado}'>";
            }
            ?>

            <select name="commander" onchange="this.form.submit()" <?= $disabled_attribute ?>>

                <option value="" <?= is_null($id_selecionado) ? 'selected' : '' ?> disabled>Selecione o Comandante</option>

                <?php
                if ($comm && mysqli_num_rows($comm) > 0) {
                    mysqli_data_seek($comm, 0);
                }

                while ($lider = mysqli_fetch_array($comm)) {
                    $selected_attr = ($lider['id_carta'] == $id_selecionado) ? 'selected' : '';
                ?>
                    <option value="<?= $lider['id_carta'] ?>" <?= $selected_attr ?>><?= $lider['nome'] ?></option>
                <?php
                }
                mysqli_data_seek($comm, 0);
                ?>
            </select>
        </form>
        <?php if ($deck_is_locked): ?>
            <p class="lock-message">⚠️ Comandante bloqueado! Remova todas as cartas do deck para poder alterá-lo.</p>
        <?php endif; ?>

    </div>

    <div class="deck-preview">
        <h3>Seu Deck Atual</h3>
        <?php if (!empty($_SESSION['deck'])): ?>
            <ul>
                <?php foreach ($_SESSION['deck'] as $deck_carta): ?>
                    <li>
                        <span><?= $deck_carta['nome'] ?> (x<?= $deck_carta['quantidade'] ?>)</span>
                        <img src="<?= $deck_carta['imagem'] ?>" alt="<?= $deck_carta['nome'] ?>" style="max-height: 50px;">

                        <form method="POST" action="montar_deck.php" style="display: inline-block;">
                            <input type="hidden" name="carta_id" value="<?= $deck_carta['id'] ?>">
                            <button type="submit" name="remove_from_deck" class="add-to-deck-btn" style="background-color: #dc3545;">Remover (1)</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Seu deck está vazio.</p>
        <?php endif; ?>
    </div>

    <div class="listas-container">
    </div>
    <?php
    if ($id_selecionado) {

        // --- BUSCA IMAGEM (Comandante) ---
        $query_imagem = "SELECT imagem FROM cartas WHERE id_carta = ?";
        $stmt_imagem = mysqli_prepare($conexao, $query_imagem);
        $lider_selecionado = null;
        if ($stmt_imagem) {
            mysqli_stmt_bind_param($stmt_imagem, 's', $id_selecionado);
            mysqli_stmt_execute($stmt_imagem);
            $resultado_imagem = mysqli_stmt_get_result($stmt_imagem);
            if ($resultado_imagem) {
                $lider_selecionado = mysqli_fetch_assoc($resultado_imagem);
            }
            mysqli_stmt_close($stmt_imagem);
        }

        if ($lider_selecionado) {
    ?>
            <img src="<?= $lider_selecionado['imagem'] ?>" alt="Imagem do Comandante Selecionado">
    <?php
        } else {
            echo "<p>Comandante selecionado não encontrado.</p>";
        }

        // --- INÍCIO DO BLOCO DE FILTRAGEM DE CARTAS ---

        // 1. BUSCAR AS CORES DO COMANDANTE
        $query_comandante_cores = "SELECT branco, preto, verde, vermelho, azul, cinza, nome FROM cartas WHERE id_carta = ?";
        $stmt_cores = mysqli_prepare($conexao, $query_comandante_cores);
        $cores_comandante = null;

        if ($stmt_cores) {
            mysqli_stmt_bind_param($stmt_cores, 's', $id_selecionado);
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

            // 4. EXECUTAR A QUERY DE CARTAS FILTRADAS
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
                mysqli_stmt_bind_param($stmt_filtradas, 's', $id_selecionado);
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
                    '7' => 'Comandantes', // Embora não apareçam aqui, bom ter para referência
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
                    echo "<div class='{$classe_div}'>";

                    if (isset($cartas_agrupadas[$tipo_id])) {
                        $titulo = $tipos_cartas[$tipo_id];
                        echo "<h3>{$titulo} disponíveis (Filtradas para o deck de {$cores_comandante['nome']})</h3>";
                        echo "<ul>";

                        foreach ($cartas_agrupadas[$tipo_id] as $carta) {
                            $carta_id = $carta['id_carta'];
                            $is_in_deck = isset($_SESSION['deck'][$carta_id]);
                            $is_terreno = ($tipo_id == '6');

                            echo "<li>";
                            echo "<span>{$carta['nome']}</span>";
                            echo "<img src='{$carta['imagem']}' alt='{$carta['nome']}'>";

                            // --- FORMULÁRIO DE ADIÇÃO POR QUANTIDADE (POST) ---
                            echo "<form method='POST' action='montar_deck.php' style='display: inline-flex; align-items: center; gap: 5px;'>";
                            echo "<input type='hidden' name='carta_id' value='{$carta_id}'>";
                            echo "<input type='hidden' name='carta_nome' value='" . htmlspecialchars($carta['nome']) . "'>";
                            echo "<input type='hidden' name='carta_imagem' value='" . htmlspecialchars($carta['imagem']) . "'>";

                            $quantidade_no_deck = $is_in_deck ? $_SESSION['deck'][$carta_id]['quantidade'] : 0;

                            $max_add = 1; // Default: máximo de 1 para cartas não-terreno
                            $input_style = 'width: 40px; text-align: center;';

                            if ($is_terreno) {
                                // Se for Terreno, pode adicionar até o limite do deck
                                $max_add = 100 - get_deck_total() + $quantidade_no_deck;
                                $max_add = max(1, $max_add); // Garante que é pelo menos 1, se não estiver cheio.
                            } else {
                                // Se não for Terreno e já estiver no deck, o máximo é 0 (não pode adicionar)
                                if ($quantidade_no_deck > 0) {
                                    $max_add = 0;
                                }
                            }

                            // O campo de quantidade só é exibido se for Terreno OU se a carta não estiver no deck
                            if ($is_terreno && $max_add > 0) {
                                echo "<input type='number' name='add_qty' 
            value='1' 
            min='1' 
            max='{$max_add}' 
            style='{$input_style}' 
            required>";

                                // Adiciona um input hidden para que a lógica de POST saiba a quantidade padrão
                                // de 1 se for não-terreno.
                                echo "<input type='hidden' name='is_terreno' value='1'>";
                            } else {
                                // Para cartas não-terreno, se for possível adicionar (max_add > 0, ou seja, 0 cópias no deck), 
                                // enviamos a quantidade 1 por um campo hidden, para que a lógica POST receba 1.
                                if ($max_add > 0) {
                                    // Envia a quantidade 1 se não for terreno e ainda puder ser adicionada
                                    echo "<input type='hidden' name='add_qty' value='1'>";
                                }
                            }

                            // Botão de Adicionar
                            $button_disabled = ($max_add === 0) ? 'disabled' : '';

                            echo "<button type='submit' name='add_to_deck' class='add-to-deck-btn' {$button_disabled}>
                                    Adicionar
                                </button>";

                            // Exibe a quantidade atual, se houver
                            if ($is_in_deck) {
                                echo "<span style='margin-left: 10px; font-weight: bold;'>({$quantidade_no_deck} no Deck)</span>";
                            }

                            echo "</form>";
                            // --- FIM DO FORMULÁRIO DE ADIÇÃO ---


                            // Se a carta já estiver no deck, adiciona um botão de Remover 1
                            if ($is_in_deck) {
                                echo "<form method='POST' action='montar_deck.php' style='display: inline-block; margin-left: 5px;'>";
                                echo "<input type='hidden' name='carta_id' value='{$carta_id}'>";
                                echo "<button type='submit' name='remove_from_deck' class='add-to-deck-btn' style='background-color: #dc3545;'>Remover (1)</button>";
                                echo "</form>";
                            }

                            echo "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<h3>{$tipos_cartas[$tipo_id]}</h3>";
                        echo "<p>Nenhuma carta deste tipo disponível com as cores do Comandante.</p>";
                    }
                    echo "</div>";
                }
            } else {
                echo "<div><p>Nenhuma carta comum encontrada para o Comandante {$cores_comandante['nome']} com as restrições de cor.</p></div>";
            }
        }
    }

    ?>
</div>

<?php
include('includes/footer.php');
?>