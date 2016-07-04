<?php
   /*
   Plugin Name: Debug Info
   Plugin URI: https://surpriseazwebservices.com/wordpress-plugins/wordpress-debug-info-plugin/
   Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5VFWNLX2NQGQN
   Description: A plugin to display your server's PHP info and WordPress environment data for debugging purposes.
   Version: 1.3.6
   Author: Scott DeLuzio
   Author URI: https://surpriseazwebservices.com
   License: GPL2
   */
   
	/*  Copyright 2014  Scott DeLuzio  (email : scott (at) surpriseazwebservices.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/

/* Add language support */
function debug_info_lang() {
	load_plugin_textdomain('debug-info', false, dirname(plugin_basename(__FILE__)) . '/lang/');
}
add_action('init', 'debug_info_lang');
	
/* Info Page */

// Hook for adding admin menus
add_action('admin_menu', 'oizuled_debug_info');

// action function for above hook
function oizuled_debug_info() {
    // Add a new submenu under Settings:
    add_dashboard_page('Debug Info','Debug Info', 'manage_options', 'oizuleddebuginfo', 'oizuled_debug_info_page');
	
}

function oizuled_get_php_info() {
	//retrieve php info for current server
	if (!function_exists('ob_start') || !function_exists('phpinfo') || !function_exists('ob_get_contents') || !function_exists('ob_end_clean') || !function_exists('preg_replace')) {
		echo 'This information is not available.';
	} else {
		ob_start();
		phpinfo();
		$pinfo = ob_get_contents();
		ob_end_clean();
	 
		$pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
		echo $pinfo;
	}
}

function getMySqlVersion() {
        global $wpdb;
        $rows = $wpdb->get_results('select version() as mysqlversion');
        if (!empty($rows)) {
             return $rows[0]->mysqlversion;
        }
        return false;
    }

function oizuled_version_check() {
	//outputs basic information
	$notavailable = __('This information is not available.', 'debug-info');
	if (!function_exists('get_bloginfo')) {
		$wp = $notavailable;
	} else {
		$wp = get_bloginfo( 'version' );
	}
	
	if (!function_exists('wp_get_theme')) {
		$theme = $notavailable;
	} else {
		$theme = wp_get_theme();
	}
	
	if (!function_exists('get_option')) {
		$plugins = $notavailable;
	} else {
		$plugins = get_option('active_plugins', array());
	}
	
	if (!function_exists('phpversion')) {
		$php = $notavailable;
	} else {
		$php = phpversion();
	}
	
	/* Removing PHP memory usage/limit data as this provides usage data for the current script, and may be misleading when diagnosing another script is causing memory issues
	if (!function_exists('memory_get_usage')) {
		$phpmemuse = $notavailable;
	} else {
		$mem_usage = memory_get_usage(true);
		if ($mem_usage < 1024) {
			$phpmemuse = $mem_usage."B"; 
		} elseif ($mem_usage < 1048576) {
			$phpmemuse = round($mem_usage/1024,2)."K"; 
		} else {
			$phpmemuse = round($mem_usage/1048576,2)."M"; 
		}
	}
	
	if (!function_exists('ini_get')) {
		$phpmemlim = $notavailable;
	} else {
		$phpmemlim = ini_get('memory_limit');
	} */
	
	if (!function_exists('getMySqlVersion')) {
		$mysql = $notavailable;
	} else {
		$mysql = getMySqlVersion();
	}
	
	if (!function_exists('apache_get_version')) {
		$apache = $notavailable;
	} else {
		$apache = apache_get_version();
	}
		
	$wpver = __('WordPress Version: ', 'debug-info');
	$themever = __('Current WordPress Theme: ', 'debug-info');
	$themeversion = $theme->get('Name') . __(' version ', 'debug-info') . $theme->get('Version') . $theme->get('Template');
	$themeauthor = __(' Theme Author: ', 'debug-info');
	$themeauth = $theme->get('Author') . ' - ' . $theme->get('AuthorURI');
	$themeuri = __(' Theme URI: ', 'debug-info');
	$uri = $theme->get('ThemeURI');
	$pluginlist = __('Active Plugins: ', 'debug-info');
	$phpver = __('PHP Version: ', 'debug-info');
	/* $phpmemory = __('PHP Memory Usage: ', 'debug-info');
	$outof = __(' out of ', 'debug-info'); */
	$mysqlver = __('MySQL Version: ', 'debug-info');
	$apachever = __('Apache Version: ', 'debug-info');
		
	echo '<strong>' . $wpver . '</strong>' . $wp . '<br />';
	echo '<strong>' . $themever . '</strong>' . $themeversion . '<br />';
	echo '<strong>' . $themeauthor . '</strong>' . $themeauth . '<br />';
	echo '<strong>' .  $themeuri . '</strong>' . $uri . '<br />'; 
	echo '<strong>' . $pluginlist . '</strong>';
		foreach ( $plugins as $plugin ) {
			echo $plugin . ' | ';
		}
	echo '<br /><strong>' . $phpver . '</strong>' . $php . '<br />';
	//echo '<strong>' . $phpmemory . '</strong>' . $phpmemuse . $outof . $phpmemlim . '<br />';
	echo '<strong>' . $mysqlver . '</strong>' . $mysql . '<br />';
	echo '<strong>' . $apachever . '</strong>' . $apache . '<br />';
	
}

// Display the page content for the PHP Info submenu
function oizuled_debug_info_page() {
	include(WP_PLUGIN_DIR.'/debug-info/options.php');  
}

?>