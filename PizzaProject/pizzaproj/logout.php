<link rel="stylesheet" target=_blank href="src/pizza.css">
<link rel="stylesheet" target=_blank href="src/pizzaunformat.css">

<?php
	// Initialize the session.
	// If you are using session_name("something"), don't forget it now!
	session_start();
	session_unset();
	echo '<h1>You logged out successfully.</h1>';
	header("Refresh:3; url=index.php");
?>