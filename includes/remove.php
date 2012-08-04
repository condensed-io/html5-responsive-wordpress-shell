<?php

/*
THE BELOW FUNCTIONS ARE USED TO REMOVE UNUSED PARTS OF THE ADMIN AREA
TO MAKE IT EASIER FOR YOUR CLIENT TO UNDERSTAND WHAT'S GOING ON
IT'S ALL COMMENTED OUT BY DEFAULT, JUST UNCOMMENT AND THEN CUSTOMIZE IT
TUTORIAL: http://webdesignfan.com/customizing-the-wordpress-admin-area/
*/
	
// remove dashboard widgets if they're not needed

	function remove_dashboard_widgets() {

	// load the metaboxes array as a global variable
	>global $wp_meta_boxes;

	// we need to manually unset each widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	}

	//  REFERENCE: DASHBOARD WIDGETS YOU CAN REMOVE IF NEEDED
	//  Main column
	//  $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']
	//  $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']
	//  $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']
	//  $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']
    //  
	//  Side Column
	//  $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']
	//  $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']
	//  $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']
	//  $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']
	

	// Hook into the 'wp_dashboard_setup' action to remove the widgets defined above
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
	
	
// remove unused menu items
	// example function removing Links, Tools, Settings, Comments -- obviously you wouldn't want to remove all this stuff
	function remove_menus()
	{
	// setup the global menu variable
	>global $menu;
	// this is an array of the menu item names we wish to remove
	$restricted = array( __('Links'),__('Tools'),__('Settings'),__('Comments'));
	end ($menu);

	while (prev($menu))
	{
	$value = explode(' ',$menu[key($menu)][0]);

	if(in_array($value[0] != NULL?$value[0]:"" , $restricted))
	{
	unset($menu[key($menu)]);
	}
	}
	}
	// hook into the action that creates the menu
	add_action('admin_menu', 'remove_menus');
	
// function remove_extra_meta_boxes() {
	remove_meta_box( 'postcustom' , 'post' , 'normal' ); // custom fields for posts
	remove_meta_box( 'postcustom' , 'page' , 'normal' ); // custom fields for pages
	remove_meta_box( 'postexcerpt' , 'post' , 'normal' ); // post excerpts
	remove_meta_box( 'postexcerpt' , 'page' , 'normal' ); // page excerpts
	remove_meta_box( 'commentsdiv' , 'post' , 'normal' ); // recent comments for posts
	remove_meta_box( 'commentsdiv' , 'page' , 'normal' ); // recent comments for pages
	remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'side' ); // post tags
	remove_meta_box( 'tagsdiv-post_tag' , 'page' , 'side' ); // page tags
	remove_meta_box( 'trackbacksdiv' , 'post' , 'normal' ); // post trackbacks
	remove_meta_box( 'trackbacksdiv' , 'page' , 'normal' ); // page trackbacks
	remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' ); // allow comments for posts
	remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' ); // allow comments for pages
	remove_meta_box('slugdiv','post','normal'); // post slug
	remove_meta_box('slugdiv','page','normal'); // page slug
	remove_meta_box('pageparentdiv','page','side'); // Page Parent
	}
	add_action( 'admin_menu' , 'remove_extra_meta_boxes' );

// some other good reading for learning about editing the admin area here
// http://sixrevisions.com/wordpress/how-to-customize-the-wordpress-admin-area/

?>