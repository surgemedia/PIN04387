<?php 
function get_post_page_content( $id ) {
			$the_query = new WP_Query( 'page_id='.$id );
			$return;
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				
			   		$return = get_the_content();

			}
			wp_reset_postdata();
			return $return;
		}