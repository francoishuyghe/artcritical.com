$thevenue = get_post_meta($event['ID'], 'thevenue', true);
				$venue = get_venue_link($thevenue);
				$address = get_post_meta($event['ID'], 'address', true);
				$notes = get_post_meta($event['ID'], 'notes', true);
				$title = get_the_title($event['ID']);
				$phone = get_post_meta($event['ID'], 'phone', true);
				$website = get_post_meta($event['ID'], 'website', true);
				$opening =  date("F d", get_post_meta($event['ID'], 'thestart', true));
				$ending = date("F d", get_post_meta($event['ID'], 'theend', true));
				$directlink = get_post_meta($thevenue, 'direct_link', true);
				if($area !== $lastarea){
                    if($area !==""){
					echo "<a class='area-anchor' name='".$area."'></a><h2 class='area-title'>".$area."</h2>";
                    }else{
                    echo "<a class='area-title' name='".$area."'><h2>".$area."</h2></a><p>There is no show in that neighborhood at the moment.</p>";
                    }
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
						<?php echo $opening ?> to <?php echo $ending ?>
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
						echo '<div class="notes">'.$notes.'</div>';
					}
					?>
			</div>
				<?php
				$lastarea = $area;