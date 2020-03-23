<?php
//send_mail.php

if (isset($_GET['action']) && $_GET['action'] == "send") {

	$status = $_GET['status'];
	$mailId = $_GET['id'];

	// validate the inputs
	include 'validation.php';
   $validation = new Validation();
	if ($validation->validateNumber($mailId, 1) == true) {
		$mailId = $validation->sanitize($mailId);
	} else {
		exit(header("location: ../authorize_campaign.php"));
	}

	if ($status != "Authorize" && $status != "Reject" ) {
		exit(header("location: ../authorize_campaign.php"));
	}

	include 'dbmodel.php';
	$model = new DBModel();
	$mail = $model->getThisEmailCampaign($mailId);

	if ($mail['flag'] == true) {

		if ($status == "Authorize") {
				
			// get the data for the campaign from the database
			$recipients = $mail['data'][0]['recipients'];
			// convert to array
			$recipients = json_decode($recipients, true);
			$subject = $mail['data'][0]['subject'];
			$sender = $mail['data'][0]['sender'];
			$body = $mail['data'][0]['body'];
			$mailId = $mail['data'][0]['mail_id'];

			// initiate mailing
			require '../vendor/PHPMailerClass/class.phpmailer.php';

			// collect all the recipients emails
			$recipientEmail = [];

			$output = ''; $noMailSent = 0;
			foreach($recipients as $recipient)
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
				
				// replacing the placeholders in the body
				// name - [[NAME]]
				$body = str_replace("[[NAME]]", $recipient["name"], $body);
				// email - [[EMAIL]]
				$body = str_replace("[[EMAIL]]", $recipient["email"], $body);
				// telephone - [[TELEPHONE]]
				$body = str_replace("[[TELEPHONE]]", $recipient["telephone"], $body);

				$mail->Body = $body;

				$mail->AltBody = '';

				$result = $mail->Send();						//Send an Email. Return true on success or false on error

				// if error in sending mail
				if ($result["code"] == '400')
				{
					$output .= html_entity_decode($result['full_error']);
				} else {
					// increment the no of successful mail sent
					$noMailSent++;
				}

				// appending the emails with comma
				$recipientEmail[] = $recipient["email"];
			}

			// add the mail to the mail_report_tbl
			$noRecipients = count($recipientEmail);
			$noMailOpened = 0;
			$report = $model->addMailReport($mailId, $noRecipients, $noMailSent, $noMailOpened);
			
			// update the mail status
			$update = $model->updateMailStatus($mailId, "Authorized");

			if($output == '' && $update == true)
			{
				exit(header("location: ../authorize_campaign.php?update=true&action=Authorized"));
			}
			else
			{
				exit(header("location: ../authorize_campaign.php?update=false&action=Authorized"));
			}
		} elseif ($status == "Reject") {
			// update the mail status
			$update = $model->updateMailStatus($mailId, "Rejected");

			if($update == true)
			{
				exit(header("location: ../authorize_campaign.php?update=true&action=Rejected"));
			}
			else
			{
				exit(header("location: ../authorize_campaign.php?update=false&action=Rejected"));
			}
		}

	}

}

?>