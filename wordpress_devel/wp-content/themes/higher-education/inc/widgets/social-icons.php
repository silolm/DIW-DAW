<?php
/**
 * Social Icons Widget
 *
 * @package Higher_Education
 */


/**
 * Adds higher_educationSocialIcons widget.
 *
 * @since Higher Education 0.1
 */
class Higher_Education_Social_Icons_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'higher_education_social_icons', // Base ID
			esc_html__( 'CT: Social Icons', 'higher-education' ), // Name
			array( 'description' => esc_html__( 'Use this widget to add Social Icons Menu as a widget. ', 'higher-education' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		echo higher_education_get_social_icons();

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = '';

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		}
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"><?php esc_html_e( 'Title (optional):', 'higher-education' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		return $instance;
	}
}

/**
 * Register Social Icon Widget
 *
 * @since Higher Education 0.1
 */
function higher_education_register_widgets() {
    register_widget( 'Higher_Education_Social_Icons_Widget' );
}
add_action( 'widgets_init', 'higher_education_register_widgets' );
