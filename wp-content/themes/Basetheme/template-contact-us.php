<?php
/**
 * Template Name: Contact Us Template
 */
?>
<div class="row"><?php while (have_posts()) : the_post(); ?>
	
	<?php 
		$extraClass="small";
		$image=getFeaturedUrl(get_the_id());
		$preTitle="";
		$title=get_the_title();
		$postTitle="";
		include(locate_template('templates/part-jumbotron.php')); ?>
		
	<div class="col-xs-12 col-md-6 col-md-push-3 general-content">
		<?php the_content(); ?>
	
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
	          <?php echo $footer_list[$i]['label'];?> 
	          <a href="<?php echo $footer_list[$i]['Clickable_link'];?>">
	            <?php echo $footer_list[$i]['value'];?>
	          </a>
	      </li>
	      
	    <?php } ?>
	    </ul>
	
			</div>
	
			<div class="acf-map">
				<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
			</div>
			<?php endif; ?>
	
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