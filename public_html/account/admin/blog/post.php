<?php
$root = './../../..';
require $root . '/../app/initialize.php';
$pageTitle = 'New Blog Post';
$navSelect = 'blog';

$user = User::get('admin');

if (isset($_POST['post'])) {
	$title = trim($db->real_escape_string($_POST['title']));
	$keywords = trim($db->real_escape_string($_POST['keywords']));
	$article = trim($db->real_escape_string($_POST['article']));

	if (validString([$title, $article])) {
		$post = Blog::post($title, $article, $keywords);

		if ($post && $post->save()) {
			$session->message("Posted to blog successfully!");
			redirect('index.php');
		} else {
			$error = "Failed posting to the blog.";
		}
	} else {
		$error = "Please fill out all fields.";
	}
} else {
	$title = "";
	$keywords = "";
	$article = "";
}
?>

<?php includeFile('site/header.php'); ?>

	<h2>Blog</h2>
	<h3>New Post</h3>

<?php getAlerts(); ?>

<div class='row'>
	<div class='col-md-9'>
		<form class='form-horizontal' action='post.php' method='post'>
			<div class='form-group'>
				<label for='title' class='col-sm-2 control-label'>Title</label>

				<div class='col-sm-10'>
					<input type='text' id='title' class='form-control' name='title' value='<?php echo $title; ?>' placeholder='Title'>
				</div>
			</div>

			<div class='form-group'>
				<label for='keywords' class='col-sm-2 control-label'>Keywords</label>

				<div class='col-sm-10'>
					<input type='keywords' id='keywords' class='form-control' name='keywords' value='<?php echo $keywords; ?>' placeholder='Keywords'>
				</div>
			</div>

			<div class='form-group'>
				<label for='article' class='col-sm-2 control-label'>rticle</label>

				<div class='col-sm-10'>
					<textarea id='article' class='form-control' name='article' rows='15' placeholder='Article...'><?php echo $article; ?></textarea>
				</div>
			</div>

			<div class='form-group'>
				<div class='col-sm-offset-2 col-sm-10'>
					<input type='submit' class='btn btn-info' name='post' value='Post'>
				</div>
			</div>
		</form>
	</div>
</div>

<?php includeFile('site/footer.php'); ?>