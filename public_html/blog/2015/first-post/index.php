<?php
$root = './../../..';
require $root . '/../app/initialize.php';
$post = Blog::findByID(1);
$pageTitle = $post->title;
$navSelect = 'blog';

$year = $year = getDateElements("%Y", $post->datetime);
?>

<?php includeFile('site/header.php'); ?>

	<a href='../../'>Blog</a> >
	<a href='../'><?php echo $year; ?></a> >
	<?php echo $post->title; ?><br>
	<br>

	<article>
		<h2><?php echo $post->title; ?></h2>

		<h3><?php echo datetimeToText($post->datetime); ?></h3>

		<p><?php echo $post->article; ?></p>
	</article>

<?php includeFile('site/footer.php'); ?>