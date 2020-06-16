<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

$inputs = $_POST;

// Get Inputs

$firstname = $inputs['firstname'];
$lastname = $inputs['lastname'];
$email = $inputs['email'];
$telephone = $inputs['telephone'];
$classification = $inputs['classification'];
$request = $inputs['request'];

// Validate Inputs & Sanitize Inputs

include '../scripts/validation.php';
$validation = new Validation();

if($validation->validateName($firstname,1,20) == false) {
   $request == "Application" ? exit(header("location: ../audience.php?errmsg=Invalid Firstname.")) : die(json_encode(["flag"=>false,"msg"=>"Invalid Firstname."]));
} else {
   $firstname = $validation->sanitize($firstname);
}

if ($validation->validateName($lastname,1,20) == false) {
   $request == "Application" ? exit(header("location: ../audience.php?errmsg=Invalid Lastname.")) : die(json_encode(["flag"=>false,"msg"=>"Invalid Lastname."]));
} else {
   $lastname = $validation->sanitize($lastname);
}

if ($validation->validateEmail($email,10,50) == false) {
   $request == "Application" ? exit(header("location: ../audience.php?errmsg=Invalid Email.")) : die(json_encode(["flag"=>false,"msg"=>"Invalid Email."]));
} else {
   $email = $validation->sanitize($email);
}

// if ($validation->validateTelephone($telephone,10,20) == false) {
//    $request == "Application" ? exit(header("location: ../audience.php?errmsg=Invalid Telephone.")) : die(json_encode(["flag"=>false,"msg"=>"Invalid Telephone."]));
// } else {
   $telephone = $validation->sanitize($telephone);
// }

if ($classification != "CUSTOMER" && $classification != "SUBSCRIBER") {
   $request == "Application" ? exit(header("location: ../audience.php?errmsg=Invalid Classification.")) : die(json_encode(["flag"=>false,"msg"=>"Invalid Classification."]));
}

// No Error
// Verify the email and add the inputs into the database

// include SMTP Email Validation Class
include_once '../vendor/php-smtp-email-validation/trunk/smtp_validateEmail.class.php';

// // Verify that email exist
// // an optional sender
// $sender = 'bulkmailer@miratechnologies.com.ng';
// // instantiate the class
// $SMTP_Validator = new SMTP_validateEmail();
// // turn on debugging if you want to view the SMTP transaction
// $SMTP_Validator->debug = false;
// // do the validation
// $results = $SMTP_Validator->validate(array($email), $sender);


// check results
// if ($results[$email] === true) {
   include '../scripts/dbmodel.php';
   
   $model = new DBModel();
   // if user email or telephone don't exist
   if ($model->checkAudienceExist($email, $telephone) == false) {
      $add = $model->addAudience($firstname, $lastname, $email, $telephone, $classification, "SUBSCRIBED");
      // and send confirmation mail
      if ($add == true) {
         @mail($email, 'Thanks', 'Thank you for subscribing to Mira Technologies Newsletter.', 'From:'.$sender."\r\n"); // send email
         $request == "Application" ? exit(header("location: ../audience.php?succmsg=Customer has successfully subscribed to newsletter.")) : die(json_encode(["flag"=>true,"data"=>"Customer has successfully subscribed to newsletter."]));
      } else {
         $request == "Application" ? exit(header("location: ../audience.php?errmsg=Customer could not subscribe to newsletter.")) : die(json_encode(["flag"=>false,"data"=>"Customer could not subscribe to newsletter."]));
      }
   } else {
      $request == "Application" ? exit(header("location: ../audience.php?errmsg=Customer already exists on our newsletter.")) : die(json_encode(["flag"=>false,"data"=>"Customer could not subscribe to newsletter."]));
   }

// } else {
//    // ignore the email and continue unto the next record
//    $request == "Application" ? exit(header("location: ../audience.php?errmsg=Email does not exist.")) : die(json_encode(["flag"=>false,"msg"=>"Email does not exist."]));
// }
