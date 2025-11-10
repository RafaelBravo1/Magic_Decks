<?php
$titulo="LOGIN";
include('includes/header.php');
if(isset($_SESSION['usuario'])){
?>
<div class="login" style="text-align: center;"><h1>JÁ ESTÁ LOGADO</h1>
<h2>Aproveite suas proximas 24 horas</h2></div>
<?php
}else{
?>
        <form class="login" method="POST">
            <label>usuário:<input type="text" name="nome"></label>
            <label>senha:<input type="password" name="senha"></label>
            <input type="submit" value="Login">
            <a href="cadastrar_usuario.php">Novo Usuário? Clique aqui para cadastrar</a>
        </form>

<?php
include('conecta.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usuario = $_POST['nome'];
    $query = "SELECT * FROM `login` WHERE nome_de_usuario = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($resultado) > 0) {
        while ($user = mysqli_fetch_assoc($resultado)) {
            if (password_verify($_POST['senha'], $user['hash'])) {
                echo "conectado";
                $_SESSION['usuario'] = $user['nome_de_usuario'];
                $_SESSION['user_id'] = $user['id_usuario'];
                $_SESSION['nivel_usuario'] = $user['nivel'];
                header('Location: index.php');
            } else {
                echo "usuario ou senha incorreto";
                unset($_SESSION['usuario']);
                unset($_SESSION['nivel_usuario']);
                die;
            }
        }
    } else {
        echo "usuario ou senha incorreto";
        die;
    }
}
}
include('includes/footer.php');