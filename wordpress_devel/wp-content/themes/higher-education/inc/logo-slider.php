<?php
/**
 * The template for displaying the Slider
 *
 * @package Higher_Education
 */



if ( !function_exists( 'higher_education_logo_slider' ) ) :
/**
 * Add slider.
 *
 * @uses action hook higher_education_before_content.
 *
 * @since Higher Education 0.1
 */
function higher_education_logo_slider() {
	//higher_education_flush_transients();
	global $wp_query;

	// get data value from options
	$options       = higher_education_get_theme_options();
	$enable_slider = $options['logo_slider_option'];
	$layout        = $options['logo_slider_visible_items'];

	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();

	// Front page displays in Reading Settings
	$page_for_posts = get_option( 'page_for_posts' );

	if ( 'entire-site' == $enable_slider  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_slider ) ) {
		if ( ( !$output = get_transient( 'higher_education_logo_slider' ) ) ) {
			echo '<!-- refreshing cache -->';

			if ( 1 == $layout ) {
				$class[] = 'layout-one';
			}
			elseif ( 2 == $layout ) {
				$class[] = 'layout-two';
			}
			elseif ( 3 == $layout ) {
				$class[] = 'layout-three';
			}
			elseif ( 4 == $layout ) {
				$class[] = 'layout-four';
			}
			elseif ( 5 == $layout ) {
				$class[] = 'layout-five';
			}


			$class[] = 'page';

			$output = '
				<div id="logo-section" class="sections '. esc_attr( implode( ' ', $class ) ) .'">
					<div class="wrapper">';
					if ( '' != $options['logo_slider_title'] ) {
						$output .= '<h2 id="logo-slider-title" class="section-title">' . esc_html( $options['logo_slider_title'] ) . '</h2>';
					}

					$output .= '
						<!-- prev/next links -->
						 <!-- prev/next links -->
					    <div class="cycle-prev"></div>
					    <div class="cycle-next"></div>


						<div class="logo_slider_content_slider_wrap cycle-slideshow"
						    data-cycle-log="false"
						    data-cycle-pause-on-hover="true"
						    data-cycle-swipe="true"
						    data-cycle-fx=carousel
						    data-cycle-carousel-fluid=true
						    data-cycle-carousel-visible="'. absint( $options['logo_slider_visible_items'] ) .'"
							data-cycle-speed="'. esc_attr( $options['logo_slider_transition_length'] ) * 1000 .'"
							data-cycle-timeout="'. esc_attr( $options['logo_slider_transition_delay'] ) * 1000 .'"
							data-cycle-prev=".cycle-prev"
        					data-cycle-next=".cycle-next"
							data-cycle-slides="> article"
							>
							' . higher_education_post_page_category_logo_slider( $options ) . '
						</div><!-- .logo_slider_content_slider_wrap.cycle-slideshow -->
					</div><!-- .wrapper -->
				</div><!-- #slider-section -->';

			set_transient( 'higher_education_logo_slider', $output, 86940 );
		}
		echo $output;
	}
}
endif;
add_action( 'higher_education_before_content', 'higher_education_logo_slider', 60 );

if ( ! function_exists( 'higher_education_post_page_category_logo_slider' ) ) :
/**
 * This function to display hero posts content
 *
 * @param $options: higher_education_theme_options from customizer
 *
 * @since Higher Education 0.1
 */
function higher_education_post_page_category_logo_slider( $options ) {
	global $post;

	$quantity   = $options['logo_slider_number'];
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
		$post_id = isset( $options['logo_slider_page_' . $i] ) ? $options['logo_slider_page_' . $i] : false;

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
			<article id="post-' . $i . '" class="post-' . $i . ' hentry">';

			//Default value if there is no first image
			$image = '<img class="wp-post-image" src="' . esc_url( get_template_directory_uri() ).'/images/no-thumb-249x147.jpg" >';

			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( $post->ID, 'full', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
			}
			else {
				//Get the first image in page, returns false if there is no image
				$first_image = higher_education_get_first_image( $post->ID, 'full', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

				//Set value of image as first image if there is an image present in the page
				if ( '' != $first_image ) {
					$image = $first_image;
				}
			}
			$output .= '
				<figure class="featured-content-image">
					<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
					'. $image .'
					</a>
				</figure>';

			$output .= '
			</article><!-- .post-'. $i .' -->';
		} //endwhile

	wp_reset_postdata();

	return $output;
}
endif; // higher_education_post_page_category_logo_slider
