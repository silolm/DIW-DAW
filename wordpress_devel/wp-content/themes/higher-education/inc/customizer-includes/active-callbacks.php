<?php
/**
 * Active callbacks for Theme/Customzer Options
 *
 * @package Higher_Education
 */


if ( ! function_exists( 'higher_education_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Higher Education 0.1
	*/
	function higher_education_is_slider_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[featured_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;


if ( ! function_exists( 'higher_education_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_featured_content_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[featured_content_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_courses_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_courses_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[courses_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_hero_content_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[hero_content_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_logo_slider_active' ) ) :
	/**
	* Return true if logo_slider is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_logo_slider_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[logo_slider_option]' )->value();

		//return true only if previwed page on customizer matches the type of logo_slider option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_news_active' ) ) :
	/**
	* Return true if news is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_news_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[news_option]' )->value();

		//return true only if previwed page on customizer matches the type of news option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_events_active' ) ) :
	/**
	* Return true if events is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_events_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[events_option]' )->value();

		//return true only if previwed page on customizer matches the type of events option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_our_professors_active' ) ) :
	/**
	* Return true if our professors is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_our_professors_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[our_professors_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_promotion_headline_active' ) ) :
	/**
	* Return true if our professors is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_promotion_headline_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[promotion_headline_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_testimonial_active' ) ) :
	/**
	* Return true if testimonial is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_testimonial_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[testimonial_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio is active
	*
	* @since  Higher Education 0.1
	*/
	function higher_education_is_portfolio_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'higher_education_theme_options[portfolio_option]' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable ) );
	}
endif;

if ( ! function_exists( 'higher_education_is_ect_testimonial_active' ) ) :
    /**
    * Return true if testimonial plugin is active
    *
    * @since Higher Education 0.1
    */
    function higher_education_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Testimonial' ) || class_exists( 'JetPack' ) || class_exists( 'Essential_Content_Pro_Jetpack_Testimonial' ) );
    }
endif;

if ( ! function_exists( 'higher_education_is_ect_testimonial_inactive' ) ) :
    /**
    * Return true if testimonial plugin is inactive
    *
    * @since Higher Education 0.1
    */
    function higher_education_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Testimonial' ) || class_exists( 'JetPack' ) || class_exists( 'Essential_Content_Pro_Jetpack_Testimonial' ) );
    }
endif;

if ( ! function_exists( 'higher_education_is_ect_portfolio_active' ) ) :
    /**
    * Return true if portfolio is active
    *
    * @since Higher Education 0.1
    */
    function higher_education_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'JetPack' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'higher_education_is_ect_portfolio_inactive' ) ) :
    /**
    * Return true if portfolio is active
    *
    * @since Higher Education 0.1
    */
    function higher_education_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'JetPack' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;
