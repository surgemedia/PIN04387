<?php
/**
 * Template Name: Home
 */
?>
<script>
	

	/*===================================
=            Modal Video            =
===================================*/

video = {
  load : function(tag){
    console.log("load video "+tag);
    var id=jQuery("#"+tag).data("videocode");
    console.log("Loading Video");
    player = new YT.Player(tag, {
          // height: '1000',
          // width: '1500',
          videoId: id,
          events: {
            // 'onReady': onPlayerReady,
            // 'onStateChange': onPlayerStateChange
          }
        });
  }
  
};
 
function stopVideo() {
       player.stopVideo();
     }

 function modalVideo(){
    
    jQuery('#myModal').on('hidden.bs.modal', function (e) {
        stopVideo();
       console.log("Stop Video");
        
      });
  }
jQuery(document).ready(function(){    
	var delay=2000;
	setTimeout(function(){
		video.load('player');
		modalVideo();
	}, delay);
});
</script>
<?php while (have_posts()) : the_post(); ?>
<section id="featured" class="row">
	<div class="">
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
		 $image_url = aq_resize($image,960,470,true,true,true);
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

<?php /*  Dont delete because video is coming ?>
<section id="main-content" data-video-id="13wt6cmCRK0" class="row">
	<hgroup class="col-md-8 col-md-offset-2">
		<h1 class="text-center col-lg-12"><span class="thin">About</span> Pinnacle Properties</h1> 
	<p><?php the_content(); ?></p>
	<a href="/about/">Read More</a>
	</hgroup>
</section>
<?php */ ?>

<?php 
    	 $image = get_field('fallback_image');
		 $image_url = aq_resize($image,1920,730,true,true,true);
 ?>
<section id="main-content" class="row"  style="">
	<!-- <div class="bg-img" style="background-image:url('<?php echo $image_url ?>')"> -->
		<div class="pattern"></div>
				<hgroup class="col-md-8 col-md-offset-2">
					<h1 class="text-center col-lg-12"><span class="thin">About</span> Pinnacle Properties</h1> 
				
				<div class="content-hidden">
					<?php if(strlen(get_the_content()) > 0){ ?>
					<p><?php the_content(); ?></p>
					<?php } else { 
					$about_id = get_id_from_slug('about');
					$content = get_post_page_content($about_id); ?>
					<p> <?php truncate( $content ,50,'',true) ?>;</p> 
					<?php } ?>
					<a href="#" class="" data-toggle="modal" data-target="#myModal" onclick="">View Video</a>
				</div>
				<!-- Button trigger modal -->

				</hgroup>



		<img class="bg-img" src="<?php echo $image_url ?>" alt="bg-ground" height="auto" width="100%">
	<!-- </div> -->
</section>




<section id="contact-us">
<div class="row grey-bg">
  <div class="headshot col-lg-6 text-center">
  	<?php
  	$image = get_field('headshot');
	$image_url = aq_resize($image,840,770,true,true,false);
		  ?>
    <img class="img-responsive"  src="<?php echo $image_url; ?>" alt="">
    <div class="hgroup">
      <h1>
      	<strong><?php echo get_field('headshot_title'); ?></strong>
      	<span>/ <?php echo get_field('headshot_job_title'); ?></span>
      	<div><?php echo get_field('headshot_license_title'); ?></div>
      </h1>
      <a href="/contact-us/" class="contactus"><?php the_field('subheading') ?></a>
    </div>
  </div>
  <div class="form col-lg-6 grey-bg">
    <div id="gravity-form" class="col-lg-8 col-md-offset-2">
    <h3 class="other_title">Contact Us <span>Today</span></h3>
    <?php  
    $pageID = get_option('page_on_front'); 
   	if(get_field('form',$pageID)){

    displayGravityForm(get_field('form',$pageID));
	}
     ?>
    </div>
  </div>
  </div>
</section>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="stopVideo()"><i class="icon-close" aria-hidden="true"></i></button>
      	
      		          <div class="embed-container">			
        <div id="player" data-videocode="<?php echo getYtCode(get_field('video')); ?>"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php endwhile; ?>
