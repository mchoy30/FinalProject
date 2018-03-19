<?php 
	session_start();
	$user = $_SESSION["loggedInUser"];



	if(is_null($user))
	{
		header("Location: login.php");
	}
	if(isset($_POST['logout']))
	{
		session_destroy();
		header("Location: login.php");
	}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>welcome <?php '{$_SESSION["loggedInUser"]}' ?></title>
</head>
<body>
	<?php echo "welcome! ".$user ?>
	<form method="post">
	<button type="submit" name="logout">Logout</button>

	</form>
</body>
</html>