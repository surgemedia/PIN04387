<?php while (have_posts()) : the_post(); ?>

<div class="row">
	<?php
		$extraClass=get_field("jumbotron_size");
		$image=getFeaturedUrl(get_the_id());
		$preTitle=get_field("light");
		$title="<b>".get_field("bold")."</b>";
		$postTitle=("small"!==get_field("jumbotron_size")) ? get_field("light2") : "";
		include(locate_template('templates/part-jumbotron.php')); ?>


	<div class="col-xs-12 col-md-6 col-md-push-3 general-content">
		<?php edit_post_link(); ?>
		<?php 
				function get_back_to_page($template){
					$args=array(
								'post_type' => 'page',
    						'meta_key' => '_wp_page_template',
								'meta_value'=> $template,
							);
						$p=get_posts( $args );
						return get_permalink($p[0]->ID);

				}

				$current_term=wp_get_post_terms(get_the_id(), 'type_of_tip', array("fields" => "all"))[0]->slug;
				switch ($current_term) {
					case 'selling':?>
						
						<a href="<?php echo get_back_to_page("template-selling-tips.php") ?>" class="back" ><i class="icon-arrow-left"></i> BACK TO SEARCH RESULTS</a>
		<?php	break;
					case 'renting':?>
						<a href="<?php echo get_back_to_page("template-renting-tips.php") ?>" class="back" ><i class="icon-arrow-left"></i> BACK TO SEARCH RESULTS</a>

		<?php break;
					case 'buying'?>
						<a href="<?php echo get_back_to_page("template-buying-tips.php") ?>" class="back" ><i class="icon-arrow-left"></i> BACK TO SEARCH RESULTS</a>
						
		<?php	default:
						# code...
						break;
				}

		 ?>

		<?php the_content(); ?>
		<?php include(locate_template('templates/part-navigation.php')); ?>
	<!-- <div class="bg_grey visible-lg"> </div> -->
	</div>
	<div class="col-sm-6 col-md-3 col-md-pull-6 side">

	</div>
	<div class="col-sm-6 col-md-3 side">
	    <?php include(locate_template('templates/part-quick-links.php')); ?>
	</div>
</div>



<?php endwhile; ?>