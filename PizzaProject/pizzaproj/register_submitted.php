<link rel="stylesheet" target=_blank href="src/pizza.css">
<link rel="stylesheet" target=_blank href="src/pizzaunformat.css">

<?php
	session_start();
	
	include 'connect.php';

	$username = $_POST['usernamereg'];	
	$email = $_POST['email'];
	$password = $_POST['passwordreg'];
	$title = $_POST['title'];
	$fname = $_POST['fname'];	
	$lname = $_POST['lname'];	
	$address = $_POST['address'];	
	$city = $_POST['city'];	
	$prov = $_POST['prov'];	
	$postal = $_POST['postal'];	
	$phone = $_POST['phone'];
	
	$noerror = true;
	
	if($username == '' || strlen($username) >= 25) {
		echo '<h1>Username may be blank, greater than 25 or already in use.</h1>';	
		$noerror = false;
	}
	
	if($email == '' ||  strlen($email) >= 30 || !filter_var($email, FILTER_VALIDATE_EMAIL))  {
		echo '<h1>Email may be blank, invalid email format, or greater than 20.</h1>';	
		$noerror = false;
	}
	
	if($password == '' || (strlen($password) >= 25 || strlen($password) <= 4)) {
		echo '<h1>Password may be blank, less than 4, or greater than 25.</h1>';	
		$noerror = false;
	}
	
	if($fname == '' || strlen($fname) >= 20) {
		echo '<h1>First Name may be blank, contains a number or a special character, or greater than 20.</h1>';	
		$noerror = false;
	}
	
	if($lname == '' || strlen($lname) >= 20) {
		echo '<h1>Last Name may be blank, contains a number or a special character, or greater than 20.</h1>';	
		$noerror = false;
	}
	
	if($address == '' || strlen($address) >= 30) {
		echo '<h1>Address may be blank or greater than 30.</h1>';	
		$noerror = false;
	}
	
	if($city == '' || strlen($city) >= 20) {
		echo '<h1>City may be blank or greater than 25.</h1>';	
		$noerror = false;
	}
	
	if(strlen($postal) != 7) {
		echo '<h1>Postal is not 7 characters. (Don\'t forget dashes)</h1>';	
		$noerror = false;
	}
		
	if($phone == '' || strlen($phone) != 12) {
		echo '<h1>Phone may be blank or not 12 characters. (Don\'t forget dashes)</h1>';		
		$noerror = false;
	}
	
	if($noerror)
	{
		$_SESSION['logged_user'] = $username;
		mysql_query("INSERT INTO `login` (User, Title, FName, LName, Address, City, Prov, Postal, Email, Phone, Password) VALUES ('$username', '$title', '$fname', '$lname', '$address', '$city', '$prov', '$postal', '$email', '$phone', '$password')");
		echo '<h1>You\'ve sucessfully registered!</h1>';
		header("Refresh:3; url=index.php");
	}
	else
		header("Refresh:5; url=login.php");
?>