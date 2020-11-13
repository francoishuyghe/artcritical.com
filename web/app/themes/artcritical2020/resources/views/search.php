<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
	<div id="main">
	<?php if (have_posts()) : 
	$counter = 0;
	?>
		<?php while (have_posts()) : the_post(); ?>
			<?php
			if($post->post_type == 'listing'){
                
				$thevenue = get_post_meta($post->ID, 'thevenue', true);
				$thestart = get_post_meta($post->ID, 'thestart', true);
				$theend = get_post_meta($post->ID, 'theend', true);	
				if(time() > $theend) break; 
                if($counter == 0){
					echo '<span class="futura">Current listings matching "'.get_search_query().'"</span>
					<hr class="color_">';
				}
				$thestart ? $thestart = date("m/d/y", $thestart) : $thestart = $thestart;
				$theend ? $theend = date("m/d/y", $theend) : $theend = $theend;
				$address = get_post_meta($thevenue, 'address', true);
				$zipcode = get_post_meta($post->ID, 'zipcode', true);
				$city = get_post_meta($post->ID, 'city', true);
				$state = get_post_meta($post->ID, 'state', true);
				$phone = get_post_meta($post->ID, 'phone', true);
				$website = get_post_meta($post->ID, 'website', true);
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				$venue = get_venue_link($thevenue, 'venue');
				$counter++;
				?>
				
				<div class="article">
					<h1 class="textcolor_<?php echo $categoryparent?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<div class="info">
						<strong><?php echo $venue ?></strong>
					</div>
					<div class="info">
						<?php echo $address ?><?php if($address2){ echo " ".$address2; } ?> <?php echo $city.', '.$state; ?> <?php echo $phone ?>
					</div>
				 	<div class="info">
						Opens: <?php echo $thestart ?>, Closes: <?php echo $theend ?>
					</div>
					<div class="info">
						<?php
						if($directlink == 'on'){
							?>
							<a href="<?php echo $website?>"><?php echo $website?></a>
							<?php
						}else{
							?>
							<?php echo $website?>
							<?php
						}
						?>
						<?php
						if($notes != ""){
							echo '
								<div class="notes">
								'.$notes.'
								</div>
							';
						}
						?>
					</div>
				</div>
				<?php
            
			}
			?>
        
        
        
		<?php 
        
        
			//               BY ARTICLE
        
        
		endwhile; 
		rewind_posts();
		$counter = 0;
		?>
		
		<?php while (have_posts()) : the_post(); ?>
			<?php 
        if ($post->post_type == 'post'){ 
				if($counter == 0){
					echo '<span class="futura">Articles matching "'.get_search_query().'"</span>
					<hr class="color_">';
				}
				?>
				
			<?php
		$title  = get_the_title();
		$keys= explode(" ",$s);
		$title  = preg_replace('/('.implode('|', $keys) .')/iu',
			'<strong class="search-excerpt">\0</strong>',
			 $title);
			?>
				<div class="article">
					
					<div id="date"><?php the_time('F jS, Y') ?></div>
					<br style="clear:both">
					<h1 class="textcolor_<?php echo $categoryparent?>"><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h1>
					<div id="date" style="padding-bottom:15px"><strong>by <?php the_author_posts_link(); ?> </strong></div>
					<br style="clear:both">
					<div id="body">
						<?php the_excerpt(); ?>
				</div>
			</div>
		<?php
				$counter++;
			}
        
		endwhile;
		?>
		

		<?php 
            if(function_exists('wp_paginate')) {
		  wp_paginate();
		      } 
        ?>
		<br>
	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar('archive'); ?>

<?php get_footer(); ?>