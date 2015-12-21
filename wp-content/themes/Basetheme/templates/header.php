<header class="banner <?php if(is_front_page()){ echo "home"; }?>" role="banner">
  <div class="container-fluid">
    <div class="logo-wrap">
      <a class="brand" href="<?= esc_url(home_url('/')); ?>">
        <img src="<?php the_field("logo","option") ?>" alt="<?php bloginfo('name'); ?>">
      </a>
    </div>
    <div class="menu-wrap">
      <nav role="navigation" class="text-right">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
        endif;
        ?>
      </nav>
    </div>
  </div>
</header>
