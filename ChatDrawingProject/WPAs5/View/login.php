<?php
include_once("/home/ubuntu/workspace/smarty/libs/Smarty.class.php");
// create object
$language = "english";
$Page = "login";
$Picture = "jo";

$smarty = new Smarty;

if ($_GET[lang] == "english" || $_GET[lang] == "french") {
    $language = $_GET[lang];
}

require_once("dictionary.php");
require_once("template.php");
$smarty->display('Template/login.tpl');
?>