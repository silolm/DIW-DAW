<?php
/**
 * The template for displaying meta box in page/post
 *
 * This adds Layout Options, Header Freatured Image Options, Single Page/Post Image
 * This is only for the design purpose and not used to save any content
 *
 * @package Higher_Education
 */

/**
 * Class to Renders and save metabox options
 *
 * @since Higher Education 0.1
 */
class Higher_Education_Metabox {
	private $meta_box;

	private $fields;

	/**
	* Constructor
	*
	* @since Higher Education 0.1
	*
	* @access public
	*
	*/
	public function __construct( $meta_box_id, $meta_box_title, $post_type ) {

		$this->meta_box = array (
			'id' 		=> $meta_box_id,
			'title' 	=> $meta_box_title,
			'post_type' => $post_type,
		);

		$this->fields = array(
			'higher-education-layout-option',
			'higher-education-header-image',
			'higher-education-featured-image'
		);


		// Add metaboxes
		add_action( 'add_meta_boxes', array( $this, 'add' ) );

		add_action( 'save_post', array( $this, 'save' ) );
   	}

	/**
	* Add Meta Box for multiple post types.
	*
	* @since Higher Education 0.1
	*
	* @access public
	*/
	public function add( $post_type ) {
		add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $post_type, 'side', 'high' );
	}

	/**
	* Renders metabox
	*
	* @since Higher Education 0.1
	*
	* @access public
	*/
	public function show() {
		global $post;

		$layout_options       = higher_education_metabox_layouts();
		$featured_img_options = higher_education_metabox_featured_image_options();
		$header_image_options = higher_education_metabox_header_featured_image_options();


	    // Use nonce for verification
	    wp_nonce_field( basename( __FILE__ ), 'higher_education_custom_meta_box_nonce' );

	    // Begin the field table and loop  ?>
	    <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="higher-education-layout-option"><?php esc_html_e( 'Layout Options', 'higher-education' ); ?></label></p>
		<select class="widefat" name="higher-education-layout-option" id="higher-education-layout-option">
			 <?php
				$meta_value = get_post_meta( $post->ID, 'higher-education-layout-option', true );
				
				if ( empty( $meta_value ) ){
					$meta_value = 'default';
				}
				
				foreach ( $layout_options as $field =>$label ) {  
				?>
					<option value="<?php echo esc_attr( $label['value'] ); ?>" <?php selected( $meta_value, $label['value'] ); ?>><?php echo esc_html( $label['label'] ); ?></option>
				<?php
				} // end foreach
			?>
		</select>

		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="higher-education-header-image"><?php esc_html_e( 'Header Featured Image Options', 'higher-education' ); ?></label></p>
		<select class="widefat" name="higher-education-header-image" id="higher-education-header-image">
			 <?php
				$meta_value = get_post_meta( $post->ID, 'higher-education-header-image', true );
				
				if ( empty( $meta_value ) ){
					$meta_value = 'default';
				}
				
				foreach ( $header_image_options as $field =>$label ) {  
				?>
					<option value="<?php echo esc_attr( $label['value'] ); ?>" <?php selected( $meta_value, $label['value'] ); ?>><?php echo esc_html( $label['label'] ); ?></option>
				<?php
				} // end foreach
			?>
		</select>

		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="higher-education-featured-image"><?php esc_html_e( 'Single Page/Post Image Layout', 'higher-education' ); ?></label></p>
		<select class="widefat" name="higher-education-featured-image" id="higher-education-featured-image">
			 <?php
				$meta_value = get_post_meta( $post->ID, 'higher-education-featured-image', true );
				
				if ( empty( $meta_value ) ){
					$meta_value = 'default';
				}
				
				foreach ( $featured_img_options as $field =>$label ) {  
				?>
					<option value="<?php echo esc_attr( $label['value'] ); ?>" <?php selected( $meta_value, $label['value'] ); ?>><?php echo esc_html( $label['label'] ); ?></option>
				<?php
				} // end foreach
			?>
		</select>
	<?php
	}

	/**
	 * Save custom metabox data
	 *
	 * @action save_post
	 *
	 * @since Higher Education 0.1
	 *
	 * @access public
	 */
	public function save( $post_id ) {
		global $post_type;

		$post_type_object = get_post_type_object( $post_type );

	    if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                      // Check Autosave
	    || ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
	    || ( ! in_array( $post_type, $this->meta_box['post_type'] ) )                  // Check if current post type is supported.
	    || ( ! check_admin_referer( basename( __FILE__ ), 'higher_education_custom_meta_box_nonce') )    // Check nonce - Security
	    || ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) )  // Check permission
	    {
	      return $post_id;
	    }

	    foreach ( $this->fields as $field ) {
			$new = $_POST[ $field ];

			if ( '' == $new || array() == $new ) {
				return;
			}
			else {
				if ( ! update_post_meta ( $post_id, $field, sanitize_key( $new ) ) ) {
					add_post_meta( $post_id, $field, sanitize_key( $new ), true );
				}
			}
		} // end foreach
	}
}

$higher_education_metabox = new Higher_Education_Metabox(
	'higher-education-options', 					//metabox id
	esc_html__( 'Higher Education Options', 'higher-education' ), //metabox title
	array( 'page', 'post' )				//metabox post types
);
