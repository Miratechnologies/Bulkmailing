<?php

include_once 'scripts/auth.php';
include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "drafts - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$templates = $model->getAllDrafts();

if ($templates['flag'] == true) {
	$allEmpty = false;
	$allDrafts = $templates['data'];
} else {
	$allEmpty = true;
}

$templates = $model->getAllEmailDrafts();
if ($templates['flag'] == true) {
	$emailEmpty = false;
	$emailDrafts = $templates['data'];
} else {
	$emailEmpty = true;
}

$templates = $model->getAllSmsDrafts();
if ($templates['flag'] == true) {
	$smsEmpty = false;
	$smsDrafts = $templates['data'];
} else {
	$smsEmpty = true;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Drafts | BulkMailing</title>

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
	<script src="assets/js/templates.js"></script>
	<link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="bg-white" onload="showEmailTemplates();">

	<?php include 'header.php'; ?>

   <main class="row no-gutters">

		<?php $nav = "DRAFTS"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Drafts
				</div>
			</div>

			<div class="container">
				<div class="my-1 border p-1 rounded">
					<div class="form-row">
						<!-- filter section -->
						<div class="col-lg-3 col-sm-12 input-group my-1">
							<div class="input-group-prepend">
								<span class="btn obejor-bg-dark text-light font-weight-bold">
									<span class="fa fa-filter"></span>
									Filter
								</span>
							</div>
							
							<select id="filter" onchange="changeTemplates();" class="input-group-append text-md form-control w-0 border-muted">
								<option value="EMAIL">Email</option>
								<option value="SMS">SMS</option>
							</select>

						</div>

						<div class="col-lg-9 col-12">
							<a href="campaign.create.php" class="text-decoration-none btn btn-sm obejor-bg-dark text-white text-md float-right my-1 mt-lg-2 mr-lg-2">
								<span class="fa fa-plus-circle"></span>
								Create Email Campaign
							</a>
							<button data-toggle="modal" data-target="#create-sms" class="text-decoration-none btn btn-sm obejor-bg-dark text-white text-md float-right my-1 mt-lg-2 mr-lg-2">
								<span class="fa fa-plus-circle"></span>
								Create SMS Campaign
							</button>
						</div>

					</div>
				</div>
			
				<?php

					$inputs = $_GET;

					if (isset($inputs['adddraft'])) {
						$addTemplateStatus = $inputs['adddraft'];
						
						if ($addTemplateStatus == 'true') {
							echo "
							<div class='alert alert-success alert-dismissible'>
								<button type='button' class='close' data-dismiss='alert'>&times;</button>
								<strong>Success!</strong> Draft was added successeccfully.
							</div>
							";
						} elseif ($addTemplateStatus == 'false') {
							echo "
								<div class='alert alert-danger alert-dismissible'>
									<button type='button' class='close' data-dismiss='alert'>&times;</button>
									<strong>Sorry!</strong> Draft was not added.
								</div>
							";
						}
					}

					if (isset($inputs['updatedraft'])) {
						$addTemplateStatus = $inputs['updatedraft'];
						
						if ($addTemplateStatus == 'true') {
							echo "
							<div class='alert alert-success alert-dismissible'>
								<button type='button' class='close' data-dismiss='alert'>&times;</button>
								<strong>Success!</strong> Draft was updated successeccfully.
							</div>
							";
						} elseif ($addTemplateStatus == 'false') {
							echo "
								<div class='alert alert-danger alert-dismissible'>
									<button type='button' class='close' data-dismiss='alert'>&times;</button>
									<strong>Sorry!</strong> Draft was not updated.
								</div>
							";
						}
					}

					if (isset($inputs['deleteDraft'])) {
						$delDraftStatus = $inputs['deleteDraft'];
						
						if ($delDraftStatus == 'true') {
							echo "
							<div class='alert alert-success alert-dismissible'>
								<button type='button' class='close' data-dismiss='alert'>&times;</button>
								<strong>Success!</strong> Draft was deleted successeccfully.
							</div>
							";
						} elseif ($delDraftStatus == 'false') {
							echo "
								<div class='alert alert-danger alert-dismissible'>
									<button type='button' class='close' data-dismiss='alert'>&times;</button>
									<strong>Sorry!</strong> Draft was not deleted.
								</div>
							";
						}
					}

				?>

				<!-- Display Template Section -->

				<div id="emailTemplates">
					<div class="row no-gutters">
						<?php 

							$role = $_SESSION['USER.ROLE'];

							if ($emailEmpty == false) {
								$count = 1;
								foreach ($emailDrafts as $template) {
									$delete = ($role == "ADMIN") ? "<a href='scripts/delete_draft.php?draft={$template['draft_id']}' class='btn btn-sm obejor-bg-dark border text-white' title='Delete'><span class='fa fa-trash'></span></a>" : "" ;
									echo <<<HTML
									<div class='col-lg-3 col-11 my-2 mx-4'>

										<div class='card'>
											<span class='position-absolute badge badge-info m-2 p-2'>{$template['draft_type']}</span>
											<span class='fa fa-envelope-o fa-5x text-center m-5'></span>
											
											<div class='card-body bg-dark text-white'>
												<div class='card-text text-left'>
													{$template['description']}
												</div>
												
												<textarea id='email_code_body{$count}' class='d-none'>{$template['body']}</textarea>
												
												<div class='btn-group my-2'>
													<a href='campaign.email.php' class='btn btn-sm obejor-bg-dark border text-white'>Campaign</a>
												
													<button class='btn btn-sm obejor-bg-dark border text-white' onclick="previewTemplateCode('email_code_body{$count}');" data-toggle='modal' data-target='#previewBody'>Preview</button>

													<a href="campaign.edit.php?draft={$template['draft_id']}" class='btn btn-sm obejor-bg-dark border text-white'><span class='fa fa-edit'></span></a>

													{$delete}
												</div>

											</div>
										</div>

									</div>
HTML;
									$count++;
								}
							} else {
								echo "
								<div class='alert alert-info w-100 '>
									No Drafts available
								</div>
								";
							}
						?>

					</div>
				</div>

				<div id="smsTemplates">
					<div class="row no-gutters">
						<?php 

							$role = $_SESSION['USER.ROLE'];

							if ($smsEmpty == false) {
								$count = 1;
								foreach ($smsDrafts as $template) {
									$delete = ($role == "ADMIN") ? "<a href='scripts/delete_draft.php?draft={$template['draft_id']}' class='btn btn-sm obejor-bg-dark border text-white' title='Delete'><span class='fa fa-trash'></span></a>" : "" ;
									echo <<<HTML
									<div class='col-lg-3 col-11 my-2 mx-4'>

										<div class='card'>
											<span class='position-absolute badge badge-info m-2 p-2'>{$template['draft_type']}</span>
											<span class='fa fa-envelope-o fa-5x text-center m-5'></span>
											
											<div class='card-body bg-dark text-white'>
												<div class='card-text text-left'>
													{$template['description']}
												</div>
												
												<textarea id='sms_code_body{$count}' class='d-none'>{$template['body']}</textarea>
												
												<div class='btn-group my-2'>
													<a href='campaign.sms.php' class='btn btn-sm obejor-bg-dark border text-white'>Campaign</a>
												
													<button class='btn btn-sm obejor-bg-dark border text-white'  onclick="previewTemplateCode('sms_code_body{$count}');" data-toggle='modal' data-target='#previewBody'>Preview</button>

													{$delete}
												</div>

											</div>
										</div>

									</div>
HTML;
									$count++;
								}
							} else {
								echo "
								<div class='alert alert-info w-100 '>
									No Drafts available
								</div>
								";
							}
						?>

					</div>
				</div>
					

				<!-- Modal -->
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

			</div>
			
		</section>

	</main>

	
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


	<?php include 'footer.php'; ?>

</body>
</html>