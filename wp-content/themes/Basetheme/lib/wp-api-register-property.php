<?php 
/*=======================================================
=     Allow WPAPI TO USE property post type            =
=======================================================*/
  add_action( 'init', 'easyListings_rest_support', 25 );
  function easyListings_rest_support() {
    global $wp_post_types;
    //be sure to set this to the name of your post type!
    $post_type_name = 'property';
    if( isset( $wp_post_types[ $post_type_name ] ) ) {

        $wp_post_types[$post_type_name]->show_in_rest = true;
        $wp_post_types[$post_type_name]->rest_base = 'json-property';
        $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
    }
  }
/*=======================================================
=            Allow WPAPI TO USE Feature TAX            =
=======================================================*/
  add_action( 'init', 'easyListings_tax_feature_rest_support', 25 );
  function easyListings_tax_feature_rest_support() {
    global $wp_taxonomies;

    //be sure to set this to the name of your taxonomy!
    $taxonomy_name = 'tax_feature';

    if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
        $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
        $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
        $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
    }


  }
/*=======================================================
=            Allow WPAPI TO USE LOCATION TAX            =
=======================================================*/
    add_action( 'init', 'easyListings_location_rest_support', 25 );
  function easyListings_location_rest_support() {
    global $wp_taxonomies;

    //be sure to set this to the name of your taxonomy!
    $taxonomy_name = 'location';

    if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
        $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
        $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
        $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
    }


  }

/*============================================
=            Expose Property Meta            =
============================================*/
add_action( 'rest_api_init', 'meta_register_property' );
function meta_register_property() {
    register_api_field( 'property', 'property_meta',
        array(
            'get_callback'    => 'meta_get_property',
            'update_callback' => null,
            'schema'          => null,
        )
    );
     register_api_field( 'property', 'property_term',
        array(
            'get_callback'    => 'meta_get_property_term',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
function meta_get_property( $object ) {
    return get_post_meta( $object[ 'id' ]);
}

function meta_get_property_term( $object ) {
    return wp_get_post_terms($object[ 'id' ], 'location', array("fields" => "all"))[0];
}


 ?>