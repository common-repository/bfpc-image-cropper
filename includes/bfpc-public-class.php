<?php
/**
 * Public class
 */
class BFPC_Public {
	
	function __construct(){

		// register shortcode
		add_shortcode( 'bfpc_image_cropper', array( $this, 'wpwc_bfpc_floor_planner_editor_callback') );
		add_shortcode( 'wpwc_bfpc_floor_planner_editor', array( $this, 'wpwc_bfpc_floor_planner_editor_callback') );

		//add_filter( 'page_template', array( $this, 'wpse_258026_modify_theme_include_file'), 99 );

	}

	/*
	* function that runs when shortcode is called
	*/
	public function wpse_258026_modify_theme_include_file( $path ) {
			global $post;

	    if( !empty($post) && is_a( $post, 'WP_Post' ) && !empty($post->post_content) && has_shortcode($post->post_content, 'bfpc_image_cropper') ) {
	        // change path here as required
	        return BFPC_INC_PATH.'template/bfpc-image-cropper-template.php'; 
	    }
	    return $path;
	}

	/*
	* function that runs when shortcode is called
	*/
	public function wpwc_bfpc_floor_planner_callback ( $atts ) {
		// Output needs to be return
		return '';
	}

	/*
	* function that runs when shortcode is called
	*/
	public function wpwc_bfpc_floor_planner_editor_callback ( $atts ) {

		global $post;

		if( is_admin() || defined( 'DOING_AJAX' ) ){
			return '[wpwc_bfpc_floor_planner]';
		}

		$atts = shortcode_atts( array(
			'theme' => 'dark'
		), $atts, 'wpwc_bfpc_floor_planner' );
    
		$theme_class = '';
		$fp_design_theme = '';

		if ( !empty($fp_design_theme) ) {
			if ( $fp_design_theme == 'Light' ) {
				$theme_class = 'wpwc_bfpc_theme_light';
			} else if ( $fp_design_theme == 'Dark' ) {
				$theme_class = 'wpwc_bfpc_theme_dark';
			} else {
				$theme_class = 'wpwc_bfpc_theme_default';
			}
		} else {
			$theme_class = 'wpwc_bfpc_theme_default';
		}
 
	ob_start(); ?>
	<div id="bfpc_floor_planner_main" class="container wpwc_bfpc_theme_container <?php echo $theme_class; ?> ">
		<?php include BFPC_INC_PATH.'template/bfpc-image-cropper-view.php'; ?>
	</div>
	<?php 
	// Output needs to be return
	return ob_get_clean();
	}

}