<?php
/*
Template Name: Business Directory
*/
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- title, meta, and date info -->
	<div class="entry-header clearfix">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</div>
	
	<!-- post content -->
	<div class="entry-content clearfix">
		<?php the_content(); ?>
		
		<h4><?php _e( 'Businesses by Type', 'epl' ); ?></h4>
		<ul>
			<?php wp_list_categories( 'taxonomy=business-category&depth=0' ); ?>
		</ul>
	</div>
</div>