<?php

add_filter( 'block_categories_all' , function( $categories ) {

  // Add categories here
  $categories[] = array(
    'slug'  => 'hero-blocks',
    'title' => 'Hero Blocks'
  );

  return $categories;
} );


