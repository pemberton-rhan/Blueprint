<?php

function theme_scripts_and_styles() {
	
	// Styles
	wp_enqueue_style( 'theme-styles', get_template_directory_uri() . '/dist/main.min.css', array(), '1.0', 'all' );
	
	// Scripts
	wp_enqueue_script( 'theme-scripts', get_stylesheet_directory_uri() . '/dist/main.min.js', array('jquery'), null, true );
	
}
add_action( 'wp_enqueue_scripts', 'theme_scripts_and_styles' );