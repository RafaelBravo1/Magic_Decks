<?php

$titulo = "Pesquisar Cartas Para Edição";
include("conecta.php");
function raridade($conexao)
{
    $r = mysqli_query($conexao, "SELECT * FROM `raridade`");
    return $r;
}
$rari = (raridade($conexao));
function tipo($conexao)
{
    $r = mysqli_query($conexao, "SELECT * FROM `tipo`");
    return $r;
}
$type = (tipo($conexao));
$filtrocor = false;
$vermelho = 0;
$verde = 0;
$preto = 0;
$branco = 0;
$cinza = 0;
$azul = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['vermelho']) || isset($_POST['verde']) || isset($_POST['preto']) || isset($_POST['branco']) || isset($_POST['cinza']) || isset($_POST['azul'])) {
        $filtrocor = true;
        if (isset($_POST['vermelho'])) {
            $vermelho = true;
        }
        if (isset($_POST['verde'])) {
            $verde = true;
        }
        if (isset($_POST['preto'])) {
            $preto = true;
        }
        if (isset($_POST['branco'])) {
            $branco = true;
        }
        if (isset($_POST['cinza'])) {
            $cinza = true;
        }
        if (isset($_POST['azul'])) {
            $azul = true;
        }
        $where = "`branco` = '$branco' and `preto` = '$preto' and `verde` = '$verde' and `vermelho` = '$vermelho' and `azul` = '$azul' and `cinza` = '$cinza'";
    }
    if (isset($_POST['nome'])) {
        if (isset($where)) {
            $where = $where . " and ";
        } else {
            $where = "";
        }

        $nome = $_POST['nome'];
        $where = $where . " `nome` LIKE '%$nome%'";
    }
    if (isset($_POST['tipo']) && ($_POST['tipo'] != "")) {
        if (isset($where)) {
            $where = $where . " and ";
        } else {
            $where = "";
        }
        $tipo = $_POST['tipo'];
        $where = $where . " `tipo` = '$tipo'";
    }
    if ($_POST['custo'] != "") {
        if (isset($where)) {
            $where = $where . " and ";
        } else {
            $where = "";
        }
        $custo = $_POST['custo'];
        $where = $where . " `custo` = '$custo'";
    }
    if (isset($_POST['raridade']) && ($_POST['raridade'] != "")) {
        if (isset($where)) {
            $where = $where . " and ";
        } else {
            $where = "";
        }
        $raridade = $_POST['raridade'];
        $where = $where . " `raridade` = '$raridade'";
    }

    $sql = mysqli_query($conexao, "SELECT * FROM `cartas` WHERE $where");
?>
    <?php
    include('includes/header.php');
    ?>

    <div class="conteudo_pesquisa">
        <table style="border: 1px black double;">
            <tr>
                <th>nome</th>
                <th>tipo</th>
                <th>raridade</th>
                <th>descrição</th>
                <th>imagem</th>
                <th>Preço</th>
                <th colspan="2">Ação</th>
            </tr>
            <?php
            while ($carta = mysqli_fetch_array($sql)) {
                while ($raridade = mysqli_fetch_array($rari)) {
                    if ($carta['raridade'] == $raridade['id_raridade']) {
                        $carta['raridade' ]= $raridade['raridade'];
                    }
                }
                while ($tipo = mysqli_fetch_array($type)) {
                    if ($carta['tipo'] == $tipo['id_tipo']) {
                        $carta['tipo' ]= $tipo['Tipo'];
                    }
                }
                mysqli_data_seek($rari, 0);
                mysqli_data_seek($type, 0);
            ?>
                <tr>
                    <td><?= $carta['nome'] ?></td>

                    <td><?= $carta['tipo'] ?></td>
                    <td><?= $carta['raridade'] ?></td>


                    <td><?= htmlspecialchars($carta['descricao'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></td>
                    <td><img style="object-fit:cover" width="300px" src="<?= $carta['imagem'] ?>"></td>
                    <td>R$<?= number_format($carta['preco'], 2, ',', ".") ?></td>
                    <td><a href="carta_editada.php?id=<?= $carta['id_carta'] ?>" style="text-decoration:none; color:yellow">Editar</a></td>
                    <td><a href="carta_excluir.php?id=<?= $carta['id_carta'] ?>" style="text-decoration:none;color:red">Excluir</a></td>
                </tr>

        <?php
            }
        }
        ?>
        </table>
    </div>
    <?php
    include('includes/footer.php');
    ?>