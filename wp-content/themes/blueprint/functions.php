<?php

/* Enqueued admin scripts & styles
-------------------------------------------------------------- */
require_once( get_template_directory() . '/lib/enqueued/admin-scripts-styles.php' );

/* Enqueued theme scripts & styles
-------------------------------------------------------------- */
require_once( get_template_directory() . '/lib/enqueued/theme-scripts-styles.php' );

/* ACF
-------------------------------------------------------------- */
require_once( get_template_directory() . '/lib/acf/block-registration.php' );
require_once( get_template_directory() . '/lib/acf/block-categories.php' );
require_once( get_template_directory() . '/lib/acf/block-allowed.php' );

/* Theme support
-------------------------------------------------------------- */
require_once( get_template_directory() . '/lib/theme-support/custom-admin.php' );
require_once( get_template_directory() . '/lib/theme-support/media-max-upload.php' );
require_once( get_template_directory() . '/lib/theme-support/options.php' );
require_once( get_template_directory() . '/lib/theme-support/plugin-auto-updates.php' );
require_once( get_template_directory() . '/lib/theme-support/post-thumbnails.php' );