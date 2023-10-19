<?php

	function gofundme_styles() {
		wp_enqueue_style( 'global-styles', get_template_directory_uri() . '/dist/style.min.css', array(), '1.0', 'all' );
	}
	add_action( 'wp_enqueue_scripts', 'gofundme_styles' );