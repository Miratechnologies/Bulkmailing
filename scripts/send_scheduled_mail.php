<?php

require_once '../vendor/PHPMailerClass/class.phpmailer.php';
require_once 'dbmodel.php';

// call the model function to get all active scheduled mails
// loop through them,
	// find their last_sent,
	// find the timelapse btw now and then roundup( now - last_sent ) in hours
		// compare the result with their mail_interval
			// if equal => 
				// send mail
				// add to mail_tbl
				// add to mail_report_tbl
				// update last_sent in scheduler_tbl
				// if now == end_date
					// update status to status inactive
			// else => continue

// **********************************************************

class scheduler
{
	private $model;

	public function __construct() {
		$this->model = new DBModel();
		
		$scheduledMails = $this->model->getActiveScheduledEmail();
		if ($scheduledMails['flag'] == true) {
			$mails = $scheduledMails['data'];
			// die(json_encode($mails[0]['subject']));
			$this->loop($mails);
		} else {
			exit("No Scheduled Mail");
		}
	}

	private function loop($mails) {
		// include the db model

		// loop through the mails
		foreach ($mails as $mail) {

			// find timelapse

			// get the current date and time
			$nowDate = date("Y-m-d");
			$nowTime = date("H:i:s");
			
			// if the scheduled date and the scheduled time are equal
			if ($nowDate == $mail['schedule_date'] && $nowTime == $mail['schedule_time']) {
				// send the mail
				// add to mail_tbl
				// add to mail_report_tbl
				$this->sendMail(json_decode($mail['recipients'], true),$mail['sender'],$mail['subject'],$mail['body']);
			}
			// as a result of setting back status to active after being cancelled, scheduled date and time might have expired
			else if ($nowDate == $mail['schedule_date'] && $nowTime == $mail['schedule_time']) {
				// send the mail
				// add to mail_tbl
				// add to mail_report_tbl
				$this->sendMail(json_decode($mail['recipients'], true),$mail['sender'],$mail['subject'],$mail['body']);
			
				// update status to status sent
				$this->model->updateScheduledEmailStatus($mail['scheduler_id'], "SENT");
				
			}
			else {
				continue;
			}

			// $now = new DateTime();
			// $lastSent = new DateTime($lastSent);

			// $diff = date_diff($now, $lastSent);
			// $timelapse = json_decode(json_encode($diff), true);
			// $days = $timelapse['d'];
			// $hours = $timelapse['h'];

			// $hours = ($days * 24) + $hours;

			// // compare the result with their mail_interval
			// if ($hours == $mail['mail_interval']) {
			// 	// send the mail
			// 	// add to mail_tbl
			// 	// add to mail_report_tbl
			// 	$this->sendMail(json_decode($mail['recipients'], true),$mail['sender'],$mail['subject'],$mail['body']);

			// 	// update last_sent in scheduler_tbl
			// 	$this->model->updateLastSent($mail['scheduler_id'], date("Y-m-d H:i:s"));
			// 	// if now == end_date
			// 	if (date("Y-m-d H:i:s") == $mail['date_ended']) {
			// 		// update status to status inactive
			// 		$this->model->updateScheduledEmailStatus($mail['scheduler_id'], "INACTIVE");
			// 	}
			// } else {
			// 	continue;
			// }
		}
	}

	private function sendMail($recipients, $sender, $subject, $body) {
		// collect all the recipients emails
		$recipientEmail = [];
		return 1;

		$output = ''; $noMailSent = 0;
		
		$mail = new PHPMailer;
		$mail->IsSMTP();								//Sets Mailer to send message using SMTP
		$mail->Host = 'mail.obejorgroup.com.ng';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = '587';								//Sets the default SMTP server port
		$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = 'obejor@obejorgroup.com.ng';					//Sets SMTP username
		$mail->Password = 'z2ByQAHnJLY$';					//Sets SMTP password
		// Testing REad Receipt
		// $return = "ebukaodini@gmail.com";
		// $mail->AddCustomHeader( "X-Confirm-Reading-To: $return" );
		// $mail->AddCustomHeader( "Return-Receipt-To: $return" );
		// $mail->AddCustomHeader( "Disposition-Notification-To: $return" );
		$mail->SMTPSecure = 'ssl';							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From = 'obejor@obejorgroup.com.ng';			//Sets the From email address for the message
		$mail->FromName = $sender;					//Sets the From name of the message
		$mail->AddAddress("obejor@obejorgroup.com.ng", "Obejor Group");	//Adds a "To" address
		foreach($recipients as $recipient) {
			$mail->addBCC($recipient["email"], $recipient["name"]);

			// appending the emails with comma
			$recipientEmail[] = $recipient["email"];

			$noMailSent++;
		}
		$mail->addReplyTo('obejor@obejorgroup.com.ng', 'Obejor Group');
		$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
		$mail->IsHTML(true);							//Sets message type to HTML
		$mail->Subject = $subject; //Sets the Subject of the message
		//An HTML or plain text message body
		
		// replacing the placeholders in the body
		// name - [[NAME]]
		// $newBody = str_replace("[[NAME]]", $recipient["name"], $body);
		// email - [[EMAIL]]
		// $newBody = str_replace("[[EMAIL]]", $recipient["email"], $newBody);
		// telephone - [[TELEPHONE]]
		// $body = str_replace("[[TELEPHONE]]", $recipient["telephone"], $body);

		$mail->Body = $body;

		$mail->AltBody = '';

		$result = $mail->Send();						//Send an Email. Return true on success or false on error

		// if error in sending mail
		if ($result["code"] == '400')
		{
			$output .= html_entity_decode($result['full_error']);
		}

		$mailType = "";
		$recipientEmails = implode(",",$recipientEmail);

		$add = $this->model->addNewMailCampaign($subject, $sender, $recipientEmails, $body);

		if ($add['flag'] == true) {
			// add the mail to the mail_report_tbl
			$mailId = $add['lastId'];
			$noRecipients = count($recipientEmail);
			$noMailOpened = 0;
			$report = $this->model->addMailReport($mailId, $noRecipients, $noMailSent, $noMailOpened);
		}
	}
}

(new Scheduler());

?>
