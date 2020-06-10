<?php

include_once 'scripts/auth.php';

include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "statistics - " . date("d/m/Y h:i a");
include 'scripts/log.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Dashboard | BulkMailing</title>

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
	<script src="assets/js/chart.min.js"></script>
	<script src="assets/js/utils.js"></script>
	<script src="assets/js/dashboard.js"></script>
   <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="bg-white">

	<?php include 'header.php'; ?>
	
   <main class="row no-gutters">

		<?php $nav = "STATISTICS"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Statistics
					<div class="btn-group">
						<button class="btn obejor-bg-dark text-light border-right" onclick="showEmailStats();">EMAIL</button>
						<button class="btn obejor- bg-secondary text-light border-left" onclick="showSMSStats();">SMS</button>
					</div>

				</div>
			</div>

			<div class="col-lg-8 col-sm-12 h-auto mx-auto my-1" id="statistics">

				<div id="emailStat" class="my-3 border border-warning">
					<canvas id="email_canvas" height="200px"></canvas>

					<br>

					<div class="form-row my-2 mx-2">
						<div class="input-group col-lg-5 col-12 my-1">
							<div class="input-group-prepend">
								<span class="input-group-text text-light obejor-bg-dark">
									<span class="fa fa-calendar"></span>&nbsp;Start Date
								</span>
							</div>
							<input id="emailStartDate" type="date" class="form-control input-group-append">
						</div>
						<div class="input-group col-lg-5 col-12 my-1">
							<div class="input-group-prepend">
								<span class="input-group-text text-light obejor-bg-dark">
									<span class="fa fa-calendar"></span>&nbsp;End Date
								</span>
							</div>
							<input id="emailEndDate" type="date" class="form-control input-group-append">
						</div>
						<div class="col-lg-2 col-12 my-1">
							<button class="btn w-100 obejor-bg-dark text-white" onclick="getEmailStatisticsByDate();">Load</button>
						</div>
					</div>

				</div>

				<div id="smsStat" class="my-3 border border-muted">
					<canvas id="sms_canvas" height="200px"></canvas>

					<br>

					<div class="form-row my-2 mx-2">
						<div class="input-group col-lg-5 col-12 my-1">
							<div class="input-group-prepend">
								<span class="input-group-text text-light obejor- bg-secondary">
									<span class="fa fa-calendar"></span>&nbsp;Start Date
								</span>
							</div>
							<input id="smsStartDate" type="date" class="form-control input-group-append">
						</div>
						<div class="input-group col-lg-5 col-12 my-1">
							<div class="input-group-prepend">
								<span class="input-group-text text-light obejor- bg-secondary">
									<span class="fa fa-calendar"></span>&nbsp;End Date
								</span>
							</div>
							<input id="smsEndDate" type="date" class="form-control input-group-append">
						</div>
						<div class="col-lg-2 col-12 my-1">
							<button class="btn w-100 obejor- bg-secondary text-white" onclick="getSMSStatisticsByDate();">Load</button>
						</div>
					</div>

				</div>

			</div>

		</section>

	</main>

	<?php include 'footer.php'; ?>

</body>
</html>