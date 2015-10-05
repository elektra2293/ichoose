<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/head.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/private_office.css" rel="stylesheet" type="text/css">
<link href="rating/styles/jquery.rating.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="fliplightbox/jquery.min.js"></script>
<script src="bookmark.js" ></script>


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
if (empty($avatar))
{echo "<img src='images/nophoto.jpg' width='200' height='auto' alt='name' />";}
else{
echo "<img src='images/client_avatar/".$avatar."' width='200' height='auto' alt='name' />";}
?>
</div>
<div id="bookmark">
<ul id="tabs">
    <li><a href="#" title="tab1">Информация о клиенте</a></li>
    <li><a href="#" title="tab2">Изменить информацию</a></li> 
</ul>
<div id="content">
<div id="tab1">
<?php
		
		echo'<p style="font-size:24px; display:inline-block;">'.$qr_results['client_name'].' '.$qr_results['client_sername'].'</p>';
echo "<p> Ваш email: ".$qr_results['emaill']."</p>";
$qr_sity= mysql_query("select * from sity where ID_Sity='".$_COOKIE['yourSity']."'" , $connect_to_db )
or die(mysql_error()); 
$qr_sitys = mysql_fetch_array($qr_sity);
echo "<p> Ваш город: ".$qr_sitys['Name_Sity']."</p>";
?>
</div>
<div id="tab2">
<form action="change_client.php" method = "POST" class="information" enctype = 'multipart/form-data'>
<?php

echo" <table>";
 	 
	
 echo'<tr>
    <td width="200px"><label for="sity" class="question"> Ваш город: </label></td>
	<td> <select id="sity" name = "sity" type="text"  class="select">';
	$qr_sity= mysql_query("select * from sity where ID_Sity='".$_COOKIE['yourSity']."'" , $connect_to_db )
or die(mysql_error()); 
$qr_sitys = mysql_fetch_array($qr_sity);
	do{
			$id = $qr_sitys['ID_Sity'];
		echo "<option value='$id'>" . $qr_sitys['Name_Sity'] ."</option>" ;
		} 
		while ($qr_sitys = mysql_fetch_array($qr_sity));
			$qr_sity= mysql_query("select * from sity where ID_Sity<>'".$_COOKIE['yourSity']."'" , $connect_to_db )
or die(mysql_error()); 
$qr_sitys = mysql_fetch_array($qr_sity);
	do{
			$id = $qr_sitys['ID_Sity'];
		echo "<option value='$id'>" . $qr_sitys['Name_Sity'] ."</option>" ;
		} 
		while ($qr_sitys = mysql_fetch_array($qr_sity));
		echo "</select></td></tr>";
		echo'<tr><td> <label for="photo" class="question">Загрузить фото: </label></td>
<td> <input type="file" name="photo" id="photo" ></td></tr>';
  
 echo" 
  </tr>";
echo "</table>";
?>
<input type='submit'  value='Сохранить изменения'></input>
</label> <a href='Delete_Client.php'><label for='photo' class='question' style="margin-top:5px; margin-right:5px;">Удалить аккаунт </label><img src='images/ok.png' width='auto' height='auto'/></a>
</form>

</div>

</div>

</div>
</div>

<div class="clear">
</div>
</div>

</body>
</html>