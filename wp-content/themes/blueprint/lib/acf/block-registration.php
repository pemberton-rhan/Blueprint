<?php

  // Register custom ACF blocks
  function register_custom_blocks() {
    if (function_exists('acf_register_block_type')) {
      
      // Hero blocks
      require_once( get_template_directory() . '/lib/acf/block-types/hero-blocks.php' );
      
    }
  }
  add_action('acf/init', 'register_custom_blocks');