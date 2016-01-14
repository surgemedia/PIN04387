<?php
/*
* Template Name: Businesses Directory Archive
*/
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('epl-business-directory-archive'); ?>>
	<div class="entry-header epl-clearfix">
	
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail( 'medium' , array('class' => 'business-thumbnail')); ?>
			</div>
		<?php endif; ?>
		
		<h4 class="entry-title epl-clearfix"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	
	</div>
	<div class="entry-content epl-clearfix">
		<?php the_excerpt(); ?>
		
		<div class="entry-meta epl-clearfix">
			<div class="epl-business-categories"> <?php _e('Business Category :','epl'); echo epl_business_get_category_list(); ?></div>
		</div>
		
	</div>
</div>
<!-- end .post -->