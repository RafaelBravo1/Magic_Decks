<?php
$titulo="Edição de Cartas";
include('includes/header.php');
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
<div class="conteudo_pesquisa">

    <form action="resultado_pesquisa_adm.php" method="post">
        <h2>Pesquisar Cartas</h2><br>
        <input type="text" name="nome" placeholder="Digite o nome da carta">
        <select name="raridade">
            <option value="" disabled selected>Selecione a raridade</option>
            <?php
            while ($raridade = mysqli_fetch_array($rari)) {
            ?>
                <option value="<?= $raridade['id_raridade'] ?>"><?= $raridade['raridade'] ?></option>
            <?php
            }
            ?>
        </select>
        <button type="button" onclick="mostrarTabelaCores()">Cor</button>

        <select name="tipo">
            <option value="">Selecione o tipo</option>
                        <?php
                        while ($tipo = mysqli_fetch_array($categoria)) {
                        ?>
                            <option value="<?= $tipo['id_tipo'] ?>"><?= $tipo['Tipo'] ?></option>
                        <?php
                        }
                        ?>
        </select>
        <input type="number" name="custo" placeholder="Custo de mana">
        <input type="number" name="preco_min" placeholder="Preço mínimo">
        <input type="number" name="preco_max" placeholder="Preço máximo">
        <button type="submit">Pesquisar</button>
        <div class="cores" style="display: none;">
            <label class="checkbox">
                <input type="checkbox" class="checkbox-input" name="vermelho" value="vermelho" />
                <span class="box" aria-hidden="true" style="background: red;"></span>
                <span>vermelho</span>
            </label>
            <label class="checkbox">
                <input type="checkbox" class="checkbox-input" name="azul" value="azul" />
                <span class="box" aria-hidden="true" style="background: blue;"></span>
                <span>azul</span>
            </label>
            <label class="checkbox">
                <input type="checkbox" class="checkbox-input" name="verde" value="verde" />
                <span class="box" aria-hidden="true" style="background: green;"></span>
                <span>verde</span>
            </label>
            <label class="checkbox">
                <input type="checkbox" class="checkbox-input" name="preto" value="preto" />
                <span class="box" aria-hidden="true" style="background: black;"></span>
                <span>preto</span>
            </label>
            <label class="checkbox">
                <div class="branco">
                    <input type="checkbox" class="checkbox-input" name="branco" value="branco" />
                    <span class="box" aria-hidden="true" style="background: #FCF4A9;"></span>
                    <span>branco</span>
                </div>
            </label>
            <label class="checkbox">
                <div class="branco">
                    <input type="checkbox" class="checkbox-input" name="cinza" value="branco" />
                    <span class="box" aria-hidden="true" style="background: #CCCCCC;"></span>
                    <span>cinza</span>
                </div>
            </label>
        </div>
    </form>
</div>


<footer>
    <p>endereço placeholder<br>
        telefone placeholder<br>
        email placeholder</p>
</footer>

</body>
<script>
    function mostrarTabelaCores() {
        var coresDiv = document.querySelector('.cores');
        if (coresDiv.style.display === 'none' || coresDiv.style.display === '') {
            coresDiv.style.display = 'block';
        } else {
            coresDiv.style.display = 'none';
        }
    }
</script>

</html>