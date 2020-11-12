<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
global $curauth, $mypage;
?>
	<div id="sidebar">
		<?php
		if($curauth->user_level > 2 && $mypage !== 1){
		?>
		<div class="catwidget authorwidget"  >
			<h2 class="title"><?php echo $curauth->display_name ?></h2>
			<div class="description">
				<?php echo $curauth->display_name ?> has written <?php echo count_user_posts( $curauth->ID ); ?> posts.
			</div>
		</div>
		<?php } ?>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Conduit Sidebar') ) : ?>

		<?php endif; ?>
	</div>
