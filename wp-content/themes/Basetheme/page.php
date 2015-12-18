<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
<div id="no-results" class="text-center">
	<h3>Sorry, there isn't any results for that search</h3>
	<p>try lowing including surrounding properties</p>
</div>