<?php

// ACF admin custom styles
add_action( 'acf/input/admin_head', 'my_acf_admin_head' );
function my_acf_admin_head() { ?>
	<style type="text/css">
		<?php include_once( get_template_directory() . '/admin/dist/admin-styles.min.css' ); ?>
	</style>
<?php }