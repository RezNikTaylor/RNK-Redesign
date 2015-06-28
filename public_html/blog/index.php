<?php
$root = './..';
require $root . '/../app/initialize.php';
$navSelect = $pageTitle = 'blog';

$posts = Blog::findAll("ORDER BY datetime DESC");
?>

<?php includeFile('site/header.php'); ?>

	<h2>Blog</h2>
	<h3>Archive</h3>

<?php if (count($posts)) { ?>
	<ul>
		<?php foreach ($posts as $post) { ?>
			<?php
			$title = $post->title;
			$year = getDateElements("%Y", $post->datetime);
			$link = $year . DS . snakeString($title);
			?>
			<li><a href='<?php echo $link; ?>'><?php echo $title; ?></a></li>
		<?php } ?>
	</ul>
<?php } else {
	echo "Currently no blog posts! :(";
} ?>

<?php includeFile('site/footer.php'); ?>