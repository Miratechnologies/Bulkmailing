<?php

   $inputs = $_POST;

   // Get Inputs
   $templateType = $inputs['templateType'];
   $description = $inputs['description'];
   $body = $inputs['body'];

   // Validate Inputs & Sanitize Inputs

   include 'validation.php';
   $validation = new Validation();

   if ($validation->validateText($description) == true) {
      $description = $validation->sanitize($description);

      include 'dbmodel.php';
      $model = new DBModel();
      // add the template to the draft
      $add = $model->addDraft($templateType,$description,$body);

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