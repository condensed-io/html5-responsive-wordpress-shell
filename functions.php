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
$output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
$output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');


// Allows you to make custom templates for posts with name structure like single-postID.php (the id is the number not the name) see: http://www.nathanrice.net/blog/wordpress-single-post-templates/
add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->term_id}.php") ) return TEMPLATEPATH . "/single-{$cat->term_id}.php"; } return $t;' ));


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


// Activates menu features
	if (function_exists('add_theme_support')) {
	    add_theme_support('menus');
	}


// Activates Featured Image function
	add_theme_support( 'post-thumbnails' );


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
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    
    // // if you want to add more just keep adding them like this:
    // register_sidebar(array(
    //     'id' => 'sidebar-single',
    //     'name' => 'Sidebar: Single',
    //     'description' => 'The second (secondary) sidebar.',
    //     'before_widget' => '<div id="%1$s" class="widget %2$s">',
    //     'after_widget' => '</div>',
    //     'before_title' => '<h4 class="widgettitle">',
    //     'after_title' => '</h4>',
    // ));

// Wigetized sidebar, we're registering two, you can add as many as you want
	if ( function_exists('register_sidebar') )
		register_sidebar(array('name'=>'Sidebar - Main', 'id' => 'sidebar-main'));
//		register_sidebar(array('name'=>'Sidebar - Footer', 'id' => 'sidebar-footer')); // you can register more by putting them on their own lines


// This function is used to get the slug of the page
	function get_the_slug() {
		global $post;
		if ( is_single() || is_page() ) {
			return $post->post_name;
		} else {
			return "";
		}
	}
	
// Custom callback to list comments in the your-theme style
// http://themeshaper.com/2009/07/01/wordpress-theme-comments-template-tutorial/
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
  ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <div class="comment-author vcard"><?php commenter_link() ?></div>
        <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'your-theme'),
                    get_comment_date(),
                    get_comment_time(),
                    '#comment-' . get_comment_ID() );
                    edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'your-theme') ?>
          <div class="comment-content">
            <?php comment_text() ?>
        </div>
        <?php // echo the comment reply link
            if($args['type'] == 'all' || get_comment_type() == 'comment') :
                comment_reply_link(array_merge($args, array(
                    'reply_text' => __('Reply','your-theme'),
                    'login_text' => __('Log in to reply.','your-theme'),
                    'depth' => $depth,
                    'before' => '<div class="comment-reply-link">',
                    'after' => '</div>'
                )));
            endif;
        ?>
<?php } // end custom_comments

// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'your-theme'),
                        get_comment_author_link(),
                        get_comment_date(),
                        get_comment_time() );
                        edit_comment_link(__('Edit', 'your-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'your-theme') ?>
            <div class="comment-content">
                <?php comment_text() ?>
            </div>
<?php } // end custom_pings

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
    } else {
        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
    }
    $avatar_email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link


// To REMOVE unused dashboard widgets you can uncomment the next line and customize /includes/remove.php
// require_once('includes/remove.php');

?>