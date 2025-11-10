<?php
include('conecta.php');
$id=$_GET['id'];
$query=mysqli_query($conexao,"DELETE FROM `decks` WHERE `id` = $id");
if($query){
    echo "<script>alert('Deck removido!');</script>";
    header('location:colecao.php');
}else{
    echo "<script>alert('Erro ao excluir deck!');</script>";
}
?>