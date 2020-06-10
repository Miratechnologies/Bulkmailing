<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Templates | BulkMailing</title>

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

		<?php $nav = "ABC"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					ABC
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
							
							<select name="filter" class="input-group-append text-md form-control w-0 border-muted">
								<option value="ALL">All</option>
								<option value="EMAIL">Email</option>
								<option value="SMS">SMS</option>
							</select>

						</div>

						<!-- Import Section -->
						<div class="col-lg-9 col-12">
							<button class="btn btn-sm obejor-bg-dark text-light text-md float-right my-1 mt-lg-2 mr-lg-2">
								<span class="fa fa-plus-circle"></span>
								Add Template
							</button>
						</div>
					</div>
				</div>
				
				
			</div>
			
		</section>

	</main>

	<?php include 'footer.php'; ?>

</body>
</html>