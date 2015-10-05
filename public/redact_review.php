<?php session_start();
$_SESSION['errors']=Array();
$sity=$_COOKIE["yourSity"];
	if(empty($sity))
	{setcookie("yourSity", 1, time()+3600*240);
	header('Location:index.php');}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
window.jQuery || document.write('<script type="text/javascript" src="rating/js/jquery-1.6.2.min.js"><\/script>');
</script>
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/head.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/category.css" rel="stylesheet" type="text/css">
<link href="rating/styles/jquery.rating.css" rel="stylesheet" type="text/css">
<link href="css/private_office.css" rel="stylesheet" type="text/css">
<link href="css/new_review.css" rel="stylesheet" type="text/css">
<title>Отзыв</title>
</head>

<body>

<div id="wraper">
 <?php
include("head.php");
include("connect.php");
$id_rev=$_GET['id_rev'];
 ?>
<div id="private">
<?php 
$client=mysql_query('select * from clients where emaill like "'.$_SESSION['login']['email'].'"',$connect_to_db)
or die(mysql_error());
$clients= mysql_fetch_array($client);

$review=mysql_query('select * from review where ID_Review = '.$id_rev.'',$connect_to_db)
or die(mysql_error()); 
$reviews=mysql_fetch_array($review);

$company=mysql_query('select * from company where ID_Company = '.$reviews['ID_Company'].'',$connect_to_db)
or die(mysql_error()); 
$comps=mysql_fetch_array($company);
echo '<h1 style="color:#006">'.$comps["Company_Name"].'/Отзыв</h1>';

echo '
<form method="post" action="change_review.php" enctype = "multipart/form-data">
<p>Название отзыва:</p>
<input name="review_name" placeholder="Краткая характеристика" maxlength="70" size="70" value="'.$reviews["Name_Review"].'">
<p>Текст отзыва:</p>
<textarea name="review_text" placeholder="Текст отзыва"  cols=54 rows=25 style="">'.$reviews["Review_Text"].'</textarea>
<p><label for="photo" class="question">Загрузить фото: </label>
<input type="hidden" name="id_rev" value="'.$reviews["ID_Review"].'">
<input type="hidden" name="id_comp" value="'.$comps['ID_Company'].'">
 <input type="file" name="photo" id="photo" ></p>
 <input type="submit"  value="Сохранить изменения"></input>
 <div class="clear">
</div>
</form>' ?>

</div>
<div class="clear">
</div>
</div>
</body>
</html>
