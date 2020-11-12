<?php
/*
Template Name: Listings All Shows
*/

get_header();
?>

<div id="main-listings">

			

<hr style="background-color:white;" />
<section class="listings-all-top">
 


          <?php include 'partials/listings-allvenues.html';?>

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
