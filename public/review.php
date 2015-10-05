<?php

$review=mysql_query("select * from review where id_company=$id_comp",$connect_to_db) 
or die('Неверный запрос!: ' . mysql_error());
$reviews=mysql_fetch_array($review);
if(empty($reviews))
{echo "<p>Отзывов пока нет</p>";}
else
{ 
	$count_review=mysql_query("select COUNT(Name_Review) AS count from review where id_company=$id_comp",$connect_to_db) 
or die('Неверный запрос: ' . mysql_error());

$count_reviews=mysql_fetch_array($count_review);
echo "<p>Отзывы(".$count_reviews['count'].")</p>";
	
echo '<ul>';
do
{ $sql=mysql_query("select * from clients where id_client=".$reviews['ID_Client']."",$connect_to_db) 
or die('Неверный запрос!: ' . mysql_error());
$avatar=mysql_fetch_array($sql);
$id=$reviews['ID_Review'];
$date_rev=date( 'Y-m-d ',$reviews['Review_Time']);
if ($avatar['emaill']==$_SESSION['login']['email'])
{$str="(Это Вы)";}
else{$str="";}
	echo "<li><div style='float:left; margin-top:5px;'>".$date_rev."</div><div class='name_review'>".$reviews['Name_Review']."</div>
	<div class='review'>
	<div class='photo'><img src='images/client_avatar/".$avatar['avatar']."' width='50' height='auto' alt='name' /></div><div class='reviev_info'>"; if ($avatar['emaill']==$_SESSION['login']['email'])
{echo"<div><div style='float:left'>".$avatar['client_name']."(Это Вы)</div> <div style='margin-left:380px'><a href='redact_review.php?id_rev=".$id."'><img src='images/edit.png'><label >редактировать отзыв</label></a><a href='delete_review.php?id_rev=".$id."' style='margin-left:20px;'><img src='images/delete.png'><label >удалить отзыв</label></a></div></div>";}
else {echo"<p >".$avatar['client_name']."</p>";}
echo"<div class='review_text'><p>".$reviews['Review_Text']."<p/></div>

	</div><div class='full-review'><a href='full_review.php?id_comp=".$id_comp."&id_rev=".$id."'>Читать далее</a></div><div class='clear'><div/></div></li>";
	
}
	while($reviews=mysql_fetch_array($review));
echo '</ul>';}	
?>
