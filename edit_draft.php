<?php

include_once 'scripts/auth.php';
include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "edit draft - " . date("d/m/Y h:i a");
include 'scripts/log.php';

// Getting the details of the page for editing
if ($_GET != []) {

   $inputs = $_GET;

   if (isset($inputs['draft'])) {

      // Get Inputs
      $draftId = $inputs['draft'];

      $get = $model->getThisDraft($draftId);

      if ($get['flag'] == true) {
         $description = $get['data'][0]['description'];
         $body = $get['data'][0]['body'];
         $draftType = $get['data'][0]['draft_type'];
      } else {
         header('location: drafts.php');
      }
   } else {
      header('location: drafts.php');
   }

}

// Updating the template
if ($_POST != []) {

   $inputs = $_POST;

   if (isset($inputs['submit_update_draft'])) {

      // Get Inputs
      $draftId = $inputs['draft_id'];
      $description = $inputs['description'];
      $body = $inputs['body'];

      // Validate Inputs & Sanitize Inputs

      include 'scripts/validation.php';
      $validation = new Validation();

      if ($validation->validateText($description) == true) {
         $description = $validation->sanitize($description);
         // $body = json_encode($body);

         include 'scripts/dbmodel.php';
         $model = new DBModel();
         $update = $model->updateDraft($description,$body,$draftId);

         if ($update == true) {
            header('location: drafts.php?updatedraft=true');
         } else {
            header('location: drafts.php?updatedraft=false');
         }
      } else {
         header('location: drafts.php?updatedraft=false');
      }

   } else {
      header('location: drafts.php');
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Edit Draft | BulkMailing</title>

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

      <?php $nav = "DRAFTS"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-sm-auto text-dark display-4">
               Edit Draft
               <hr>
				</div>
			</div>

			<div class="container">

            <form action="edit_draft.php" method="POST" class="text-dark">
            
               <input type="hidden" name="draft_id" value="<?php echo $draftId; ?>">
               <input type="hidden" name="draft_type" value="<?php echo $draftType; ?>">

               <br>
               <label for="description" class="text-lg">Description:</label>
               <textarea name="description" class="form-control" cols="30" rows="3"><?php echo $description; ?></textarea>

               <br>
               <label for="body" class="text-lg">Body:</label>
               <textarea name="body" id="code_body" cols="30" rows="20" class="form-control text-md"><?php echo $body; ?></textarea>

               <br>
               <a href="drafts.php" type="button" class="float-left btn btn-danger">
                  <span class="fa fa-times"></span>
                  Cancel
               </a>
               <div class="float-right">
                  <button type="button" class="btn obejor-bg-dark text-white" onclick="previewCode();" data-toggle="modal" data-target="#previewBody">
                     Preview
                  </button>
                  <button type="submit" name="submit_update_draft" class="btn obejor-bg-dark text-white">
                     <span class="fa fa-save"></span>
                     Update
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