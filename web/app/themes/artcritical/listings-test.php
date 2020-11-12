<?php
/*
Template Name: Listings Test
*/

get_header();
?>

<div id="main-listings">

			

<hr style="background-color:white;" />
<section class="listings-all-top">
 
        <span class="listings-title" id="bycalendar_tab">
        	<a href="/listings-week">Week at a Glance</a>
        </span>

		<span class="listings-title active" style="margin-left:12px" id="byneighborhood_tab">
			<a href="/listings-all" class="area-button">All shows</a>
		</span>

		<span class="listings-title" style="margin-left:12px" id="event_tab">
			<a href="/listings-events">Lectures/Events</a>
		</span>

<hr style="background-color:white;" />

          <?php include 'partials/listings-all-test.html';?>

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
});
    
        jQuery('.area-check').change(function() {
            var cat = jQuery(this).attr("id");
            jQuery(".sub-"+cat).not(this).attr('checked', this.checked);
        });
    
        jQuery("[class*='sub-']").change(function(){
            var elClasses = jQuery( this ).attr( 'class' ).split ( ' ' );
                for ( var index in elClasses ) {
                    if ( elClasses[index].match( /^sub-\d+$/ ) ) {
                        var classNum = elClasses[index].split ( '-' )[1];
                        jQuery("#"+classNum).attr('checked', false);
                        break;
                    }
                }
        });
    
        jQuery("#mylist-button").click(function(){
            jQuery(".listing-check").each(function(){
                if (jQuery(this).attr("checked")){
                    var zeClass = jQuery( this ).attr( 'class' ).split ( ' ' );
                    for ( var index in zeClass ) {
                        var classy = zeClass[index];
                        console.log(classy);
                        if ( classy.match( /^check-\d+$/ ) ) {
                            var classNum = classy.split ( '-' )[1];
                            jQuery("#title_"+classNum).addClass("active");
                            }
                        if ( zeClass[index].match( /^sub-\d+$/ ) ) {
                            var hoodNum = zeClass[index].split ( '-' )[1];
                            jQuery(".hood_"+hoodNum).addClass("active");
                            console.log("Hood: "+hoodNum);
                            }
                        if ( zeClass[index].match( /^area-\d+$/ ) ) {
                            var bighoodNum = zeClass[index].split ( '-' )[1];
                            jQuery(".bighood_"+bighoodNum).addClass("active");
                            console.log("Big Hood: "+bighoodNum);
                            break;
                            }
                }
                }
            });
            jQuery(".listing").not(".active").each(function(){
                jQuery(this).css("display", "none");
            });
            jQuery(".hood-title").not(".active").each(function(){
                jQuery(this).css("display", "none");
            });
            jQuery(".area-wrap").not(".active").each(function(){
                jQuery(this).css("display", "none");
            });
        });
        
        jQuery("#reset-button").click(function(){
            jQuery(".listing-check").attr('checked', false);
            jQuery(".listing").each(function(){
                jQuery(this).css("display", "block");
            });
            jQuery(".hood-title").each(function(){
                jQuery(this).css("display", "block");
            });
            jQuery(".area-wrap").each(function(){
                jQuery(this).css("display", "block");
            });
        });



</script>

<?php get_footer(); ?>
