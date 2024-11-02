<?php
/**
 * Plugin Name:       BFPC Image Cropper
 * Plugin URI:        
 * Description:       This plugin can give options to site visitor can edit image online via your site.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Vasant Rajput (vasant.dev95@gmail.com)
 * Author URI:        https://www.fiverr.com/vasantrajput
 * Text Domain:       wpwc-bfpc
 * License:           
 * License URI:       
 */


define( 'BFPC_VERSION', '1.0.0' );
define( 'BFPC_Text_Domain', 'wpwc-bfpc' );
define( 'BFPC_PATH', plugin_dir_path( __FILE__ ) );
define( 'BFPC_URL', plugin_dir_url( __FILE__ ) );
define( 'BFPC_INC_PATH', BFPC_PATH.'includes/' );
define( 'BFPC_INC_URL', BFPC_URL.'includes/' );

add_action( 'plugins_loaded', 'wpwc_bfpc_load_plugin_files', 50 );

function wpwc_bfpc_load_plugin_files() {

	global $bfpc_public, $bfpc_scripts;

	include_once BFPC_INC_PATH .'bfpc-public-class.php';
	include_once BFPC_INC_PATH .'bfpc-script-class.php';

	load_plugin_textdomain( BFPC_Text_Domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	
	if( class_exists('BFPC_Public') ){
		$bfpc_public = new BFPC_Public();
	}
	if ( class_exists('BFPC_Scripts') ) {
		$bfpc_scripts = new BFPC_Scripts();
	}

}
