<?php

// If this file is called directly, abort
if(!defined('ABSPATH'))  {
	exit;
}

// Create admin tab for the plugin
function wse_admin_tab()  {
	
	add_menu_page('Wiki Styled Editing', 'Wiki Styled Editing', 'manage_options', __FILE__, 'wse_admin_page');
}

add_action('admin_menu', 'wse_admin_tab');

// Create admin page
function wse_admin_page()  {

	ob_start(); ?>	

	<div class="wrap">
		<h2><?php _e('Wiki Styled Editing Plugin is installed correctly. Go to any of your blog posts to see it in action.', 'wse'); ?></h2>        
	</div>	
		
	<?php
	echo ob_get_clean();
	
}

// Register settings
function wse_register_settings()	{	
	register_setting('wse_settings_group', 'wse_settings');
}

add_action('admin_init', 'wse_register_settings');
