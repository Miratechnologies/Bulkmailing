<?php

session_start();
if (isset($_SESSION['USER.EMAIL'])) {
	exit(header("location: dashboard.php"));
}

$inputs = $_POST;

if (isset($inputs['verify'])) {

   // Get Inputs
	$email = $inputs['_email'];
	$token = $inputs['token'];

	// validate the inputs
	include 'scripts/validation.php';
   $validation = new Validation();

	if ($validation->validateEmail($email,10,50) == true) {
      $email = $validation->sanitize($email);
	} else {
		die("wrong email" . $email);
		exit(header("location: verify.php?u={$email}&errmsg=Invalid Email"));
	}

	if ($validation->validateNumberExact($token,6) == true) {
      $token = $validation->sanitize($token);
	} else {
		exit(header("location: verify.php?u={$email}&errmsg=Invalid Token"));
	}

	// get the auth detail from the database
	include 'scripts/dbmodel.php';
	$model = new DBModel();
	$verify = $model->verifyToken($email,$token);

	if ($verify == true) {

		// redirect to the change password page
		exit(header("location: changepassword.php?u={$email}"));

	} else {
		exit(header("location: verify.php?u={$email}&errmsg=Wrong Token"));
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Verify Token | BulkMailing</title>

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
<body class="bg-white" onload="hidePassword();">

   <nav class="navbar navbar-expand-md navbar-dark obejor-bg-dark sticky-top">
		<a class="navbar-brand active ml-3 h1 mt-1" href="index.php"> <span class="fa fa-envelope-o"></span> Obejor Bulk Mailing & SMS</a>
		<!-- <button class="navbar-toggler text-dark" type="button" data-toggle="collapse" data-target="#navbarText"
			aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button> -->
	</nav>

   <section class="container-fluid my-5">

      <div class="display-4 text-center mt-5">Verify Token</div>

		<div class="card col-md-3 mx-auto d-block mt-4">
			
			<div class="card-body">

				<?php 
					if (isset($_GET['errmsg']) == true) {
						echo "
						<div class='alert alert-danger alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Sorry!</strong> {$_GET['errmsg']}.
						</div>
						";
					}
				?>

				<form method="POST" action="verify.php" autocomplete="off">
					<input type="hidden" name="_email" value="<?=$_GET['u']?>">
					<p class="text-center">If your email address is registered, you should receive a 6 digit token.<br>Enter the token below</p>
					<div class="input-group my-3">
						<div class="input-group-prepend">
							<span class="input-group-text obejor-bg-dark text-white">
								<i class="fa fa-asterisk fa-sm"></i>
							</span>
						</div>
						<input type="text" maxlength="6" minlength="0" pattern="[0-9]{6}" class="form-control" placeholder="Token" name="token" required>
					</div>

					<div class="form-group">
						<button type="submit" name="verify" class="btn btn-dark d-block mx-auto mt-3">
							Verify <i class="fa fa-lg fa-check"></i>
						</button>

						<p class="text-center mt-3"><a class="text-dark" href="index.php">Return to Login</a></p>
					</div>
				</form>

			</div>

		</div>

	</section>

	<?php include 'footer.php'; ?>

</body>
</html>