<?php
// store a few user agent variables, don't delete, we'll use these later
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#">

<head>

	<meta charset="<?php bloginfo( 'charset' ); // lets you change the charset from within wp, defaults to UTF8 ?>" />
	
	<!--Forces latest IE rendering engine & chrome frame-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<!-- title & meta handled by the yoast plugin, don't add your own here just activate the plugin -->

	<title><?php wp_title(''); ?></title>
	
	<!-- favicon & other link Tags -->
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />  
	<link rel="apple-touch-icon" href="/images/custom_icon.png"/><!-- 114x114 icon for iphones and ipads -->
	<link rel="copyright" href="#copyright" /> 
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- CSS -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" media="screen" />

	<!-- BEGIN: IE Specific Hacks -->
	<!--[if IE 8]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/ie8.css" media="screen" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/styles/ie7.css" media="screen" /><![endif]-->
	<!--END: IE Specific Hacks-->
	
	<!--REMOVE this viewport code if you are making a site that is NOT responsive-->
	<?php if ($iphone == true || $android == true || $ipad == true) : ?>
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
	<?php endif; ?>
 	<!--REMOVE this viewport code if you are making a site that is NOT responsive-->
	
	<?php wp_head(); // wp_head hook for Plugins ~ always keep this just before the /head tag ?>

	<!--SCRIPTS-->
		<script type="text/JavaScript" src="<?php bloginfo('template_url'); ?>/js/functions.js"></script>
		<!--this is the development version of modernizr, you should get a production version before going live ~ see http://www.modernizr.com-->
		<script type="text/JavaScript" src="<?php bloginfo('template_url'); ?>/js/modernizr.custom.js"></script>

</head>

<!--see http://www.mimoymima.com/2010/03/lab/wordpress-body-tag/-->
<body class="<?php body_class(); ?>">

	<!--div class="preloader"></div-->

	<!--BEGIN: page~wrapper-->
	<div class="page-wrapper">
			
		<header class="site-header" role="banner">
	
			<hgroup>
				<h1 class="site-title"><?php if(!is_home()) { wp_title(''); echo " :: "; } ?><a href="/"><?php bloginfo('name'); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
	
		</header>

		<!-- Main Nav ~ to make the menu vertical instead of horizontal remove the menu_class of horiz-list -->
		<nav class="main-nav" role="navigation">
			<h1 class="access-hide">Main Navigation</h1>
			<?php wp_nav_menu(array('menu' => 'mainNav', 'menu_class' => 'horiz-list')); // create the mainNav menu inside Appearance menus and go to town -- for more on menus see: http://templatic.com/news/wordpress-3-0-menu-management ?>
		</nav>
