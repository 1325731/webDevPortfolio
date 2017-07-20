<link rel="stylesheet" target=_blank href="src/pizza.css">
<link rel="stylesheet" target=_blank href="src/pizzaunformat.css">

<?php
	session_start();
	
	include 'connect.php';

	$username = $_POST['username'];	
	$password = $_POST['password'];	
									
	$sql= "SELECT User, Password FROM login WHERE User = '$username'";
	$result = mysql_query($sql);

	$row = mysql_fetch_array($result);
	
	if($username == '' &&  $password == '')
	{
		echo '<h1>Username and password are blank.</h1>';
		header("Refresh:3; url=login.php");
	}
	else if($username == '')
	{
		echo '<h1>Username is blank.</h1>';
		header("Refresh:3; url=login.php");
	}
	else if($password == '')
	{
		echo '<h1>Password is blank.</h1>';
		header("Refresh:3; url=login.php");
	}
	else if($row["User"] == $username && $row["Password"] == $password)
	{
		$_SESSION['logged_user'] = $username;
		echo '<h1>Welcome, ', $_SESSION['logged_user'],'</h1>';
		header("Refresh:3; url=index.php");
	}
	else
	{
		echo '<h1>Inputs are incorrect.</h1>';
		header("Refresh:3; url=login.php");
	}
?>