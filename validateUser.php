
<?php

// function filter_user_registration()
// {
// 	$userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
// 	$fName    = filter_input(INPUT_POST, 'fName', FILTER_SANITIZE_SPECIAL_CHARS);
// 	$lName    = filter_input(INPUT_POST, 'lName', FILTER_SANITIZE_SPECIAL_CHARS);
// 	$email    = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);

// 	print_r($_POST['Email']);	
// 	print_r($lName);
// 	///filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_SPECIAL_CHARS);

// 	return strlen($userName) > 0 && strlen($fName) > 0 && strlen($lName) > 0 && strlen($email) > 0;
// }
session_start();

include_once 'connect.php';
$db = new PDO(DB_DSN, DB_USER, DB_PASS);
function salt_And_Hash()
{
	$password =  $_POST['password1'];
	//$salted = 'askjdbsajk334fbjasfkb'.  $password . 'kjsafbjhgrbj234slkdfn';
	
	$hashed  = password_hash($password , PASSWORD_DEFAULT);
	//= hash('sha512', $password);

	return $hashed;
}

 
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
	      	die();
	      	if(!$checkUser)
	      	{
	      		return true;
	      	}
	      		return false;
	}



	if($_POST)
	{
		$user = valid_username();
		$matchingPassword = valid_password();
		$checkEmail = valid_email();
		$captcha = valid_captcha_attempt();
		$firstName = valid_first_name();
		$lastName = valid_lastname();


		//$captcha == $_SESSION['Captcha'] && $matchingPassword && 
		if($captcha == $_SESSION['Captcha'] && $matchingPassword && check_for_existing_email() && check_existing_username())
		{
			header("Loctaion: validateUser.php");

			if(isset($_POST["command"]) == "registerUser")
			{
				$password = salt_And_Hash();
				$userName = $user;
				$fName 	  = $firstName;
				$lName    = $lastName;
				$email    = $checkEmail;


				$query = "INSERT INTO users (FirstName, LastName, UserName, EmailAddress, Password  ) VALUES (:FirstName, :LastName, :UserName, :EmailAddress, :Password);";
				$statement = $db->prepare($query); 
				
				
				$bind_values = [
					'FirstName' => $fName, 'LastName' => $lName, 'UserName' => $userName, 'EmailAddress' => $email, 'Password' => $password
				];
								print_r($bind_values);

				$statement->execute($bind_values); 
				header("Location: PHPMailer\sendMail.php");
				die();




			}
		}
		else {
			echo "error ";
			var_dump($_POST);
			var_dump($_SESSION);
			header("Loctaion: error.php");
		}
	}





	// if(!filter_user_registration()) {
	// 		echo 'Error';

	// }
	// else if(filter_user_registration() && isset($_POST["command"]) )
	// {
	// 	require_once 'connect.php';
		

	// 	if($_POST["command"] == "registerUser" && filter_user_registration())
	// 	{
	// 			$password = salt_And_Hash();
	// 			$userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_SPECIAL_CHARS);
	// 			$fName 	  = filter_input(INPUT_POST, 'fName', FILTER_SANITIZE_SPECIAL_CHARS);
	// 			$lName    = filter_input(INPUT_POST, 'lName', FILTER_SANITIZE_SPECIAL_CHARS);
	// 			$email    = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
				
	

 



	// 			$query = "INSERT INTO users (FirstName, LastName, UserName, EmailAddress, Password  ) VALUES (:FirstName, :LastName, :UserName, :EmailAddress, :Password);";
	// 			$statement = $db->prepare($query); 
				
				
	// 			$bind_values = [
	// 				'FirstName' => $fName, 'LastName' => $lName, 'UserName' => $userName, 'EmailAddress' => $email, 'Password' => $password
	// 			];
	// 							print_r($bind_values);

	// 			$statement->execute($bind_values); 
	// 			header("Location: PHPMailer\sendMail.php");
	// 			die();

	// 	}
	// }


?>