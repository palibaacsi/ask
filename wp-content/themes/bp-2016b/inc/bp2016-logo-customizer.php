<?php


/**
 * Set up the WordPress core custom logo feature.
 *
 * @uses bp2016_logo_style()
 */
function bp2016_logo_setup() {
//	$color_scheme        = bp2016_logo_get_color_scheme();
//	$default_text_color  = trim( $color_scheme[4], '#' );

	/**
	 * Filter Twenty Fifteen custom-logo support arguments.
	 *
	 * @since Twenty Fifteen 1.0
	 *
	 * @param array $args {
	 *     An array of custom-logo support arguments.
	 *
	 *     @type string $default_text_color     Default color of the logo text.
	 *     @type int    $width                  Width in pixels of the custom logo image. Default 954.
	 *     @type int    $height                 Height in pixels of the custom logo image. Default 1300.
	 *     @type string $wp-head-callback       Callback function used to styles the logo image and text
	 *                                          displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-logo', apply_filters( 'bp2016_logo_args', array(
		'default-text-color'     => $default_text_color,
		'width'                  => 200,
		'height'                 => 100,
		'wp-head-callback'       => 'bp2016_logo_style',
	) ) );
}
add_action( 'after_setup_theme', 'bp2016_logo_setup' );


function bp2016_logo_customize_register( $wp_customize ) {

//	function bp2016_logo_customize( $wp_customize ) {
    $wp_customize->add_section(
        'bp2016_logo_section',
        array(
            'title' => 'Logo Section',
            'description' => 'This section is for uploading your logo.',
            'priority' => 45,
        )
    );


	$wp_customize->add_setting( 'bp2016-logo' );
	 
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'bp2016-logo',
	        array(
	            'label' => 'Upload a Logo',
	            'section' => 'bp2016_logo_section',
	            'settings' => 'bp2016-logo'
	        )
	    )
	);


	$wp_customize->add_setting( 'show-bp2016-logo' );

	$wp_customize->add_control(
    'show-bp2016-logo',
    array(
        'section'   => 'bp2016_logo_section',
        'label'     => 'Display Logo?',
        'type'      => 'checkbox'
    )
);

	$wp_customize->add_setting( 'show-bp2016-text' );

	$wp_customize->add_control(
    'show-bp2016-text',
    array(
        'section'   => 'bp2016_logo_section',
        'label'     => 'Display Description?',
        'type'      => 'checkbox'
    )
);	

}
add_action( 'customize_register', 'bp2016_logo_customize_register', 11 );
