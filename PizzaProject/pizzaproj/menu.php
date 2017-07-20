<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title> Koma Pizzaria - Menu</title>
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
		<br style="clear: left;"/>
		<div id="prices">
			<div id="pizzaprice">
				<h2>PIZZA</h2>
				<table class="menutables">
					<tr><td>All Dressed</td><td>Small</td><td>8.99</td></tr>
					<tr><td></td><td>Medium</td><td>15.99</td></tr>
					<tr><td></td><td>Large</td><td>24.99</td></tr>
					<tr><td>Hawaiian</td><td>Small</td><td>7.99</td></tr>
					<tr><td></td><td>Medium</td><td>13.99</td></tr>
					<tr><td></td><td>Large</td><td>19.99</td></tr>
					<tr><td>Mexican</td><td>Small</td><td>7.99</td></tr>
					<tr><td></td><td>Medium</td><td>14.99</td></tr>
					<tr><td></td><td>Large</td><td>21.99</td></tr>
					<tr><td>Vegetarian</td><td>Small</td><td>6.99</td></tr>
					<tr><td></td><td>Medium</td><td>12.99</td></tr>
					<tr><td></td><td>Large</td><td>18.99</td></tr>
				</table>
			</div>
			<div id="pastaprice">
				<h2>PASTA</h2>
				<table class="menutables">
					<tr><td>Choice of pasta</td><td>Spaghetti, Rigatoni, Lasagna</td><td>$8.95</td></tr>
					<tr><td>Choice of sauce</td><td>Tomato, Rosé, Meat sauce</td><td>$0.00</td></tr>
					<tr><td>Additional Topping</td><td>Large</td><td>add $0.50</td></tr>
					<tr><td></td><td>Peperoni</td><td>add $0.50</td></tr>
					<tr><td></td><td>Mushroom</td><td>add $0.50</td></tr>
					<tr><td></td><td>Meat Balls</td><td>add $1.00</td></tr>
					<tr><td></td><td>Italian Sausage</td><td>add $1.50</td></tr>
					<tr><td></td><td>Italian and M-Balls</td><td>add $2.00</td></tr>
					<tr><td></td><td>Koma Special</td><td>add $0.75</td></tr>
				</table>	
				<p>Koma special is Peperoni and Mushrooms</p>
			</div>
		</div>
		<div id="menus">
			<h2>Click to Enlargen Menus</h2>
			<span style="float: left;">
			<p>Pizza Menu or Take Out</p>
			<a target="_blank" href="img/menu1.jpg"><img src="img/menu1.jpg" class="menupics"/></a>
			</span>
			<span style="float: right;">
			<p>Pasta Menu or Take Out</p>
			<a target="_blank" href="img/menu2.jpg"><img src="img/menu2.jpg" class="menupics"/></a>
			</span>
		</div>
		<br style="clear: left;"/>
	</div>
</body>
</html>
