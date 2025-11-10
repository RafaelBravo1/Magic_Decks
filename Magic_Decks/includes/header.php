<?php
session_start();
include("./conecta.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" href="css/estilo.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Pagina' ?></title>
</head>

<body>
    <header>
        <nav>
            <div class="logo_canto">
<img src="imagens/logo.jpg" alt="Logo">
            </div>
            <div class="usuario">
                <h3><?= $_SESSION['usuario'] ?? 'DESLOGADO' ?></h3>
                <a href="logout.php">Sair</a>
            </div>
            <div class="botoes_coloridos">
                                <?php
                if (isset($_SESSION['nivel_usuario']) && $_SESSION['nivel_usuario'] >= 2) {?>
                <button style="background-color: #ffffffff;" onclick="location.href='adm.php'">Área do ADM</button>
                <?php } ?>
                <button style="background-color: #4EBEF6;" onclick="location.href='index.php'">Início</button>
                <button style="background-color: #FCF4A9;" onclick="location.href='pesquisar_cartas.php'">Pesquisar Cartas</button>
                <button style="background-color: #AC7D7D;" onclick="location.href='montar_deck.php'">Montar Deck</button>
                <button style="background-color: #42B268;" onclick="location.href='colecao.php'">Coleção</button>
                <button style="background-color: #F77E55;" onclick="location.href='login.php'">Login</button>
            </div>
        </nav>
    </header>

    <main>