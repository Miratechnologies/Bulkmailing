<?php

	include_once 'scripts/auth.php';
	include 'scripts/dbmodel.php';
	$model = new DBModel();
	// session_start();
	$_SESSION['USER.ACTIVITY'][] = "profile - " . date("d/m/Y h:i a");
	include 'scripts/log.php';
	
	$get = $model->getUserDetail($_SESSION['USER.EMAIL']);

	if ($get['flag'] == true) {
		$data = $get['data'][0];

		$firstname = $data['firstname'];
		$lastname = $data['lastname'];
		$email = $data['email'];
		$telephone = $data['telephone'];
	} else {
		session_unset();
		session_destroy();

		exit(header('location: index.php'));
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Profile | BulkMailing</title>

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

		<?php $nav = "PROFILE"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
				<span class="fa fa-user-o"></span>
					My Profile
				</div>
				<hr>
			</div>

			<div class="container">

				<div class="col-lg-8 col-12 mx-auto card">
					<div class="card-body text-lg text-center">

						<div class="row my-5">
							<div class="col-lg-5 mx-auto border my-1">
								<span class="fa fa-user"></span>
								<strong>Firstname</strong> <br>
								<?php echo $firstname; ?>
							</div>
							
							<div class="col-lg-5 mx-auto border my-1">
								<span class="fa fa-user"></span>
								<strong>Lastname</strong> <br>
								<?php echo $lastname; ?>
							</div>
						</div>

						<div class="row my-5">
							<div class="col-lg-5 mx-auto border my-1">
								<span class="fa fa-envelope"></span>
								<strong>Email</strong> <br>
								<?php echo $email; ?>
							</div>
							
							<div class="col-lg-5 mx-auto border my-1">
								<span class="fa fa-phone"></span>
								<strong>Phone Number</strong> <br>
								<?php echo $telephone; ?>
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