<?php $review=mysql_query("select * from comment where id_review=$id_rev",$connect_to_db) 
or die('Неверный запрос!: ' . mysql_error());
$reviews=mysql_fetch_array($review);
if(empty($reviews))
{echo "</div><p>Комментариев пока нет</p>";
if (empty($_SESSION['login']['email']))
{echo '<p>Чтобы оставить комментарий, войдите в систему</p>';}
else{

echo'<form  action="new_comment.php" method="post" class="comment"> <input type="hidden" name="id_rev" value="'.$id_rev.'"><div style="float:left; margin-left:80px;"><textarea name="inf" cols=40 rows=2></textarea></div><div style="float:left; margin-top:8px;"><input type="submit"  value="Комментировать"></input></div><form>';}}

else
{ 
	$count_review=mysql_query("select COUNT(ID_Comment) AS count from comment where id_review=$id_rev",$connect_to_db) 
or die('Неверный запрос: ' . mysql_error());

$count_reviews=mysql_fetch_array($count_review);
echo "</div><p>Комментарии(".$count_reviews['count'].")</p>";
	
echo '<div class="comment"><ul>';
do
{ $sql=mysql_query("select * from clients where id_client=".$reviews['ID_Client']."",$connect_to_db) 
or die('Неверный запрос!: ' . mysql_error());
$avatar=mysql_fetch_array($sql);
$id=$reviews['ID_Review'];
$date_rev=date( 'Y-m-d H:i:s',$reviews['time_rev']);
$id_comm=$reviews['ID_Comment'];
	echo "<li>
	<div class='review'>
	<div class='photo'>";
	if (empty($avatar['avatar'])) 
	{echo"<img src='images/nophoto.jpg' width='40' height='auto' alt='name' />";}
	else
	{echo"<img src='images/client_avatar/".$avatar['avatar']."' width='40' height='auto' alt='name' />";}; echo "</div><div class='reviev_info'>";
	if ($avatar['emaill']==$_SESSION['login']['email'])
	{echo"<p >".$avatar['client_name']."(Это Вы)<span style='font-weight:200; float:right'>".$date_rev."</span></p>";
	echo "<div class='review_text'><p >".$reviews['Comment_text']."<p/></div>";
	echo "<div style='margin-left:320px'><a href='delete_comment.php?id_comm=".$id_comm."' style='margin-left:20px;'><img src='images/delete.png'><label >удалить комментарий</label></a></div>";}
	else{echo"<p >".$avatar['client_name']."<span style='font-weight:200; float:right'>".$date_rev."</span></p>";
	echo "<div class='review_text'><p >".$reviews['Comment_text']."<p/>";}

	echo "</div><div class='clear'><div/></div></li>";
}
	while($reviews=mysql_fetch_array($review));
echo '</ul>';
if (empty($_SESSION['login']['email']))
{echo '<p>Чтобы оставить комментарий, войдите в систему</p>';}
else{

echo'<form  action="new_comment.php" method="post" class="comment"> <input type="hidden" name="id_rev" value="'.$id_rev.'"><div style="float:left; margin-left:80px;"><textarea name="inf" cols=40 rows=2></textarea></div><div style="float:left; margin-top:8px;"><input type="submit"  value="Комментировать"></input></div><form></div>';};}?>