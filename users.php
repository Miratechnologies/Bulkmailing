<?php

include_once 'scripts/auth.php';

include_once 'scripts/restrict_admin.php';
// session_start();
include 'scripts/dbmodel.php';
$model = new DBModel();

$_SESSION['USER.ACTIVITY'][] = "users - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$users = $model->getAllUsers();

if ($users['flag'] == true) {
	$empty = false;
	$users = $users['data'];
} else {
	$empty = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Users | BulkMailing</title>

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
					Users
				</div>
			</div>

			<div class="container">

				<div class="my-1 border p-1 rounded">
					<div class="form-row">
						<!-- filter section -->
						<!-- <div class="col-lg-3 col-sm-12 input-group my-1">
							<div class="input-group-prepend">
								<span class="btn obejor-bg-dark text-light font-weight-bold">
									<span class="fa fa-filter"></span>
									Filter Role
								</span>
							</div>
							
							<select name="filter" class="input-group-append text-md form-control w-0 border-muted">
								<option value="ALL">All</option>
								<option value="CUSTOMER">Admin</option>
								<option value="SUBSCRIBER">Subscriber</option>
							</select>
						</div> -->

						<!-- Import Section -->
						<div class="col-lg-12 col-12 my-1">
							<a href="add_user.php" class="btn btn-sm obejor-bg-dark text-white text-lg float-right">
								<span class="fa fa-plus"></span>
								Add User
							</a>
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
								<th>Firstname</th>
								<th>Lastname</th>
								<th>Email</th>
								<th>Telephone</th>
								<th>Role</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if ($empty == false) {
									$count = 1;

									foreach ($users as $user) {

										if ($user['status'] == "ACTIVE") {
											$status = "<button class='btn btn-sm obejor-bg-dark text-light' onclick='blockUser({$user['auth_id']});'>Block User</button>";
										} else {
											$status = "<button class='btn btn-sm obejor-bg-dark text-light' onclick='activateUser({$user['auth_id']});'>Activate User</button>";
										}

										echo "<tr class='text-dark'>
											<td>{$count}</td>
											<td>{$user['firstname']}</td>
											<td>{$user['lastname']}</td>
											<td>{$user['email']}</td>
											<td>{$user['telephone']}</td>
											<td>{$user['role']}</td>
											<td>
												{$status}
												<a href=\"userlogs.php?user={$user['email']}\" class='btn btn-sm obejor-bg-dark text-light'><span class='fa fa-table'></span> View Log</a>
											</td>
										</tr>";

										$count++;
									}
								} else {
									echo '<tr>
										<td colspan="7">No User Exists</td>
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