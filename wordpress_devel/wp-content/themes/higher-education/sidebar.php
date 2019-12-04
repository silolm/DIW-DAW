<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Higher_Education
 */

/**
 * Set higher_education_before_secondary hook
 */
do_action( 'higher_education_before_secondary' );

$higher_education_layout = higher_education_get_theme_layout();

// Bail early if no sidebar layout is selected.
if ( 'no-sidebar' == $higher_education_layout || 'no-sidebar-one-column' == $higher_education_layout || 'no-sidebar-full-width' == $higher_education_layout ) {
	return;
}

do_action( 'higher_education_before_primary_sidebar' );
?>
	<aside class="sidebar sidebar-primary widget-area" role="complementary">
		<?php
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' );
		} else {
			// Helper Text.
			if ( current_user_can( 'edit_theme_options' ) ) { ?>
				<section id="widget-default-text" class="widget widget_text">
					<div class="widget-wrap">
	        			<h4 class="widget-title"><?php esc_html_e( 'Primary Sidebar Widget Area', 'higher-education' ); ?></h4>

	   					<div class="textwidget">
	           				<p><?php esc_html_e( 'This is the Primary Sidebar Widget Area if you are using a two column site layout option.', 'higher-education' ); ?></p>
	           				<p><?php printf( __( 'By default it will load Search and Archives widgets as shown below. You can add widget to this area by visiting your %1$s Widgets Panel%2$s which will replace default widgets.', 'higher-education' ), '<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">', '</a>' ); ?></p>
	         			</div>
	   				</div><!-- .widget-wrap -->
	       		</section><!-- #widget-default-text -->
			<?php
			} ?>
			<section class="widget widget_search" id="default-search">
				<div class="widget-wrap">
					<?php get_search_form(); ?>
				</div><!-- .widget-wrap -->
			</section><!-- #default-search -->
			<section class="widget widget_archive" id="default-archives">
				<div class="widget-wrap">
					<h4 class="widget-title"><?php esc_html_e( 'Archives', 'higher-education' ); ?></h4>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</div><!-- .widget-wrap -->
			</section><!-- #default-archives -->
			<?php
		}
	?>
	</aside><!-- .sidebar sidebar-primary widget-area -->
<?php
/**
 * Set higher_education_after_secondary hook
 */
do_action( 'higher_education_after_secondary' );