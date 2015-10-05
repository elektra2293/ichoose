<?php			
		$raiting = mysql_query("select sum(number) as total_raiting from raiting WHERE id_company='".$companies[ID_Company]."'" , 		$connect_to_db)
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
		
		
		echo'<div class="company"><a href="company.php?id_comp='.$companies['ID_Company'].'">'.$companies['Company_Name'].'</a>
		 	<div class="rating_2">
                <input type="hidden" name="val" value="'.$total_raiting.'"/>
                <input type="hidden" name="votes" value="'.$count.'"/>    
    		 </div>	
			 <div class="photo"><img src="images/company_avatar/'.$companies['main_photo'].'" width="100" height="auto" alt="name" /></div>
	<div class="info" > <p> Сайт: <a href="'.$companies['Site'].'">'.$companies["Site"].'</a></p>
	 <p> Телефон: '.$companies["Phone"].'</p>';
	 $street = mysql_query("select * from street WHERE id_street='".$companies[ID_Street]."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$streets= mysql_fetch_array($street);
	 echo '<p> Адрес:'.$streets["Name_Street"].' '.$companies["house"].'</p></div>
	 </div>';
	 

/*	 $user=mysql_query("select * from clients WHERE emaill='".$_SESSION['login']['email']."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
	$users=mysql_fetch_array($user);
	$user_id=$users['id_client'];

	if(empty($user_id)){}
		else
		{
			 $rating_exist=mysql_query("select * from raiting WHERE ID_Company='".$companies[ID_Company]."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
	
	 $user_score=$_COOKIE['score'];

	 $count=$count+1;

	 $rating=$rating+$user_score;

	 $total_raiting=$rating/$count;

	 echo round($total_raiting, 1);
	 $sql = mysql_query('INSERT INTO raiting (number, id_company, id_client) VALUES ("'.$total_raiting.'", "'.$companies[ID_Company].'","'.$user_id.'")');}*/
?>