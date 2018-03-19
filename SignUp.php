<?php 
	include_once 'connect.php';
	session_start();
    
	function valid_username()
	{
		return filter_input(INPUT_POST, 'userName',FILTER_SANITIZE_SPECIAL_CHARS);
	}

	function valid_password(){


		$password1 = $_POST["password1"];
		$password2 = $_POST['password2'];
		
		if($password1 === $password2 && !is_null($password1)){
			return $password1;
		}
		return false;
	}

	function valid_first_name(){
		return filter_input(INPUT_POST, 'fname',FILTER_SANITIZE_SPECIAL_CHARS);
	}

	function valid_lastname(){
		return filter_input(INPUT_POST, 'lname',FILTER_SANITIZE_SPECIAL_CHARS);
	}

	function valid_email(){
		return filter_input(INPUT_POST, 'Email',FILTER_VALIDATE_EMAIL);
	}


	function valid_captcha_attempt(){
		return filter_input(INPUT_POST, 'image',FILTER_SANITIZE_SPECIAL_CHARS);
	}


	function check_for_existing_email(){

			$checkEmail = valid_email();
			$db = new PDO(DB_DSN, DB_USER, DB_PASS); // added to fix 
			$query = "SELECT EmailAddress FROM Users WHERE EmailAddress = :email;";
	      	$statement = $db->prepare($query); 
	      	$bind_values = ['email' => $checkEmail];
	      	$statement->execute($bind_values);

	      	$email = $statement->fetch();

	      	if(!$email)
	      	{
	      		return true;
	      	}
	      		return false;
	}	

	function check_existing_username(){
			include_once 'connect.php';

			$user = valid_username();
			$db = new PDO(DB_DSN, DB_USER, DB_PASS); // added to fix
			$query = "SELECT UserName FROM Users WHERE UserName = :userName;";
	      	$statement = $db->prepare($query); 
	      	$bind_values = ['userName' => $user];
	      	$statement->execute($bind_values);

	      	$checkUser = $statement->fetch();
	      	
	      	if(!$checkUser)
	      	{
	      		return true;
	      	}
	      		return false;
	}



	if($_POST)
	{
		$username = valid_username();
		$matchingPassword = valid_password();
		$checkEmail = valid_email();
		$captcha = valid_captcha_attempt();
		$firstName = valid_first_name();
		$lastName = valid_lastname();


		//$captcha == $_SESSION['Captcha'] && $matchingPassword && 
		if($captcha == $_SESSION['Captcha'] && $matchingPassword && check_for_existing_email() && check_existing_username())
		{
			header("Loctaion: validateUser.php");
		}
		else {
			echo "error ";
		}
	}
			
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	
</head>
<body>

	
		<form method="POST" action="validateUser.php">
		<!-- <form method="POST" action="<?php //echo $_SERVER['PHP_SELF']; ?>"> -->
		<legend>Signup</legend>
		<label>Enter Username:</label><input type="text" id="userNameInput" name="userName"><br>
		<label>Enter Password:</label><input type="text" name="password1"><br>
		<label>Retype Password:</label><input type="text" name="password2"><br>
		<label>First Name:</label><input type="text" name="fName"><br>
		<label>Last Name:</label><input type="text" name="lName"><br>
		<label>Enter Email:</label><input type="text" name="Email"><br>
		<label>Please type captcha before submitting</label><br>
		<input type="text" name="image"> <br>
		<img src="image.php"><br>
		
		<input type="submit" name="command" value="registerUser">



	</form>

<div id="checkUserName"></div>

	
</body>
</html>