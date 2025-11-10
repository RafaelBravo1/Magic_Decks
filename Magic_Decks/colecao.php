<?php
$titulo="Coleção de Decks";
include('includes/header.php');
include('conecta.php');

$user_id = $_SESSION['user_id'] ?? 1; // Usar o mesmo ID de usuário da lógica de salvar
$decks = [];

// Query segura para buscar decks
$query_decks = "SELECT id, nome, commander_id, data_criacao FROM decks WHERE user_id = ?";
$query_comandantes = "SELECT nome nome FROM cartas WHERE id_carta = ?";
$stmt_decks = mysqli_prepare($conexao, $query_decks);
$stmt_comandante = mysqli_prepare($conexao, $query_comandantes);

if ($stmt_decks) {
    mysqli_stmt_bind_param($stmt_decks, 'i', $user_id);
    mysqli_stmt_execute($stmt_decks);
    $resultado = mysqli_stmt_get_result($stmt_decks);

    if ($resultado) {
        $decks = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }
    mysqli_stmt_close($stmt_decks);
}
if ($stmt_comandante) {
    foreach ($decks as $key => $deck) {
        $commander_id = $deck['commander_id'];
        $commander_nome = "ID: {$commander_id} (Não Encontrado)"; // Default

        // Bind e Execução para buscar o nome
        mysqli_stmt_bind_param($stmt_comandante, 's', $commander_id); // 's' pois o id_carta pode ser varchar/string
        mysqli_stmt_execute($stmt_comandante);
        $resultado_comandante = mysqli_stmt_get_result($stmt_comandante);

        if ($resultado_comandante && $nome_achado = mysqli_fetch_assoc($resultado_comandante)) {
            $commander_nome = $nome_achado['nome'];
        }

        // Armazena o nome no array do deck para ser usado no HTML
        $decks[$key]['commander_nome'] = $commander_nome;
    }
    mysqli_stmt_close($stmt_comandante);
}
?>

<div id="lista_decks">
    <h1>Meus Decks Salvos</h1>

    <?php if (empty($decks)): ?>
        <p>Você ainda não salvou nenhum deck.</p>
    <?php else: ?>
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #333; color: #ffcc00;">
                    <th style="padding: 10px;">ID do Deck</th>
                    <th style="padding: 10px;">Nome</th>
                    <th style="padding: 10px;">Comandante</th>
                    <th style="padding: 10px;">Data de Criação</th>
                    <th style="padding: 10px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($decks as $deck): ?>
                    <tr>
                        <td style="padding: 10px; text-align: center;"><?= $deck['id'] ?></td>
                        <td style="padding: 10px;"><?= htmlspecialchars($deck['nome']) ?></td>
                        <td style="padding: 10px; text-align: center;">
                            <strong><?= htmlspecialchars($deck['commander_nome']) ?></strong>
                        </td>
                        <td style="padding: 10px; text-align: center;"><?= $deck['data_criacao'] ?></td>
                        <td style="padding: 10px; text-align: center;">
                            <a href="editar_deck.php?deck_id=<?= $deck['id'] ?>">Carregar</a>
                            <a href="excluir_deck.php?id=<?= $deck['id'] ?>" style="color: #dc3545;">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <p style="margin-top: 20px;"><a href="montar_deck.php">Voltar para Montagem de Deck</a></p>
</div>

<?php
include('includes/footer.php');
?>

