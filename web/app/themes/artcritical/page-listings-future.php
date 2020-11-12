<?php
/*
Template Name: Listings All Shows
*/

get_header();
?>

<div id="main-listings">

			

<hr style="background-color:white;" />
<section class="listings-all-top">
 
        <span class="listings-title" id="bycalendar_tab">
        	<a href="<?php echo site_url(); ?>/listings-week">Week at a Glance</a>
        </span>

		<span class="listings-title" style="margin-left:12px" id="byneighborhood_tab">
			<a href="<?php echo site_url(); ?>/listings-all" class="area-button">Current</a>
		</span>

		<span class="listings-title" style="margin-left:12px" id="event_tab">
			<a href="<?php echo site_url(); ?>/listings-events">Lectures/Events</a>
		</span>
    
        <span class="listings-title active" style="margin-left:12px" id="future_tab">
			<a href="<?php echo site_url(); ?>/listings-future">Future Shows</a>
		</span>

<hr style="background-color:white;" />

          <?php include 'partials/listings-all-future.html';?>

</section>
		
		
</div>

<?php //get_sidebar('listings'); ?>

<script type="text/javascript">

jQuery(document).ready(function(){
    
    
    var  mn = jQuery(".area_list");
    mns = "sticky";
    
    ph = jQuery(".placeholder");
    
    jQuery(window).scroll(function(){
        
        hdr = 118;
        jQuery('.area-anchor').css('top', -150);
        
    if( jQuery(this).scrollTop() >= 275 ) {
    mn.addClass(mns);
    jQuery(".arrow-up").addClass("active");
    ph.css("width", mn.width()).css("height", mn.height());
    } else {
    mn.removeClass(mns);
    jQuery(".arrow-up").removeClass("active");
    ph.css("width", "0").css("height", "0");
  }

    })
})
</script>

<?php get_footer(); ?>
