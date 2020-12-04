<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php'; 
require 'includes/dbh.inc.php';
// Instantiation and passing `true` enables exceptions


if(isset($_POST['reset-forgotpassword-submit']))
{
		
		$emailTo = $_POST['email'];
		$pwdResetSelector = uniqid(true);
		$pwdResetSelector = password_hash($pwdResetSelector, PASSWORD_DEFAULT);
		$query = mysqli_query($conn, "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector) VALUES ('$emailTo', '$pwdResetSelector')");
		if(!$query)
		{
			exit("Error");
		}

		$mail = new PHPMailer(true);

		try {
	    //Server settings

	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'roomreservation6@gmail.com';                     // SMTP username
	    $mail->Password   = 'amaccpassword';                               // SMTP password
	    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
	    $mail->Port       = 465;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom('roomreservation6@gmail.com', 'Room Reservation');
	    $mail->addAddress($emailTo);     // Add a recipient
	    $mail->addReplyTo('no-replyinfo@example.com', 'No reply');
	    $mail->addCC('cc@example.com');
	    $mail->addBCC('bcc@example.com');


	    // Content
	    $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SEF"]) . "/loginsystem/resetpassword.php?code=$pwdResetSelector";
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Reset password link';
	    $mail->Body    = "<h1>You requested a password reset</h1>
	    					Click <a href='$url'>this link</a>";
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    
	    echo 'Message has been sent';
	    header("location: forgotpassword.php?request=success");
	    
			} catch (Exception $e) {
		
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	    header("location: forgotpassword.php?request=error");
	    
		}

}


?>