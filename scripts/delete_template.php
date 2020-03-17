<?php

$inputs = $_GET;

   // Get Inputs
   $templateId = $inputs['template'];

   // Validate Inputs & Sanitize Inputs

   include 'validation.php';
   $validation = new Validation();

   if ($validation->validateNumber($templateId, 1) == true) {
      $templateId = $validation->sanitize($templateId);

      include 'dbmodel.php';
      $model = new DBModel();
      // add the template to the draft
      $del = $model->deleteTemplate($templateId);

      if ($del == true) {
         exit(header("location: ../templates.php?deleteTemplate=true"));
      } else {
         exit(header("location: ../templates.php?deleteTemplate=false"));
      }
   } else {
      exit(header("location: ../templates.php?deleteTemplate=false"));
   }

?>