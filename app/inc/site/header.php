<?php
$root = $GLOBALS['root'];
$session = $GLOBALS['session'];

$pageTitle = ucwords(getGlobal('pageTitle'));
$navSelect = strtolower(getGlobal('navSelect'));
$headLines = getGlobal('headLines');
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content=''>
	<meta name='author' content='Seth Aaron Taylor'>
	<link rel='icon' href='<?php echo $root . DS; ?>res/img/site/favicon.ico'>
	<title><?php if (!empty($pageTitle)) echo "{$pageTitle} | "; ?>RezNikTaylor</title>
	<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' rel='stylesheet'>
	<link href='<?php echo $root . DS; ?>res/css/main.css' rel='stylesheet'>
	<?php
	if (is_string($headLines)) echo "{$headLines}\n";

	if (is_array($headLines)) {
		foreach ($headLines as $line) {
			echo "{$line}\n";
		}
	}
	?>
</head>
<body>

<header>
	<div class='container'>
		<div id='brand'>
			<a href='<?php echo $root . DS; ?>index.php'><img src='<?php echo $root . DS; ?>res/img/site/logo.png' alt=''></a>
			<a href='<?php echo $root . DS; ?>index.php'><h1>RezNikTaylor</h1></a>
		</div>

		<nav>
			<div id='nav' class='hidden-xs'>

				<div id='account'>
					<?php
					if ($session->loggedIn()) {
						$user = User::get();
						echo "<a href='" . $root . DS . "account" . DS . $user->type . "'>";
						echo "<span class='glyphicon glyphicon-user' aria-hidden='true'></span> {$user->username}</a>\n";
					} else {
						echo "<a href='" . $root . DS . "account/register.php'>Register</a> | ";
						echo "<a href='" . $root . DS . "account/login.php'>Login</a>";
					}
					?>
				</div>

				<div id='main-nav'>
					<ul>
						<li><a <?php if ($navSelect == 'home') echo "class='selected' "; ?>href='<?php echo $root . DS; ?>index.php'>Home</a></li>
						<li><a <?php if ($navSelect == 'music') echo "class='selected' "; ?>href='<?php echo $root . DS; ?>music'>Music</a></li>
						<li><a <?php if ($navSelect == 'blog') echo "class='selected' "; ?>href='<?php echo $root . DS; ?>blog'>Blog</a></li>
						<li><a <?php if ($navSelect == 'contact') echo "class='selected' "; ?>href='<?php echo $root . DS; ?>contact'>Contact</a></li>
					</ul>
				</div>

			</div>

			<a id='mobile-menu' class='visible-xs-block' href='#'>
				<span class='glyphicon glyphicon-menu-hamburger' aria-hidden='true'></span>
			</a>
		</nav>

	</div>
</header>

<section class='hidden-xs' id='banner'>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-1'></div>
			<div class='col-sm-2'>
				<img class='img-circle pull-right' src='<?php echo $root . DS; ?>res/img/site/profile.jpg' alt=''>
			</div>
			<div class='col-sm-8'>
				<h2>There is no alternative to being yourself!</h2>
			</div>
			<div class='col-sm-1'></div>
		</div>
	</div>
</section>

<div class='container'>
	<section id='main'>