<?php

/**
 * Template Name: Property Search Template
 */
?>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.js"></script>
<script id="propertyTemplate" type="text/x-jQuery-tmpl">
<article class="property-card col-lg-6" style="background:url('http://localhost/PinnacleProperties/wp-content/uploads/2015/11/sale-960x730.png');">
    
    <div class="content">
        <div class="suburb">${title}</div>
        <div class="street">${address}</div>
        <ul class="amenity">
            <li><i class="glyphicon glyphicon-envelope"><div>2</div></i></li>
            <li><i class="glyphicon glyphicon-envelope"><div>2</div></i></li>
            <li><i class="glyphicon glyphicon-envelope"><div>2</div></i></li>
        </ul>
    </div>
</article>
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
<section id="search">
    <label for="suburb">REFINE SEARCH TERMS</label>
    <input type="text" name="suburb">
    <button onclick="load()">SEARCH</button>
    <input type="checkbox" name="surrounding" value="include"> INCLUDE SURROUNDING PROPERTIES
    
    <label for="">PROPERTY TYPE</label>
    <select name="" id="type">
     <option value="">- Any -</option>
    <?php 
    for ($i=0; $i <= sizeof($terms); $i++) { 
        echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
    }
     ?>
    </select>
    
    <label for="">BEDROOMS</label>
    <select name="" id="bed">
     <option value="">- Any -</option>
    <?php 
    for ($i=0; $i <= sizeof($terms); $i++) { 
        echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
    }
     ?>
    </select>
    
    <label for="">BATHROOMS</label>
    <select name="" id="bath">
     <option value="">- Any -</option>
    <?php 
    for ($i=0; $i <= sizeof($terms); $i++) { 
        echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
    }
     ?>
    </select>
    
    <label for="">CAR SPACES</label>
    <select name="" id="car">
     <option value="">- Any -</option>
    <?php 
    for ($i=0; $i <= sizeof($terms); $i++) { 
        echo '<option value='.$terms[$i]->slug.'>'.$terms[$i]->name.'</option>';
    }
     ?>
    </select>

</section>


<div id="blogPostContainer"> </div>

<!-- Defiant template -->
<script type="defiant/xsl-template">
<xsl:template name="property">
    
    <xsl:for-each select="//property">
        <article class="property-card col-lg-6" style="background:url('<?php echo wp_get_attachment_image_src("{featured_image}")[0] ?> ');">
        
        <div class="content">
            <div class="suburb"><xsl:value-of select="property_meta/property_address_suburb"/></div>
            <div class="street">
                <xsl:value-of select="property_meta/property_address_street_number"/>
                <xsl:value-of select="property_meta/property_address_street"/>
            </div>
            <ul class="amenity">
                <li class="col-lg-4"><i class="glyphicon glyphicon-envelope">
                        <div><xsl:value-of select="property_meta/property_rooms"/>
                        </div>
                    </i>
                </li>
                <li class="col-lg-4"><i class="glyphicon glyphicon-envelope">
                        <div><xsl:value-of select="property_meta/property_garage"/>
                        </div>
                    </i>
                </li>
                <li class="col-lg-4"><i class="glyphicon glyphicon-envelope">
                        <div><xsl:value-of select="property_meta/property_toilet"/>
                        </div>
                    </i>
                </li>
            </ul>
        </div>
    </article>

    </xsl:for-each>
    
</xsl:template>

<xsl:template name="tree">
    <h1>Tree</h1>
    <xsl:call-template name="tree-walker"/>
</xsl:template>

<xsl:template name="tree-walker">
    <xsl:param name="indent" />
    <xsl:for-each select="./*">
        <xsl:sort order="descending" select="count(./*)"/>
        <div class="tree-item">
            <xsl:value-of select="$indent"/> <xsl:value-of select="@name"/>
            <xsl:if test="count(./*) > 0">
                <div class="item-children">
                    <xsl:call-template name="tree-walker">
                        <xsl:with-param name="indent">
                            <xsl:value-of select="$indent"/>&#160;&#160;
                        </xsl:with-param>
                    </xsl:call-template>
                </div>
            </xsl:if>
        </div>
    </xsl:for-each>
</xsl:template>

</script>

<!-- Output element -->
<pre id="output"></pre>



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