<?php
/**
 * Make a site Private, works with/Without BuddyPress
 *
 * @author sbrajesh
 * @global string $pagenow
 *
 */
function private_buddypress_site() {

	//first exclude the wp-login.php
	//register
	//activate
	global $pagenow;

	//do not restrict logged in users
	if ( is_user_logged_in() ) {
		return ;
	}
	//if we are here, the user is not logged in, so let us check for exclusion
	//we selectively exclude pages from the list

	//are we on login page?
	if ( 'wp-login.php' === $pagenow ) {
		return ;
	}

	//let us exclude the home page
	if ( is_front_page() ) {
		return ;
	}

	$exclude_pages = array( 'about-us', 'register', 'activate', 'updates' );//add the slugs here

	//is it one of the excluded pages, if yes, we just return and don't care
	if ( is_page( $exclude_pages ) ) {
		return ;
	}

	$redirect_url = wp_login_url( site_url( '/' ) );//get login url,

	wp_safe_redirect( $redirect_url );
	exit( 0 );
}

add_action( 'template_redirect', 'private_buddypress_site', 0 );

function my_bp_nav_adder() {
	global $bp;
	bp_core_new_nav_item(
		array(
				'name'                => __( 'Listings', 'buddypress' ),
				'slug'                => 'my-listings',
				'position'            => 1,
				'screen_function'     => 'listingsdisplay',
				'default_subnav_slug' => 'my-listings',
				'parent_url'          => $bp->loggedin_user->domain . $bp->slug . '/',
				'parent_slug'         => $bp->slug,
		)
	);
}

function listingsdisplay() {
	//add title and content here - last is to call the members plugin.php template
	add_action( 'bp_template_title', 'my_groups_page_function_to_show_screen_title' );
	add_action( 'bp_template_content', 'my_groups_page_function_to_show_screen_content' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function my_groups_page_function_to_show_screen_title() {
	echo 'My new Page Title';
}

function my_groups_page_function_to_show_screen_content() {
	echo 'My Tab content here';

}

add_action( 'bp_setup_nav', 'my_bp_nav_adder', 50 );

function my_setup_nav() {
    global $bp;
    bp_core_new_subnav_item( array(
       'name' => 'My Group Page',
       'slug' => 'my-group-page',
       'parent_url' => $bp->loggedin_user->domain . $bp->groups->slug . '/',
       'parent_slug' => $bp->groups->slug,
       'screen_function' => 'my_groups_page_function_to_show_screen',
       'position' => 40 ) );
}
add_action( 'bp_setup_nav', 'my_setup_nav' );

function my_groups_page_function_to_show_screen() {

    //add title and content here - last is to call the members plugin.php template
    add_action( 'bp_template_title', 'my_groups_page_show_screen_title' );
    add_action( 'bp_template_content', 'my_groups_page_show_screen_content' );
    bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function my_groups_page_show_screen_title() {
    echo 'My Page Title';
}
function my_groups_page_show_screen_content() { 

	echo 'page content goes here';

}
