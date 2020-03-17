<?php

$inputs = $_POST;

   // Get Inputs
   $userId = $inputs['userId'];
   $status = $inputs['status'];

   // Validate Inputs & Sanitize Inputs

   include 'validation.php';
   $validation = new Validation();

   if ($validation->validateNumber($userId, 1) == true && ($status == "ACTIVE" || $status == "BLOCKED") ) {
      $userId = $validation->sanitize($userId);

      include 'dbmodel.php';
      $model = new DBModel();
      // add the template to the draft
      $add = $model->updateUserStatus($status,$userId);

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