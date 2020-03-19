<?php

include_once 'scripts/auth.php';

include_once 'scripts/restrict_admin.php';
// session_start();
include 'scripts/dbmodel.php';
$model = new DBModel();

$_SESSION['USER.ACTIVITY'][] = "authorize campaigns - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$mails = $model->getAllPendingEmailCampaign();

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

			<div class="bg-white p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Pending Mail Campaigns
					<!-- <div class="float-lg-right float-sm-none btn obejor-bg-dark text-white my-lg-3 cursor-pointer" onclick="location.href='campaign.email.schedule.php';">Schedule another Mail</div> -->
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="container">

				<?php 
					if (isset($_GET['update']) && $_GET['update'] == 'true') {
						echo "
						<div class='alert alert-success alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Success!</strong> The mail campaign was {$_GET['action']}.
						</div>
						";
					} elseif (isset($_GET['update']) && $_GET['update'] == 'false') {
						echo "
						<div class='alert alert-danger alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Sorry!</strong> The mail campaign was not {$_GET['action']}.
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
								<th>Recipients</th>
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
										if ($mail['status'] == "Pending") {
											// it can be set to cancel the schedule
											$action = "<button class='btn btn-sm obejor-bg-dark text-light' onclick=\"location.href='scripts/send_mail.php?action=send&id={$mail['mail_id']}&status=Authorize'\">Authorize</button>";
										}
										else {
											$action = "";
										}

										echo "<tr class='text-dark'>
											<td>{$count}</td>
											<td>{$mail['subject']}</td>
											<td>{$mail['sender']}</td>
											<td>{$mail['recipients']}</td>
											<td>{$mail['status']}</td>
											<td>
												{$action}
											</td>
										</tr>";

										$count++;
									}
								} else {
									echo '<tr>
										<td colspan="6">No Campaign Pending Authorization</td>
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