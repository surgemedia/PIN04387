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
    <?php $hidden = ("Fax:"==$footer_list[$i]['label']) ? "hidden-xs no-padding" : "" ;?>
    <li class="<?php echo $hidden; ?>">
      <span class="hidden-xs"> <?php echo $footer_list[$i]['label'];?></span>
      <a  href="<?php echo $footer_list[$i]['Clickable_link'];?>">
        <span class="hidden-xs"><?php echo $footer_list[$i]['value'];?></span>
        <span class="visible-xs-block"> <?php echo str_replace(":", "", $footer_list[$i]['label']);?></span>
      </a>
    </li>
    
    <?php } ?>
  </ul>
</div>
<footer class="content-info" role="contentinfo">
  
  <!-- <div class="foot">
    <span><?php the_field('footer_text','option') ?></span>
  </div> -->
  <div class="foot">
    <span class="col-xs-12 col-sm-6 col-md-3"><?php
            if (has_nav_menu('footer-menu')) :
              wp_nav_menu(['theme_location' => 'footer-menu', 'menu_class' => 'footer-nav']);
            endif;
            ?></span>
    
    
    <span class="col-xs-12 col-sm-6 col-md-3 col-md-push-6">
      
      <?php

      // check if the repeater field has rows of data
      if( have_rows('social_media','option') ):
          
        // loop through the rows of data
          while ( have_rows('social_media','option') ) : the_row();
              
              if (get_sub_field('visible')) : 
                  $icon=get_sub_field('name');
                //if("facebook"==get_sub_field('name')){ $icon="fb";}
                //if("twitter"==get_sub_field('name')){ $icon="tw";}?>
                  
                  <a href="<?php echo get_sub_field('url');?>" target="_blank" class="">
                    <i class="icon-<?php echo $icon?>"></i>
                  </a>
      <?php   endif;
          endwhile;

      else :

          // no rows found

      endif;

      ?>
    </span>

    <span class="col-lg-6 col-sm-12 col-md-6 col-md-pull-3"><?php echo date('Y'); ?> © Pinnacle Properties Queensland</span>

  </div>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-72650017-1', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> -->
  </footer>