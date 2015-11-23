<?php

/**
 * Template Name: Team Template
 */
?>
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


<div class="col-sm-6 col-md-3 side">
    <?php 
    
    $team_side_column="team_left_column";
    include(locate_template('templates/part-team-side.php')); ?>
    
</div>
<div class="col-sm-6 col-md-3 col-md-push-6 side">
<?php 
    
    $team_side_column="team_right_column";
    include(locate_template('templates/part-team-side.php')); ?>
</div>
<div class="col-xs-12 col-md-6 col-md-pull-3 general-content">
    <?php
    the_content(); ?>
</div>




<?php
endwhile; ?>
