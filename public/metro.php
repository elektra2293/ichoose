<?php

		include 'connect.php';
	
		$sity = $_GET['id'];
		$qr_result = mysql_query("select * from metro where ID_Sity = $sity" , $connect_to_db )
		or die(mysql_error());
		
		$qr_results=mysql_fetch_array($qr_result);
	if (!empty($qr_results)){
		echo '<label for="metro" class="question"> Станция метро: </label>
 		<select id="metro" name = "metro" type="text"  class="select">';
		do{
			$id = $qr_results['ID_Metro'];
		echo "<option value='$id'>" . $qr_results['Name_Metro'] .'</option>' ;
		} 
		while ($qr_results=mysql_fetch_array($qr_result));
		echo '</select>';}
	
?>