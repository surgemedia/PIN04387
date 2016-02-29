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
  add_action( 'init', 'easyRentals_rest_support', 25 );
  function easyRentals_rest_support() {
    global $wp_post_types;
    //be sure to set this to the name of your post type!
    $post_type_name = 'rental';
    if( isset( $wp_post_types[ $post_type_name ] ) ) {
        $wp_post_types[$post_type_name]->show_in_rest = true;
        $wp_post_types[$post_type_name]->rest_base = 'json-rental';
        $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
    }
  }
/*=======================================================
=            Allow WPAPI TO USE Feature TAX            =
=======================================================*/
  // add_action( 'init', 'easyListings_tax_feature_rest_support', 25 );
  // function easyListings_tax_feature_rest_support() {
  //   global $wp_taxonomies;

  //   //be sure to set this to the name of your taxonomy!
  //   $taxonomy_name = 'tax_feature';

  //   if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
  //       $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
  //       $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
  //       $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
  //   }


  // }
/*=======================================================
=            Allow WPAPI TO USE LOCATION TAX            =
=======================================================*/
  //   add_action( 'init', 'easyListings_location_rest_support', 25 );
  // function easyListings_location_rest_support() {
  //   global $wp_taxonomies;

  //   //be sure to set this to the name of your taxonomy!
  //   $taxonomy_name = 'location';

  //   if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
  //       $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
  //       $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
  //       $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
  //   }


  // }

/*============================================
=            Expose Property Meta            =
============================================*/
add_action( 'rest_api_init', 'meta_register_property' );

function meta_register_property() {
    /*===============================
    =            Selling            =
    ===============================*/
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
     register_api_field( 'property', 'property_image',
        array(
            'get_callback'    => 'meta_get_property_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
     /*===============================
     =            Rentals            =
     ===============================*/
     register_api_field( 'rental', 'property_meta',
        array(
            'get_callback'    => 'meta_get_property',
            'update_callback' => null,
            'schema'          => null,
        )
    );
     register_api_field( 'rental', 'property_term',
        array(
            'get_callback'    => 'meta_get_property_term',
            'update_callback' => null,
            'schema'          => null,
        )
    );
     register_api_field( 'rental', 'property_image',
        array(
            'get_callback'    => 'meta_get_property_image',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}

function meta_get_property( $object ) {
    $post_meta = get_post_meta( $object[ 'id' ]);
    $garage_num = $post_meta['property_garage'];
    $carpost_num = $post_meta['property_carport'];
    $sum = $carpost_num[0] + $garage_num[0];
    // if(!is_numeric($sum)){ $sum = 'cheese'; }
    
    $final_data = array(
        'property_address_street_number' => $post_meta['property_address_street_number'],
        'property_address_street' => $post_meta['property_address_street'],
        'property_bedrooms' => $post_meta['property_bedrooms'],
        'property_bathrooms' => $post_meta['property_bathrooms'],
        'property_address_suburb' => $post_meta['property_address_suburb'],
        'property_carport' => $post_meta['property_carport'],
        'property_address_coordinates' => $post_meta['property_address_coordinates'],
        'property_status' => $post_meta['property_status'],
        'property_category' => $post_meta['property_category'],
        'property_garage' => $post_meta['property_garage'],
        'property_all_carspaces' => $sum

        );
    
    return $final_data;
}

function meta_get_property_term( $object ) {
    return wp_get_post_terms($object[ 'id' ], 'location', array("fields" => "names"))[0];
}

function meta_get_property_image( $object ) {
    return getFeaturedUrl($object[ 'id' ]);
}


/*==========================================================
=            Remove unused information property            =
==========================================================*/
function my_remove_extra_product_data( $data, $post, $context ) {
    // make sure you've got the right custom post type
    if ( 'property' !== $data[ 'type' ] ) {
        return $data;
    }
     if ( 'rental' !== $data[ 'type' ] ) {
      
        return $data;
    }
    // now proceed as you saw in the other examples
    if ( $context !== 'view' || is_wp_error( $data ) ) {
        return $data;
    }
    // unset unwanted fields
    unset( $data[ 'comment_status' ] );
   



    // finally, return the filtered data
    return $data;
}

// make sure you use the SAME filter hook as for regular posts
add_filter( 'json_prepare_post', 'my_remove_extra_product_data', 12, 3 );


 ?>
