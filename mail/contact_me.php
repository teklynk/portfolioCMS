<?php
session_start();
//die("contact form disabled");

if (!empty($_POST) && $_POST['referer'] == $_SESSION['unique_referer']) {
	//redirect back to contact form or home page
	$redirectPage = "../index.php?msgsent=thankyou#contact";
	//if an error occurs
	$errorPage = "../index.php?msgsent=error#contact";

	$name = $_POST['name'];
	$email_address = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
	$sendTo = $_POST['sendToEmail'];

	if (!empty($name)) {
		// Check for empty fields
		if(empty($_POST['name'])  	||
		   empty($_POST['email']) 	||
		   empty($_POST['phone']) 	||
		   empty($_POST['message'])	||
		   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
				header("Location: $errorPage");
				echo "<script>window.location.href='$errorPage';</script>";
				return false;
		} else {
			// Create the email and send the message
			$email_subject = "Website Contact Form:  $name";
			$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
			$headers = "From: $email_address\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
			$headers .= "Reply-To: $sendTo";
			mail($sendTo,$email_subject,$email_body,$headers);
			header("Location: $redirectPage");
			echo "<script>window.location.href='$redirectPage';</script>";
			return true;
		}
	} else {
		header("Location: $errorPage");
		echo "<script>window.location.href='$errorPage';</script>";
	}
	
} else {
	die('Direct access not permitted');
}
?>
