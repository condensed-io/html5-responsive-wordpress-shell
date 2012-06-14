<?php
// store a few user agent variables, don't delete, we'll use these later
$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#">

<head>

	<meta charset="<?php bloginfo( 'charset' ); // lets you change the charset from within wp, defaults to UTF8 ?>" />
	
	<!--Forces latest IE rendering engine & chrome frame-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>
		<?php // from 2011 theme - prints the title based on what is being viewed
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );
		?>
	</title>
	
	<!-- Meta description and keywords Handled by the SEO plugin, don't add your own here just activate the plugin -->
	
	<!-- BEGIN: Open Graph meta tags for Facebook...  Add in your App ID and or Admins here -->
    <meta property="fb:app_id" content="your_app_id" />
    <meta property="fb:admins" content="your_admin_id" />
	
	<meta property="og:title" content="<?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );/* Add a page number if necessary: */if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', '' ), max( $paged, $page ) ); ?>" />
    <meta property="og:url" content="<?php the_permalink() ?>"/>

	<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
	
	<?php if (is_single() || is_page()): ?>
	    <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
	    <meta property="og:type" content="article" />

		<?php if (function_exists('get_the_image')) $imgArray = get_the_image(array('format' => 'array')); //get the image array ?>
		<meta property="og:image" content="<?php if($imgArray != null) echo $imgArray[src]; else echo wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ) ?>" />
	
	<?php else: ?>
	    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
	    <meta property="og:type" content="website" />
	    <meta property="og:image" content="<?php bloginfo('template_url') ?>/path/to-your/logo.jpg" />
	<?php endif; ?>
	
	<!--END: Open Graph facebook tags-->
	
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
	
	<!--BEGIN: include iphone stylesheet-->
	<?php if ($iphone == true) : ?>
		<link href="<?php echo $templateURL; ?>/css/iphone.css" type="text/css" rel="stylesheet" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
	<?php endif; ?>
	<!--END: include iphone stylesheet-->
	
	<?php if(!is_home() || !is_front_page()): // if not on the home page preload the home page, doesn't work in all browsers but doesn't do any harm if they don't support it ?>
	<link rel="prefetch" href="/" />
	<?php endif;?>
	
	<!--wp_head hook for Plugins ~ always keep this just before the /head -->
	<?php wp_head(); ?>

	<!--SCRIPTS-->
		<script type="text/JavaScript" src="<?php bloginfo('template_url'); ?>/js/functions.js"></script>
		<!--this is the development version of modernizr, you should get a production version before going live ~ see http://www.modernizr.com-->
		<script type="text/JavaScript" src="<?php bloginfo('template_url'); ?>/js/modernizr_2_0_6_dev.js"></script>

</head>

<!--see http://www.mimoymima.com/2010/03/lab/wordpress-body-tag/-->
<body id="<?php $post_parent = get_post($post->post_parent); $parentSlug = $post_parent->post_name; if (is_category()) { echo "category-template"; } elseif (is_archive()) { echo "archive-template"; } elseif (is_search()) { echo "search-results"; } elseif (is_tag()) { echo "tag-template"; } else { echo $parentSlug; } ?>" class="<?php global $wp_query; $template_name = get_post_meta( $wp_query->post->ID, '_wp_page_template', true ); $tn = str_replace(".php", "", $template_name); echo "template-".$tn." "; ?><?php if (is_category()) { echo 'category'; } elseif (is_search()) { echo 'search'; } elseif (is_tag()) { echo "tag"; } elseif (is_home()) { echo "home"; } elseif (is_404()) { echo "page404"; } else { echo $post->post_name; } ?>">

	<!--div id="preloader"></div-->

	<!--BEGIN: page~wrapper-->
	<div id="page-wrapper">
			
		<header id="site-header" role="banner">
	
			<?php if (( is_home() || is_front_page() )): // if front page we'll include the site title and description ?>
				<hgroup>
					<h1 id="site-title"><?php wp_title(); ?> : <?php bloginfo( 'name' ); ?></h1>
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
			<?php else: // else just the site title ?>
				<h1 id="site-title"><?php wp_title(); ?> : <?php bloginfo( 'name' ); ?></h1>
			<?php endif; ?>
	
		</header>

		<nav id="main-nav" role="navigation">
			<h1>Main Navigation</h1>
			<?php wp_nav_menu('menu=mainNav'); // create the mainNav menu inside Appearance menus and go to town -- for more on menus see: http://templatic.com/news/wordpress-3-0-menu-management ?>
		</nav>
