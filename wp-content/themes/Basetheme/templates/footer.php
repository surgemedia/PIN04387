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
    <?php  displayGravityForm(get_field('form')); ?>
    </div>
  </div>
  </div>
</section>
<footer class="content-info" role="contentinfo">
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
  <div class="foot">
  	<span><?php the_field('footer_text','option') ?></span>
  </div>
</footer>
