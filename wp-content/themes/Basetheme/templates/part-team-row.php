    <?php
    
    $team = get_field('team_row');
        
        // WP_Query arguments
        $args = array(
            'post_type' => array('team'),
            'post__in' =>  $team,
            'orderby' => 'post__in',
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
            <div class="col-sm-6 col-md-4 col-lg-3 side remove-padding">
            <div class="staff">
                <div class="staff-image">
                    <img src=<?php echo $image_url; ?> >
                    <span><?php echo $name; ?> <strong><?php echo $surname; ?></strong></span>
                </div>
                <div class="staff-info col-lg-12">
                    <div class="position">
                        <strong><?php the_field('job_title'); ?></strong>
                    </div>
                    <span>p: <?php the_field('phone'); ?></span>
                    <span>m: <?php the_field('mobile'); ?></span>
                    <div class="email"><?php the_field('email'); ?></div>
                    <a href="#modalItem_<?php echo get_the_ID();?>" data-toggle="modal" >More About <?php echo $name; ?></a>
                </div>
            </div>
            
           <div class="modal fade" id="modalItem_<?php echo get_the_ID();?>" role="dialog" aria-labelledby="gridSystemModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close"><i class="icon-close" aria-hidden="true"></i></a>
                    <div class="row">
                        <div class="col-lg-6">
                            <img src=<?php echo $image_url; ?> >
                        </div>
                        <div class="col-lg-6 agent-info">
                            
                            <div class="name">
                                <span><?php echo $name; ?> <strong><?php echo $surname; ?></strong></span>
                            </div>
                            <?php the_content(); ?>
                            
                            <div class="contact-info">
                                <span><strong>Phone: <?php the_field('phone'); ?></strong></span>
                                <span><strong>Mobile: <?php the_field('mobile'); ?></strong></span>
                                <div class="email"><strong>Email: <?php the_field('email'); ?></strong></div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
              </div>
 
            
         <?php
        }
    } 
    else {
        
        // no posts found
        
    }
    
    // Restore original Post Data
    
    wp_reset_postdata();
?>
 