<?php include('includes/header.php'); 
if(!isset($_SESSION['nivel_usuario']) || $_SESSION['nivel_usuario'] < 2 )
{header('location:login.php');}?>