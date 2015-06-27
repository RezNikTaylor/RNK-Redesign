<?php
$root = './../../..';
require $root . '/../app/initialize.php';

$user = User::get('admin');
$msgs = SiteMail::findAll();
?>

<?php includeFile('site/header.php'); ?>

	<h2>Site Mail</h2>
	<h3>Inbox</h3>

<?php getAlerts(); ?>

<?php if (count($msgs)) { ?>
	<table class="table table-hover">
		<tbody>
		<?php foreach ($msgs as $msg) { ?>
			<tr>
				<td><?php echo $msg->name; ?></td>
				<td>
					<?php
					echo substr($msg->message, 0, 30);
					if (strlen($msg->message) > 30) {
						echo "...";
					};
					?>
				</td>
				<td><?php echo strftime("%m/%d/%y", strtotime($msg->datetime)); ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php } else {
	echo "Site inbox is empty!";
} ?>

<?php includeFile('site/footer.php'); ?>