<?php

   $inputs = $_POST;

   // Get Inputs
   $templateType = $inputs['templateType'];
   $description = $inputs['description'];
   $body = $inputs['body'];

   // Validate Inputs & Sanitize Inputs

   include 'validation.php';
   $validation = new Validation();

   if ($validation->validateText($description) == true && strlen($description) <= 100 ) {
      $description = $validation->sanitize($description);

      include 'dbmodel.php';
      $model = new DBModel();
      // add the template to the draft
      $add = $model->addDraft($templateType,$description,htmlentities($body));

      if ($add != false) {
         exit(json_encode([
            "flag"=>true,
            "id"=>$add
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