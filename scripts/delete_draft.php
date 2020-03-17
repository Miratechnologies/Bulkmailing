<?php

$inputs = $_GET;

   // Get Inputs
   $draftId = $inputs['draft'];

   // Validate Inputs & Sanitize Inputs

   include 'validation.php';
   $validation = new Validation();

   if ($validation->validateNumber($draftId, 1) == true) {
      $draftId = $validation->sanitize($draftId);

      include 'dbmodel.php';
      $model = new DBModel();
      // add the template to the draft
      $del = $model->deleteDraft($draftId);

      if ($del == true) {
         exit(header("location: ../drafts.php?deleteDraft=true"));
      } else {
         exit(header("location: ../drafts.php?deleteDraft=false"));
      }
   } else {
      exit(header("location: ../drafts.php?deleteDraft=false"));
   }

?>