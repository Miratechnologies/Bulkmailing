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

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Campaign
				</div>
				<hr>
			</div>

			<div class="container">

				<div class="col-12 mx-auto card my-5">
					<div class="card-body text-lg text-center">

						<div class="row mt-3">
							<div class="col-lg-6 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" onclick="location.href='campaign.create.php';">
								<span class="fa fa-4x fa-plus"></span> <br>
								<span class="obejor-text-dark text-lg">NEW EMAIL CAMPAIGN</span>
							</div>

							<div class="col-lg-6 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" data-toggle="modal" data-target="#create-sms">
								<span class="fa fa-4x fa-plus"></span> <br>
								<span class="obejor-text-dark text-lg">NEW SMS CAMPAIGN</span>
							</div>
						</div>

						<div class="row my-2">
							<div class="col-lg-4 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" onclick="location.href='campaign.email.php';">
								<span class="fa fa-4x fa-envelope"></span> <br>
								<span class="obejor-text-dark text-lg">SEND EMAIL CAMPAIGN</span>
							</div>
							
							<div class="col-lg-4 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" onclick="location.href='campaign.sms.php';">
								<span class="fa fa-4x fa-comment"></span> <br>
								<span class="obejor-text-dark text-lg">SEND SMS CAMPAIGN</span>
							</div>
							
							<div class="col-lg-4 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" onclick="location.href='campaign.email.schedule.php';">
								<span class="fa fa-4x fa-history"></span> <br>
								<span class="obejor-text-dark text-lg">SCHEDULE EMAIL CAMPAIGN</span>
							</div>
						</div>

						<?php
							$role = $_SESSION['USER.ROLE'];

							if ($role == "ADMIN") {
								echo '
								<div class="row my-2">
									<div class="col-6 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" onclick="location.href=\'authorize_campaign.php\';">
										<span class="fa fa-4x fa-check"></span> <br>
										<span class="obejor-text-dark text-lg">AUTHORIZE CAMPAIGN</span>
									</div>

									<div class="col-6 mx-auto border my-1 p-5 obejor-text-dark cursor-pointer" onclick="location.href=\'scheduledmails.php\';">
										<span class="fa fa-4x fa-list"></span> <br>
										<span class="obejor-text-dark text-lg">SCHEDULED EMAIL LIST</span>
									</div>
								</div>
								';
							}
						?>

					</div>
				</div>

			</div>
			
		</section>

		<div class="modal fade" id="create-sms" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">
							Enter Campaign Name
						</h4>

						<button type="button" id="close-start-campaign" class="d-none float-left close" data-dismiss="modal" data-toggle="start-campaign" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body" >
						<form action="Javascript:void(0);">

							<input type="text" name="campaign-name" id="campaign-name" placeholder="Enter Campaign Name" maxlength="20" autofocus class="my-1 form-control">

							<br>
							<textarea onkeyup="$('#sms_body_len').html(160 - $('#sms_body').val().length);" minlength="1" maxlength="160" name="sms_body" id="sms_body" class="form-control" cols="30" rows="5" style="resize:none"  placeholder="Enter Campaign SMS"></textarea>
							<p id="sms_body_len">160</p>

							<button type="submit" onclick="create()" class="my-3 btn btn-md btn-secondary">Submit</button>
							
						</form>
					</div>

				</div>
			</div>
		</div>

	</main>

	<?php include 'footer.php'; ?>
	
</body>

<script>
	function create() {
		let campaign_name = $("#campaign-name").val();
		let campaign_body = $("#sms_body").val();
		// do validation
		campaign_name = campaign_name.toString().trim();
		campaign_body = campaign_body.toString().trim();
		if (campaign_name !== "" && campaign_name.length > 0 && campaign_name.length <= 20 && campaign_body !== "" && campaign_body.length > 0 && campaign_body.length <= 160) {
			$.post('scripts/add_to_draft.php', 
			{
				templateType: 'SMS',
				description: campaign_name,
				body: campaign_body
			}, function(data, status) {
				// alert(data);
				if (status == 'success') {
					resp = JSON.parse(data);
					if (resp.flag === true) {
						document.getElementById("close-start-campaign").click();
						alert(`Campaign ${campaign_name} created successfully.`);
					} else {
						alert(`Campaign ${campaign_name} could not be created! Please try again`);
					}
				}
			});
		} else {
			alert('Invalid SMS Campaign')
		}
	}
</script>
	
</html>