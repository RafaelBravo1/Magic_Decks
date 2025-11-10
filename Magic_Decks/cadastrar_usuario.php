<?php
$titulo="Cadastrar Usuário";
include('conecta.php');
include('includes/header.php')
?>

<form class="cadastro" method="POST">
    <h3>Cadastrar</h3>
<label>Nome de usuário:<input type="text" name="nome"></label>
<label>E-mail:<input type="email"name="email"></label>
<label>Senha:<input type="password"name="senha"></label>
<input type="submit" value="cadastrar">
<a href="login.php">Já é cadastrado? Faça login clicando aqui!</a>
</form>

<?php
include('includes/footer.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $senha=password_hash($_POST['senha'],PASSWORD_DEFAULT);

    echo $senha;
 $stmt = mysqli_prepare($conexao, "INSERT INTO `login`(`nivel`, `nome_de_usuario`, `email`, `hash`) VALUES ('1',?,?,?)");
 if($stmt){
                mysqli_stmt_bind_param($stmt, "sss",$nome,$email,$senha);
                $inseriu = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if ($inseriu) {
                    echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar usuário!');</script>";
                }
            }
}
?>