<?php
/**
 * The template for displaying Portfolio
 *
 * @package Higher_Education
 */


if ( !function_exists( 'higher_education_portfolio_display' ) ) :
/**
* Add Featured content.
*
* @uses action hook higher_education_before_content.
*
* @since Higher Education 0.1
*/
function higher_education_portfolio_display() {
	//higher_education_flush_transients();
	global $wp_query;

	// get data value from options
	$options        = higher_education_get_theme_options();
	$enable_content = $options['portfolio_option'];

	// Front page displays in Reading Settings
	$page_for_posts = get_option( 'page_for_posts' );

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
		if ( ( !$output = get_transient( 'higher_education_portfolio' ) ) ) {
			$layouts 	 = $options['portfolio_layout'];
			$headline 	 = $options['portfolio_headline'];
			$subheadline = $options['portfolio_subheadline'];

			echo '<!-- refreshing cache -->';

			if ( !empty( $layouts ) ) {
				$classes = $layouts ;
			}

			$classes .= ' custom-post-type';

			$output ='
			<div id="portfolio-section" class="sections ' . $classes . '">
				<div class="wrapper">';
				if ( ! empty( $headline ) || ! empty( $subheadline ) ) {
					$output .='
					<div class="section-heading-wrap">';
						if ( !empty( $headline ) ) {
							$output .='<h2 class="section-title">'.  $headline .'</h2>';
						}
						if ( !empty( $subheadline ) ) {
							$output .='<p>' . wp_kses_post( $subheadline ) . '</p>';
						}
					$output .='
					</div><!-- .section-heading-wrap -->';
					}

					$output .='<div class="section-content-wrap">
						' . higher_education_post_page_category_portfolio( $options );

			if ( $options['portfolio_more_button_link'] || $options['portfolio_more_button_text'] ) {
				$target = $options['portfolio_more_button_target'] ? '_blank' : '_self';
				$output .='<span class="readmore"><a target="' . $target . '" href="' . esc_url( $options['portfolio_more_button_link'] ) . '">' . esc_html( $options['portfolio_more_button_text'] ) . '</a></span>';
			}

			$output .='
					</div><!-- .portfolio-content-wrap -->
				</div><!-- .wrapper -->
			</div><!-- .portfolio-section -->';

			set_transient( 'higher_education_portfolio', $output, 86940 );
		}

		echo $output;
	}
} //higher_education_portfolio_display
endif;
add_action( 'higher_education_before_content', 'higher_education_portfolio_display', 50 );

if ( ! function_exists( 'higher_education_post_page_category_portfolio' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: higher_education_theme_options from customizer
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_post_page_category_portfolio( $options ) {
		global $post;

		$quantity          = $options['portfolio_number'];
		$no_of_post        = 0;
		$post_list         = array();// list of valid post/page ids
		$type              = $options['portfolio_type'];
		$jetpack_portfolio = $options['jetpack_portfolio_type'];

		$output     = '<div class="portfolio_slider_wrap">';

		$args = array(
			'post_type'           => 'any',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['portfolio_project_' . $i] ) ? $options['portfolio_project_' . $i] : false;

			if ( $post_id && '' != $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;

		$args['posts_per_page'] = $no_of_post;

		if ( 0 == $no_of_post ) {
			return;
		}

		$loop = new WP_Query( $args );

		$i=0;
		while ( $loop->have_posts() ) {

			$loop->the_post();

			$i++;

			$title_attribute = the_title_attribute( 'echo=0' );

			$output .= '
				<article id="portfolio-post-' . $i . '" class="post hentry ' . esc_attr( $type )  . '">
					<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">';

			//Default value if there is no first image
			$image = '<img class="wp-post-image" src="'.esc_url( get_template_directory_uri() ).'/images/no-thumb-440x440.jpg" >';

				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( $post->ID, 'higher-education-featured-sections', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
				}
				else {
					//Get the first image in page, returns false if there is no image
					$first_image = higher_education_get_first_image( $post->ID, 'higher-education-featured-sections', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

					//Set value of image as first image if there is an image present in the page
					if ( '' != $first_image ) {
						$image = $first_image;
					}
				}

			$output .= '
						<figure class="portfolio-content-image featured-image">
							'. $image .'
						</figure>

						<div class="entry-container caption">
							<header class="entry-header vcenter">
								<h2 class="entry-title">
								' . esc_html( the_title( '' ,'', false ) ) . '
								<span class="readmore fa fa-plus"><span class="screen-reader-text">' . wp_kses_data( $options['excerpt_more_text'] ) . '</span></span>
							</header><!-- .entry-header.vcenter -->
						</div><!-- .entry-container.caption -->
					</a>';
			$output .= '
				</article><!-- .post-'. $i .' -->';
		} //endwhile

		$output .= '</div><!-- .portfolio_slider_wrap -->';

		wp_reset_postdata();

		return $output;
	}
endif; // higher_education_post_page_category_portfolio
