<?php
include('conecta.php');
$id=$_GET['id'];
$query=mysqli_query($conexao,"DELETE FROM `cartas` WHERE `id_carta` = $id");
if($query){
    echo "<script>alert('Carta removida!');</script>";
    header('location:adm.php');
}else{
    echo "<script>alert('Erro ao excluir carta!');</script>";
}
?>