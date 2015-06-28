<?php
$root = $GLOBALS['root'];
$footLines = getGlobal('footLines');

$posts = Blog::findAll("ORDER BY datetime DESC LIMIT 5");
?>
	</section>
</div>

<footer>
	<div class='container'>
		<div class='row'>
			<div class='col-sm-4 col-xs-12'>
				<h2>Recent Articles</h2>
				<ul>
					<?php if (count($posts)) {
						foreach ($posts as $post) {
							$title = $post->title;
							$year = getDateElements("%Y", $post->datetime);
							$link = $root . DS . 'blog' . DS . $year . DS . snakeString($title); ?>
							<li><a href='<?php echo $link . DS; ?>'><?php echo $title ?></a></li>
						<?php }
					} else {
						echo "Currently no blog posts! :(";
					} ?>
<!--					<li><a href='--><?php //echo $root . DS; ?><!--blog'>Website Launch</a></li>-->
<!--					<li><a href='--><?php //echo $root . DS; ?><!--blog'>Great Books To Pickup</a></li>-->
<!--					<li><a href='--><?php //echo $root . DS; ?><!--blog'>Dual Monitoring</a></li>-->
<!--					<li><a href='--><?php //echo $root . DS; ?><!--blog'>Sidechain Compression</a></li>-->
				</ul>
			</div>

			<div class='col-sm-4 col-xs-12'>
				<h2>Social Media</h2>
				<div id='social-footer'>
					<a href='https://soundcloud.com/rezniktaylor'><img src='<?php echo $root . DS; ?>res/img/site/soundcloud.png' alt='Soundcloud'></a>
					<a href='https://facebook.com/rezniktaylor'><img src='<?php echo $root . DS; ?>res/img/site/facebook.png' alt='Facebook'></a>
					<a href='https://twitter.com/RezNikTaylor'><img src='<?php echo $root . DS; ?>res/img/site/twitter.png' alt='Twitter'></a>
					<a href='https://plus.google.com/111317248650420842503'><img src='<?php echo $root . DS; ?>res/img/site/googleplus.png' alt='Google+'></a>
				</div>
			</div>

			<div class='col-sm-4 col-xs-12'>
				<h2>Get In Touch</h2>
				<p>
					Seth Aaron Taylor<br>
					Woodstock, VT<br>
					<a href='mailto:seth@reznik-taylor.com'>seth@reznik-taylor.com</a>
				</p>
			</div>
		</div>
	</div>

	<div id='copyright'>
		<div class='container'>
			<div class='row'>
				<span class='pull-left'>Copyright &copy; <?php echo date('Y'); ?> - Seth Aaron Taylor.</span>
				<span class='pull-right hidden-xs'><a href='<?php echo $root . DS; ?>index.php'>www.RezNik-Taylor.com</a></span>
			</div>
		</div>
	</div>

</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<?php
if (is_string($footLines)) echo "{$footLines}\n";
if (is_array($footLines)) {
	foreach ($footLines as $line) {
		echo "{$line}\n";
	}
}
?>
</body>
</html>