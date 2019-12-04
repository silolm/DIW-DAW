<?php
/**
* The template for adding Testimonial Settings in Customizer
*
* @package Higher_Education
* @since Higher Education 0.1
*/

$wp_customize->add_section( 'higher_education_testimonial', array(
	'panel'    => 'higher_education_theme_options',
	'title'    => esc_html__( 'Testimonial', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[testimonial_note]', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Higher_Education_Note_Control( $wp_customize, 'higher_education_theme_options[testimonial_note]', array(
	'active_callback'   => 'higher_education_is_ect_testimonial_inactive',
    'label'             => sprintf( esc_html__( 'For Testimonials, install %1$sEssential Content Types%2$s Plugin with Portfolio Content Type Enabled', 'higher-education' ),
        '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
        '</a>'
    ),
    'section'           => 'higher_education_testimonial',
    'type'              => 'description',
    'priority'          => 1,
) ) );

$wp_customize->add_setting( 'higher_education_theme_options[testimonial_option]', array(
	'default'			=> $defaults['testimonial_option'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[testimonial_option]', array(
	'active_callback' => 'higher_education_is_ect_testimonial_active',
	'choices'         => higher_education_section_visibility_options(),
	'label'           => esc_html__( 'Enable Testimonial on', 'higher-education' ),
	'section'         => 'higher_education_testimonial',
	'settings'        => 'higher_education_theme_options[testimonial_option]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[testimonial_layout]', array(
	'default'			=> $defaults['testimonial_layout'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[testimonial_layout]', array(
	'active_callback' => 'higher_education_is_testimonial_active',
	'choices'         => higher_education_testimonial_layout_options(),
	'label'           => esc_html__( 'Select Testimonial Layout', 'higher-education' ),
	'section'         => 'higher_education_testimonial',
	'settings'        => 'higher_education_theme_options[testimonial_layout]',
	'type'            => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[testimonial_position]', array(
	'default'			=> $defaults['testimonial_position'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'higher_education_theme_options[testimonial_position]', array(
	'active_callback' => 'higher_education_is_testimonial_active',
	'label'           => esc_html__( 'Check to Move above Footer', 'higher-education' ),
	'section'         => 'higher_education_testimonial',
	'settings'        => 'higher_education_theme_options[testimonial_position]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[testimonial_slider]', array(
	'default'           => $defaults['testimonial_slider'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'higher_education_theme_options[testimonial_slider]', array(
	'active_callback' => 'higher_education_is_testimonial_active',
	'label'           => esc_html__( 'Check to Enable Slider', 'higher-education' ),
	'section'         => 'higher_education_testimonial',
	'settings'        => 'higher_education_theme_options[testimonial_slider]',
	'type'            => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[testimonial_headline]', array(
	'default'           => $defaults['testimonial_headline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[testimonial_headline]' , array(
	'active_callback' => 'higher_education_is_testimonial_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Headline', 'higher-education' ),
	'label'           => esc_html__( 'Headline for Testimonial', 'higher-education' ),
	'section'         => 'higher_education_testimonial',
	'settings'        => 'higher_education_theme_options[testimonial_headline]',
	'type'            => 'text',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[testimonial_subheadline]', array(
	'default'           => $defaults['testimonial_subheadline'],
	'sanitize_callback' => 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[testimonial_subheadline]' , array(
	'active_callback' => 'higher_education_is_testimonial_active',
	'description'     => esc_html__( 'Leave field empty if you want to remove Sub-headline', 'higher-education' ),
	'label'           => esc_html__( 'Sub-headline for Testimonial', 'higher-education' ),
	'section'         => 'higher_education_testimonial',
	'settings'        => 'higher_education_theme_options[testimonial_subheadline]',
	'type'            => 'textarea',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[testimonial_number]', array(
	'default'           => $defaults['testimonial_number'],
	'sanitize_callback' => 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[testimonial_number]' , array(
		'active_callback' => 'higher_education_is_testimonial_active',
		'description'     => esc_html__( 'Save and refresh the page if No. of Testimonial is changed', 'higher-education' ),
		'input_attrs'     => array(
			'style' => 'width: 45px;',
			'min'   => 0,
		),
		'label'           => esc_html__( 'No of Testimonial', 'higher-education' ),
		'section'         => 'higher_education_testimonial',
		'settings'        => 'higher_education_theme_options[testimonial_number]',
		'type'            => 'number',
		)
);

for ( $i=1; $i <=  $options['testimonial_number'] ; $i++ ) {
	//for jetpack testimonial
	$wp_customize->add_setting( 'higher_education_theme_options[testimonial_testimonial_'. $i .']', array(
					'sanitize_callback'	=> 'higher_education_sanitize_page',
		)
	);

	$wp_customize->add_control( 'higher_education_theme_options[testimonial_testimonial_'. $i .']'. $i, array(
		'active_callback' => 'higher_education_is_testimonial_active',
		'label'           => esc_html__( 'Testimonial ', 'higher-education' ) . ' ' . $i ,
		'section'         => 'higher_education_testimonial',
		'settings'        => 'higher_education_theme_options[testimonial_testimonial_'. $i .']',
		'type'            => 'select',
		'choices'         => higher_education_generate_post_array( 'jetpack-testimonial' ),
		)
	);
}