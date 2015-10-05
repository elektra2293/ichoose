<?php

include_once 'connect.php';
		$category = $_GET['id'];
		$qr_result = mysql_query("select * from category where subcategory = $category" , $connect_to_db )
		or die(mysql_error());
		$qr_results=mysql_fetch_array($qr_result);
      
		do{
		$id = $qr_results['ID_Category'];
		echo "<option value = '$id'>" . $qr_results['Type_Name'] .'</option>' ;
		} 
		while ($qr_results=mysql_fetch_array($qr_result));
	
?>