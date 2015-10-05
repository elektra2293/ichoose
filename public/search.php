<?php		
	$street_id=$_POST['street'];
	$metro_id=$_POST['metro'];

	if(empty($street_id)){ if(!empty($metro_id)){$company = mysql_query("select *  from company where ID_Metro='$metro_id' and ID_Category=$id_cat" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());}	else {$company = mysql_query("select *  from company JOIN street ON company.ID_Street=street.ID_Street JOIN sity ON street.ID_Sity=sity.ID_Sity WHERE sity.ID_Sity=$sity and ID_Category=$id_cat" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());}
		}
	else {$company = mysql_query("select *  from company where ID_Street='$street_id' and ID_Category=$id_cat" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());}
		$companies= mysql_fetch_array($company);
		do{
		$raiting = mysql_query("select sum(number) as total_raiting from raiting WHERE id_company='".$companies[ID_Company]."'" , 		$connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$raitings= mysql_fetch_array($raiting);
		$rating = $raitings['total_raiting'];
		
		$count_raiting = mysql_query("select COUNT(number) as count_raiting from raiting WHERE id_company='".$companies[ID_Company]."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$count_raitings= mysql_fetch_array($count_raiting);
		$count = $count_raitings['count_raiting'];
	if ($count!=0)
		{$total_raiting=$rating/$count;}
	else{$total_raiting=0;}
		
		$client= mysql_query("select * from clients WHERE emaill='".$_SESSION['login']['email']."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$clients=mysql_fetch_array($client);
		echo'
		<div class="company">'; 
		if(empty($clients)){echo'<a href="company_for_guest.php?id_comp='.$companies['ID_Company'].'">'.$companies['Company_Name'].'</a>';}
		else{
		echo'<a href="company.php?id_comp='.$companies['ID_Company'].'">'.$companies['Company_Name'].'</a>';}
		 	echo'<div class="rating_2">
                <input type="hidden" name="val" value="'.$total_raiting.'"/>
                <input type="hidden" name="votes" value="'.$count.'"/>    
    		 </div>	
			 <div class="photo"><img src="images/company_avatar/'.$companies['main_photo'].'" width="100" height="auto" alt="name" /></div>
	<div class="info" > <p> <label> Сайт:</label><a href="'.$companies['Site'].'">'.$companies["Site"].'</a></p>
	 <p> Телефон: '.$companies["Phone"].'</p>';
	 $street = mysql_query("select * from street WHERE id_street='".$companies['ID_Street']."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
		$streets= mysql_fetch_array($street);
	 echo '<p> Адрес:'.$streets["Name_Street"].' '.$companies["house"].'</p></div>
	 </div>';}
	 while($companies= mysql_fetch_array($company));

		

/*	 $user=mysql_query("select * from clients WHERE emaill='".$_SESSION['login']['email']."'" , $connect_to_db)
		or die('Неверный запрос: ' . mysql_error());
	$users=mysql_fetch_array($user);
	$user_id=$users['id_client'];

	if(empty($user_id)){}
		else
		{
			}*/
?>