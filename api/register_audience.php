<?php

$inputs = $_POST;

// Get Inputs

$firstname = $inputs['firstname'];
$lastname = $inputs['lastname'];
$email = $inputs['email'];
$telephone = $inputs['telephone'];
$classification = $inputs['classification'];

// Validate Inputs & Sanitize Inputs

include '../scripts/validation.php';
$validation = new Validation();

if($validation->validateName($firstname,1,20) == false) {
   die(json_encode(["flag"=>false,"msg"=>"Invalid Firstname."]));
} else {
   $firstname = $validation->sanitize($firstname);
}

if ($validation->validateName($lastname,1,20) == false) {
   die(json_encode(["flag"=>false,"msg"=>"Invalid Lastname."]));
} else {
   $lastname = $validation->sanitize($lastname);
}

if ($validation->validateEmail($email,10,50) == false) {
   die(json_encode(["flag"=>false,"msg"=>"Invalid Email."]));
} else {
   $email = $validation->sanitize($email);
}

if ($validation->validateTelephone($telephone,10,20) == false) {
   die(json_encode(["flag"=>false,"msg"=>"Invalid Telephone."]));
} else {
   $telephone = $validation->sanitize($telephone);
}

if ($classification != "CUSTOMER" && $classification != "SUBSCRIBER") {
   die(json_encode(["flag"=>false,"msg"=>"Invalid Classification."]));
}

// No Error
// Verify the email and add the inputs into the database

// include SMTP Email Validation Class
include_once '../vendor/php-smtp-email-validation/trunk/smtp_validateEmail.class.php';

// Verify that email exist
// an optional sender
$sender = 'bulk@nglohitech.com';
// instantiate the class
$SMTP_Validator = new SMTP_validateEmail();
// turn on debugging if you want to view the SMTP transaction
$SMTP_Validator->debug = true;
// do the validation
$results = $SMTP_Validator->validate(array($email), $sender);
// check results
if ($results[$email] === true) {
   include '../scripts/dbmodel.php';
   
   $model = new DBModel();
   $add = $model->addAudience($firstname, $lastname, $email, $telephone, $classification, "SUBSCRIBED");
   // and send confirmation mail
   if ($add == true) {
      mail($email, 'Confirm Email', 'Please reply to this email to confirm', 'From:'.$sender."\r\n"); // send email
      die(json_encode(["flag"=>true,"data"=>"Customer has successfully subscribed to newsletter."]));
   } else {
      die(json_encode(["flag"=>false,"data"=>"Customer could not subscribe to newsletter."]));
   }

} else {
   // ignore the email and continue unto the next record
   die(json_encode(["flag"=>false,"msg"=>"Email does not exist."]));
}