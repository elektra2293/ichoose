
  <?php
  $subcategory = $_GET['id'];
  $sity=$_COOKIE['yourSity'];
  $id_cat= $_GET['id_cat'];
  $id_street= $_GET['id_street'];
  if (is_null($subcategory) and is_null($id_cat))
 { echo'<a href="index.php?id=22" id="cat1">Животные и растения</a>
  <a href="index.php?id=23" id="cat2">Транспорт</a>
  <a href="index.php?id=24" id="cat3">Рестораны и кафе</a>
  <a href="index.php?id=25" class="link1" id="cat4">Для дома</a>
  <a href="index.php?id=26" class="link1 line2" id="cat5">Все для детей</a>
  <a href="index.php?id=27" class="line2" id="cat6"> финансы и деловые услуги</a>
  <a href="index.php?id=28" class="line2" id="cat7">Туризм и спорт</a>
  <a href="index.php?id=31" class="line3" id="cat8">Одежда и обувь</a>
  <a href="index.php?id=30" class="line3" id="cat9">Развлечения</a>
  <a href="index.php?id=29" class="line3" id="cat10" >Красота и здоровье</a>';}
  else
  { if(is_null($id_cat)){
	  	include('connect.php');
		$category = mysql_query("select * from category where subcategory = $subcategory" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$categories = mysql_fetch_array($category);
		echo'<div id="categ">';
		
		do
		{	
	$company = mysql_query("select COUNT(Company_Name) AS count_com  from company JOIN street ON company.ID_Street=street.ID_Street JOIN sity ON street.ID_Sity=sity.ID_Sity WHERE sity.ID_Sity=$sity and ID_Category='$categories[ID_Category]'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$companies= mysql_fetch_array($company);
if($companies['count_com']==0)
		{echo ' <a href="#" class="subcat">' . $categories['Type_Name']. '('. $companies['count_com'] .')</a>';} 
		else {echo ' <a href="index.php?id_cat='.$categories['ID_Category'].'" class="subcat">' . $categories['Type_Name']. '('. $companies['count_com'] .')</a>';} 
		
		;}
		while ($categories = mysql_fetch_array($category)) ;
		echo '</div>';}
	else
	{
				
		echo'<div id="search">
		<form action="index.php?id_cat='.$id_cat.'" id="search_street" method="post">';
		$street_in_sity = mysql_query("select * from street WHERE Id_Sity='".$_COOKIE["yourSity"]."'ORDER BY Name_Street" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$streets_in_sity= mysql_fetch_array($street_in_sity);
		 echo '<label for="street">Поиск по улице</label><select id="street" name="street" class="select">';
		echo '<option value = 0>-выберите улицу-</option>';
		do{
		$id = $streets_in_sity['ID_Street'];
		echo "<option value='$id'>" . $streets_in_sity['Name_Street'] .'</option>' ;
		} 
		while ($streets_in_sity= mysql_fetch_array($street_in_sity)) ;
		echo'</select>
		<input type="submit" value=""></form>';
		
		
		
		if($_COOKIE['yourSity']==1 or $_COOKIE['yourSity']==2){
		echo'<form action="index.php?id_cat='.$id_cat.'" id="search_metro" method="POST">';
		$metro_in_sity = mysql_query("select * from metro WHERE Id_Sity='".$_COOKIE["yourSity"]."'ORDER BY Name_Metro" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$metros_in_sity= mysql_fetch_array($metro_in_sity);
		 echo '<label for="street">Поиск по метро</label><select id="metro" name="metro" class="select">';
		echo '<option value = 0>-выберите метро-</option>';
		do{
		$id = $metros_in_sity['ID_Metro'];
		echo "<option value='$id'>" . $metros_in_sity['Name_Metro'] .'</option>' ;
		} 
		while ($metros_in_sity= mysql_fetch_array($metro_in_sity)) ;
		echo'</select>
		<input type="submit" value=""></form>';}
		echo "<div class='clear'></div></div>";

include('search.php');
}
		
	;}	
	
  ?>
