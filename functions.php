<?php

// BEGIN: if you are logged into the admin area, show what template someone is using on the top of all pages
	if (is_user_logged_in()) { add_action('wp_footer', 'show_template'); }

	function show_template() {
		global $template;
		print_r($template);
		//global $wp_taxonomies;
		//print_r($wp_taxonomies['sections']);
	}

// // create a new taxonomy called 'Countries'
// function countries_init() {
//   register_taxonomy(
//     'countries',
//     'post',
//     array(
//       'label' => __('Countries'),
//       'sort' => true,
//       'args' => array('orderby' => 'term_order'),
//       'rewrite' => array('slug' => 'countries'),
//     )
//   );
// }
// add_action( 'init', 'countries_init' );


// Add a 'first' and 'last' class to the first and last menu item pulled from custom menus
function add_first_and_last($output) {
    $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item"', $output, 1);
    $output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
    return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');


// Removes tags generated in the WordPress Head that we don't use, you could read up and re-enable them if you think they're needed
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');


// Loads jQuery from the Google CDN, loading jquery this way ensures it won't be included twice with plugins that include it
/*
if you are developing this site locally you can use wordpress' local copy of jquery by commenting out the deregister line and the line with google's version of jquery below and registering the local copy
like this:
           // wp_deregister_script( 'jquery' );
           // wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
           wp_register_script ( 'jquery' );
           wp_enqueue_script( 'jquery' );
*/

	function my_init_method() {
	    if (!is_admin()) {
	        wp_deregister_script( 'jquery' );
	        wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	        wp_enqueue_script( 'jquery' );
	    }
	} 
	add_action('init', 'my_init_method');


// Add theme support
    
if (function_exists('add_theme_support')) {
    
    // Activates menu features
    add_theme_support('menus');
    
    // Activates Featured Image functions
    add_theme_support( 'post-thumbnails' );

}

// Body Class Function
function body_classes() {

    global $post;

 // echo some of these things
    if (is_category()) { echo "page_category"," "; }
        elseif (is_search()) { echo "page_search"," "; }
        elseif (is_tag()) { echo "page_tag"," "; }
        elseif (is_home()) { echo "page_home"," "; }
        elseif (is_404()) { echo "page_404"," "; }

    // echo page_(page name)
    if( is_page()) {
        $pn = $post->post_name;
        echo "page_".$pn;
    }

    // echo parent_(parent name)
    $post_parent = get_post($post->post_parent);
    $parentSlug = $post_parent->post_name;
    
    if ( is_page() && $post->post_parent ) {
            echo "parent_".$parentSlug." ";
    }

    // echo template_(template name)
    $temp = get_page_template();
    $path = pathinfo($temp);
    $tmp = $path['filename'] . "." . $path['extension'];
    $tn= str_replace(".php", "", $tmp);
    echo "template_".$tn." ";

}


// Removes the automatic paragraph tags from the excerpt, we leave it on for the content and have a custom field you can use to turn it off on a page by page basis --> wpautop = false
	remove_filter('the_excerpt', 'wpautop');

// Used to create custom length excerpts
function get_the_custom_excerpt($length){
	return substr( get_the_excerpt(), 0, strrpos( substr( get_the_excerpt(), 0, $length), ' ' ) ).'...';
}

// Register wigetized sidebars, changing the default output from lists to divs

    if ( function_exists('register_sidebar') )

    register_sidebar(array(
        'id' => 'sidebar-main',
        'name' => 'Sidebar: Main',
        'description' => 'The second (secondary) sidebar.',
        'before_widget' => '<div class="%1$s widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    
    // // if you want to add more just keep adding them like this:
    // register_sidebar(array(
    //     'id' => 'sidebar-footer',
    //     'name' => 'Sidebar: Footer',
    //     'description' => 'Footer sidebar.',
    //     'before_widget' => '<div class="%1$s widget %2$s">',
    //     'after_widget' => '</div>',
    //     'before_title' => '<h4 class="widgettitle">',
    //     'after_title' => '</h4>',
    // ));

// This function is used to get the slug of the page
	function get_the_slug() {
		global $post;
		if ( is_single() || is_page() ) {
			return $post->post_name;
		} else {
			return "";
		}
	}

	
// To REMOVE unused dashboard widgets you can uncomment the next line and customize /includes/remove.php
// require_once('includes/remove.php');

/*
COMMENT FUNCTIONS:
we usually use LiveFyre, Disqus, or Intense Debate for comments
also jetpack has some kind of commenting plugin that we haven't tried yet
if you're making a site that requires a totally custom comments area,
check this tutorial which has a bunch of functions to customize comments:
http://themeshaper.com/2009/07/01/wordpress-theme-comments-template-tutorial/
*/

?>