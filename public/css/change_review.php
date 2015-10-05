<?php 
include "connect.php";
$name=$_POST['review_name'];
$text=$_POST['review_text'];
$photo=$_FILES['photo']['name'];
$id_rev=$_POST['id_rev'];
$uploadfile = "images/company_photo/".$_FILES['photo']['name'];
move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
$sql = mysql_query('UPDATE review SET Name_Review = "'.$name.'", Review_Text="'.$text.'" WHERE email="'.$email.'"', $connect_to_db)
or die(mysql_error());
if (empty($photo)){}
else{
		$sql=mysql_query('INSERT INTO photo (ID_Review, File) VALUES ('.$id_rev.', "'.$photo.'")');}
		header("Location: {$_SERVER["HTTP_REFERER"]}");
		exit;
?>