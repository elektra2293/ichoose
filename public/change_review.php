<?php 
include "connect.php";
$name=$_POST['review_name'];
$text=$_POST['review_text'];
$photo=$_FILES['photo']['name'];
$id_rev=$_POST['id_rev'];
$id_comp=$_POST['id_comp'];
$uploadfile = "images/review_photo/".$_FILES['photo']['name'];
move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
$sql = mysql_query('UPDATE review SET Name_Review = "'.$name.'", Review_Text="'.$text.'" WHERE ID_Review="'.$id_rev.'"', $connect_to_db)
or die(mysql_error());
if (empty($photo)){}
else{
		$sql=mysql_query('INSERT INTO photo (ID_Review, File) VALUES ('.$id_rev.', "'.$photo.'")');}
		header("Location: Company.php?id_comp=".$id_comp."");
		exit;
?>