<?php

/**
 * Template Name: Property Search Template
 */
?>

<script>
var searchForm = function(){
var obj = [];
obj.surbub = jQuery('#suburb').val();
obj.property_type =  jQuery("#type").val();
obj.bedrooms = jQuery("#bedrooms").val();
obj.car_space = jQuery("#car-space").val();
obj.bathrooms = jQuery("#bathrooms").val();
// return obj;

load(function(json,obj) {
var arr = [];
jQuery.each(json, function (i, jsonSingle) {
        arr.push({
            property: jsonSingle
        });
    });           
    console.log(arr);


var suburb_results = JSON.search(arr, '//property[contains(property_term, "'+obj.suburb+'" )]');
console.log(suburb_results);

});


}

// console.log(searchForm.surbub);

// load(function(json) {
// var arr = [];
// jQuery.each(json, function (i, jsonSingle) {
//         arr.push({
//             property: jsonSingle
//         });
//     });           
//     console.log(arr);


// // var wooloowin = JSON.search(arr, '//property[contains(property_term, "wooloowin")]');
// // console.log(wooloowin);

// });


function load(callback)
{
    jQuery.ajax({  
        type: "GET",  
        url: "http://localhost/PinnacleProperties/wp-json/wp/v2/json-property",  
        contentType: "application/json; charset=utf-8",  
        dataType: "json",  
        success: function (json) {
            // Call our callback with the message
            callback(json);
        },  
        failure: function () {
           console.log()
        }
     }); 
}
</script>
<?php 
// no default values. using these as examples
$taxonomies = array( 
    'location'
);

$args = array(
    'orderby'           => 'name', 
    'order'             => 'ASC',
    'hide_empty'        => true, 
    'exclude'           => array(), 
    'exclude_tree'      => array(), 
    'include'           => array(),
    'number'            => '', 
    'fields'            => 'all', 
    'slug'              => '',
    'parent'            => '',
    'hierarchical'      => true, 
    'child_of'          => 0,
    'childless'         => false,
    'get'               => '', 
    'name__like'        => '',
    'description__like' => '',
    'pad_counts'        => false, 
    'offset'            => '', 
    'search'            => '', 
    'cache_domain'      => 'core'
); 
    
    $terms = get_terms($taxonomies, $args);
   // debug($terms);
 ?>

<section id="search" class="col-lg-12">
    <div id="jsonSearch">
      <div class="search col-lg-6">
           <select name="suburb" id="suburb">
           <option value="">Surbub</option>
            <?php 
            for ($i=0; $i <= sizeof($terms); $i++) { 
                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
            }
             ?>
            </select>
    </div>
   <select name="type" id="type">
    <option value="NULL">Any</option>
       <option value="House">House</option>
   </select>
   <select name="bedrooms" id="bedrooms">
   <option value="NULL">Any</option>
         <option value="1">1</option>
       <option value="2">2</option>
       <option value="3">3</option>
       <option value="4">4</option>
   </select>
   <select name="car_space" id="car-space">
   <option value="NULL">Any</option>
       <option value="1">1</option>
       <option value="2">2</option>
       <option value="3">3</option>
       <option value="4">4</option>
   </select>
    <div class="form-group">
    <label for="exampleInputEmail1">Bathrooms</label>
       <select name="bathrooms" id="bathrooms" class="form-control">
   <option value="NULL">Any</option>
       <option value="">1</option>
       <option value="">2</option>
       <option value="">3</option>
       <option value="">4</option>
   </select>
  </div>
  

  <button onclick="searchForm(); ">Submit</button>
</div>

</section>

<script>

function getServiceInfo (url,container){

    jQuery.getJSON(url, function(data) {

    for (var i = 0; i < data.length; i++) {
        console.log(data);
    }

    });
getServiceInfo('http://localhost/PinnacleProperties/wp-json/wp/v2/json-property','#jsonConsole')

}


// function get_object_meta(key,value){
//     var object = jQuery.grep(json, function( n, i ) {
//     return n.proptery_meta[] ===;
//     });
//     return object;
// }



</script>

<pre id="jsonConsole" ></pre>
    <?php
//     global $wp_post_types;
// // debug( $wp_post_types[ 'property' ] );
// // WP_Query arguments
// $args = array('post_type' => array('property'), 'p' => 37,);
// $query = new WP_Query($args);

// if ($query->have_posts()) {
//     while ($query->have_posts()) {
//         $query->the_post();
        
//         debug(get_post());
//         debug(get_post_meta(get_the_id() ));
        
//     }
// } 
// else {
    
//     // no posts found
    
// }
wp_reset_postdata(); ?>
<div class="container-fluid">
    <?php


 ?>
</div>