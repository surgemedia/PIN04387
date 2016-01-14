<div class="row">
<?php
		
		$the_property = get_post(get_the_id()) ;
		$the_property_meta = get_post_meta(get_the_id()) ;
		// debug($the_property);
		// debug($the_property_meta);


	 ?>
<div class="owl-carousel">

<?php
 $gallery =  get_attached_media( 'image' );
			foreach ($gallery as $index => $image_id): ?>

	   <div class="wrap">
	   <?php //debug($image_id); ?>
<img  style='background-image:url(<?php  $feat_image = wp_get_attachment_url($image_id->ID);
	                            echo $feat_image;?>)' alt="" >
	                            </div>
	<?	endforeach; ?>
</div>
<div class="customPrevBtn"><i class="icon-arrow-left"></i></div>
<div class="customNextBtn"><i class="icon-arrow-right"></i></div>
<?php if ($the_property_meta['property_status'][0]=='sold'):?>
	<?php $compare_id = get_the_id(); 
	// debug($compare_id); ?>
		
			<?php 
		$args = array (
	'post_type'              => array( 'testimonial' ),
);

$query_quote = new WP_Query($args);

// The Loop
if ( $query_quote->have_posts() ) {
	while ( $query_quote->have_posts() ) {
		$query_quote->the_post(); ?>
	<?php if(get_field('select_property')[0]  == $compare_id ) { ?>
	<div class="testimonial">
			<div class="content">
				<?php echo  '"'.get_the_content().'"'; ?>
			</div>	
			<div class="author">
				<?php the_field('name') ?>
			</div>
	</div>
	<?php } ?>
<?php

	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata(); ?>	
<?php endif; ?>
  	


<div class="col-xs-12 col-md-6 col-md-push-3 general-content">
	<a href="" class="back" ><i class="icon-arrow-left"></i> BACK TO SEARCH RESULTS</a>
	<?php echo wpautop( $the_property->post_content); ?> 
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

		<i class="icon-BED" data-toggle="tooltip" data-placement="top" title="Bed"><?php echo $the_property_meta['property_bedrooms'][0]; ?></i>
		<i class="icon-BATH" data-toggle="tooltip" data-placement="top" title="Bath"><?php echo $the_property_meta['property_bathrooms'][0]; ?></i>
		<i class="icon-CAR" data-toggle="tooltip" data-placement="top" title="Car"><?php echo $the_property_meta['property_garage'][0]; ?></i>

		<div class="price">
		<?php
		// debug($the_property_meta);
		$end_price;
		 switch ($the_property->post_type) {
			case 'property':
				$end_price = $the_property->property_price_view;
				break;
			case 'rental':
				$end_price = $the_property->property_rent_view;
				break;
			default:
				$end_price = $the_property->property_price_view;
				break;
		} ?>
			<?php  echo $end_price ?>
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
					<a target="_blank" href="http://maps.google.com/?q=<?php echo $location[0]; ?>,<?php echo $location[1]; ?>">Enlarge MAP</a>
					<a target="_blank" href="http://maps.google.com/?q=<?php echo $location[0]; ?>,<?php echo $location[1]; ?>&layer=c&cbll=<?php echo $location[0]; ?>,<?php echo $location[1]; ?>">Street view</a>
				</div>


			</div>
</div>


<div class="col-sm-6 col-md-3 side">
    <?php
    // $the_property_meta
    $agentID= $the_property_meta['property_agent'];
    include(locate_template('templates/part-agent-side.php')); ?>

<div class="inspection">
<!-- <link href="http://addtocalendar.com/atc/1.5/atc-style-blue.css" rel="stylesheet" type="text/css"> -->

		<ul>
		  <li>
		     <strong>Open for inspection Times</strong>
		  </li>
		  <li>
		     <div class="box"><?php echo $the_property_meta['property_inspection_times'][0]; ?></div>
			</li>

			<li>
			   <i class="icon-save-to-calendar"></i>
			   <a id="ical" href="">Save to Calendar</a>
			</li>
	  <li>
	       <i class="icon-google-icon"></i>
				 <a id="gcal" href="#">Save to Google Calendar</a>
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
</div>
<script type="text/javascript">(function () {
            if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
            if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
                s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
                var h = d[g]('body')[0];h.appendChild(s); }})();
    </script>
    <!-- 3. Place event data -->
    <?php

    $the_date = explode('to',$the_property_meta['property_inspection_times'][0]);
   	$start_time = explode(' ',$the_property_meta['property_inspection_times'][0]);
   	$end_time = $start_time[3];

   	$final_data = date("d-m-Y", strtotime($the_date[0]));
   	$start_time = date("H:i", strtotime($start_time[1]));
   	$end_time =  date("H:i", strtotime($end_time));
   

    // debug($final_time)
     ?>
    <span class="hidden addtocalendar atc-style-blue">
        <var class="atc_event">
        <?php //debug($final_data.' '.$end_time); ?>
            <var class="atc_date_start"><?php echo $final_data.' '.$start_time; ?></var>
            <var class="atc_date_end"><?php echo $final_data.' '.$end_time; ?></var>
            <var class="atc_timezone">Australia/Brisbane</var>
            <var class="atc_title">Inspection <?php the_title(); ?></var>
            <var class="atc_description">Inspections <?php $the_property_meta['property_inspection_times'][0] ?> </var>
            <var class="atc_location"><?php the_title(); ?></var>
            <var class="atc_organizer">Pinnacle Properties</var>
            <var class="atc_organizer_email">info@pinnacleproperties.com.au</var>
        </var>
    </span>
    <script>
  jQuery(document).ready(function($) {
   	setTimeout(function(){
			var ical = jQuery('.atcb-item-link')[0].href;
			var gcal = jQuery('.atcb-item-link')[1].href;

			jQuery('#ical').attr('href',ical); 
			jQuery('#gcal').attr('href',gcal);
		}, 2000);
	  });
	</script>