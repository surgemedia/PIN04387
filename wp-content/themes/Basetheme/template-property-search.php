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
    <?php include(locate_template('templates/organism-searchbox.php')); ?>
    <?php include(locate_template('templates/molecule-property-of-the-week.php')); ?>
    <!-- Defiant template -->
    <script type="defiant/xsl-template">
    <?php include(locate_template('templates/molecule-property.php')); ?>
    </script>
    <!-- Output element -->
    <div id="output" class="row"></div>
    <?php
 
    wp_reset_postdata(); ?>
    <div class="container-fluid">
        <?php
        ?>
    </div>