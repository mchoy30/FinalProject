<?php 
		require 'connect.php';
		/// USed at login page
print_r($_POST);
		function verifyLogin()
		{
			//require_once 'connect.php';
			$userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
			$password = $_POST['password'];
			$db = new PDO(DB_DSN, DB_USER, DB_PASS);
			$query = "SELECT Password FROM Users WHERE UserName = :userName;";
	      	$statement = $db->prepare($query); 
	      	$bind_values = ['userName' => $userName];
	      	$statement->execute($bind_values);

	      	$passwordAttempt = $statement->fetch();

	      	return $passwordAttempt[0];
		}


		function StartSessionForUser()
		{
			//require_once 'connect.php';
			$userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
			$db = new PDO(DB_DSN, DB_USER, DB_PASS);
			$query = "SELECT userName FROM Users WHERE UserName = :userName;";
	      	$statement = $db->prepare($query); 
	      	$bind_values = ['userName' => $userName];
	      	$statement->execute($bind_values);

	      	$username = $statement->fetch();

	      	session_start();
	      	$_SESSION['loggedInUser'] = $username[0];
	      	
		}

		
		if($_POST["command"] == "loginAttempt")
		{

			$attemptedPassword = $_POST["password"];
			$password = verifyLogin();

				if (password_verify((string)$attemptedPassword, (string)$password)) {
   					StartSessionForUser();
   					header("Location: index.php");
				} else {
    			echo 'Invalid password.';
    			echo "<a href='login.php'>Try again</a>";
				}
		}

 ?>