<section class="search-feature col-lg-6 row">
        <?php
                            // WP_Query arguments
                        $args = array (
                            'post_type' => array( 'property' ),
                            'p' => get_field('featured_property')[0],
                            );
                        $query = new WP_Query( $args );
                        
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
        // debug(get_post_meta(get_the_id() ));?>
        <?php
                            // $the_property = get_post(get_the_id() );
                            $the_property = get_post();
                            $the_property_meta = get_post_meta(get_the_id() );
        ?>
        <div class="col-sm-6">
            <?php
                                        $image = getFeaturedUrl(get_the_id());
                                        $image_url = aq_resize($image,960,621,true,true,true);
            ?>
            <div class="img">
                <img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
            </div>
            <h1 class="title"><strong>Property</strong> of the week</h1>
        </div>
        <div class="col-sm-6 ">
            <div class="property-obj">
                <div class="suburb"><?php echo $the_property_meta['property_address_suburb'][0]; ?></div>
                <div class="street">
                    <?php echo $the_property_meta['property_address_street_number'][0]; ?> &nbsp;
                    <?php echo $the_property_meta['property_address_street'][0]; ?>
                </div>
                <ul>
                    <li><i class="icon-BED" data-toggle="tooltip" data-placement="top" title="Bed"></i>
                        <span><?php echo $the_property_meta['property_bedrooms'][0]; ?></span>
                    </li>
                    <li><i class="icon-BATH" data-toggle="tooltip" data-placement="top" title="Bath"></i>
                        <span><?php echo $the_property_meta['property_bathrooms'][0]; ?></span>
                    </li>
                    <li><i class="icon-CAR" data-toggle="tooltip" data-placement="top" title="Car"></i>
                        <span><?php echo $the_property_meta['property_garage'][0]; ?></span>
                    </li>
                </ul>

                <a href="<?php echo $the_property->guid; ?>" class="details">Details</a>
            </div>
        </div>

        <?php    }
                        } else {
                            // no posts found
                        }
            
        wp_reset_postdata(); ?>

        <section>
        </div>

    </section>