<?php session_start() ?>
<div class="private_office" >
<p> Здравствуйте, <?php echo $_SESSION['login']['email']; 
$qr_result= mysql_query("select * from clients where emaill like '".$_SESSION['login']['email']."'")
or die(mysql_error());
$qr_results=mysql_fetch_array($qr_result); ?>  </p>
<p><?php
if (!empty($qr_results)){	 
echo "<a href='private_office_client.php'> Личный кабинет</a>";}
else
{echo "<a href='private_office_company.php'> Личный кабинет</a>";}
 ?></p>
<p><a href="exit.php"> Выход</a></p>
</div>
