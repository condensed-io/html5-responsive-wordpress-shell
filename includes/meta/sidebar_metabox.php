<?php

// Hook into WordPress
add_action( 'admin_init', 'sidebar_metabox' );
add_action( 'save_post', 'save_custom_url' );

/**
 * Add meta box
 */
function sidebar_metabox() {
    $types = array( 'post', 'page' ); // you can add more post_types here
    foreach( $types as $type ) {
        add_meta_box( 'custom-metabox', __( 'Sidebar' ), 'url_custom_metabox', $type, 'side', 'high' );
    }
}

/**
 * Display the metabox
 */
function url_custom_metabox() {
    global $post;
    $sidebar = get_post_meta( $post->ID, 'disableSidebar', true );

    // output invlid url message and add the http:// to the input field
    if( $errors ) { echo $errors; } ?>

    <p>
            <select name="sidebar">
                    <option value="false">Enable sidebar</option>
                    <option value="true" <?php if($sidebar=='true') { ?>selected<?php } ?>>Disable sidebar</option>
            </select>
    </p>
<?php
}

/**
 * Process the custom metabox fields
 */
function save_custom_url( $post_id ) {
    global $post;

    if( $_POST ) {
        update_post_meta( $post->ID, 'disableSidebar', $_POST['sidebar'] );
    }
}
?>
