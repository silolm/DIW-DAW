<?php
/**
 * The template for displaying the footer
 *
 * @package Higher_Education
 */
?>

<?php
    /**
     * higher_education_after_content hook
     *
     * @hooked higher_education_content_sidebar_wrap_end - 10
     * @hooked higher_education_content_end - 30
     * @hooked higher_education_featured_content_display (move below homepage posts) - 40
     * @hooked higher_education_courses_display (move below homepage posts) - 50
     * @hooked higher_education_our_professors_display (move below homepage posts) - 60
     * @hooked higher_education_testimonial_display (move below homepage posts) - 70
     * @hooked higher_education_events_display (move below homepage posts) - 80
     * @hooked higher_education_news_display (move below homepage posts) - 90
     *
     */
    do_action( 'higher_education_after_content' );
?>

<?php
    /**
     * higher_education_footer hook
     *
     * @hooked higher_education_footer_content_start - 10
     * @hooked higher_education_footer_sidebar - 20
     * @hooked higher_education_footer_menu_wrapper_start - 30
     * @hooked higher_education_footer_menu - 40
     * @hooked higher_education_footer_social - 50
     * @hooked higher_education_footer_menu_wrapper_end - 60
     * @hooked higher_education_get_footer_content - 100
     * @hooked higher_education_footer_content_end - 110
     * @hooked higher_education_page_end - 200
     *
     */
    do_action( 'higher_education_footer' );
?>

<?php
/**
 * higher_education_after hook
 *
 * @hooked higher_education_scrollup - 10
 *
 */
do_action( 'higher_education_after' );?>

<?php wp_footer(); ?>

</body>
</html>