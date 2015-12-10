
<?php
		
		$the_property = get_post(get_the_id()) ;
		$the_property_meta = get_post_meta(get_the_id()) ;


	 ?>
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
<div class="customPrevBtn"><i class="icon-arrow-left"></i></div>
<div class="customNextBtn"><i class="icon-arrow-right"></i></div>
<?php if ($the_property_meta['property_status'][0]=='sold'):?>
	<div class="testimonial">
		<div class="content">
			“I just want to say a belated thanks to the team at Pinnacle Properties and to recommend their service to anyone looking to sell their property! It was an absolute pleasure selling my house  with Von. She is always very prompt, positive and helpful.”

		</div>
			<div class="author">
				Martin Shane
			</div>
	</div>


<?php endif; ?>
  	


<div class="col-xs-12 col-md-6 col-md-push-3 general-content">
	<?php  echo str_replace("\r", "<br />", $the_property->post_content); ?>

<!-- 	<?php debug($the_property); ?>
<?php debug($the_property_meta); ?> -->
</div>
<div class="col-sm-6 col-md-3 col-md-pull-6 side">
	<div class="property-info">
		<div class="address">
			<div class="suburb"><?php echo $the_property_meta['property_address_suburb'][0]; ?></div>
      <div class="street">
          <?php echo $the_property_meta['property_address_street_number'][0]; ?> &nbsp;
          <?php echo $the_property_meta['property_address_street'][0]; ?>
      </div>
		</div>

		<i class="icon-BED"><?php echo $the_property_meta['property_bedrooms'][0]; ?></i>
		<i class="icon-BATH"><?php echo $the_property_meta['property_bathrooms'][0]; ?></i>
		<i class="icon-CAR"><?php echo $the_property_meta['property_garage'][0]; ?></i>

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
		     <div class="box"><?php echo $the_property_meta['property_inspection_times'][0]; ?></div>
			</li>
			<li>
			   <i class="icon-save-to-calendar"></i>
			   <a href="">Save to Calendar</a>
			</li>
	    <li>
	       <i class="icon-google-icon"></i>
				 <a href="https://www.google.com/calendar/render?action=TEMPLATE&text=<?php the_title();?>&dates=<?php echo $the_property_meta['property_inspection_times'][0]; ?>/20140320T221500Z&details=For+details,+link+here:+http://www.example.com&location=Waldorf+Astoria,+301+Park+Ave+,+New+York,+NY+10022&sf=true&output=xml">Save to Google Calendar</a>
			</li>
		</ul>
</div>

		<div class="social-links">
			<ul>
				<li>
					<i class="icon-send-to-a-friend"></i>
					<a class="mailLink" href="">Send to a Friend</a>
				</li>
				<li>
					<i class="icon-facebook"></i>
					<a class="fbLink" href="">Share this property</a>
				</li>
				<li>
					<i class="icon-twitter"></i>
					<a class="twLink" href="">Share this property</a>
				</li>
			</ul>
		</div>
</div>