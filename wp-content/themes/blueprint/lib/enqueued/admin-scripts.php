<?php

// Enqueue admin scripts
add_action( 'admin_enqueue_scripts', 'my_admin_scripts' );
function my_admin_scripts() {
	wp_enqueue_script( 'my-admin-js', get_template_directory_uri() . '/admin/dist/admin-scripts.min.js', array(), '1.0.0', true );
}