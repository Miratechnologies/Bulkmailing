<?php

include_once 'scripts/auth.php';

include 'scripts/dbmodel.php';
$model = new DBModel();
// session_start();
$_SESSION['USER.ACTIVITY'][] = "add user - " . date("d/m/Y h:i a");
include 'scripts/log.php';

$inputs = $_POST;
if (isset($inputs['save_user'])) {

   // Get Inputs
   $firstname = $inputs['firstname'];
   $lastname = $inputs['lastname'];
	$email = $inputs['email'];
	$telephone = $inputs['telephone'];
   $role = $inputs['role'];
   $password = $inputs['password'];

   // Validate Inputs & Sanitize Inputs

   include 'scripts/validation.php';
   $validation = new Validation();

   if ($validation->validateName($firstname,2,20) == true) {
		$firstname = $validation->sanitize($firstname);
	} else {
		exit(header('location: add_user.php?errmsg=Invalid firstname'));
	}
	
	if ($validation->validateName($lastname,2,20) == true) {
      $lastname = $validation->sanitize($lastname);
	} else {
		exit(header('location: add_user.php?errmsg=Invalid lastname'));
	}

	if ($validation->validateEmail($email,10,50) == true) {
      $email = $validation->sanitize($email);
	} else {
		exit(header('location: add_user.php?errmsg=Invalid email'));
	}
	
	if ($validation->validateTelephone($telephone,11,20) == true) {
      $telephone = $validation->sanitize($telephone);
	} else {
		exit(header('location: add_user.php?errmsg=Invalid telephone'));
	}

	function hashPassword($password){
      $options = [
         'cost' => 10,
         'salt' => openssl_random_pseudo_bytes(22),
      ];
   
      $password =  password_hash($password, PASSWORD_BCRYPT, $options);
      return $password;
   }

	if ($validation->validatePassword($password,8,20) == true) {
		$hpassword = hashPassword($password);
	} else {
		exit(header('location: add_user.php?errmsg=Invalid password'));
	}
	
	$add = $model->addAuthForUser($firstname,$lastname,$telephone,$email,$hpassword,"",$role);

	if ($add == true) {
		header('location: users.php?adduser=true&loginEmail='.$email.'&loginPassword='.$password);
	} else {
		header('location: users.php?adduser=false');
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Templates | BulkMailing</title>

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

		<?php $nav = "USERS"; include 'nav.php'; ?>

		<section class="col-lg-10 container-fluid">

			<div class="p-2 mx-0 my-0">
				<div class="mx-lg-5 mx-sm-auto text-dark display-4">
					Add User
				</div>
				<hr>
			</div>

			<div class="container mt-2 mb-5">

				<form action="add_user.php" method="post" form-validate class="col-8 mx-auto">

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

					<label for="firstname" class="text-lg"> <span class="fa fa-user"></span> Firstname:</label>
					<input type="text"  id="firstname" name="firstname" class="form-control">

					<br>
					<label for="lastname" class="text-lg"> <span class="fa fa-user"></span> Lastname:</label>
					<input type="text" id="lastname" name="lastname" class="form-control">

					<br>
					<label for="email" class="text-lg"> <span class="fa fa-envelope"></span> Email:</label>
					<input type="email" id="emial" name="email" class="form-control">

					<br>
					<label for="telephone" class="text-lg"> <span class="fa fa-phone"></span> Telephone:</label>
					<input type="tel" id="telephone" name="telephone" class="form-control">

					<br>
					<label for="g_password" class="text-lg"> <span class="fa fa-lock"></span> Password:</label>
					<div class="input-group">
						<input type="hidden" id="password" name="password" value="">
						<input type="text" name="g_password" id="g_password" value="" onchange="$('#password').val($('#g_password').val())" class="form-control input-group-prepend">
						<button type="button" class="input-group-append btn btn-sm obejor-bg-dark text-white" onclick="generatePassword();">Generate Password</button>
					</div>
					<small class="obejor-text-dark">Don't forget to copy the password</small>
					<br>
					
					<br>
					<label for="role" class="text-lg"> <span class="fa fa-bookmark"></span> Role:</label>
					<select name="role" id="role" class="form-control">
						<option value="ADMIN">ADMIN</option>
						<option value="STAFF">STAFF</option>
					</select>

					<br>
					<input type="submit" name="save_user" value="Save" class="btn btn-lg obejor-bg-dark text-white d-block mx-auto px-5 mt-5">

				</form>
				
			</div>
			
		</section>

	</main>

	<?php include 'footer.php'; ?>

</body>
</html>