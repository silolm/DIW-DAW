<?php
/**
 * The main template for implementing Theme/Customzer Options
 *
 * @package Higher_Education
 */

/**
 * Implements Higher Education theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since Higher Education 0.1
 */
function higher_education_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport			= 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport	= 'postMessage';

	$wp_customize->get_setting( 'header_textcolor' )->transport	= 'refresh';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'higher_education_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'higher_education_customize_partial_blogdescription',
		) );
	}

	$options  = higher_education_get_theme_options();

	$defaults = higher_education_get_default_theme_options();

	$wp_customize->add_setting( 'higher_education_theme_options[move_title_tagline]', array(
		'default'			=> $defaults['move_title_tagline'],
		'sanitize_callback' => 'higher_education_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'higher_education_theme_options[move_title_tagline]', array(
		'label'    => esc_html__( 'Check to move Site Title and Tagline before logo', 'higher-education' ),
		'section'  => 'title_tagline',
		'settings' => 'higher_education_theme_options[move_title_tagline]',
		'type'     => 'checkbox',
	) );

	$include_array = array(
		'custom-controls',
		'courses',
		'events',
		'featured-content',
		'featured-slider',
		'header-options',
		'hero-content',
		'logo-slider',
		'news',
		'our-professors',
		'portfolio',
		'promotion-headline',
		'testimonial',
		'social-icons',
		'theme-options',
	);

	foreach ( $include_array as $value ) {
		require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/' . $value .  '.php';
	}

	// Reset all settings to default
	$wp_customize->add_section( 'higher_education_reset_all_settings', array(
		'description'	=> esc_html__( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'higher-education' ),
		'priority' 		=> 700,
		'title'    		=> esc_html__( 'Reset all settings', 'higher-education' ),
	) );

	$wp_customize->add_setting( 'higher_education_theme_options[reset_all_settings]', array(
		'default'			=> $defaults['reset_all_settings'],
		'sanitize_callback' => 'higher_education_sanitize_checkbox',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'higher_education_theme_options[reset_all_settings]', array(
		'label'    => esc_html__( 'Check to reset all settings to default', 'higher-education' ),
		'section'  => 'higher_education_reset_all_settings',
		'settings' => 'higher_education_theme_options[reset_all_settings]',
		'type'     => 'checkbox',
	) );
	// Reset all settings to default end

	//Important Links
	$wp_customize->add_section( 'important_links', array(
		'priority' => 999,
		'title'    => esc_html__( 'Important Links', 'higher-education' ),
	) );

	/**
	 * Has dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'important_links', array(
		'sanitize_callback'	=> 'higher_education_sanitize_important_link',
	) );

	$wp_customize->add_control( new Higher_Education_Important_Links( $wp_customize, 'important_links', array(
		'label'    => esc_html__( 'Important Links', 'higher-education' ),
		'section'  => 'important_links',
		'settings' => 'important_links',
		'type'     => 'important_links',
    ) ) );
    //Important Links End
}
add_action( 'customize_register', 'higher_education_customize_register' );

/**
 * Remove Plugin sections
 * @param $wp_customize Theme Customizer object
 * @return void
 */
function higher_education_remove_sections( $wp_customize ) {
	// Remove section from plugins as it is supported in theme
	$wp_customize->remove_section( 'jetpack_testimonials' );
	$wp_customize->remove_section( 'jetpack_portfolio' );
}
add_action( 'customize_register', 'higher_education_remove_sections', 100 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Higher Education 0.1
 * @see higher_education_customize_register()
 *
 * @return void
 */
function higher_education_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Higher Education 0.1
 * @see higher_education_customize_register()
 *
 * @return void
 */
function higher_education_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for Higher Education.
 * And flushes out all transient data on preview
 *
 * @since Higher Education 0.1
 */
function higher_education_customize_preview() {
	wp_enqueue_script( 'higher_education_customizer', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/customizer.min.js', array( 'customize-preview' ), '20120827', true );

	//Flush transients on preview
	higher_education_flush_transients();
}
add_action( 'customize_preview_init', 'higher_education_customize_preview' );


/**
 * Custom scripts and styles on customize.php for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_customize_scripts() {
	wp_enqueue_script( 'higher_education_customizer_custom', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/customizer-custom-scripts.min.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20150630', true );

	$higher_education_data = array(
		'reset_message'       => esc_html__( 'Refresh the customizer page after saving to view reset effects', 'higher-education' ),
		'portfolio_message'   => esc_html__( 'To use this featured, please make sure Jetpack plugin and its Custom Content Type Portfolio is activated', 'higher-education' ),
		'testimonial_message' => esc_html__( 'To use this featured, please make sure Jetpack plugin and its Custom Content Type Testimonial is activated', 'higher-education' )
	);

	// Send list of color variables as object to custom customizer js
	wp_localize_script( 'higher_education_customizer_custom', 'higher_education_data', $higher_education_data );
}
add_action( 'customize_controls_enqueue_scripts', 'higher_education_customize_scripts');


function higher_education_sort_sections_list( $wp_customize ) {
	foreach ( $wp_customize->sections() as $section_key => $section_object ) {
		if ( false !== strpos( $section_key, 'higher_education_') && 'higher_education_reset_all_settings' != $section_key && 'higher_education_important_links' != $section_key && 'higher_education_menu_options' != $section_key ) {
    		$options[] = $section_key;
		}
	}

	sort( $options );

	$priority = 1;
	foreach ( $options as  $option ) {
		$wp_customize->get_section( $option )->priority	= $priority++;
	}
}
add_action( 'customize_register', 'higher_education_sort_sections_list' );

/**
 * Function to reset date with respect to condition
 */
function higher_education_reset_data() {
	$options = higher_education_get_theme_options();
    if ( $options['reset_all_settings'] ) {
    	remove_theme_mods();

        // Flush out all transients	on reset
        higher_education_flush_transients();

        return;
    }
}
add_action( 'customize_save_after', 'higher_education_reset_data' );


//Active callbacks for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/active-callbacks.php';

//Sanitize functions for customizer
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/sanitize-functions.php';

// Upgrade Button
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/upgrade-button/class-customize.php';
