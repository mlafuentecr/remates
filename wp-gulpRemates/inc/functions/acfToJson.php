<?php

/*
*/

// Saves ACF's settings under './acf' directory.
add_filter(
	'acf/settings/save_json', function ( $path ) {
	  $path = trailingslashit( get_template_directory() ) . 'acf';
	  return $path;
	}
  );
  
  // Automatically loads ACF's settings under './acf' directory.
  add_filter(
	'acf/settings/load_json', function ( $path ) {
	  $path[] = trailingslashit( get_template_directory() ) . 'acf';
	  return $path;
	} 
  );
  