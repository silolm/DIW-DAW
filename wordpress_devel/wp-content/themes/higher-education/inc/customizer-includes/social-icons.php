<?php
/**
* The template for Social Links in Customizer
*
* @package Higher_Education
* @since Higher Education 0.1
*/

$wp_customize->add_section( 'higher_education_social_links', array(
	'panel' => 'higher_education_theme_options',
	'title' => esc_html__( 'Social Links', 'higher-education' ),
) );

$icons = higher_education_get_social_icons_list();

foreach ( $icons as $key => $value ){
	if ( 'skype_link' == $key ){
		$wp_customize->add_setting( 'higher_education_theme_options['. $key .']', array(
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'higher_education_theme_options['. $key .']', array(
			'description'	=> esc_html__( 'Skype link can be of formats:<br>callto://+{number}<br> skype:{username}?{action}. More Information in readme file', 'higher-education' ),
			'label'    		=> $value['label'],
			'section'  		=> 'higher_education_social_links',
			'settings' 		=> 'higher_education_theme_options['. $key .']',
			'type'	   		=> 'url',
		) );
	}
	else {
		if ( 'email_link' == $key ){
			$wp_customize->add_setting( 'higher_education_theme_options['. $key .']', array(
									'sanitize_callback' => 'sanitize_email',
				) );
		}
		elseif ( 'handset_link' == $key || 'phone_link' == $key ){
			$wp_customize->add_setting( 'higher_education_theme_options['. $key .']', array(
									'sanitize_callback' => 'sanitize_text_field',
				) );
		}
		else {
			$wp_customize->add_setting( 'higher_education_theme_options['. $key .']', array(
									'sanitize_callback' => 'esc_url_raw',
				) );
		}

		$wp_customize->add_control( 'higher_education_theme_options['. $key .']', array(
			'label'    => $value['label'],
			'section'  => 'higher_education_social_links',
			'settings' => 'higher_education_theme_options['. $key .']',
			'type'	   => 'url',
		) );
	}
}
