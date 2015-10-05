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
<script type="text/javascript" src="fliplightbox/jquery.min.js"></script>
<script type="text/javascript" src="fliplightbox/fliplightbox.min.js"></script>
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/head.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/category.css" rel="stylesheet" type="text/css">
<link href="css/private_office.css" rel="stylesheet" type="text/css">
<link href="css/review.css" rel="stylesheet" type="text/css">
<link href="rating/styles/jquery.rating.css" rel="stylesheet" type="text/css">
<title>Документ без названия</title>
</head>

<body>
<div id="wraper">
 <?php
include("head.php")
 ?>
<?php	
include('connect.php');
$id_comp = $_GET['id_comp'];
$company = mysql_query("select * from company  WHERE ID_Company=$id_comp" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$companies= mysql_fetch_array($company);?>
        
        
<div id="private">
    <div id="avatar">
    <?php 
    $avatar = $companies['main_photo'];
    echo "<img src='images/company_avatar/".$avatar."' width='200' height='auto' alt='name' />"
    ?><div>
    <a href="enter_for_review.php"><img src='images/review.png'></a>
    </div>
    </div>
    
    <div id="bookmark">
    <div id="content">
    <div id="tab1">
    <?php
    
            include("new_vote.php");
            echo'<p ><label style="font-size:24px; display:inline-block;">'.$companies['Company_Name'].'</label><span class="rating" style="display:inline-block;">
                    <input type="hidden" name="val" value="'.$total_raiting.'"/>
                    <input type="hidden" name="votes" value="'.$count.'"/></span></p>';
                    
    echo "<p> email: ".$companies['email']."</p>";
    echo "<p> Телефон: ".$companies['Phone']."</p>";
    echo "<p> Cайт: <a href='".$companies['Site']."'>".$companies['Site']."</a></p>";
    if($_COOKIE['yourSity']==1 or $_COOKIE['yourSity']==2)
    {$qr_metro= mysql_query("select * from metro where ID_Metro='".$companies['ID_Metro']."'" , $connect_to_db )
    or die(mysql_error()); 
    $qr_metros = mysql_fetch_array($qr_metro);
    echo "<p> Станция метро: ".$qr_metros['Name_Metro']."</p>";}
    $qr_street= mysql_query("select * from Street where ID_Street='".$companies['ID_Street']."'" , $connect_to_db )
    or die(mysql_error()); 
    $qr_streets = mysql_fetch_array($qr_street);
    echo "<p> Адрес: ".$qr_streets['Name_Street']."  ".$companies['house']."</p>";
    echo "<p> Информация о компании: ".$companies['Information']."</p>";
    ?>
    <ul id="photo">   
    <?php
    
    $photo= mysql_query("select * from photo where ID_Company= '".$companies['ID_Company']."'" , $connect_to_db )
    or die(mysql_error()); 
    $photos=mysql_fetch_array($photo);
    
    if (empty($photos['File'])){}
    else{
     do{
    echo '<li><a href="images/company_photo/'.$photos['File'].'" class="flipLightBox"><img src="images/company_photo/'.$photos['File'].'" width="auto" height="100" alt="Image 1" /></a></li>';}
    while ($photos=mysql_fetch_array($photo));} ?>
    </ul>
    <script type="text/javascript">$('body').flipLightBox()</script>
    </div>
    </div>
    </div>
 <div class="review">
<?php include "review.php" ?>
</div>
</div>

<div class="clear">
</div>
</div>

</body>
