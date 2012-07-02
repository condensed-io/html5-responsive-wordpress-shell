<?php

// BEGIN: if you are logged into the admin area, show what template someone is using on the top of all pages
	if (is_user_logged_in()) { add_action('wp_footer', 'show_template'); }

	function show_template() {
		global $template;
		print_r($template);
		//global $wp_taxonomies;
		//print_r($wp_taxonomies['sections']);
	}

// allows you to make custom templates for posts with name structure like single-postID.php (the id is the number not the name) see: http://www.nathanrice.net/blog/wordpress-single-post-templates/
add_filter('single_template', create_function('$t', 'foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-{$cat->term_id}.php") ) return TEMPLATEPATH . "/single-{$cat->term_id}.php"; } return $t;' ));


// removes tags generated in the WordPress Head that we don't use, you could read up and re-enable them if you think they're needed
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');


// loads jQuery from the Google CDN, loading jquery this way ensures it won't be included twice with plugins that include it

	function my_init_method() {
	    if (!is_admin()) {
	        wp_deregister_script( 'jquery' );
	        wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	        wp_enqueue_script( 'jquery' );
	    }
	} 
	add_action('init', 'my_init_method');


// activates menu features
	if (function_exists('add_theme_support')) {
	    add_theme_support('menus');
	}


// activates Featured Image function
	add_theme_support( 'post-thumbnails' );


// removes the automatic paragraph tags from the excerpt, we leave it on for the content and have a custom field you can use to turn it off on a page by page basis --> wpautop = false
	remove_filter('the_excerpt', 'wpautop');


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

	
/*
THE BELOW FUNCTIONS ARE USED TO REMOVE UNUSED PARTS OF THE ADMIN AREA
TO MAKE IT EASIER FOR YOUR CLIENT TO UNDERSTAND WHAT'S GOING ON
IT'S ALL COMMENTED OUT BY DEFAULT, JUST UNCOMMENT AND THEN CUSTOMIZE IT
TUTORIAL: http://webdesignfan.com/customizing-the-wordpress-admin-area/
*/

/* BEGIN comment, remove this line and the END comment line below to uncomment
	
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

END commenting, remove this line to uncomment */

// some other good reading for learning about editing the admin area here
// http://sixrevisions.com/wordpress/how-to-customize-the-wordpress-admin-area/

?>