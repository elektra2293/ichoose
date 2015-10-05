<?php session_start();
		include 'connect.php';
		$email = $_SESSION['login']['email'];
		$site = $_POST['site'];
		$phone = $_POST['phone'];
		$metro = $_POST['metro'];
		$street=$_POST['street'];
		$house=$_POST['house'];
		$inf=$_POST['inf'];
		$photo=$_FILES['photo']['name'];
		
		$uploadfile = "images/company_photo/".$_FILES['photo']['name'];
  		move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
		if (empty($metro))
		{$sql = mysql_query('UPDATE company SET Site = "'.$site.'", Phone="'.$phone.'",ID_Street="'.$street.'", house="'.$house.'", information="'.$inf.'" WHERE email="'.$email.'"', $connect_to_db)
		or die(mysql_error());}
		else
		{$sql = mysql_query('UPDATE company SET Site = "'.$site.'", Phone="'.$phone.'", ID_Metro="'.$metro.'",ID_Street="'.$street.'", house="'.$house.'", information="'.$inf.'" WHERE email="'.$email.'"', $connect_to_db)
		or die(mysql_error());	
			;}
			$qr_result= mysql_query("select * from company where email like '$email'" , $connect_to_db )
			
or die(mysql_error()); 
$qr_results=mysql_fetch_array($qr_result);
if (empty($photo)){}
else{
		$sql=mysql_query('INSERT INTO photo (ID_Company, File) VALUES ('.$qr_results["ID_Company"].', "'.$photo.'")');}
			$user=array();
			$user['email']=$email;
			$user['password']=$password;
		$_SESSION['login']=$user;
		header('Location: private_office_company.php');
		exit;
		?>