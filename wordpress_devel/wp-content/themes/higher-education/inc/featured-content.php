<?php
/**
 * The template for displaying the Featured Content
 *
 * @package Higher_Education
 */



if ( !function_exists( 'higher_education_featured_content_display' ) ) :
/**
* Add Featured content.
*
* @uses action hook higher_education_before_content.
*
* @since Higher Education 0.1
*/
function higher_education_featured_content_display() {
	//higher_education_flush_transients();
	global $wp_query;

	// get data value from options
	$options        = higher_education_get_theme_options();
	$enable_content = $options['featured_content_option'];

	// Front page displays in Reading Settings
	$page_for_posts = get_option( 'page_for_posts' );


	// Get Page ID outside Loop
	$page_id = $wp_query->get_queried_object_id();
	if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
		if ( ( !$output = get_transient( 'higher_education_featured_content' ) ) ) {
			$layouts 	 = $options['featured_content_layout'];
			$headline 	 = $options['featured_content_headline'];
			$subheadline = $options['featured_content_subheadline'];

			echo '<!-- refreshing cache -->';

			if ( !empty( $layouts ) ) {
				$classes = $layouts ;
			}

			$classes .= ' page';

			if ( $options['featured_content_position'] ) {
				$classes .= ' border-top' ;
			}

			$output ='
				<div id="featured-section" class="sections ' . $classes . '">
					<div class="wrapper">';
						if ( !empty( $headline ) || !empty( $subheadline ) ) {
							$output .='<div class="section-heading-wrap">';
								if ( !empty( $headline ) ) {
									$output .='<h2 id="featured-heading" class="section-title">'.  $headline .'</h2>';
								}
								if ( !empty( $subheadline ) ) {
									$output .='<p>' . wp_kses_post( $subheadline ) . '</p>';
								}
							$output .='</div><!-- .heading-wrap -->';
						}
						$output .='
						<div class="section-content-wrap">
							' . higher_education_post_page_category_content( $options ) . '
						</div><!-- .section-content-wrap -->
					</div><!-- .wrapper -->
				</div><!-- #featured-section -->';
		set_transient( 'higher_education_featured_content', $output, 86940 );
		}
	echo $output;
	}
}
endif;


if ( ! function_exists( 'higher_education_featured_content_display_position' ) ) :
/**
 * Homepage Featured Content Position
 *
 * @action higher_education_content, higher_education_after_secondary
 *
 * @since Higher Education 0.1
 */
function higher_education_featured_content_display_position() {
	// Getting data from Theme Options
	$options = higher_education_get_theme_options();

	if ( $options['featured_content_position'] ) {
		add_action( 'higher_education_after_content', 'higher_education_featured_content_display', 40 );
	}
	else {
		add_action( 'higher_education_before_content', 'higher_education_featured_content_display', 30 );
	}
}
endif; // higher_education_featured_content_display_position
add_action( 'higher_education_before', 'higher_education_featured_content_display_position' );

if ( ! function_exists( 'higher_education_post_page_category_content' ) ) :
/**
 * This function to display featured posts content
 *
 * @param $options: higher_education_theme_options from customizer
 *
 * @since Higher Education 0.1
 */
function higher_education_post_page_category_content( $options ) {
	global $post;

	$quantity   = $options['featured_content_number'];
	$no_of_post = 0; // for number of posts
	$post_list  = array();// list of valid post/page ids
	$layouts    = 3;

	$output     = '';

	if ( 'layout-four' == $options['featured_content_layout'] ) {
		$layouts = 4;
	}

	$args = array(
		'post_type'           => 'any',
		'orderby'             => 'post__in',
		'ignore_sticky_posts' => 1 // ignore sticky posts
	);

	//Get valid number of posts
	for( $i = 1; $i <= $quantity; $i++ ){
		$post_id = isset( $options['featured_content_page_' . $i] ) ? $options['featured_content_page_' . $i] : false;

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
			$image = '<img class="wp-post-image" src="'.esc_url( get_template_directory_uri() ).'/images/no-thumb-80x80.jpg" >';

			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( $post->ID, 'higher-education-featured-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
			}
			else {
				//Get the first image in page, returns false if there is no image
				$first_image = higher_education_get_first_image( $post->ID, 'higher-education-featured-content', array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

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

			if ( $options['featured_content_enable_title'] || 'hide-content' != $options['featured_content_show'] ) {
			$output .= '
				<div class="entry-container">';
				if ( $options['featured_content_enable_title'] ) {
					$output .= '
						<header class="entry-header">
							<h2 class="entry-title">
								<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . the_title( '','', false ) . '</a>
							</h2>
						</header>';
				}

				if ( 'excerpt' == $options['featured_content_show'] ) {
					//Show Excerpt
					$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
				}
				elseif ( 'full-content' == $options['featured_content_show'] ) {
					//Show Content
					$content = apply_filters( 'the_content', get_the_content() );
					$content = str_replace( ']]>', ']]&gt;', $content );
					$output .= '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
				}
			}
			$output .= '
			</article><!-- .featured-post-'. $i .' -->';
		} //endwhile

	wp_reset_postdata();

	return $output;
}
endif; // higher_education_post_page_category_content
