<?php
/**
 * Public class
 */
class BFPC_Scripts {
	
	function __construct(){
		add_action( 'wp_enqueue_scripts', array( $this, 'wpwc_bfpc_public_enqueue_scripts' ) );
	}

	/*
	* Public enqueue styles and scripts
	*/
	public function wpwc_bfpc_public_enqueue_scripts(){

		global $post;
		// Check the page, post have shortcode
		if( !empty($post) && is_a( $post, 'WP_Post' ) && !empty($post->post_content) && has_shortcode($post->post_content, 'bfpc_image_cropper') ) {

			// enqueue styles
			wp_enqueue_style( 'dashicons' );
	        wp_enqueue_style('wpwc-bfpc-font-awesome-style', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all');
	        wp_enqueue_style('wpwc-bfpc-jquery-Jcrop-min', BFPC_INC_URL.'css/jquery.Jcrop.min.css', array(), BFPC_VERSION, 'all');
	        wp_enqueue_style('wpwc-bfpc-public-style', BFPC_INC_URL.'css/bfpc-public-style.css', array(), BFPC_VERSION, 'all');
	        wp_enqueue_style('wpwc-bfpc-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap', false );

	        // enqueue scripts
	        wp_enqueue_script('wpwc-bfpc-jquery-Jcrop-min', BFPC_INC_URL.'js/jquery.Jcrop.min.js', array('jquery'), '', false);
	        wp_enqueue_script('wpwc-bfpc-crop-image-script', BFPC_INC_URL.'js/bfpc-crop-image-script.js', array('jquery', 'wpwc-bfpc-jquery-Jcrop-min' ), BFPC_VERSION, false);
		}
	}

}