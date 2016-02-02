<?php

$args = array(
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => get_post_type(),
	'post_status'      => 'publish',
  'type_of_tip'			 => $current_term
);
$pagelist = get_posts( $args );
$pages = array();
foreach ($pagelist as $page) {
$pages[] += $page->ID;
}
$current = array_search(get_the_ID(), $pages);
$prevID = $pages[$current-1];
$nextID = $pages[$current+1];
?>

<div class="col-lg-8">
	<div class="content">
		<div class="navigation">
			<?php if (!empty($prevID)) { ?>
			<div class="alignleft">
				<a href="<?php echo get_permalink($prevID); ?>"
					title="<?php echo get_the_title($prevID); ?>">
					<i class="glyphicon glyphicon-chevron-left"></i>
					Previous
				</a>
			</div>
			<?php }
			if (!empty($nextID)) { ?>
			<div class="alignright">
				<a href="<?php echo get_permalink($nextID); ?>"
					title="<?php echo get_the_title($nextID); ?>">Next
					<i class="glyphicon glyphicon-chevron-right"></i>
				</a>
			</div>
			<?php } ?>
			</div><!-- .navigation -->
		</div>
	</div>