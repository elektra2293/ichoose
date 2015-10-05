<?php

setcookie("yourSity", $_POST['sity'], time()+3600*240);
header('Location:'.$_SERVER['HTTP_REFERER']);
