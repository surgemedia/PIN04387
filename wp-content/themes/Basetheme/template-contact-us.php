<?php
/**
 * Template Name: Contact Us
 */
?>
<div class="row contactus"><?php while (have_posts()) : the_post(); ?>
	
	<?php 
		$extraClass=get_field("jumbotron_size");
		$image=getFeaturedUrl(get_the_id());
		$preTitle=get_field("light");
		$title="<b>".get_field("bold")."</b>";
		$postTitle=("small"!==get_field("jumbotron_size")) ? get_field("light2") : "";
		include(locate_template('templates/part-jumbotron.php')); ?>
		
	<div class="col-xs-12 col-md-6 col-md-push-3 general-content">
		<?php the_content(); ?>
	 <div id="gravity-form" class="">
    <?php  
    $pageID = get_option('page_on_front'); 
   	if(get_field('form',$pageID)){

    displayGravityForm(get_field('form',$pageID));
	}
     ?>
    </div>
		<?php 
	
			$location = get_field('map_location','option');
			
			if( !empty($location) ):
			?>
	
			<div class="contact-location">
				<p>Address: <?php echo $location[address]?></p>
			 <?php 
	    			$footer_list = get_field('contact_details','option');?>
	
			<ul class="info"> 
	    	<?php for ($i=0; $i < count($footer_list); $i++) { ?>
	      <li>
	          <span class="hidden-xs"><?php echo $footer_list[$i]['label'];?> </span>
	          <a href="tel:<?php echo $footer_list[$i]['Clickable_link'];?>">
	            <span class="hidden-xs"><?php echo $footer_list[$i]['value'];?></span>
            <span class="visible-xs-block"> <?php echo $footer_list[$i]['label'];?></span>
	          </a>
	      </li>
	      
	    <?php } ?>
	    </ul>
	
			</div>
	
			<div class="acf-map">
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
			</div>
			<?php endif; ?>
		
<div class="social row">
	<div class="col-xs-12 col-sm-8 col-md-12 col-lg-8"><?php
		  // $testing = get_field('email_signup','option');
		  // debug($testing);
		    if(get_field('email_signup','option')){ ?>
		    <?php  displayGravityForm(get_field('email_signup','option')); ?>
		    <?php }; ?> </div>
	<div class="col-xs-12 col-sm-4 col-md-12 col-lg-4">
			<div class="followus">
				<h3>Follow Us</h3>
				<ul>
					<li>
						<a class="fbLink" href=""><i class="icon-facebook"></i></a>
					</li>
					<li>
						<a class="twLink" href=""><i class="icon-twitter"></i></a>
					</li>
				</ul>
			</div>
	</div>

</div>

	<!-- <div class="bg_grey visible-lg"> </div> -->
	</div>
	<div class="col-sm-6 col-md-3 col-md-pull-6 side">
		<?php 
	    
	    $team_side_column="team_left_column";
	    include(locate_template('templates/part-team-side.php')); ?>
	</div>
	<div class="col-sm-6 col-md-3 side">
	    <?php 
	    
	    $team_side_column="team_right_column";
	    include(locate_template('templates/part-team-side.php')); ?>
	</div>
	
	
	
	
	
	
	<?php endwhile; ?></div>