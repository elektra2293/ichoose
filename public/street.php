<?php

		include 'connect.php';
		$sity = $_GET['id'];
		$qr_result = mysql_query("select * from street where ID_Sity = $sity" , $connect_to_db )
		or die(mysql_error());
		echo $qr_result;
		$qr_results=mysql_fetch_array($qr_result);
	
      
		do{
		$id = $qr_results['ID_Street'];	
		echo "<option value ='$id'>" . $qr_results['Name_Street'] .'</option>' ;
		} 
		while ($qr_results=mysql_fetch_array($qr_result));
	
?>