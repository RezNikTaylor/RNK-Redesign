<?php
$root = './..';
require $root . '/../app/initialize.php';

// Logout
if ($session->loggedIn()) {
	if (isset($_GET['logout']) == 'true') {
		$session->logout();
		redirect('login.php');
	} else {
		$user = User::get();
		redirect($root . DS . 'account' . DS . $user->type);
	}
}

// Login
if (isset($_POST['login'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	$foundUser = User::authenticate($username, $password);

	if ($foundUser) {
		$session->login($foundUser);
		logAction("Login", "{$foundUser->username} logged in.");
		redirect($foundUser->type);
	} else {
		// username/password combo was not found
		$error = "Login credentials were incorrect.";
	}
} else {
	$username = "";
	$password = "";
}
?>

<?php includeFile('site/header.php'); ?>

	<div class='row'>
		<div class='col-md-7'>
			<h2>Sign In</h2>
			<br>

			<?php getAlerts(); ?>

			<form class='form-horizontal' action='login.php' method='post'>
				<div class='form-group'>
					<label for='username' class='col-sm-2 control-label'>Username</label>

					<div class='col-sm-8'>
						<input type='text' class='form-control' name='username' value='<?php echo $username; ?>' placeholder='Username'
						       autofocus="true">
					</div>
				</div>
				<div class='form-group'>
					<label for='password' class='col-sm-2 control-label'>Password</label>

					<div class='col-sm-8'>
						<input type='password' class='form-control' name='password' placeholder='Password'>
					</div>
				</div>
				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-8'>
						<input type='submit' class='btn btn-info btn-lg' name='login' value='Sign In'>
						<button class='btn btn-default btn-lg'>Register</button>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php includeFile('site/footer.php'); ?>