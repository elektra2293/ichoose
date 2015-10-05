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

<script type="text/javascript" src="rating/js/show-rating.js"></script>

<script type="text/javascript">

$(function(){
	
	$('.rating_2').rating({
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
<link href="rating/styles/jquery.rating.css" rel="stylesheet" type="text/css">
<title>Главная</title>
</head>

<body>

<div id="wraper">
 <?php
include("head.php")
 ?>

<div id="cat">
 <?php include("category.php");?>


</div>
<div class="clear">
</div>
</div>
</body>
</html>
