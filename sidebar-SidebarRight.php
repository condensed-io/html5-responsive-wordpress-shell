<!--BEGIN: SidebarRight-->
<aside id="sidebar-right" role="complementary">
		
	<?php if ( !function_exists('dynamic_sidebar') ||  
	!dynamic_sidebar('SidebarRight') ) : ?>  
  	<section>
		<h2>No widgets</h2>
		<p>You should add some widgets</p>
  	</section>
	<?php endif; ?>
		
	<!--WP Hook for plugins-->
	<?php wp_meta(); ?>
	
</aside>
<!--END: SidebarRight-->