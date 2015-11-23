<?php
/*
* Single Business Directory
*/
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-business-directory' ); ?>>
	<div class="entry-header epl-clearfix">
	
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail( 'medium' , array('class' => 'business-thumbnail')); ?>
			</div>
		<?php endif; ?>
		
		<h1 class="entry-title epl-clearfix"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	
		<div class="entry-meta epl-clearfix">
			<div class="epl-business-categories"> <?php _e('Business Category :','epl'); echo epl_business_get_category_list(); ?></div>
		</div>
	</div>
	<div class="entry-content epl-clearfix">
		<?php the_content(); ?>
		
		<div class="epl-tab-section business-details">
			<h5 class="tab-title"><?php _e('Business Details','epl') ?></h5>
			
			<div class="tab-content">
				<?php if( epl_business_get_meta('epl_bd_website') != '') : ?>
					<?php echo '<div class="epl-business-website">
									<a href="', epl_business_get_meta('epl_bd_website'), '">', epl_business_get_meta('epl_bd_website'),'</a></div>'; ?>
			<?php endif; ?>
			
			<?php if( epl_business_get_meta('epl_bd_phone') != '') : ?>
					<?php echo '<div class="epl-business-phone">', epl_business_get_meta('epl_bd_phone'), '</div>'; ?>
			<?php endif; ?>		
			</div>
		</div>
	</div>
</div>