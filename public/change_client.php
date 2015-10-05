<?php session_start();
		include 'connect.php';
		$email = $_SESSION['login']['email'];
		$sity = $_POST['sity'];
		$photo=$_FILES['photo']['name'];
		$uploadfile = "images/client_avatar/".$_FILES['photo']['name'];
  		move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
		if (empty($photo)){$sql = mysql_query('UPDATE clients SET ID_Sity = "'.$sity.'" WHERE emaill="'.$email.'"', $connect_to_db)
		or die(mysql_error());}
		else{
	$sql = mysql_query('UPDATE clients SET ID_Sity = "'.$sity.'", avatar="'.$photo.'" WHERE emaill="'.$email.'"', $connect_to_db)
		or die(mysql_error());}	
			$user=array();
			$user['email']=$email;
			$user['password']=$password;
		$_SESSION['login']=$user;
		setcookie("yourSity", $_POST['sity'], time()+3600*240);
		header('Location: private_office_client.php');
		exit;
		?>