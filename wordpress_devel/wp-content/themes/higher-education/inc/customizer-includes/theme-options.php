<?php
/**
* The template for adding additional theme options in Customizer
*
* @package Higher_Education
* @since Higher Education 0.1
*/

$wp_customize->add_panel( 'higher_education_theme_options', array(
    'priority'       => 200,
    'title'    		 => esc_html__( 'Theme Options', 'higher-education' ),
) );

// Breadcrumb Option
$wp_customize->add_section( 'higher_education_breadcrumb_options', array(
	'description'	=> esc_html__( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance. You can enable/disable them on homepage and entire site.', 'higher-education' ),
	'panel'			=> 'higher_education_theme_options',
	'title'    		=> esc_html__( 'Breadcrumb Options', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[breadcrumb_option]', array(
	'default'			=> $defaults['breadcrumb_option'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'higher_education_theme_options[breadcrumb_option]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb', 'higher-education' ),
	'section'  => 'higher_education_breadcrumb_options',
	'settings' => 'higher_education_theme_options[breadcrumb_option]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[breadcrumb_on_homepage]', array(
	'default'			=> $defaults['breadcrumb_on_homepage'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox'
) );

$wp_customize->add_control( 'higher_education_theme_options[breadcrumb_on_homepage]', array(
	'label'    => esc_html__( 'Check to enable Breadcrumb on Homepage', 'higher-education' ),
	'section'  => 'higher_education_breadcrumb_options',
	'settings' => 'higher_education_theme_options[breadcrumb_on_homepage]',
	'type'     => 'checkbox',
) );

$wp_customize->add_setting( 'higher_education_theme_options[breadcrumb_seperator]', array(
	'default'			=> $defaults['breadcrumb_seperator'],
	'sanitize_callback'	=> 'sanitize_text_field',
) );

$wp_customize->add_control( 'higher_education_theme_options[breadcrumb_seperator]', array(
	'input_attrs' => array(
    		'style' => 'width: 40px;'
		),
	'label'    	=> esc_html__( 'Separator between Breadcrumbs', 'higher-education' ),
	'section' 	=> 'higher_education_breadcrumb_options',
	'settings' 	=> 'higher_education_theme_options[breadcrumb_seperator]',
	'type'     	=> 'text'
	)
);
// Breadcrumb Option End

// Excerpt Options
$wp_customize->add_section( 'higher_education_excerpt_options', array(
	'panel' => 'higher_education_theme_options',
	'title' => esc_html__( 'Excerpt Options', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[excerpt_length]', array(
	'default'			=> $defaults['excerpt_length'],
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'higher_education_theme_options[excerpt_length]', array(
	'description' => esc_html__('Excerpt length. Default is 40 words', 'higher-education'),
	'input_attrs' => array(
        'min'   => 10,
        'max'   => 200,
        'step'  => 5,
        'style' => 'width: 60px;'
        ),
    'label'    => esc_html__( 'Excerpt Length (words)', 'higher-education' ),
	'section'  => 'higher_education_excerpt_options',
	'settings' => 'higher_education_theme_options[excerpt_length]',
	'type'	   => 'number',
	)
);

$wp_customize->add_setting( 'higher_education_theme_options[excerpt_more_text]', array(
	'default'			=> $defaults['excerpt_more_text'],
	'sanitize_callback'	=> 'wp_kses_post',
) );

$wp_customize->add_control( 'higher_education_theme_options[excerpt_more_text]', array(
	'label'    => esc_html__( 'Read More Text', 'higher-education' ),
	'section'  => 'higher_education_excerpt_options',
	'settings' => 'higher_education_theme_options[excerpt_more_text]',
	'type'	   => 'text',
) );
// Excerpt Options End

//Homepage / Frontpage Options
$wp_customize->add_section( 'higher_education_homepage_options', array(
	'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'higher-education' ),
	'panel'       => 'higher_education_theme_options',
	'title'       => esc_html__( 'Homepage / Frontpage Options', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[front_page_category]', array(
	'default'			=> $defaults['front_page_category'],
	'sanitize_callback'	=> 'higher_education_sanitize_category_list',
) );

$wp_customize->add_control( new Higher_Education_Multi_Dropdown_Category_Control( $wp_customize, 'higher_education_theme_options[front_page_category]', array(
	'label'    => esc_html__( 'Select Categories', 'higher-education' ),
	'name'     => 'higher_education_theme_options[front_page_category]',
	'section'  => 'higher_education_homepage_options',
	'settings' => 'higher_education_theme_options[front_page_category]',
	'type'     => 'dropdown-categories',
) ) );
//Homepage / Frontpage Settings End

// Layout Options
$wp_customize->add_section( 'higher_education_layout', array(
	'panel'      => 'higher_education_theme_options',
	'title'      => esc_html__( 'Layout Options', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[theme_layout]', array(
	'default'			=> $defaults['theme_layout'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[theme_layout]', array(
	'choices'	=> higher_education_layouts(),
	'label'		=> esc_html__( 'Default Layout', 'higher-education' ),
	'section'	=> 'higher_education_layout',
	'type'		=> 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[single_layout]', array(
	'default'			=> $defaults['single_layout'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[single_layout]', array(
	'choices'	=> higher_education_layouts(),
	'label'		=> esc_html__( 'Single Page/Post Layout', 'higher-education' ),
	'section'	=> 'higher_education_layout',
	'type'		=> 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[content_layout]', array(
	'default'			=> $defaults['content_layout'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[content_layout]', array(
	'choices'   => higher_education_get_archive_content_layout(),
	'label'		=> esc_html__( 'Archive Content Layout', 'higher-education' ),
	'section'   => 'higher_education_layout',
	'settings'  => 'higher_education_theme_options[content_layout]',
	'type'      => 'select',
) );

$wp_customize->add_setting( 'higher_education_theme_options[single_post_image_layout]', array(
	'default'			=> $defaults['single_post_image_layout'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );


$wp_customize->add_control( 'higher_education_theme_options[single_post_image_layout]', array(
		'label'		=> esc_html__( 'Single Page/Post Image ', 'higher-education' ),
		'section'   => 'higher_education_layout',
        'settings'  => 'higher_education_theme_options[single_post_image_layout]',
        'type'	  	=> 'select',
		'choices'  	=> higher_education_single_post_image_layout_options(),
) );
// Layout Options End

// Pagination Options
$pagination_type	= $options['pagination_type'];

$nav_desc = sprintf(
	wp_kses(
		__( 'Infinite Scroll Options requires <a target="_blank" href="%1$s">JetPack Plugin</a> with Infinite Scroll module Enabled.', 'higher-education' ),
		array(
			'a' => array(
				'href' => array(),
				'target' => array(),
			),
			'br'=> array()
		)
	),
	esc_url( 'https://wordpress.org/plugins/jetpack/' )
);

$wp_customize->add_section( 'higher_education_pagination_options', array(
	'description' => $nav_desc,
	'panel'       => 'higher_education_theme_options',
	'title'       => esc_html__( 'Pagination Options', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[pagination_type]', array(
	'default'			=> $defaults['pagination_type'],
	'sanitize_callback' => 'higher_education_sanitize_select',
) );

$wp_customize->add_control( 'higher_education_theme_options[pagination_type]', array(
	'choices'  => higher_education_get_pagination_types(),
	'label'    => esc_html__( 'Pagination type', 'higher-education' ),
	'section'  => 'higher_education_pagination_options',
	'settings' => 'higher_education_theme_options[pagination_type]',
	'type'	   => 'select',
) );
// Pagination Options End

// Scrollup
$wp_customize->add_section( 'higher_education_scrollup', array(
	'panel' => 'higher_education_theme_options',
	'title' => esc_html__( 'Scrollup Options', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[disable_scrollup]', array(
	'default'			=> $defaults['disable_scrollup'],
	'sanitize_callback' => 'higher_education_sanitize_checkbox',
) );

$wp_customize->add_control( 'higher_education_theme_options[disable_scrollup]', array(
	'label'		=> esc_html__( 'Check to disable Scroll Up', 'higher-education' ),
	'section'   => 'higher_education_scrollup',
    'settings'  => 'higher_education_theme_options[disable_scrollup]',
	'type'		=> 'checkbox',
) );
// Scrollup End

// Search Options
$wp_customize->add_section( 'higher_education_search_options', array(
	'description' => esc_html__( 'Change default placeholder text in Search.', 'higher-education'),
	'panel'       => 'higher_education_theme_options',
	'title'       => esc_html__( 'Search Options', 'higher-education' ),
) );

$wp_customize->add_setting( 'higher_education_theme_options[search_text]', array(
	'default'			=> $defaults['search_text'],
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'higher_education_theme_options[search_text]', array(
	'label'		=> esc_html__( 'Default Display Text in Search', 'higher-education' ),
	'section'   => 'higher_education_search_options',
    'settings'  => 'higher_education_theme_options[search_text]',
	'type'		=> 'text',
) );
// Search Options End