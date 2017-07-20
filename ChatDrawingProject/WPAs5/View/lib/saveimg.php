<?php
    $dir = __DIR__;
    $img = $_POST;
    
	// requires php5
	define('UPLOAD_DIR', '../../cache/');
	$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . 'canvas' . '.png';
	$success = file_put_contents($file, $data);
	// php flock / unlock
	print $success ? $file : 'Unable to save the file.';
?>
