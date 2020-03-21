<?php

include_once 'scripts/auth.php';

include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "campaign - " . date("d/m/Y h:i a");
include 'scripts/log.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Campaigns | BulkMailing</title>

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

		<?php $nav = "CAMPAIGN"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Campaign
				</div>
				<hr>
			</div>

			<div class="container">

				<div class="col-12 mx-auto card my-5">
					<div class="card-body text-lg text-center">

						<div class="row my-5">
							<div class="col-lg-4 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" onclick="location.href='campaign.email.php';">
								<span class="fa fa-4x fa-envelope"></span> <br>
								<span class="obejor-text-dark text-lg">EMAIL</span>
							</div>
							
							<div class="col-lg-4 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" onclick="location.href='campaign.sms.php';">
								<span class="fa fa-4x fa-comment"></span> <br>
								<span class="obejor-text-dark text-lg">SMS</span>
							</div>
							
							<div class="col-lg-4 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" onclick="location.href='campaign.email.schedule.php';">
								<span class="fa fa-4x fa-history"></span> <br>
								<span class="obejor-text-dark text-lg">SCHEDULE EMAIL</span>
							</div>

							<?php
								$role = $_SESSION['USER.ROLE'];

								if ($role == "ADMIN") {
									echo '
									<div class="col-6 mx-auto border my -1 p-5 obejor-text-dark cursor-pointer" onclick="location.href=\'authorize_campaign.php\';">
										<span class="fa fa-4x fa-check"></span> <br>
										<span class="obejor-text-dark text-lg">AUTHORIZE CAMPAIGN</span>
									</div>

									<div class="col-6 mx-auto border my -1 p-5 obejor-text-dark cursor-pointer" onclick="location.href=\'scheduledmails.php\';">
										<span class="fa fa-4x fa-list"></span> <br>
										<span class="obejor-text-dark text-lg">SCHEDULED EMAIL LIST</span>
									</div>
									';
								}
							?>

							

						</div>

					</div>
				</div>

			</div>
			
		</section>

	</main>

	<?php include 'footer.php'; ?>

</body>
</html>