<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title> Koma Pizzaria - Order</title>
<link rel="stylesheet" target=_blank href="src/pizza.css">
<script src="src/jquery-2.1.4.js"></script>
<script>
	$(document).ready(function() { 
	});
</script>
</head>
<body>
	<div id="menu">
		<img src="img/logo.png" id="logo"/><br><?php 
		if (isset($_SESSION['logged_user']))
			echo '<p id="loginstring">Welcome, ', $_SESSION['logged_user'], '.</p>'; ?>
		<div id="links">
			<a href="index.php">Home</a>
			<a href="logout.php">Log Out</a>
		</div>
			<a style="float: right" href="french.php">Francais?</a>
	</div>
	<div id="backboard">
		<br style="clear: left;"/>
		<div id="ordering">
		<h1> Ordering </h1>
				<form id="orderform" action="" method="POST">
					<p><label>All Dressed Small ($8.99): </label><input type="number" name="ads" placeholder="0"/></p>		
					<p><label>All Dressed Medium ($15.99): </label><input type="number" name="adm" placeholder="0"/></p>	
					<p><label>All Dressed Large ($24.99): </label><input type="number" name="adl" placeholder="0"/></p>	
					<p><label>Hawaiian Small ($7.99): </label><input type="number" name="hs" placeholder="0"/></p>		
					<p><label>Hawaiian Medium ($13.99): </label><input type="number" name="hm" placeholder="0"/></p>	
					<p><label>Hawaiian Large ($19.99): </label><input type="number" name="hl" placeholder="0"/></p>
					<p><label>Mexican Small ($7.99): </label><input type="number" name="ms" placeholder="0"/></p>		
					<p><label>Mexican Medium ($14.99): </label><input type="number" name="mm" placeholder="0"/></p>	
					<p><label>Mexican Large ($21.99): </label><input type="number" name="ml" placeholder="0"/></p>	
					<p><label>Vegetarian Small ($6.99): </label><input type="number" name="vs" placeholder="0"/></p>		
					<p><label>Vegetarian Medium ($12.99): </label><input type="number" name="vm" placeholder="0"/></p>	
					<p><label>Vegetarian Large ($18.99): </label><input type="number" name="vl" placeholder="0"/></p>	
					<input id="atc" type="submit" name="submit" value="Add to Cart" />
				</form>
		</div>
		<br style="clear: left;"/>
	</div>
</body>
</html>