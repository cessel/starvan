<?php
include_once $_SERVER['DOCUMENT_ROOT']."/lib/includer.php"; // за скрипт "includer" спасибо огромное автору Sergey Novikov <Novikov.Sergey.S 0_0 GMail.Com>
$include = new Includer;
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/errors.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/functions.php");
errors('on');
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php"); 
// Функция резервного копирования базы данных
backup_database_tables(DB_HOST,DB_USER,DB_PASS,DB_NAME, '*');
?>
