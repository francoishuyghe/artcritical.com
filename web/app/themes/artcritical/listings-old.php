<?php
/*
Template Name: Listings
*/

get_header();
isset($_GET['tab']) ? $tab = $_GET['tab'] : $tab = 'oc';
?>
	<div id="main">
		<span class="futura <?php if($tab == 'oc') echo "selected" ?>"id="bycalendar_tab"><a href="?tab=oc">Week at a Glance</a></span>
		<span class="futura <?php if($tab == 'show') echo "selected" ?>" style="margin-left:12px" id="byshow_tab"><a href="?tab=show">By Show</a></span>
		<span class="futura <?php if($tab == 'venue') echo "selected" ?>" style="margin-left:12px" id="byvenue_tab"><a href="?tab=venue">By Venue</a></span>
		<span class="futura <?php if($tab == 'hood') echo "selected" ?>" style="margin-left:12px" id="byneighborhood_tab"><a href="?tab=hood">By Neighborhood</a></span>
		<span class="futura <?php if($tab == 'events') echo "selected" ?>" style="margin-left:12px" id="event_tab"><a href="?tab=events">Lectures / Panels / Events</a></span>
		<hr style="background-color:#95e5c8">
		<?php if($tab == 'oc'){?>
		<div id="bycalendar" >
			<?php
			$args = array(
				'post_type' => 'listing',
				'post_status'  => 'publish',
				'post__not_in' => array($post->ID),
				'orderby' => 'date',
				'order' => 'DESC',
				'meta_key' => 'featured_calendar',
				'meta_value' => 'on',
				'posts_per_page' => 1
			);	
			$featured = new WP_Query($args);
			if ($featured->have_posts()) : while ($featured->have_posts()) : $featured->the_post();
				$thevenue = get_post_meta($post->ID, 'thevenue', true);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$website = get_post_meta($post->ID, 'website', true);
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				?>
				<div id="featured">
					<div id="thumb">
				<?php the_post_thumbnail(); ?>
					</div>
					<h2><?php the_title()?></h2>
					<div id="gallery" class="info"><?php echo get_venue_link($thevenue); ?></div>
					<div id="address" class="info"><?php echo get_post_meta($post->ID, 'address', true)?></div>
					<div id="phone" class="info"><?php echo get_post_meta($post->ID, 'phone', true)?></div>
					<div id="excerpt">
						<?php the_excerpt();?>
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
					</div>
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
				<?php

			endwhile;
			endif;
			?>
			<div id="daysoftheweek" class="listing_list">
			<?php
			//OPENING AND CLOSING THIS WEEK
			$today = date('l');
			$today_num = date('N');
			$daysoftheweek[] = "Monday";
			$daysoftheweek[] = "Tuesday";
			$daysoftheweek[] = "Wednesday";
			$daysoftheweek[] = "Thursday";
			$daysoftheweek[] = "Friday";
			$daysoftheweek[] = "Saturday";
			
			$days = array();
			$days[] = date('U', strtotime('Last Sunday'));
			foreach($daysoftheweek as $day){
				if($today_num > date('N', strtotime($day)) ){
					$days[] = date('U', strtotime('Last '. $day));
				}else{
					$days[] = date('U', strtotime($day));
				}
			}
			$days[] = date('U', strtotime('Next Sunday'));
			
			for($i = 0; $i < count($days); $i++){
				
				//get listings
				$query = "SELECT * FROM `wp_posts` AS `wp` INNER JOIN `wp_postmeta` AS `pm` ON `pm`.`post_id` = `wp`.`id` WHERE `wp`.`post_type` = 'listing' AND `pm`.`meta_key` = 'theend' AND CAST(`pm`.`meta_value` AS UNSIGNED) = ".$days[$i]."";
				
				$endingcalendar = $wpdb->get_results($query, ARRAY_A);

				$query = "SELECT * FROM `wp_posts` AS `wp` INNER JOIN `wp_postmeta` AS `pm` ON `pm`.`post_id` = `wp`.`id` WHERE `wp`.`post_type` = 'listing' AND `pm`.`meta_key` = 'thestart' AND CAST(`pm`.`meta_value` AS UNSIGNED) = ".$days[$i]."";
				
				$openingcalendar = $wpdb->get_results($query, ARRAY_A);
				if(!empty($endingcalendar) || !empty($openingcalendar)){
		
				?>
				<div class="day">
					<h2 ><?php echo date('l (m/d)', $days[$i])?></h2>
					<?php if (!empty($openingcalendar)){
						echo "<h4>Opening:</h4>";
						foreach($openingcalendar as $event){
							$thevenue = get_post_meta($event['ID'], 'thevenue', true);
							$venue = get_venue_link($thevenue);
							$address = get_post_meta($event['ID'], 'address', true);
							$title = get_the_title($event['ID']);
							$notes = get_post_meta($event['ID'], 'notes', true);
							$phone = get_post_meta($event['ID'], 'phone', true);
							$website = get_post_meta($event['ID'], 'website', true);
							$opening =  date("m/d", get_post_meta($event['ID'], 'thestart', true));
							$ending = date("m/d", get_post_meta($event['ID'], 'theend', true));
							$directlink = get_post_meta($thevenue, 'direct_link', true);
							?>
							<div class="listing">
								<div id="title_<?php echo $event['ID']?>" class="info">
									<strong><?php echo $title ?> at <?php echo $venue ?></strong>
								</div>
								<div id="address_<?php echo $event['ID']?>" class="info">
									<?php echo $address ?>. <?php echo $phone ?>
								</div>
							 	<div id="dates_<?php echo $event['ID']?>" class="info">
									Opens: <?php echo $opening ?>, Closes: <?php echo $ending ?>
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

								</div>
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
							<?php
						}
					}?>
					<?php if (!empty($endingcalendar)){
						echo "<h4>Closing:</h4>";
						foreach($endingcalendar as $event){
							$thevenue = get_post_meta($event['ID'], 'thevenue', true);
							$venue = get_venue_link($thevenue);
							$title = get_the_title($event['ID']);
							$notes = get_post_meta($event['ID'], 'notes', true);
							$address = get_post_meta($event['ID'], 'address', true);
							$phone = get_post_meta($event['ID'], 'phone', true);
							$website = get_post_meta($event['ID'], 'website', true);
							$opening =  date("m/d", get_post_meta($event['ID'], 'thestart', true));
							$ending = date("m/d", get_post_meta($event['ID'], 'theend', true));
							$directlink = get_post_meta($thevenue, 'direct_link', true);
							
							?>
							<div class="listing">
								<div id="title_<?php echo $event['ID']?>" class="info">
									<strong><?php echo $title ?> at <?php echo $venue ?></strong>
								</div>
								<div id="address_<?php echo $event['ID']?>" class="info">
									<?php echo $address ?>. <?php echo $phone ?>
								</div>
							 	<div id="dates_<?php echo $event['ID']?>" class="info">
									Opens: <?php echo $opening ?>, Closes: <?php echo $ending ?>
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

								</div>
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
							<?php
						}
					}?>
					</div>
					
				<?php
				}
			}
			?>
			</div>
		</div>
		<?php } if($tab == 'show') { ?>
			<?php
			$args = array(
				'post_type' => 'listing',
				'post_status'  => 'publish',
				'post__not_in' => array($post->ID),
				'orderby' => 'date',
				'order' => 'DESC',
				'meta_key' => 'featured_show',
				'meta_value' => 'on',
				'posts_per_page' => 1
			);	
			$featured = new WP_Query($args);
			if ($featured->have_posts()) : while ($featured->have_posts()) : $featured->the_post();
				$thevenue = get_post_meta($post->ID, 'thevenue', true);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$website = get_post_meta($post->ID, 'website', true);
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				?>
				<div id="featured">
					<div id="thumb">				<?php the_post_thumbnail(); ?></div>
					<h2><?php the_title()?></h2>
					<div id="gallery" class="info"><?php echo get_venue_link($thevenue); ?></div>
					<div id="address" class="info"><?php echo get_post_meta($post->ID, 'address', true)?></div>
					<div id="phone" class="info"><?php echo get_post_meta($post->ID, 'phone', true)?></div>
					<div id="excerpt">
						<?php the_excerpt();?>
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
					</div>
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
				<?php

			endwhile;
			endif;
			?>
		<div id="byshow" class="archive_list listing_list">
			<?php
			
			$query = "SELECT `wp_posts`.`post_title`, `wp_posts`.`ID`, `end`.`meta_value` as `enddate`, `start`.`meta_value` as `startdate` FROM `wp_posts`, `wp_postmeta` as `end`, `wp_postmeta` as `start` WHERE `wp_posts`.`post_type` = 'listing' AND (`wp_posts`.`ID` = `end`.`post_id` AND `end`.`meta_key` = 'theend' AND `end`.`meta_value` >= ".(time()+86400).") AND (`wp_posts`.`ID` = `start`.`post_id` AND `start`.`meta_key` = 'thestart' AND `start`.`meta_value` <= ".time().") AND `wp_posts`.`post_status` = 'publish' GROUP BY `wp_posts`.`ID` ORDER BY `wp_posts`.`post_title` ASC";
			//echo $query;
			$calendar = $wpdb->get_results($query, ARRAY_A);
			foreach($calendar as $event){
				$thevenue = get_post_meta($event['ID'], 'thevenue', true);
				$venue = get_venue_link($thevenue);
				$title = get_the_title($event['ID']);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$address = get_post_meta($event['ID'], 'address', true);
				$phone = get_post_meta($event['ID'], 'phone', true);
				$website = get_post_meta($event['ID'], 'website', true);
				$opening =  date("m/d", get_post_meta($event['ID'], 'thestart', true));
				$ending = date("m/d", get_post_meta($event['ID'], 'theend', true));
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				?>
				<div class="listing" style="padding-bottom:20px">
					<div id="title_<?php echo $event['ID']?>" class="info">
						<strong><?php echo $title; ?> at <?php echo $venue ?></strong>
					</div>
					<div id="address_<?php echo $event['ID']?>" class="info">
						<?php echo $address ?>. <?php echo $phone ?>
					</div>
				 	<div id="dates_<?php echo $event['ID']?>" class="info">
						Opens: <?php echo $opening ?>, Closes: <?php echo $ending ?>
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
					</div>
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
				<?php
			}
			?>
		</div>
		<?php } else if($tab == 'venue') { ?>
			<?php
			$args = array(
				'post_type' => 'listing',
				'post_status'  => 'publish',
				'post__not_in' => array($post->ID),
				'orderby' => 'date',
				'order' => 'DESC',
				'meta_key' => 'featured_venue',
				'meta_value' => 'on',
				'posts_per_page' => 1
			);	
			$featured = new WP_Query($args);
			if ($featured->have_posts()) : while ($featured->have_posts()) : $featured->the_post();
				$thevenue = get_post_meta($post->ID, 'thevenue', true);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$website = get_post_meta($post->ID, 'website', true);
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				?>
				<div id="featured">
					<div id="thumb">				<?php the_post_thumbnail(); ?></div>
					<h2><?php the_title()?></h2>
					<div id="gallery" class="info"><?php echo get_venue_link($thevenue); ?></div>
					<div id="address" class="info"><?php echo get_post_meta($post->ID, 'address', true)?></div>
					<div id="phone" class="info"><?php echo get_post_meta($post->ID, 'phone', true)?></div>
					<div id="excerpt">
						<?php the_excerpt();?>
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
					</div>
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
				<?php

			endwhile;
			endif;
			?>
		<div id="byvenue" class="archive_list listing_list">
			<?php
			$query = "SELECT `wp_posts`.`post_title`, `wp_posts`.`ID`, `end`.`meta_value` as `enddate`, `start`.`meta_value` as `startdate`, `venue`.`meta_value` as `thevenue` FROM `wp_posts`, `wp_postmeta` as `end`, `wp_postmeta` as `start`, `wp_postmeta` as `venue` WHERE `wp_posts`.`post_type` = 'listing' AND (`wp_posts`.`ID` = `end`.`post_id` AND `end`.`meta_key` = 'theend' AND `end`.`meta_value` >= ".(time()+86400).") AND (`wp_posts`.`ID` = `start`.`post_id` AND `start`.`meta_key` = 'thestart' AND `start`.`meta_value` <= ".time().") AND (`wp_posts`.`ID` = `venue`.`post_id` AND `venue`.`meta_key` = 'thevenuename') AND `wp_posts`.`post_status` = 'publish' GROUP BY `wp_posts`.`ID` ORDER BY `thevenue` ASC";
			
			$calendar = $wpdb->get_results($query, ARRAY_A);
			foreach($calendar as $event){
				$thevenue = get_post_meta($event['ID'], 'thevenue', true);
				$venue = get_venue_link($thevenue);
				$address = get_post_meta($event['ID'], 'address', true);
				$title = get_the_title($event['ID']);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$phone = get_post_meta($event['ID'], 'phone', true);
				$website = get_post_meta($event['ID'], 'website', true);
				$opening =  date("m/d", get_post_meta($event['ID'], 'thestart', true));
				$ending = date("m/d", get_post_meta($event['ID'], 'theend', true));
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				?>
				<div class="listing" style="padding-bottom:20px">
					<div id="title_<?php echo $event['ID']?>" class="info">
						<strong><?php echo $title ?> at <?php echo $venue ?></strong>
					</div>
					<div id="address_<?php echo $event['ID']?>" class="info">
						<?php echo $address ?>. <?php echo $phone ?>
					</div>
				 	<div id="dates_<?php echo $event['ID']?>" class="info">
						Opens: <?php echo $opening ?>, Closes: <?php echo $ending ?>
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
		</div>
		<?php } else if($tab == 'events') { ?>
			<?php
			$args = array(
				'post_type' => 'listing',
				'post_status'  => 'publish',
				'post__not_in' => array($post->ID),
				'orderby' => 'date',
				'order' => 'DESC',
				'meta_key' => 'featured_events',
				'meta_value' => 'on',
				'posts_per_page' => 1
			);	
			$featured = new WP_Query($args);
			if ($featured->have_posts()) : while ($featured->have_posts()) : $featured->the_post();
				$thevenue = get_post_meta($post->ID, 'thevenue', true);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$website = get_post_meta($post->ID, 'website', true);
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				?>
				<div id="featured">
					<div id="thumb">				<?php the_post_thumbnail(); ?></div>
					<h2><?php the_title()?></h2>
					<div id="gallery" class="info"><?php echo get_venue_link($thevenue); ?></div>
					<div id="address" class="info"><?php echo get_post_meta($post->ID, 'address', true)?></div>
					<div id="phone" class="info"><?php echo get_post_meta($post->ID, 'phone', true)?></div>
					<div id="excerpt">
						<?php the_excerpt();?>
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
					</div>
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
				<?php

			endwhile;
			endif;
			?>
		<div id="events" class="archive_list listing_list">
			<?php
			$query = "SELECT `wp_posts`.`post_title` , `wp_posts`.`ID` , `end`.`meta_value` AS `enddate` , `event`.`meta_value` AS `event_check`
			FROM `wp_posts` , `wp_postmeta` AS `end` , `wp_postmeta` AS `event`
			WHERE `wp_posts`.`post_type` = 'listing'
			AND (
			`wp_posts`.`ID` = `end`.`post_id`
			AND `end`.`meta_key` = 'theend'
			AND `end`.`meta_value` >=".(time()+86400)."
			)
			AND `wp_posts`.`post_status` = 'publish'
			AND (
			`wp_posts`.`ID` = `event`.`post_id`
			AND `event`.`meta_key` = 'event'
			AND `event`.`meta_value` = 'on'
			)
			GROUP BY `wp_posts`.`ID`
			ORDER BY `enddate` ASC";
			//echo $query;
			$calendar = $wpdb->get_results($query, ARRAY_A);
			foreach($calendar as $event){
				$thevenue = get_post_meta($event['ID'], 'thevenue', true);
				$venue = get_venue_link($thevenue);
				$address = get_post_meta($event['ID'], 'address', true);
				$title = get_the_title($event['ID']);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$phone = get_post_meta($event['ID'], 'phone', true);
				$website = get_post_meta($event['ID'], 'website', true);
				$opening =  date("m/d", get_post_meta($event['ID'], 'thestart', true));
				$ending = date("m/d", get_post_meta($event['ID'], 'theend', true));
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				?>
				<div class="listing" style="padding-bottom:20px">
					<div id="title_<?php echo $event['ID']?>" class="info">
						<strong><?php echo $title ?> at <?php echo $venue ?></strong>
					</div>
					<div id="address_<?php echo $event['ID']?>" class="info">
						<?php echo $address ?>. <?php echo $phone ?>
					</div>
				 	<div id="dates_<?php echo $event['ID']?>" class="info">
						Opens: <?php echo $opening ?>, Closes: <?php echo $ending ?>
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
		</div>












		<?php } else if($tab == 'hood') { ?>
			<?php
			$args = array(
				'post_type' => 'listing',
				'post_status'  => 'publish',
				'post__not_in' => array($post->ID),
				'orderby' => 'date',
				'order' => 'DESC',
				'meta_key' => 'featured_neighborhood',
				'meta_value' => 'on',
				'posts_per_page' => 1
			);	
			$featured = new WP_Query($args);
			if ($featured->have_posts()) : while ($featured->have_posts()) : $featured->the_post();
				$thevenue = get_post_meta($post->ID, 'thevenue', true);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$website = get_post_meta($post->ID, 'website', true);
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				?>
				<div id="featured_hood">
					<div id="thumb">				<?php the_post_thumbnail(); ?></div>
					<h2><?php the_title()?></h2>
					<div id="gallery" class="info"><?php echo get_venue_link($thevenue); ?></div>
					<div id="address" class="info"><?php echo get_post_meta($post->ID, 'address', true)?></div>
					<div id="phone" class="info"><?php echo get_post_meta($post->ID, 'phone', true)?></div>
					<div id="excerpt">
						<?php the_excerpt();?>
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
					</div>
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
				<hr>
				<?php

			endwhile;
			endif;
			?>
		<div id="byneighborhood" class="archive_list">
			<?php
			$tags = get_terms('neighborhoods');
			//print_r($tags);
			?>
			<div id="neighborhood_menu">
				<?php
				foreach($tags as $tag){
					echo "<div class=\"neighborhood_link\"><a href=\"#".$tag->name."\">".$tag->name."</a></div>";
				}
				?>
			</div>
			
			
			
			<div style="float:right; width:70%">
			<?php
			$query = "SELECT `wp_posts`.`post_title` , `wp_posts`.`ID` , `end`.`meta_value` AS `enddate` , `start`.`meta_value` as `startdate`, `area`.`meta_value` AS `thearea`
			FROM `wp_posts` , `wp_postmeta` AS `end` , `wp_postmeta` AS `start` , `wp_postmeta` AS `area`
			WHERE `wp_posts`.`post_type` = 'listing'
			AND (
			`wp_posts`.`ID` = `end`.`post_id`
			AND `end`.`meta_key` = 'theend'
			AND `end`.`meta_value` >= '".(time()+86400)."'
			)
			AND (
			`wp_posts`.`ID` = `start`.`post_id`
			AND `start`.`meta_key` = 'thestart'
			AND `start`.`meta_value` <= '".time()."'
			)
			AND (
			`wp_posts`.`ID` = `area`.`post_id`
			AND `area`.`meta_key` = 'area'
			)
			AND `wp_posts`.`post_status` = 'publish'
			GROUP BY `wp_posts`.`ID`
			ORDER BY `thearea` ASC";
			$calendar = $wpdb->get_results($query, ARRAY_A);

			foreach($calendar as $event){
				$area = get_post_meta($event['ID'], 'area', true);
				$thevenue = get_post_meta($event['ID'], 'thevenue', true);
				$venue = get_venue_link($thevenue);
				$address = get_post_meta($event['ID'], 'address', true);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$title = get_the_title($event['ID']);
				$phone = get_post_meta($event['ID'], 'phone', true);
				$website = get_post_meta($event['ID'], 'website', true);
				$opening =  date("m/d", get_post_meta($event['ID'], 'thestart', true));
				$ending = date("m/d", get_post_meta($event['ID'], 'theend', true));
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				if($area !== $lastarea){
					echo "<a name='".$area."'><h2>".$area."</h2></a>";
				}
				?>
				<div class="listing" style="padding-bottom:20px">
					<div id="title_<?php echo $event['ID']?>" class="info">
						<strong><?php echo $title ?> at <?php echo $venue ?></strong>
					</div>
					<div id="address_<?php echo $event['ID']?>" class="info">
						<?php echo $address ?>. <?php echo $phone ?>
					</div>
				 	<div id="dates_<?php echo $event['ID']?>" class="info">
						Opens: <?php echo $opening ?>, Closes: <?php echo $ending ?>
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
					</div>
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
				<?php
				$lastarea = $area;
			}
			?>
			</div>
			</div>
			<?
		}?>
	</div>

<?php get_sidebar('listings'); ?>

<?php get_footer(); ?>
