<?php
	 
$raiting = mysql_query("select sum(number) as total_raiting from raiting WHERE id_company='".$companies['ID_Company']."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$raitings= mysql_fetch_array($raiting);
		$rating = $raitings['total_raiting'];
		$count_raiting = mysql_query("select COUNT(number) as count_raiting from raiting WHERE id_company='".$companies['ID_Company']."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$count_raitings= mysql_fetch_array($count_raiting);
		$count = $count_raitings['count_raiting'];
	if ($count!=0)
		{$total_raiting=round($rating/$count,1);}
	else{$total_raiting=0;}
	 
	 $user_score=$_COOKIE['score'];
	
	  $clientid=mysql_query("select * from clients WHERE emaill='".$_SESSION['login']['email']."'" , $connect_to_db)
	 or die('Неверный запрос: ' . mysql_error());
	 $clientsid=mysql_fetch_array($clientid);


	 $vote=mysql_query("select * from raiting WHERE ID_Company='".$id_comp."' and ID_Client='".$clientsid['id_client']."'" , $connect_to_db)
	 or die('Неверный запрос: ' . mysql_error());
	 $votes=mysql_fetch_array($vote);


	 if(empty($votes))
	 {
		  $sql = mysql_query('INSERT INTO raiting (number, id_company, id_client) VALUES ("'.$user_score.'", "'.$id_comp.'" ,"'.$clientsid['id_client'].'")', $connect_to_db);}
	 else
	 {
		$sql = mysql_query('UPDATE raiting SET number = "'.$user_score.'" WHERE id_raiting="'.$votes['id_raiting'].'"', $connect_to_db)
		or die(mysql_error());
		 }
	 ?>