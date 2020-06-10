<?php

   $inputs = $_POST;

   // Get Inputs
   $id = $inputs['id'];
   $body = $inputs['body'];

   include 'dbmodel.php';
   $model = new DBModel();
   // add the template to the draft
   $add = $model->updateDraft($body, $id);

   if ($add === true) {
      exit(json_encode([
         "flag"=>true
      ]));
   } else {
      exit(json_encode([
         "flag"=>false
      ]));
   }

?>