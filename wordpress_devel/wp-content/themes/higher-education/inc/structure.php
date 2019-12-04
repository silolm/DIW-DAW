<?php
/**
 * The template for Managing Theme Structure
 *
 * @package Higher_Education
 */

if ( ! function_exists( 'higher_education_doctype' ) ) :
    /**
     * Doctype Declaration
     *
     * @since Higher Education 0.1
     *
     */
    function higher_education_doctype() {
        ?>
        <!DOCTYPE html>
        <html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action( 'higher_education_doctype', 'higher_education_doctype', 10 );


if ( ! function_exists( 'higher_education_head' ) ) :
    /**
     * Header Codes
     *
     * @since Higher Education 0.1
     *
     */
    function higher_education_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php
    }
endif;
add_action( 'higher_education_before_wp_head', 'higher_education_head', 10 );


if ( ! function_exists( 'higher_education_doctype_start' ) ) :
    /**
     * Start div id #page
     *
     * @since Higher Education 0.1
     *
     */
    function higher_education_page_start() {
        ?>
        <div id="page" class="hfeed site">
            <div class="site-inner">
        <?php
    }
endif;
add_action( 'higher_education_header', 'higher_education_page_start', 10 );


if ( ! function_exists( 'higher_education_page_end' ) ) :
    /**
     * End div id #page
     *
     * @since Higher Education 0.1
     *
     */
    function higher_education_page_end() {
        ?>
            </div><!-- .site-inner -->
        </div><!-- #page -->
        <?php
    }
endif;
add_action( 'higher_education_footer', 'higher_education_page_end', 200 );


if ( ! function_exists( 'higher_education_header_start' ) ) :
    /**
     * Start Header id #masthead and class .wrapper
     *
     * @since Higher Education 0.1
     *
     */
    function higher_education_header_start() {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'higher-education' ); ?></a>

        <header id="masthead" class="site-header" role="banner">
            <div class="wrapper site-header-main">
        <?php
    }
endif;
add_action( 'higher_education_header', 'higher_education_header_start', 20 );


if ( ! function_exists( 'higher_education_header_end' ) ) :
    /**
     * End Header id #masthead and class .wrapper
     *
     * @since Higher Education 0.1
     *
     */
    function higher_education_header_end() {
        ?>
            </div><!-- .wrapper -->
        </header><!-- #masthead -->
        <?php
    }
endif;
add_action( 'higher_education_header', 'higher_education_header_end', 100 );


if ( ! function_exists( 'higher_education_archive_header' ) ) :
    /**
     * Add archive header
     *
     * @since Higher Education Pro 1.0
     *
     */
    function higher_education_archive_header() {
        if ( ! is_archive() ) {
            return;
        }
        ?>
        <header class="page-header">
            <div class="wrapper">
                <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description();
                ?>
            </div><!-- .wrapper -->
        </header><!-- .page-header -->
        <?php
    }
endif;
add_action( 'higher_education_content', 'higher_education_archive_header', 10 );


if ( ! function_exists( 'higher_education_content_start' ) ) :
    /**
     * Start div id #content and class .wrapper
     *
     * @since Higher Education Pro 1.0
     *
     */
    function higher_education_content_start() {
        ?>
        <div id="content" class="site-content">
            <div class="wrapper">
    <?php
    }
endif;
add_action( 'higher_education_content', 'higher_education_content_start', 20 );

if ( ! function_exists( 'higher_education_content_end' ) ) :
    /**
     * End div id #content and class .wrapper
     *
     * @since Higher Education Pro 1.0
     */
    function higher_education_content_end() {
        ?>
            </div><!-- .wrapper -->
        </div><!-- #content -->
        <?php
    }
endif;
add_action( 'higher_education_after_content', 'higher_education_content_end', 30 );


if ( ! function_exists( 'higher_education_footer_content_start' ) ) :
    /**
     * Start footer id #colophon
     *
     * @since Higher Education 0.1
     */
    function higher_education_footer_content_start() {
        ?>
        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="wrapper">
        <?php
    }
endif;
add_action( 'higher_education_footer', 'higher_education_footer_content_start', 10 );


if ( ! function_exists( 'higher_education_footer_sidebar' ) ) :
    /**
     * Footer Sidebar
     *
     * @since Higher Education 0.1
     */
    function higher_education_footer_sidebar() {
        get_sidebar( 'footer' );
    }
endif;
add_action( 'higher_education_footer', 'higher_education_footer_sidebar', 20 );


if ( ! function_exists( 'higher_education_footer_content_end' ) ) :
    /**
     * End footer id #colophon
     *
     * @since Higher Education 0.1
     */
    function higher_education_footer_content_end() {
        ?>
            </div><!-- .wrapper -->
        </footer><!-- #colophon -->
        <?php
    }
endif;
add_action( 'higher_education_footer', 'higher_education_footer_content_end', 110 );