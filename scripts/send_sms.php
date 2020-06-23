<?php
//send_mail.php


function sendSMSOld($user,$sender,$recipients,$messg){

	$postdata = "smsuser=". $user ."&sender=".$sender."&recipients=".$recipients."&messg=".$messg;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.miratechnologiesng.com/sendsmsapi.php?");
	//curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
	curl_exec($ch);
	curl_close($ch);
	
}

function sendSMS($recipients,$msg) {
	// {
	// 	"account": {
	// 	  "password": "string",
	// 	  "systemId": "string"
	// 	},
	// 	"destinations": [
	// 	  "string"
	// 	],
	// 	"src": "string",
	// 	"text": "string"
	// }


	$payload = [];

	$payload["account"] = [
		"password" => "GpYt87KHK",
		"systemId" => "NG.201.2014"
	];
	$payload["destinations"] = $recipients;
	$payload["src"] = "ISWTest";
	$payload["text"] = $msg;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://sms.vanso.com/rest/sms/submit/bulk");
	//curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $payload);
	curl_exec($ch);
	curl_close($ch);

	// return json_encode($payload);
}


if(isset($_POST['send_sms']))
{
	require '../vendor/PHPMailerClass/class.phpmailer.php';

	// get the data
	$recipients = $_POST['sms_recipients'];
	$sender = $_POST['sms_sender'];
	$body = $_POST['sms_body'];

	// collect all the recipients telephone no.
	$recipientTelephone = [];

	$noMailSent = 0;
	foreach($recipients as $recipient)
	{
		// collecting the telephone no's
		$recipientTelephone[] = $recipient["telephone"];
		// $recipient["name"];
	}
	
	// implode with comma
	// $recipientTelephone = implode(",",$recipientTelephone);
	// $recipientTelephone

	// try sending sms
	sendSMS($recipientTelephone,$body);

	include 'dbmodel.php';
	$model = new DBModel();
	$add = $model->addNewSMSCampaign($sender, $recipientEmails, $body);

	if ($add['flag'] == true) {
		// add the mail to the mail_report_tbl
		$smsId = $add['lastId'];
		$noRecipients = count($recipientTelephone);
		$noMailOpened = 0;
		$report = $model->addSMSReport($smsId, $noRecipients, $noMailSent, $noMailOpened);

		exit(json_encode([
			"flag"=>true
		]));
	} else {
		exit(json_encode([
			"flag"=>false
		]));
	}
	
}

?>