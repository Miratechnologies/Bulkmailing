<?php

$inputs = $_GET;

// Get Inputs
$email = $inputs['email'];


// Validate Inputs & Sanitize Inputs
include '../scripts/validation.php';
$validation = new Validation();

if ($validation->validateEmail($email,10,50) == false) {
   die(json_encode(["flag"=>false,"msg"=>"Invalid Email."]));
} else {
   $email = $validation->sanitize($email);
}

   include '../scripts/dbmodel.php';
   
   $model = new DBModel();
   $update = $model->unSubscribeAudience("UNSUBSCRIBER",$email);
   // and send confirmation mail
   if ($update == true) {
      die("Dear $email, you have been successfully unsuscribed.");
   } else {
      die("Sorry, Unsuscription failed.");
   }

