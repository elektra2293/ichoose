<?php 
    // определяем начальные данные
    $db_host = '88.198.10.230';
    $db_name = 'ichoose';
    $db_username = 'elektra';
    $db_pass = 'POaKHflU';

    // соединяемся с сервером базы данных
    $connect_to_db = mysql_connect($db_host, $db_username, $db_pass)
		or die("Could not connect: " . mysql_error());

    // подключаемся к базе данных
    mysql_select_db($db_name, $connect_to_db)
		or die("Could not select DB: " . mysql_error());
		mysql_set_charset( 'utf8' );
?>