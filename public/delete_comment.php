<?php
include 'connect.php'; 
$id_comm=$_GET['id_comm'];
$sql=mysql_query('DELETE FROM comment where ID_Comment="'.$id_comm.'"',$connect_to_db);
		 header("Location: {$_SERVER["HTTP_REFERER"]}");
		exit();
?>