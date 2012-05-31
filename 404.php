<?php get_header(); ?>

<?php // look to see if we've disabled sidebar in a custom field, if not show it
	$disableSidebarLeft = get_post_meta($post->ID, 'disableSidebarLeft', $single = true);
	if ($disableSidebarLeft !== 'true') { get_sidebar('SidebarLeft'); }
?>

<!--BEGIN: Content-->
<div id="content" role="main">

		<h1>Keep searching.</h1>
	
		<p style="margin-top: 1em;">The URL you've come to doesn't exist...<br />  If it's an error with our site <a href="/contact/">please tell us about it</a>, if not use the searchbox below to find what you're looking for.</p>
		<?php get_search_form(); ?>
	
		<h2>Or Choose A Popular Topic</h2>
		<p><?php wp_tag_cloud(''); ?> </p>

</div>
<!--END: Content-->

<?php // look to see if we've disabled sidebar in a custom field, if not show it
	$disableSidebarRight = get_post_meta($post->ID, 'disableSidebarRight', $single = true);
	if ($disableSidebarRight !== 'true') { get_sidebar('SidebarRight'); }
?>
	
<?php get_footer(); ?>