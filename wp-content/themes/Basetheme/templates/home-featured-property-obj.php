<?php 
// $the_property = get_post(get_the_id() );
$the_property_meta = get_post_meta(get_the_id() );
//debug($the_property_meta);
 ?>
 
<div class="col-lg-6 featured">
	<?php 
		 $image = getFeaturedUrl(get_the_id()); 
		 $image_url = aq_resize($image,960,621,true,true,true);
	?>
	<div class="image" style="background-image:url('<?php echo $image_url; ?>')" ></div>
        <h1 class="title"><strong>Property</strong> of the week</h1>
        <div class="property-obj">
            <span><?php the_title(); ?></span>
            <ul>
                <li><i class="icon-BED" data-toggle="tooltip" data-placement="top" title="Bed"></i>
                        <span><?php echo $the_property_meta['property_bedrooms'][0]; ?></span>
                    </li>
                    <li><i class="icon-BATH" data-toggle="tooltip" data-placement="top" title="Bath"></i>
                        <span><?php echo $the_property_meta['property_bathrooms'][0]; ?></span>
                    </li>
                    <li><i class="icon-CAR" data-toggle="tooltip" data-placement="top" title="Car"></i>
                        <span><?php echo $the_property_meta['property_carport'][0]+$the_property_meta['property_garage'][0]; ?></span>
                    </li>
            </ul>
            <a href="<?php the_permalink()?>" class="details">Details</a>
            <div class="row">
                <div class="col-lg-12 text-right"><a href="/property-search/" class="all-properties"><i class="icon-list"></i>ALL LISTED PROPERTIES</a></div>
            </div>
        </div>
    </div>
