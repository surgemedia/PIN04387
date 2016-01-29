
<div class="container">
<?php if (!is_page_template('template-contact-us.php')): ?>
  <div id="email-marketing" class="col-md-6 col-md-offset-3">
  <?php
  // $testing = get_field('email_signup','option');
  // debug($testing);
    if(get_field('email_signup','option')){ ?>
    <?php  displayGravityForm(get_field('email_signup','option')); ?>
    <?php }; ?> 
    </div>
<?php endif ?>
  </div>
<div class="container">
<?php 
    $footer_list = get_field('contact_details','option');
 ?>
	 <ul class="info"> 
    <?php for ($i=0; $i < count($footer_list); $i++) { ?>
      <li>
          <span class="hidden-xs"> <?php echo $footer_list[$i]['label'];?></span>   
          <a href="<?php echo $footer_list[$i]['Clickable_link'];?>">
            <span class="hidden-xs"><?php echo $footer_list[$i]['value'];?></span>
            <span class="visible-xs-block"> <?php echo $footer_list[$i]['label'];?></span>
          </a>
      </li>
      
    <?php } ?>
    </ul>
</div>
<footer class="content-info" role="contentinfo">
  
  <div class="foot">
  	<span><?php the_field('footer_text','option') ?></span>
  </div>
  
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</footer>
