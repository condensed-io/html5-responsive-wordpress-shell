<?php $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<!--NOTE: you can't use includes in a 503 document so put your header and footer content in here manually-->

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<title><?php if (is_single() || is_page() || is_archive()) { wp_title('',true); } else { bloginfo('description'); } ?> &#8212; <?php bloginfo('name'); ?></title>

	<link rel="copyright" href="#copyright" /> 
	<link rel="icon" href="/favicon.ico" type="image/x-icon" />  
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	
	<!-- add your 503 (maintenance or coming soon page) styles below -->
	<style>
		html, body { background: #EEE; color: #333; }
	</style>

</head>

<body id="splash" class="maintenance">

	<img src="/wp-content/themes/theme_condensed/images/img_coming-soon.png" alt="coming soon" />

</body>

</html>