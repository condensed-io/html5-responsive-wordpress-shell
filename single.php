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

<div id="content" class="clear-fix" role="main">
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<!--BEGIN: Single Post-->
	<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
		<header>
			<h1><?php the_title(); ?></h1>	
			<time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_time('F jS, Y'); ?></time>
			<p>by <?php the_author(); ?></p>
		</header>
		
		<div class="entry">
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
			<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>
		</div>
		
		<!--BEGIN: Post Meta Data-->
		<footer class="post-meta-data">
			<p><?php the_tags('Tags: ', ', ', '<br />'); ?></p>
		</footer>
		<!--END: Post Meta Data-->
		
		<h2><?php comments_popup_link('Share your comments', '1 Comment', '% Comments'); ?></h2>
		<?php comments_template( '', true ); ?>
			
	</article>
	<!--END: Single Post-->

	<?php wp_link_pages(); //this allows for multi-page posts ?>

<?php endwhile; ?>

<?php else: //ERROR: Nothing Found ?>

	<h2>No posts were found :(</h2>
	
<?php endif; //END: The Loop ?>
		
</div>
<!--END: Content-->

<?php get_footer(); ?>