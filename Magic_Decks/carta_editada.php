<?php
$titulo="Edição de Cartas";
function raridade($conexao)
{
    $r = mysqli_query($conexao, "SELECT * FROM `raridade`");
    return $r;
}
function tipo($conexao)
{
    $r = mysqli_query($conexao, "SELECT * FROM `tipo`");
    return $r;
}
include('conecta.php');

$rari = (raridade($conexao));
$categoria = (tipo($conexao));
$cartaid = $_GET['id'];
$cartaselecionada = mysqli_query($conexao, "SELECT * FROM `cartas` WHERE id_carta = $cartaid");
$carta = mysqli_fetch_array($cartaselecionada);
include('includes/headeradm.php');
?>

<div class="inclui">
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Editar Carta</h2><br>
        <label for="nome">Nome<input type="text" name="nome" placeholder="Digite o nome da carta" value="<?= $carta['nome'] ?>" required></label>
        <label for="raridade">Raridade<select name="raridade" required>
                <option value="" disabled>Selecione a raridade</option>
                <option value="<?= $carta['raridade'] ?>" selected><?php while ($rariselec = mysqli_fetch_array($rari)) {
                                                                        if ($rariselec['id_raridade'] == $carta['raridade']) { ?>
                            <?= $rariselec['raridade'] ?> -selecionado- </option>
            <?php }
                                                                    }
                                                                    mysqli_data_seek($rari, 0);
                                                                    while ($raridad = mysqli_fetch_array($rari)) {
            ?>
            <option value="<?= $raridad['id_raridade'] ?>"><?= $raridad['raridade'] ?></option>
        <?php
                                                                    }
        ?>
            </select></label>
        <label for="descricao">Descrição<input type="text" name="descricao" placeholder="descrição" value="<?= $carta['descricao'] ?>" required></label>
        <label for="vermelho">vermelho<input type="number" name="vermelho" placeholder="0" value="<?= $carta['vermelho'] ?>" required></label>
        <label for="azul">azul<input type="number" name="azul" placeholder="0" value="<?= $carta['azul'] ?>" required></label>
        <label for="verde">verde<input type="number" name="verde" placeholder="0" value="<?= $carta['verde'] ?>" required></label>
        <label for="preto">preto<input type="number" name="preto" placeholder="0" value="<?= $carta['preto'] ?>" required></label>
        <label for="branco">branco<input type="number" name="branco" placeholder="0" value="<?= $carta['branco'] ?>" required></label>
        <label for="cinza">INCOLOR<input type="number" name="cinza" placeholder="0" value="<?= $carta['cinza'] ?>" required></label>

        <label for="tipo">Tipo:<select name="tipo" required>
                <option value="">Selecione o tipo</option>
                <option value="<?= $carta['tipo'] ?>" selected><?php while ($tiposelec = mysqli_fetch_array($categoria)) {
                                                                    if ($tiposelec['id_tipo'] == $carta['tipo']) { ?>
                            <?= $tiposelec['Tipo'] ?> -selecionado- </option>
            <?php }
                                                                }
                                                                mysqli_data_seek($categoria, 0);
                                                                while ($tipo = mysqli_fetch_array($categoria)) {
            ?>
            <option value="<?= $tipo['id_tipo'] ?>"><?= $tipo['Tipo'] ?></option>
        <?php
                                                                }
        ?>
            </select></label>
        <label for="preco">Preço:<input type="number" name="preco" placeholder="Preço" st ep="0.00" value="" required></label>
        <label for=""> Imagem da carta:<input type="file" name="imagem"></label>
        <button type="submit">Salvar</button>
    </form>
</div>
<?php
include('includes/footer.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $vermelho = $_POST['vermelho'];
    $verde = $_POST['verde'];
    $azul = $_POST['azul'];
    $preto = $_POST['preto'];
    $branco = $_POST['branco'];
    $cinza = $_POST['cinza'];
    $preco = $_POST['preco'];
    $tipo = $_POST['tipo'];
    $raridade = $_POST['raridade'];
    $descricao = $_POST['descricao'];
    $custo = 0;
    $verm = false;
    $verd = false;
    $az = false;
    $pret = false;
    $bran = false;
    $cin = false;
    if ($vermelho > 0) {
        $verm = true;
        $custo = $custo + $vermelho;
    }
    if ($verde > 0) {
        $verd = true;
        $custo = $custo + $verde;
    }
    if ($azul > 0) {
        $az = true;
        $custo = $custo + $azul;
    }
    if ($preto > 0) {
        $pret = true;
        $custo = $custo + $preto;
    }
    if ($branco > 0) {
        $bran = true;
        $custo = $custo + $branco;
    }
    if ($cinza > 0) {
        $cin = true;
        $custo = $custo + $cinza;
    }
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] !== UPLOAD_ERR_NO_FILE){
        $arquivo = $_FILES['imagem'];
        if ($arquivo['error'])
            die("falha ao enviar arquivo");

        if ($arquivo['size'] > 10 * 1024 * 1024)
            die("aquivo muito grande, tamanho maximo: 10MB");

        $pasta = "cartas/";
        $nomedoArquivo = $arquivo['name'];
        $novoNomedoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION));

        if ($extensao != "jpg" && $extensao != "png" && $extensao != "webp" && $extensao != "gif" && $extensao != "jpeg")
            die("Tipo de arquivo não aceito");

        $path = $pasta . $novoNomedoArquivo . "." . $extensao;

        $deu_certo = move_uploaded_file($arquivo['tmp_name'], $path);
        if ($deu_certo) {
            $stmt = mysqli_prepare($conexao, "UPDATE `cartas` SET `nome`=?,`raridade`=?,`tipo`=?,`descricao`=?,`custo`=?,`branco`=?,`preto`=?,`verde`=?,`vermelho`=?,`azul`=?,`cinza`=?,`preco`=?,`imagem`=? WHERE id_carta = $cartaid");

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "siisiiiiiiids", $nome, $raridade, $tipo, $descricao, $custo, $bran, $pret, $verd, $verm, $az, $cin, $preco, $path);
                $inseriu = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($inseriu) {
                    echo "<script>alert('Carta atualizada com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao atualizar carta!');</script>";
                }
            }
        }
    } else {

        $stmt = mysqli_prepare($conexao, "UPDATE `cartas` SET `nome`=?,`raridade`=?,`tipo`=?,`descricao`=?,`custo`=?,`branco`=?,`preto`=?,`verde`=?,`vermelho`=?,`azul`=?,`cinza`=?,`preco`=?,`imagem`=? WHERE id_carta = $cartaid");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "siisiiiiiiids", $nome, $raridade, $tipo, $descricao, $custo, $bran, $pret, $verd, $verm, $az, $cin, $preco, $carta['imagem']);
            $inseriu = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($inseriu) {
                echo "<script>alert('Carta atualizada com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao atualizar carta!');</script>";
            }
        }
    }
}



?>