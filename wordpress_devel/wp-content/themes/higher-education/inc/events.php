<?php
/**
 * The template for displaying the Events
 *
 * @package Higher_Education
 */


if ( !function_exists( 'higher_education_events_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook higher_education_before_content.
	*
	* @since Higher Education 0.1
	*/
	function higher_education_events_display() {
		//higher_education_flush_transients();
		global $wp_query;

		// get data value from options
		$options        = higher_education_get_theme_options();
		$enable_content = $options['events_option'];

		// Front page displays in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );


		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		if ( 'entire-site' == $enable_content || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable_content ) ) {
			if ( ! $output = get_transient( 'higher_education_events' ) ) {
				$headline 	 = $options['events_headline'];
				$subheadline = $options['events_subheadline'];

				echo '<!-- refreshing cache -->';

				$classes = 'page';

				if ( $options['events_position'] ) {
					$classes .= ' border-top' ;
				}

				$output ='
					<div id="events-section" class="sections ' . $classes . '">
						<div class="wrapper">';
							if ( !empty( $headline ) || !empty( $subheadline ) ) {
								$output .='<div class="section-heading-wrap">';
									if ( !empty( $headline ) ) {
										$output .='<h2 id="events-heading" class="section-title">'.  $headline .'</h2>';
									}
									if ( !empty( $subheadline ) ) {
										$output .='<p>' . wp_kses_post( $subheadline ) . '</p>';
									}
								$output .='</div><!-- .featured-heading-wrap -->';
							}

				$output .='
							<div class="section-content-wrap">' . higher_education_post_page_category_events( $options );

				$target = $options['events_button_target'] ? '_blank' : '_self';

				if ( $options['events_button_url'] || $options['events_button_text'] ) {
					$output .=' <span class="readmore"><a href="' . esc_url( $options['events_button_url'] ) .  '" target="' . $target . '">' . esc_html( $options['events_button_text'] ) . '</a></span>';
				}

				$output .='
							</div><!-- .section-content-wrap -->
						</div><!-- .wrapper -->
					</div><!-- #events-section -->';
			set_transient( 'higher_education_events', $output, 86940 );
			}
		echo $output;
		}
	}
endif;


if ( ! function_exists( 'higher_education_events_display_position' ) ) :
	/**
	 * Homepage events Position
	 *
	 * @action higher_education_content, higher_education_after_secondary
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_events_display_position() {
		// Getting data from Theme Options
		$options = higher_education_get_theme_options();

		if ( $options['events_position'] ) {
			add_action( 'higher_education_after_content', 'higher_education_events_display', 80 );
		}
		else {
			add_action( 'higher_education_before_content', 'higher_education_events_display', 100 );
		}
	}
endif; // higher_education_events_display_position
add_action( 'higher_education_before', 'higher_education_events_display_position' );

if ( ! function_exists( 'higher_education_post_page_category_events' ) ) :
/**
 * This function to display featured posts content
 *
 * @param $options: higher_education_theme_options from customizer
 *
 * @since Higher Education 0.1
 */
function higher_education_post_page_category_events( $options ) {
	global $post;

	$quantity   = $options['events_number'];
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
		$post_id = isset( $options['events_page_' . $i] ) ? $options['events_page_' . $i] : false;

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

	while ( $loop->have_posts() ) {
		$loop->the_post();

		$title_attribute = the_title_attribute( 'echo=0' );

		$output .= '
			<article id="event-post-' . esc_attr( $loop->current_post + 1 ) . '" class="post hentry post">
				<div class="entry-container">';

			if ( ! $options['events_hide_date'] ) {
				$event_date      = get_the_date();
				$event_date_meta = get_post_meta( $post->ID, 'higher-education-event-date', true );

				if ( '' != $event_date_meta ) {
					$event_date = $event_date_meta;
				}

				$output .= '<p class="entry-meta"><span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $event_date . '</a></span></p>';
			}

			$output .= '
					<div class="entry-wrap">';

			if ( $options['events_enable_title'] ) {
				$output .= '
						<header class="entry-header">
							<h2 class="entry-title">
								' . the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a>', false ) . '
							</h2>
						</header>';
			}

			if ( ! $options['events_hide_time'] ) {
				$event_time = get_the_time();

				$output .= '
						<footer class="entry-footer">
							<p class="entry-meta">';

				if ( ! $options['events_hide_time'] ) {
					$output .= '<span class="event-time"><span class="screen-reader-text">' . esc_html__( 'Event Time', 'higher-education' ) . '</span><a href="' . esc_url( get_permalink() ) . '"><i class="fa fa-clock-o" aria-hidden="true"></i>' . esc_html( get_the_time() ) . '</a></span>';

					$output .= '<span class="location-links"><span class="screen-reader-text">' . esc_html__( 'Event Location', 'higher-education' ) . '</span><a href="' . esc_url( get_permalink() ) . '"><i class="fa fa-calendar" aria-hidden="true"></i>' . esc_html( get_the_date() ) . '</a></span>';
				}

				$output .= '</p><!-- .entry-meta -->
						</footer>';
			}

			$output .= '
					</div> <!-- entry-wrap -->
				</div><!-- .entry-container -->
			</article><!-- .event-post-' . esc_attr( $loop->current_post + 1 ) . ' -->';
		} //endwhile

	wp_reset_postdata();

	return $output;
}
endif; // higher_education_post_page_category_events