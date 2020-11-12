<?php
/*
Template Name: Covers
*/

get_header();
//isset($_GET['tab']) ? $tab = $_GET['tab'] : $tab = 'oc';


?>

	<div id="main">
			<span class="futura">Cover Archive</span>
			<hr style="background-color:#000">
		<div id="bycover" class="cover_list">
			<table>
				
			<?php
			$count = 0;
			$args = array(
				'post_type' => 'cover',
				'post_status'  => 'publish',
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => 50
			);	
			$covers = new WP_Query($args);
			if ($covers->have_posts()) : while ($covers->have_posts()) : $covers->the_post();
				if ($count == 0) {
					echo "<tr>";
				}
				if ($count == 5) {
					echo "</tr>";
					$count = 0;
				}
				$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
				?>
				<td class="cover">
					<div id="thumb"><a class="thickbox no_icon" title="<?php the_excerpt();?>" href="<?php echo $img[0] ?>"><?php the_post_thumbnail('thumbnail');?></a></div>
					<h2><?php the_title()?></h2>
				</td>
				<?php
				$count++;
			endwhile;
			endif;
			?>
			</table>
		</div>
	</div>

<?php get_sidebar('archive'); ?>

<?php get_footer(); ?>
