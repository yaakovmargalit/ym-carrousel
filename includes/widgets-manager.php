<?php

function register_ym_carrousel_custom_widgets( $widgets_manager ) {

require_once( __DIR__ . '/widgets/carrousel-widget.php' );  // include the widget file

$widgets_manager->register( new \Ym_Elementor_Carrousel_Widget() );  // register the widget

}
add_action( 'elementor/widgets/register', 'register_ym_carrousel_custom_widgets' );




function ym_carrousel_widgets_dependencies() {

	/* Scripts */
	wp_register_script( 'ym_carrousel-script-1', plugins_url( '/js/swiper.js', __FILE__ ), array( ), '2.0.0', false );


	/* Styles */
	wp_register_style( 'widget-style-1', plugins_url( '/css/swiper.css', __FILE__ ) );
	

}
add_action( 'wp_enqueue_scripts', 'ym_carrousel_widgets_dependencies' );

