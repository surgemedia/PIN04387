<?php
/**
 * Template Name: Home Template
 */
?>
<?php while (have_posts()) : the_post(); ?>
<section id="featured" class="row">
	<div class="row">
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
					// debug(get_post_meta(get_the_id() ));
					include(locate_template('templates/home-featured-property-obj.php'));
				}
			} else {
				// no posts found
			}

			wp_reset_postdata(); ?>
		<?php 
	if(get_field('side_blocks')): ?>
    <?php while(the_repeater_field('side_blocks')): ?>
    	<?php 
    	 $image = get_sub_field('image');
		 $image_url = aq_resize($image,960,730,true,true,true);
		  ?>
		<div class="col-lg-6 side-block" style="background-image:url(<?php echo $image_url ?>);">
			
			<span class=" overlay">

						<a href="<?php the_sub_field('title_link'); ?>">
						<?php 
							$sideblocks_title = explode(' ',get_sub_field('title'));
							// debug($sideblocks_title);
						 ?>
						<?php
							echo $sideblocks_title[0];
							echo '<strong> '.$sideblocks_title[1].'</strong>';

						 ?></a>

				</span>
		
		</div>
    <?php endwhile; ?>

 <?php endif; ?>
		
		
</div>

</section>
<section id="main-content" data-video-id="13wt6cmCRK0" class="row">
	<hgroup>
		<h1 class="text-center col-lg-12"><span class="thin">About</span> Pinnacle Properties</h1> 
	</hgroup>
</section>


<section id="contact-us">
<div class="row">
  <div class="headshot col-lg-6">
    <img width="78%" src="http://localhost/PinnacleProperties/wp-content/uploads/2015/11/VON-400x400.png" alt="">
    <div class="hgroup">
      <h1><strong></strong><span></span></h1>
      <a href="" class="contactus"></a>
    </div>
  </div>
  <div class="form col-lg-6 grey-bg">
    <div id="gravity-form" class="col-lg-8 col-md-offset-2">

    <?php  
    $pageID = get_option('page_on_front'); 
    displayGravityForm(get_field('form',$pageID));

     ?>
    </div>
  </div>
  </div>
</section>
<div class="container">
  <?php debug(get_field('mailchimp','option')) ?>
		<?php  displayGravityForm(); ?>
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
<?php endwhile; ?>
