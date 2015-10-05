<div id="ichoose">
<div id="logo">
</div>
<form class="block2" action="set_sity.php" method="post">
<p align="center">Ваш город
<?php include("connect.php");
echo '<select name="sity">';
	$sity=$_COOKIE["yourSity"];
    $qr_result = mysql_query("select * from sity where ID_Sity = $sity" , $connect_to_db )
		or die(mysql_error());
		$qr_results=mysql_fetch_array($qr_result);
		do{
		echo '<option value='.$qr_results['ID_Sity'].'>'.$qr_results['Name_Sity'].'</option>';
		} 
		while ($qr_results=mysql_fetch_array($qr_result));
	
    $qr_result = mysql_query("select * from sity where id_sity<>$sity" , $connect_to_db )
		or die(mysql_error());
		$qr_results=mysql_fetch_array($qr_result);
		do{
		echo '<option value='.$qr_results['ID_Sity'].'>'.$qr_results['Name_Sity'].'</option>';
		} 
		while ($qr_results=mysql_fetch_array($qr_result));
		echo '</select> <input type="submit"  value=""></input></p>';	
?>
</form>
<?php if(empty($_SESSION['login']))
{echo '<div id=menu>
  <a href=index.php>Главная</a>
  <a href=registr.php>Регистрация</a>
  <a href=raiting.php>Рейтинг</a>
</div>';}
else 
{echo'<div id=menu_after>
  <a href=index.php>Главная</a>
  <a href=private_office_company.php>Личный кабинет</a>
  <a href=raiting.php>Рейтинг</a>
</div>';} ?>

</div>
<div class="enter">
 <?php  if($_SESSION['login']==1){}
 else{
 if(empty($_SESSION['login']))
 	include("widget_enter.php"); 
 else include("widget_private.php");} ?>
</div>



