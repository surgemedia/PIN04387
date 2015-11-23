    <?php
    $team_side = get_field($team_side_column);
    
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
            $image_url = aq_resize($image,400,400,true,true,true); 
            $full_name=explode(" ", get_the_title());
            $name=$full_name[0];
            $surname=$full_name[1]?>
            <div class="staff">
                <div class="staff-image">
                    <img src=<?php echo $image_url; ?> >
                    <span><?php echo $name; ?> <strong><?php echo $surname; ?></strong></span>
                </div>
                <ul>
                    <li><strong><?php the_field('job_title'); ?></strong></li>
                    <li>p: <?php the_field('phone'); ?></li>
                    <li>m: <?php the_field('mobile'); ?></li>
                    <li><?php the_field('email'); ?></li>
                    <li><a href="<?php the_permalink(); ?>">More About <?php echo $name; ?></a></li>
                </ul>
            </div>
            
            
            
            
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