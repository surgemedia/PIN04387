<div id="post-<?php the_ID(); ?>" <?php post_class( 'epl-brochure epl-brochure-default' ); ?>>

	<div class="entry-content epl-content epl-clearfix">
		
		<div class="epl-brochure-left">
			<?php do_action( 'epl_property_featured_image' ); ?>
			
			<div class="epl-brochure-listing-details epl-clearfix">
			
				<div class="epl-brochure-property-details">
					<?php do_action('epl_property_before_title'); ?>
					<h1 class="entry-title">
						<?php do_action('epl_property_title'); ?>
					</h1>
					<?php do_action('epl_property_after_title'); ?>
				</div>

				<div class="entry-col property-pricing-details">
					<?php do_action('epl_property_price_before'); ?>
					<div class="property-meta pricing">
						<?php do_action('epl_property_price'); ?>
					</div>
					<?php do_action('epl_property_price_after'); ?>
				</div>
			</div>
			
			<!--<h3 class="secondary-heading"><?php //do_action('epl_property_secondary_heading'); ?></h3>-->
			
			<div class="epl-brochure-left">
				<div class="epl-brochure-content">
					<h2 class="entry-title"><?php do_action('epl_property_heading'); ?></h2>
					
					<?php do_action('epl_property_content_before'); ?>
					<?php the_content(); ?>
					<?php // do_action('epl_property_content_after'); ?>
					
					<?php do_action('epl_property_tab_section_before'); ?>
					
					<?php // do_action('epl_property_tab_section_after'); ?>
				</div>
			</div>
	
			<div class="epl-brochure-right">

				<div class="entry-col property-other-details">
					<?php do_action('epl_property_available_dates'); // rental only ?>
					<?php do_action('epl_property_inspection_times'); ?>
							
					<?php do_action('epl_property_land_category'); ?>
					<?php // do_action('epl_property_price_content'); ?>
					<?php do_action('epl_property_commercial_category'); ?>
				</div>
				
				<div class="epl-brochure-features">
					<?php do_action('epl_property_tab_section'); ?>
				</div>
			</div>

		</div>

		<div class="epl-brochure-right">
		
		<div class="epl-brochure-attached-images">
				<?php epl_br_attachment_images(  ); ?>
			</div>
			
			<div class="epl-brochure-map">
				<?php do_action( 'epl_property_map' ); ?>
			</div>
		
			

			<?php do_action( 'epl_br_author_details' ); ?>
			
			<?php do_action( 'epl_br_office_details' ); ?>
			
			<?php //do_action( 'epl_single_author' ); ?>
			
			<?php // do_action('epl_property_tab_section_after'); ?>
			
			<?php //do_action( 'epl_property_gallery' ); ?>
			
			<?php //do_action( 'epl_single_extensions' ); ?>
			
		</div>
		
			
	</div>
	<div class="entry-footer epl-clearfix">
		<?php do_action( 'epl_br_disclaimer' ); ?>
	</div>
	
	<!-- Floor plan will be output on second page -->
	<?php do_action( 'epl_br_floor_plan' ); ?>
</div>
