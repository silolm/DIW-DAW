<?php
/**
 * The default template for displaying header
 *
 * @package Higher_Education
 */

	/**
	 * higher_education_doctype hook
	 *
	 * @hooked higher_education_doctype -  10
	 *
	 */
	do_action( 'higher_education_doctype' );?>

<head>
<?php
	/**
	 * higher_education_before_wp_head hook
	 *
	 * @hooked higher_education_head -  10
	 *
	 */
	do_action( 'higher_education_before_wp_head' );

	wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' );  ?>

<?php
	/**
     * higher_education_before_header hook
     *
     */
    do_action( 'higher_education_before' );

	/**
	 * higher_education_header hook
	 *
	 * @hooked higher_education_page_start -  10
	 * @hooked higher_education_header_start- 20
	 * @hooked higher_education_mobile_header_nav_anchor - 30
	 * @hooked higher_education_mobile_secondary_nav_anchor - 40
	 * @hooked higher_education_site_branding - 50
	 * @hooked higher_education_primary_menu - 60
	 * @hooked higher_education_header_end - 100
	 *
	 */
	do_action( 'higher_education_header' );

	/**
     * higher_education_after_header hook
     *
	 * @hooked higher_education_add_breadcrumb - 30
	 * @hooked higher_education_featured_overall_image - 60
     */
	do_action( 'higher_education_after_header' );

	/**
	 * higher_education_before_content hook
	 *
	 * @hooked higher_education_featured_slider - 10
	 * @hooked higher_education_hero_content_display - 20
	 * @hooked higher_education_featured_content_display (move featured content above homepage posts - default option) - 30
	 * @hooked higher_education_promotion_headline - 40
	 * @hooked higher_education_portfolio_display - 50
	 * @hooked higher_education_logo_slider - 60
	 * @hooked higher_education_courses_display (move courses above homepage posts - default option) - 70
	 * @hooked higher_education_our_professors_display - 80
	 * @hooked higher_education_testimonial_display - 90
	 * @hooked higher_education_events_display - 100
	 * @hooked higher_education_news_display - 110
	 */
	do_action( 'higher_education_before_content' );

	/**
     * higher_education_content hook
     *
     *  @hooked higher_education_content_start - 10
     *  @hooked higher_education_content_sidebar_wrap_start - 40
     *
     */
	do_action( 'higher_education_content' );