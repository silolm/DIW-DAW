<?php
/**
 * The template for adding Portfolio Settings in Customizer
 *
 * @package Higher_Education
 */

$wp_customize->add_section( 'higher_education_portfolio', array(
	'panel' => 'higher_education_theme_options',
	'title' => esc_html__( 'Portfolio', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[portfolio_note]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Higher_Education_Note_Control( $wp_customize, 'higher_education_theme_options[portfolio_note]', array(
	'active_callback'   => 'higher_education_is_ect_portfolio_inactive',
    'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Content Type Enabled', 'higher-education' ),
        '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
        '</a>'
    ),
    'section'           => 'higher_education_portfolio',
    'type'              => 'description',
    'priority'          => 1,
) ) );

$wp_customize->add_setting( 'higher_education_theme_options[portfolio_option]', array(
	'default'			=> $defaults['portfolio_option'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[portfolio_option]', array(
	'active_callback' => 'higher_education_is_ect_portfolio_active',
	'choices'         => higher_education_section_visibility_options(),
	'label'           => esc_html__( 'Enable Portfolio on', 'higher-education' ),
	'section'         => 'higher_education_portfolio',
	'settings'        => 'higher_education_theme_options[portfolio_option]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[portfolio_layout]', array(
	'default'			=> $defaults['portfolio_layout'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[portfolio_layout]', array(
	'active_callback' => 'higher_education_is_portfolio_active',
	'choices'         => higher_education_featured_content_layout_options(),
	'label'           => esc_html__( 'Select Portfolio Layout', 'higher-education' ),
	'section'         => 'higher_education_portfolio',
	'settings'        => 'higher_education_theme_options[portfolio_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[portfolio_headline]', array(
	'default'           => $defaults['portfolio_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[portfolio_headline]' , array(
	'active_callback' => 'higher_education_is_portfolio_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'higher-education' ),
	'label'           => esc_html__( 'Headline for Portfolio', 'higher-education' ),
	'section'         => 'higher_education_portfolio',
	'settings'        => 'higher_education_theme_options[portfolio_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[portfolio_subheadline]', array(
	'default'           => $defaults['portfolio_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[portfolio_subheadline]' , array(
	'active_callback' => 'higher_education_is_portfolio_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'higher-education' ),
	'label'           => esc_html__( 'Sub-headline for Portfolio', 'higher-education' ),
	'section'         => 'higher_education_portfolio',
	'settings'        => 'higher_education_theme_options[portfolio_subheadline]',
	'type'            => 'textarea',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[portfolio_number]', array(
	'default'           => $defaults['portfolio_number'],
	'sanitize_callback' => 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[portfolio_number]' , array(
	'active_callback' => 'higher_education_is_portfolio_active',
	'description'     => esc_html__( 'Save and refresh the page if No. of Portfolio is changed', 'higher-education' ),
	'input_attrs'     => array(
		'style' => 'width: 45px;',
		'min'   => 0,
	),
	'label'           => esc_html__( 'No of Portfolio', 'higher-education' ),
	'section'         => 'higher_education_portfolio',
	'settings'        => 'higher_education_theme_options[portfolio_number]',
	'type'            => 'number',
	)
);

for ( $i=1; $i <=  $options['portfolio_number'] ; $i++ ) {
	//for jetpack portfolio
	$wp_customize->add_setting( 'higher_education_theme_options[portfolio_project_'. $i .']', array(
			'sanitize_callback'	=> 'higher_education_sanitize_page',
		)
	);

	$wp_customize->add_control( 'higher_education_theme_options[portfolio_project_'. $i .']'. $i, array(
		'active_callback' => 'higher_education_is_portfolio_active',
		'label'           => esc_html__( 'Portfolio ', 'higher-education' ) . ' ' . $i ,
		'section'         => 'higher_education_portfolio',
		'settings'        => 'higher_education_theme_options[portfolio_project_'. $i .']',
		'type'            => 'select',
		'choices'         => higher_education_generate_post_array( 'jetpack-portfolio' ),
		)
	);
}

$wp_customize->add_setting( 'higher_education_theme_options[portfolio_more_button_text]', array(
	'default'			=> $defaults['portfolio_more_button_text'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'higher_education_theme_options[portfolio_more_button_text]', array(
	'active_callback' => 'higher_education_is_portfolio_active',
	'label'           => esc_html__( 'More Button Text', 'higher-education' ),
	'section'         => 'higher_education_portfolio',
	'settings'        => 'higher_education_theme_options[portfolio_more_button_text]',
	'type'            => 'text',
) );

$wp_customize->add_setting( 'higher_education_theme_options[portfolio_more_button_link]', array(
	'default'			=> $defaults['portfolio_more_button_link'],
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'higher_education_theme_options[portfolio_more_button_link]', array(
	'active_callback' => 'higher_education_is_portfolio_active',
	'label'           => esc_html__( 'More Button Link', 'higher-education' ),
	'section'         => 'higher_education_portfolio',
	'settings'        => 'higher_education_theme_options[portfolio_more_button_link]',
	'type'            => 'url',
) );

$wp_customize->add_setting( 'higher_education_theme_options[portfolio_more_button_target]', array(
	'default'			=> $defaults['portfolio_more_button_target'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox',
) );

$wp_customize->add_control( 'higher_education_theme_options[portfolio_more_button_target]', array(
	'active_callback' => 'higher_education_is_portfolio_active',
	'label'           => esc_html__( 'Check to Open Link in New Window/Tab', 'higher-education' ),
	'section'         => 'higher_education_portfolio',
	'settings'        => 'higher_education_theme_options[portfolio_more_button_target]',
	'type'            => 'checkbox',
) );