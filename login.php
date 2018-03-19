<?php  
	require 'connect.php';

	
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="POST" action="verifylogin.php">
		<label>Username</label><input type="text" name="userName"><br>
		<label>Password</label><input type="password" name="password"><br>
		<input type="submit" name="command" value="loginAttempt"><br>
		<a href="signup.php">Signup</a>

	</form>
</body>
</html>