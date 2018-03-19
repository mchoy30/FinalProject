<?php 
 	require 'PHPMailer-master/PHPMailerAutoLoad.php';

 	$mailTo = "mackenziechoy@gmail.com"; //$_POST['Email'];
 	$mailSub = "Welcome!" . $_POST['fname'];				
 	$mailMSG = 'Welcome to our website!!';  //send_mail();
 	$mail = new PHPMailer();
 	$mail ->IsSMTP();

 	$mail ->SMTPDebug =1; 
 	$mail ->SMTPAuth = true;
 	$mail ->SMPT = 'ssl';
 	$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
	);
 	$mail ->Host = "smtp.gmail.com";
 	$mail ->Port = 587;//587
 	$mail ->IsHTML(true);

 	$mail ->Username =  "webdev2006project@gmail.com"; 
 	$mail ->Password = "M1n1man!";
 	$mail ->SetFrom("webdev2006project@gmail.com"); 
 	$mail ->Subject = $mailSub;
 	$mail ->Body = $mailMSG;
 	$mail ->AddAddress($mailTo);

 	if(!$mail->Send())
 	{
 		echo "Mail Failed to send";
 	}
 	else
 	{
 		echo "Email sent to your address.";
 		header("Location: ..\login.php");

 	}
 ?>