<section id="contact-us">
<div class="row">
  <div class="headshot col-lg-6">
    <img src="https://unsplash.it/960/700?image=832" alt="">
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
