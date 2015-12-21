<?php

/**
 * Template Name: Team Template
 */
?>
<div class="row">
<?php
    while (have_posts()):
        the_post(); ?>
    <?php 
        $extraClass="big";
        $image=getFeaturedUrl(get_the_id());
        $preTitle="";
        $title="pinnacle property qld";
        $postTitle="Exceeding Expectations";
        include(locate_template('templates/part-jumbotron.php')); ?>
    
    <div class="tips-content">
        <div class="content">
            <?php the_content(); ?>
        </div>
    </div>
    
    <?php 
        
        $team_side_column="team_right_column";
        include(locate_template('templates/part-team-row.php')); ?>
    
    
    
    
    
    <?php
    endwhile; ?>
    </div>