<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

global $categoryparent, $cat_id, $category;
?>
	<div id="sidebar">
		<?php if(nl2br(category_description($cat_id)) !== ""): ?>
			<div class="catwidget color_<?php echo $categoryparent; ?>"  >
				<h2 class="title"><?php echo $category->name; ?></h2>
				<div class="description">
					<?php echo category_description($cat_id); ?>
				</div>
			</div>
		<?php endif; ?>
		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Conduit Sidebar') ) : ?>

		<?php endif; ?>
	</div>
