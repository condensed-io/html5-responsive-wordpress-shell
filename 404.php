<?php get_header(); ?>

<!--Put your sidebars in wherever necessary-->

<!--BEGIN: Content-->
<div id="content" role="main">

		<h1>Keep searching.</h1>
	
		<p style="margin-top: 1em;">The URL you've come to doesn't exist...<br />  If it's an error with our site <a href="/contact/">please tell us about it</a>, if not use the searchbox below to find what you're looking for.</p>
		<?php get_search_form(); ?>
	
		<h2>Or Choose A Popular Topic</h2>
		<p><?php wp_tag_cloud(''); ?> </p>

</div>
<!--END: Content-->
	
<?php get_footer(); ?>