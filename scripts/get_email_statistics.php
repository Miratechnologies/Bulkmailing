<?php

   $inputs = $_POST;

   // Get Inputs
   $list = $inputs['list'];

   // Validate Inputs & Sanitize Inputs

   include 'validation.php';
   $validation = new Validation();

   include 'dbmodel.php';
   $model = new DBModel();

   if ($list == "recent") {
      $report = $model->getEmailReport();
      if ($report['flag'] == true) {
         $data = $report['data'];
         exit(json_encode([
            "flag"=>true,
            "data"=>$data
         ]));
      } else {
         exit(json_encode([
            "flag"=>false
         ]));
      }
   } elseif ($list == "range") {
      $startDate = $inputs['startDate'];
      $endDate = $inputs['endDate'];

      if ($validation->validateDate($startDate) == true && $validation->validateDate($endDate) == true) {

         $report = $model->getEmailReportByDate($startDate,$endDate);
         if ($report['flag'] == true) {
            $data = $report['data'];
            exit(json_encode([
               "flag"=>true,
               "data"=>$data
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
   }

?>