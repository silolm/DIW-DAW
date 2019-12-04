<?php
/**
 * The template for adding Hero Content Settings in Customizer
 *
 * @package Higher_Education
 */

$wp_customize->add_section( 'higher_education_hero_content', array(
	'panel' => 'higher_education_theme_options',
	'title' => esc_html__( 'Hero Content', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[hero_content_option]', array(
	'default'           => $defaults['hero_content_option'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[hero_content_option]', array(
	'choices'  => higher_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Hero Content on', 'higher-education' ),
	'section'  => 'higher_education_hero_content',
	'settings' => 'higher_education_theme_options[hero_content_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[hero_content_number]', array(
	'default'           => $defaults['hero_content_number'],
	'sanitize_callback' => 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[hero_content_number]' , array(
		'active_callback' => 'higher_education_is_hero_content_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of Hero Content is changed (Max no of Hero Content is 20)', 'higher-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of Hero Content', 'higher-education' ),
		'section'         => 'higher_education_hero_content',
		'settings'        => 'higher_education_theme_options[hero_content_number]',
		'type'            => 'number',
		)
);

for ( $i=1; $i <=  $options['hero_content_number'] ; $i++ ) {
	$wp_customize->add_setting( 'higher_education_theme_options[hero_content_page_'. $i .']', array(
			'sanitize_callback'	=> 'higher_education_sanitize_page',
	) );

	$wp_customize->add_control( 'higher_education_hero_content_page_'. $i, array(
		'active_callback' => 'higher_education_is_hero_content_active',
		'label'           => esc_html__( 'Page', 'higher-education' ) . ' ' . $i ,
		'section'         => 'higher_education_hero_content',
		'settings'        => 'higher_education_theme_options[hero_content_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}