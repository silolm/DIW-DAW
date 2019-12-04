<?php
/**
 * The template for displaying the Promotion Headline
 *
 * @package Higher_Education
 */


if ( !function_exists( 'higher_education_promotion_headline_display' ) ) :
	/**
	* Add Promotion Headline.
	*
	* @uses action hook higher_education_before_content
	*
	* @since Higher Education 0.1
	*/
	function higher_education_promotion_headline_display() {
		//higher_education_flush_transients();
		global $wp_query;

		$options        = higher_education_get_theme_options();
		$enable_content = $options['promotion_headline_option'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ( !$output = get_transient( 'higher_education_promotion_headline' ) ) ) {
				echo '<!-- refreshing cache -->';

				$output ='
					<div id="promotion-section" class="sections page">
						<div class="wrapper">
							' . higher_education_post_page_category_promotion_headline( $options ) . '
						</div><!-- .wrapper -->
					</div><!-- #promotion-section -->';

				set_transient( 'higher_education_promotion_headline', $output, 86940 );
			}
		echo $output;
		}
	}
endif;
add_action( 'higher_education_before_content', 'higher_education_promotion_headline_display', 40 );

if ( ! function_exists( 'higher_education_post_page_category_promotion_headline' ) ) :
	/**
	 * This function to display hero posts content
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_post_page_category_promotion_headline( $options ) {
		if ( absint( $options['promotion_headline_page'] ) < 1 ) {
			return false;
		}

		global $post;

		$output    = '';

		$args = array(
			'post_type'           => 'any',
			'posts_per_page'      => 1,
			'ignore_sticky_posts' => 1
		);

		$args['p'] = absint( $options['promotion_headline_page'] );

		$get_posts = new WP_Query( $args );
		while ( $get_posts->have_posts() ) {
			$get_posts->the_post();

			$content = apply_filters( 'the_content', get_the_content() );

			$content = str_replace( ']]>', ']]&gt;', $content );

			if ( '' != $content ) {
				$content = '<p>' . $content . '</p>';
			}

			$output .= the_title( '<h2 class="section-title ' . esc_attr( $post->ID ) . '">','</h2>', false ) . $content;
			} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // higher_education_post_page_category_promotion_headline
