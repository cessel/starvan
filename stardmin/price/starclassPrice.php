<?
header('Content-type: text/html; charset=utf-8'); 
include_once $_SERVER['DOCUMENT_ROOT']."/lib/includer.php"; // за скрипт "includer" спасибо огромное автору Sergey Novikov <Novikov.Sergey.S 0_0 GMail.Com>
$include = new Includer;
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/errors.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/functions.php");
$include->includeOnce($_SERVER['DOCUMENT_ROOT']."/lib/a.charset.php");
errors('on');









?>