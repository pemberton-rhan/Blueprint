<?php

/* Hero Blocks
-------------------------------------------------------------- */
acf_register_block_type(array(
  'name' => 'hero-primary',
  'title' => __('Hero - Primary'),
  'description' => __('Primary hero block'),
  
  'category' => 'hero-blocks',
  'icon' => 'align-full-width',
  'keywords' => array('hero', 'hero block', 'primary', 'hero primary'),
  'mode' => 'edit',
  'supports' => array(
    'align' => false,
    'mode' => false,
    'multiple' => false,
  ),
  'render_template' => get_template_directory() . '/theme-blocks/hero/primary/block.php',
  'enqueue_assets' => function(){
    wp_enqueue_style( 'hero-primary-styles', get_template_directory_uri() . '/theme-blocks/hero/primary/dist/block.css' );
    wp_enqueue_script( 'hero-primary-scripts', get_template_directory_uri() . '/theme-blocks/hero/primary/dist/block.js', array(), '', true );
  },
));

