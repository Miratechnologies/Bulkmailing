<?php

include_once 'scripts/auth.php';
include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "edit template - " . date("d/m/Y h:i a");
include 'scripts/log.php';

// Getting the details of the page for editing
if ($_GET != []) {

   $inputs = $_GET;

   if (isset($inputs['template'])) {

      // Get Inputs
      $templateId = $inputs['template'];

      $get = $model->getThisTemplate($templateId);

      if ($get['flag'] == true) {
         $description = $get['data'][0]['description'];
         $body = $get['data'][0]['body'];
         $templateType = $get['data'][0]['template_type'];
      } else {
         header('location: templates.php');
      }
   } else {
      header('location: templates.php');
   }

}

// Updating the template
if ($_POST != []) {

   $inputs = $_POST;

   if (isset($inputs['submit_update_template'])) {

      // Get Inputs
      $templateId = $inputs['template_id'];
      $description = $inputs['template_description'];
      // $body = $inputs['body'];
      $body = isset($inputs['email_body']) && trim($inputs['email_body']) != "" ? $inputs['email_body'] : $inputs['sms_body'] ;

      // Validate Inputs & Sanitize Inputs

      include 'scripts/validation.php';
      $validation = new Validation();

      if ($validation->validateText($description) == true) {
         $description = $validation->sanitize($description);
         // $body = json_encode($body);

         $update = $model->updateTemplate($description,$body,$templateId);

         if ($update == true) {
            header('location: templates.php?updatetemplate=true');
         } else {
            header('location: templates.php?updatetemplate=false');
         }
      } else {
         header('location: templates.php?updatetemplate=false');
      }

   } 
   
   // elseif (isset($inputs['submit_save_as_draft'])) {

   //    // Get Inputs
   //    $templateId = $inputs['template_id'];
   //    $templateType = $inputs['template_type'];
   //    $description = $inputs['description'];
   //    $body = $inputs['body'];

   //    // Validate Inputs & Sanitize Inputs

   //    include 'scripts/validation.php';
   //    $validation = new Validation();

   //    if ($validation->validateText($description) == true) {
   //       $description = $validation->sanitize($description);

   //       // update the template record
   //       $update = $model->updateTemplate($description,$body,$templateId);
   //       // add the template to the draft
   //       $add = $model->addDraft($templateType,$description,$body);

   //       if ($add == true) {
   //          header('location: drafts.php?adddraft=true');
   //       } else {
   //          header('location: templates.php?adddraft=false');
   //       }
   //    } else {
   //       header('location: templates.php?adddraft=false');
   //    }
   // } 
   
   else {
      header('location: templates.php');
   }
}


$get = $model->getImages();

if ($get['flag'] == true) {
   $images = $get['data'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Edit Template | BulkMailing</title>

	<!-- Jquery -->
	<script src="assets/js/jquery.min.js"></script>
	<!-- Popper -->
	<script src="assets/js/popper.min.js"></script>
	<!-- Bootstrap -->
	<script src="assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="assets/css/fontawesome.css">
	<!-- Custom -->
	<script src="assets/js/main.js"></script>
   <script src="assets/js/createtemplate.js"></script>
   <link rel="stylesheet" href="assets/css/main.css">
   <link rel="stylesheet" href="assets/css/createtemplate.css">
   
</head>
<body class="bg-white">

   <?php include 'header.php'; ?>
   <a href="templates.php" class="sticky-top btn btn-sm btn-dark ml-1 mb-0" style="margin-top: -100px;"> <span class="fa fa-arrow-left"></span> Back </a>

   <main class="row no-gutters">
      
      <section class="position-fixed col-lg-8 bg-muted border" style="width: 70%; height: 90%;">
         <div id="template-pad" class="position-fixed scrollable cursor-pointer" style="width:66.5%; height: 90%;">
            <?php if ($templateType == "EMAIL") { echo $body; } ?>
         </div>
      </section>

      <aside class="offset-8 position-fixed col-lg-4 bg-light h-100 p-3 pb-5 mb-5 scrollable" style="width: 40%; height: 90%;">
      
         <button onclick="previewTemplate();" data-toggle="modal" data-target="#previewBody" class="btn btn-md btn-outline-secondary text-dark"> <span class="fa fa-eye"></span> Preview</button>
         <button id="btnShowRow" onclick="showRow();" class="btn btn-md btn-outline-secondary text-dark">Add New Row</button>
         
         <div class="btn-group float-right">
            <button class="btn btn-md btn-secondary" title="Undo" onclick="undo()"><span class="fa fa-undo"></span></button>
            <button class="btn btn-md btn-secondary" title="Redo" onclick="redo()"><span class="fa fa-repeat"></span></button>
            <button class="btn btn-md btn-secondary" onclick="clearSelect()">Deselect</button>
         </div>
         
         <div class="clearfix my-3"></div>
         <br>

         <div id="create-new-template">

            <form method="post" id="templateForm" action="edit_template.php">
               
               <!-- <label for="template_type" class="text-lg" value="<?php echo $templateType; ?>">Template Type:</label>
               <select onchange="if ( $('#template_type').val() == 'EMAIL' ) { $('#sms_save').hide(); $('#email_create').show(); } else if ( $('#template_type').val() == 'SMS' ) { $('#email_create').hide(); $('#sms_save').show(); } " id="template_type" name="template_type" class="input-group-append text-md form-control w-0 border-muted">
                  <option value="EMAIL">Email</option>
                  <option value="SMS">SMS</option>
               </select> -->

               <input type="hidden" name="template_id" value="<?php echo $templateId; ?>">
               <!-- <input type="hidden" name="template_type" value="<?php //echo $templateType; ?>"> -->

               <!-- <br> -->
               <label for="template_description" class="text-lg">Description:</label>
               <textarea id="template_description" name="template_description" minlength="1" maxlength="200" class="form-control" cols="30" rows="3" style="resize:none"><?php echo $description; ?></textarea>

               <input type="hidden" name="email_body" id="email_body" value="">
               <input type="hidden" name="submit_update_template" value="Update Template">

               <?php
               if ($templateType == "SMS") {
                  ?>

                  <div id="sms_save">
                     <br>
                     <label for="sms_body" class="text-lg">SMS Template:</label>
                     <textarea onkeyup="$('#sms_body_len').html(160 - $('#sms_body').val().length);" minlength="1" maxlength="160" name="sms_body" id="sms_body" class="form-control" cols="30" rows="5" style="resize:none"><?php echo $body; ?></textarea>
                     <p id="sms_body_len">160</p>

                     <input type="submit" id="submit_add_template" name="submit_update_template" value="Update Template" class="btn btn-md btn-dark" />
                     <a href="templates.php" class="btn btn-md btn-danger"> Cancel </a>
                  </div>
                  
                  <?php
               }
               ?>

            </form>

            <!-- <div id="email_create">
               <br>
               <button class="btn btn-md btn-dark" onclick="createNewTemplate()">Create New Template</button>
            </div> -->

         </div>

         <div class="card">
               
            <div id="row-display">
               <div class="card-header">
                  <p class="h3 text-secondary w-100">Row</p>
               </div>
               <div class="card-body">
                  <label for="rowBgColor" class="">Background Color</label> <br>
                  <input type="color" class="form-control" value="#ffffff" id="rowBgColor"><br>

                  <label for="rowBorderWeight">Border Weight</label> <span class="font-weight-bold" id="rowBorderWeightDisplay"></span> <br>
                  <input type="range" onchange="$('#rowBorderWeightDisplay').html($('#rowBorderWeight').val())" class="form-control" id="rowBorderWeight" value="0" min="0" max="100"><br>

                  <label for="rowBorderColor" class="">Border Color</label> <br>
                  <input type="color" class="form-control" value="#ffffff" id="rowBorderColor"><br>

                  <label for="rowHeight">Row Height</label> <span class="font-weight-bold" id="rowHeightDisplay"></span> <br>
                  <input type="range" onchange="$('#rowHeightDisplay').html($('#rowHeight').val())" class="form-control" id="rowHeight" value="0" min="0" step="5" max="100"><br>

                  <!-- <button class="btn btn-dark btn-md" onclick="styleRow()">Apply</button> -->
                  <button class="btn btn-dark btn-md" onclick="addRow()">Add New Row</button>
               </div>
            </div>

            <div id="editRow-display">
               <div class="card-header">
                  <p class="h3 text-secondary w-100">Edit Row</p>
               </div>
               <div class="card-body">
                  <label for="editrowBgColor" class="">Background Color</label> <br>
                  <input type="color" class="form-control" value="#ffffff" id="editrowBgColor"><br>

                  <label for="editrowBorderWeight">Border Weight</label> <span class="font-weight-bold" id="editrowBorderWeightDisplay"></span> <br>
                  <input type="range" onchange="$('#editrowBorderWeightDisplay').html($('#editrowBorderWeight').val())" class="form-control" id="editrowBorderWeight" value="0" min="0" max="100"><br>

                  <label for="editrowBorderColor" class="">Border Color</label> <br>
                  <input type="color" class="form-control" value="#ffffff" id="editrowBorderColor"><br>

                  <label for="editrowHeight">Row Height</label> <span class="font-weight-bold" id="editrowHeightDisplay"></span> <br>
                  <input type="range" onchange="$('#editrowHeightDisplay').html($('#editrowHeight').val())" class="form-control" id="editrowHeight" value="0" min="0" step="5" max="100"><br>

                  <button class="btn btn-dark btn-md" onclick="editRow()">Apply</button>
                  <button class="btn btn-danger btn-md" onclick="$('#editRow-display').hide()">Cancel</button>

                  <button class="btn btn-danger btn-md float-right" onclick="remove();$('#editRow-display').hide();">Delete</button>
               </div>
            </div>
            
            <div id="addColumn-display">
               <div class="card-header">
                  <p class="h3 text-secondary w-100">Add Columns</p>
               </div>
               <div class="card-body">
                  <label for="no_columns" class="">Number of Columns</label> <br>
                  <input class="form-control" type="number" id="no_columns" value="1" min="1" max="5"> <br>

                  <label for="columnBgColor" class="">Background Color</label> <br>
                  <input type="color" class="form-control" value="#ffffff" id="columnBgColor"><br>

                  <label for="columnBorderWeight">Border Weight</label> <span class="font-weight-bold" id="columnBorderWeightDisplay"></span> <br>
                  <input type="range" onchange="$('#columnBorderWeightDisplay').html($('#columnBorderWeight').val())" class="form-control" id="columnBorderWeight" value="0" min="0" max="100"><br>

                  <label for="columnBorderColor" class="">Border Color</label> <br>
                  <input type="color" class="form-control" value="#ffffff" id="columnBorderColor"><br>

                  <label for="columnHeight">column Height</label> <span class="font-weight-bold" id="columnHeightDisplay"></span> <br>
                  <input type="range" onchange="$('#columnHeightDisplay').html($('#columnHeight').val())" class="form-control" id="columnHeight" value="0" min="0" step="5" max="100"><br>

                  <button class="btn btn-dark btn-md" onclick="addColumns()">Apply</button>
               </div>
            </div>

            <div id="col-actions">
               <div class="card-header">
                  <p class="h3 text-secondary w-100">Columns</p>
               </div>
               <div class="card-body">
               
                  <div class="row my-1">
                     <button class="btn col-lg-5 mx-auto my-1 btn-dark btn-md" onclick="showContents();">Add Contents</button>

                     <button class="btn col-lg-5 mx-auto my-1 btn-dark btn-md" onclick="showEditColumn();">Edit Column</button>
                  </div>

                  <div class="row my-1">
                     <button class="btn col-lg-5 mx-auto my-1 btn-dark btn-md" onclick="addRowAbove();">Add Items Above</button>

                     <button class="btn col-lg-5 mx-auto my-1 btn-dark btn-md" onclick="addRowBelow();">Add Items Below</button>
                  </div>

                  <button class="btn btn-danger mt-2 btn-md float -right" onclick="remove()">Delete</button>
               </div>
            </div>

            <div id="editColumn-display">
               <div class="card-header">
                  <p class="h3 text-secondary w-100">Edit Column</p>
               </div>
               <div class="card-body">
                  <!-- <label for="no_columns" class="">Number of Columns</label> <br>
                  <input class="form-control" type="number" id="no_columns" value="1" min="1" max="5"> <br> -->

                  <label for="editcolumnBgColor" class="">Background Color</label> <br>
                  <input type="color" class="form-control" value="#ffffff" id="editcolumnBgColor"><br>

                  <label for="editcolumnBorderWeight">Border Weight</label> <span class="font-weight-bold" id="editcolumnBorderWeightDisplay"></span> <br>
                  <input type="range" onchange="$('#editcolumnBorderWeightDisplay').html($('#editcolumnBorderWeight').val())" class="form-control" id="editcolumnBorderWeight" value="0" min="0" max="100"><br>

                  <label for="editcolumnBorderColor" class="">Border Color</label> <br>
                  <input type="color" class="form-control" value="#ffffff" id="editcolumnBorderColor"><br>

                  <label for="editcolumnHeight">column Height</label> <span class="font-weight-bold" id="editcolumnHeightDisplay"></span> <br>
                  <input type="range" onchange="$('#editcolumnHeightDisplay').html($('#editcolumnHeight').val())" class="form-control" id="editcolumnHeight" value="0" min="0" step="5" max="100"><br>

                  <label for="editcolumnWidth">column Width</label> <span class="font-weight-bold" id="editcolumnWidthDisplay"></span> <br>
                  <input type="range" onchange="$('#editcolumnWidthDisplay').html($('#editcolumnWidth').val())" class="form-control" id="editcolumnWidth" value="0" min="0" step="5" max="100"><br>

                  <button class="btn btn-dark btn-md" onclick="editColumn()">Apply</button>
               </div>
            </div>

            <div id="cntt-actions">
               <button class="btn btn-dark btn-md" onclick="remove()">Remove</button>
            </div>
            
         </div>

         <div id="contents-display">

            <div id="accordion">
               <div class="card">
                  <div class="card-header bg-secondary">
                     <p class="h3 text-light w-100">Contents</p>
                  </div>

                  <!-- Text -->
                  <div>
                     <div class="card-header">
                        <a class="h4 text-secondary card-link w-100" data-toggle="collapse" href="#textContent">
                           Text
                        </a>
                     </div>
                     <div id="textContent" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                           <label for="textContentText" class="">Text</label> <br>
                           <textarea id="textContentText" class="form-control" cols="10" rows="3" placeholder="Enter Text..."></textarea>
                           <span><b>For Recipient Placeholder,</b><br>Use <b>[[NAME]]</b> for the recipient's name<br>Use <b>[[EMAIL]]</b> for the recipient's email</span><br><br>
                           
                           <label for="textContentFamily">Font Family</label> <br>
                           <select class="form-control" id="textContentFamily">
                              <option style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="Verdana, Geneva, Tahoma, sans-serif;">Verdana</option>
                              <option style="font-family: 'Courier New', Courier, monospace;" value="'Courier New', Courier, monospace;">Courier New</option>
                              <option style="font-family: monospace;" value="monospace">Monospace</option>
                              <option style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif" value="Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Cambria</option>
                              <option style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif" value="'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Lucida Sans</option>
                              <option style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" value="Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">IMPACT</option>
                              <option style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" value="'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Segoe UI</option>
                              <option style="font-family: 'Times New Roman', Times, serif;" value="'Times New Roman', Times, serif;">Times New Roman</option>
                              <option style="font-family: Arial, Helvetica, sans-serif;" value="Arial, Helvetica, sans-serif;">Arial</option>
                              <option style="font-family: sans-serif;" value="sans-serif;">Sans Serif</option>
                           </select><br>

                           <label for="textContentSize">Text Size</label> <span class="font-weight-bold" id="textContentSizeDisplay"></span> <br>
                           <input type="range" onchange="$('#textContentSizeDisplay').html($('#textContentSize').val())" class="form-control" id="textContentSize" value="15" min="1" max="100"><br>
                           
                           <label for="textContentColor">Text Color</label> <br>
                           <input type="color" class="form-control" id="textContentColor"><br>

                           <label for="textContentWeight">Font Weight</label> <br>
                           <select class="form-control" id="textContentWeight">
                              <option style="font-weight: 100;" value="100">Thin</option>
                              <option style="font-weight: 200;" value="200">Extra Light</option>
                              <option style="font-weight: 300;" value="300">Light</option>
                              <option style="font-weight: 400;" value="400">Normal</option>
                              <option style="font-weight: 500;" value="500">Medium</option>
                              <option style="font-weight: 600;" value="600">Semi Bold</option>
                              <option style="font-weight: 700;" value="700">Bold</option>
                              <option style="font-weight: 800;" value="800">Extra Bold</option>
                              <option style="font-weight: 900;" value="900">Heavy</option>
                           </select><br>

                           <label for="textContentXPadding">Horizontal Padding</label> <span class="font-weight-bold" id="textContentXPaddingDisplay"></span> <br>
                           <input type="range" onchange="$('#textContentXPaddingDisplay').html($('#textContentXPadding').val())" class="form-control" id="textContentXPadding" value="0" min="0" max="100"><br>
                           <label for="textContentYPadding">Vertical Padding</label> <span class="font-weight-bold" id="textContentYPaddingDisplay"></span> <br>
                           <input type="range" onchange="$('#textContentYPaddingDisplay').html($('#textContentYPadding').val())" class="form-control" id="textContentYPadding" value="0" min="0" max="100"><br>

                           <label for="textContentAlign">Text Align</label><br>
                           <div id="textContentAlignCenter" onclick="textAlignClicked('center')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-align-center"></span></div>
                           <div id="textContentAlignJustify" onclick="textAlignClicked('justify')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-align-justify"></span></div>
                           <div id="textContentAlignStart" onclick="textAlignClicked('start')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-align-left"></span></div>
                           <div id="textContentAlignEnd" onclick="textAlignClicked('end')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-align-right"></span></div>
                           <br><br>

                           <label for="textContentStyle">Text Style</label><br>
                           <div id="textContentStyleNormal" onclick="textStyleClicked('normal')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-font"></span></div>
                           <div id="textContentStyleItalic" onclick="textStyleClicked('italic')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-italic"></span></div>
                           <div id="textContentStyleStrikethrough" onclick="textStyleClicked('line-through')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-strikethrough"></span></div>
                           <div id="textContentStyleUnderline" onclick="textStyleClicked('underline')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-underline"></span></div>
                           <br>

                           <button class="my-3 btn btn-md btn-dark" onclick="addText()">Apply</button>
                        </div>
                     </div>
                  </div>
                  
                  <!-- Text Link -->
                  <div>
                     <div class="card-header">
                        <a class="h4 text-secondary card-link w-100" data-toggle="collapse" href="#textLinkContent">
                           Text Link
                        </a>
                     </div>
                     <div id="textLinkContent" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                           <label for="textLinkContentText" class="">Text</label> <br>
                           <textarea id="textLinkContentText" class="form-control" cols="10" rows="3" placeholder="Enter Text..."></textarea>
                           <span><b>For Recipient Placeholder,</b><br>Use <b>[[NAME]]</b> for the recipient's name<br>Use <b>[[EMAIL]]</b> for the recipient's email</span><br><br>
                           
                           <label for="textLinkContentLink" class=""><span class="fa fa-link"></span> Link</label> <br>
                           <input id="textLinkContentLink" class="form-control" placeholder="http://www.address.com"><br>

                           <label for="textLinkContentFamily">Font Family</label> <br>
                           <select class="form-control" id="textLinkContentFamily">
                              <option style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="Verdana, Geneva, Tahoma, sans-serif;">Verdana</option>
                              <option style="font-family: 'Courier New', Courier, monospace;" value="'Courier New', Courier, monospace;">Courier New</option>
                              <option style="font-family: monospace;" value="monospace">Monospace</option>
                              <option style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif" value="Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">Cambria</option>
                              <option style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif" value="'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">Lucida Sans</option>
                              <option style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif" value="Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">IMPACT</option>
                              <option style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" value="'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Segoe UI</option>
                              <option style="font-family: 'Times New Roman', Times, serif;" value="'Times New Roman', Times, serif;">Times New Roman</option>
                              <option style="font-family: Arial, Helvetica, sans-serif;" value="Arial, Helvetica, sans-serif;">Arial</option>
                              <option style="font-family: sans-serif;" value="sans-serif;">Sans Serif</option>
                           </select><br>

                           <label for="textLinkContentSize">Text Size</label> <span class="font-weight-bold" id="textLinkContentSizeDisplay"></span> <br>
                           <input type="range" onchange="$('#textLinkContentSizeDisplay').html($('#textLinkContentSize').val())" class="form-control" id="textLinkContentSize" value="15" min="1" max="100"><br>
                           
                           <label for="textLinkContentColor">Text Color</label> <br>
                           <input type="color" class="form-control" id="textLinkContentColor"><br>

                           <label for="textLinkContentWeight">Font Weight</label> <br>
                           <select class="form-control" id="textLinkContentWeight">
                              <option style="font-weight: 100;" value="100">Thin</option>
                              <option style="font-weight: 200;" value="200">Extra Light</option>
                              <option style="font-weight: 300;" value="300">Light</option>
                              <option style="font-weight: 400;" value="400">Normal</option>
                              <option style="font-weight: 500;" value="500">Medium</option>
                              <option style="font-weight: 600;" value="600">Semi Bold</option>
                              <option style="font-weight: 700;" value="700">Bold</option>
                              <option style="font-weight: 800;" value="800">Extra Bold</option>
                              <option style="font-weight: 900;" value="900">Heavy</option>
                           </select><br>

                           <label for="textLinkContentXPadding">Horizontal Padding</label> <span class="font-weight-bold" id="textLinkContentXPaddingDisplay"></span> <br>
                           <input type="range" onchange="$('#textLinkContentXPaddingDisplay').html($('#textLinkContentXPadding').val())" class="form-control" id="textLinkContentXPadding" value="2" min="1" max="50"><br>
                           <label for="textLinkContentYPadding">Vertical Padding</label> <span class="font-weight-bold" id="textLinkContentYPaddingDisplay"></span> <br>
                           <input type="range" onchange="$('#textLinkContentYPaddingDisplay').html($('#textLinkContentYPadding').val())" class="form-control" id="textLinkContentYPadding" value="2" min="1" max="50"><br>

                           <label for="textLinkContentAlign">Text Align</label><br>
                           <div id="textLinkContentAlignCenter" onclick="textLinkAlignClicked('center')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-align-center"></span></div>
                           <div id="textLinkContentAlignJustify" onclick="textLinkAlignClicked('justify')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-align-justify"></span></div>
                           <div id="textLinkContentAlignStart" onclick="textLinkAlignClicked('start')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-align-left"></span></div>
                           <div id="textLinkContentAlignEnd" onclick="textLinkAlignClicked('end')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-align-right"></span></div>
                           <br><br>

                           <label for="textLinkContentStyle">Text Style</label><br>
                           <div id="textLinkContentStyleNormal" onclick="textLinkStyleClicked('normal')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-font"></span></div>
                           <div id="textLinkContentStyleItalic" onclick="textLinkStyleClicked('italic')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-italic"></span></div>
                           <div id="textLinkContentStyleStrikethrough" onclick="textLinkStyleClicked('line-through')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-strikethrough"></span></div>
                           <div id="textLinkContentStyleUnderline" onclick="textLinkStyleClicked('underline')" class="btn btn-sm btn-outline-dark cursor-pointer"><span class="fa fa-underline"></span></div>
                           <br>

                           <button class="my-3 btn btn-md btn-dark" onclick="addTextLink()">Apply</button>
                        </div>
                     </div>
                  </div>

                  <!-- Image -->
                  <div>
                     <div class="card-header">
                        <a class="h4 text-secondary card-link w-100" data-toggle="collapse" href="#imageContent">
                           Image
                        </a>
                     </div>
                     <div id="imageContent" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                        
                           <button data-toggle="modal" data-target="#selectImage" onclick="setImageSelector('imgContentSrcDisplay')" class="btn btn-md btn-secondary">Select Image</button>
                           <span class="font-weight-bold" id="imgContentSrcDisplay">No Image</span> <br><br>

                           <label for="imgContentHeight">Image Height</label> <span class="font-weight-bold" id="imgContentHeightDisplay"></span> <br>
                           <input type="range" onchange="$('#imgContentHeightDisplay').html($('#imgContentHeight').val())" class="form-control" id="imgContentHeight" value="100" min="1" max="100"><br>
                           <label for="imgContentWidth">Image Width</label> <span class="font-weight-bold" id="imgContentWidthDisplay"></span> <br>
                           <input type="range" onchange="$('#imgContentWidthDisplay').html($('#imgContentWidth').val())" class="form-control" id="imgContentWidth" value="100" min="1" max="100"><br>

                           <label for="imgContentXPadding">Horizontal Padding</label> <span class="font-weight-bold" id="imgContentXPaddingDisplay"></span> <br>
                           <input type="range" onchange="$('#imgContentXPaddingDisplay').html($('#imgContentXPadding').val())" class="form-control" id="imgContentXPadding" value="0" min="0" max="50"><br>
                           <label for="imgContentYPadding">Vertical Padding</label> <span class="font-weight-bold" id="imgContentYPaddingDisplay"></span> <br>
                           <input type="range" onchange="$('#imgContentYPaddingDisplay').html($('#imgContentYPadding').val())" class="form-control" id="imgContentYPadding" value="0" min="0" max="50"><br>

                           <label for="imgContentAlign">Image Alignment</label> <br>
                           <select class="form-control" id="imgContentAlign">
                              <option value="middle">Middle</option>
                              <option value="left">Left</option>
                              <option value="right">Right</option>
                           </select>

                           <button class="my-3 btn btn-md btn-dark" onclick="addImage()">Apply</button>
                        </div>
                     </div>
                  </div>

                  <!-- Image Link -->
                  <div>
                     <div class="card-header">
                        <a class="h4 text-secondary card-link w-100" data-toggle="collapse" href="#imageLinkContent">
                           Image Link
                        </a>
                     </div>
                     <div id="imageLinkContent" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                           
                           <button data-toggle="modal" data-target="#selectImage" onclick="setImageSelector('imgLinkContentSrcDisplay')" class="btn btn-md btn-secondary">Select Image</button>
                           <span class="font-weight-bold" id="imgLinkContentSrcDisplay">No Image</span> <br><br>

                           <label for="imageLinkContentLink" class=""><span class="fa fa-link"></span> Link</label> <br>
                           <input id="imageLinkContentLink" class="form-control" placeholder="http://www.address.com"><br>

                           <label for="imgLinkContentHeight">Image Height</label> <span class="font-weight-bold" id="imgLinkContentHeightDisplay"></span> <br>
                           <input type="range" onchange="$('#imgLinkContentHeightDisplay').html($('#imgLinkContentHeight').val())" class="form-control" id="imgLinkContentHeight" value="100" min="1" max="100"><br>
                           <label for="imgLinkContentWidth">Image Width</label> <span class="font-weight-bold" id="imgLinkContentWidthDisplay"></span> <br>
                           <input type="range" onchange="$('#imgLinkContentWidthDisplay').html($('#imgLinkContentWidth').val())" class="form-control" id="imgLinkContentWidth" value="100" min="1" max="100"><br>

                           <label for="imgLinkContentXPadding">Horizontal Padding</label> <span class="font-weight-bold" id="imgLinkContentXPaddingDisplay"></span> <br>
                           <input type="range" onchange="$('#imgLinkContentXPaddingDisplay').html($('#imgLinkContentXPadding').val())" class="form-control" id="imgLinkContentXPadding" value="0" min="0" max="50"><br>
                           <label for="imgLinkContentYPadding">Vertical Padding</label> <span class="font-weight-bold" id="imgLinkContentYPaddingDisplay"></span> <br>
                           <input type="range" onchange="$('#imgLinkContentYPaddingDisplay').html($('#imgLinkContentYPadding').val())" class="form-control" id="imgLinkContentYPadding" value="0" min="0" max="50"><br>

                           <label for="imgLinkContentAlign">Image Alignment</label> <br>
                           <select class="form-control" id="imgLinkContentAlign">
                              <option value="middle">Middle</option>
                              <option value="left">Left</option>
                              <option value="right">Right</option>
                           </select>

                           <button class="my-3 btn btn-md btn-dark" onclick="addImageLink()">Apply</button>
                           
                        </div>
                     </div>
                  </div>

                  <!-- Footer -->
                  <div>
                     <div class="card-header">
                        <a class="h4 text-secondary card-link w-100" data-toggle="collapse" href="#footerContent">
                           Default Footer
                        </a>
                     </div>
                     <div id="footerContent" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                           <button class="my-3 btn btn-lg btn-dark" onclick="addFooter()">Add Default Footer</button>
                        </div>
                     </div>
                  </div>

               </div>
            </div>

         </div>

         <div class="mb-5">
            <?php include 'footer.php'; ?>
         </div>

      </aside>

   </main>

   <!-- Modal -->
   <div class="modal fade" id="previewBody" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="exampleModalLongTitle">
                  Preview Template
               </h4>

               <button type="button" class="float-left close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <div class="modal-header">
               <button class="btn btn-success btn-md" onclick="updateTemplate()"> <span class="fa fa-save"></span> Update Template </button>
            </div>

            <div class="modal-body table-responsive w-100" id="bodyPreview" style="height: 1000px;" >
            </div>

            <div class="modal-footer">
               <button class="btn btn-success btn-md" onclick="updateTemplate()"> <span class="fa fa-save"></span> Update Template </button>
            </div>

         </div>
      </div>
   </div>

   <div class="modal fade" id="selectImage" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="exampleModalLongTitle">
                  Select Image
               </h4>

               <button type="button" class="float-left close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>

            <div class="modal-body row no-gutters" id="" >
               <?php
                  if (isset($images) && is_array($images)) {
                     foreach ($images as $image) {
                        $url = $image["image_url"];
                        $name = $image["image_name"];
                        $id = $image["image_id"];
                        echo '
                        <div class="col-lg-4 p-1 col-12 my-2">
                           <div class="card">
                              <img src="'.$url.'" alt="Template Image" width="100%" height="100%">
                              <hr>
                              <p class="ml-2 h6 font-weight-normal my-auto">
                                 '.$name.'
                                 <input class="btn bnt-sm btn-secondary mb-2 mr-2 float-right" type="button" value="Select" data-dismiss="modal" aria-label="Close" onclick="selectThisImage(\''.$name.'\',\''.$url.'\');" />
                                 <span class="clearfix"></span>
                              </p>
                           </div>
                        </div>
                        ';
                     }
                     
                  } else {
                     echo '
                     <div class="col-lg-12 p-1 col-12 my-2">
                        <div class="alert alert-secondary w-100">
                           <span class="fa fa-info-circle"></span>
                           There are no Images.
                        </div>
                     </div>
                     ';
                  }
               ?>
            </div>

         </div>
      </div>
   </div>
   
   
   
   <!-- 
      <form action="edit_template.php" method="POST" class="text-dark">
      
         <input type="hidden" name="template_id" value="<?php //echo $templateId; ?>">
         <input type="hidden" name="template_type" value="<?php //echo $templateType; ?>">

         <br>
         <label for="description" class="text-lg">Description:</label>
         <textarea name="description" class="form-control" cols="30" rows="3"><?php //echo $description; ?></textarea>

         <br>
         <label for="body" class="text-lg">Body:</label>
         <textarea name="body" id="code_body" cols="30" rows="20" class="form-control text-md"><?php //echo $body; ?></textarea>

         <br>
         <a href="templates.php" type="button" class="float-left btn btn-danger">
            <span class="fa fa-times"></span>
            Cancel
         </a>
         <div class="float-right">
            <button type="button" class="btn obejor-bg-dark text-white" onclick="previewCode();" data-toggle="modal" data-target="#previewBody">
               Preview
            </button>
            <button type="submit" name="submit_update_template" class="btn obejor-bg-dark text-white">
               <span class="fa fa-save"></span>
               Update
            </button>
            <button type="submit" name="submit_save_as_draft" class="btn obejor-bg-dark text-white">
               <span class="fa fa-save"></span>
               Save As Draft
            </button>
         </div>
         
      </form>
   -->

</body>
</html>