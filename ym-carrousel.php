<?php
/**
 * Plugin Name: קרוסלה יפה לאלמנטור
 * Description: משהו ממש יפה.
 * Text Domain: ym-carrousel
 * 
 * Elementor tested up to: 3.16.0
 * Elementor Pro tested up to: 3.16.0
 */


 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}







function ym_carrousel() {

	// Load plugin file
	require_once( __DIR__ . '/includes/widgets-manager.php' );
	require_once( __DIR__ . '/includes/controls-manager.php' );

}
add_action( 'plugins_loaded', 'ym_carrousel' );
