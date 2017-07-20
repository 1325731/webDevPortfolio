<?php
session_start();
echo json_encode(array('user'=>$_SESSION['user']));
?>