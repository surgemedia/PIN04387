<footer class="content-info" role="contentinfo">
  <div class="container">
  <?php debug(get_field('mailchimp','option')) ?>
		<?php  displayGravityForm(); ?>
    <?php 
    $footer_list = get_field('contact_details','option');

    for ($i=0; $i < count($footer_list); $i++) { 
    	debug($footer_list[$i]);
    }
     ?>

  </div>
  <div class="foot">
  	<?php the_field('footer_text','option') ?>
  </div>
</footer>
