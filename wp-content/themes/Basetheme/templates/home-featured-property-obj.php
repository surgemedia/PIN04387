<?php 
// $the_property = get_post(get_the_id() );
$the_property_meta = get_post_meta(get_the_id() );
 ?>
<div class="col-lg-6 featured">
	<?php 
		 $image = getFeaturedUrl(get_the_id()); 
		 $image_url = aq_resize($image,960,621,true,true,true);
	?>
	<img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
        <h1 class="title"><strong>Property</strong> of the week</h1>
        <div class="property-obj">
            <span><?php the_title(); ?></span>
            <ul>
                <li><i class="icon-BED"></i>
                        <span><?php echo $the_property_meta['property_bedrooms'][0]; ?></span>
                    </li>
                    <li><i class="icon-BATH"></i>
                        <span><?php echo $the_property_meta['property_bathrooms'][0]; ?></span>
                    </li>
                    <li><i class="icon-CAR"></i>
                        <span><?php echo $the_property_meta['property_garage'][0]; ?></span>
                    </li>
            </ul>
            <a href="" class="details">Details</a>

        </div>
    </div>
