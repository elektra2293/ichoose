<?php 
	session_start();
	include 'connect.php';
	$email = $_SESSION['login']['email'];
	$sql = mysql_query('DELETE FROM clients WHERE emaill="'.$email.'"', $connect_to_db)
		or die(mysql_error());
		$user=array();
		$_SESSION['login']=$user;
		header('Location: index.php');
		exit;
?>