<?php
// import the IOFactory
include_once '../vendor/PHPExcel/IOFactory.php';
include_once '../vendor/PHPExcel/PHPExcel.php';

// include SMTP Email Validation Class
include_once '../vendor/php-smtp-email-validation/trunk/smtp_validateEmail.class.php';

// upload the document
$target_dir = "../storage/UploadedExcelFiles/";
$target_file = $target_dir . basename($_FILES["excelFile"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Allow certain file formats
if($fileType != "xls") {
   die(json_encode([
      "flag"=>false,
      "data"=>"Sorry, only XLS files are allowed."
   ]));
   $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   die(json_encode([
      "flag"=>false,
      "data"=>"Sorry, your file was not uploaded."
   ]));
// if everything is ok, try to upload file
} else {
   if (move_uploaded_file($_FILES["excelFile"]["tmp_name"], $target_file)) {

      // read the data in the excel file 
      readExcelData($target_file);

   } else {
      die(json_encode([
         "flag"=>false,
         "data"=>"Sorry, there was an error uploading your file."
      ]));
   }
}

function readExcelData($excelFile){

  $objPHPExcel = PHPExcel_IOFactory::load($excelFile);
  $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

	// Add the inputs into the database
   include 'dbmodel.php';
   $model = new DBModel();

   foreach ($sheetData as $row) {

      $firstname = $row['A'];
      $lastname = $row['B'];
      $email = $row['C'];
      $telephone = $row['D'];
      $classification = $row['E'];

      // verify that email exist
      
      // an optional sender
      $sender = 'bulk@nglohitech.com';
      // instantiate the class
      $SMTP_Validator = new SMTP_validateEmail();
      // turn on debugging if you want to view the SMTP transaction
      $SMTP_Validator->debug = true;
      // do the validation
      $results = $SMTP_Validator->validate(array($email), $sender);
      // check results
      if ($results[$email] === true) {

         // if user email or telephone don't exist
         if ($model->checkAudienceExist($email, $telephone) == false) {
            // email address is valid, add them to the database
            $add = $model->addAudience($firstname, $lastname, $email, $telephone, $classification, "SUBSCRIBED");
            // and send confirmation mail
            if ($add == true) {
               mail($email, 'Confirm Email', 'Please reply to this email to confirm', 'From:'.$sender."\r\n"); // send email
            }
         }
         
      } else {
         // ignore the email and continue unto the next record
         continue;
      }
   }

   die(json_encode([
      "flag"=>true,
      "data"=>"Customers are added."
   ]));

}

?>