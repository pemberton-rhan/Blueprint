<?php

/* Customize and re-order admin sidebar
-------------------------------------------------------------- */
function gfm_custom_menu_order($menu_ord) {
  if (!$menu_ord) return true;
  
  return array(
    // Dashboard
    'index.php',
    // Content types
    'edit.php',
    'edit.php?post_type=supporter-space',
    'edit.php?post_type=page',
    'separator1',
    // Content creation
    'upload.php',
    'gf_edit_forms',
    'edit.php?post_type=acf-field-group',
    'separator-last',
    // Utilities
    'users.php',
    'options-general.php',
    'plugins.php',
    'betterdocs-admin',
  );
  
}

add_filter('custom_menu_order', 'gfm_custom_menu_order');
add_filter('menu_order', 'gfm_custom_menu_order');

// Remove unnecessary admin items
add_action('admin_menu', 'gfm_remove_menus');

function gfm_remove_menus() {
  //remove_menu_page('edit-comments.php');
  //remove_menu_page('tools.php');
  //remove_menu_page('themes.php');
}