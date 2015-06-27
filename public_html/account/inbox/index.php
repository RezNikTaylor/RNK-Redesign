<?php
$root = './../..';
require $root . '/../app/initialize.php';

$user = User::get();
$msgs = UserMail::getInbox($user->id);
?>

<?php includeFile('site/header.php'); ?>

	<h2>Mail</h2>
	<h3>Inbox</h3>

<?php getAlerts(); ?>

<?php if (count($msgs)) { ?>
	<table class="table table-hover">
		<tbody>
		<?php foreach ($msgs as $msg) {
			$fromUser = User::findByID($msg->id); ?>
			<tr>
				<td><?php echo $fromUser->fullName(); ?></td>
				<td>
					<?php
					echo substr($msg->message, 0, 30);
					if (strlen($msg->message) > 30) {
						echo "...";
					}
					?>
				</td>
				<td><?php echo strftime("%m/%d/%y", strtotime($msg->datetime)); ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php } else {
	echo "Your inbox is empty!";
} ?>

<?php includeFile('site/footer.php'); ?>