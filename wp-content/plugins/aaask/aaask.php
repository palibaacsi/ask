<?php
/*
 * Plugin Name: AAASK
 */

add_action( 'plugins_loaded', 'unplug_jetpack_init' );

function unplug_jetpack_init() {
	add_filter( 'jetpack_development_mode', '__return_true' );
}


add_action( 'init', 'cleverness_todo_widget' );

function cleverness_todo_widget() {
//	include_once( plugins_url() . 'cleverness-to-do-list/includes/cleverness-to-do-list-widget.class.php' );
}

// Calling it only on the login page
// add_action( 'login_enqueue_scripts', 'enqueue_login_css', 10 );
add_filter( 'login_headerurl', 'alter_login_url' );
add_filter( 'login_headertitle', 'alter_login_title' );


function enqueue_login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/login.css', false );
}


// Changing the logo link from wordpress.org to your site
function alter_login_url() {
	return home_url();
}

// Changing the alt text on the logo to show your site name
function alter_login_title() {
	return get_option( 'blogname' );
}

add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo() { ?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo-300.png);
	/*		padding-bottom: 30px; */
		}
	</style>
<?php }

add_filter( 'login_message', 'ask_login_message' );

function ask_login_message() {

	echo '<p style="text-align: center; font-size: 1rem;">Hiya folks! If you haven\'t yet registered, please do so first by clicking on <b><em>Register</b></em> below the white login box.</p>';

}

// add_action( 'wp_enqueue_scripts', 'faq_css' );

function faq_css() {
	wp_enqueue_style( 'faq-css', get_stylesheet_directory_uri() . '/inc/css/faq.css', false );
}

add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	add_dashboard_page( 'My Plugin Dashboard', 'My Plugin', 'read', 'my-unique-identifier', 'buckwheat_says_make_mo_bigger_max_allowed_packet_n_wait_timeout' );
}

/*
Notes:
execute the function twice to see if the variable values are changed or not.
I did not bother with creating additional foreach queries for before and after.
If you exceed either the minimum or maximum values the Min|Max value will be used instead of your value.

integer is in bytes: 1024 = 1KB | 1073741824 = 1GB

max_allowed_packet
Permitted Values Type integer
Default	4194304
Min Value 1024
Max Value 1073741824

integer is in seconds: 28800 = 480 minutes | 31536000 = 525600 minutes = 8760 hours
wait_timeout
Permitted Values (Windows) Type integer
Default	28800
Min Value 1
Max Value 2147483

Permitted Values (Other) Type integer
Default	28800
Min Value 1
Max Value 31536000
*/

function buckwheat_says_make_mo_bigger_max_allowed_packet_n_wait_timeout() {
	global $wpdb;

	$max_allowed_packet = 'max_allowed_packet';
	$wait_timeout = 'wait_timeout';
	$result = $wpdb->get_results( $wpdb->prepare( "SHOW SESSION VARIABLES WHERE (Variable_name = %s) OR (Variable_name = %s)", $max_allowed_packet, $wait_timeout ) );

	echo '<div class="update-nag">';
	echo '<strong>Execute the function twice to see if the values change or not</strong><br>';	

	foreach ( $result as $data ) {

		echo '<strong>'.$data->Variable_name.': </strong>'. $data->Value.'</strong><br>';	

		if ( $data->Variable_name == 'max_allowed_packet' ) {

			//$map_value = '4194304'; // default value
			$map_value = '1073741824'; // max value
			$map_results = $wpdb->query( $wpdb->prepare( "SET GLOBAL max_allowed_packet = %d;", $map_value ) );
		}	

		if ( $data->Variable_name == 'wait_timeout' ) {

			//$wt_value = '28800'; // default value
			//$wt_value = '2147483'; // max value Windows
			$wt_value = '31536000'; // max value other
			$wpdb->query( $wpdb->prepare( "SET GLOBAL wait_timeout = %d;", $wt_value ) );
		}
	}

	echo '</div>';
}

// buckwheat_says_make_mo_bigger_max_allowed_packet_n_wait_timeout();

