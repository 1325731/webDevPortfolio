<?php
error_reporting(E_ALL ^ E_DEPRECATED);
define("DB_NAME", "pizzaproj");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_HOST", "localhost");
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link)
	die("Could not connect: " . mysql_error());
	
$db_selected = mysql_select_db(DB_NAME);
if(!$db_selected)
	die("Cannot use ".DB_NAME.": ". mysql_error());
// CONNECT.PHP!';

?>