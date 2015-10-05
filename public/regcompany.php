<?php 	
		session_start();
		include 'connect.php';
		$errors=array();
		$_SESSION['errors'] = $errors;		
		$name=$_POST['name'];
		if(empty($name)){ $errors['name']='введите название';};
		
		$email = $_POST['email'];
		if(empty($email)){ $errors['email']='введите email';}
		else{
			$sql = mysql_query("select * from company where email = '$email'" , $connect_to_db)
			or die(mysql_error());
			$sqls =mysql_fetch_array($sql);
			if(!empty($sqls)){ $errors['email']='такой email существует';}}
			
	
		$site = $_POST['site'];
		$phone = $_POST['phone'];
		
		$street = $_POST['street'];
		if(empty($street)){ $errors['street']='выберите улицу';};
		
		$metro = $_POST['metro'];
		
		$password= $_POST['password'];
		if(empty($password)){ $errors['password']='введите пароль';};
		
		$category = $_POST['subcat'];
		if(empty($category)){ $errors['subcat']='выберите категорию';};
		
		$photo=$_FILES['photo']['name'];
		$house = $_POST['house'];
		if (!empty($errors))
		{$_SESSION['errors'] = $errors;
			header('Location: registr.php');}
		else
		{ if (empty($photo)) 
		{$photo= 'nophoto.jpg';}
		else{	  
		$uploadfile = "images/company_avatar/".$_FILES['photo']['name'];
  		move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);}
		if (empty($metro))
		{$sql = mysql_query('INSERT INTO company (Company_Name, ID_Category, ID_Street, house, Com_Parol, Site, Phone, email, main_photo) VALUES( "'.$name.'" , "'.$category.'" , "'.$street.'" , "'.$house.'" ,"'.$password.'" , "'.	$site.'" , "'.$phone.'" , "'.$email.'" , "'.$photo.'")', $connect_to_db)
		or die(mysql_error());}
		else
		{$sql = mysql_query('INSERT INTO company (Company_Name, ID_Category, ID_Metro, ID_Street, house, Com_Parol, Site, Phone, email,main_photo) VALUES( "'.$name.'" , "'.$category.'" , "'.$metro.'", "'.$street.'" , "'.$house.'", "'.$password.'" , "'.	$site.'" , "'.$phone.'", "'.$email.'","'.$photo.'")', $connect_to_db)
		or die(mysql_error());	
			;}
			$user=array();
			$user['email']=$email;
			$user['password']=$password;
		$_SESSION['login']=$user;
		header('Location: index.php');}
		exit;
		?>