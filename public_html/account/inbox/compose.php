<?php
$root = './../..';
require $root . '/../app/initialize.php';

$user = User::get();

if (isset($_POST['send'])) {
	$toID = 1;
	$msg = trim($db->real_escape_string($_POST['message']));

	if (is_int($toID) && validString($msg)) {
		// Check if toID exists
		if (User::IDExists($toID)) {
			$mail = UserMail::write($toID, $msg);

			if ($mail && $mail->save()) {
				$session->message("Message sent!");
				redirect('compose.php');
			} else {
				$error = "Failed to send message.";
			}
		} else {
			$error = "Message not sent because user does not exists.";
		}
	} else {
		$error = "Please fill out all fields.";
	}
}
?>

<?php includeFile('site/header.php'); ?>

	<div class='row'>
		<div class='col-md-7'>

			<h2>Mail</h2>

			<h3>Compose</h3>

			<?php getAlerts(); ?>

			<form class='form-horizontal' action='compose.php' method='post'>
				<div class='form-group'>
					<label for='message' class='col-sm-2 control-label'>Message</label>

					<div class='col-sm-8'>
						<textarea id='message' class='form-control' name='message'></textarea>
					</div>
				</div>
				<div class='form-group'>
					<div class='col-sm-offset-2 col-sm-8'>
						<input type='submit' class='btn btn-info btn-lg' name='send' value='Send'>
					</div>
				</div>
			</form>
		</div>
	</div>

<?php includeFile('site/footer.php'); ?>