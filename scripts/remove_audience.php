<?php

$inputs = $_POST;

   // Get Inputs
   $audienceId = $inputs['audienceId'];

   // Validate Inputs & Sanitize Inputs

   include 'validation.php';
   $validation = new Validation();

   if ($validation->validateNumber($audienceId, 1) == true) {
      $audienceId = $validation->sanitize($audienceId);

      include 'dbmodel.php';
      $model = new DBModel();
      // add the template to the draft
      $add = $model->removeAudience($audienceId);

      if ($add == true) {
         exit(json_encode([
            "flag"=>true
         ]));
      } else {
         exit(json_encode([
            "flag"=>false
         ]));
      }
   } else {
      exit(json_encode([
         "flag"=>false
      ]));
   }

?>