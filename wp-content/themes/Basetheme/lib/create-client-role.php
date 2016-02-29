<?php
/***
Plugin Name: Client Role
Plugin URI: - 
Description: Create Custom User level Client
Author: Junaid Ahmed
Author URI: http://www.simpleux.co.uk
Version: 1.0.0.0
License: GPLv3 or later
***/


if(get_role('client')) {
	remove_role('client' );
	}
add_action('init', 'cloneUserRole');
function cloneUserRole()
{
 global $wp_roles;
 if (!isset($wp_roles))
 $wp_roles = new WP_Roles();
 $adm = $wp_roles->get_role('administrator');
 // Adding a new role with all admin caps.
 $wp_roles->add_role('client', 'Client', $adm->capabilities);
}
?>