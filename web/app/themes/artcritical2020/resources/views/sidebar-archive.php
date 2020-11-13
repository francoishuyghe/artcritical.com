<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

global $categoryparent;
?>
	<div id="sidebar">
		<!-- <div id="ad" style="margin-top:20px"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/ad.png"></div> -->
		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Conduit Sidebar') ) : ?>

		<?php endif; ?>
	</div>
