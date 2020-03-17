<?php

$inputs = $_GET;

   // Get Inputs
   $status = $inputs['status'];
   $id = $inputs['id'];

   // Validate Inputs & Sanitize Inputs

   include 'validation.php';
   $validation = new Validation();

   if ($validation->validateNumber($id, 1) == true && ($status == "ACTIVE" || $status == "CANCEL") ) {
      $id = $validation->sanitize($id);

      include 'dbmodel.php';
      $model = new DBModel();
      // add the template to the draft
      $add = $model->updateScheduledEmailStatus($id,$status);

      $msg = ($status == "ACTIVE") ? "enabled" : "disabled";

      if ($add == true) {
         exit(header("location: ../scheduledmails.php?update=true&action=$msg"));
      } else {
         exit(header("location: ../scheduledmails.php?update=false&action=$msg"));
      }
   } else {
      exit(header("location: ../scheduledmails.php"));
   }

?>