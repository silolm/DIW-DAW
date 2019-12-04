<?php
/**
* The template for adding Featured Content Settings in Customizer
*
* @package Higher_Education
* @since Higher Education 0.1
*/


$wp_customize->add_section( 'higher_education_featured_content', array(
	'panel'    => 'higher_education_theme_options',
	'title'    => esc_html__( 'Featured Content', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_content_option]', array(
	'default'			=> $defaults['featured_content_option'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_content_option]', array(
	'choices'  => higher_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Featured Content on', 'higher-education' ),
	'section'  => 'higher_education_featured_content',
	'settings' => 'higher_education_theme_options[featured_content_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_content_layout]', array(
	'default'			=> $defaults['featured_content_layout'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_content_layout]', array(
	'active_callback' => 'higher_education_is_featured_content_active',
	'choices'         => higher_education_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Featured Content Layout', 'higher-education' ),
	'section'         => 'higher_education_featured_content',
	'settings'        => 'higher_education_theme_options[featured_content_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_content_position]', array(
	'default'			=> $defaults['featured_content_position'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_content_position]', array(
	'active_callback' => 'higher_education_is_featured_content_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'higher-education' ),
	'section'         => 'higher_education_featured_content',
	'settings'        => 'higher_education_theme_options[featured_content_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_content_headline]', array(
	'default'           => $defaults['featured_content_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_content_headline]' , array(
	'active_callback' => 'higher_education_is_featured_content_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'higher-education' ),
	'label'           => esc_html__( 'Headline for Featured Content', 'higher-education' ),
	'section'         => 'higher_education_featured_content',
	'settings'        => 'higher_education_theme_options[featured_content_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[featured_content_subheadline]', array(
	'default'           => $defaults['featured_content_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_content_subheadline]' , array(
	'active_callback' => 'higher_education_is_featured_content_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'higher-education' ),
	'label'           => esc_html__( 'Sub-headline for Featured Content', 'higher-education' ),
	'section'         => 'higher_education_featured_content',
	'settings'        => 'higher_education_theme_options[featured_content_subheadline]',
	'type'            => 'textarea',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[featured_content_number]', array(
	'default'           => $defaults['featured_content_number'],
	'sanitize_callback' => 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_content_number]' , array(
		'active_callback' => 'higher_education_is_featured_content_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of items', 'higher-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of items', 'higher-education' ),
		'section'         => 'higher_education_featured_content',
		'settings'        => 'higher_education_theme_options[featured_content_number]',
		'type'            => 'number',
		)
);

$wp_customize->add_setting( 'higher_education_theme_options[featured_content_enable_title]', array(
		'default'           => $defaults['featured_content_enable_title'],
		'sanitize_callback' => 'higher_education_sanitize_checkbox',
	) );

$wp_customize->add_control(  'higher_education_theme_options[featured_content_enable_title]', array(
	'active_callback' => 'higher_education_is_featured_content_active',
	'label'           => esc_html__( 'Check to Enable Title', 'higher-education' ),
	'section'         => 'higher_education_featured_content',
	'settings'        => 'higher_education_theme_options[featured_content_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_content_show]', array(
	'default'           => $defaults['featured_content_show'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_content_show]', array(
	'active_callback' => 'higher_education_is_featured_content_active',
	'choices'         => higher_education_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'higher-education' ),
	'section'         => 'higher_education_featured_content',
	'settings'        => 'higher_education_theme_options[featured_content_show]',
	'type'            => 'select',
) );

for ( $i=1; $i <=  $options['featured_content_number'] ; $i++ ) {
	$wp_customize->add_setting( 'higher_education_theme_options[featured_content_page_'. $i .']', array(
			'sanitize_callback'	=> 'higher_education_sanitize_page',
	) );

	$wp_customize->add_control( 'higher_education_featured_content_page_'. $i, array(
		'active_callback'	=> 'higher_education_is_featured_content_active',
		'label'    	=> esc_html__( 'Page', 'higher-education' ) . ' ' . $i ,
		'section'  	=> 'higher_education_featured_content',
		'settings' 	=> 'higher_education_theme_options[featured_content_page_'. $i .']',
		'type'	   	=> 'dropdown-pages',
	) );
}