<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/head.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/registr.css" rel="stylesheet" type="text/css">

<title>регистрация</title>
</head>

<body>
<div id="wraper">
 <?php include("head.php")?>
 <script src="jquery.js"></script>
<script src="jquery.maskedinput.js"></script>
<script src="linkedlist.js" ></script>
<script src="bookmark.js" ></script>
<script type="text/javascript">
jQuery(function($){
   $("#phone").mask("8-(999)-999-9999");
});
</script>
<div id="reg">


<ul id="tabs">
    <li><a href="#" title="tab1">Компания</a></li>
    <li><a href="#" title="tab2">Клиент</a></li> 
</ul>
<div id="content"> 
<div id="tab1">

<form action="regcompany.php" method="POST" name = "form2" class = "form2"  enctype = 'multipart/form-data' >
<fieldset>

<label for="name" class="question"> Название компании: </label>
 <input type="text" name="name" id="name" size="30" maxlength="30" class="input">
 <span class="error" ><?php echo $_SESSION['errors']['name']?></span>

 <label for="email" class="question">контактный email: </label>
 <input type="text" name="email" id="email" size="30"  class="input">
  <span class="error" ><?php echo $_SESSION['errors']['email']?></span>
  <label for="site" class="question">Сайт компании: </label>
 <input type="text" name="site" id="site" size="30"  class="input">
 
  <label for="phone" class="question"> Телефон: </label>
 <input type="text" name="phone" id="phone" size="30"  class="input">
 
<label for="sity2" class="question"> Ваш город: </label>
		<?php
	    $qr_result = mysql_query('select * from sity' , $connect_to_db )
		or die(mysql_error());
		$qr_results=mysql_fetch_array($qr_result);
        echo '<select id="sity2"  type="text" class="select">';
		echo '<option value = 0>-выберите город-</option>';
		do{
		$id = $qr_results['ID_Sity'];
		echo "<option value='$id'>" . $qr_results['Name_Sity'] .'</option>' ;
		} 
		while ($qr_results=mysql_fetch_array($qr_result)) ;
		echo'</select>';
		$_COOKIE['yourSity']= $id;
		?> 
<label for="street" class="question"> Ваша улица: </label>
<select id="street" name="street" type="text" disabled class="select"></select>
 <span class="error" ><?php echo $_SESSION['errors']['street']?></span>
 <label for="house" class="question"> Дом/строение: </label>
<input id="house" name="house" type="text" size="30" class="unput">
<span id="show" style="display:block">

</span>

 <label for="subcat" class="question"> Выберите раздел: </label>
		<?php
	    $qr_result = mysql_query("select * from category where ID_Category > 21 and ID_Category < 32" , $connect_to_db )
		or die(mysql_error());
		$qr_results=mysql_fetch_array($qr_result);
        echo '<select id="category" name="category" type="text" class="select">';
		echo '<option value = 0>-выберите раздел-</option>';
		do{
		$id = $qr_results['ID_Category'];
		echo " <option value='$id'>".$qr_results['Type_Name'].'</option>';		
		} 
		while ($qr_results=mysql_fetch_array($qr_result)) ;
		echo'</select>';
		?> 
 <label  class="question"> Категория: </label>
<select id="subcat" name = "subcat" type="text" disabled class="select">
</select>
 <span class="error" ><?php echo $_SESSION['errors']['subcat']?></span>

<label for="photo" class="question">Фото компании: </label>
 <input type="file" name="photo" id="photo" style="margin-left:0px" >

<label for="password" class="question">Введите пароль: </label>
 <input type="password" name="password" id="password" size="30" maxlength="10" class="input">
  <span class="error" ><?php echo $_SESSION['errors']['password']?></span>

<input type="submit" value="Регистрация"></input>
</fieldset>



</form>
</div>

<div  id="tab2">
<form action="regclient.php" method="POST" name = "form1" class="form1" enctype = 'multipart/form-data'>

<fieldset>

<label for="name" class="question"> Ваше имя: </label>
 <?php echo ' <input type="text" name="name" id="name" size="30"  class="input" value="'.$_SESSION['data']['name'].'">'?>

 <label for="sername" class="question"> Ваша фамилия: </label>
 <?php echo ' <input type="text" name="sername" id="sername" size="30"  class="input" value="'.$_SESSION['data']['sername'].'">'?>
 
<label for="sity1" class="question"> Ваш город: </label>
<?php
	    $qr_result = mysql_query('select * from sity' , $connect_to_db )
		or die(mysql_error());
		$qr_results=mysql_fetch_array($qr_result);
        echo '<select id="sity1" name="sity1" type="text" class="select">';
		do{
			$id = $qr_results['ID_Sity'];
		echo "<option value='$id'>" . $qr_results['Name_Sity'] .'</option>' ;
		} 
		while ($qr_results=mysql_fetch_array($qr_result)) ;
		echo'</select>'
		?>


<label for="email" class="question">Ваш email: </label>
<?php echo '<input type="text" name="email" id="email" size="30" class="input" value="'.$_SESSION['data']['email'].'">'?>


<label for="photo" class="question">Ваше фото: </label>
 <input type="file" name="photo" id="photo" >
 
 
<label for="password" class="question">Введите пароль: </label>
<input type="password" name="password" id="password" size="30" maxlength="10" class="input">


<input type="submit" value="регистрация">
<?php /*?> <?php */?>
 </fieldset>
 <span class="error" ><?php echo $_SESSION['errors2']['name']?></span>
 <span class="error" ><?php echo $_SESSION['errors2']['password']?></span> 
 <span class="error" ><?php echo $_SESSION['errors2']['photo']?></span> 
 <span class="error" ><?php echo $_SESSION['errors2']['email']?></span> 
 <span class="error" ><?php echo $_SESSION['errors2']['sity1']?></span>
</form>
</div>
</div>
</div>

<div class="clear">
</div>
</div>

</body>
</html>
