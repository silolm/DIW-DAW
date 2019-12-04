<?php
/**
 * The template for Menus
 *
 * @package Higher_Education
 */


if ( ! function_exists( 'higher_education_primary_menu' ) ) :
	/**
	 * Shows Primary Menu
	 *
	 * @since Higher Education 0.1
	 */
	function higher_education_primary_menu() {
		?>
		<button id="menu-toggle-primary" class="menu-toggle"><span class="menu-label"><?php esc_html_e( 'Menu', 'higher-education' ); ?></span></button>

		<div id="site-header-menu-primary" class="site-header-menu">
			<nav id="site-navigation-primary" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'higher-education' ); ?>">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Primary menu', 'higher-education' ); ?></h3>
				<?php
					if ( has_nav_menu( 'primary' ) ) {
						$args = array(
							'theme_location'    => 'primary',
							'menu_class'        => 'menu primary-menu',
							'container'         => false
						);
						wp_nav_menu( $args );
					}
					else {
						wp_page_menu( array( 'menu_class'  => 'default-page-menu' ) );
					}
				?>
			</nav><!-- .main-navigation -->

			<div class="mobile-social-search">
				<nav id="social-navigation" class="social-navigation" role="navigation" aria-label="Social Links Menu" aria-expanded="false">
					<button id="search-toggle" class="toggle-top"><span class="search-label screen-reader-text"><?php esc_html_e( 'Search', 'higher-education' ); ?></span></button>

					<div class="search-container"><?php get_search_form(); ?></div>

					<?php $social_icons = higher_education_get_social_icons();

					if ( $social_icons ) :
					?>

					<button id="share-toggle" class="toggle-top"><span class="search-label screen-reader-text"><?php esc_html_e( 'Social Menu', 'higher-education' ); ?></span></button>

					<div class="menu-social-container"><?php echo $social_icons; // WPCS ok. ?></div>
					<?php endif; ?>
				</nav><!-- .social-navigation -->
			</div><!-- .mobile-social-search -->
		</div><!-- .site-header-menu -->
	<?php
	}
endif;
add_action( 'higher_education_header', 'higher_education_primary_menu', 60 );



/**
 * Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
 *
 * @since Higher Education 0.1
 */
function higher_education_add_menuclass( $ulclass ) {
  return preg_replace( '/<ul>/', '<ul id="wp-page-menu" class="menu primary-menu">', $ulclass, 1 );
}
add_filter( 'wp_page_menu', 'higher_education_add_menuclass', 90 );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since Higher Education 0.1
 */
function higher_education_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'higher_education_page_menu_args' );

if ( ! function_exists( 'higher_education_footer_menu_wrapper_start' ) ) :
	/**
	 * Start Footer Menu Wrapper
	 */
	function higher_education_footer_menu_wrapper_start() {
		$class = "footer-menu-wrapper one";

		if ( has_nav_menu( 'footer' ) ) {
			$class = "footer-menu-wrapper two";
		} else {

		}
		echo '<div class="' . $class . '">';
	}
endif; //higher_education_footer_menu_wrapper_start
add_action( 'higher_education_footer', 'higher_education_footer_menu_wrapper_start', 30 );


if ( ! function_exists( 'higher_education_footer_menu' ) ) :
	/**
	 * Shows the Footer Menu
	 */
	function higher_education_footer_menu() {
		if ( has_nav_menu( 'footer' ) ) {
		?>
		<nav class="nav-footer" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'higher-education' ); ?>">
			<h3 class="screen-reader-text"><?php esc_html_e( 'Footer menu', 'higher-education' ); ?></h3>
			<?php
				$args = array(
					'theme_location' => 'footer',
					'menu_class'     => 'footer-menu',
					'depth'          => 1
				);
				wp_nav_menu( $args );
			?>
		</nav><!-- .nav-footer -->
	<?php
		}
	}
endif; //higher_education_footer_menu
add_action( 'higher_education_footer', 'higher_education_footer_menu', 40 );


if ( ! function_exists( 'higher_education_footer_social' ) ) :
	/**
	 * Shows the Footer Menu
	 *
	 * default load in sidebar-header-right.php
	 */
	function higher_education_footer_social() {
		echo '<div id="footer-social">' . higher_education_get_social_icons() . '</div><!-- #footer-social -->';
	}
	endif; //higher_education_footer_social
add_action( 'higher_education_footer', 'higher_education_footer_social', 50 );


if ( ! function_exists( 'higher_education_footer_menu_wrapper_end' ) ) :
	/**
	 * End Footer Menu Wrapper
	 */
	function higher_education_footer_menu_wrapper_end() {
		echo '</div><!-- .footer-menu-wrapper -->';
	}
endif; //higher_education_footer_menu_wrapper_end
add_action( 'higher_education_footer', 'higher_education_footer_menu_wrapper_end', 60 );
