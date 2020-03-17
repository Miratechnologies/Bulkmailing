<?php
//send_mail.php

if(isset($_POST['schedule_email']))
{
	// get the data
	$recipients = $_POST['email_recipients'];
	$sender = $_POST['email_sender'];
	$subject = $_POST['email_subject'];
   $body = $_POST['email_body'];
   $schedule_date = $_POST['schedule_date'];
	$schedule_time = $_POST['schedule_time'];
	
	// die($schedule_date . " - " . $schedule_time);

	include 'dbmodel.php';
	$model = new DBModel();
	$add = $model->addNewScheduler($subject, $sender, json_encode($recipients), $body, $schedule_date, $schedule_time);

	if($add['flag'] == true)
	{
      // $mailId = $add['lastId'];
		exit(json_encode([
			"flag"=>true
		]));
	}
	else
	{
		exit(json_encode([
			"flag"=>false
		]));
	}
}

?>