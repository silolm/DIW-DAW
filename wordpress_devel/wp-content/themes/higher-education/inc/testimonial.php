<?php
/**
 * The template for displaying Testimonial
 *
 * @package Higher_Education
 */



if ( !function_exists( 'higher_education_testimonial_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook higher_education_before_content.
	*
	* @since Higher Education 0.1
	*/
	function higher_education_testimonial_display() {
		//higher_education_flush_transients();
		global $wp_query;

		// get data value from options
		$options        = higher_education_get_theme_options();
		$enable_content = $options['testimonial_option'];
		$slider_select  = $options['testimonial_slider'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ! $output = get_transient( 'higher_education_testimonial' ) ) {
				$layouts 	 = $options['testimonial_layout'];
				$headline 	 = $options['testimonial_headline'];
				$subheadline = $options['testimonial_subheadline'];

				echo '<!-- refreshing cache -->';

				$classes = $layouts . ' jetpack-testimonial';

				if ( $options['testimonial_position'] ) {
					$classes .= ' border-top' ;
				}

				$output ='
					<div id="testimonial-section" class="sections ' . $classes . '">
						<div class="wrapper">';
							if ( ! empty( $headline ) || ! empty( $subheadline ) ) {
								$output .='<div class="section-heading-wrap">';
									if ( ! empty( $headline ) ) {
										$output .='<h2 id="testimonial-heading" class="section-title">' .   $headline .'</h2>';
									}
									if ( ! empty( $subheadline ) ) {
										$output .='<p>' . wp_kses_post( $subheadline ) . '</p>';
									}
								$output .='
								</div><!-- .featured-heading-wrap -->';
							}
							$output .='
							<div class="section-content-wrap">';

								if ( $slider_select ) {
									$output .='
									<div class="cycle-slideshow"
									    data-cycle-log="false"
									    data-cycle-pause-on-hover="true"
									    data-cycle-swipe="true"
									    data-cycle-auto-height=container
										data-cycle-slides=".testimonial_slider_wrap"
										data-cycle-fx="scrollHorz"
										data-cycle-prev="#testimonial-section .content-prev"
	        							data-cycle-next="#testimonial-section .content-next"
										>

										<!-- prev/next links -->
									<div id="content-controls">
										<div class="content-prev"></div>
										<div class="content-next"></div>
									</div>';
								}

								$output .= higher_education_post_page_category_testimonial( $options );

				if ( $slider_select ) {
									$output .='
									</div><!-- .cycle-slideshow -->';
								}

				$output .='
							</div><!-- .section-content-wrap -->
							</div><!-- .section-content-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #testimonial-section -->';
			set_transient( 'higher_education_testimonial', $output, 86940 );
			}

		echo $output;
		}
	}
endif;


if ( ! function_exists( 'higher_education_testimonial_display_position' ) ) :
	/**
	 * Homepage Testimonial Position
	 *
	 * @action higher_education_content, higher_education_after_secondary
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_testimonial_display_position() {
		// Getting data from Theme Options
		$options = higher_education_get_theme_options();

		if ( $options['testimonial_position'] ) {
			add_action( 'higher_education_after_content', 'higher_education_testimonial_display', 70 );
		}
		else {
			add_action( 'higher_education_before_content', 'higher_education_testimonial_display', 90 );
		}
	}
endif; // higher_education_testimonial_display_position
add_action( 'higher_education_before', 'higher_education_testimonial_display_position' );

if ( ! function_exists( 'higher_education_post_page_category_testimonial' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: higher_education_theme_options from customizer
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_post_page_category_testimonial( $options ) {
		global $post;

		$quantity   = $options['testimonial_number'];
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$layouts    = 1;

		if ( 'layout-two' == $options['testimonial_layout'] ) {
			$layouts = 2;
		}

		$args = array(
			'post_type'           => 'any',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		for( $i = 1; $i <= $quantity; $i++ ){
			$post_id = '';

			$post_id = isset( $options['testimonial_testimonial_' . $i] ) ? $options['testimonial_testimonial_' . $i] : false;

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
		$loop     = new WP_Query( $args );

		$i = 1;

		$output = '<div class="testimonial_slider_wrap">';

		while ( $loop->have_posts() ) {
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );

			$output .= '
				<article id="testimonial-post-' . $i . '" class="post hentry jetpack-testimonial">';
			//Default value if there is no first image
			$image = '<img class="wp-post-image" src="' . esc_url( get_template_directory_uri() ).'/images/no-thumb-200x200.jpg" >';

			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( $post->ID, 'higher-education-testimonial', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
			}
			else {
				//Get the first image in page, returns false if there is no image
				$first_image = higher_education_get_first_image( $post->ID, 'higher-education-testimonial', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

				//Set value of image as first image if there is an image present in the page
				if ( '' != $first_image ) {
					$image = $first_image;
				}
			}

			$output .= '
				<figure class="testimonial-image">
					' .  $image .'
				</figure>';

			$output .= '
				<div class="entry-container">';


			$content = apply_filters( 'the_content', get_the_content() );
			$content = str_replace( ']]>', ']]&gt;', $content );

			$output .= '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';

			$output .= '<header class="entry-header">';

			$output .= the_title( '<h2 class="entry-title">', '</h2>', false );

			$output .= '
					</header><!-- .entry-header -->';

			$output .= '
				</div><!-- .entry-container -->
			</article><!-- .featured-post-' .  $i .' -->';

			if ( 0 == ( $i % $layouts ) && $i < $no_of_post ) {
				//end and start testimonial_slider_wrap div based on logic
				$output .= '
			</div><!-- .testimonial_slider_wrap -->

			<div class="testimonial_slider_wrap">';
			}

			$i++;
		} //endwhile

		wp_reset_postdata();

		$output .= '</div><!-- .testimonial_slider_wrap -->';

		return $output;
	}
endif; // higher_education_post_page_category_testimonial
