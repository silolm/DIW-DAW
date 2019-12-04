<?php
/**
* The template for adding Featured Slider Options in Customizer
*
* @package Higher_Education
* @since Higher Education 0.1
*/

$wp_customize->add_section( 'higher_education_featured_slider', array(
	'panel' => 'higher_education_theme_options',
	'title' => esc_html__( 'Featured Slider', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_slider_option]', array(
	'default'			=> $defaults['featured_slider_option'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_slider_option]', array(
	'choices'   => higher_education_section_visibility_options(),
	'label'    	=> esc_html__( 'Enable Slider on', 'higher-education' ),
	'section'  	=> 'higher_education_featured_slider',
	'settings' 	=> 'higher_education_theme_options[featured_slider_option]',
	'type'    	=> 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_slider_transition_effect]', array(
	'default'			=> $defaults['featured_slider_transition_effect'],
	'sanitize_callback'	=> 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_slider_transition_effect]' , array(
	'active_callback'	=> 'higher_education_is_slider_active',
	'choices'  			=> higher_education_featured_slider_transition_effects(),
	'label'				=> esc_html__( 'Transition Effect', 'higher-education' ),
	'section'  			=> 'higher_education_featured_slider',
	'settings'			=> 'higher_education_theme_options[featured_slider_transition_effect]',
	'type'				=> 'select',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[featured_slider_transition_delay]', array(
	'default'			=> $defaults['featured_slider_transition_delay'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_slider_transition_delay]' , array(
	'active_callback'	=> 'higher_education_is_slider_active',
	'description'		=> esc_html__( 'seconds(s)', 'higher-education' ),
	'input_attrs' 		=> array(
			            	'style' => 'width: 40px;',
			            	'min'   => 0,
			        	),
	'label'    			=> esc_html__( 'Transition Delay', 'higher-education' ),
	'section'  			=> 'higher_education_featured_slider',
	'settings' 			=> 'higher_education_theme_options[featured_slider_transition_delay]',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[featured_slider_transition_length]', array(
	'default'			=> $defaults['featured_slider_transition_length'],
	'sanitize_callback'	=> 'absint',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_slider_transition_length]' , array(
	'active_callback'	=> 'higher_education_is_slider_active',
	'description'		=> esc_html__( 'seconds(s)', 'higher-education' ),
	'input_attrs' 		=> array(
				            'style' => 'width: 40px;',
				            'min'   => 0,
			            	),
	'label'    			=> esc_html__( 'Transition Length', 'higher-education' ),
	'section'  			=> 'higher_education_featured_slider',
	'settings' 			=> 'higher_education_theme_options[featured_slider_transition_length]',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[featured_slider_image_loader]', array(
	'default'			=> $defaults['featured_slider_image_loader'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_slider_image_loader]', array(
	'active_callback'	=> 'higher_education_is_slider_active',
	'choices'   		=> higher_education_featured_slider_image_loader(),
	'label'    			=> esc_html__( 'Image Loader', 'higher-education' ),
	'section'  			=> 'higher_education_featured_slider',
	'settings' 			=> 'higher_education_theme_options[featured_slider_image_loader]',
	'type'    			=> 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[featured_slider_number]', array(
	'default'			=> $defaults['featured_slider_number'],
	'sanitize_callback'	=> 'higher_education_sanitize_number_range',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_slider_number]' , array(
	'active_callback'	=> 'higher_education_is_slider_active',
	'description'		=> esc_html__( 'Save and refresh the page if No. of Slides is changed', 'higher-education' ),
	'input_attrs' 		=> array(
		'style' => 'width: 45px;',
		'min'   => 0,
	),
	'label'    			=> esc_html__( 'No of Slides', 'higher-education' ),
	'section'  			=> 'higher_education_featured_slider',
	'settings' 			=> 'higher_education_theme_options[featured_slider_number]',
	'type'	   			=> 'number',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[featured_slider_show]', array(
	'default'           => $defaults['featured_slider_show'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[featured_slider_show]', array(
	'active_callback' => 'higher_education_is_slider_active',
	'choices'         => higher_education_featured_content_show(),
	'label'           => esc_html__( 'Display Content', 'higher-education' ),
	'section'         => 'higher_education_featured_slider',
	'settings'        => 'higher_education_theme_options[featured_slider_show]',
	'type'            => 'select',
) );

//loop for featured post sliders
for ( $i=1; $i <=  $options['featured_slider_number'] ; $i++ ) {
	$wp_customize->add_setting( 'higher_education_theme_options[featured_slider_page_'. $i .']', array(
		'sanitize_callback'	=> 'higher_education_sanitize_page',
	) );

	$wp_customize->add_control( 'higher_education_theme_options[featured_slider_page_'. $i .']', array(
		'active_callback' => 'higher_education_is_slider_active',
		'label'           => esc_html__( 'Page', 'higher-education' ) . ' # ' . $i ,
		'section'         => 'higher_education_featured_slider',
		'settings'        => 'higher_education_theme_options[featured_slider_page_'. $i .']',
		'type'            => 'dropdown-pages',
	) );
}
// Featured Slider End