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
      $description = $inputs['description'];
      $body = $inputs['body'];

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

   } elseif (isset($inputs['submit_save_as_draft'])) {

      // Get Inputs
      $templateId = $inputs['template_id'];
      $templateType = $inputs['template_type'];
      $description = $inputs['description'];
      $body = $inputs['body'];

      // Validate Inputs & Sanitize Inputs

      include 'scripts/validation.php';
      $validation = new Validation();

      if ($validation->validateText($description) == true) {
         $description = $validation->sanitize($description);

         // update the template record
         $update = $model->updateTemplate($description,$body,$templateId);
         // add the template to the draft
         $add = $model->addDraft($templateType,$description,$body);

         if ($add == true) {
            header('location: drafts.php?adddraft=true');
         } else {
            header('location: templates.php?adddraft=false');
         }
      } else {
         header('location: templates.php?adddraft=false');
      }
   } else {
      header('location: templates.php');
   }
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
   <link rel="stylesheet" href="assets/css/main.css">
   
</head>
<body class="bg-white">

	<?php include 'header.php'; ?>

   <main class="row no-gutters">

      <?php $nav = "TEMPLATES"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-sm-auto text-dark display-4">
               Edit Template
               <hr>
				</div>
			</div>

			<div class="container">

            <form action="edit_template.php" method="POST" class="text-dark">
            
               <input type="hidden" name="template_id" value="<?php echo $templateId; ?>">
               <input type="hidden" name="template_type" value="<?php echo $templateType; ?>">

               <br>
               <label for="description" class="text-lg">Description:</label>
               <textarea name="description" class="form-control" cols="30" rows="3"><?php echo $description; ?></textarea>

               <br>
               <label for="body" class="text-lg">Body:</label>
               <textarea name="body" id="code_body" cols="30" rows="20" class="form-control text-md"><?php echo $body; ?></textarea>

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
            
            <!-- Modal -->
            <div class="modal fade" id="previewBody" tabindex="-1" role="dialog" aria-hidden="true">
               <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Preview Body</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>

                     <div class="modal-body table-responsive w-100" id="bodyPreview" style="height: 1000px;" >
                     </div>

                  </div>
               </div>
            </div>
				
			</div>
			
		</section>

	</main>

	<?php include 'footer.php'; ?>

</body>
</html>