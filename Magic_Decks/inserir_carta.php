<?php
$titulo="Inserir Carta";
include('includes/headeradm.php');
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

?>

        <div class="inclui">
            <form action="" method="post" enctype="multipart/form-data">
                <h2>Inserir Carta</h2><br>
                <label for="nome">Nome<input type="text" name="nome" placeholder="Digite o nome da carta" required></label>
                <label for="raridade">Raridade<select name="raridade" required>
                        <option value="" disabled>Selecione a raridade</option>
                        <?php
                        while ($raridade = mysqli_fetch_array($rari)) {
                        ?>
                            <option value="<?= $raridade['id_raridade'] ?>"><?= $raridade['raridade'] ?></option>
                        <?php
                        }
                        ?>
                    </select></label>
                <label for="descricao">Descrição<input type="text" name="descricao" placeholder="descrição" required></label>
                <label for="vermelho">vermelho<input type="number" name="vermelho" value="0" placeholder="0" required></label>
                <label for="azul">azul<input type="number" name="azul" value="0" placeholder="0" required></label>
                <label for="verde">verde<input type="number" name="verde" value="0" placeholder="0" required></label>
                <label for="preto">preto<input type="number" name="preto" value="0" placeholder="0" required></label>
                <label for="branco">branco<input type="number" name="branco" value="0" placeholder="0" required></label>
                <label for="cinza">INCOLOR<input type="number" name="cinza" value="0" placeholder="0" required></label>

                <label for="tipo">Tipo:<select name="tipo" required>
                        <option value="">Selecione o tipo</option>
                        <?php
                        while ($tipo = mysqli_fetch_array($categoria)) {
                        ?>
                            <option value="<?= $tipo['id_tipo'] ?>"><?= $tipo['Tipo'] ?></option>
                        <?php
                        }
                        ?>
                    </select></label>
                <label for="preco">Preço:<input type="number" name="preco" placeholder="Preço" step="0.00" required></label>
                <label for=""> Imagem da carta:<input type="file" name="imagem"></label>
                <button type="submit">Salvar</button>
            </form>
        </div>
    </Main>
    <footer>
        <p>endereço placeholder<br>
            telefone placeholder<br>
            email placeholder</p>
    </footer>
    </div>
</body>

</html>
<?php
include("conecta.php");

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
    if (isset($_FILES['imagem'])) {
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
            $stmt = mysqli_prepare($conexao, "INSERT INTO `cartas` (`nome`,`raridade`,`tipo`,`descricao`,`custo`,`branco`,`preto`,`verde`,`vermelho`,`azul`,`preco`,`imagem`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "siisiiiiiids", $nome, $raridade, $tipo, $descricao, $custo, $bran, $pret, $verd, $verm, $az, $preco, $path);
                $inseriu = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($inseriu) {
                    echo "<script>alert('Carta cadastrada com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar carta!');</script>";
                }
            }
        }
    }
}



?>