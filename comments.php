<?php
/*
thanks to:
http://themeshaper.com/2009/07/01/wordpress-theme-comments-template-tutorial/
http://ponderwell.net/2010/07/html5-forms-and-wp-3-0-comments/
*/
?>

<div class="comments">

<?php // Run some checks for bots and password protected posts
    $req = get_option('require_name_email'); // Checks if fields are required.
    if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
        die ( 'Please do not load this page directly. Thanks!' );
    if ( ! empty($post->post_password) ) :
        if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>

	<div class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'your-theme') ?></div>

	</div><!-- .comments -->

<?php
        return;
    endif;
endif;
?>
 
<?php if ( have_comments() ) : // See IF there are comments and do the comments stuff! ?>
 
<?php //Count the number of comments and trackbacks (or pings)
$ping_count = $comment_count = 0;
foreach ( $comments as $comment )
    get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
?>
 
<?php /* IF there are comments, show the comments */ ?>
<?php if ( ! empty($comments_by_type['comment']) ) : ?>
 
	<div class="comments-list comments">
	<h3><?php printf($comment_count > 1 ? __('<span>%d</span> Comments', 'your-theme') : __('<span>One</span> Comment', 'your-theme'), $comment_count) ?></h3>
 
<?php /* If there are enough comments, build the comment navigation  */ ?>
<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
	<div class="comments-nav-above comments-navigation">
	<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
	</div><!-- #comments-nav-above -->
<?php endif; ?>                  
 
<?php /* An ordered list of our custom comments callback, custom_comments(), in functions.php   */ ?>

	<ol>
		<?php wp_list_comments('type=comment&callback=custom_comments'); ?>
	</ol>
 
<?php /* If there are enough comments, build the comment navigation */ ?>
<?php $total_pages = get_comment_pages_count(); if ( $total_pages > 1 ) : ?>
	<div class="comments-nav-below comments-navigation">
		<div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
	</div><!-- #comments-nav-below -->
<?php endif; ?>                
 
</div><!-- #comments-list .comments -->
 
<?php endif; // ($comment_count) ?>
 
<?php // If there are trackbacks(pings), show the trackbacks ?>
<?php if ( ! empty($comments_by_type['pings']) ) : ?>
	
	<div class="trackbacks-list comments">
		<h3><?php printf($ping_count > 1 ? __('<span>%d</span> Trackbacks', 'your-theme') : __('<span>One</span> Trackback', 'your-theme'), $ping_count) ?></h3>
 
		<?php /* An ordered list of our custom trackbacks callback, custom_pings(), in functions.php   */ ?>
		<ol>
			<?php wp_list_comments('type=pings&callback=custom_pings'); ?>
		</ol>
	</div><!-- #trackbacks-list .comments -->
	
<?php endif // ($ping_count) ?>
<?php endif // ($comments) ?>
 
<?php /* If comments are open, build the respond form */ ?>
<?php if ( 'open' == $post->comment_status ) : ?>
                <div class="respond">
                    <h3><?php comment_form_title( __('Post a Comment', 'your-theme'), __('Post a Reply to %s', 'your-theme') ); ?></h3>
 
                    <div class="cancel-comment-reply"><?php cancel_comment_reply_link() ?></div>
 
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
                    <p class="login-req"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.', 'your-theme'),
                    get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>
 
<?php else : ?>
                    <div class="formcontainer">  
 
                        <form class="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
 
<?php if ( $user_ID ) : ?>
                            <p class="login"><?php printf(__('<span class="loggedin">Logged in as <a href="%1$s" title="Logged in as %2$s">%2$s</a>.</span> <span class="logout"><a href="%3$s" title="Log out of this account">Log out?</a></span>', 'your-theme'),
                                get_option('siteurl') . '/wp-admin/profile.php',
                                wp_specialchars($user_identity, true),
                                wp_logout_url(get_permalink()) ) ?></p>
 
<?php else : ?>
 
                            <p class="comment-notes"><?php _e('Your email is <em>never</em> published nor shared.', 'your-theme') ?> <?php if ($req) _e('Required fields are marked <span class="required">*</span>', 'your-theme') ?></p>
 
              <div class="form-section-author form-section">
                                <div class="form-label"><label for="author"><?php _e('Name', 'your-theme') ?></label> <?php if ($req) _e('<span class="required">*</span>', 'your-theme') ?></div>
                                <div class="form-input"><input class="author" name="author" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="20" tabindex="3" /></div>
              </div><!-- #form-section-author .form-section -->
 
              <div class="form-section-email form-section">
                                <div class="form-label"><label for="email"><?php _e('Email', 'your-theme') ?></label> <?php if ($req) _e('<span class="required">*</span>', 'your-theme') ?></div>
                                <div class="form-input"><input class="email" name="email" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" /></div>
              </div><!-- #form-section-email .form-section -->
 
              <div class="form-section-url form-section">
                                <div class="form-label"><label for="url"><?php _e('Website', 'your-theme') ?></label></div>
                                <div class="form-input"><input class="url" name="url" type="text" value="<?php echo $comment_author_url ?>" size="30" maxlength="50" tabindex="5" /></div>
              </div><!-- #form-section-url .form-section -->
 
<?php endif /* if ( $user_ID ) */ ?>
 
              <div class="form-section-comment form-section">
                                <div class="form-label"><label for="comment"><?php _e('Comment', 'your-theme') ?></label></div>
                                <div class="form-textarea"><textarea class="comment" name="comment" cols="45" rows="8" tabindex="6"></textarea></div>
              </div><!-- #form-section-comment .form-section -->
 
              <div class="form-allowed-tags" class="form-section">
                  <p><span><?php _e('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'your-theme') ?></span> <code><?php echo allowed_tags(); ?></code></p>
              </div>
 
<?php do_action('comment_form', $post->ID); ?>
 
                            <div class="form-submit"><input class="submit" name="submit" type="submit" value="<?php _e('Post Comment', 'your-theme') ?>" tabindex="7" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></div>
 
<?php comment_id_fields(); ?> 
 
<?php /* Just … end everything. We're done here. Close it up. */ ?> 
 
                        </form><!-- #commentform -->
                    </div><!-- .formcontainer -->
<?php endif /* if ( get_option('comment_registration') && !$user_ID ) */ ?>
                </div><!-- #respond -->
<?php endif /* if ( 'open' == $post->comment_status ) */ ?>

</div><!-- #comments -->