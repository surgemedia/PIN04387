<?php
/**
* Template Name: Land Search
*/
?>

<?php
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
?>
<script>
    jQuery(document).ready(function(){
    var saleType = "current";
    var property_type = "land";
    
    // setTimeout(function(){
        loadProperties(saleType,property_type);
    // }, 1000);
    
    });
</script>
<div class="search-header row">
        <?php //include(locate_template('templates/organism-searchbox.php')); ?>
        <?php include(locate_template('templates/organism-searchbox-land.php')); ?>
        
        <?php $type="land";
              include(locate_template('templates/molecule-property-of-the-week.php')); ?>
    <!-- Defiant template -->
</div>
    <script type="defiant/xsl-template">
        <?php include(locate_template('templates/molecule-land.php')); ?>
    </script>
    <!-- Output element -->
    <div id="output"></div>
     <?php include(locate_template('templates/molecule-noResults.php' )); ?>
    <?php wp_reset_postdata(); ?>
    