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
                    <li><a href="#modalItem_<?php echo get_the_ID();?>" data-toggle="modal" >More About <?php echo $name; ?></a></li>
                </ul>
            </div>
            
           <div class="modal fade" id="modalItem_<?php echo get_the_ID();?>" role="dialog" aria-labelledby="gridSystemModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    
                     
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close"><span class="sharpe-icon-close2" aria-hidden="true"></span></a>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src=<?php echo $image_url; ?> >
                        </div>
                        <div class="col-lg-6">
                            
                            <span><?php echo $name; ?> <strong><?php echo $surname; ?></strong></span>
                            <?php the_content(); ?>
                            <ul class="">
                                <li>p: <?php the_field('phone'); ?></li>
                                <li>m: <?php the_field('mobile'); ?></li>
                            </ul>
                            <div><?php the_field('email'); ?></div>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
              
 
            
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