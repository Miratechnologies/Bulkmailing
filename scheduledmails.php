<?php

include_once 'scripts/auth.php';

include_once 'scripts/restrict_admin.php';
// session_start();
include 'scripts/dbmodel.php';
$model = new DBModel();

$_SESSION['USER.ACTIVITY'][] = "scheduled list - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$mails = $model->getAllScheduledEmail();

if ($mails['flag'] == true) {
	$empty = false;
	$mails = $mails['data'];
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
	<title>Scheduled Mails | BulkMailing</title>

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

		<?php $nav = "CAMPAIGN"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="bg-white p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Scheduled Mails
					<div class="float-lg-right float-sm-none btn obejor-bg-dark text-white my-lg-3 cursor-pointer" onclick="location.href='campaign.email.schedule.php';">Schedule another Mail</div>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="container">

				<?php 
					if (isset($_GET['update']) && $_GET['update'] == 'true') {
						echo "
						<div class='alert alert-success alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Success!</strong> The scheduled mail was {$_GET['action']}.
						</div>
						";
					} elseif (isset($_GET['update']) && $_GET['update'] == 'false') {
						echo "
						<div class='alert alert-danger alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Sorry!</strong> The scheduled mail was not {$_GET['action']}.
						</div>
						";
					}
				?>
				
				<div class="table-responsive">
					<table class="table table-bordered text-center text-secondary">
						<thead class="obejor-text-dark">
							<tr>
								<th>#</th>
								<th>Subject</th>
								<th>Sender</th>
								<th>Date&nbsp;Scheduled</th>
								<th>Scheduled&nbsp;Date</th>
								<th>Scheduled&nbsp;Time</th>
								<!-- <th>Intervals</th> -->
								<!-- <th>Last&nbsp;Sent</th> -->
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if ($empty == false) {
									$count = 1;

									foreach ($mails as $mail) {

										// if status is active
										if ($mail['status'] == "ACTIVE") {
											// it can be set to cancel the schedule
											$action = "<button class='btn btn-sm obejor-bg-dark text-light' onclick=\"location.href='scripts/update_schedule_status.php?id={$mail['scheduler_id']}&status=CANCEL'\">Cancel</button>";
										}
										// else if the status is cancelled
										elseif ($mail['status'] == "CANCEL") {
											// it can be set back to activate
											$action = "<button class='btn btn-sm obejor-bg-dark text-light' onclick=\"location.href='scripts/update_schedule_status.php?id={$mail['scheduler_id']}&status=ACTIVE'\">Activate</button>";
										}
										// else the status is now either SENT or EXPIRED, hence no action
										else {
											$action = "";
										}

										$date1 = date_create($mail['date_scheduled']);
										$date1 = date_format($date1, "d/m/Y");

										$date2 = date_create($mail['schedule_date']);
										$date2 = date_format($date2, "d/m/Y");

										$date3 = date_create($mail['schedule_time']);
										$date3 = date_format($date3, "h:ia");

										// $date4 = date_create($mail['last_sent']);
										// $date4 = date_format($date4, "d/m/Y h:ia");

										echo "<tr class='text-dark'>
											<td>{$count}</td>
											<td>{$mail['subject']}</td>
											<td>{$mail['sender']}</td>
											<td>{$date1}</td>
											<td>{$date2}</td>
											<td>{$date3}</td>
											<td>{$mail['status']}</td>
											<td>
												{$action}
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