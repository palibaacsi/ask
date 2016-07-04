<?php


include get_stylesheet_directory() . '/inc/bp2016-logo-customizer.php';

/**
 * Proper way to enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'bp2016_theme_scripts' );
function bp2016_theme_scripts() {

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}


function peta_disable_feed() {
		wp_die( __('Our feeds are unavailable, but if you have access, please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
	}

add_action('do_feed', 'peta_disable_feed', 1);
add_action('do_feed_rdf', 'peta_disable_feed', 1);
add_action('do_feed_rss', 'peta_disable_feed', 1);
add_action('do_feed_rss2', 'peta_disable_feed', 1);
// add_action('do_feed_atom', 'peta_disable_feed', 1);
// add_action('do_feed_rss2_comments', 'peta_disable_feed', 1);
// add_action('do_feed_atom_comments', 'peta_disable_feed', 1);
/*
add_filter(‘bp_is_blog_public’,’peta_bp_is_blog_public’,10,1);
function peta_bp_is_blog_public($is_blog_public) {
	return true;
}
`*/