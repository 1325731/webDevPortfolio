<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title> Koma Pizzaria - Login / Register</title>
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
			<a href="index.php">Home</a>
			<a href="menu.php">Menu</a>
			<a href="login.php">Log In</a>
		</div>
			<a style="float: right" href="french.php">Francais?</a>
	</div>
	<div id="backboard">
		<div id="login">
			<h1>Login</h1>
			<form action="login_submitted.php" method="POST">
				<p><label>Username&nbsp; : </label>
				<input id="username" type="text" name="username" placeholder="username" /></p>			 
				 <p><label>Password&nbsp;&nbsp;&nbsp;&nbsp;:  </label>
				 <input id="password" type="password" name="password" placeholder="password" /></p>			 
				<input id="btnlogin" type="submit" name="submit" value="Login" />
			</form>
		</div>
		<div id="register">
				<h1>Register</h1>
				<form action="register_submitted.php" method="POST">
					<p><label>Username &nbsp;&nbsp;: </label>
					<input id="usernamereg" type="text" name="usernamereg" placeholder="username" /></p>					
					<p><label>E-Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>
					 <input id="email" type="email" name="email" placeholder="email" /></p>				 
					 <p><label>Password&nbsp;&nbsp;&nbsp;&nbsp;: </label>
					 <input id="passwordreg" type="password" name="passwordreg" placeholder="password" /></p>						 		 
					 <p><label>Title&nbsp;&nbsp;&nbsp;: </label> <select name="title">
															  <option value="Mr.">Mr.</option>
															  <option value="Ms.">Ms.</option>
															  <option value="Mrs.">Mrs.</option>
															  <option value="M.">M.</option>
															</select> </p>	
					 <p><label>First Name&nbsp;&nbsp;: </label>
					 <input id="fname" type="fname" name="fname" placeholder="first name" /></p>				  
					 <p><label>Last Name&nbsp;&nbsp;: </label>
					 <input id="lname" type="lname" name="lname" placeholder="last name" /></p>				 
					 <p><label>Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>
					 <input id="address" type="address" name="address" placeholder="address" /></p>				 
					 <p><label>City&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>
					 <input id="city" type="city" name="city" placeholder="city" /></p>						 		 
					 <p><label>Province&nbsp;&nbsp;&nbsp;: </label> <select name="prov">
															  <option value="QC">QC</option>
															</select> </p>				 
					 <p><label>Postal Code&nbsp;: </label>
					 <input id="postal" type="postal" name="postal" placeholder="postal code" /></p>				 
					 <p><label>Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>
					 <input id="phone" type="phone" name="phone" placeholder="phone number" /></p>		
					<input id="btnregister" type="submit" name="submit" value="Register" />
				</form>
		</div>
		<br style="clear: left;"/>
	</div>
</body>
</html>
