<?php
/**
 * The template for displaying the Slider
 *
 * @package Higher_Education
 */


if ( !function_exists( 'higher_education_featured_slider' ) ) :
/**
 * Add slider.
 *
 * @uses action hook higher_education_before_content.
 *
 * @since Higher Education 0.1
 */
function higher_education_featured_slider() {
	//higher_education_flush_transients();
	global $wp_query;

	// get data value from options
	$options      = higher_education_get_theme_options();
	$enableslider = $options['featured_slider_option'];

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings
	$page_for_posts = get_option( 'page_for_posts' );

	if ( 'entire-site' == $enableslider  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enableslider ) ) {
		if ( ! $output = get_transient( 'higher_education_featured_slider' ) ) {
			echo '<!-- refreshing cache -->';

			$output = '
				<div id="slider-section" class="sections">
					<div class="wrapper">
						<div class="slider-container';
						if ( 'hide-content' === $options['featured_slider_show'] ) {
							$output .= ' hide-content';
						}
						$output .= '">
							<div class="cycle-slideshow"
							    data-cycle-log="false"
							    data-cycle-pause-on-hover="true"
							    data-cycle-swipe="true"
							    data-cycle-auto-height=container
							    data-cycle-fx="'. esc_attr( $options['featured_slider_transition_effect'] ) .'"
								data-cycle-speed="'. esc_attr( $options['featured_slider_transition_length'] ) * 1000 .'"
								data-cycle-timeout="'. esc_attr( $options['featured_slider_transition_delay'] ) * 1000 .'"
								data-cycle-loader="'. esc_attr( $options['featured_slider_image_loader'] ) .'"
								data-cycle-slides="> article"
								data-cycle-pager="#main-slider-cycle-pager"
								data-cycle-prev="#main-slider-cycle-prev"
	        					data-cycle-next="#main-slider-cycle-next"
	    						data-cycle-pager-template="<strong><a href=#> <span>{{slideNum}}</span> / <span>' . $options['featured_slider_number'] . '</span> </a></strong>"
								>';

								$output .=  higher_education_post_page_category_slider( $options );

				$output .= '
							</div><!-- .cycle-slideshow -->

							<div class="slider-controls">
							    <!-- prev/next links -->
							    <div id="main-slider-cycle-prev"><span>' . esc_html__( 'Previous', 'higher-education' ) . '</span></div>
							    <!-- empty element for pager links -->
		    					<div id="main-slider-cycle-pager"></div>
							    <div id="main-slider-cycle-next"><span>' . esc_html__( 'Next', 'higher-education' ) . '</span></div>
		    				</div><!-- .slider-controls -->
		    			</div><!-- .slider-container -->
					</div><!-- .wrapper -->
				</div><!-- #slider-section -->';

			set_transient( 'higher_education_featured_slider', $output, 86940 );
		}
		echo $output;
	}
}
endif;
add_action( 'higher_education_before_content', 'higher_education_featured_slider', 10 );

if ( ! function_exists( 'higher_education_post_page_category_slider' ) ) :
	/**
	 * This function to display featured post, page or category slider
	 *
	 * @param $options: higher_education_theme_options from customizer
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_post_page_category_slider( $options ) {
		global $post;

		$quantity   = $options['featured_slider_number'];
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
			$post_id = isset( $options['featured_slider_page_' . $i] ) ? $options['featured_slider_page_' . $i] : false;

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

		$i=0;
		while ( $loop->have_posts() ) {
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );
			$excerpt         = get_the_excerpt();

			$classes = 'post post-'.$post->ID.' hentry slides displayblock';

			if ( 0 === $i++ ) {
				$classes = 'post post-'.$post->ID.' hentry slides displaynone';
			}

			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( $post->ID, 'higher-education-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class'	=> 'attached-post-image' ) );
			} else {
				//Default value if there is no first image
				$image = '<img class="wp-post-image" src="'.esc_url( get_template_directory_uri() ).'/images/no-thumb-1400x640.jpg" >';

				//Get the first image in page, returns false if there is no image
				$first_image = higher_education_get_first_image( $post->ID, 'higher-education-slider', array( 'title' => $title_attribute, 'alt' => $title_attribute, 'class' => 'attached-post-image' ) );

				//Set value of image as first image if there is an image present in the page
				if ( '' != $first_image ) {
					$image = $first_image;
				}
			}

			$output .= '
			<article class="' . $classes . '">
				<figure class="slider-image">
					<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">'. $image .'</a>
				</figure><!-- .slider-image -->
				<div class="entry-container clear">
					<header class="entry-header">
						<div class="entry-meta">'. higher_education_page_post_meta() . '</div>

						<h2 class="entry-title">
							<a title="' . $title_attribute . '" href="' . esc_url( get_permalink() ) . '">'.the_title( '<span>','</span>', false ).'</a>
						</h2>
					</header>';

			if ( 'excerpt' === $options['featured_slider_show'] ) {
				$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
			} elseif ( 'full-content' === $options['featured_slider_show'] ) {
				$content = apply_filters( 'the_content', get_the_content() );
				$content = str_replace( ']]>', ']]&gt;', $content );
				$output .= '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
			}

			$output .= '
				</div><!-- .entry-container -->
			</article><!-- .slides -->';
		} // endwhile.

		wp_reset_postdata();

		return $output;
	}
endif; // higher_education_post_page_category_slider
