<?php

include_once 'scripts/auth.php';

include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "add template - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$inputs = $_POST;
if (isset($inputs['submit_add_template'])) {

   // Get Inputs
   $template_type = $inputs['type'];
   $description = $inputs['description'];
   $body = $inputs['body'];

   // Validate Inputs & Sanitize Inputs

   include 'scripts/validation.php';
   $validation = new Validation();

   if ($validation->validateText($description) == true) {
      $description = $validation->sanitize($description);

      $add = $model->addTemplate($template_type,$description,$body);

      if ($add == true) {
         header('location: templates.php?addtemplate=true');
      } else {
         header('location: templates.php?addtemplate=false');
      }
   } else {
      header('location: templates.php?addtemplate=false');
   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Add Template | BulkMailing</title>

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
               Add Template
               <hr>
				</div>
			</div>

			<div class="container">

            <form action="add_template.php" method="POST" class="text-dark">
               <label for="type" class="text-lg">Template Type:</label>
               <select name="type" class="input-group-append text-md form-control w-0 border-muted">
                  <option value="EMAIL">Email</option>
                  <option value="SMS">SMS</option>
               </select>

               <br>
               <label for="description" class="text-lg">Description:</label>
               <textarea name="description" class="form-control" cols="30" rows="3"></textarea>

               <br>
               <label for="body" class="text-lg">Body:</label>
               <textarea name="body" id="code_body" cols="30" rows="20" class="form-control text-md"></textarea>

               <br>
               <div class="float-right">
                  <button type="button" class="btn obejor-bg-dark text-white" onclick="previewCode();" data-toggle="modal" data-target="#previewBody">
                     Preview
                  </button>
                  <button type="submit" name="submit_add_template" class="btn obejor-bg-dark text-white">
                     <span class="fa fa-save"></span>
                     Save
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