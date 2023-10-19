<?php

function gofundme_scripts() {
	// Ensure jQuery is enqueued
	wp_enqueue_script('jquery');
			
	// Enqueue your global script with jQuery as a dependency
	wp_enqueue_script( 'global-scripts', get_stylesheet_directory_uri() . '/dist/main.min.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'gofundme_scripts' );
