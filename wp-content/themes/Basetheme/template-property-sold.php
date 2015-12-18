<?php
/**
* Template Name: Solded Properties Template
*/
?>
<?php 
    $extraClass="small";
    $image=getFeaturedUrl(get_the_id());
    $preTitle="";
    $title=get_the_title();
    $postTitle="";
    include(locate_template('templates/part-jumbotron.php')); 
?>
<script>
    var saleType = "sold";
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