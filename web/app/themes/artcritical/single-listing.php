<?php
get_header();
?>
		<div id="main">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php
			$thevenue = get_post_meta($post->ID, 'thevenue', true);
			$thestart = get_post_meta($post->ID, 'thestart', true);
			$thestart ? $thestart = date("m/d/y", $thestart) : $thestart = $thestart;
			$theend = get_post_meta($post->ID, 'theend', true);
			$theend ? $theend = date("m/d/y", $theend) : $theend = $theend;
			$address = get_post_meta($post->ID, 'address', true);
			$zipcode = get_post_meta($post->ID, 'zipcode', true);
			$city = get_post_meta($post->ID, 'city', true);
			$notes = get_post_meta($event['ID'], 'notes', true);
			$state = get_post_meta($post->ID, 'state', true);
			$phone = get_post_meta($post->ID, 'phone', true);
			$website = get_post_meta($post->ID, 'website', true);
			$directlink = get_post_meta($thevenue, 'direct_link', true);
			$venue = get_venue_link($thevenue, 'venue');
			?>
			<h1 class="textcolor_<?php echo $categoryparent?>"><?php the_title(); ?></h1>
			<div class="listing">
				<?php if(has_post_thumbnail()){?>
				<div class="image">
					<?php the_post_thumbnail('featured_inside');?>
				</div>
				<?php } ?>
				<div id="allinfo">
					<div class="info">
						<strong><?php echo $venue ?></strong>
					</div>
					<div class="info">
						<?php echo $address ?>. <?php echo $phone ?>
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
				</div
				<br style="clear:both">
				<div class="excerpt">
					<?php the_excerpt();?>
				</div>
				<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=ABQIAAAAJZ2CRkRXxNPkGk3eCvnblxQAiCtCeZfDbzyjhnmP78Gs1zRu7hRbf1RVyp40T-DQOrL4qIUbfdAM_w" type="text/javascript"></script>
				<script>
					document.observe("dom:loaded", function() {

						var map = null;
					    var geocoder = null;
						initialize();

						function initialize() {
							if (GBrowserIsCompatible()) {
							map = new GMap2(document.getElementById("map_canvas"));
							map.setUIToDefault();
							geocoder = new GClientGeocoder();
							if (geocoder) {
								geocoder.getLatLng(
		 							'<?php echo $address." ".$city." ".$state." ".$zipcode ?>',
								function(point) {
									if (point) {
										map.setCenter(point, 13);
										var marker = new GMarker(point);
										map.addOverlay(marker);
										marker.openInfoWindowHtml("<strong><?php the_title()?></strong><br/><?php echo $address;?> <br/><?php echo $city.' '.$state.' '.$zipcode ?><br><?php echo $phone ?><br><a href='<?php echo $website ?>'><?php echo $website ?></a>");
									}
								});
							}
					      }
					    }
					});
				</script>
				<div id="map_canvas" style="width: 100%; height: 300px"></div><br>
			</div>
			
		</div>
				<?php endwhile; else: ?>

					<p>Sorry, no posts matched your criteria.</p>

			<?php endif; ?>
		<!-- sidebar -->
		<?php get_sidebar('venue'); ?>
		<br style="clear:both">
		<!-- footer -->
		<?php get_footer(); ?>