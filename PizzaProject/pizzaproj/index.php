<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title> Koma Pizzaria - Home</title>
<link rel="stylesheet" target=_blank href="src/pizza.css">
<script src="src/jquery-2.1.4.js"></script>
<script>
	$(document).ready(function() {
	});
</script>
</head>
<body>
	<div id="menu">
		<img src="img/logo.png" id="logo"/><br>
		<div id="links">
		<?php 
		if (isset($_SESSION['logged_user']))
			echo '<p id="loginstring">Welcome, ', $_SESSION['logged_user'], '.</p>'; ?>
			<a href="index.php">Home</a>
			<a href="menu.php">Menu</a>
			<?php 
				if (isset($_SESSION['logged_user'])) {
					echo '<a href="order.php">Order</a> '; 
					echo ' <a href="logout.php">Log Out</a>'; 					
				}
				else
					echo ' <a href="login.php">Log In</a>'; 		
				?>
		</div>
			<a style="float: right" href="french.php">Francais?</a>
	</div>
	<div id="backboard">
		<div id="hours">
				<h2>Delivery</h2>
				<p>Sunday, Monday, Tuesday, Wednesday, Thursday</p>
				<h3>11h to 2h</h3>
				<p>Friday, Saturday</p>
				<h3>11h to 4h</h3>
				<p><u>Opening Hours</u></p>
				<p>Monday to Thursday: 6h00 to 2h00</p>
				<p>Friday & Satuday: 6h00 to 4h00</p>
				<p>Sunday: 8h00 to 1h00</p>
				<p><u>Delivery Hours</u></p>
				<p>Monday to Thursday: 11h00 to 2h00</p>
				<p>Friday & Satuday: 11h00 to 4h00</p>
				<p>Sunday: 11h00 to 23h00</p>
				<h2>Contact</h2>
				<h3>Name</h3>Koma Italiano
				<h3>Phone Number</h3>450-555-1212
				<h3>Email</h3>komaitaliano@thegoogle.com
				<h3>Location</h3><a target="_blank" href="https://www.google.ca/maps/place/150+Rue+Sainte-Anne,+Sainte-Anne-de-Bellevue,+QC+H9X+1M4/@45.4041454,-73.9545149,18z/data=!3m1!4b1!4m2!3m1!1s0x4cc938471c716dd7:0x928ca2655c36d803">
					150 Rue Sainte-Anne, <br>
					Sainte-Anne-de-Bellevue, <br>
					QC H9X 1M4</a>
		</div>
		<div id="pics">
			<img src="img/pizza1.jpg" class="display"/><br>
			<img src="img/restaurant1.jpg" class="display"/>
		</div>
		<br style="clear: left;"/>
	</div>
</body>
</html>
