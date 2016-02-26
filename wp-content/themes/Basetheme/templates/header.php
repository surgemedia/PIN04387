<header class="banner <?php if(is_front_page()){ echo "home"; }?>" role="banner">
  <div class="container-fluid">
    <div class="logo-wrap">
      <a class="brand" href="<?= esc_url(home_url('/')); ?>">
        <img title="Pinnacle Properties - Everything we touch turns to.. SOLD" src="<?php the_field("logo","option") ?>" alt="Pinnacle Properties - Everything we touch turns to.. SOLD">
      </a>
    </div>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>

    

    <div class="menu-wrap">
      <nav role="navigation" class="text-right">
           <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <?php
            if (has_nav_menu('primary_navigation')) :
              wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
            endif;
            ?>
          
            <section class="follow-us visible-xs-block visible-sm-block">
              <h1>Follow Us</h1>
              <ul>
                <li class="col-xs-6"><a class="fbLink" href=""><i class="icon-facebook"></i></a></li>
                <li class="col-xs-6"><a class="twLink" href=""><i class="icon-twitter"></i></a></li>
              </ul>
            </section>
        </div><!-- /.navbar-collapse-->
       
      </nav>
    </div>
  </div>
</header>
