<?php
// Register Custom PETA Job
function peta_job_type() {

	$labels = array(
		'name'                  => _x( 'PETA Jobs', 'PETA Job General Name', 'peta_rocks' ),
		'singular_name'         => _x( 'PETA Job', 'PETA Job Singular Name', 'peta_rocks' ),
		'menu_name'             => __( 'PETA Job', 'peta_rocks' ),
		'name_admin_bar'        => __( 'PETA Job', 'peta_rocks' ),
		'archives'              => __( 'Job Archives', 'peta_rocks' ),
		'parent_item_colon'     => __( 'Parent Job:', 'peta_rocks' ),
		'all_items'             => __( 'All Jobs', 'peta_rocks' ),
		'add_new_item'          => __( 'Add New Job', 'peta_rocks' ),
		'add_new'               => __( 'Add New', 'peta_rocks' ),
		'new_item'              => __( 'New Job', 'peta_rocks' ),
		'edit_item'             => __( 'Edit Job', 'peta_rocks' ),
		'update_item'           => __( 'Update Job', 'peta_rocks' ),
		'view_item'             => __( 'View Job', 'peta_rocks' ),
		'search_items'          => __( 'Search Job', 'peta_rocks' ),
		'not_found'             => __( 'Not found', 'peta_rocks' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'peta_rocks' ),
		'featured_image'        => __( 'Featured Image', 'peta_rocks' ),
		'set_featured_image'    => __( 'Set featured image', 'peta_rocks' ),
		'remove_featured_image' => __( 'Remove featured image', 'peta_rocks' ),
		'use_featured_image'    => __( 'Use as featured image', 'peta_rocks' ),
		'insert_into_item'      => __( 'Insert into item', 'peta_rocks' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'peta_rocks' ),
		'items_list'            => __( 'Jobs list', 'peta_rocks' ),
		'items_list_navigation' => __( 'Jobs list navigation', 'peta_rocks' ),
		'filter_items_list'     => __( 'Filter items list', 'peta_rocks' ),
	);
	$args = array(
		'label'                 => __( 'PETA Job', 'peta_rocks' ),
		'description'           => __( 'PETA Job Description', 'peta_rocks' ),
		'labels'                => $labels,
		'supports'              => array( ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'post_type', $args );

}
add_action( 'init', 'peta_job_type', 0 );