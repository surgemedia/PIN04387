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
        <?php

        // check if the flexible content field has rows of data
        if( have_rows('external_links') ):

             // loop through the rows of data
            while ( have_rows('external_links') ) : the_row();

                if( get_row_layout() == 'external_url' ):?>

                <li>
                <a href="<?php echo get_sub_field('url') ?>" target="_blank"><?php the_sub_field('name'); ?></a>
                 </li>

        <?php   elseif( get_row_layout() == 'file_link' ): ?>

                <li>
                <a href="<?php echo get_sub_field('link') ?>" target="_blank"><?php the_sub_field('name'); ?></a>
                </li>

        <?php   endif;

            endwhile;

        else :

            // no layouts found

        endif;
        
        ?>
        </ul>
</div>