<?php
/*
Template Name: template-name
*/
?>

<?
// This template is used to list posts in a specific category. Don't forget to change the 'category_name=' below to the category you want to use
?>

<?php get_header(); ?>

<?php // look to see if we've disabled sidebar in a custom field, if not show it
	$disableSidebarLeft = get_post_meta($post->ID, 'disableSidebarLeft', $single = true);
	if ($disableSidebarLeft !== 'true') { get_sidebar('SidebarLeft'); }
?>

<!--BEGIN: Content-->
<div id="content" class="clear-fix" role="main">

	<?php // this is an example of a custom Query -- shows just posts from a certain category -- change the name of the category below from 'blog' to whatever you want
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$wp_query = new WP_Query();
	$wp_query -> query('category_name=blog&posts_per_page=5&paged=' . $paged);
	?>
	
	<?php if (have_posts()) : //BEGIN: The Loop ?>
	
	<h1>Posts in <?php the_category(', ') ?></h1>
	
	<?php while (have_posts()) : the_post(); ?>

			<!--BEGIN: Post-->
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
				<h2><?php the_title(); ?></h2>
				
				<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_time('F jS, Y'); ?></time>
				
				<div class="entry">
					<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { the_post_thumbnail(array(200,160), array("class" => "alignleft post_thumbnail")); } ?>
					<?php the_excerpt("Continue reading &rarr;"); ?>
				</div>
											
			</div>
			<!--END: Post-->
			
		<?php endwhile; ?>

			<div class="navigation">
				<?php posts_nav_link('&nbsp;','<div class="alignleft">&laquo; Previous Page</div>','<div class="alignright">Next Page &raquo;</div>') ?>
			</div>
			
		<?php else : // ERROR: nothing found ?>

			<h2>No posts were found :(</h2>

	<?php endif; ?>


</div>
<!--END: Content-->

<?php // look to see if we've disabled sidebar in a custom field, if not show it
	$disableSidebarRight = get_post_meta($post->ID, 'disableSidebarRight', $single = true);
	if ($disableSidebarRight !== 'true') { get_sidebar('SidebarRight'); }
?>


<?php get_footer(); ?>