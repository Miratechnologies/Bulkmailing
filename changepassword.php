<?php

session_start();
if (isset($_SESSION['USER.EMAIL'])) {
	exit(header("location: dashboard.php"));
}

$inputs = $_POST;

if (isset($inputs['reset'])) {

   // Get Inputs
	$email = $inputs['_email'];
	$password = $inputs['password'];
	$cpassword = $inputs['cpassword'];

	// validate the inputs
	include 'scripts/validation.php';
   $validation = new Validation();

	function hashPassword($password){
      $options = [
         'cost' => 10,
         'salt' => openssl_random_pseudo_bytes(22),
      ];
   
      $password =  password_hash($password, PASSWORD_BCRYPT, $options);
      return $password;
   }

	if ( ($password == $cpassword) && ($validation->validatePassword($password,8,20) == true) ) {
		$hpassword = hashPassword($password);
	} else {
		exit(header("location: changepassword.php?u={$email}&errmsg=Invalid password"));
	}

	// get the auth detail from the database
	include 'scripts/dbmodel.php';
	$model = new DBModel();
	$change = $model->updatePassword($email,$hpassword);

	if ($change == true) {

		// redirect to the change password page
		exit(header("location: index.php?succmsg=Password reset successful."));

	} else {
		exit(header("location: changepassword.php?u={$email}&errmsg=Password reset failed."));
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Change Password | BulkMailing</title>

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
<body class="bg-white" onload="hidePassword();">

   <nav class="navbar navbar-expand-md navbar-dark obejor-bg-dark sticky-top">
		<a class="navbar-brand active ml-3 h1 mt-1" href="index.php"> <img src="assets/imgs/favicon.png" alt="Obejor Logo" width="30"> Obejor Bulk Mailing & SMS</a>
		<!-- <button class="navbar-toggler text-dark" type="button" data-toggle="collapse" data-target="#navbarText"
			aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button> -->
	</nav>

   <section class="container-fluid my-5">

      <div class="display-4 text-center mt-5">Reset Password</div>

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

				<form method="POST" action="changepassword.php" autocomplete="off">
					<input type="hidden" name="_email" value="<?=$_GET['u']?>">
					<p class="text-center">Enter your new password and confirm your password</p>
					<div class="input-group my-3">
						<div class="input-group-prepend">
							<span class="input-group-text obejor-bg-dark text-white">
								<i class="fa fa-lock fa-sm"></i>
							</span>
						</div>
						<input type="password" class="form-control" placeholder="New Password" name="password" required>
					</div>
					<div class="input-group my-3">
						<div class="input-group-prepend">
							<span class="input-group-text obejor-bg-dark text-white">
								<i class="fa fa-lock fa-sm"></i>
							</span>
						</div>
						<input type="password" class="form-control" placeholder="Confirm New Password" name="cpassword" required>
					</div>

					<div class="form-group">
						<button type="submit" name="reset" class="btn btn-dark d-block mx-auto mt-3">
							Reset <i class="fa fa-lg fa-check"></i>
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