<?php
include 'connect.php'; 
$id_rev=$_GET['id_rev'];
$sql=mysql_query('DELETE FROM review where ID_Review="'.$id_rev.'"',$connect_to_db);
		 header("Location: {$_SERVER["HTTP_REFERER"]}");
		exit();
?>