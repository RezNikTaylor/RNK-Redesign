<?php
$root = './..';
require $root . '/../app/initialize.php';

if (isset($_POST['register'])) {
	$firstName = trim($_POST['firstName']);
	$lastName = trim($_POST['lastName']);
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$repassword = trim($_POST['repassword']);
	$email = trim($_POST['email']);

	if (validString([$firstName, $lastName, $username, $password, $repassword, $email])) {
		if ($password == $repassword) {
			$newUser = User::register($username, $password, $firstName, $lastName, $email);

			if ($newUser && $newUser->save()) {
				$session->message("You are registered and can now log in.");

				redirect('login.php');
			} else {
				$error = "Failed to register {$username} to the database.";
			}
		} else {
			$error = "Passwords do not match.";
		}
	} else {
		$error = "Please fill out all fields.";
	}
} else {
	$firstName = "";
	$lastName = "";
	$username = "";
	$email = "";
}
?>

<?php includeFile('site/header.php'); ?>

	<div class='row'>
		<div class='col-md-9'>
			<h2>Register</h2>

			<h3>New User</h3>

			<?php getAlerts(); ?>

			<form class='form-horizontal' action='register.php' method='post'>
				<div class='form-group'>
					<label for='firstName' class='col-sm-2 control-label'>First Name</label>

					<div class='col-sm-10'>
						<input type='text' id='firstName' class='form-control' name='firstName' value='<?php echo $firstName; ?>'
						       placeholder='First Name' autofocus='true'>
					</div>
				</div>

				<div class='form-group'>
					<label for='lastName' class='col-sm-2 control-label'>Last Name</label>

					<div class='col-sm-10'>
						<input type='text' id='lastName' class='form-control' name='lastName' value='<?php echo $lastName; ?>' placeholder='Last Name'>
					</div>
				</div>

				<div class='form-group'>
					<label for='username' class='col-sm-2 control-label'>Username</label>

					<div class='col-sm-10'>
						<input type='text' id='username' class='form-control' name='username' value='<?php echo $username; ?>' placeholder='Username'>
					</div>
				</div>

				<div class='form-group'>
					<label for='password' class='col-sm-2 control-label'>Password</label>

					<div class='col-sm-10'>
						<input type='password' id='password' class='form-control' name='password' placeholder='Password'>
					</div>
				</div>

				<div class='form-group'>
					<label for='repassword' class='col-sm-2 control-label'>Repeat Password</label>

					<div class='col-sm-10'>
						<input type='password' id='repassword' class='form-control' name='repassword' placeholder='Repeat Password'>
					</div>
				</div>

				<div class='form-group'>
					<label for='email' class='col-sm-2 control-label'>Email</label>

					<div class='col-sm-10'>
						<input type='email' id='email' class='form-control' name='email' value='<?php echo $email; ?>' placeholder='Email'>
					</div>
				</div>

				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<input type='submit' class='btn btn-info btn-lg' name='register' value='Sign Up'>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php includeFile('site/footer.php'); ?>