<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"

   "http://www.w3.org/TR/html4/strict.dtd">



<html lang="en" ng-app="artCritical" >

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title><?php wp_title('/', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<style type="text/css">

		@import url("<?php bloginfo('stylesheet_url'); ?>");

	</style>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" />

	<?php wp_head(); ?>

	<?php wp_print_scripts();?>
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon.png">
	
	<script src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.1.0/prototype.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.3/scriptaculous.js"></script>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/js/functions.js" type="text/javascript"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.8/angular-route.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/coffee-script/1.4.0/coffee-script.min.js"></script>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/js/app.js"></script>
    


	



</head>

<body>

	<div class="container">

		<div id="header">

			<div id="topmenucontainer">

				<div id="logo" style="padding-top:15px;float:left;height:70px"><a href="<?php bloginfo('url')?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png"></a></div>







				<div id="vulture728x90" style="float:right; margin-bottom:10px;margin-top:3px;">

					<?php if (is_home()):?>









                                               <!-- BANNER AD FOR HOME PAGE -->



						<script language="JavaScript" type="text/javascript">

						window.dctile = Number(window.dctile) + 1 || 1;

						window.dc_ord = Number(window.dc_ord) || Math.floor(Math.random() * 1E10);

						if (dctile==1) {var vdcopt = 'ist';} else {vdcopt = '';}

						if (17>dctile) document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/nym.vulturenetwork.artcritical/Homepage;dcopt=' + vdcopt + ';tile=' + dctile + ';sz=728x90;ord=' + dc_ord + '?"><\/script>\n');

						</script>

						<noscript><a href="http://ad.doubleclick.net/jump/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?"><img src="http://ad.doubleclick.net/ad/nym.vulturenetwork.artcritical/Homepage;sz=728x90;ord=123456789?" border="0"></a></noscript>

                                           <!-- END BANNER AD FOR HOME PAGE -->











					<?php else: ?>

                                          

 <!-- BANNER AD FOR INSIDE PAGE -->







						<script language="JavaScript" type="text/javascript">

						window.dctile = Number(window.dctile) + 1 || 1;

						window.dc_ord = Number(window.dc_ord) || Math.floor(Math.random() * 1E10);

						if (dctile==1) {var vdcopt = 'ist';} else {vdcopt = '';}

						if (17>dctile) document.write('<script type="text/javascript" src="http://ad.doubleclick.net/adj/nym.vulturenetwork.artcritical/ros;dcopt=' + vdcopt + ';tile=' + dctile + ';sz=728x90;ord=' + dc_ord + '?"><\/script>\n');

						</script>

						<noscript><a href="http://ad.doubleclick.net/jump/nym.vulturenetwork.artcritical/ros;sz=728x90;ord=123456789?"><img src="http://ad.doubleclick.net/ad/nym.vulturenetwork.artcritical/ros;sz=728x90;ord=123456789?" border="0"></a></noscript>

                                           









<!-- END BANNER AD FOR INSIDE PAGE -->







					<?php endif;?>

				</div>

				<br style="clear:both">

			</div>

			<div id="bottommenucontainer">

				<?php get_menu();?>

				</div>

				<div id="search_follow">

					<?php get_search_form(); ?> 

				</div>

				<br style="clear:both">

				<div id="submenu">

					<h2><a href="<?php bloginfo('url')?>/browse">Archive</a></h2> |  

					<h2><a href="<?php bloginfo('url')?>/subscribe">Subscribe</a></h2> | 

					<h2><a href="<?php bloginfo('url')?>/about">About Us</a></h2> | 

					<h2><a href="<?php bloginfo('url')?>/support">Advertise/Support</a></h2>

				</div>

				<br style="clear:both">

			</div>

			<hr>

		</div>

		<!-- END HEADER -->