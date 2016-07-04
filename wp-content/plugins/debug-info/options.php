<script type="text/javascript">
	function showDetails(id) {
		document.getElementById(id).style.display = 'block';
	}
	function hideDetails(id) {
		document.getElementById(id).style.display = 'none';
	}
</script>
<div class="wrap">
	<div class="postbox">
		<h2><?php _e('WordPress Debug Info', 'debug-info'); ?></h2>
		<p><?php _e('Below is some information about your current WordPress and server setup. This information may be useful for your technical support, website developers, and plugin or theme developers who need to diagnose problems on your site.', 'debug-info'); ?></p>
		<p><?php echo oizuled_version_check(); ?></p>
		<p><?php _e('For more detailed PHP server related information, click the Show Details link below.', 'debug-info'); ?></p>
		<a href="#" onclick="showDetails('details'); return false;"><?php _e('Show Details', 'debug-info'); ?></a>
		<a href="#" onclick="hideDetails('details'); return false;"><?php _e('Hide Details', 'debug-info'); ?></a>
		<span id="details" style="display: none;"><?php echo oizuled_get_php_info(); ?></span>
	</div>
	<div class="postbox">
		<p><?php _e('If this plugin has helped you out at all, please consider making a donation to encourage future updates.<br />Your generosity is appreciated!', 'debug-info'); ?></p>
			<a href="#" onclick="window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5VFWNLX2NQGQN');">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" width="147" height="47">
			</a>
		<p><?php _e('To report any issues with', 'debug-info'); ?> <strong><?php _e('this plugin', 'debug-info'); ?></strong><?php _e(', please visit the ', 'debug-info'); ?><a href="http://wordpress.org/support/plugin/debug-info"><?php _e('support page on WordPress.org', 'debug-info'); ?></a>.</p>
		<p><?php _e('For all other WordPress support, please check out the following', 'debug-info'); ?> <a href="https://surpriseazwebservices.com/services/wordpress-site-install/"><?php _e('site set-up', 'debug-info'); ?></a>, <a href="https://surpriseazwebservices.com/services/wordpress-maintenance-support/"><?php _e('24x7 support', 'debug-info'); ?></a><?php _e(', and other', 'debug-info'); ?> <a href="https://surpriseazwebservices.com/services/"><?php _e('WordPress training', 'debug-info'); ?></a> <?php _e('services', 'debug-info'); ?>.</p>
		<p><a href="https://twitter.com/SurpriseWebSvc" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @SurpriseWebSvc</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></p>
	</div>
</div>