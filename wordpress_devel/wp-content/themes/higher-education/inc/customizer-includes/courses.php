<?php
/**
* The template for adding Courses Settings in Customizer
*
* @package Higher_Education
* @since Higher Education 0.1
*/


$wp_customize->add_section( 'higher_education_courses', array(
	'panel'    => 'higher_education_theme_options',
	'title'    => esc_html__( 'Courses', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[courses_option]', array(
	'default'			=> $defaults['courses_option'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[courses_option]', array(
	'choices'  => higher_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable Courses on', 'higher-education' ),
	'section'  => 'higher_education_courses',
	'settings' => 'higher_education_theme_options[courses_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[courses_layout]', array(
	'default'			=> $defaults['courses_layout'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[courses_layout]', array(
	'active_callback' => 'higher_education_is_courses_active',
	'choices'         => higher_education_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Courses Layout', 'higher-education' ),
	'section'         => 'higher_education_courses',
	'settings'        => 'higher_education_theme_options[courses_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[courses_position]', array(
	'default'			=> $defaults['courses_position'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'higher_education_theme_options[courses_position]', array(
	'active_callback' => 'higher_education_is_courses_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'higher-education' ),
	'section'         => 'higher_education_courses',
	'settings'        => 'higher_education_theme_options[courses_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[courses_slider]', array(
	'default'           => $defaults['courses_slider'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'higher_education_theme_options[courses_slider]', array(
	'active_callback' => 'higher_education_is_courses_active',
	'label'           => esc_html__( 'Check to Enable Slider', 'higher-education' ),
	'section'         => 'higher_education_courses',
	'settings'        => 'higher_education_theme_options[courses_slider]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[courses_headline]', array(
	'default'           => $defaults['courses_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[courses_headline]' , array(
	'active_callback' => 'higher_education_is_courses_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'higher-education' ),
	'label'           => esc_html__( 'Headline for Courses', 'higher-education' ),
	'section'         => 'higher_education_courses',
	'settings'        => 'higher_education_theme_options[courses_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[courses_subheadline]', array(
	'default'           => $defaults['courses_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[courses_subheadline]' , array(
	'active_callback' => 'higher_education_is_courses_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'higher-education' ),
	'label'           => esc_html__( 'Sub-headline for Courses', 'higher-education' ),
	'section'         => 'higher_education_courses',
	'settings'        => 'higher_education_theme_options[courses_subheadline]',
	'type'            => 'textarea',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[courses_number]', array(
	'default'           => $defaults['courses_number'],
	'sanitize_callback' => 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[courses_number]' , array(
		'active_callback' => 'higher_education_is_courses_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of Courses is changed', 'higher-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of Courses', 'higher-education' ),
		'section'         => 'higher_education_courses',
		'settings'        => 'higher_education_theme_options[courses_number]',
		'type'            => 'number',
		)
);

$wp_customize->add_setting( 'higher_education_theme_options[courses_enable_title]', array(
		'default'           => $defaults['courses_enable_title'],
		'sanitize_callback' => 'higher_education_sanitize_checkbox',
	) );

$wp_customize->add_control(  'higher_education_theme_options[courses_enable_title]', array(
	'active_callback' => 'higher_education_is_courses_active',
	'label'           => esc_html__( 'Check to Enable Title', 'higher-education' ),
	'section'         => 'higher_education_courses',
	'settings'        => 'higher_education_theme_options[courses_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[courses_show]', array(
	'default'           => $defaults['courses_show'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[courses_show]', array(
	'active_callback' => 'higher_education_is_courses_active',
	'choices'         => higher_education_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'higher-education' ),
	'section'         => 'higher_education_courses',
	'settings'        => 'higher_education_theme_options[courses_show]',
	'type'            => 'select',
) );

$priority =	7;

for ( $i=1; $i <=  $options['courses_number'] ; $i++ ) {
	$wp_customize->add_setting( 'higher_education_theme_options[courses_page_' . $i . ']', array(
			'sanitize_callback'	=> 'higher_education_sanitize_page',
	) );

	$wp_customize->add_control( 'higher_education_courses_page_'. $i, array(
		'active_callback' => 'higher_education_is_courses_active',
		'label'           => esc_html__( 'Page', 'higher-education' ) . ' ' . $i ,
		'section'         => 'higher_education_courses',
		'settings'        => 'higher_education_theme_options[courses_page_' . $i . ']',
		'type'            => 'dropdown-pages',
	) );
}