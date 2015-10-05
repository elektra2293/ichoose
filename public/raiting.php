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

<link href="css/rating.css" rel="stylesheet" type="text/css">
<link href="rating/styles/jquery.rating.css" rel="stylesheet" type="text/css">
<title>Рейтинг компаний</title>
</head>

<body>

<div id="wraper">
 <?php
include("head.php");
include("connect.php");
$company= mysql_query('select * from company',$connect_to_db);
$companies=mysql_fetch_array($company);
do{
	$count_rev= mysql_query('select COUNT(ID_Company) as count from review where id_company='.$companies[ID_Company].'',$connect_to_db);
	$count_revs=mysql_fetch_array($count_rev);
	$sum_rating= mysql_query('select SUM(number) as sum_rating from raiting where id_company='.$companies[ID_Company].'',$connect_to_db);
	$sum_ratings= mysql_fetch_array($sum_rating);
	$sum=$sum_ratings['sum_rating'];
	$count_raiting= mysql_query('select count(number) as count_rating from raiting where id_company='.$companies[ID_Company].'',$connect_to_db);
	$count_raitings= mysql_fetch_array($count_raiting);
	$count = $count_raitings['count_rating'];
	if($count==0){$total_raiting=0;}
	else{
	$total_raiting=round($sum/$count, 1);}
	$total_raiting=mysql_query('update company SET rating='.$total_raiting.' where id_company='.$companies[ID_Company].'',$connect_to_db);
	$count_rev=mysql_query('update company SET count_rev='.$count_revs['count'].' where id_company='.$companies[ID_Company].'',$connect_to_db);
}
while($companies=mysql_fetch_array($company));
$company_rev= mysql_query('select * from company order by count_rev  DESC LIMIT 10',$connect_to_db);
$companies_rev=mysql_fetch_array($company_rev);

$company_rat=mysql_query('select * from company order by rating  DESC LIMIT 10',$connect_to_db);
$companies_rat= mysql_fetch_array($company_rat);
 ?>

<div id="cat">
<div class='rating'>
<div class="list">
<div class="top">Популярные компании</div>
<div class="list">
<?php do{echo '<div class="comp"><div class="img"><img src="images/company_avatar/'.$companies_rev['main_photo'].'" width="35" height="auto"></div><div class="com_name"><a href="company.php?id_comp='.$companies_rev['ID_Company'].'">'.$companies_rev['Company_Name'].'</a> </div>   <div><img src="images/review_icon.png" style:"float:left">  '.$companies_rev['Count_rev'].'</div></div>'; }
while($companies_rev=mysql_fetch_array($company_rev))?>
</div>
</div>
</div>

<div class='rating'>
<div class="list">
<div class="top">Лучшие компании</div>
<?php do{echo '<div class="comp"><div class="img"><img src="images/company_avatar/'.$companies_rat['main_photo'].'" width="35" height="auto"></div><div class="com_name"><a href="company.php?id_comp='.$companies_rat['ID_Company'].'">'.$companies_rat['Company_Name'].'</a></div>   <div><img src="images/star.png" height=14px style:"float:left">'.$companies_rat['rating'].'</div></div>'; }
while($companies_rat= mysql_fetch_array($company_rat))?>
</div>
</div>


</div>
<div class="clear">
</div>
</div>
</body>
</html>
