<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php wp_title('/', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<style type="text/css">
		@import url("<?php bloginfo('stylesheet_url'); ?>");
	</style>
	<?php wp_head(); ?>
	<?php wp_print_scripts();?>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/cufon-yui.js" type="text/javascript"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/Futura_500-Futura_800-Futura_italic_500.font.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.1.0/prototype.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.3/scriptaculous.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/functions.js" type="text/javascript"></script>
	

</head>
<body>
	<div style="margin-left:10px">
			<div id="topmenucontainer">
				<div id="logo" style="padding-top:10px;float:left;height:70px"><a href="<?php bloginfo('url')?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png"></a></div>
			</div>
	

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div id="article">
					<h2><?php the_title(); ?></h2>
					<br style="clear:both">
					<!-- <div id="body"> -->
						<br style="clear:both">
						<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
					<!-- </div> -->
				</div>
			</div>
			<?php endwhile; else: ?>
			<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>
</body>
</html>
<?php die();?>