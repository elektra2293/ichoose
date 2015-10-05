<?php
session_start();
include "connect.php";
$comment=$_POST['inf'];
$id_rev=$_POST['id_rev'];
$user=$_SESSION['login']['email'];
$time=time();
$user_id=mysql_query('select * from clients where emaill = "'.$user.'"',$connect_to_db)
or die(mysql_error());
$users_id=mysql_fetch_array($user_id); 
$sql=mysql_query('INSERT INTO comment (comment_text, ID_Client, ID_Review, time_rev) VALUES( "'.$comment.'" , "'.$users_id['id_client'].'" , "'.$id_rev.'", "'.$time.'" )', $connect_to_db)
or die('Неверный запрос!'. mysql_error());
 header("Location: {$_SERVER["HTTP_REFERER"]}");
		exit();
 ?>