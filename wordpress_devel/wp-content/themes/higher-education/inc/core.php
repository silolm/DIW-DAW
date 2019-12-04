<?php
/**
 * Core functions and definitions
 *
 * Sets up the theme
 *
 * The first function, higher_education_initial_setup(), sets up the theme by registering support
 * for various features in WordPress, such as theme support, post thumbnails, navigation menu, and the like.
 *
 * Higher Education functions and definitions
 *
 * @package Higher_Education
 */

if ( ! function_exists( 'higher_education_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function higher_education_content_width() {
		$content_width = 920; /* pixels */

		$GLOBALS['content_width'] = apply_filters( 'higher_education_content_width', $content_width );
	}
endif;
add_action( 'after_setup_theme', 'higher_education_content_width', 0 );


if ( ! function_exists( 'higher_education_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function higher_education_template_redirect() {
		$layout = higher_education_get_theme_layout();

		if ( 'no-sidebar-full-width' == $layout  ) {
			$GLOBALS['content_width'] = 1400;
		}
	}
endif;
add_action( 'template_redirect', 'higher_education_template_redirect' );


if ( ! function_exists( 'higher_education_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function higher_education_setup() {
		/**
		 * Get Theme Options Values
		 */
		$options = higher_education_get_theme_options();

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on Higher Education, use a find and replace
		 * to change 'higher-education' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'higher-education', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Add Higher Education's custom image sizes
		add_image_size( 'higher-education-slider', 1400, 640, true ); // Used for Slider Ratio 21:9

		add_image_size( 'higher-education-featured-content', 320, 320, true ); // used in Featured Content Ratio 1:1

		add_image_size( 'higher-education-featured-sections', 440, 440, true ); // used in Archive Left/Right, Portfolio, Recent Courses, News and Blog, Ratio 1:1

		add_image_size( 'higher-education-hero-content', 440, 560, true ); // used in Professors and Hero Content Ratio 4:3

		add_image_size( 'higher-education-testimonial', 200, 200, true ); // used in Testimonial Ratio 1:1

		//Archive Images
		add_image_size( 'higher-education-featured', 920, 550, true); // used in Sticky Post and Archive Top Ratio 4:3

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'higher-education' ),
			'footer'  => esc_html__( 'Footer Menu', 'higher-education' ),
		) );

		/**
		 * Enable support for Post Formats
		 */
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', higher_education_fonts_url() ) );

		/**
		 * Setup title support for theme
		 * Supported from WordPress version 4.1 onwards
		 * More Info: https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
		 */
		add_theme_support( 'title-tag' );

		/**
		* Setup Custom Logo Support for theme
		* Supported from WordPress version 4.5 onwards
		* More Info: https://make.wordpress.org/core/2016/03/10/custom-logo/
		*/
		add_theme_support( 'custom-logo' );

		/**
		 * Setup Infinite Scroll using JetPack if navigation type is set
		 */
		$pagination_type = $options['pagination_type'];

		if ( 'infinite-scroll' == $pagination_type ) {
			add_theme_support( 'infinite-scroll', array(
				'container' => 'main',
				'footer'    => 'page'
			) );
		}

		add_theme_support( 'html5', array(
			'gallery',
			'caption',
		) );

		add_theme_support( 'html5', array(
			'gallery',
			'caption',
		) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'higher-education' ),
					'shortName' => esc_html__( 'S', 'higher-education' ),
					'size'      => 12,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'higher-education' ),
					'shortName' => esc_html__( 'M', 'higher-education' ),
					'size'      => 17,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'higher-education' ),
					'shortName' => esc_html__( 'L', 'higher-education' ),
					'size'      => 36,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'higher-education' ),
					'shortName' => esc_html__( 'XL', 'higher-education' ),
					'size'      => 42,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'higher-education' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'higher-education' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => esc_html__( 'Gray', 'higher-education' ),
				'slug'  => 'gray',
				'color' => '#686868',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'higher-education' ),
				'slug'  => 'light-gray',
				'color' => '#eeeeee',
			),
			array(
				'name'  => esc_html__( 'Blue', 'higher-education' ),
				'slug'  => 'blue',
				'color' => '#00b5df',
			),
		) );
	}
endif; // higher_education_setup
add_action( 'after_setup_theme', 'higher_education_setup' );

if ( ! function_exists( 'higher_education_fonts_url' ) ) :
	/**
	 * Register Google fonts for High Responsive.
	 *
	 * Create your own higher_education_fonts_url() function to override in a child theme.
	 *
	 * @since Higher Education 0.1
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function higher_education_fonts_url() {
		/* translators: If there are characters in your language that are not supported by Nunito Sans, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' === _x( 'on', 'Neuto font: on or off', 'higher-education' ) ) {
			return false;
		}

		$fonts_url = add_query_arg( array(
			'family' => urlencode( 'Nunito+Sans:300,300i,400,400i,600,600i,700,700i' ),
			'subset' => urlencode( 'latin,latin-ext' ),
		), 'https://fonts.googleapis.com/css' );

		return esc_url( $fonts_url );
	}
endif;

/**
 * Enqueue scripts and styles
 *
 * @uses  wp_register_script, wp_enqueue_script, wp_register_style, wp_enqueue_style, wp_localize_script
 * @action wp_enqueue_scripts
 *
 * @since Higher Education 0.1
 */
function higher_education_scripts() {
	$options = higher_education_get_theme_options();

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'higher-education-fonts', higher_education_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'higher-education-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'higher-education-block-style', get_theme_file_uri( '/css/blocks.css' ), array( 'higher-education-style' ), '1.0' );

	// Load the html5 shiv.
	wp_enqueue_script( 'higher-education-html5', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/html5.min.js', array(), '3.7.3' );
	wp_script_add_data( 'higher-education-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'higher-education-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/skip-link-focus-fix.min.js', array(), HIGHER_EDUCATION_THEME_VERSION, true );

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//For Font Awesome
	wp_enqueue_style( 'font-awesome', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/font-awesome/css/font-awesome.min.css', false, '4.7.0' );

	if ( version_compare( $GLOBALS['wp_version'], '5.0', '<' ) ) {
		wp_enqueue_script( 'jquery-fitvids', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/fitvids.min.js', array( 'jquery' ), '1.1', true );
	}

	/**
	 * Loads up Cycle JS
	 */
	if ( 'disabled' != $options['featured_slider_option'] || $options['courses_slider'] || $options['testimonial_slider'] || 'disabled' != $options['logo_slider_option']  ) {
		wp_enqueue_script( 'jquery-cycle2', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );

		$transition_effects = array(
			$options['featured_slider_transition_effect']
		);

		/**
		 * Condition checks for additional slider transition plugins
		 */
		// Scroll Vertical transition plugin addition
		if ( in_array( 'scrollVert', $transition_effects ) ){
			wp_enqueue_script( 'jquery-cycle2-scrollVert', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.scrollVert.min.js', array( 'jquery-cycle2' ), HIGHER_EDUCATION_THEME_VERSION, true );
		}

		if ( in_array( 'flipHorz', $transition_effects ) || in_array( 'flipVert', $transition_effects ) ){
			// Flip transition plugin addition
			wp_enqueue_script( 'jquery-cycle2-flip', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.flip.min.js', array( 'jquery-cycle2' ), HIGHER_EDUCATION_THEME_VERSION, true );
		}

		if ( in_array( 'tileSlide', $transition_effects ) || in_array( 'tileBlind', $transition_effects ) ){
			// tile transition plugin addition
			wp_enqueue_script( 'jquery-cycle2-tile', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.tile.min.js', array( 'jquery-cycle2' ), HIGHER_EDUCATION_THEME_VERSION, true );
		}

		if ( in_array( 'shuffle', $transition_effects ) ){
			// Shuffle transition plugin addition
			wp_enqueue_script( 'jquery-cycle2-shuffle', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.shuffle.min.js', array( 'jquery-cycle2' ), HIGHER_EDUCATION_THEME_VERSION, true );
		}

		if ( 'disabled' != $options['logo_slider_option'] ) {
			wp_enqueue_script( 'jquery-cycle2-carousel', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/jquery.cycle/jquery.cycle2.carousel.min.js', array( 'jquery-cycle2' ), HIGHER_EDUCATION_THEME_VERSION, true );
		}
	}

	/**
	 * Enqueue custom script for Higher Education.
	 */
	wp_enqueue_script( 'higher-education-custom-scripts', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/custom-scripts.min.js', array( 'jquery' ), null );

	wp_enqueue_script( 'higher-education-navigation', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/navigation.min.js', array( 'jquery' ), HIGHER_EDUCATION_THEME_VERSION, true );

	/**
	 * Loads up Scroll Up script
	 */
	if ( ! $options['disable_scrollup'] ) {
		wp_enqueue_script( 'higher-education-scrollup', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/scrollup.min.js', array( 'jquery' ), HIGHER_EDUCATION_THEME_VERSION, true  );
	}

	wp_localize_script( 'higher-education-custom-scripts', 'higherEducationScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'higher-education' ),
		'collapse' => esc_html__( 'collapse child menu', 'higher-education' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'higher_education_scripts' );


/**
 * Enqueue editor styles for Gutenberg
 *
 * @since Higher Education 1.0
 */
function higher_education_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'higher-education-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/editor-blocks.css' );
	// Add custom fonts.
	wp_enqueue_style( 'higher-education-fonts', higher_education_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'higher_education_block_editor_styles' );


/**
 * Returns the options array for Higher Education.
 * @uses  get_theme_mod
 *
 * @since Higher Education 0.1
 */
function higher_education_get_theme_options() {
	$default_options = higher_education_get_default_theme_options();

	return array_merge( $default_options , get_theme_mod( 'higher_education_theme_options', $default_options ) ) ;
}


/**
 * Flush out all transients
 *
 * @uses delete_transient
 *
 * @action customize_save, higher_education_customize_preview (see higher_education_customizer function: higher_education_customize_preview)
 *
 * @since Higher Education 0.1
 */
function higher_education_flush_transients(){
	delete_transient( 'higher_education_hero_content' );
	delete_transient( 'higher_education_featured_content' );
	delete_transient( 'higher_education_events' );
	delete_transient( 'higher_education_our_professors' );
	delete_transient( 'higher_education_news' );
	delete_transient( 'higher_education_promotion_headline' );
	delete_transient( 'higher_education_portfolio' );
	delete_transient( 'higher_education_logo_slider' );
	delete_transient( 'higher_education_testimonial' );
	delete_transient( 'higher_education_courses' );
	delete_transient( 'higher_education_featured_slider' );
	delete_transient( 'higher_education_footer_content' );
	delete_transient( 'higher_education_featured_image' );
	delete_transient( 'higher_education_social_icons' );
	delete_transient( 'higher_education_scrollup' );
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'customize_save', 'higher_education_flush_transients' );

/**
 * Flush out category transients
 *
 * @uses delete_transient
 *
 * @action edit_category
 *
 * @since Higher Education 0.1
 */
function higher_education_flush_category_transients(){
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'higher_education_flush_category_transients' );


/**
 * Flush out post related transients
 *
 * @uses delete_transient
 *
 * @action save_post
 *
 * @since Higher Education 0.1
 */
function higher_education_flush_post_transients(){
	delete_transient( 'higher_education_hero_content' );
	delete_transient( 'higher_education_featured_content' );
	delete_transient( 'higher_education_events' );
	delete_transient( 'higher_education_our_professors' );
	delete_transient( 'higher_education_news' );
	delete_transient( 'higher_education_promotion_headline' );
	delete_transient( 'higher_education_portfolio' );
	delete_transient( 'higher_education_logo_slider' );
	delete_transient( 'higher_education_testimonial' );
	delete_transient( 'higher_education_courses' );
	delete_transient( 'higher_education_featured_slider' );
	delete_transient( 'higher_education_featured_image' );
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'save_post', 'higher_education_flush_post_transients' );


if ( ! function_exists( 'higher_education_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous )
				return;
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$options         = higher_education_get_theme_options();
		$pagination_type = $options['pagination_type'];

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( 'infinite-scroll' == $pagination_type && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		?>
			<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>">
				<h3 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'higher-education' ); ?></h3>
				<?php
				/**
				 * Check if navigation type is numeric and if Wp-PageNavi Plugin is enabled
				 */
				if ( 'numeric' == $pagination_type ) {
					// Posts Pagination.
					the_posts_pagination( array(
						'prev_text'          => esc_html__( 'Previous page', 'higher-education' ),
						'next_text'          => esc_html__( 'Next page', 'higher-education' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'higher-education' ) . ' </span>',
					) );
				}
				else { ?>
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'higher-education' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'higher-education' ) ); ?></div>
				<?php
				} ?>
			</nav><!-- #nav -->
		<?php
	}
endif; // higher_education_content_nav


if ( ! function_exists( 'higher_education_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_comment( $comment, $args, $depth ) {
		if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-body">
				<?php esc_html_e( 'Pingback:', 'higher-education' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'higher-education' ), '<span class="edit-link">', '</span>' ); ?>
			</div>

		<?php else : ?>

		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php printf( __( '%s <span class="says">says:</span>', 'higher-education' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'higher-education' ), get_comment_date(), get_comment_time() ); ?>
							</time>
						</a>
						<?php edit_comment_link( esc_html__( 'Edit', 'higher-education' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'higher-education' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					) ) );
				?>
			</article><!-- .comment-body -->

		<?php
		endif;
	}
endif; // higher_education_comment()


if ( ! function_exists( 'higher_education_the_attached_image' ) ) :
	/**
	 * Prints the attached image with a link to the next attached image.
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_the_attached_image() {
		$post                = get_post();
		$attachment_size     = apply_filters( 'higher_education_attachment_size', array( 1200, 1200 ) );
		$next_attachment_url = wp_get_attachment_url();

		/**
		 * Grab the IDs of all the image attachments in a gallery so we can get the
		 * URL of the next adjacent image in a gallery, or the first image (if
		 * we're looking at the last image in a gallery), or, in a gallery of one,
		 * just the link to that image file.
		 */
		$attachment_ids = get_posts( array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => 1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
		) );

		// If there is more than 1 attachment in a gallery...
		if ( count( $attachment_ids ) > 1 ) {
			foreach ( $attachment_ids as $attachment_id ) {
				if ( $attachment_id == $post->ID ) {
					$next_id = current( $attachment_ids );
					break;
				}
			}

			// get the URL of the next image attachment...
			if ( $next_id )
				$next_attachment_url = get_attachment_link( $next_id );

			// or get the URL of the first image attachment.
			else
				$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}

		printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url( $next_attachment_url ),
			the_title_attribute( 'echo=0' ),
			wp_get_attachment_image( $post->ID, $attachment_size )
		);
	}
endif; //higher_education_the_attached_image


if ( ! function_exists( 'higher_education_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_entry_meta() {
		echo '<p class="entry-meta">';

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span>&nbsp;/&nbsp;</span>',
				sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'higher-education' ) ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			);
		}

		printf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
			sprintf( __( '<span class="screen-reader-text">Posted on</span>', 'higher-education' ) ),
			esc_url( get_permalink() ),
			$time_string
		);

		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'higher-education' ), esc_html__( '1 Comment', 'higher-education' ), esc_html__( '% Comments', 'higher-education' ) );
			echo '</span>';
		}

		edit_post_link( esc_html__( 'Edit', 'higher-education' ), '<span class="edit-link">', '</span>' );

		echo '</p><!-- .entry-meta -->';
	}
endif; //higher_education_entry_meta


if ( ! function_exists( 'higher_education_tag_category' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags.
	 *
	 * @since Higher Education Pro 1.0
	 */
	function higher_education_tag_category() {
		echo '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {
			$categories_list = get_the_category_list();
			if ( $categories_list && higher_education_categorized_blog() ) {
				printf( '<span class="cat-links">%1$s%2$s</span>',
					sprintf( _x( '<span>Categories</span>', 'Used before category names.', 'higher-education' ) ),
					$categories_list
				);
			}

			$tags_list = get_the_tag_list();
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s%2$s</span>',
					sprintf( _x( '<span>Tags</span>', 'Used before tag names.', 'higher-education' ) ),
					$tags_list
				);
			}
		}

		echo '</p><!-- .entry-meta -->';
	}
endif; //higher_education_tag_category


if ( ! function_exists( 'higher_education_categorized_blog' ) ) :
	/**
	 * Returns true if a blog has more than 1 category
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
			// Create an array of all the categories that are attached to posts
			$all_the_cool_cats = get_categories( array(
				'hide_empty' => 1,
			) );

			// Count the number of categories that are attached to the posts
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'all_the_cool_cats', $all_the_cool_cats );
		}

		if ( '1' != $all_the_cool_cats ) {
			// This blog has more than 1 category so higher_education_categorized_blog should return true
			return true;
		} else {
			// This blog has only 1 category so higher_education_categorized_blog should return false
			return false;
		}
	}
endif; //higher_education_categorized_blog


/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Higher Education 0.1
 */
function higher_education_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'higher_education_enhanced_image_navigation', 10, 2 );


/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Higher Education 0.1
 */
function higher_education_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'footer-1' ) )
		$count++;

	if ( is_active_sidebar( 'footer-2' ) )
		$count++;

	if ( is_active_sidebar( 'footer-3' ) )
		$count++;

	if ( is_active_sidebar( 'footer-4' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}


if ( ! function_exists( 'higher_education_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$options = higher_education_get_theme_options();
		$length  = $options['excerpt_length'];
		return absint( $length );
	}
endif; //higher_education_excerpt_length
add_filter( 'excerpt_length', 'higher_education_excerpt_length' );


if ( ! function_exists( 'higher_education_continue_reading' ) ) :
	/**
	 * Returns a "Custom Continue Reading" link for excerpts
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_continue_reading( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		// Getting data from Customizer Options
		$options		=	higher_education_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return ' <span class="readmore"><a href="'. esc_url( get_permalink() ) . '">' . wp_kses_post( $more_tag_text ) . '</a></span>';
	}
endif; //higher_education_continue_reading
add_filter( 'excerpt_more', 'higher_education_continue_reading' );


if ( ! function_exists( 'higher_education_custom_excerpt' ) ) :
	/**
	 * Adds Continue Reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= higher_education_continue_reading( $output );
		}
		return $output;
	}
endif; //higher_education_custom_excerpt
add_filter( 'get_the_excerpt', 'higher_education_custom_excerpt' );


if ( ! function_exists( 'higher_education_more_link' ) ) :
	/**
	 * Replacing Continue Reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_more_link( $more_link, $more_link_text ) {
		$options		= higher_education_get_theme_options();
		$more_tag_text	= $options['excerpt_more_text'];

		return str_replace( $more_link_text, $more_tag_text, $more_link );
	}
endif; //higher_education_more_link
add_filter( 'the_content_more_link', 'higher_education_more_link', 10, 2 );


if ( ! function_exists( 'higher_education_body_classes' ) ) :
	/**
	 * Adds Higher Education layout classes to the array of body classes.
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_body_classes( $classes ) {
		$options = higher_education_get_theme_options();

		// Adds a class of group-blog to blogs with more than 1 published author
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		$layout = higher_education_get_theme_layout();

		switch ( $layout ) {
			case 'right-sidebar':
				$classes[] = 'layout-two-columns content-left';
			break;

			case 'no-sidebar':
				$classes[] = 'layout-one-column no-sidebar content-width';
			break;
		}

		if ( "" != $options['content_layout'] ) {
			$classes[] = $options['content_layout'];
		}

		if ( has_nav_menu( 'secondary' ) ) {
			$classes[] = 'has-secondary-menu';
		}

		if (   is_active_sidebar( 'footer-1'  )
			|| is_active_sidebar( 'footer-2' )
			|| is_active_sidebar( 'footer-3'  )
		    || is_active_sidebar( 'footer-4'  )
		) {
			$classes[] = 'has-footer-widgets';
		}

		if ( has_nav_menu( 'footer' ) ) {
			$classes[] = 'has-footer-menu';
		}

		$title = $options['featured_header_media_title'];
		$text  = $options['featured_header_media_text'];
		$url   = $options['featured_header_image_url'];

		if ( '' === $title && '' === $text && '' === $url ) {
			$classes[] = 'header-media-text-empty';
		}

		$classes 	= apply_filters( 'higher_education_body_classes', $classes );

		return $classes;
	}
endif; //higher_education_body_classes
add_filter( 'body_class', 'higher_education_body_classes' );


if ( ! function_exists( 'higher_education_get_theme_layout' ) ) :
	/**
	 * Returns Theme Layout prioritizing the meta box layouts
	 *
	 * @uses  get_theme_mod
	 *
	 * @action wp_head
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_get_theme_layout() {
		$id = '';

		global $post, $wp_query;

		// Front page displays in Reading Settings
		$page_on_front  = get_option('page_on_front') ;
		$page_for_posts = get_option( 'page_for_posts' );

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		// Blog Page or Front Page setting in Reading Settings
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
			$id = $page_id;
		}
		else if ( is_singular() ) {
			if ( is_attachment() ) {
				$id = $post->post_parent;
			}
			else {
				$id = $post->ID;
			}
		}

		//Get appropriate metabox value of layout
		if ( '' != $id ) {
			$layout = get_post_meta( $id, 'higher-education-layout-option', true );
		}
		else {
			$layout = 'default';
		}

		//Load options data
		$options = higher_education_get_theme_options();

		//check empty and load default
		if ( empty( $layout ) || 'default' == $layout ) {
			$layout = $options['theme_layout'];

			if ( is_singular() ) {
				$layout = $options['single_layout'];
			}
		}

		return $layout;
	}
endif; //higher_education_get_theme_layout


if ( ! function_exists( 'higher_education_archive_content_image' ) ) :
	/**
	 * Template for Featured Image in Archive Content
	 *
	 * To override this in a child theme
	 * simply create your own higher_education_archive_content_image(), and that function will be used instead.
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_archive_content_image() {
		$options        = higher_education_get_theme_options();
		$featured_image = $options['content_layout'];
		$theme_layout   = $options['theme_layout'];

		if ( 'full-content' !== $featured_image &&  has_post_thumbnail() && ! post_password_required() ) {
		?>
			<figure class="featured-image">
				<a rel="bookmark" href="<?php the_permalink(); ?>">
					<?php
						$thumbnail = 'higher-education-featured-sections';

						if ( is_sticky() && is_home() && ! is_paged() ) {
							if ( 'no-sidebar-full-width' == $theme_layout ) {
								$thunmbnail = 'full';
							} else {
								$thunmbnail = 'higher-education-featured';
							}
						}

						the_post_thumbnail( $thumbnail );
					?>
				</a>
			</figure>
		<?php
		}
	}
endif; //higher_education_archive_content_image
add_action( 'higher_education_before_entry_container', 'higher_education_archive_content_image', 10 );


if ( ! function_exists( 'higher_education_single_content_image' ) ) :
	/**
	 * Template for Featured Image in Single Post
	 *
	 * To override this in a child theme
	 * simply create your own higher_education_single_content_image(), and that function will be used instead.
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_single_content_image() {
		global $post, $wp_query;

		// Getting data from Theme Options
		$options = higher_education_get_theme_options();

		$featured_image = $options['single_post_image_layout'];

		// Get Page ID outside Loop
		$page_id = $wp_query->get_queried_object_id();

		if ( $post ) {
			if ( is_attachment() ) {
				$parent = $post->post_parent;
				$metabox_feat_img = get_post_meta( $parent,'higher-education-featured-image', true );
			} else {
				$metabox_feat_img = get_post_meta( $page_id,'higher-education-featured-image', true );
			}
		}

		if ( empty( $metabox_feat_img ) || ( !is_page() && !is_single() ) ) {
			$metabox_feat_img = 'default';
		}

		if ( 'disabled' == $metabox_feat_img  || '' == get_the_post_thumbnail() || ( 'default' == $metabox_feat_img && 'disabled' == $featured_image ) ) {
			echo '<!-- Page/Post Single Image Disabled or No Image set in Post Thumbnail -->';
			return false;
		}
		else {
			$class = '';

			if ( 'default' == $metabox_feat_img ) {
				$class = $featured_image;
			}
			else {
				$class = 'from-metabox ' . $metabox_feat_img;
				$featured_image = $metabox_feat_img;
			}

			?>
			<figure class="featured-image <?php echo esc_attr( $class ); ?>">
				<?php the_post_thumbnail( $featured_image ); ?>
			</figure>
		<?php
		}
	}
endif; //higher_education_single_content_image
add_action( 'higher_education_before_post_container', 'higher_education_single_content_image', 10 );
add_action( 'higher_education_before_page_container', 'higher_education_single_content_image', 10 );


if ( ! function_exists( 'higher_education_get_comment_section' ) ) :
	/**
	 * Comment Section
	 *
	 * @display comments_template
	 * @action higher_education_comment_section
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_get_comment_section() {
		if ( comments_open() || '0' != get_comments_number() ) {
			comments_template();
		}
	}
endif;
add_action( 'higher_education_comment_section', 'higher_education_get_comment_section', 10 );

if ( ! function_exists( 'higher_education_comment_defaults' ) ) :
	/**
	 * Modify Comment Form Defaults
	 *
	 * @uses comment_form_defaults filter
	 * @since Higher Education Pro 1.0
	 */
	function higher_education_comment_defaults( $defaults ) {
		$req           = get_option( 'require_name_email' );
		$required_text =  $req ? '&nbsp;*' : '';
		$aria_req      = $req ? " aria-required='true'" : '';

		$defaults['comment_field'] = '<p class="comment-form-comment"><textarea placeholder="' . esc_html__( 'Comment', 'higher-education' ) . $required_text . '" id="comment" name="comment" cols="45" rows="8"' . $aria_req . '""></textarea></p>';

		return $defaults;
	}
endif; //higher_education_comment_defaults
add_filter( 'comment_form_defaults', 'higher_education_comment_defaults' );


if ( ! function_exists( 'higher_education_comment_form_fields' ) ) :
	/**
	 * Modify Comment Form Fields
	 *
	 * @uses comment_form_default_fields filter
	 * @since Higher Education Pro 1.0
	 */
	function higher_education_comment_form_fields( $fields ) {
		$commenter     = wp_get_current_commenter();
		$req           = get_option( 'require_name_email' );
		$required_text =  $req ? '&nbsp;*' : '';
		$aria_req      = $req ? " aria-required='true'" : '';

		$fields['author'] = '<p class="comment-form-author"><input placeholder="' . esc_html__( 'Name', 'higher-education' ) . '&nbsp' . $required_text . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';

		$fields['email'] = '<p class="comment-form-email"><input placeholder="' . esc_html__( 'Email', 'higher-education' ) . '&nbsp' . $required_text . '" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';

		$fields['url'] = '<p class="comment-form-url"><input placeholder="' . esc_html__( 'Website', 'higher-education' ) . '" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

		return $fields;
	}
endif; //higher_education_comment_form_fields
add_filter( 'comment_form_default_fields', 'higher_education_comment_form_fields' );

if ( ! function_exists( 'higher_education_move_comment_field_to_bottom' ) ) :
	/**
	 * Move Comments field below Name, Email and Website Fields
	 *
	 * @uses comment_form_fields filter
	 * @since Higher Education Pro 1.0
	 */
	function higher_education_move_comment_field_to_bottom( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}
endif; //higher_education_comment_form_fields
add_filter( 'comment_form_fields', 'higher_education_move_comment_field_to_bottom' );

/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action higher_education_footer
 *
 * @since Higher Education 0.1
 */
function higher_education_footer_content() {
	//higher_education_flush_transients();
	if ( ! $output = get_transient( 'higher_education_footer_content' ) ) {
		$theme_data = wp_get_theme();
		$output .= '
			<div id="site-generator" class="site-info two">
				<div class="wrapper">
					<div id="footer-left-content" class="copyright">' . sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL 3: Privacy Policy Link', 'higher-education' ), esc_attr( date_i18n( __( 'Y', 'higher-education' ) ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>', get_the_privacy_policy_link() ) . '</div>

					<div id="footer-right-content" class="powered">' . esc_html__( 'Theme', 'higher-education') . ': ' .  '<a target="_blank" href="'. esc_url( $theme_data->get( 'ThemeURI' ) ) .'">'. esc_attr( $theme_data->get( 'Name' ) ) .'</a>' . '</div>
				</div><!-- .wrapper -->
			</div><!-- #site-generator -->';

		set_transient( 'higher_education_footer_content', $output, 86940 );
	}

	echo $output;
}
add_action( 'higher_education_footer', 'higher_education_footer_content', 100 );


/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Higher Education 0.1
 */

function higher_education_get_first_image( $postID, $size, $attr ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field('post_content', $postID ) , $matches);

	if ( isset( $matches [1] [0] ) ) {
		//Get first image
		$first_img = $matches [1] [0];

		return '<img class="wp-post-image" src="'. esc_url( $first_img ) .'">';
	}
	else {
		return false;
	}
}


if ( ! function_exists( 'higher_education_scrollup' ) ) {
	/**
	 * This function loads Scroll Up Navigation
	 *
	 * @action higher_education_footer action
	 * @uses set_transient and delete_transient
	 */
	function higher_education_scrollup() {
		//higher_education_flush_transients();
		if ( !$scrollup = get_transient( 'higher_education_scrollup' ) ) {

			// get the data value from theme options
			$options = higher_education_get_theme_options();
			echo '<!-- refreshing cache -->';

			//site stats, analytics header code
			if ( ! $options['disable_scrollup'] ) {
				$scrollup =  '<a href="#masthead" id="scrollup" class="scroll-to-top fa fa-angle-up" aria-hidden="true">
				<span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'higher-education' ) . '</span>
				<span class="backtotop">' . esc_html__( 'Top', 'higher-education' ) . '</span>
				</a>' ;
			}

			set_transient( 'higher_education_scrollup', $scrollup, 86940 );
		}
		echo $scrollup;
	}
}
add_action( 'higher_education_after', 'higher_education_scrollup', 10 );


if ( ! function_exists( 'higher_education_page_post_meta' ) ) :
	/**
	 * Post/Page Meta for Google Structure Data
	 */
	function higher_education_page_post_meta() {
		$author_url = esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) );

		$output = '<span class="post-author">' . esc_html__( 'By', 'higher-education' ) . ' <span class="author vcard"><a class="url fn n" href="' . esc_url( $author_url ) . '" title="' . esc_attr__( 'View all posts by ', 'higher-education' ) . esc_attr( get_the_author() ) . '" rel="author">' . get_the_author() . '</a></span>';
		$output .= '&nbsp;/&nbsp;<span class="post-time screen-reader-text">' . esc_html__( 'Posted on', 'higher-education' ) . '</span><a href="' . esc_url( get_permalink() ) . '"<time class="entry-date updated published" datetime="' . esc_attr( get_the_date( 'c' ) ) . '" pubdate>' . esc_html( get_the_date() ) . '</time></a>';

		return $output;
	}
endif; //higher_education_page_post_meta


if ( ! function_exists( 'higher_education_alter_home' ) ) :
	/**
	 * Alter the query for the main loop in homepage
	 *
	 * @action pre_get_posts action
	 */
	function higher_education_alter_home( $query ){
		if ( $query->is_main_query() && $query->is_home() ) {
			$options   = higher_education_get_theme_options();
			$cats      = $options['front_page_category'];

			if ( is_array( $cats  ) && !in_array( '0', $cats  ) ) {
				$cats = (array) $cats ;
				if ( defined( "ICL_LANGUAGE_CODE" ) ) {
					$category = array();
					foreach( $cats as $cat ){
						$category[] = apply_filters( 'wpml_object_id', $cat, 'category', true );
					}
					$cats = $category;
				}
			} else{
				$cats = '0';
			}

			if ( is_array( $cats ) && !in_array( '0', $cats ) ) {
				$query->query_vars['category__in'] = $cats;
			}
		}
	}
endif; //higher_education_alter_home
add_action( 'pre_get_posts','higher_education_alter_home' );


if ( ! function_exists( 'higher_education_post_navigation' ) ) :
	/**
	 * Displays Single post Navigation
	 *
	 * @uses  the_post_navigation
	 *
	 * @action higher_education_after_post
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_post_navigation() {
		// Previous/next post navigation.
		if ( function_exists( 'the_post_navigation' ) ) {
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next &rarr;', 'higher-education' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'higher-education' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( '&larr; Previous', 'higher-education' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'higher-education' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
		}
		else {
			// Don't print empty markup if there's nowhere to navigate.
			$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
			?>
			<nav class="navigation post-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'higher-education' ); ?></h2>
				<div class="nav-links">
					<?php
						previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
						next_post_link( '<div class="nav-next">%link</div>', '%title' );
					?>
				</div><!-- .nav-links -->
			</nav><!-- .navigation -->
		<?php
		}
	}
endif; //higher_education_post_navigation
add_action( 'higher_education_after_post', 'higher_education_post_navigation', 10 );


/**
 * Display Multiple Select type for and array of categories
 *
 * @param  [string] $name  [field name]
 * @param  [string] $id    [field_id]
 * @param  [array] $selected    [selected values]
 * @param  string $label [label of the field]
 */
function higher_education_dropdown_categories( $name, $id, $selected, $label = '' ) {
	$dropdown = wp_dropdown_categories(
		array(
			'name'             => $name,
			'echo'             => 0,
			'hide_empty'       => false,
			'show_option_none' => false,
			'hierarchical'       => 1,
		)
	);

	if ( '' != $label ) {
		echo '<label for="' . $id . '">
			'. $label .'
			</label>';
	}

	$dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:120px; width: 100%" ', $dropdown );

	foreach( $selected as $selected ) {
		$dropdown = str_replace( 'value="'. $selected .'"', 'value="'. $selected .'" selected="selected"', $dropdown );
	}

	echo $dropdown;

	echo '<span class="description">'. esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'higher-education' ) . '</span>';
}


/**
 * Return registered image sizes.
 *
 * Return a two-dimensional array of just the additionally registered image sizes, with width, height and crop sub-keys.
 *
 * @since 0.1.7
 *
 * @global array $_wp_additional_image_sizes Additionally registered image sizes.
 *
 * @return array Two-dimensional, with width, height and crop sub-keys.
 */
function higher_education_get_additional_image_sizes() {
	global $_wp_additional_image_sizes;

	if ( $_wp_additional_image_sizes )
		return $_wp_additional_image_sizes;

	return array();
}


if ( ! function_exists( 'higher_education_get_meta' ) ) :
	/**
	 * Returns HTML with meta information for the categories, tags, date and author.
	 *
	 * @param [boolean] $hide_category Adds screen-reader-text class to category meta if true
	 * @param [boolean] $hide_tags Adds screen-reader-text class to tag meta if true
	 * @param [boolean] $hide_posted_by Adds screen-reader-text class to date meta if true
	 * @param [boolean] $hide_author Adds screen-reader-text class to author meta if true
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_get_meta( $hide_category = false, $hide_tags = false, $hide_posted_by = false, $hide_author = false ) {
		$output = '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {

			$class = $hide_category ? 'screen-reader-text' : '';

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'higher-education' ) );
			if ( $categories_list && higher_education_categorized_blog() ) {
				$output .= sprintf( '<span class="cat-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'higher-education' ) ),
					$categories_list
				);
			}

			$class = $hide_tags ? 'screen-reader-text' : '';

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'higher-education' ) );
			if ( $tags_list ) {
				$output .= sprintf( '<span class="tags-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'higher-education' ) ),
					$tags_list
				);
			}

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$class = $hide_posted_by ? 'screen-reader-text' : '';

			$output .= sprintf( '<span class="posted-on ' . $class . '">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
				sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'higher-education' ) ),
				esc_url( get_permalink() ),
				$time_string
			);

			if ( is_singular() || is_multi_author() ) {
				$class = $hide_author ? 'screen-reader-text' : '';

				$output .= sprintf( '<span class="byline ' . $class . '"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
					sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'higher-education' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
			}
		}

		$output .= '</p><!-- .entry-meta -->';

		return $output;
	}
endif; //higher_education_get_meta


/**
 * Generate a list of all available post array
 * @param  $post_type
 * @return post_array
 */
function higher_education_generate_post_array( $post_type ) {
	$output = array();
	$posts = get_posts( array(
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'suppress_filters' => false,
		'posts_per_page'   =>-1,
		)
	);

	foreach ( $posts as $post ) {
		$output[$post->ID] = $post->post_title;
	}

	return $output;
}


/**
 * Converts a HEX value to RGB.
 *
 * @since Higher Education 0.1
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function higher_education_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$red   = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$green = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$blue  = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$red   = hexdec( substr( $color, 0, 2 ) );
		$green = hexdec( substr( $color, 2, 2 ) );
		$blue  = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $red, 'green' => $green, 'blue' => $blue );
}


if ( ! function_exists( 'higher_education_get_highlight_meta' ) ) :
	/**
	 * Returns HTML with meta information for the categories, tags, date and author.
	 *
	 * @param [boolean] $hide_category Adds screen-reader-text class to category meta if true
	 * @param [boolean] $hide_tags Adds screen-reader-text class to tag meta if true
	 * @param [boolean] $hide_posted_by Adds screen-reader-text class to date meta if true
	 * @param [boolean] $hide_author Adds screen-reader-text class to author meta if true
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_get_highlight_meta( $hide_category = false, $hide_tags = false, $hide_posted_by = false, $hide_author = false ) {
		$output = '<p class="entry-meta">';

		if ( 'post' == get_post_type() ) {

			$class = $hide_category ? 'screen-reader-text' : '';

			$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'higher-education' ) );
			if ( $categories_list && higher_education_categorized_blog() ) {
				$output .= sprintf( '<span class="cat-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Categories</span>', 'Used before category names.', 'higher-education' ) ),
					$categories_list
				);
			}

			$class = $hide_tags ? 'screen-reader-text' : '';

			$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'higher-education' ) );
			if ( $tags_list ) {
				$output .= sprintf( '<span class="tags-links ' . $class . '">%1$s%2$s</span>',
					sprintf( _x( '<span class="screen-reader-text">Tags</span>', 'Used before tag names.', 'higher-education' ) ),
					$tags_list
				);
			}

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$class = $hide_posted_by ? 'screen-reader-text' : '';

			$output .= sprintf( '<span class="posted-on ' . $class . '">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
				sprintf( _x( '<span class="screen-reader-text">Posted on</span>', 'Used before publish date.', 'higher-education' ) ),
				esc_url( get_permalink() ),
				$time_string
			);

			if ( is_singular() || is_multi_author() ) {
				$class = $hide_author ? 'screen-reader-text' : '';

				$output .= sprintf( '<span class="byline ' . $class . '"><span class="author vcard">%1$s<a class="url fn n" href="%2$s">%3$s</a></span></span>',
					sprintf( _x( '<span class="screen-reader-text">Author</span>', 'Used before post author name.', 'higher-education' ) ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
			}
		}

		$output .= '</p><!-- .entry-meta -->';

		return $output;
	}
endif; //higher_education_get_highlight_meta

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Higher Education 0.1
 *
 * @see higher_education_header_style()
 */
function higher_education_custom_header_and_background() {
	/**
	 * Filter the arguments used when adding 'custom-background' support in Higher Education Pro.
	 *
	 * @since Higher Education Pro 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'higher_education_custom_background_args', array(
		'default-color' => '#f5f5f5',
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Higher Education Pro.
	 *
	 * @since Higher Education Pro 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'higher_education_custom_header_args', array(
		'default-image'      => get_parent_theme_file_uri( '/images/header-image.jpg' ),
		'default-text-color' => '#111111',
		'width'              => 1400,
		'height'             => 640,
		'flex-height'        => true,
		'flex-width'         => true,
		'wp-head-callback'   => 'higher_education_header_style',
		'video'              => true
	) ) );

	register_default_headers( array(
	'default-image' => array(
		'url'           => '%s/assets/images/header-image.jpg',
		'thumbnail_url' => '%s/assets/images/header-image.jpg',
		'description'   => esc_html__( 'Default Header Image', 'higher-education' ),
		),
	) );
}
add_action( 'after_setup_theme', 'higher_education_custom_header_and_background' );

if ( ! function_exists( 'higher_education_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own higher_education_header_style() function to override in a child theme.
 *
 * @since Higher Education Pro 1.0
 *
 * @see higher_education_custom_header_and_background().
 */
function higher_education_header_style() {
	// If the header text option is untouched, let's bail.
	if ( ! display_header_text() ) {
		?>
		<style type="text/css" id="higher_education-header-css">
			.site-branding {
				margin: 0 auto 0 0;
			}

			.site-branding .site-title,
			.site-description {
				clip: rect(1px, 1px, 1px, 1px);
				position: absolute;
			}
		</style>
		<?php
	}

	if ( get_theme_support( 'custom-header', 'default-text-color' ) !== get_header_textcolor() ) {
		?>
		<style type="text/css">
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( get_header_textcolor() ); ?> !important;
			}
		</style>
		<?php
	}
}
endif; // higher_education_header_style

/**
 * Default Options.
 */
require trailingslashit( get_template_directory() ) . 'inc/default-options.php';

/**
 * Custom Header.
 */
require trailingslashit( get_template_directory() ) . 'inc/custom-header.php';


/**
 * Structure for Higher Education
 */
require trailingslashit( get_template_directory() ) . 'inc/structure.php';


/**
 * Menus for Higher Education
 */
require trailingslashit( get_template_directory() ) . 'inc/menus.php';


/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer-includes/customizer.php';

/**
 * Load Slider file.
 */
require trailingslashit( get_template_directory() ) . 'inc/featured-slider.php';

/**
 * Load Featured Content.
 */
require trailingslashit( get_template_directory() ) . 'inc/featured-content.php';

/**
 * Load Courses.
 */
require trailingslashit( get_template_directory() ) . 'inc/courses.php';

/**
 * Load Testimonials.
 */
require trailingslashit( get_template_directory() ) . 'inc/testimonial.php';

/**
 * Load Hero Content.
 */
require trailingslashit( get_template_directory() ) . 'inc/hero-content.php';

/**
 * Load Logo Slider.
 */
require trailingslashit( get_template_directory() ) . 'inc/logo-slider.php';

/**
 * Load Portfolio.
 */
require trailingslashit( get_template_directory() ) . 'inc/portfolio.php';

/**
 * Load Promotion Headline
 */
require trailingslashit( get_template_directory() ) . 'inc/promotion-headline.php';

/**
 * Load News.
 */
require trailingslashit( get_template_directory() ) . 'inc/news.php';

/**
 * Load Events.
 */
require trailingslashit( get_template_directory() ) . 'inc/events.php';

/**
 * Load Our Professors
 */
require trailingslashit( get_template_directory() ) . 'inc/our-professors.php';

/**
 * Load Breadcrumb file.
 */
require trailingslashit( get_template_directory() ) . 'inc/breadcrumb.php';

/**
 * Load Testimonial.
 */
require trailingslashit( get_template_directory() ) . 'inc/testimonial.php';

/**
 * Load Logo Slider.
 */
require trailingslashit( get_template_directory() ) . 'inc/logo-slider.php';

/**
 * Load Widgets and Sidebars
 */
require trailingslashit( get_template_directory() ) . 'inc/widgets/widgets.php';

/**
 * Load Social Icons
 */
require trailingslashit( get_template_directory() ) . 'inc/social-icons.php';

/**
 * Load Metaboxes
 */
require trailingslashit( get_template_directory() ) . 'inc/metabox.php';
