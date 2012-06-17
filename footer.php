<!--BEGIN: Footer Section-->
<footer id="footer" class="clear-fix">

	<!--BEGIN: Footer Nav-->
	<nav role="navigation">
		<h1>Footer Navigation</h1>
		<ul class="horiz-list">
			<?php wp_nav_menu('menu=footerNav'); // create the footerNav menu inside Appearance menus and go to town -- for more on menus see: http://templatic.com/news/wordpress-3-0-menu-management ?>
		</ul>
	</nav>
	<!--END: Footer Nav-->

	<!--BEGIN: Optional Contact Info using microformats: http://microformats.org/-->
	<!--dl class="vcard">
		<dt class="org fn">OrgName or Full Name of person - remove one or the other class</dt>
		<dd class="adr">
			<span class="street-address"></span>
			<span class="locality">City</span>
			<span class="region">State</span>
			<span class="postal-code">xxxxx</span>		
		</dd>
		<dd class="tel"></dd>
		<dd class="tel"></dd>
		<dd class="email"><a href="mailto:"></a></dd>
		<dd class="fax"></dd>
	</dl-->
	<!--END: Contact Info-->
	
	<!--BEGIN: Credit. If you use this theme please consider keeping our credit in the footer.  You may delete it though if needed. -->
	<article id="site-credits">
		<h1>Credits</h1>
		<h2><a id="cred-yours" href="http://html5.mimoymima.com" title="keyword rich title">Your Credit Here</a></h2>
		<h2><a id="cred-mine" href="http://html5.mimoymima.com" title="Build your Wordpress themes faster - HTML5 WordPress Shell">built using the HTML5 Wordpress shell :: html5.mimoymima.com</a></h2>
	</article>
	<!--END: Credit-->
	
	<p id="copyright"><small>&copy; <?php echo date('Y'); ?> <?php bloginfo('name')?></small></p>
	
	<!-- wp_footer hook for Plugins -->
	<?php wp_footer(); ?>

</footer>
<!--END: Footer Section-->

<!--Javascript Indicator-->
<div class="indicator" id="js-ind"><a href="http://www.mimoymima.com/help/turning-javascript-on-and-off/" title="You don't have javascript enabled, click here to learn more.">Enable Javascript</a></div>
<!--Javascript Indicator-->

</div>
<!--END: page~wrapper-->

</body>
</html>