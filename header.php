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
	<!--[if IE 8]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie8.css" media="screen" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie7.css" media="screen" /><![endif]-->
	<!--END: IE Specific Hacks-->
	
	<?php if ($iphone == true) : // conditional iPhone and Android code ?>
		<link href="<?php echo $templateURL; ?>/css/iphone.css" type="text/css" rel="stylesheet" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
	<?php elseif ($android == true) : ?>
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
	<?php endif; ?>
	
	<?php wp_head(); // wp_head hook for Plugins ~ always keep this just before the /head tag ?>

	<!--SCRIPTS-->
		<script type="text/JavaScript" src="<?php bloginfo('template_url'); ?>/js/functions.js"></script>
		<!--this is the development version of modernizr, you should get a production version before going live ~ see http://www.modernizr.com-->
		<script type="text/JavaScript" src="<?php bloginfo('template_url'); ?>/js/modernizr.custom.js"></script>

</head>

<!--see http://www.mimoymima.com/2010/03/lab/wordpress-body-tag/-->
<body id="<?php $post_parent = get_post($post->post_parent); $parentSlug = $post_parent->post_name; if (is_category()) { echo "category-template"; } elseif (is_archive()) { echo "archive-template"; } elseif (is_search()) { echo "search-results"; } elseif (is_single()) { echo "single-template"; } elseif (is_tag()) { echo "tag-template"; } else { echo $parentSlug; } ?>" class="<?php global $wp_query; $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true ); $tn = str_replace(".php", "", $template_name); echo "template-".$tn." "; ?><?php if (is_category()) { echo 'category'; } elseif (is_search()) { echo 'search'; } elseif (is_tag()) { echo "tag"; } elseif (is_home()) { echo "home"; } elseif (is_404()) { echo "page404"; } else { echo $post->post_name; } ?>">

	<!--div id="preloader"></div-->

	<!--BEGIN: page~wrapper-->
	<div id="page-wrapper">
			
		<header id="site-header" role="banner">
	
			<hgroup>
				<h1 id="site-title"><?php if(!is_home()) { wp_title(''); echo " :: "; } ?><a href="/"><?php bloginfo('name'); ?></a></h1>
				<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>
	
		</header>

		<nav id="main-nav" role="navigation">
			<h1 class="access-hide">Main Navigation</h1>
			<?php wp_nav_menu('menu=mainNav'); // create the mainNav menu inside Appearance menus and go to town -- for more on menus see: http://templatic.com/news/wordpress-3-0-menu-management ?>
		</nav>
