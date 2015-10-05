<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/head.css" rel="stylesheet" type="text/css">
<link href="css/enter.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/private_office.css" rel="stylesheet" type="text/css">
<link href="rating/styles/jquery.rating.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="fliplightbox/jquery.min.js"></script>
<script type="text/javascript" src="fliplightbox/fliplightbox.min.js"></script>
<script src="bookmark.js" ></script>

<script type="text/javascript">
window.jQuery || document.write('<script type="text/javascript" src="rating/js/jquery-1.6.2.min.js"><\/script>');
</script>

<script type="text/javascript" src="rating/js/show-rating.js"></script>

<script type="text/javascript">

$(function(){
	
	$('.rating').rating({
		fx: 'half',
        image: 'rating/images/stars.png',
        loader: 'rating/images/ajax-loader.gif',
        callback: function(responce){
            
            this.vote_success.fadeOut(2000);
            
            alert('Общий бал: '+this._data.val);
        }
	});
})
</script>
<title>Личный кабинет</title>
</head>

<body>
<div id="wraper">
<?php 
include "connect.php";
$email = $_SESSION['login']['email'];
$qr_result= mysql_query("select * from company where email like '$email'" , $connect_to_db )
or die(mysql_error()); 
$qr_results=mysql_fetch_array($qr_result);
if (empty ($qr_results))
{$_SESSION['login']=1;
include("head.php");
echo  "<p class='message'> Чтобы просматривать эту страницу, войдите в систему </p>";
	include ("widget_bad_enter.php");
	session_destroy();}
else
{include("head.php");
$email = $_SESSION['login']['email'];
$qr_result= mysql_query("select * from company where email like '$email'" , $connect_to_db )
or die(mysql_error()); 
$qr_results=mysql_fetch_array($qr_result);
echo '<div id="private">
<div id="avatar">';
$avatar = $qr_results['main_photo'];
echo "<img src='images/company_avatar/".$avatar."' width='200' height='auto' alt='name' />";
echo '</div>
<div id="bookmark">
<ul id="tabs">
    <li><a href="#" title="tab1">Информация о компании</a></li>
    <li><a href="#" title="tab2">Изменить информацию</a></li> 
</ul>
<div id="content">
<div id="tab1">';
$raiting = mysql_query("select sum(number) as total_raiting from raiting WHERE id_company='".$qr_results['ID_Company']."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$raitings= mysql_fetch_array($raiting);
		$rating = $raitings['total_raiting'];
		$count_raiting = mysql_query("select COUNT(number) as count_raiting from raiting WHERE id_company='".$qr_results['ID_Company']."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$count_raitings= mysql_fetch_array($count_raiting);
		$count = $count_raitings['count_raiting'];
	if ($count!=0)
		{$total_raiting=$rating/$count;}
	else{$total_raiting=0;}
		
		echo'<p style="font-size:24px; display:inline-block;">'.$qr_results['Company_Name'].'<span class="rating" style="display:inline-block;">
                <input type="hidden" name="val" value="'.$total_raiting.'"/>
                <input type="hidden" name="votes" value="'.$count.'"/></span></p>';
echo "<p> Ваш email: ".$qr_results['email']."</p>";
echo "<p> Ваш телефон: ".$qr_results['Phone']."</p>";
echo "<p> Ваш сайт: <a href='".$qr_results['Site']."'>".$qr_results['Site']."</a></p>";
if($_COOKIE['yourSity']==1 or $_COOKIE['yourSity']==2)
{$qr_metro= mysql_query("select * from metro where ID_Metro='".$qr_results['ID_Metro']."'" , $connect_to_db )
or die(mysql_error()); 
$qr_metros = mysql_fetch_array($qr_metro);
echo "<p> Станция метро: ".$qr_metros['Name_Metro']."</p>";}
$qr_street= mysql_query("select * from Street where ID_Street='".$qr_results['ID_Street']."'" , $connect_to_db )
or die(mysql_error()); 
$qr_streets = mysql_fetch_array($qr_street);
echo "<p> Ваш адрес: ".$qr_streets['Name_Street']."  ".$qr_results['house']."</p>";
echo "<p> Информация о компании: ".$qr_results['Information']."</p>
<ul id='photo'> " ; 
$email = $_SESSION['login']['email'];
$qr_result= mysql_query("select * from company where email like '$email'" , $connect_to_db )
or die(mysql_error()); 
$qr_results=mysql_fetch_array($qr_result);
$photo= mysql_query("select * from photo where ID_Company= '".$qr_results['ID_Company']."'" , $connect_to_db )
or die(mysql_error()); 
$photos=mysql_fetch_array($photo);

if (empty($photos['File'])){}
else{
 do{
echo '<li><a href="images/company_photo/'.$photos['File'].'" class="flipLightBox"><img src="images/company_photo/'.$photos['File'].'" width="auto" height="100" alt="Image 1" /></a></li>';}
while ($photos=mysql_fetch_array($photo));}
echo '</ul>';
echo"
<script type='text/javascript'>$('body').flipLightBox()</script>
</div>
<div id='tab2'>
<form action='change_company.php' method = 'POST' class='information' enctype = 'multipart/form-data'>
 <table>
  <tr>
    <td> <label for='site' class='question'>Сайт компании: </label></td>
	<td> <input type='text' name='site' id='site' size='30'  value='".$qr_results['Site']."' class='input'></td>
  </tr>
    <tr>
    <td><label for='phone' class='question'>Ваш телефон: </label></td>
	<td>  <input type='text' name='phone' id='phone' size=30  value='".$qr_results['Phone']."' class='input'></td>
  </tr>";
  if($_COOKIE['yourSity']==1 or $_COOKIE['yourSity']==2)
{$qr_metro= mysql_query("select * from metro where ID_Sity='".$_COOKIE['yourSity']."'" , $connect_to_db )
or die(mysql_error()); 
$qr_metros = mysql_fetch_array($qr_metro);
 echo'<tr>
    <td><label for="metro" class="question"> Станция метро: </label></td>
	<td> <select id="metro" name = "metro" type="text"  class="select">';
	do{
			$id = $qr_metros['ID_Metro'];
		echo "<option value='$id'>" . $qr_metros['Name_Metro'] ."</option>" ;
		} 
		while ($qr_metros = mysql_fetch_array($qr_metro));
		echo '</select></td></tr>
		 <tr>';}
		 
		 $qr_street= mysql_query("select * from street where ID_Sity='".$_COOKIE['yourSity']."'" , $connect_to_db )
or die(mysql_error()); 
$qr_streets = mysql_fetch_array($qr_street);
 echo'<tr>
    <td><label for="street" class="question"> Улица: </label></td>
	<td> <select id="street" name = "street" type="text"  class="select">';
	do{
			$id = $qr_streets['ID_Street'];
		echo "<option value='$id'>" . $qr_streets['Name_Street'] ."</option>" ;
		} 
		while ($qr_streets = mysql_fetch_array($qr_street));
		echo "</select></td></tr>
		 <tr>
		     <tr>
    <td><label for='house' class='question'>Дом/строение: </label></td>
	<td>  <input type='text' name='house' id='phone' size=5  value='".$qr_results['house']."' class='input'></td>
  </tr>";
		 

  echo" <tr><td><label class='question'> Информация о компании:</label></td>
	<td> <textarea name='inf' cols=30 rows=10>".$qr_results['Information']."</textarea></td>
  </tr>";
echo'<tr><td> <label for="photo" class="question">Загрузить фото: </label></td>
<td> <input type="file" name="photo" id="photo" ></td></tr>';
  
 echo" 
  </tr>";

echo "</table><input type='submit'  value='Сохранить изменения'></input>
</label> <a href='Delete_Company.php'><label for='photo' class='question' style='margin-top:5px; margin-right:5px;'>Удалить компанию </label><img src='images/ok.png' width='auto' height='auto'/></a>
</form></div>

</div>

</div>
</div>";
}?>

<?php 


?>






<div class="clear">
</div>
</div>

</body>
</html>