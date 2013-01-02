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

<!--BEGIN: Content-->
<div class="main-content" role="main">

	<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		
		<?php if (is_category()) : // If this is a category archive ?>
		<h1 class="page-title">Archive for &#8216;<?php single_cat_title(); ?>&#8217;</h1>
		
		<?php elseif (is_tag()) : // If this is a tag archive  ?>
		<h1 class="page-title">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>

		<?php elseif (is_day()) : // If this is a daily archive ?>
		<h1 class="page-title">Archive for <?php the_time('F jS, Y'); ?></h1>

		<?php elseif (is_month()) : // If this is a monthly archive ?>
		<h1 class="page-title">Archive for <?php the_time('F, Y'); ?></h1>

		<?php elseif (is_year()) : // If this is a yearly archive ?>
		<h1 class="page-title">Archive for <?php the_time('Y'); ?></h1>

		<?php elseif (is_author()) : // If this is an author archive ?>
		<h1 class="page-title">Author Archive</h1>

		<?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : // If this is a paged archive ?>
		<h1 class="page-title">Blog Archives</h1>

		<?php endif; ?>
		
		<?php while (have_posts()) : the_post(); ?>

		<!--BEGIN: Archive-->
		<article <?php post_class(); ?>>
						
			<h2 class="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			
			<small><?php the_time('l, F jS, Y') ?></small>

			<div class="entry">
				<?php the_content() ?>
			</div>

			<?php if(!is_tag()): // don't show this stuff on tag pages '?>
			<!--BEGIN: Post Meta Data-->
			<footer class="post-meta-data">
				<ul class="no-bullet">
					<li class="add-comment"><?php comments_popup_link('Share your comments', '1 Comment', '% Comments'); ?></li>
					<li>Posted in <?php the_category(', ') ?></li>
					<li><?php edit_post_link('[Edit]', '<small>', '</small>'); ?></li>
					<li><?php the_tags('Tags: ', ', ', '<br />'); ?></li>
				</ul>
			</footer>
			<!--END: Post Meta Data-->
			<?php endif; ?>
			
		</article>
		<!--END: Archive-->
				
		<?php endwhile; ?>

		<!--BEGIN: Page Nav-->
		<?php if ( $wp_query->max_num_pages > 1 ) : // if there's more than one page turn on pagination ?>
	        <nav class="page-nav">
	        	<h1 class="hide">Page Navigation</h1>
		        <ul class="clear-fix">
			        <li class="prev-link"><?php next_posts_link('Next Page') ?></li>
			        <li class="next-link"><?php previous_posts_link('Previous Page') ?></li>
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