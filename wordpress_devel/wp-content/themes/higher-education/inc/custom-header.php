<?php
/**
 * Implement Custom Header functionality
 *
 * @package Higher_Education
 */

if ( ! function_exists( 'higher_education_site_branding' ) ) :
	/**
	 * Get the logo and display
	 *
	 * @uses higher_education_get_theme_options, get_header_textcolor, get_bloginfo, display_header_text
	 * @get logo from options
	 *
	 * @display logo
	 *
	 * @action
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_site_branding() {
		$options = higher_education_get_theme_options();

		$class = $class_header= '';

		if ( ! display_header_text() ) {
			$class_header = 'class="screen-reader-text"';
			$class        = ' screen-reader-text';
		}

		$header_text = '<div id="site-header" ' . $class_header . '>';
			if ( is_front_page() && is_home() ) :
				$header_text .= '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></h1>';
			else :
				$header_text .= '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></p>';
			endif;
			$header_text .= '<p class="site-description">' . get_bloginfo( 'description' ) . '</p>
		</div><!-- #site-header -->';


		$output = '<div class="site-branding' . $class . '">' . $header_text . '</div><!-- #site-branding-->';

		if ( has_custom_logo() ) {
			if ( $options['move_title_tagline'] ) {
				$output = '<div class="site-branding logo-right">' . $header_text . '<div id="site-logo">'. get_custom_logo() . '</div><!-- #site-logo --></div><!-- .site-branding.logo-right -->';
			}
			else {
				$output = '<div class="site-branding logo-left">' . '<div id="site-logo">'. get_custom_logo() . '</div><!-- #site-logo -->' . $header_text . '</div><!-- .site-branding.logo-left -->';
			}
		}

		echo $output ;
	}
endif; // higher_education_site_branding
add_action( 'higher_education_header', 'higher_education_site_branding', 50 );

if ( ! function_exists( 'higher_education_featured_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own higher_education_featured_image(), and that function will be used instead.
	 *
	 * @since Higher Education Pro 1.0
	 */
	function higher_education_featured_image() {
		if ( has_custom_header() ) : ?>
			<div class="header-media">
				<div class="wrapper">
					<div class="header-media-wrapper">
						<div class="custom-header-media">
							<?php the_custom_header_markup(); ?>
						</div><!-- .custom-header-media -->

						<?php higher_education_header_media_text(); ?>
					</div><!-- .header-media-wrapper -->
				</div><!-- .wrapper -->
			</div><!-- .header-media -->
			<?php
			return;
		endif;
	} // higher_education_featured_image
endif;

if ( ! function_exists( 'higher_education_featured_page_post_image' ) ) :
	/**
	 * Template for Featured Header Image from Post and Page
	 *
	 * To override this in a child theme
	 * simply create your own higher_education_featured_imaage_pagepost(), and that function will be used instead.
	 *
	 * @since Higher Education Pro 1.0
	 */
	function higher_education_featured_page_post_image() {
		global $post, $wp_query;

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();
		$page_for_posts = get_option( 'page_for_posts' );

		if ( is_home() && $page_for_posts == $page_id ) {
			$header_page_id = $page_id;
		}
		else {
			$header_page_id = $post->ID;
		}

		if ( has_post_thumbnail( $header_page_id ) ) {
			$options           = higher_education_get_theme_options();
			$header_image_url  = $options['featured_header_image_url'];
			$header_image_base = $options['featured_header_image_base'];
			$header_image_alt  = $options['featured_header_image_alt'];
			$header_image_size = $options['featured_image_size'];

			if ( '' != $header_image_url ) {
				$target = '_self';

				//support for qtranslate custom link
				if ( function_exists( 'qtrans_convertURL' ) ) {
					$header_image_url = qtrans_convertURL( $header_image_url );
				}

				//Checking Link Target
				if ( $header_image_base ) {
					$target = '_blank';
				}
			}

			$feat_image = get_the_post_thumbnail( $post->ID, $header_image_size, array( 'id' => 'main-feat-img', 'alt' => $header_image_alt ) );

			$output = '<div id="header-featured-image" class ="' . esc_attr( $header_image_size ) . '">
				<div class="wrapper">';

			// Header Image Link
			if ( '' != $header_image_url ) {
				$output .= '<a title="'. esc_attr( $header_image_alt ).'" href="'. esc_url( $header_image_url ) .'" target="' . $target . '">' . $feat_image . '</a>';
			} else {
				// if empty featured_header_image on theme options, display default
				$output .= $feat_image;
			}

			$output .= '
				</div><!-- .wrapper -->
			</div><!-- #header-featured-image -->';

			echo $output;
		}
		else {
			higher_education_featured_image();
		}
	} // higher_education_featured_page_post_image
endif;

if ( ! function_exists( 'higher_education_featured_overall_image' ) ) :
	/**
	 * Template for Featured Header Image from theme options
	 *
	 * To override this in a child theme
	 * simply create your own higher_education_featured_page_post_image(), and that function will be used instead.
	 *
	 * @since Higher Education Pro 1.0
	 */
	function higher_education_featured_overall_image() {
		global $post, $wp_query;
		$options = higher_education_get_theme_options();
		$enable  = $options['enable_featured_header_image'];

		// Check Enable/Disable header image in Page/Post Meta box
		if ( is_singular() ) {
			//Individual Page/Post Image Setting
			$metabox_feat_img = get_post_meta( $post->ID, 'higher-education-header-image', true );

			if ( 'disable' == $metabox_feat_img || ( 'default' == $metabox_feat_img && 'disabled' == $enable ) ) {
				echo '<!-- Page/Post Disable Header Image -->';
				return;
			} elseif ( 'enable' == $metabox_feat_img && 'disabled' == $enable ) {
				higher_education_featured_page_post_image();
			}
		}

		// Get Page ID outside Loop
		$page_id        = $wp_query->get_queried_object_id();
		$page_for_posts = get_option( 'page_for_posts' );

		// Check Homepage
		if ( 'homepage' == $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				higher_education_featured_image();
			}
		} elseif ( 'exclude-home' == $enable ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			} else {
				higher_education_featured_image();
			}
		} elseif ( 'exclude-home-page-post' == $enable  ) {
			if ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) {
				return false;
			} elseif ( is_singular() ) {
				higher_education_featured_page_post_image();
			} else {
				higher_education_featured_image();
			}
		} elseif ( 'entire-site' == $enable ) {
			higher_education_featured_image();
		} elseif ( 'entire-site-page-post' == $enable ) {
			if ( is_singular() ) {
				higher_education_featured_page_post_image();
			} else {
				higher_education_featured_image();
			}
		} elseif ( 'pages-posts' == $enable ) {
			if ( is_singular() ) {
				higher_education_featured_page_post_image();
			}
		} else {
			echo '<!-- Disable Header Image -->';
		}


	} // higher_education_featured_overall_image
endif;
add_action( 'higher_education_after_header', 'higher_education_featured_overall_image', 60 );

if ( ! function_exists( 'higher_education_video_controls' ) ) :
	/**
	 * Customize video play/pause button in the custom header.
	 *
	 * @param array $settings header video settings.
	 */
	function higher_education_video_controls( $settings ) {
		$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'higher-education' ) . '</span>';
		$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'higher-education' ) . '</span>';
		return $settings;
	}
endif; // higher_education_video_controls().
add_filter( 'header_video_settings', 'higher_education_video_controls' );

if ( ! function_exists( 'higher_education_header_media_text' ) ) :
	/**
	 * Display Header Media Text
	 * @return void
	 */
	function higher_education_header_media_text() {
		$options = higher_education_get_theme_options();

		$title    = $options['featured_header_media_title'];
		$text     = $options['featured_header_media_text'];
		$url      = $options['featured_header_image_url'];
		$url_text = $options['featured_header_image_url_text'];
		$base     = $options['featured_header_image_base'];
		$alt      = $options['featured_header_image_alt'];
		$target   = '_self';

		if ( '' != $url ) {
			//support for qtranslate custom link
			if ( function_exists( 'qtrans_convertURL' ) ) {
				$url = qtrans_convertURL( $url );
			}

			//Checking Link Target
			if ( $base ) {
				$target = '_blank';
			}
		}

		if ( '' !== $title || '' !== $text || '' !== $url ) : ?>
			<div class="custom-header-content sections header-media-section">
				<div class="custom-header-content-wrapper">
					<?php if ( '' !== $title ) : ?>
						<h2 class="entry-title section-title"><?php echo wp_kses_post( $title ); ?></h2>
					<?php endif; ?>

					<p class="site-header-text"><?php echo wp_kses_post( $text ); ?>

					<span class="readmore"><a href="<?php echo esc_url( $url ); ?>" target="<?php echo $target; ?>" class="more-link"><?php echo wp_kses_data( $url_text ); ?><span class="screen-reader-text"><?php echo wp_kses_post( $title ); ?></span></a></p></span>
				</div><!-- .custom-header-content-wrapper -->
			</div>
		<?php endif;
	}
endif; // higher_education_header_media_text().
