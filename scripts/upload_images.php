<?php

// echo bin2hex(random_bytes(3));

if(isset($_POST["uploadImage"])) {

   include_once 'dbmodel.php';
   include_once 'validation.php';
   
   $imageName = $_POST['image_name'];
   $validation = new Validation();

   if ($validation->validateText($imageName) == false || strlen($imageName) < 1 || strlen($imageName) > 50) {
      exit(header("location: ../images.php?status=error"));
   } else {
      $imageName = $validation->sanitize($imageName);
   }

   $uploadOk = 1;
   $target_dir = "../storage/images/";
   $imageFileType = strtolower(pathinfo($target_dir . basename($_FILES["image"]["name"]),PATHINFO_EXTENSION));
   
   // regenerate a secured random name for the file
   $image = bin2hex(random_bytes(3)) .".". $imageFileType;
   $imageUrl = "storage/images/" . $image;
   $target_file = $target_dir . $image;

   // Check if image file is a actual image or fake image
   if(isset($_POST["uploadImage"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check === false) {
         exit(header("location: ../images.php?status=error&msg=File is not an image."));
      }
   }

   // Allow certain file formats
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif" ) {
      exit(header("location: ../images.php?status=error&msg=Sorry, only JPG, JPEG, PNG and GIF files are allowed."));
   }

   // Check if $uploadOk is set to 0 by an error
   if ($uploadOk == 0) {
      exit(header("location: ../images.php?status=error"));
   // if everything is ok, try to upload file
   } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
         // add the file to the database
         
         // $imageName
         $dbModel = new DBModel();
         $add = $dbModel->addImage($imageUrl,$imageName);
         if ($add['flag'] == true) {
            exit(header("location: ../images.php?status=success"));
         } else {
            exit(header("location: ../images.php?status=error"));
         }
      } else {
         exit(header("location: ../images.php?status=error"));
      }
   }

} else {
   exit(header("location: ../images.php?status=error"));
}

?>