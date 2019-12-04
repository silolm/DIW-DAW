<?php
/**
 * The template for displaying the News
 *
 * @package Higher_Education
 */



if ( !function_exists( 'higher_education_news_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook higher_education_before_content.
	*
	* @since Higher Education 0.1
	*/
	function higher_education_news_display() {
		//higher_education_flush_transients();
		global $wp_query;

		// get data value from options
		$options        = higher_education_get_theme_options();
		$enable_content = $options['news_option'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );


		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ( !$output = get_transient( 'higher_education_news' ) ) ) {
				$layouts 	 = $options['news_layout'];
				$headline 	 = $options['news_headline'];
				$subheadline = $options['news_subheadline'];

				echo '<!-- refreshing cache -->';

				if ( !empty( $layouts ) ) {
					$classes = $layouts ;
				}

				$classes .= ' page';

				if ( $options['news_position'] ) {
					$classes .= ' border-top' ;
				}

				$output ='
					<div id="news-section" class="sections ' . $classes . '">
						<div class="wrapper">';
							if ( !empty( $headline ) || !empty( $subheadline ) ) {
								$output .='<div class="section-heading-wrap">';
									if ( !empty( $headline ) ) {
										$output .='<h2 id="news-heading" class="section-title">' .  $headline .'</h2>';
									}
									if ( !empty( $subheadline ) ) {
										$output .='<p>' . wp_kses_post( $subheadline ) . '</p>';
									}
								$output .='</div><!-- .featured-heading-wrap -->';
							}
							$output .='
							<div class="section-content-wrap">
								' . higher_education_post_page_category_news( $options ) . '
							</div><!-- .section-content-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #news-section -->';
			set_transient( 'higher_education_news', $output, 86940 );
			}
		echo $output;
		}
	}
endif;


if ( ! function_exists( 'higher_education_news_display_position' ) ) :
	/**
	 * Homepage news Position
	 *
	 * @action higher_education_content, higher_education_after_secondary
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_news_display_position() {
		// Getting data from Theme Options
		$options = higher_education_get_theme_options();

		if ( $options['news_position'] ) {
			add_action( 'higher_education_after_content', 'higher_education_news_display', 90 );
		}
		else {
			add_action( 'higher_education_before_content', 'higher_education_news_display', 110 );
		}
	}
endif; // higher_education_news_display_position
add_action( 'higher_education_before', 'higher_education_news_display_position' );

if ( ! function_exists( 'higher_education_post_page_category_news' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: higher_education_theme_options from customizer
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_post_page_category_news( $options ) {
		global $post;

		$quantity   = $options['news_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$output     = '';

		$args = array(
			'post_type'           => 'any',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = isset( $options['news_page_' . $i] ) ? $options['news_page_' . $i] : false;

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

		$loop = new WP_Query( $args );

		$i=0;

		while ( $loop->have_posts() ) {

			$loop->the_post();

			$i++;

			$title_attribute = the_title_attribute( 'echo=0' );

			$output .= '
				<article id="featured-post-' . $i . '" class="post hentry post">';

				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="' . esc_url( get_template_directory_uri() ).'/images/no-thumb-440x440.jpg" >';

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
					<figure class="featured-content-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
						' . $image .'
						</a>
					</figure>';

				$output .= '
					<div class="entry-container">
						<header class="entry-header">
							<div class="entry-meta">' . higher_education_page_post_meta() . '</div>

							<h2 class="entry-title">
								' . the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a>', false ) . '
							</h2>
						</header>

						<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->
					</div><!-- .entry-container -->
				</article><!-- .featured-post-' . $i .' -->';
			} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // higher_education_post_page_category_news
