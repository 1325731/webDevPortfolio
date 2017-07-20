<?php
include_once("/home/ubuntu/workspace/smarty/libs/Smarty.class.php");
// create object
$language = "english";
$Page = "chatroom";
$Picture = "no";

$smarty = new Smarty;

if ($_GET[lang] == "english" || $_GET[lang] == "french") {
    $language = $_GET[lang];
}


if(file_exists("log.html") && filesize("log.html") > 0){
	$handle = fopen("log.html", "r");
	$contents = fread($handle, filesize("log.html"));
	fclose($handle);
	
    $smarty->assign('ChatStuff', $contents);
}

require_once("dictionary.php");
require_once("template.php");
$smarty->display('Template/chat_room.tpl');
?>