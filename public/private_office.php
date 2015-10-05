<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/head.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/private_office.css" rel="stylesheet" type="text/css">
<title>Личный кабинет</title>
</head>

<body>
<div id="wraper">
<?php include("head.php")?>
<div id="private">

<div id="avatar">
<?php 
$email = $_SESSION['login']['email'];
$qr_result= mysql_query("select * from clients where emaill like '$email'" , $connect_to_db )
or die(mysql_error()); 
$qr_results=mysql_fetch_array($qr_result);
$avatar = $qr_results['avatar'];
echo "<img src='images/".$avatar."' width='200' height='auto' alt='name' />"
?>
</div>
<div class="information">
<?php
echo "<p>".$qr_results['client_name']."</p>";
?>
</div>
</div>
<div class="clear">
</div>
</div>

</body>
</html>