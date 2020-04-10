<?php

include_once 'scripts/auth.php';

include_once 'scripts/restrict_admin.php';

include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "settings - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$inputs = $_POST;

if (isset($inputs['save_setting'])) {

   // Get Inputs
   $pref = $inputs['pref'];
   $options = $inputs['pref_options'];
	$value = $inputs['pref_value'];

   // Validate Inputs & Sanitize Inputs

   include 'scripts/validation.php';
   $validation = new Validation();

   if ($validation->validateName($pref,2,50) == true) {
		$pref = $validation->sanitize($pref);
	} else {
		exit(header('location: settings.php?addpref=false&errmsg=Invalid Preference'));
	}
	
	if ($validation->validateText($options) == true) {
      $options = $validation->sanitize($options);
	} else {
		exit(header('location: settings.php?addpref=false&errmsg=Invalid Preference Options'));
	}

	if ($validation->validateName($value,2,50) == true) {
		$value = $validation->sanitize($value);
	} else {
		exit(header('location: settings.php?addpref=false&errmsg=Invalid Preference Value'));
	}
	
	include 'scripts/dbmodel.php';
	$model = new DBModel();
	$add = $model->addNewPreference($pref,$options,$value);

	if ($add == true) {
		header('location: settings.php?addpref=true');
	} else {
		header('location: users.php?addpref=false&errmsg=Preference is not added');
	}

}

if (isset($inputs['update_setting'])) {

   // Get Inputs
   $pref = $inputs['edit_pref'];
   $options = $inputs['edit_pref_options'];
	$value = $inputs['edit_pref_value'];
	$prefId = $inputs['edit_pref_id'];

   // Validate Inputs & Sanitize Inputs

   include 'scripts/validation.php';
   $validation = new Validation();

   if ($validation->validateName($pref,2,50) == true) {
		$pref = $validation->sanitize($pref);
	} else {
		exit(header('location: settings.php?editpref=false&errmsg=Invalid Preference'));
	}
	
	if ($validation->validateText($options) == true) {
      $options = $validation->sanitize($options);
	} else {
		exit(header('location: settings.php?editpref=false&errmsg=Invalid Preference Options'));
	}

	if ($validation->validateName($value,2,50) == true) {
		$value = $validation->sanitize($value);
	} else {
		exit(header('location: settings.php?editpref=false&errmsg=Invalid Preference Value'));
	}
	
	include 'scripts/dbmodel.php';
	$model = new DBModel();
	$add = $model->updatePreference($prefId,$pref,$options,$value);

	if ($add == true) {
		header('location: settings.php?editpref=true');
	} else {
		header('location: users.php?editpref=false&errmsg=Preference is not updated');
	}

}

include_once 'scripts/dbmodel.php';
$model = new DBModel();
$prefs = $model->getAllPreferences();
if ($prefs['flag'] == true) {
	$prefEmpty = false;
	$prefs = $prefs['data'];
} else {
	$prefEmpty = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Settings | BulkMailing</title>

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

	<?php $nav = "SETTINGS"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Settings

					<!-- <button class="btn mt-4 obejor-bg-dark text-white float-right" data-toggle="modal" data-target="#addSetting">
						<span class="fa fa-plus"></span>
						Add Setting
					</button> -->

				</div>


			</div>

			<div class="container">

				<?php 
					if (isset($_GET['addpref']) == true && $_GET['addpref'] == true) {
						echo "
						<div class='alert alert-success alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Success!</strong> Setting added successfully.
						</div>
						";
					} elseif (isset($_GET['addpref']) == true && $_GET['addpref'] == false) {
						echo "
						<div class='alert alert-danger alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Error!</strong> {$_GET['errmsg']}
						</div>
						";
					}

					if (isset($_GET['editpref']) == true && $_GET['editpref'] == true) {
						echo "
						<div class='alert alert-success alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Success!</strong> Setting updated successfully.
						</div>
						";
					} elseif (isset($_GET['editpref']) == true && $_GET['editpref'] == false) {
						echo "
						<div class='alert alert-danger alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Error!</strong> {$_GET['errmsg']}
						</div>
						";
					}
				?>

				<div class="table-responsive">
					<table class="table table-bordered text-center text-secondary">
						<thead class="obejor-text-dark">
							<tr>
								<th>#</th>
								<th>Preference</th>
								<th>Options</th>
								<th>Value</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if ($prefEmpty == false) {
									$count = 1;

									foreach ($prefs as $pref) {
										echo "<tr class='text-dark'>
											<td>{$count}</td>
											<td>{$pref['preference']}</td>
											<td>{$pref['options']}</td>
											<td>{$pref['value']}</td>
											<td>
												<button class='btn btn-sm obejor-bg-dark text-light' data-toggle='modal' data-target='#editSetting' onclick=\"setupEdit('{$pref['preference_id']}','{$pref['preference']}','{$pref['options']}','{$pref['value']}')\" ><span class='fa fa-edit'></span> Edit</button>
											</td>
										</tr>";

										$count++;
									}
								} else {
									echo '<tr>
										<td colspan="5">No Settings</td>
									</tr>';
								} 
							?>
						</tbody>
					</table>
				</div>
				
			</div>
			
		</section>

		
		<!-- Modal -->
		<div class="modal fade" id="addSetting" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Add Setting</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form action="settings.php" method="post">
							
							<label for="pref" class="text-lg"> <span class="fa fa-cog"></span> Preference:</label>
							<input type="text" id="pref" name="pref" class="form-control" required>

							<br>
							<label for="pref_options" class="text-lg"> <span class="fa fa-tags"></span> Preference Options:</label>
							<input type="text" id="pref_options" name="pref_options" class="form-control" required>
							<small class="obejor-text-dark">Please separate options with comma (,)</small>
							<br>

							<br>
							<label for="pref_value" class="text-lg"> <span class="fa fa-tag"></span> Preference Value:</label>
							<input type="text" id="pref_value" name="pref_value" class="form-control" required>

							<br>
							<input type="submit" name="save_setting" value="Save" class="btn btn-lg obejor-bg-dark text-white d-block mx-auto px-5 mt-3">

						</form>
					</div>

				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="editSetting" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit Setting</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form action="settings.php" method="post">
							
							<label for="edit_pref" class="text-lg"> <span class="fa fa-cog"></span> Preference:</label>
							<input type="text" id="edit_pref" name="edit_pref" class="form-control" required>

							<br>
							<label for="edit_pref_options" class="text-lg"> <span class="fa fa-tags"></span> Preference Options:</label>
							<input type="text" id="edit_pref_options" name="edit_pref_options" class="form-control" required>
							<small class="obejor-text-dark">Please separate options with comma (,)</small>
							<br>

							<br>
							<label for="edit_pref_value" class="text-lg"> <span class="fa fa-tag"></span> Preference Value:</label>
							<input type="text" id="edit_pref_value" name="edit_pref_value" class="form-control" required>

							<input type="hidden" name="edit_pref_id" id="edit_pref_id">

							<br>
							<input type="submit" name="update_setting" value="Update" class="btn btn-lg obejor-bg-dark text-white d-block mx-auto px-5 mt-3">

						</form>
					</div>

				</div>
			</div>
		</div>

	</main>

	<?php include 'footer.php'; ?>

</body>
</html>