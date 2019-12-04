<?php
/**
 * Implement Default Theme/Customizer Options
 *
 * @package Higher_Education
 */


/**
 * Returns the default options for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_get_default_theme_options() {
	$options = array(
		//Site Title an Tagline
		'move_title_tagline'                              => 0,

		//Layout
		'theme_layout'                                    => 'right-sidebar',
		'single_layout'                                   => 'no-sidebar',
		'content_layout'                                  => 'excerpt-image-left',
		'single_post_image_layout'                        => 'disabled',

		//Header Image
		'enable_featured_header_image'                    => 'homepage',
		'featured_image_size'                             => 'higher-education-slider',
		'featured_header_media_title'                     => '',
		'featured_header_media_text'                      => '',
		'featured_header_image_url'                       => '',
		'featured_header_image_url_text'                  => '',
		'featured_header_image_alt'                       => '',
		'featured_header_image_base'                      => 0,

		//Breadcrumb Options
		'breadcrumb_option'                               => 0,
		'breadcrumb_on_homepage'                          => 0,
		'breadcrumb_seperator'                            => '&raquo;',

		//Scrollup Options
		'disable_scrollup'                                => 0,

		//Excerpt Options
		'excerpt_length'                                  => '40',
		'excerpt_more_text'                               => esc_html__( 'Continue Reading ...', 'higher-education' ),

		//Homepage / Frontpage Settings
		'front_page_category'                             => '0',

		//Pagination Options
		'pagination_type'                                 => 'default',

		//Promotion Headline Options
		'promotion_headline_option'                       => 'disabled',

		//Search Options
		'search_text'                                     => esc_html__( 'Search...', 'higher-education' ),

		//Featured Content Options
		'featured_content_option'                         => 'disabled',
		'featured_content_layout'                         => 'layout-four',
		'featured_content_position'                       => 0,
		'featured_content_headline'                       => '',
		'featured_content_subheadline'                    => '',
		'featured_content_type'                           => 'demo',
		'featured_content_number'                         => '4',
		'featured_content_enable_title'                   => 1,
		'featured_content_show'                           => 'hide-content',

		// Courses Options
		'courses_option'                                  => 'disabled',
		'courses_layout'                                  => 'layout-three',
		'courses_position'                                => 0,
		'courses_slider'                                  => 1,
		'courses_headline'                                => '',
		'courses_subheadline'                             => '',
		'courses_type'                                    => 'demo',
		'courses_number'                                  => '6',
		'courses_enable_title'                            => 1,
		'courses_show'                                    => 'hide-content',

		// Testimonail Options
		'testimonial_option'                              => 'disabled',
		'testimonial_layout'                              => 'layout-one',
		'testimonial_position'                            => 0,
		'testimonial_slider'                              => 1,
		'testimonial_headline'                            => '',
		'testimonial_subheadline'                         => '',
		'testimonial_type'                                => 'demo',
		'testimonial_number'                              => '4',

		//Featured Slider Options
		'featured_slider_option'                          => 'disabled',
		'featured_slider_image_loader'                    => 'true',
		'featured_slider_transition_effect'               => 'scrollHorz',
		'featured_slider_transition_delay'                => '4',
		'featured_slider_transition_length'               => '1',
		'featured_slider_number'                          => '4',
		'featured_slider_show'                            => 'excerpt',

		//Hero Content Options
		'hero_content_option'                             => 'disabled',
		'hero_content_number'                             => '1',
		'disable_read_more'                               => 0,

		//Logo Slider
		'logo_slider_option'                              => 'disabled',
		'logo_slider_visible_items'                       => '4',
		'logo_slider_transition_delay'                    => '4',
		'logo_slider_transition_length'                   => '1',
		'logo_slider_title'                               => '',
		'logo_slider_number'                              => '5',

		//Our Professors Options
		'our_professors_option'                           => 'disabled',
		'our_professors_layout'                           => 'layout-three',
		'our_professors_position'                         => 0,
		'our_professors_headline'                         => '',
		'our_professors_subheadline'                      => '',
		'our_professors_type'                             => 'demo',
		'our_professors_number'                           => '3',
		'our_professors_enable_title'                     => 1,
		'our_professors_show'                             => 'hide-content',

		//Portfolio
		'portfolio_option'                                => 'disabled',
		'portfolio_layout'                                => 'layout-three',
		'portfolio_position'                              => 0,
		'portfolio_slider'                                => 1,
		'portfolio_headline'                              => '',
		'portfolio_subheadline'                           => '',
		'portfolio_type'                                  => 'demo',
		'jetpack_portfolio_type'                          => 'individual',
		'portfolio_number'                                => '3',
		'portfolio_more_button_link'                      => '#',
		'portfolio_more_button_text'                      => esc_html__( 'View More', 'higher-education' ),
		'portfolio_more_button_target'                    => 0,

		// News Options
		'news_option'                                     => 'disabled',
		'news_layout'                                     => 'layout-three',
		'news_position'                                   => 0,
		'news_headline'                                   => esc_html__( 'Recent News', 'higher-education' ),
		'news_subheadline'                                => '',
		'news_number'                                     => '3',

		// Events Options
		'events_option'                                   => 'disabled',
		'events_position'                                 => 0,
		'events_headline'                                 => esc_html__( 'Events', 'higher-education' ),
		'events_subheadline'                              => '',
		'events_type'                                     => 'demo',
		'events_number'                                   => '4',
		'events_enable_title'                             => 1,
		'events_hide_time'                                => 0,
		'events_button_text'                              => esc_html__( 'View More', 'higher-education' ),
		'events_button_url'                               => '#',
		'events_button_target'                            => 0,
		'events_hide_date'                                => 0,

		//Reset all settings
		'reset_all_settings'                              => 0,
	);

	return apply_filters( 'higher_education_default_theme_options', $options );
}

/**
 * Returns an array of layout options registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_layouts() {
	$layout_options = array(
		'right-sidebar'         => esc_html__( 'Content, Primary Sidebar', 'higher-education' ),
		'no-sidebar'            => esc_html__( 'No Sidebar ( Content Width )', 'higher-education' ),
	);
	return apply_filters( 'higher_education_layouts', $layout_options );
}


/**
 * Returns an array of content layout options registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_get_archive_content_layout() {
	$layout_options = array(
		'excerpt-image-left'  => esc_html__( 'Show Excerpt (Image Left)', 'higher-education' ),
		'full-content'        => esc_html__( 'Show Full Content (No Featured Image)', 'higher-education' ),
	);

	return apply_filters( 'higher_education_get_archive_content_layout', $layout_options );
}


/**
 * Returns an array of feature header enable options
 *
 * @since Higher Education 0.1
 */
function higher_education_enable_featured_header_image_options() {
	$options = array(
		'homepage'               => esc_html__( 'Homepage / Frontpage', 'higher-education' ),
		'exclude-home'           => esc_html__( 'Excluding Homepage', 'higher-education' ),
		'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'higher-education' ),
		'entire-site'            => esc_html__( 'Entire Site', 'higher-education' ),
		'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'higher-education' ),
		'pages-posts'            => esc_html__( 'Pages and Posts', 'higher-education' ),
		'disabled'               => esc_html__( 'Disabled', 'higher-education' ),
	);

	return apply_filters( 'higher_education_enable_featured_header_image_options', $options );
}


/**
 * Returns an array of feature image size
 *
 * @since Higher Education 0.1
 */
function higher_education_featured_image_size_options() {
	$all_sizes = higher_education_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')';
	}

	$options['full'] = esc_html__( 'Full size', 'higher-education' );

	return apply_filters( 'higher_education_featured_image_size_options', $options );
}


/**
 * Returns an array of content and slider layout options registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_section_visibility_options() {
	$options = array(
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'higher-education' ),
		'entire-site' => esc_html__( 'Entire Site', 'higher-education' ),
		'disabled'    => esc_html__( 'Disabled', 'higher-education' ),
		);

	return apply_filters( 'higher_education_section_visibility_options', $options );
}


/**
 * Returns an array of feature content types registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_custom_section_types() {
	$options = array(
		'demo'     => esc_html__( 'Demo', 'higher-education' ),
		'post'     => esc_html__( 'Post', 'higher-education' ),
		'page'     => esc_html__( 'Page', 'higher-education' ),
		'category' => esc_html__( 'Category', 'higher-education' ),
		'image'    => esc_html__( 'Image', 'higher-education' ),
	);

	return apply_filters( 'higher_education_custom_section_types', $options );
}

/**
 * Returns an array of testimonial types registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_testimonial_types() {
	$options = array(
		'demo'                => esc_html__( 'Demo', 'higher-education' ),
		'post'                => esc_html__( 'Post', 'higher-education' ),
		'jetpack-testimonial' => esc_html__( 'Custom Post Type', 'higher-education' ),
		'page'                => esc_html__( 'Page', 'higher-education' ),
		'category'            => esc_html__( 'Category', 'higher-education' ),
		'image'               => esc_html__( 'Image', 'higher-education' ),
	);

	return apply_filters( 'higher_education_testimonial_types', $options );
}


/**
 * Returns an array of portfolio types registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_portfolio_types() {
	$options = array(
		'demo'              => esc_html__( 'Demo', 'higher-education' ),
		'post'              => esc_html__( 'Post', 'higher-education' ),
		'jetpack-portfolio' => esc_html__( 'Custom Post Type', 'higher-education' ),
		'page'              => esc_html__( 'Page', 'higher-education' ),
		'category'          => esc_html__( 'Category', 'higher-education' ),
		'image'             => esc_html__( 'Image', 'higher-education' ),
	);

	return apply_filters( 'higher_education_portfolio_types', $options );
}


/**
 * Returns an array of portfolio types registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_jetpack_portfolio_types() {
	$options = array(
		'individual'       => esc_html__( 'Select Individual Project', 'higher-education' ),
		'by-project-types' => esc_html__( 'Select By Project Types', 'higher-education' ),
		'by-project-tags'  => esc_html__( 'Select By Project Tags', 'higher-education' ),
	);

	return apply_filters( 'higher_education_portfolio_types', $options );
}


/**
 * Returns an array of featured content background image positions
 *
 * @since Higher Education 0.1
 */
function higher_education_section_bg_display_positions() {
	$options = array(
		'left'   => esc_html__( 'Left', 'higher-education' ),
		'center' => esc_html__( 'Center', 'higher-education' ),
		'right'  => esc_html__( 'Right', 'higher-education' ),
	);
	return apply_filters( 'higher_education_section_bg_display_positions', $options );
}

/**
 * Returns an array of featured content options registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_featured_content_layout_options() {
	$options = array(
		'layout-three' => esc_html__( '3 columns', 'higher-education' ),
		'layout-four'  => esc_html__( '4 columns', 'higher-education' ),
	);

	return apply_filters( 'higher_education_featured_content_layout_options', $options );
}


/**
 * Returns an array of featured content show registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_featured_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'higher-education' ),
		'full-content' => esc_html__( 'Show Full Content', 'higher-education' ),
		'hide-content' => esc_html__( 'Hide Content', 'higher-education' ),
	);

	return apply_filters( 'higher_education_featured_content_show', $options );
}


/**
 * Returns an array of testimonial content show registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_testimonial_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'higher-education' ),
		'full-content' => esc_html__( 'Show Full Content', 'higher-education' ),
	);

	return apply_filters( 'higher_education_testimonial_content_show', $options );
}


/**
 * Returns an array of testimonial layout options registered.
 *
 * @since Higher Education 0.1
 */
function higher_education_testimonial_layout_options() {
	$options = array(
		'layout-one'   => esc_html__( '1 column', 'higher-education' ),
		'layout-two'   => esc_html__( '2 columns', 'higher-education' ),
	);

	return apply_filters( 'higher_education_testimonial_layout_options', $options );
}


/**
 * Returns an array of feature slider transition effects
 *
 * @since Higher Education 0.1
 */
function higher_education_featured_slider_transition_effects() {
	$options = array(
		'fade'       => esc_html__( 'Fade', 'higher-education' ),
		'fadeout'    => esc_html__( 'Fade Out', 'higher-education' ),
		'none'       => esc_html__( 'None', 'higher-education' ),
		'scrollHorz' => esc_html__( 'Scroll Horizontal', 'higher-education' ),
		'scrollVert' => esc_html__( 'Scroll Vertical', 'higher-education' ),
		'flipHorz'   => esc_html__( 'Flip Horizontal', 'higher-education' ),
		'flipVert'   => esc_html__( 'Flip Vertical', 'higher-education' ),
		'tileSlide'  => esc_html__( 'Tile Slide', 'higher-education' ),
		'tileBlind'  => esc_html__( 'Tile Blind', 'higher-education' ),
		'shuffle'    => esc_html__( 'Shuffle', 'higher-education' ),
	);

	return apply_filters( 'higher_education_featured_slider_transition_effects', $options );
}


/**
 * Returns an array of featured slider image loader options
 *
 * @since Higher Education 0.1
 */
function higher_education_featured_slider_image_loader() {
	$options = array(
		'true'  => esc_html__( 'True', 'higher-education' ),
		'wait'  => esc_html__( 'Wait', 'higher-education' ),
		'false' => esc_html__( 'False', 'higher-education' ),
	);

	return apply_filters( 'higher_education_featured_slider_image_loader', $options );
}


/**
 * Returns an array of color schemes registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_get_pagination_types() {
	$options = array(
		'default'         => esc_html__( 'Default(Older Posts/Newer Posts)', 'higher-education' ),
		'numeric'         => esc_html__( 'Numeric', 'higher-education' ),
		'infinite-scroll' => esc_html__( 'Infinite Scroll', 'higher-education' ),
	);

	return apply_filters( 'higher_education_get_pagination_types', $options );
}

/**
 * Returns an array of content featured image size.
 *
 * @since Higher Education 0.1
 */
function higher_education_single_post_image_layout_options() {
	$all_sizes = higher_education_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')';
	}

	$options['disabled'] = esc_html__( 'Disabled', 'higher-education' );
	$options['full']     = esc_html__( 'Full size', 'higher-education' );

	return apply_filters( 'higher_education_single_post_image_layout_options', $options );
}


/**
 * Returns an array of hero content types registered for parallaxframe.
 *
 * @since Higher Education 0.1
 */
function higher_education_get_category_list() {
	$cats    = get_categories();

	foreach ( $cats as $cat ) {
		$options[$cat->term_id] = $cat->name;
	}

	return apply_filters( 'higher_education_get_category_list', $options );
}


/**
 * Returns list of social icons currently supported
 *
 * @since Higher Education 0.1
*/
/**
 * Returns list of social icons currently supported
 *
 * @since Higher Education 0.1
*/
function higher_education_get_social_icons_list() {
	$options = array(
		'facebook_link'		=> array(
			'fa_class' 	=> 'facebook',
			'label' 			=> esc_html__( 'Facebook', 'higher-education' )
			),
		'twitter_link'		=> array(
			'fa_class' 	=> 'twitter',
			'label' 			=> esc_html__( 'Twitter', 'higher-education' )
			),
		'googleplus_link'	=> array(
			'fa_class' 	=> 'google-plus',
			'label' 			=> esc_html__( 'Googleplus', 'higher-education' )
			),
		'email_link'		=> array(
			'fa_class' 	=> 'envelope-o',
			'label' 			=> esc_html__( 'Email', 'higher-education' )
			),
		'feed_link'			=> array(
			'fa_class' 	=> 'feed',
			'label' 			=> esc_html__( 'Feed', 'higher-education' )
			),
		'wordpress_link'	=> array(
			'fa_class' 	=> 'wordpress',
			'label' 			=> esc_html__( 'WordPress', 'higher-education' )
			),
		'github_link'		=> array(
			'fa_class' 	=> 'github',
			'label' 			=> esc_html__( 'GitHub', 'higher-education' )
			),
		'linkedin_link'		=> array(
			'fa_class' 	=> 'linkedin',
			'label' 			=> esc_html__( 'LinkedIn', 'higher-education' )
			),
		'pinterest_link'	=> array(
			'fa_class' 	=> 'pinterest',
			'label' 			=> esc_html__( 'Pinterest', 'higher-education' )
			),
		'flickr_link'		=> array(
			'fa_class' 	=> 'flickr',
			'label' 			=> esc_html__( 'Flickr', 'higher-education' )
			),
		'vimeo_link'		=> array(
			'fa_class' 	=> 'vimeo',
			'label' 			=> esc_html__( 'Vimeo', 'higher-education' )
			),
		'youtube_link'		=> array(
			'fa_class' 	=> 'youtube',
			'label' 			=> esc_html__( 'YouTube', 'higher-education' )
			),
		'tumblr_link'		=> array(
			'fa_class' 	=> 'tumblr',
			'label' 			=> esc_html__( 'Tumblr', 'higher-education' )
			),
		'instagram_link'	=> array(
			'fa_class' 	=> 'instagram',
			'label' 			=> esc_html__( 'Instagram', 'higher-education' )
			),
		'codepen_link'		=> array(
			'fa_class' 	=> 'codepen',
			'label' 			=> esc_html__( 'CodePen', 'higher-education' )
			),
		'dribbble_link'		=> array(
			'fa_class' 	=> 'dribbble',
			'label' 			=> esc_html__( 'Dribbble', 'higher-education' )
			),
		'skype_link'		=> array(
			'fa_class' 	=> 'skype',
			'label' 			=> esc_html__( 'Skype', 'higher-education' )
			),
		'digg_link'			=> array(
			'fa_class' 	=> 'digg',
			'label' 			=> esc_html__( 'Digg', 'higher-education' )
			),
		'reddit_link'		=> array(
			'fa_class' 	=> 'reddit',
			'label' 			=> esc_html__( 'Reddit', 'higher-education' )
			),
		'stumbleupon_link'	=> array(
			'fa_class' 	=> 'stumbleupon',
			'label' 			=> esc_html__( 'Stumbleupon', 'higher-education' )
			),
		'pocket_link'		=> array(
			'fa_class' 	=> 'get-pocket',
			'label' 			=> esc_html__( 'Pocket', 'higher-education' ),
			),
		'dropbox_link'		=> array(
			'fa_class' 	=> 'dropbox',
			'label' 			=> esc_html__( 'DropBox', 'higher-education' ),
			),
		'spotify_link'		=> array(
			'fa_class' 	=> 'spotify',
			'label' 			=> esc_html__( 'Spotify', 'higher-education' ),
			),
		'foursquare_link'	=> array(
			'fa_class' 	=> 'foursquare',
			'label' 			=> esc_html__( 'Foursquare', 'higher-education' ),
			),
		'twitch_link'		=> array(
			'fa_class' 	=> 'twitch',
			'label' 			=> esc_html__( 'Twitch', 'higher-education' ),
			),
		'website_link'		=> array(
			'fa_class' 	=> 'globe',
			'label' 			=> esc_html__( 'Website', 'higher-education' ),
			),
		'phone_link'		=> array(
			'fa_class' 	=> 'mobile',
			'label' 			=> esc_html__( 'Phone', 'higher-education' ),
			),
		'handset_link'		=> array(
			'fa_class' 	=> 'phone',
			'label' 			=> esc_html__( 'Handset', 'higher-education' ),
			),
		'cart_link'			=> array(
			'fa_class' 	=> 'shopping-cart',
			'label' 			=> esc_html__( 'Cart', 'higher-education' ),
			),
		'cloud_link'		=> array(
			'fa_class' 	=> 'cloud',
			'label' 			=> esc_html__( 'Cloud', 'higher-education' ),
			),
		'link_link'		=> array(
			'fa_class' 	=> 'link',
			'label' 			=> esc_html__( 'Link', 'higher-education' ),
			),
	);

	return apply_filters( 'higher_education_social_icons_list', $options );
}


/**
 * Returns an array of metabox layout options registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_metabox_layouts() {
	$layout_options = array(
		'default' 	=> array(
			'id' 	=> 'higher-education-layout-option',
			'value' => 'default',
			'label' => esc_html__( 'Default', 'higher-education' ),
		),
		'right-sidebar' => array(
			'id' 	=> 'higher-education-layout-option',
			'value' => 'right-sidebar',
			'label' => esc_html__( 'Content, Primary Sidebar', 'higher-education' ),
		),
		'no-sidebar'	=> array(
			'id' 	=> 'higher-education-layout-option',
			'value' => 'no-sidebar',
			'label' => esc_html__( 'No Sidebar ( Content Width )', 'higher-education' ),
		),
	);
	return apply_filters( 'higher_education_layouts', $layout_options );
}

/**
 * Returns an array of metabox header featured image options registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_metabox_header_featured_image_options() {
	$options = array(
		'default' => array(
			'id'		=> 'higher-education-header-image',
			'value' 	=> 'default',
			'label' 	=> esc_html__( 'Default', 'higher-education' ),
		),
		'enable' => array(
			'id'		=> 'higher-education-header-image',
			'value' 	=> 'enable',
			'label' 	=> esc_html__( 'Enable', 'higher-education' ),
		),
		'disable' => array(
			'id'		=> 'higher-education-header-image',
			'value' 	=> 'disable',
			'label' 	=> esc_html__( 'Disable', 'higher-education' )
		)
	);
	return apply_filters( 'header_featured_image_options', $options );
}


/**
 * Returns an array of metabox featured image options registered for Higher Education.
 *
 * @since Higher Education 0.1
 */
function higher_education_metabox_featured_image_options() {
	$options['default'] = array(
		'id'	=> 'higher-education-featured-image',
		'value' => 'default',
		'label' => esc_html__( 'Default', 'higher-education' ),
	);

	$all_sizes = higher_education_get_additional_image_sizes();

	foreach ($all_sizes as $key => $value) {
		$options[$key] = array(
			'id'	=> 'higher-education-featured-image',
			'value' => $key,
			'label' => esc_html( $key ).' ('.$value['width'].'x'.$value['height'].')'
		);

	}

	$options['full'] = array(
		'id'	=> 'higher-education-featured-image',
		'value'	=> 'full',
		'label' => esc_html__( 'Full Image', 'higher-education' ),
	);

	$options['disabled'] = array(
		'id' 	=> 'higher-education-featured-image',
		'value' => 'disabled',
		'label' => esc_html__( 'Disable Image', 'higher-education' )
	);

	return apply_filters( 'higher_education_metabox_featured_image_options', $options );
}
