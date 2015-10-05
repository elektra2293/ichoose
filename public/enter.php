<?php 
session_start();
 $email=$_POST['email'];
 $parol=$_POST['parol'];
  include ("connect.php");
 $qr_result = mysql_query("select * from company where email like '$email' and Com_Parol like '$parol'" , $connect_to_db )
		or die(mysql_error());
		$qr_results=mysql_fetch_array($qr_result);
		
		if (empty($qr_results))
			{ $qr_result = mysql_query("select * from clients where emaill like '$email' and parol like '$parol'" , $connect_to_db )
			or die(mysql_error());
			$qr_results=mysql_fetch_array($qr_result);
			
			if (empty($qr_results))
				{ $_SESSION['login']=1;
				header('Location: bad_enter.php');
				}
					else{
						$user=array();
						$user['email']= $email;
						$user['parol']=$parol;
						$_SESSION['login'] = $user;
						header('Location: index.php');
						}
			}
		else{
		$qr_sity= mysql_query("select * from street where ID_Street='".$qr_results['ID_Street']."'" , $connect_to_db )
		or die(mysql_error());
		$qr_sitys=mysql_fetch_array($qr_sity);
		$user=array();
		$user['email']= $email;
		$user['parol']=$parol;
		$_SESSION['login'] = $user;
		setcookie("yourSity", $qr_sitys['ID_Sity'], time()+3600*240);
		header('Location: index.php');
		}
		

 ?>



