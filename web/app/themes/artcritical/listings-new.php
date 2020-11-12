<?php
/*
Template Name: Listings Test
*/

get_header();
?>

<div id="main-listings">

			

<hr style="background-color:white;" />
<section ng-controller="TabController as tab">
 
        <span class="listings-title" id="bycalendar_tab" ng-class="{ active:tab.isSet(1) }">
        	<a href="" ng-click="tab.setTab(1)">Week at a Glance</a>
        </span>

		<span class="listings-title" style="margin-left:12px" id="byneighborhood_tab" ng-class="{ active:tab.isSet(2) }">
			<a href="" ng-click="tab.setTab(2)" class="area-button">All shows</a>
		</span>

		<span class="listings-title" style="margin-left:12px" id="event_tab" ng-class="{ active:tab.isSet(3) }">
			<a href="" ng-click="tab.setTab(3)">Lectures/Events</a>
		</span>

<hr style="background-color:white;" />

          <div ng-show="tab.isSet(1)">
            <?php include 'partials/listings-week.html';?>
          </div>


          <div ng-show="tab.isSet(2)" class="area-tab">
          <?php include 'partials/listings-all.html';?>
          </div>

          <div ng-show="tab.isSet(3)">
          <?php include 'partials/listings-events.html';?>
          </div>

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
