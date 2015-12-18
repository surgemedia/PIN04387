<?php
/*
 * Widget Recent Business Directory : Default
 *
 * @package EPL-BM
 * @subpackage Theme
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div id="post-<?php the_ID(); ?>" class="business-directory-widget">
	<div class="entry-header">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="epl-img-widget">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( $d_image ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
	
	<div class="entry-content">
		<h5 class="business-directory-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
		
		<div class="entry-meta epl-clearfix">
			<div class="epl-business-categories"> <?php _e('Business Category :','epl'); echo epl_business_get_category_list(); ?></div>
		</div>
	</div>
</div>