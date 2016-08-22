<?php
include_once $_SERVER['DOCUMENT_ROOT']."/lib/includer.php"; // за скрипт "includer" спасибо огромное автору Sergey Novikov <Novikov.Sergey.S 0_0 GMail.Com>
$include = new Includer;
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php");
$login=mysql_escape_string($_POST['name']);
$sql="SELECT * FROM `sv_users` WHERE `name`='".$login."'";
$result = sql($sql);

$login_db_info = $result->fetch_row();

$pass=$_POST['pass'];
if (($login_db_info[2]===$pass)&&($pass!=''))
	{
		setcookie ('stardmin_logon' ,'admin');
		echo "Успешный вход";
	}
else
	{
		echo "Не верный пароль";
	}

//
 ?>