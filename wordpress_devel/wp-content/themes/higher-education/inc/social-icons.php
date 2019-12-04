<?php
/**
 * The template for displaying Social Icons
 *
 * @package Higher_Education
 */


if ( ! function_exists( 'higher_education_get_social_icons' ) ) :
/**
 * Generate social icons.
 *
 * @since Higher Education 0.1
 */
function higher_education_get_social_icons(){
	if ( ( !$output = get_transient( 'higher_education_social_icons' ) ) ) {
		$output	= '';

		$options = higher_education_get_theme_options(); // Get options

		//Pre defined Social Icons Link Start
		$pre_def_social_icons =	higher_education_get_social_icons_list();

		foreach ( $pre_def_social_icons as $key => $item ) {
			if ( isset( $options[ $key ] ) && '' != $options[ $key ] ) {
				$value = $options[ $key ];

				if ( 'email_link' == $key  ) {
					$output .= '<a class="fa fa-'. sanitize_key( $item['fa_class'] ) .'" target="_blank" title="'. esc_attr__( 'Email', 'higher-education') . '" href="mailto:'. antispambot( sanitize_email( $value ) ) .'"><span class="screen-reader-text">'. esc_html__( 'Email', 'higher-education') . '</span> </a>';
				}
				elseif ( 'skype_link' == $key  ) {
					$output .= '<a class="fa fa-'. sanitize_key( $item['fa_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="'. esc_attr( $value ) .'"><span class="screen-reader-text">'. esc_attr( $item['label'] ). '</span> </a>';
				}
				elseif ( 'phone_link' == $key || 'handset_link' == $key ) {
					$output .= '<a class="fa fa-'. sanitize_key( $item['fa_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) . '" href="tel:' . preg_replace( '/\s+/', '', esc_attr( $value ) ) . '"><span class="screen-reader-text">'. esc_attr( $item['label'] ) . '</span> </a>';
				}
				else {
					$output .= '<a class="fa fa-'. sanitize_key( $item['fa_class'] ) .'" target="_blank" title="'. esc_attr( $item['label'] ) .'" href="'. esc_url( $value ) .'"><span class="screen-reader-text">'. esc_attr( $item['label'] ) .'</span> </a>';
				}
			}
		}
		//Pre defined Social Icons Link End

		set_transient( 'higher_education_social_icons', $output, 86940 );
	}

	return $output;
} // higher_education_get_social_icons
endif;