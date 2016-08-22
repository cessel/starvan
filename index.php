<?
session_start();
header('Content-type: text/html; charset=utf-8'); 
include_once $_SERVER['DOCUMENT_ROOT']."/lib/includer.php"; // за скрипт "includer" спасибо огромное автору Sergey Novikov <Novikov.Sergey.S 0_0 GMail.Com>
$include = new Includer;
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/errors.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/functions.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/nokogiri.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/a.charset.php");
errors('on');
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/settings.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/dbconnect.php");
@$content=$_GET['content'];
if(!isset($cont)){$cont='main';}
if($content!='stardmin')
	{$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/theme/index.php");}
else
	{$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/stardmin/index.php");}
//test git
?>