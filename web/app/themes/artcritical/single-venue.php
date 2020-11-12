<?php
get_header();
?>
		<div id="main">
			<span class="arrow"> &#x25C4; </span> <span class="futura"><a href="#" onClick="history.go(-1)">Back</a></span>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php
			$address = get_post_meta($post->ID, 'address', true);
			$zipcode = get_post_meta($post->ID, 'zipcode', true);
			$city = get_post_meta($post->ID, 'city', true);
			$state = get_post_meta($post->ID, 'state', true);
			$phone = get_post_meta($post->ID, 'phone', true);
			$website = get_post_meta($post->ID, 'website', true);
			?>
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
			<div id="archived_shows">
				<h2>Archived shows at <?php the_title();?>:</h2><br><br>
				<?php
				$args = array(
					'post_type' => 'listing',
					'post_status'  => 'publish',
					'orderby' => 'date',
					'order' => 'DESC',
					'meta_key' => 'thevenue',
					'meta_value' => $post->ID,
					'nopaging' => true
				);
				$shows = new WP_Query($args);
				if ($shows->have_posts()) : while ($shows->have_posts()) : $shows->the_post();?>
					<a href="<?php the_permalink(); ?>"><?php the_title()?></a>
				<?php
				endwhile;
				endif;
				?>
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