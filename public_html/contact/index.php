<?php
$root = './..';
require $root . '/../app/initialize.php';
$navSelect = $pageTitle = 'contact';

if (isset($_POST['send'])) {
	$name = trim($db->real_escape_string($_POST['name']));
	$email = trim($db->real_escape_string($_POST['email']));
	$msg = trim($db->real_escape_string($_POST['message']));

	if (validString([$name, $email, $msg])) {
		$mail = SiteMail::write($name, $email, $msg);

		if ($mail && $mail->save()) {
			$session->message("Message sent successfully!");
			redirect('index.php');
		} else {
			$error = "Failed to send message.";
		}
	} else {
		$error = "Please fill out all fields.";
	}
} else {
	$name = "";
	$email = "";
	$msg = "";
}
?>

<?php includeFile('site/header.php'); ?>

	<div class='row'>
		<div class='col-md-9'>
			<h2>Contact</h2>

			<h3>Send A Message</h3>

			<?php getAlerts(); ?>

			<form class='form-horizontal' action='index.php' method='post'>
				<div class='form-group'>
					<label for='name' class='col-sm-2 control-label'>Full Name</label>

					<div class='col-sm-10'>
						<input type='text' id='name' class='form-control' name='name' value='<?php echo $name; ?>' placeholder='Full Name'>
					</div>
				</div>

				<div class='form-group'>
					<label for='email' class='col-sm-2 control-label'>Email</label>

					<div class='col-sm-10'>
						<input type='email' id='email' class='form-control' name='email' value='<?php echo $email; ?>' placeholder='Email'>
					</div>
				</div>

				<div class='form-group'>
					<label for='message' class='col-sm-2 control-label'>Message</label>

					<div class='col-sm-10'>
						<textarea id='message' class='form-control' name='message' rows='4' placeholder='Message...'><?php echo $msg; ?></textarea>
					</div>
				</div>

				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-10'>
						<input type='submit' class='btn btn-info' name='send' value='Send'>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php includeFile('site/footer.php'); ?>