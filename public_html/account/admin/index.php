<?php
$root = './../..';
require $root . '/../app/initialize.php';

$user = User::get('admin');
?>

<?php includeFile('site/header.php'); ?>

	<h2><?php echo $user->username; ?></h2>
	<h3>Account</h3>

<?php getAlerts(); ?>

	<p>
		<a href='<?php echo $root . DS; ?>account/inbox'>Inbox</a><br>
		<a href='<?php echo $root . DS; ?>account/admin/blog'>Manage Blog</a>
	</p>

	<a href='<?php echo $root . DS; ?>account/login.php?logout=true'>Logout</a>

<?php includeFile('site/footer.php'); ?>