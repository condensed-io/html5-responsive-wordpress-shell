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

<!--BEGIN: Content-->
<div id="content" role="main">

	<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h1 class="page-title">Archive for &#8216;<?php single_cat_title(); ?>&#8217;</h1>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1 class="page-title">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1 class="page-title">Archive for <?php the_time('F jS, Y'); ?></h1>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1 class="page-title">Archive for <?php the_time('F, Y'); ?></h1>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1 class="page-title">Archive for <?php the_time('Y'); ?></h1>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1 class="page-title">Author Archive</h1>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1 class="page-title">Blog Archives</h1>	
		<?php } ?>
	
		<!--BEGIN: Archive-->
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		
			<?php while (have_posts()) : the_post(); ?>
				
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
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

		<nav class="navigation">
			<h1>Page Navigation</h1>
			<?php posts_nav_link('&nbsp;','<div class="alignright">Newer Entries &raquo;</div>','<div class="alignleft">&laquo; Older Entries</div>') ?>
		</nav>
		
		<?php else : // ERROR: nothing found ?>

			<h2>No posts were found :(</h2>
			
	<?php endif; ?>

	</article>
	<!--END: Archive-->

</div>
<!--END: Content-->

<?php get_footer(); ?>