<?php
/**
* The template for adding Customizer Custom Controls
*
* @package Higher_Education
* @since Higher Education 0.1
*/

//Custom control for any note, use label as output description
class Higher_Education_Note_Control extends WP_Customize_Control {
	public $type = 'description';

	public function render_content() {
		echo '<h2 class="description">' . $this->label . '</h2>'; // WPCS: XSS OK.
	}
}

//Custom control for dropdown category multiple select
class Higher_Education_Multi_Dropdown_Category_Control extends WP_Customize_Control {
	public $type = 'dropdown-categories';
	public $name;
	public $taxonomy;

	public function render_content() {
		$args = array(
			'name'             => $this->name,
			'echo'             => 0,
			'hide_empty'       => false,
			'show_option_none' => false,
			'hide_if_empty'    => false,
			'show_option_all'  => esc_html__( 'All Categories', 'higher-education' )
		);

		$args['taxonomy'] = isset( $this->taxonomy ) ? $this->taxonomy : 'category';

		$dropdown = wp_dropdown_categories( $args );

		$dropdown = str_replace('<select', '<select multiple = "multiple" style = "height:95px;" ' . $this->get_link(), $dropdown );

		printf(
			'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
			$this->label,
			$dropdown
		);

		echo '<p class="description">'. esc_html__( 'Hold down the Ctrl (windows) / Command (Mac) button to select multiple options.', 'higher-education' ) . '</p>';
	}
}

//Custom control for dropdown category multiple select
class Higher_Education_Important_Links extends WP_Customize_Control {
    public $type = 'important-links';

    public function render_content() {
    	//Add Theme instruction, Support Forum, Changelog, Donate link, Review, Facebook, Twitter, Google+, Pinterest links
        $important_links = array(
						'theme_instructions' => array(
							'link'	=> esc_url( 'http://catchthemes.com/theme-instructions/higher-education/' ),
							'text' 	=> esc_html__( 'Theme Instructions', 'higher-education' ),
							),
						'support' => array(
							'link'	=> esc_url( 'http://catchthemes.com/support/' ),
							'text' 	=> esc_html__( 'Support', 'higher-education' ),
							),
						'changelog' => array(
							'link'	=> esc_url( 'http://catchthemes.com/changelogs/higher-education-theme/' ),
							'text' 	=> esc_html__( 'Changelog', 'higher-education' ),
							),
						'donate' => array(
							'link'	=> esc_url( 'http://catchthemes.com/donate/' ),
							'text' 	=> esc_html__( 'Donate Now', 'higher-education' ),
							),
						'review' => array(
							'link'	=> esc_url( 'https://wordpress.org/support/view/theme-reviews/higher-education' ),
							'text' 	=> esc_html__( 'Review', 'higher-education' ),
							),
						'facebook' => array(
							'link'	=> esc_url( 'https://www.facebook.com/catchthemes/' ),
							'text' 	=> esc_html__( 'Facebook', 'higher-education' ),
							),
						'twitter' => array(
							'link'	=> esc_url( 'https://twitter.com/catchthemes/' ),
							'text' 	=> esc_html__( 'Twitter', 'higher-education' ),
							),
						'gplus' => array(
							'link'	=> esc_url( 'https://plus.google.com/+Catchthemes/' ),
							'text' 	=> esc_html__( 'Google+', 'higher-education' ),
							),
						'pinterest' => array(
							'link'	=> esc_url( 'http://www.pinterest.com/catchthemes/' ),
							'text' 	=> esc_html__( 'Pinterest', 'higher-education' ),
							),
						);
		foreach ( $important_links as $important_link) {
			echo '<p><a target="_blank" href="' . $important_link['link'] .'" >' . esc_attr( $important_link['text'] ) .' </a></p>';
		}
    }
}
