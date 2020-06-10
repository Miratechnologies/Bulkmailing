<?php

session_start();
if (isset($_SESSION['USER.EMAIL'])) {
	exit(header("location: dashboard.php"));
}

$inputs = $_POST;

if (isset($inputs['auth'])) {

   // Get Inputs
	$email = $inputs['email'];
	$password = $inputs['password'];

	// validate the inputs
	include 'scripts/validation.php';
   $validation = new Validation();

	if ($validation->validateEmail($email,10,50) == true) {
      $email = $validation->sanitize($email);
	} else {
		exit(header('location: index.php?errmsg=Invalid Email/Password'));
	}

	// get the auth detail from the database
	include 'scripts/dbmodel.php';
	$model = new DBModel();
	$get = $model->getUserDetail($email);

	if ($get['flag'] == true) {
		$data = $get['data'][0];
		
		$dbEmail = $data['email'];
		$dbPassword = $data['password'];
		$dbRole = $data['role'];
		$dbStatus = $data['status'];

		// don't allow blocked users
		if ($dbStatus == "BLOCKED") {
			exit(header('location: index.php?errmsg=Your Account has been blocked.'));
		}

		// and verify the login details
		if (password_verify($password, $dbPassword))
		{
			// Set the session
			$_SESSION['USER.EMAIL'] = $dbEmail;
			$_SESSION['USER.ROLE'] = $dbRole;

			// add the login to the user's activity
			$add = $model->addNewLog($dbEmail,"",get_client_ip());

			if ($add['flag'] == true) {
				// update for login
				$_SESSION['USER.LOG.ID'] = $add['id'];
				$_SESSION['USER.ACTIVITY'][] = "logged in - " . date("d/m/Y h:i a");

				include 'scripts/log.php';
			}

			// regenerate session
			session_regenerate_id();
			// redirect to the dashboard
			exit(header('location: dashboard.php'));
		} else {
			exit(header('location: index.php?errmsg=Invalid Email/Password'));
		}
	} else {
		exit(header('location: index.php?errmsg=Invalid Email/Password'));
	}

	function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
}

function get_client_ip() {
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Welcome | BulkMailing</title>

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
		<a class="navbar-brand active ml-3 h1 mt-1" href="#"> <img src="assets/imgs/favicon.png" alt="Obejor Logo" width="30"> Obejor Bulk Mailing & SMS</a>
		<!-- <button class="navbar-toggler text-dark" type="button" data-toggle="collapse" data-target="#navbarText"
			aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button> -->
	</nav>

   <section class="container-fluid my-5">

      <div class="display-2 text-center mt-5">Login</div>

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

					if (isset($_GET['succmsg']) == true) {
						echo "
						<div class='alert alert-success alert-dismissible fade show'>
							<button type='button' class='close alert-dismissible' data-dismiss='alert'>&times;</button>
							<strong>Success!</strong> {$_GET['succmsg']}.
						</div>
						";
					}
				?>

				<form method="POST" action="index.php" autocomplete="off">
					<div class="input-group my-3">
						<div class="input-group-prepend">
							<span class="input-group-text obejor-bg-dark text-white">
								<i class="fa fa-envelope fa-sm"></i>
							</span>
						</div>
						<input type="text" class="form-control" placeholder="Email" name="email" required>
					</div>

					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text obejor-bg-dark text-white" id="Password">
								<i class="fa fa-lock fa-lg"></i>
							</span>
						</div>

						<input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
						
						<button type="button" class="btn btn-sm rounded-0 text-dark" id="showPassword">
							<i class="fa fa-eye fa-lg" onclick="showPassword();"></i>
						</button>

						<button type="button" class="btn btn-sm rounded-0 text-dark" id="hidePassword">
							<i class="fa fa-eye-slash fa-lg" onclick="hidePassword();"></i>
						</button>
					</div>
					
					<div class="form-group">
						<button type="submit" name="auth" class="btn btn-dark d-block mx-auto mt-3">
							Login <i class="fa fa-lg fa-sign-in"></i>
						</button>

						<p class="text-center mt-3"><a class="text-dark" href="forgot.php">Forgot Password</a></p>
					</div>
				</form>

			</div>

		</div>

	</section>

	<?php include 'footer.php'; ?>

</body>
</html>