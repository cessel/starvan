<?
get_header();

if (!isset($_COOKIE['stardmin_logon']))
	{
		get_loginform();
	}
else
	{get_backend();}
























?>