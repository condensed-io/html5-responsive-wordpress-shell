<?php get_header(); ?>

<!--BEGIN: sidebar~main-->
<?php // to disable this sidebar on a page by page basis just add a custom field to your page or post of disableSidebarMain = true
$disableSidebarMain = get_post_meta($post->ID, 'disableSidebarMain', $single = true);
if ($disableSidebarMain !== 'true'): ?>

<aside id="sidebar-main">
	<h1>Main Sidebar</h1>
	<?php dynamic_sidebar('sidebar-main'); ?>
</aside>

<?php endif; ?>
<!--END: sidebar~main-->

<!--BEGIN: content div-->
<section id="content" class="clear-fix" role="main">

	<h1 class="access-hide">Latest Posts</h1>
	
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); //BEGIN: The Loop ?>

			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<header>
					<h1><?php the_title(); ?></h1>
					<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_time('F jS, Y'); ?></time>
					<p>by <?php the_author() ?></p>
				</header>
				
				<div class="entry">
					<?php the_content(); ?>
				</div>
							
				<footer id="post-meta-data">
					<ul class="no-bullet">
						<li class="add-comment"><?php comments_popup_link('Share your comments', '1 Comment', '% Comments'); ?></li>
						<li>Posted in <?php the_category(', ') ?></li>
						<li><?php edit_post_link('[Edit]', '<small>', '</small>'); ?></li>
						<li><?php the_tags('Tags: ', ', ', '<br />'); ?></li>
					</ul>
				</footer>
			
			</article>

		<?php wp_link_pages(); //this allows for multi-page posts -- not 100% sure this is the best spot for it ?>
				
		<?php endwhile; ?>

			<!--BEGIN: Page Nav-->
			<?php if ( $wp_query->max_num_pages > 1 ) : // if there's more than one page turn on pagination ?>
				<nav id="page-nav">
		        	<h1 class="hide">Page Navigation</h1>
			        <ul class="clear-fix">
				        <li class="prev-link"><?php next_posts_link('&laquo; Previous Page') ?></li>
				        <li class="next-link"><?php previous_posts_link('Next Page &raquo;') ?></li>
			        </ul>
		        </nav>
			<?php endif; ?>
			<!--END: Page Nav-->
			
	<?php else : ?>

		<h2>No posts were found :(</h2>

	<?php endif; //END: The Loop ?>
	
</div>
<!--END: content div-->

<?php get_footer(); ?>