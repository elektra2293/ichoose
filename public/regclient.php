<?php session_start();
		include 'connect.php';	
	$errors=array();
		$_SESSION['errors2'] = $errors;
		$_SESSION['data'] = $_POST;
		$name=$_POST['name'];
		if(empty($name)){ $errors['name']='введите имя';};
		$sername=$_POST['sername'];
		
		$email = $_POST['email'];
		if(empty($email)){ $errors['email']='введите email';}
		else{
		$sql = mysql_query("select * from clients where emaill = '$email'" , $connect_to_db )
		or die(mysql_error());
		$qr_results=mysql_fetch_array($sql);
		if(!empty($qr_results)){ $errors['email']='такой email существует';};}
		
		$password= $_POST['password'];
		if(empty($password)){ $errors['password']='введите пароль';};
		
		$sity=$_POST['sity1'];
		if(empty($sity)){ $errors['sity1']='выберите город';}
		
		$photo=$_FILES['photo']['name'];
		
				if (!empty($errors))
		{$_SESSION['errors2'] = $errors;

			header('Location: registr.php');
			
			}
		else
		{
		  if (empty($photo)) 
		{$photo= 'nophoto.jpg';}
		else{	  
		$uploadfile = "images/client_avatar/".$_FILES['photo']['name'];
  		move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);}
		$sql = mysql_query('INSERT INTO clients (Client_Name, Client_Sername, ID_Sity, Parol, avatar, emaill) VALUES( "'.$name.'" ,"'.$sername.'", "'.$sity.'" , "'.$password.'" ,  "'.$photo.'" , "'.$email.'")', $connect_to_db)
		or die(mysql_error());	
	$user=array();
			$user['email']=$email;
			$user['password']=$password;
		$_SESSION['login']=$user;
		header('Location: index.php');
		}
		?>