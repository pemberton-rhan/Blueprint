<?php

// Styles
function my_acf_admin_head() { ?>
	<style type="text/css">
		<?php include_once( get_template_directory() . '/admin/dist/admin-styles.min.css' ); ?>
	</style>
<?php }
add_action( 'acf/input/admin_head', 'my_acf_admin_head' );

// Scripts
function my_admin_scripts() {
	wp_enqueue_script( 'my-admin-js', get_template_directory_uri() . '/admin/dist/admin-scripts.min.js', array(), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'my_admin_scripts' );