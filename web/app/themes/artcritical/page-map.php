<?php
/*
Template Name: Listings All Shows
*/

get_header();
?>

<div id="main-listings">

			<?php
			$query = "SELECT `wp_posts`.`ID`, `quartier`.`meta_value` AS `thequartier`, `street`.`meta_value` AS `thestreet`, `number`.`meta_value` AS `thenumber`, `block`.`meta_value` AS `theblock`
        FROM `wp_posts`, `wp_postmeta` AS `quartier`, `wp_postmeta` AS `street`, `wp_postmeta` AS `number`, `wp_postmeta` AS `block`

        WHERE `wp_posts`.`post_type` = 'venue'

        AND `wp_posts`.`ID` = `quartier`.`post_id`
        AND `wp_posts`.`ID` = `street`.`post_id`
        AND `wp_posts`.`ID` = `block`.`post_id`
        AND `wp_posts`.`ID` = `number`.`post_id`

        AND `quartier`.`meta_key` = 'quartier'
        AND `street`.`meta_key` = 'street'
        AND `number`.`meta_key` = 'number'
        AND `block`.`meta_key` = 'block'

        AND `wp_posts`.`post_status` = 'publish'

        GROUP BY `wp_posts`.`ID`
        ORDER BY `thequartier` + 0 ASC";
            
            $wpdb->query("SET SQL_BIG_SELECTS=1");
			$calendar = $wpdb->get_results($query, ARRAY_A);
            
            foreach ($calendar as $key => $row) {
                $thequartier[$key]  = $row['thequartier'];
                $thestreet[$key] = $row['thestreet'];
                $theblock[$key] = $row['theblock'];
                $thenumber[$key] = $row['thenumber'];
            }

            // Sort the data with volume descending, edition ascending
            array_multisort($thequartier, SORT_ASC, $theblock, SORT_ASC, $thestreet, SORT_ASC, $thenumber, SORT_ASC, $calendar);

                        ?>


<div id="map" style="height:800px;"></div>
    <script>

      // This example displays a marker at the center of Australia.
      // When the user clicks the marker, an info window opens.

      function initMap() {
          
        var newyork = {lat: 40.7477381, lng: -74.0238805};
          
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: newyork
        });
          
        var infowindow = null;
          
        			<?php
                $i = 0;
                foreach($calendar as $event){ 
				$title = get_the_title($event['ID']);
				$area = get_post_meta($event['ID'], 'quartier', true);
                $block = get_post_meta($event['ID'], 'block', true);
                $street = get_post_meta($event['ID'], 'street', true);
                $number = get_post_meta($event['ID'], 'number', true);
				$address = get_post_meta($event['ID'], 'address', true);
                $address2 = get_post_meta($event['ID'], 'address2', true);
                $city = get_post_meta($event['ID'], 'city', true);
                $state = get_post_meta($event['ID'], 'state', true);
                $zip = get_post_meta($event['ID'], 'zipcode', true);
                $gps1 = get_post_meta($event['ID'], 'gps1', true);
                $gps2 = get_post_meta($event['ID'], 'gps2', true);
                $phone = get_post_meta($event['ID'], 'phone', true);
				$website = get_post_meta($event['ID'], 'website', true);
                $directlink = get_post_meta($event['ID'], 'direct_link', true);
                ?>

				
				


        var venueInfo<?php echo $i; ?> = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading"><?php echo $title; ?></h1>'+
            '<div id="bodyContent">'+
            '<p><?php echo $address." ".$address2." ".$city." ".$state." ".$zip; ?></p>'+
            '</div>'+
            '</div>';
          
        

          
        var coord<?php echo $i; ?> = {lat: <?php if( $gps1 !=='' ){echo $gps1;} else {echo '0';} ?>, lng: <?php if( $gps1 !=='' ){echo $gps2;}else{echo '0';} ?>};
              
        var marker<?php echo $i; ?> = new google.maps.Marker({
                map: map,
                position: coord<?php echo $i; ?>,
                title: '<?php echo $title; ?>'
              });

        
            marker<?php echo $i; ?>.addListener('click', function() {
                if (infowindow) {
                    infowindow.close();
                }
                infowindow = new google.maps.InfoWindow({
                  content: venueInfo<?php echo $i; ?>
                });
                infowindow.open(map, marker<?php echo $i; ?>);
            });
         
          
          <?php 
                $i ++;
                } ?>
        
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZzR7hbFKiOIFDuTi8DI5Csrn3K0vFJdc&callback=initMap">
    </script>
    
    

    

		
		
</div>

<?php //get_sidebar('listings'); ?>



<?php get_footer(); ?>
