<?php
//send_mail.php

if(isset($_POST['send_email']))
{
	require '../vendor/PHPMailerClass/class.phpmailer.php';

	// get the data
	$recipients = $_POST['email_recipients'];
	$sender = $_POST['email_sender'];
	$subject = $_POST['email_subject'];
   $body = $_POST['email_body'];
   $attachment = "
   \r\n\r\n
   <br>A new campaign with the subject <b>{$subject}</b> is about to go out.\r\nPlease Authourize this campaign.
   ";

	// collect all the recipients emails
   $recipientEmails = json_encode($recipients);
   
   $admin = [
      ["email"=>"ebukaodini@gmail.com","name"=>"Developer Admin"],
      // ["email"=>"obejorbusiness@gmail.com","name"=>"Obejor Admin"],
   ];

   // Notify the Admin
	foreach($admin as $recipient)
	{
		$mail = new PHPMailer;
		$mail->IsSMTP();								//Sets Mailer to send message using SMTP
		$mail->Host = 'mail.obejorgroup.com.ng';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = '25';								//Sets the default SMTP server port
		$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = 'obejor@obejorgroup.com.ng';					//Sets SMTP username
		$mail->Password = 'z2ByQAHn]LY$';					//Sets SMTP password
		// Testing REad Receipt
		$return = "ebukaodini@gmail.com";
		$mail->AddCustomHeader( "X-Confirm-Reading-To: $return" );
		$mail->AddCustomHeader( "Return-Receipt-To: $return" );
		$mail->AddCustomHeader( "Disposition-Notification-To: $return" );
		// $mail->SMTPSecure = '';							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From = 'obejor@obejorgroup.com.ng';			//Sets the From email address for the message
		$mail->FromName = $sender;					//Sets the From name of the message
		$mail->AddAddress($recipient["email"], $recipient["name"]);	//Adds a "To" address
		$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
		$mail->IsHTML(true);							//Sets message type to HTML
		$mail->Subject = $subject; //Sets the Subject of the message
		//An HTML or plain text message body
		$mail->Body = $body . $attachment;

		$mail->AltBody = "<br>A new campaign with the subject <b>{$subject}</b> is about to go out.\r\nPlease Authourize this campaign.";

		$result = $mail->Send();						//Send an Email. Return true on success or false on error

      $status = ($result["code"] == '400') ? "ERROR" : "OK" ;

	}

	$mailType = "";

	include 'dbmodel.php';
	$model = new DBModel();
	$add = $model->addNewMailCampaign($subject, $sender, $recipientEmails, $body, "Pending"); # Authorized

	if ($status == "OK" || $add['flag'] == true) {
		exit(json_encode([
			"flag"=>true
		]));
	}
	else
	{
		exit(json_encode([
			"flag"=>false,
			"data"=>$output
		]));
	}
}

?>