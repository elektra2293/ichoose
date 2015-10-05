<div id="ichoose">
<form class="block2" action="set_sity.php" method="post">
<p align="center">Ваш город</p>
<?php include("connect.php");
echo '<p><select name="sity">';
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
		echo '</select> <input type="submit" value="Выбрать"></input></p>';	
?>
</form>

<div id=menu>
  <a href=index.php>Главная</a>
  <a href=private_office_company.html>Личный кабинет</a>
  <a href=rating.html>Рейтинг</a>
</div>


</div>