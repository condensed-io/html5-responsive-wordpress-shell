<?php
/*
Template Name: template-name
*/
?>

<?php get_header(); ?>

<!--BEGIN: sidebar~main-->
<?php // to disable this sidebar on a page by page basis just add a custom field to your page or post of disableSidebar = true
$disableSidebar = get_post_meta($post->ID, 'disableSidebar', $single = true);
if ($disableSidebar !== 'true'): ?>

<aside class="sidebar-main">
	<h1>Main Sidebar</h1>
	<?php dynamic_sidebar('sidebar-main'); ?>
</aside>

<?php endif; ?>
<!--END: sidebar~main-->

<!--BEGIN: content div-->
<div class="content clear-fix" role="main">

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
			<article <?php post_class(); ?>>
				
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

			<!--BEGIN: Page Nav-->
			<?php if ( $wp_query->max_num_pages > 1 ) : // if there's more than one page turn on pagination ?>
				<nav class="page-nav">
		        	<h1 class="hide">Page Navigation</h1>
			        <ul class="clear-fix">
				        <li class="next-link"><?php next_posts_link('Next Page', $my_query->max_num_pages) //important to put in the argument for the number of pages in the custom query here or else it grabs page numbers from the main wp_query ?></li>
				        <li class="prev-link"><?php previous_posts_link('Previous Page') ?></li>
			        </ul>
		        </nav>
			<?php endif; ?>
			<!--END: Page Nav-->
			
		<?php else : ?>

		<h2>No posts were found :(</h2>

	<?php endif; //END: The Loop ?>

</div>
<!--END: Content-->

<?php get_footer(); ?>