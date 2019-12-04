<?php
/**
 * Add Custom Sidebars and Widgets
 *
 * @package Higher_Education
 */

/**
 * Register widgetized area
 *
 * @since Higher Education 0.1
 */
function higher_education_widgets_init() {
	//Primary Sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'higher-education' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		'description'	=> esc_html__( 'This is the primary sidebar if you are using a two column site layout option.', 'higher-education' ),
	) );

	$footer_no = 3; //Number of footer sidebars

	for( $i=1; $i <= $footer_no; $i++ ) {
		register_sidebar( array(
			'name'          => sprintf( esc_html__( 'Footer Area %d', 'higher-education' ), $i ),
			'id'            => sprintf( 'footer-%d', $i ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => '</div><!-- .widget-wrap --></section><!-- .widget -->',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			'description'	=> sprintf( esc_html__( 'Footer %d widget area.', 'higher-education' ), $i ),
		) );
	}
}
add_action( 'widgets_init', 'higher_education_widgets_init' );

// // Load Social Icon Widget
include trailingslashit( get_template_directory() ) . 'inc/widgets/social-icons.php';