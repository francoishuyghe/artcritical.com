<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

global $categoryparent;
global $authordata;
global $theauthor;
$theauthor = $authordata;
?>
	<div id="sidebar">
		<!-- <div id="ad"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/ad.png"></div> -->
		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Listings Sidebar') ) : ?>

		<?php endif; ?>
	</div>
