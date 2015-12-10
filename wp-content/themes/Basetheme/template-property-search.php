<?php

/**
 * Template Name: Property Search Template
 */
?>

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

<div class="search-header row">
    <section id="search" class="col-lg-6">
        <div class="filter">
            <label for="suburb">REFINE SEARCH TERMS</label>
            <input type="text" name="suburb" id="suburb">
            <button onclick="search();">SEARCH</button>
        </div>
        
        <div class="surrounding">
            <input type="checkbox" name="surrounding" value="include"> INCLUDE SURROUNDING PROPERTIES
        </div>
        
        <div class="field">
            <label for="">PROPERTY TYPE</label>
            <select name="" id="type">
             <option value="">- Any -</option>
              
                
            <?php 
            for ($i=0; $i <= sizeof($terms); $i++) { 
                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
            }
             ?>
            </select>
        </div>
        
        <div class="field">
            <label for="">BEDROOMS</label>
            <select name="" id="bed">
             <option value="">- Any -</option>
             <option value="1">- 1 + -</option>
             <option value="2">- 2 + -</option>  
             <option value="3">- 3 + -</option>  
            <?php 
            /*for ($i=0; $i <= sizeof($terms); $i++) { 
                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
            }*/
             ?>
            </select>
        </div>
        
        <div class="field">
            <label for="">BATHROOMS</label>
            <select name="" id="bath">
             <option value="">- Any -</option>
             <option value="1">- 1 + -</option>
             <option value="2">- 2 + -</option>  
             <option value="3">- 3 + -</option>  
            <?php 
            /*for ($i=0; $i <= sizeof($terms); $i++) { 
                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
            }*/
             ?>
            </select>
        </div>
        
        <div class="field">
            <label for="">CAR SPACES</label>
            <select name="" id="car">
             <option value="">- Any -</option>
             <option value="1">- 1 + -</option>
             <option value="2">- 2 + -</option>  
             <option value="3">- 3 + -</option> 
            <?php 
                   /* for ($i=0; $i <= sizeof($terms); $i++) { 
                echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
            }*/
             ?>
            </select>
        </div>
    </section>
    <section class="search-feature col-lg-6 row">
        <?php  
                    // WP_Query arguments
                $args = array (
                    'post_type' => array( 'property' ),
                    'p' => get_field('featured_property')[0],
                    ); 
                $query = new WP_Query( $args );
                
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        // debug(get_post_meta(get_the_id() ));?>
                         <?php 
                    // $the_property = get_post(get_the_id() );
                    $the_property = get_post();
                    $the_property_meta = get_post_meta(get_the_id() );
                     ?>
                    <div class="col-sm-6">
                        <?php 
                             $image = getFeaturedUrl(get_the_id()); 
                             $image_url = aq_resize($image,960,621,true,true,true);
                        ?>
                        <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
                        <h1 class="title"><strong>Propery</strong> of the week</h1>
                    </div>
                    <div class="col-sm-6 ">   
                            <div class="property-obj">
                                <div class="suburb"><?php echo $the_property_meta['property_address_suburb'][0]; ?></div>
                                <div class="street">
                                    <?php echo $the_property_meta['property_address_street_number'][0]; ?> &nbsp;
                                    <?php echo $the_property_meta['property_address_street'][0]; ?>
                                </div>
                                <ul>
                                    <li><i class="icon-BED"></i>
                                        <span><?php echo $the_property_meta['property_bedrooms'][0]; ?></span>
                                    </li>
                                    <li><i class="icon-BATH"></i>
                                        <span><?php echo $the_property_meta['property_bathrooms'][0]; ?></span>
                                    </li>
                                    <li><i class="icon-CAR"></i>
                                        <span><?php echo $the_property_meta['property_garage'][0]; ?></span>
                                    </li>
                                </ul>
                                
                                <a href="<?php echo $the_property->guid; ?>" class="details">Details</a>

                            </div>
                        </div>   
                


                <?php    }
                } else {
                    // no posts found
                }
    
                wp_reset_postdata(); ?>
        
    <section>
</div>
    
</section>
<div id="blogPostContainer"> </div>

<!-- Defiant template -->
<script type="defiant/xsl-template">
<xsl:template name="property">
    
    <xsl:for-each select="//property">
        <article class="property-card col-lg-6" style="background:url('{property_image}');">
        
        <a href="{link}" class="content">
            <div class="suburb"><xsl:value-of select="property_meta/property_address_suburb"/></div>
            <div class="street">
                <span>
                    <xsl:value-of select="property_meta/property_address_street_number"/>
                </span>
                <span>
                    <xsl:value-of select="property_meta/property_address_street"/>
                </span>
            </div>
            <i class="icon-BED">
                    <xsl:value-of select="property_meta/property_bedrooms"/>
                </i>
            <i class="icon-BATH">
                    <xsl:value-of select="property_meta/property_bathrooms"/>
                    
                </i>
            <i class="icon-CAR">
                    <xsl:value-of select="property_meta/property_garage"/>
                    
                </i>
        </a>
    </article>

    </xsl:for-each>
    
</xsl:template>

</script>

<!-- Output element -->
<div id="output" class="row"></div>


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