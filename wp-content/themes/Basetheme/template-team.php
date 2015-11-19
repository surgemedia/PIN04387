<?php

/**
 * Template Name: Team Template
 */
?>
<?php
while (have_posts()):
    the_post(); ?>
<div class="col-md-3">
	<?php
    $team_side = get_field('team_left_column');
    
    // WP_Query arguments
    $args = array(
    	'post_type' => array('team'),
    	'post__in' =>  $team_side,
    );
    
    // The Query
    $query = new WP_Query($args);
    
    // The Loop
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post(); ?>
 			<?php $image = getFeaturedUrl(get_the_id()); 
		 	$image_url = aq_resize($image,100,100,true,true,true); ?>
		 	<?php debug($image_url); ?>
			<?php debug(get_the_title()); ?>
			<?php debug(get_field('job_title')); ?>
			<?php debug(get_field('phone')); ?>
			<?php debug(get_field('mobile')); ?>
			<?php debug(get_field('email')); ?>
         <?php
        }
    } 
    else {
        
        // no posts found
        
    }
    
    // Restore original Post Data
    unset($team_side);
    wp_reset_postdata();
?>
</div>
<div class="col-md-3 pull-right">
	<?php
    $team_side = get_field('team_right_column');
    
    // WP_Query arguments
    $args = array(
    	'post_type' => array('team'),
    	'post__in' =>  $team_side,
    );
    
    // The Query
    $query = new WP_Query($args);
    
    // The Loop
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post(); ?>
 			
		 	<?php $image = getFeaturedUrl(get_the_id()); 
		 	$image_url = aq_resize($image,100,100,true,true,true); ?>
		 	<?php debug($image_url); ?>
			<?php debug(get_the_title()); ?>
			<?php debug(get_field('job_title')); ?>
			<?php debug(get_field('phone')); ?>
			<?php debug(get_field('mobile')); ?>
			<?php debug(get_field('email')); ?>
			
         <?php
        }
    } 
    else {
        
        // no posts found
        
    }
    
    // Restore original Post Data
    unset($team_side);
    wp_reset_postdata();
?>
</div>
<div class="col-md-6">
	<?php
    the_content(); ?>
</div>




<?php
endwhile; ?>
