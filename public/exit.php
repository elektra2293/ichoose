<?php session_start();
$user=array();
$_SESSION['login']=$user;
header('Location: index.php');
?>