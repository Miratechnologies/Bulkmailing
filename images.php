<?php

	include_once 'scripts/auth.php';
	include 'scripts/dbmodel.php';
	$model = new DBModel();
	// session_start();
	$_SESSION['USER.ACTIVITY'][] = "Images - " . date("d/m/Y h:i a");
	include 'scripts/log.php';
	
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
	<title>Images | BulkMailing</title>

	<link rel="shortcut icon" href="assets/imgs/favicon.png" type="image/x-icon"><!-- Jquery -->
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

		<?php $nav = "IMAGES"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Images
				</div>
			</div>

			<div class="container">

				<div class="my-1 border p-1 rounded">
					<div class="form-row">
						
						<!-- Import Section -->
						<div class="col-lg-12 col-12">
							<button class="btn btn-sm obejor-bg-dark text-light text-md float-right my-1 mt-lg-2 mr-lg-2" data-toggle="modal" data-target="#addImage">
								<span class="fa fa-plus-circle"></span>
								Add Image
							</button>
						</div>
					</div>
				</div>
				
				
			</div>

			<div class="container">
				<div class="my-lg-3 my-1 row no-gutters">

				<!-- error/success messages -->
				<?php
					if (isset($_GET['status']) == true && $_GET['status'] == 'success') {
						$msg = isset($_GET['msg']) == true ? $_GET['msg'] : "<strong>Success!</strong> Image was uploaded successfully." ;
						echo "
						<div class='alert w-100 alert-success alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							{$msg}
						</div>
						";
					} elseif (isset($_GET['status']) == true && $_GET['status'] == 'error') {
						$msg = isset($_GET['msg']) == true ? $_GET['msg'] : "<strong>Sorry!</strong> Image was not uploaded." ;
						echo "
						<div class='alert w-100 alert-danger alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							{$msg}
						</div>
						";
					}
				?>

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
										<a href="scripts/delete_image.php?image='.$id.'"><span class="btn bnt-sm btn-danger p-1 my-2 mx-2 cursor-pointer float-right fa fa-trash"></span></a>
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
			
		</section>

		<!-- Modal -->
		<div class="modal fade" id="addImage" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Add Image</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form action="scripts/upload_images.php" method="post" enctype="multipart/form-data">
							
							<label for="image" class="text-lg">Select Image</label> <br>
							<input type="file" accept="image/*" id="image" name="image" clas s="form-control" required>
							<br><br>

							<label for="image_name" class="text-lg">Image Name</label> <br>
							<input type="text" id="image_name" minlength="1" maxlength="50" name="image_name" class="form-control" required>
							<br>

							<br>
							<input type="submit" name="uploadImage" value="Upload" class="btn btn-lg obejor-bg-dark text-white d-block mx-auto px-5 mt-3">

						</form>
					</div>

				</div>
			</div>
		</div>

	</main>

	<?php include 'footer.php'; ?>

</body>
</html>