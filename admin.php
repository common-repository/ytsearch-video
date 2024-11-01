<?php

function ytsv_settings_link($links, $file) {
	if ( $file == plugin_basename(dirname(__FILE__).'/related_video.php') ) {
		$links[] = '<a href="' . admin_url('plugins.php?page=ytsv_api_config') . '">'.__( 'Settings' ).'</a>';
	}
	return $links;
}
add_filter('plugin_action_links', 'ytsv_settings_link', 10, 2);
function ytsv_add_submenu() {
	add_submenu_page('plugins.php', 'blogVault', '<span>Related Video</span>', 'manage_options', 'ytsv_api_config', 'ytsv_api_config');
}
add_action('admin_menu', 'ytsv_add_submenu');

function ytsv_api_config() {
	if (isset($_POST['googleapi'])) {
		$keys = str_split($_POST['googleapi'], 32);
		update_option('ytsvapikey', $_POST['googleapi']);
	}
	if (get_option('ytsvapikey')) {
?>
		<p>API Key configured.</p>
<?php
	} else {
?>
		<p>
			<form method='post'> 
				<font>Google API Key:</font> <input type='text' name='googleapi' />
				<input type='submit' value='Submit' />
			</form>
		</p>
<?php
	}
}