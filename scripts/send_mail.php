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
			$mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->Host = 'mail.obejorgroup.com.ng';
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = 'ssl';
			$mail->Username = 'obejor@obejorgroup.com.ng';
			$mail->Password = 'z2ByQAHnJLY$';
			$mail->From = 'obejor@obejorgroup.com.ng';
			$mail->FromName = $sender;
			$mail->AddAddress("obejor@obejorgroup.com.ng", "Obejor Group");
			foreach($recipients as $recipient) {
				$mail->addBCC($recipient["email"], $recipient["name"]);

				// appending the emails with comma
				$recipientEmail[] = $recipient["email"];

				$noMailSent++;
			}
			$mail->addReplyTo('bulkmailer@obejorgroup.com.ng', 'Obejor Group');
			$mail->WordWrap = 50;
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $body;
			$result = $mail->Send();

			// if error in sending mail
			if ($result["code"] == '400')
			{
				$output .= html_entity_decode($result['full_error']);
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