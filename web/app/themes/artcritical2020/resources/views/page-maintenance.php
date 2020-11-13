<?php
/**
 */

get_header(); ?>

	<div id="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="article">
				<div id="body">
					<?php the_content(); ?>
			</div>
		</div>
		<?php endwhile; endif; ?>
	</div>


<?php get_footer(); ?>
