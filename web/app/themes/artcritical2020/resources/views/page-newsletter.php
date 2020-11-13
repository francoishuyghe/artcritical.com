<?php
/*
Template Name: Listings Test
*/ ?>



<table style="width: 700px; margin: 0px auto; font-family: Verdana, Helvetica, sans; font-size: 11px; line-height: 16px;" cellspacing="0" cellpadding="5" border="0">
<tbody>
<tr>
<td colspan="3" style="text-align: right;"><a href="http://ymlp.com/z8flTQ">Click here to view this email in your browser</a></td>
</tr>
<tr>
<td colspan="3"><a href="http://www.artcritical.com" target="_blank"><img style="border: 0pt none;" width="700" height="70" src="http://thumbnail.ymlp.com/artcritical_bannertop.png" /></a></td>
</tr>


    <?php
$args = array(
	'meta_key' => 'newsletter_intro',
	'meta_value'  => 'on',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 1
);
query_posts($args); ?>

    
<?php while (have_posts()) : the_post(); ?>
    
<tr>
    <td colspan="3" style="text-align: right;">
    artcritical's comprehensive guide to art and events <a href="http://www.artcritical.com/listings-week/" target="_blank" style="color: #fff; background-color: #d70b00; padding: 5px 10px; text-decoration: none; font-size: 16px; font-weight: 400;">THE LIST</a>
    </td></tr>
    
<tr>
<td  style="padding-top: 50px;"><a href="<?php the_permalink()?>" target="_blank"><img style="border: 0pt none;" width="200" height="auto" src="<?php echo the_post_thumbnail_url(); ?>" /></a></td>
    
<td colspan="2" style="vertical-align:top; padding-top: 50px;"><h1 style="font-weight: 400; color: #d70b00; font-size: 20px; line-height:25px; margin: 5px 0 5px 0;"><?php the_title();?></h1>
    <h3 style="font-size: 12px; color: #666; font-weight: 400; margin-top:0;">by <?php echo get_the_author(); ?> </h3>
    <?php the_content(); ?></td>

</tr>
    
<?php endwhile;?>

    
    
<tr style="height: 40px;">
<td colspan="3" style="padding: 30px 0;">
<hr style="border-top: 5px solid #ee6464;" />
</td>
</tr>
    
    
    
    
<tr>
<td colspan="3" style="text-align:left;">
<?php
$args = array(
	'meta_key' => 'newsletter_cover',
	'meta_value'  => 'on',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 1
);
query_posts($args);
?>
<?php if (have_posts())  : ?>
	<?php while (have_posts()) : the_post(); 
    ?>
		<?php $coverid = $post->ID;?>
        <?php $coverpicurl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
		<?php $coverdescription = App\get_fronttop3_excerpt(255);?>
           
            <h1 style="font-weight: 400; color: #d70b00; font-size: 20px; line-height:25px; margin: 5px 0 25px 0;"><?php the_title();?></h1>
			<?php the_content(); ?>
	<?php endwhile;?>
<?php endif;?>
</td>
</tr>
    

    
    
<tr style="height: 40px; text-align: center;">
<td colspan="3">
    <?php



			//			<script language="JavaScript" type="text/javascript">

				//		window.dctile = Number(window.dctile) + 1 || 1;

			//			window.dc_ord = Number(window.dc_ord) || Math.floor(Math.random() * 1E10);

			//			if (dctile==1) {var vdcopt = 'ist';} else {vdcopt = '';}

		//				if (17>dctile) document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/nym.vulturenetwork.artcritical/Homepage;dcopt=' + vdcopt + ';tile=' + dctile + ';sz=728x90;ord=' + dc_ord + '?"><\/script>\n');

			//			</script>

//          		<noscript><a href="http://ad.doubleclick.net/jump/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?"><img src="http://ad.doubleclick.net/ad/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?" border="0"></a></noscript>

                            ?>

    
    </td>
</tr>


   

    
    
<tr>
<td colspan="3">
<h1 style="font-weight: 400; font-color: #888; font-size: 14px;">New this week on artcritical</h1>
</td>
</tr>
    
<?php
$args = array(
	'meta_key' => 'newsletter',
	'meta_value'  => 'on',
	'orderby' => 'date',
	'order' => 'DESC',
	'posts_per_page' => 5
);
query_posts($args); ?>

    
<?php while (have_posts()) : the_post(); 
?>
<tr>
    <td><a href="<?php the_permalink()?>" target="_blank"><img style="border: 0pt none;" width="200" height="148" src="<?php echo postimage('featured_front'); ?>" /></a></td>
<td style="vertical-align:top;">
<span style="list-style-type:none; color:#8a0700; font-weight:bold; font-size: 14px; padding-bottom:5px;"><?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' ';} ?></span>
    <a href="<?php the_permalink()?>" style="text-decoration: none; color:black;" target="_blank" ><h2 style="font-weight: bold; font-size: 16px; margin: 5px 0;"><?php the_title(); ?></h2></a>
					<span style="color: #7c7c7c; text-transform: lowercase; font-variant: small-caps; font-size: 16px; ">by <?php the_author(); ?></span>
					<p><?php echo get_newsletter_excerpt($link); ?></p>
                    <a href="<?php the_permalink()?>" target="_blank" style="font-weight:300; color:black">Read More</a>
</td>
</tr>
<?php endwhile;?>

    
     <tr >
        <td colspan="3" style="text-align:center; padding-top:50px;">
        <?php    
            
            //            <script language="JavaScript" type="text/javascript">

			//			window.dctile = Number(window.dctile) + 1 || 1;

			//			window.dc_ord = Number(window.dc_ord) || Math.floor(Math.random() * 1E10);

			//			if (dctile==1) {var vdcopt = 'ist';} else {vdcopt = '';}

			//			if (17>dctile) document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/nym.vulturenetwork.artcritical/Homepage;dcopt=' + vdcopt + ';tile=' + dctile + ';sz=728x90;ord=' + dc_ord + '?"><\/script>\n');

			//			</script>

			//			<noscript><a href="http://ad.doubleclick.net/jump/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?"><img src="http://ad.doubleclick.net/ad/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?" border="0"></a></noscript>
            
            ?>
    </td></tr>


<tr>
<td colspan="3" style="text-align: right; font-size: 9px;"><a href="http://ymlp.com/u.php?id=gusymmqg">Change email address / Leave mailing list</a></td>
</tr>
</tbody>
</table>