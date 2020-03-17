<?php

include_once 'scripts/auth.php';

include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "campaign email - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$templates = $model->getAllEmailDrafts();
if ($templates['flag'] == true) {
	$emailEmpty = false;
	$emailDrafts = $templates['data'];
} else {
	$emailEmpty = true;
}

// $templates = $model->getAllSmsDrafts();
// if ($templates['flag'] == true) {
// 	$smsEmpty = false;
// 	$smsDrafts = $templates['data'];
// } else {
// 	$smsEmpty = true;
// }

$audiences = $model->getAllAudiences();

if ($audiences['flag'] == true) {
	$audEmpty = false;
	$audience = $audiences['data'];
} else {
	$audEmpty = true;
}

$senders = $model->getEmailSendersFromPreference();

if ($senders['flag'] == true) {
	$senderEmpty = false;
	$senders = $senders['data']['options'];
	$senders = explode(",",$senders);
} else {
	$senderEmpty = true;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Email Campaign | BulkMailing</title>

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
	<script src="assets/js/campaign.js"></script>
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="bg-white" onload="start();">

	<?php include 'header.php'; ?>

   <main class="row no-gutters">

		<?php $nav = "CAMPAIGN"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Email Campaign
				</div>
			</div>

			<div class="container">

				<div class="my-0 w-100 btn-group">
					<button id="draftNav" class="d-inline p-4 cursor-pointer text-md btn btn-outline-dark" onclick="showDraft();">1. Select Email Draft</button>
					<button id="recipientNav" class="d-inline p-4 cursor-pointer text-md btn btn-outline-dark" disabled onclick="showRecipient();">2. Select Email Recipients</button>
					<button id="senderNav" class="d-inline p-4 cursor-pointer text-md btn btn-outline-dark" disabled onclick="showSender();">3. Select Email Sender</button>
					<button id="subjectNav" class="d-inline p-4 cursor-pointer text-md btn btn-outline-dark" disabled onclick="showSubject();">4. Enter Email Subject</button>
					<button id="sendNav" class="d-inline p-4 cursor-pointer text-md btn btn-outline-dark" disabled onclick="showSend();">5. Preview Email</button>
				</div>

				<div class="p-3 my-2 border rounded">

					<!-- The Select Draft Section -->
					<div id="draft">
						<div class="row no-gutters">
							<?php 
								if ($emailEmpty == false) {
									$count = 1;
									foreach ($emailDrafts as $template) {
										echo "
										<div class='col-lg-3 col-11 my-2 mx-4'>

											<div class='card'>
												<span class='position-absolute badge badge-info m-2 p-2'>{$template['draft_type']}</span>
												<span class='fa fa-envelope-o fa-5x text-center m-5'></span>
												
												<div class='card-body bg-dark text-white'>
													<div class='card-text text-left'>
														{$template['description']}
													</div>
													
													<textarea id='email_code_body{$count}' class='d-none'>{$template['body']}</textarea>
													
													<div class='btn-group float-right'>
														<button class='btn btn-sm obejor-bg-dark border text-white' onclick='previewTemplateCode(\"email_code_body{$count}\");' data-toggle='modal' data-target='#previewBody'>Preview</button>

														<button onclick=\"selectDraft('email_code_body{$count}',{$template['draft_id']})\" class='btn btn-sm obejor-bg-dark border text-white'>Select</button>
													</div>
												</div>
											</div>

										</div>
										";
										$count++;
									}
								}
							?>
						</div>
					</div>

					<!-- The Select Recipient Section -->
					<div id="recipient">
						<table class="table table-bordered text-center text-secondary">
							<thead class="obejor-text-dark">
								<tr>
									<th>#</th>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Email</th>
									<!-- <th>Telephone</th>
									<th>Classification</th>
									<th>Subscription&nbsp;Status</th> -->
									<th>
										Select
									</th>
								</tr>
							</thead>
							<tbody>

							<!-- 
								<td>{$aud['telephone']}</td>
								<td>{$aud['classification']}</td>
								<td>{$aud['subscription_status']}</td>
							 -->

								<?php 
									if ($audEmpty == false) {
										$count = 1;

										foreach ($audience as $aud) {
											echo "<tr class='text-dark'>
												<td>{$count}</td>
												<td>{$aud['firstname']}</td>
												<td>{$aud['lastname']}</td>
												<td>{$aud['email']}</td>
												<td>
													<input type='checkbox' class='check' id='{$aud['audience_id']}|{$aud['firstname']}|{$aud['lastname']}|{$aud['email']}'>
												</td>
											</tr>";

											$count++;
										}
										echo "<tr class='text-dark'>
											<td colspan='4'></td>
											<td>
												<button class='my-1 btn btn-sm obejor-bg-dark text-light' onclick='selectAllRecipient();'>Select All</button>
												<br>
												<button class='my-1 btn btn-sm obejor-bg-dark text-light' onclick='deselectAllRecipient();'>Deselect All</button>
											</td>
										</tr>";
									} else {
										echo '<tr>
											<td colspan="8">No Audience Exists</td>
										</tr>';
									} 
								?>
							</tbody>
						</table>

						<button class='btn btn-sm obejor-bg-dark text-light float-right' onclick="confirmRecipient();">
							Continue
							<span class="fa fa-arrow-right"></span>
						</button>
						<div class="clearfix"></div>
					</div>

					<!-- The Select Sender Section -->
					<div id="sender">
						<div class="input-group my-5 w-100">
							<div class="input-group-prepend">
								<span class="btn obejor-bg-dark text-light font-weight-bold">
									<span class="fa fa-user-o"></span>
								</span>
							</div>
							
							<select id="selectSender" class="input-group-append text-md form-control w-0 border-muted">
								<?php
									if ($senderEmpty == false) {
										foreach ($senders as $sender) {
											echo "<option value='{$sender}'>{$sender}</option>";
										}
									} else {
										echo '<option value="Obejor">Obejor</option>';
									}
								?>
							</select>

							<div class="input-group-append">
								<button class="btn obejor-bg-dark text-light font-weight-bold" onclick="selectSender();">
									Continue
									<span class="fa fa-arrow-right"></span>
								</button>
							</div>
						</div>
					</div>

					<!-- The Enter Subject Section -->
					<div id="subject">
						<div class="input-group my-5 w-100">
							<div class="input-group-prepend">
								<span class="btn obejor-bg-dark text-light font-weight-bold">
									<span class="fa fa-asterisk"></span>
								</span>
							</div>
							
							<input type="text" id="enterSubject" placeholder="Enter Subject..." class="input-group-append text-md form-control w-0 border-muted">

							<div class="input-group-append">
								<button class="btn obejor-bg-dark text-light font-weight-bold" onclick="enterSubject();">
									Continue
									<span class="fa fa-arrow-right"></span>
								</button>
							</div>
						</div>
					</div>

					<div id="send">
						
						<div class="text-lg my-4">
							Subject: <span id="previewSubject" class="text-lg"></span>
							<br>
							Sender: <span id="previewSender"></span></b>
							<br>
							Recipients: <span id="previewRecipients"></span></b>
						</div>

						<div class="card w-100 h-100" id="emailBodyPreview">
						</div>

						<button id="sendBtn" class="my-2 btn obejor-bg-dark text-light font-weight-bold float-right" onclick="sendEmail(this);">
							<span class="fa fa-envelope"></span>
							Send
						</button>

						<div class="clearfix"></div>

					</div>

				</div>

			</div>
			
		</section>

		<!-- Draft Preview Modal -->
		<div class="modal fade" id="previewBody" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Preview Body</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body table-responsive w-100" id="bodyPreview" style="height: 1000px;" >
					</div>

				</div>
			</div>
		</div>


	</main>

	<?php include 'footer.php'; ?>

</body>
</html>