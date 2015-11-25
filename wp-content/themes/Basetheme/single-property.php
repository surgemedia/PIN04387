
<!-- <section id="jumbotron" class="container-fluid">
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
		<?php  echo $the_property->post_content; ?>
		<?php  debug($the_property->post_content); ?>
		<?php  debug(get_the_permalink()); ?>

	</div>
	<div class="col-lg-6">
		<h1> <?php $the_property_meta['property_heading'][0] ?></h1>
	</div>
	<div class="col-lg-3"></div>
</section> -->
<div class="owl-carousel">

<?php  $gallery = explode( ',', $the_property_meta['epl_slides_order'][0] );


			foreach ($gallery as $index => $image_id): ?>

	   <div class="wrap"
	   			>
<img  style='background-image:url(<?php  $feat_image = wp_get_attachment_url($image_id);
	                            echo $feat_image;?>)' alt="" >
	                            </div>
	<?	endforeach;
				?>




</div>

  	<!-- <div class="custom-nav row">
        <div class="col-xs-6">
          <div class="customPrevBtn">PREVIOUS</div>
        </div>
        <div class="col-xs-6">
          <div class="customNextBtn">NEXT</div>
        </div>
      </div> 

<?php debug($the_property); ?>
<?php debug($the_property_meta); ?>-->
<div class="col-xs-12 col-md-6 col-md-push-3 general-content">
	<?php  echo $the_property->post_content; ?>
</div>
<div class="col-sm-6 col-md-3 col-md-pull-6 side">
	<div class="property-info">
		<div class="address">
		 <?php the_title(); ?>
		</div>
		<i class="glyphicon glyphicon-envelope"><div><?php echo $the_property_meta['property_bedrooms'][0]; ?></div></i>
		<i class="glyphicon glyphicon-cloud"><div><?php echo $the_property_meta['property_bathrooms'][0]; ?></div></i>
		<i class="glyphicon glyphicon-pencil"><div><?php echo $the_property_meta['property_carport'][0]; ?></div></i>

		<div class="price">
			<?php  echo $the_property->property_price_view; ?>
		</div>

	</div>

			<div class="map">
				<?php 
					$location = explode( ',', $the_property_meta['property_address_coordinates'][0]);

					if( !empty($location) ):
					?>
					<div class="acf-map">
						<div class="marker" data-lat="<?php echo $location[0]; ?>" data-lng="<?php echo $location[1]; ?>"></div>
					</div>
				<?php endif; ?>
				<div class="button-map">
					<a href="">Enlarge MAP</a>
					<a href="">Street view</a>
				</div>


			</div>
</div>


<div class="col-sm-6 col-md-3 side">
    <?php

    $agentID="123asd";
    include(locate_template('templates/part-agent-side.php')); ?>

<div class="inspection">
		<ul>
		  <li>
		     <strong>Open for inspection Times</strong>
		  </li>
		  <li>
		     <div class="box">31 December 2015</div>
			</li>
			<li>
			   <i class="glyphicon glyphicon-cloud"></i>
			   <a href="">Save to Calendar</a>
			</li>
	    <li>
	       <i class="glyphicon glyphicon-pencil"></i>
				 <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?php the_title();?>&dates=<?php echo $the_property_meta['property_inspection_times'][0]; ?>/20140320T221500Z&details=For+details,+link+here:+http://www.example.com&location=Waldorf+Astoria,+301+Park+Ave+,+New+York,+NY+10022&sf=true&output=xml">Save to Google Calendar</a>
			</li>
		</ul>
</div>

		<div class="social-links">
			<ul>
				<li>
					<i class="glyphicon glyphicon-cloud"></i>
					<a class="mailLink" href="">Send to a Friend</a>
				</li>
				<li>
					<i class="glyphicon glyphicon-pencil"></i>
					<a class="fbLink" href="">Share this property</a>
				</li>
				<li>
					<i class="glyphicon glyphicon-envelope"></i>
					<a class="twLink" href="">Share this property</a>
				</li>
			</ul>
		</div>
</div>
