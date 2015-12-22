<?php
/*
 * Widget Listing Unlimited List
 *
 * @package EPL-LP
 * @subpackage Theme
 */

?>

<li class="epl-listing-unlimited-list-item">
<!-- Featured Image -->
		<?php if ( $display == 'on' && has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $image , array( 'class' => $d_align . ' ' . $image ) ); ?>
			</a>
		<?php endif; ?>
		<!-- END Featured Image -->
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	<?php if ( $d_excerpt == 'on' ) {
		the_excerpt(); 
	}
	?>
</li>
