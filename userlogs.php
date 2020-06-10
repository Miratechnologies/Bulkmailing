<?php

include_once 'scripts/auth.php';

include_once 'scripts/restrict_admin.php';
// session_start();
include 'scripts/dbmodel.php';
$model = new DBModel();

$_SESSION['USER.ACTIVITY'][] = "user log - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$inputs = $_GET;
if (isset($inputs['user'])) {

   // Get Inputs
   $userId = $inputs['user'];
   
   // Validate Inputs & Sanitize Inputs
   include 'scripts/validation.php';
   $validation = new Validation();

   if ($validation->validateEmail($userId,0,50) == true) {
		$userId = $validation->sanitize($userId);

		$userLogs = $model->getUserLog($userId);
		if ($userLogs['flag'] == true) {
			$empty = false;
			$logs = $userLogs['data'];
		} else {
			$empty = true;
		}

	} else {
		exit(header('location: users.php?errmsg=Invalid Email'));
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>User Logs | BulkMailing</title>

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

		<?php $nav = "USERS"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="bg-white p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					User Logs
				</div>
			</div>

			<div class="container">

				<div class="my-1 border p-1 rounded">
					<div class="form-row">
						<!-- filter section -->
						<div class="col-lg-4 col-sm-12 input-group my-1">
							<div class="input-group-prepend">
								<span class="btn obejor-bg-dark text-light font-weight-bold">
									<span class="fa fa-calendar"></span>
									Filter by Date
								</span>
							</div>
							
							<input name="filter" type="date" class="input-group-append text-md form-control w-0 border-muted"/>
						</div>

					</div>
				</div>

				<?php 
					if (isset($_GET['adduser']) == true) {
						echo "
						<div class='alert alert-success alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Success!</strong> User created successfully.
							<br>
							Please copy the login details
							<b>Email: </b>{$_GET['loginEmail']} & <b>Password: </b>{$_GET['loginPassword']}
						</div>
						";
					}
				?>
				
				<div class="table-responsive">
					<table class="table table-bordered text-center text-secondary">
						<thead class="obejor-text-dark">
							<tr>
								<th>#</th>
								<th>Email</th>
								<th>Logged In</th>
								<th>Logged Out</th>
								<th>IP Address</th>
								<th>Activities</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if ($empty == false) {
									$count = 1;

									foreach ($logs as $log) {

										$activities = str_replace(',','<br>',$log['activities']);

										echo "<tr class='text-dark'>
											<td>{$count}</td>
											<td>{$log['user_id']}</td>
											<td>{$log['date_logged_in']}</td>
											<td>{$log['date_logged_out']}</td>
											<td>{$log['ip_address']}</td>
											<td>{$activities}</td>
										</tr>";

										$count++;
									}
								} else {
									echo '<tr>
										<td colspan="6">No logs for this user</td>
									</tr>';
								} 
							?>
						</tbody>
					</table>
				</div>

			</div>

			
		</section>

	</main>

	<?php include 'footer.php'; ?>

</body>
</html>