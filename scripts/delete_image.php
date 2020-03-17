<?php

$inputs = $_GET;

   // Get Inputs
   $id = $inputs['image'];

   // Validate Inputs & Sanitize Inputs

   include 'validation.php';
   $validation = new Validation();

   if ($validation->validateNumber($id, 1) == true) {
      $id = $validation->sanitize($id);

      include 'dbmodel.php';
      $model = new DBModel();
      
      $image = $model->getImage($id);
      if ($image['flag'] == true) {
         $image = $image['data']['image_url'];
         
         unlink("../" . $image);
         $del = $model->deleteImage($id);
         exit(header("location: ../images.php?status=success&msg=Image was deleted successfully."));
      
      } else {
         exit(header("location: ../images.php?status=error&msg=Sorry!, Image was not deleted."));
      }
   } else {
      exit(header("location: ../images.php?status=error&msg=Sorry!, Image was not deleted."));
   }

?>