<?php
$root = './../../..';
require $root . '/../app/initialize.php';
$pageTitle = 'Manage Blog';
$navSelect = 'blog';

$user = User::get('admin');
$posts = Blog::findAll("ORDER BY title ASC");
?>

<?php includeFile('site/header.php'); ?>

	<h2>Blog</h2>
	<h3>Articles</h3>

<?php getAlerts(); ?>

	<p><a href='post.php'>Write New Post</a></p>

<?php if (count($posts)) { ?>
	<table class="table table-hover">
		<tbody>
		<?php foreach ($posts as $post) { ?>
			<tr>
				<td><?php echo $post->title; ?></td>
				<td>
					<?php
					echo htmlentities(substr($post->article, 0, 30));
					if (strlen($post->article) > 30) {
						echo "...";
					}
					?>
				</td>
				<td><?php echo strftime("%m/%d/%y", strtotime($post->datetime)); ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php } else {
	echo "You haven't posted anything yet!";
} ?>

<?php includeFile('site/footer.php'); ?>