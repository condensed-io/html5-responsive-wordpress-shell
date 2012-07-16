<?php
/*
Template Name: template-name
*/
?>

<?php get_header(); ?>

<?php // look to see if we've disabled sidebar in a custom field, if not show it
	$disableSidebarLeft = get_post_meta($post->ID, 'disableSidebarLeft', $single = true);
	if ($disableSidebarLeft !== 'true') { get_sidebar('SidebarLeft'); }
?>

<!--BEGIN: content div-->
<div id="content" class="clear-fix" role="main">

	<?php
	
	// this is an example of a custom WP_Query
	// if you're just making edits to the main loop you should probably try using pre_get_posts instead: http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts   ---   also: http://developer.wordpress.com/2012/05/14/querying-posts-without-query_posts/

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$my_args = array(
		'category_name' => 'home', //change this to the category you want or remove it
		'posts_per_page' => '2',
		'paged' => $paged
	);

	$my_query = new WP_Query($my_args);
	?>
		
	<?php if ($my_query->have_posts()) : //BEGIN: The Loop ?>

	<h1>Posts in <?php the_category(', ') ?></h1>

	<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

	<!--BEGIN: Post-->
	<article <?php post_class(); ?> id="<?php the_ID(); ?>">
		
		<h2><?php the_title(); ?></h2>
		
		<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_time('F jS, Y'); ?></time>
		
		<div class="entry">
			<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { the_post_thumbnail(array(200,160), array("class" => "alignleft post_thumbnail")); } ?>
			<?php the_excerpt("Continue reading &rarr;"); ?>
		</div>
									
	</article>
	<!--END: Post-->
	
	<?php wp_reset_postdata() // Reset the post data, necessary when you create a new WP_Query object ?>
			
	<?php endwhile; ?>

	<nav>
		<h1 class="hide">Page Navigation</h1>
		<?php // posts_nav_link('&nbsp;','<div class="alignleft">&laquo; Previous Page</div>','<div class="alignright">Next Page &raquo;</div>') ?>
		
		<?php next_posts_link('&laquo; Older Entries', $my_query->max_num_pages) //important to put in the argument for the number of pages in the custom query here or else it grabs page numbers from the main wp_query?>
		<?php previous_posts_link('Newer Entries &raquo;') ?>
	</nav>
		
	<?php else : // ERROR: nothing found ?>

	<h2>No posts were found :(</h2>

	<?php endif; //END: The Loop ?>

</div>
<!--END: Content-->

<?php // look to see if we've disabled sidebar in a custom field, if not show it
	$disableSidebarRight = get_post_meta($post->ID, 'disableSidebarRight', $single = true);
	if ($disableSidebarRight !== 'true') { get_sidebar('SidebarRight'); }
?>

<?php get_footer(); ?>