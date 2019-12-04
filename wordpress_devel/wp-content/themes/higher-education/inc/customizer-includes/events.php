<?php
/**
* The template for adding Events Settings in Customizer
*
* @package Higher_Education
* @since Higher Education 0.1
*/


$wp_customize->add_section( 'higher_education_events', array(
	'panel'    => 'higher_education_theme_options',
	'title'    => esc_html__( 'Events', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[events_option]', array(
	'default'			=> $defaults['events_option'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[events_option]', array(
	'choices'  => higher_education_section_visibility_options(),
	'label'    => esc_html__( 'Enable on', 'higher-education' ),
	'section'  => 'higher_education_events',
	'settings' => 'higher_education_theme_options[events_option]',
	'type'     => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[events_position]', array(
	'default'			=> $defaults['events_position'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'higher_education_theme_options[events_position]', array(
	'active_callback' => 'higher_education_is_events_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[events_headline]', array(
	'default'           => $defaults['events_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[events_headline]' , array(
	'active_callback' => 'higher_education_is_events_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'higher-education' ),
	'label'           => esc_html__( 'Headline', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[events_subheadline]', array(
	'default'           => $defaults['events_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[events_subheadline]' , array(
	'active_callback' => 'higher_education_is_events_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'higher-education' ),
	'label'           => esc_html__( 'Sub-headline', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_subheadline]',
	'type'            => 'textarea',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[events_number]', array(
	'default'           => $defaults['events_number'],
	'sanitize_callback' => 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[events_number]' , array(
	'active_callback' => 'higher_education_is_events_active',
	'description'     => esc_html__( 'Save and refresh the page if No. of items', 'higher-education' ),
	'input_attrs'     => array(
		'style' => 'width: 45px;',
		'min'   => 0,
	),
	'label'           => esc_html__( 'No of items', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_number]',
	'type'            => 'number',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[events_enable_title]', array(
		'default'           => $defaults['events_enable_title'],
		'sanitize_callback' => 'higher_education_sanitize_checkbox',
	) );

$wp_customize->add_control(  'higher_education_theme_options[events_enable_title]', array(
	'active_callback' => 'higher_education_is_events_active',
	'label'           => esc_html__( 'Check to Enable Title', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_enable_title]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[events_hide_date]', array(
    'sanitize_callback'	=> 'higher_education_sanitize_checkbox',
) );

$wp_customize->add_control( 'higher_education_theme_options[events_hide_date]', array(
	'active_callback' => 'higher_education_is_events_active',
	'label'           => esc_html__( 'Check to Hide Event Date', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_hide_date]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[events_hide_time]', array(
    'sanitize_callback'	=> 'higher_education_sanitize_checkbox',
) );

$wp_customize->add_control( 'higher_education_theme_options[events_hide_time]', array(
	'active_callback' => 'higher_education_is_events_active',
	'label'           => esc_html__( 'Check to Hide Event Time', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_hide_time]',
	'type'            => 'checkbox',
) );

for ( $i=1; $i <=  $options['events_number'] ; $i++ ) {
	$wp_customize->add_setting( 'higher_education_theme_options[events_page_'. $i .']', array(
		'sanitize_callback'	=> 'higher_education_sanitize_page',
	) );

	$wp_customize->add_control( 'higher_education_events_page_'. $i, array(
		'active_callback'	=> 'higher_education_is_events_active',
		'label'    	=> esc_html__( 'Page', 'higher-education' ) . ' ' . $i ,
		'section'  	=> 'higher_education_events',
		'settings' 	=> 'higher_education_theme_options[events_page_'. $i .']',
		'type'	   	=> 'dropdown-pages',
	) );
}

$wp_customize->add_setting( 'higher_education_theme_options[events_button_text]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'           => $defaults['events_button_text'],
) );

$wp_customize->add_control( 'higher_education_theme_options[events_button_text]', array(
	'active_callback' => 'higher_education_is_events_active',
	'label'           => esc_html__( 'More Button Text', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_button_text]',
	'type'            => 'text',
) );

$wp_customize->add_setting( 'higher_education_theme_options[events_button_url]', array(
	'sanitize_callback'	=> 'esc_url_raw',
	'default'           => $defaults['events_button_url'],
) );

$wp_customize->add_control( 'higher_education_theme_options[events_button_url]', array(
	'active_callback' => 'higher_education_is_events_active',
	'label'           => esc_html__( 'More Button Link', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_button_url]',
	'type'            => 'text',
) );

$wp_customize->add_setting( 'higher_education_theme_options[events_button_target]', array(
    'sanitize_callback'	=> 'higher_education_sanitize_checkbox',
) );

$wp_customize->add_control(  'higher_education_theme_options[events_button_target]', array(
	'active_callback' => 'higher_education_is_events_active',
	'label'           => esc_html__( 'Check to Open Link in New Window/Tab', 'higher-education' ),
	'section'         => 'higher_education_events',
	'settings'        => 'higher_education_theme_options[events_button_target]',
	'type'            => 'checkbox',
) );