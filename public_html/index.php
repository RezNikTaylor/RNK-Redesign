<?php
$root = '.';
require $root . '/../app/initialize.php';
$navSelect = 'home';
?>

<?php includeFile('site/header.php'); ?>

	<h2>What is this site?</h2>
	<h3>Mission statement</h3>

	<p>
		This site is where anyone can gain access to my daily life. You can read <a href='blog'>blog posts</a> on technology that I'm currently
		using or fun classic <a href='#'>gear</a> from the past. Every once and a while when I get around to recording <a href='music'>music</a>,
		tracks will be posted for your listening pleasure.
	</p>

	<p>
		If you sign up to <a href='account/register.php'>become a member</a> of my site you get some pretty cool benefits. As I'm working on
		projects, I will periodically share previews of what I'm working on. There are then <a href='#'>open discussions</a> about what the
		members think should happen next. It's like a team <a href='#'>development</a> here are RezNik-Taylor.com
	</p>

	<p>So come on and <a href='account/register.php'>join</a> the fun!</p>

<?php includeFile('site/footer.php'); ?>