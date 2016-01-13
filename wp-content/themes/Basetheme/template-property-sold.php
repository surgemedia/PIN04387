<?php
/**
* Template Name: Solded Properties Template
*/
?>
<?php 
    $extraClass=get_field("jumbotron_size");
    $image=getFeaturedUrl(get_the_id());
    $preTitle=get_field("light");
    $title="<b>".get_field("bold")."</b>";
    $postTitle=("small"!==get_field("jumbotron_size")) ? get_field("light2") : "";
    include(locate_template('templates/part-jumbotron.php')); 
?>
<script>
    var saleType = "sold";
    var property_type = "property";
</script>
<div class="tips-content">
        <div class="content">
            <?php the_content(); ?>
        </div>   
</div>    
    <!-- Defiant template -->
    <script type="defiant/xsl-template">
        <?php include(locate_template('templates/molecule-property.php')); ?>
    </script>
    <!-- Output element -->
    <div id="output" class="row"></div>
    <?php wp_reset_postdata(); ?>