<?php
session_start();
if(isset($_SESSION['user'])){
	$text = $_POST['text'];
	
	$fp = fopen("log.html", 'a');
	if($text == '/draw') {
		fwrite($fp, "<ul>".'('.$_POST['today'].')'." ".$_SESSION['user'].": There's an invitation to the chat!: <a onclick=\"openthing()\">Click here to draw</a></ul>");
		
	} else {
		fwrite($fp, "<ul>".'('.$_POST['today'].')'." ".$_SESSION['user'].": ".stripslashes(htmlspecialchars($text))."</ul>");
	}
	fclose($fp);
}
?>