<?php 
$the_property = get_post(get_the_id() );
$the_property_meta = get_post_meta(get_the_id() );
 ?>
<div class="col-lg-6 featured">
	<?php 
		 $image = getFeaturedUrl(get_the_id()); 
		 $image_url = aq_resize($image,960,621,true,true,true);
	?>
	<img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>">
    <!-- <img src="https://unsplash.it/960/730/?random" alt="" > -->
        <h1 class="title"><strong>Propery</strong> of the week</h1>
        <div class="property-obj">
            <span><?php the_title(); ?></span>
            <ul>
                <li><a href=""><i class="icon bed">bed</i><span><?php echo $the_property_meta['property_bedrooms'][0]; ?></span></a></li>
                <li><a href=""><i class="icon bath">bath</i><span><?php echo $the_property_meta['property_bathrooms'][0]; ?></span></a></li>
                <li><a href=""><i class="icon car">car</i><span><?php echo $the_property_meta['property_carport'][0]; ?></span></a></li>
            </ul>
            <a href="" class="details">Details</a>

        </div>
    </div>
