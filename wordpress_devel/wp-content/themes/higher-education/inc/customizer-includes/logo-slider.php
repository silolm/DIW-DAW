<?php
/**
 * The template for adding Logo Slider Options in Customizer
 *
 * @package Higher_Education
 */

//Logo Slider
$wp_customize->add_section( 'higher_education_logo_slider', array(
	'panel' => 'higher_education_theme_options',
	'title' => esc_html__( 'Logo Slider', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[logo_slider_option]', array(
	'default'			=> $defaults['logo_slider_option'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[logo_slider_option]', array(
	'choices'  => higher_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Logo Slider on', 'higher-education' ),
	'section'  => 'higher_education_logo_slider',
	'settings' => 'higher_education_theme_options[logo_slider_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[logo_slider_transition_delay]', array(
	'default'			=> $defaults['logo_slider_transition_delay'],
	'sanitize_callback'	=> 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[logo_slider_transition_delay]' , array(
	'active_callback' => 'higher_education_is_logo_slider_active',
	'description'     => esc_html__( 'seconds(s)', 'higher-education' ),
	'input_attrs'     => array(
		'style' => 'width: 100px;',
		'min'   => 0,
		),
	'label'           => esc_html__( 'Transition Delay', 'higher-education' ),
	'section'         => 'higher_education_logo_slider',
	'settings'        => 'higher_education_theme_options[logo_slider_transition_delay]',
) );

$wp_customize->add_setting( 'higher_education_theme_options[logo_slider_transition_length]', array(
	'default'			=> $defaults['logo_slider_transition_length'],
	'sanitize_callback'	=> 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[logo_slider_transition_length]' , array(
		'active_callback' => 'higher_education_is_logo_slider_active',
		'description'     => esc_html__( 'seconds(s)', 'higher-education' ),
		'input_attrs'     => array(
			'style' => 'width: 100px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'Transition Length', 'higher-education' ),
		'section'         => 'higher_education_logo_slider',
		'settings'        => 'higher_education_theme_options[logo_slider_transition_length]',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[logo_slider_title]', array(
	'default'			=> $defaults['logo_slider_title'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'higher_education_theme_options[logo_slider_title]' , array(
	'active_callback' => 'higher_education_is_logo_slider_active',
	'label'           => esc_html__( 'Title', 'higher-education' ),
	'section'         => 'higher_education_logo_slider',
	'settings'        => 'higher_education_theme_options[logo_slider_title]',
) );

$wp_customize->add_setting( 'higher_education_theme_options[logo_slider_number]', array(
	'default'			=> $defaults['logo_slider_number'],
	'sanitize_callback'	=> 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[logo_slider_number]' , array(
	'active_callback' => 'higher_education_is_logo_slider_active',
	'description'     => esc_html__( 'Save and refresh the page if No. of Slides is changed', 'higher-education' ),
	'input_attrs'     => array(
		'style' => 'width: 45px;',
		'min'   => 0,
	),
	'label'           => esc_html__( 'No of Items', 'higher-education' ),
	'section'         => 'higher_education_logo_slider',
	'settings'        => 'higher_education_theme_options[logo_slider_number]',
	'type'            => 'number',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[logo_slider_visible_items]', array(
	'default'			=> $defaults['logo_slider_visible_items'],
	'sanitize_callback' => 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[logo_slider_visible_items]', array(
	'active_callback' => 'higher_education_is_logo_slider_active',
	'input_attrs'     => array(
	'style'           => 'width: 45px;',
		'min'  => 1,
		'max'  => 5,
		'step' => 1,
	),
	'label'           => esc_html__( 'No of visible items', 'higher-education' ),
	'section'         => 'higher_education_logo_slider',
	'settings'        => 'higher_education_theme_options[logo_slider_visible_items]',
	'type'            => 'number',
) );

//loop for featured post sliders
for ( $i=1; $i <=  $options['logo_slider_number'] ; $i++ ) {
	//page content
	$wp_customize->add_setting( 'higher_education_theme_options[logo_slider_page_'. $i .']', array(
		'sanitize_callback'	=> 'higher_education_sanitize_page',
	) );

	$wp_customize->add_control( 'higher_education_logo_slider_page_'. $i, array(
		'active_callback' => 'higher_education_is_logo_slider_active',
		'label'           => esc_html__( 'Page', 'higher-education' ) . ' ' . $i ,
		'section'         => 'higher_education_logo_slider',
		'settings'        => 'higher_education_theme_options[logo_slider_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}
// Logo Slider End