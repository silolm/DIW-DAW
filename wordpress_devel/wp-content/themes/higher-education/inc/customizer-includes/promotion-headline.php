<?php
/**
* The template for adding additional theme options in Customizer
*
* @package Higher_Education
* @since Higher Education 0.1
*/

$wp_customize->add_section( 'higher_education_promotion_headline', array(
	'panel' => 'higher_education_theme_options',
	'title' => esc_html__( 'Promotion Headline', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[promotion_headline_option]', array(
	'default'			=> $defaults['promotion_headline_option'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[promotion_headline_option]', array(
	'choices'  	=> higher_education_section_visibility_options(),
	'label'    	=> esc_html__( 'Enable on', 'higher-education' ),
	'section'  	=> 'higher_education_promotion_headline',
	'type'	  	=> 'select',
) );

//page content
$wp_customize->add_setting( 'higher_education_theme_options[promotion_headline_page]', array(
	'sanitize_callback'	=> 'higher_education_sanitize_page',
) );

$wp_customize->add_control( 'higher_education_theme_options[promotion_headline_page]', array(
	'active_callback' => 'higher_education_is_promotion_headline_active',
	'label'           => esc_html__( 'Select Page', 'higher-education' ),
	'section'         => 'higher_education_promotion_headline',
	'type'            => 'dropdown-pages',
) );