<section id="jumbotron" class="container-fluid">
	<div class="row">
	<?php 
		 $image = getFeaturedUrl(get_the_id()); 
		 $image_url = aq_resize($image,960,621,true,true,true);
		 debug($image_url);
	?>
	<?php 
		// debug(get_post());
		$the_property = get_post(get_the_id()) ; 
		$the_property_meta = get_post_meta(get_the_id()) ; 
		
		
	 ?>
</div>
</section>
<section class="container-fluid">
	<div class="col-lg-3">
		<?php debug(get_the_title()); ?>
		<?php  echo $the_property_meta['property_bedrooms'][0]; ?>
		<?php  echo $the_property_meta['property_bathrooms'][0]; ?>
		<?php  echo $the_property_meta['property_carport'][0]; ?>
		<?php debug($the_property); ?>
		<?php  debug($the_property->post_content); ?>
		<?php  debug(get_the_permalink()); ?>

	</div>
	<div class="col-lg-6">
		<h1> <?php $the_property_meta['property_heading'][0] ?></h1>
	</div>
	<div class="col-lg-3"></div>
</section>

