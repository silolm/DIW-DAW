<?php
/**
* The template for adding Additional Header Option in Customizer
*
* @package Higher_Education
* @since Higher Education Pro 1.0
*/


$wp_customize->add_setting( 'higher_education_theme_options[enable_featured_header_image]', array(
	'default'			=> $defaults['enable_featured_header_image'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[enable_featured_header_image]', array(
		'choices'  	=> higher_education_enable_featured_header_image_options(),
		'label'		=> esc_html__( 'Enable Header Media on ', 'higher-education' ),
		'section'   => 'header_image',
        'settings'  => 'higher_education_theme_options[enable_featured_header_image]',
        'type'	  	=> 'select',
) );


$wp_customize->add_setting( 'higher_education_theme_options[featured_image_size]', array(
	'default'			=> $defaults['featured_image_size'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_image_size]', array(
		'choices'  	=> higher_education_featured_image_size_options(),
		'label'		=> esc_html__( 'Page/Post Header Media Size', 'higher-education' ),
		'section'   => 'header_image',
		'settings'  => 'higher_education_theme_options[featured_image_size]',
		'type'	  	=> 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_header_media_title]', array(
	'default'			=> $defaults['featured_header_media_title'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_header_media_title]', array(
		'label'		=> esc_html__( 'Header Media Title', 'higher-education' ),
		'section'   => 'header_image',
        'settings'  => 'higher_education_theme_options[featured_header_media_title]',
        'type'	  	=> 'text',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_header_media_text]', array(
	'default'			=> $defaults['featured_header_media_text'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_header_media_text]', array(
		'label'    => esc_html__( 'Header Media Text', 'higher-education' ),
		'section'  => 'header_image',
		'settings' => 'higher_education_theme_options[featured_header_media_text]',
		'type'     => 'textarea',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_header_image_url]', array(
	'default'			=> $defaults['featured_header_image_url'],
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_header_image_url]', array(
		'label'    => esc_html__( 'Header Media Link URL', 'higher-education' ),
		'section'  => 'header_image',
		'settings' => 'higher_education_theme_options[featured_header_image_url]',
		'type'     => 'text',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_header_image_url_text]', array(
	'default'			=> $defaults['featured_header_image_url_text'],
	'sanitize_callback' => 'wp_kses_data',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_header_image_url_text]', array(
		'label'		=> esc_html__( 'Header Media Link Text', 'higher-education' ),
		'section'   => 'header_image',
        'settings'  => 'higher_education_theme_options[featured_header_image_url_text]',
        'type'	  	=> 'text',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_header_image_base]', array(
	'default'	=> $defaults['featured_header_image_url'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_header_image_base]', array(
	'label'    	=> esc_html__( 'Check to Open Link in New Window/Tab', 'higher-education' ),
	'section'  	=> 'header_image',
	'settings' 	=> 'higher_education_theme_options[featured_header_image_base]',
	'type'     	=> 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_header_image_alt]', array(
	'default'			=> $defaults['featured_header_image_alt'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_header_image_alt]', array(
		'label'		=> esc_html__( 'Header Media Alt/Title Tag ', 'higher-education' ),
		'section'   => 'header_image',
        'settings'  => 'higher_education_theme_options[featured_header_image_alt]',
        'type'	  	=> 'text',
) );