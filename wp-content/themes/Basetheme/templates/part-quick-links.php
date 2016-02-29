<div class="quick-links">
    <h2>Quick Links</h2>
    <ul>
    <?php
        $quick_links_side = get_field('quick_links');
        
        // WP_Query arguments
        $args = array(
            'post_type' => array('page'),
            'post__in' =>  $quick_links_side,
            'orderby' => 'post__in',
         );
        
        // The Query
        $query = new WP_Query($args);
        
        // The Loop
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post(); ?>
                 <li>
             <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
             </li>
        
            
             <?php
            }
        } 
        else {
            
            // no posts found
            
        }
        
        // Restore original Post Data
        unset($quick_links_side);
        wp_reset_postdata();
        ?>
        </ul>
</div>