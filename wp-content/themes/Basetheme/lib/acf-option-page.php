<?php
//Theme Settings Page
if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'Extra Settings',
    'menu_title'  => 'Extra Settings',
    'menu_slug'   => 'extra-settings',
    'capability'  => 'edit_posts',
  ));
  
}
