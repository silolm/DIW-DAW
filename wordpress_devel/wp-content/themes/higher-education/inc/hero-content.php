<?php
/**
 * The template for displaying the Hero Content
 *
 * @package Higher_Education
 */



if ( !function_exists( 'higher_education_hero_content_display' ) ) :
/**
* Add Featured content.
*
* @uses action hook higher_education_before_content.
*
* @since Higher Education 0.1
*/
function higher_education_hero_content_display() {
	//higher_education_flush_transients();
	global $wp_query;

	// get data value from options
	$options        = higher_education_get_theme_options();
	$enable_content = $options['hero_content_option'];

	// Front page displays in Reading Settings
	$page_for_posts = get_option( 'page_for_posts' );

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
		if ( ( !$output = get_transient( 'higher_education_hero_content' ) ) ) {
			echo '<!-- refreshing cache -->';

			$classes[] = 'page' ;

			$output ='
				<div id="hero-section" class="sections ' . implode( ' ', $classes ) . '">
					<div class="wrapper">
						' . higher_education_post_page_category_hero_content( $options ) . '
					</div><!-- .wrapper -->
				</div><!-- #hero-section -->';

			set_transient( 'higher_education_hero_content', $output, 86940 );
		}
	echo $output;
	}
}
endif;
add_action( 'higher_education_before_content', 'higher_education_hero_content_display', 20 );

if ( ! function_exists( 'higher_education_post_page_category_hero_content' ) ) :
	/**
	 * This function to display hero posts content
	 *
	 * @param $options: higher_education_theme_options from customizer
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_post_page_category_hero_content( $options ) {
		global $post;

		$quantity   = $options['hero_content_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$output     = '';

		$args = array(
			'post_type'           => 'any',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['hero_content_page_' . $i] ) ? $options['hero_content_page_' . $i] : false;

			if ( $post_id && '' != $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;

		if ( 0 == $no_of_post ) {
			return;
		}

		$args['posts_per_page'] = $no_of_post;

		$get_hero_posts         = new WP_Query( $args );

		$i=0;
		while ( $get_hero_posts->have_posts() ) {
			$get_hero_posts->the_post();

			$i++;

			$title_attribute = the_title_attribute( 'echo=0' );

			$output .= '
				<article id="post-' . $i . '" class="post-' . $i . ' hentry has-post-thumbnail">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="'.esc_url( get_template_directory_uri() ).'/images/no-thumb-440x560.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( $post->ID, 'higher-education-hero-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = higher_education_get_first_image( $post->ID, 'higher-education-hero-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $first_image ) {
						$image = $first_image;
					}
				}

				$output .= '
					<figure class="featured-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						'. $image .'
						</a>
					</figure>';

				$output .= '
					<div class="entry-container">';

				$output .= '
					<header class="entry-header">
						<h2 class="entry-title section-title">
							<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
						</h2>
					</header>';

				$content = apply_filters( 'the_content', get_the_content() );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$output .= '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
				$output .= '
					</div><!-- .entry-container -->
				</article><!-- .post-'. $i .' -->';
			} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // higher_education_post_page_category_hero_content
