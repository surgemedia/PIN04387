<?php
/*
 * WIDGET :: Listing Unlimited Profile
 */
class EPL_Widget_Listing_Unlimited extends WP_Widget {
	function __construct() {
		parent::__construct( false, $name = __('EPL - Listing Unlimited', 'epl-lu') );
	}
	function widget($args, $instance) {	
	
		$defaults = array(
			'title'		=>	'',
			'text_before'=>	'',
			'text_after'=>	'',
			'display'	=>	0,
			'd_columns'	=>	1,
			'image'		=>	'thumbnail',
			'style'		=>	'list',
			'd_align'	=>	'none',
			'p_number'	=>	1,
			'p_skip'	=>	0,
			'd_excerpt'	=>	0,
			'sort'		=>	'DESC',
			'random'	=>	0
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
	
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title']);
		$text_before= $instance['text_before'];
		$text_after	= $instance['text_after'];
		$p_number	= $instance['p_number'];
		$p_skip		= $instance['p_skip'];
		$d_excerpt	= $instance['d_excerpt'];
		$display	= $instance['display'];
		$d_columns	= $instance['d_columns'];
		$style		= $instance['style'];
		$image		= $instance['image'];
		$d_align	= $instance['d_align'];
		$sort		= $instance['sort'];
		$random		= $instance['random'];
		
		$before_text		= '<div class="sub-title">';
		$before_text_footer	= '<div class="sub-title footer">';
		$after_text			= '</div>';
		
		echo $before_widget;
		if ( $random == 'on' ) {
			$random = 'rand';
			
			$query = new WP_Query( array (
				'post_type' => 'listing_unlimited',
				'showposts' => $p_number,
				'order' => $sort,
				'orderby' => $random
			) );
			
		} elseif ( 'list' == $style && 0 == $random	) {
			$query = new WP_Query( array (
				'post_type' => 'listing_unlimited',
				'showposts' => $p_number,
				'order' => $sort,
				'orderby' => 'title'
				) );
		} else {
			$query = new WP_Query( array (
				'post_type' => 'listing_unlimited',
				'showposts' => $p_number,
				'order' => $sort
				) );
		
		}
		if( $query->have_posts() ) : 
			if ( $title )
				echo $before_title . $title . $after_title;
				
				if ( $text_before != '' ) {
					echo $before_text . $text_before . $after_text;
				}
				if ( 'tab-left' == $style  ) {
					// card
					while($query->have_posts()) : $query->the_post();
						epl_lu_listing_unlimited_tab_left();
						wp_reset_query();
					endwhile;
				}
				elseif ( 'card' == $style  ) {
					// card
					while($query->have_posts()) : $query->the_post();
						epl_lu_listing_unlimited_card( $display , $image , $d_align , $d_excerpt );
						wp_reset_query();
					endwhile;
				}
				else {
						$tab_columns = '';
						if ( $d_columns  > 1) {
							$tab_columns = 'epl-tab-' . $d_columns . '-columns'; 
						}
						
					echo "<ul class='epl-location-profile-list $tab_columns epl-clearfix'>";
						while($query->have_posts()) : $query->the_post();						
							epl_lu_listing_unlimited_list( $display , $image , $d_align , $d_excerpt );
							wp_reset_query();
						endwhile;
					echo '</ul>';
				}
				
				if ( $text_after != '' ) {
					echo $before_text_footer . $text_after . $after_text;
				}
		endif;
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text_before'] = strip_tags($new_instance['text_before']);
		$instance['text_after'] = strip_tags($new_instance['text_after']);
		$instance['display'] = strip_tags($new_instance['display']);
		$instance['d_columns'] = strip_tags($new_instance['d_columns']);
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['style'] = strip_tags($new_instance['style']);
		$instance['d_align'] = strip_tags($new_instance['d_align']);
		$instance['p_number'] = strip_tags($new_instance['p_number']);
		$instance['p_skip'] = strip_tags($new_instance['p_skip']);
		$instance['d_excerpt'] = strip_tags($new_instance['d_excerpt']);
		$instance['sort'] = strip_tags($new_instance['sort']);
		$instance['random'] = strip_tags($new_instance['random']);
		return $instance;
	}
	
	function form($instance) {
		$defaults = array(
						'title'		=>	'',
						'text_before'=>	'',
						'text_after'=>	'',
						'display'	=>	0,
						'd_columns'	=>	1,
						'image'		=>	'thumbnail',
						'style'		=>	'list',
						'd_align'	=>	'none',
						'p_number'	=>	1,
						'p_skip'	=>	0,
						'd_excerpt'	=>	0,
						'sort'		=>	'DESC',
						'random'	=>	0
					);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	
		$title 		= esc_attr($instance['title']);
		$text_before = esc_attr($instance['text_before']);
		$text_after = esc_attr($instance['text_after']);
		$display	= esc_attr($instance['display']);
		$d_columns	= esc_attr($instance['d_columns']);
		$image		= esc_attr($instance['image']);
		$style		= esc_attr($instance['style']);
		$d_align	= esc_attr($instance['d_align']);
		$p_number	= esc_attr($instance['p_number']);
		$p_skip		= esc_attr($instance['p_skip']);
		$d_excerpt	= esc_attr($instance['d_excerpt']);
		$sort		= esc_attr($instance['sort']);
		$random		= esc_attr($instance['random']); ?>
	
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'epl-lu'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_before'); ?>"><?php _e('Sub Title:', 'epl-lu'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('text_before'); ?>" name="<?php echo $this->get_field_name('text_before'); ?>" type="text" value="<?php echo $text_before; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text_after'); ?>"><?php _e('Footer Text:', 'epl-lu'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('text_after'); ?>" name="<?php echo $this->get_field_name('text_after'); ?>" type="text" value="<?php echo $text_after; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('style'); ?>"><?php _e('Style', 'epl-lu'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>">
				<?php
					$options = array( 
									'list' 		=> __('List', 'epl-lu'),
									'card'		=> __('Card', 'epl-lu'),
									'tab-left' 	=> __('Tabbed Box', 'epl-lu')
								);
					foreach ($options as $k => $option) {
						echo '<option value="' . $k . '" id="' . $k . '"', $instance['style'] == $k ? ' selected="selected"' : '', '>', $option, '</option>';
					}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Size', 'epl-lu'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>">
				<?php
					$sizes = epl_get_thumbnail_sizes();
					foreach ($sizes as $k=>$v) {
						$v = implode(" x ", $v);
						echo '<option class="widefat" value="' . $k . '" id="' . $k . '"', $instance['image'] == $k ? ' selected="selected"' : '', '>', $k . ' (' . $v . ' )', '</option>';
					}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('d_align'); ?>"><?php _e('Image Alignment', 'epl-lu'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('d_align'); ?>" name="<?php echo $this->get_field_name('d_align'); ?>">
				<?php
					$options = array('none', 'alignleft', 'alignright', 'aligncenter');
					foreach ($options as $option) {
						echo '<option value="' . $option . '" id="' . $option . '"', $instance['d_align'] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('sort'); ?>"><?php _e('Sort Order', 'epl-lu'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('sort'); ?>" name="<?php echo $this->get_field_name('sort'); ?>">
				<?php
					$options = array('DESC', 'ASC');
					foreach ($options as $option) {
						echo '<option value="' . $option . '" id="' . $option . '"', $instance['sort'] == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
				?>
			</select>
		</p>
		<p>
			<select id="<?php echo $this->get_field_id('p_number'); ?>" name="<?php echo $this->get_field_name('p_number'); ?>">
				<?php
					for ($i=1;$i<=100;$i++) {
						echo '<option value="'.$i.'"'; if ($i==$instance['p_number']) echo ' selected="selected"'; echo '>'.$i.'</option>';
					}
				?>
			</select>
			<label for="<?php echo $this->get_field_id('p_number'); ?>"><?php _e('Number of Listing Unlimited', 'epl-lu'); ?></label>
		</p>
		
		<p>
			<select id="<?php echo $this->get_field_id('p_skip'); ?>" name="<?php echo $this->get_field_name('p_skip'); ?>">
				<?php
					for ($i=0;$i<=100;$i++) {
						echo '<option value="'.$i.'"'; 	if ($i==$instance['p_skip']) echo ' selected="selected"'; echo '>'.$i.'</option>';
					}
				?>
			</select>
			<label for="<?php echo $this->get_field_id('p_skip'); ?>"><?php _e('Number of Listing Unlimited to Skip', 'epl-lu'); ?></label>
		</p>
		<p>
			<select id="<?php echo $this->get_field_id('d_columns'); ?>" name="<?php echo $this->get_field_name('d_columns'); ?>">
				<?php
					for ($i=1;$i<=5;$i++) {
						echo '<option value="'.$i.'"'; 	if ($i==$instance['d_columns']) echo ' selected="selected"'; echo '>'.$i.'</option>';
					}
				?>
			</select>
			<label for="<?php echo $this->get_field_id('d_columns'); ?>"><?php _e('Number of Location Columns', 'epl-lu'); ?></label>
		</p>
		<p>
		<input type="checkbox" id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>" <?php if ($instance['display']) echo 'checked="checked"' ?> />
		<label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display Featured Image', 'epl-lu'); ?></label>
		</p>
		
		<p>
			<input type="checkbox" id="<?php echo $this->get_field_id('d_excerpt'); ?>" name="<?php echo $this->get_field_name('d_excerpt'); ?>" <?php if ($instance['d_excerpt']) echo 'checked="checked"' ?> />
			<label for="<?php echo $this->get_field_id('d_excerpt'); ?>"><?php _e('Display Excerpt', 'epl-lu'); ?></label>
		</p>
		
		<p>
			<input type="checkbox" id="<?php echo $this->get_field_id('random'); ?>" name="<?php echo $this->get_field_name('random'); ?>" <?php if ($instance['random']) echo 'checked="checked"' ?> />
			<label for="<?php echo $this->get_field_id('random'); ?>"><?php _e('Random', 'epl-lu'); ?></label>
		</p>
		<?php 
	}
}
add_action( 'widgets_init', create_function('', 'return register_widget("EPL_Widget_Listing_Unlimited");') );
