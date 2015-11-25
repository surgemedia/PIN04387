    <?php
    /**
     *
     * $agentID
     *
     */
    
    
    // WP_Query arguments
    $args = array(
        'post_type' => array('team'),
        'meta_query' => array(
                array(
                    'key'       => 'real_state_id',
                    'value'     => $agentID,
                ),
            ),
        
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
                    <span>AGENT</span>
                </div>
                <ul>
                    <li><strong><p><?php the_title(); ?></p></strong></li>
                    <li><p>p: <?php the_field('phone'); ?></p></li>
                    <li><p>m: <?php the_field('mobile'); ?></p></li>
                    <li><p><?php the_field('email'); ?></p></li>
                    <li><a href="mailto:<?php the_field('email'); ?>">EMAIL AGENT</a></li>
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