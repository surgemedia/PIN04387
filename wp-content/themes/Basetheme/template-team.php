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
        $preTitle=get_field("light");
        $title="<b>".get_field("bold")"</b>";
        $postTitle=get_field("light2");
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