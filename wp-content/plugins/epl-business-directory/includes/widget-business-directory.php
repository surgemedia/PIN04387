<?php
/**
 * WIDGET :: Recent Business Directory
 *
 * @package     EPL-BD
 * @subpackage  Widget/Recent_Business_Directory
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
class EPL_BD_Recent_Business extends WP_Widget {
	function __construct() {
		parent::__construct( false, $name = __('EPL - Business Directory', 'epl') );
	}
	function widget($args, $instance) {
	
		$defaults = array(
						'title'		=>	'',
						'featured'	=>	0,
						'display'	=>	'image',
						'image'		=>	'medium',
						'archive'	=>	0,
						'order_rand'=>	0,
						'p_number'	=>	1,
						'p_skip'	=>	0
					);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title']);
		$display	= $instance['display'];
		$image		= $instance['image'];
		$archive	= $instance['archive'];
		$p_number	= $instance['p_number'];
		$p_skip		= $instance['p_skip'];
		$featured	= $instance['featured'];
		$order_rand	= $instance['order_rand'];
	
		if ( $p_number == '' ) { $p_number = 1; }
		
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		
			$args = array(
				'post_type' => 'business_directory', 
				'showposts' => $p_number,
				'offset'	=> $p_skip
			);
		
		if ( $order_rand == 'on' ) {
			$args['orderby'] = 'rand';
		}
		
		$query = new WP_Query ( $args );
		if( $query->have_posts() ) :
			while($query->have_posts()) : $query->the_post();
				if ( $display == 'list' ) {
					echo '
						<div class="business-directory-widget-list">
							<ul>';
								epl_business_directory_widget_list(); 
								echo '
							</ul>
						</div>
					';
				} else {
					echo '<div class="business-directory-widget-image">';
						epl_business_directory_widget( $display , $image );
					echo '</div>';
				}
				wp_reset_query(); 
			endwhile;
		endif;
		echo $after_widget;
	}
 
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['featured'] = strip_tags($new_instance['featured']);
		$instance['status'] = strip_tags($new_instance['status']);
		$instance['display'] = strip_tags($new_instance['display']);
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['archive'] = strip_tags($new_instance['archive']);
		$instance['p_number'] = strip_tags($new_instance['p_number']);
		$instance['p_skip'] = strip_tags($new_instance['p_skip']);
		$instance['order_rand'] = strip_tags($new_instance['order_rand']);
		return $instance;
    }
 
    function form($instance) {	
		$defaults = array(
						'title'		=>	'',
						'featured'	=>	0,
						'display'	=>	'image',
						'image'		=>	'medium',
						'archive'	=>	0,
						'order_rand'=>	0,
						'p_number'	=>	1,
						'p_skip'	=>	0
					);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$title 		= esc_attr($instance['title']);
		$featured	= esc_attr($instance['featured']);
		$display 	= esc_attr($instance['display']);
		$image	 	= esc_attr($instance['image']);
		$archive	= esc_attr($instance['archive']);
		$p_number	= esc_attr($instance['p_number']);
		$p_skip		= esc_attr($instance['p_skip']);
		$order_rand	= esc_attr($instance['order_rand']); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'epl'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display Style', 'epl'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
				<?php
					$options = array('image', 'list' );
					foreach ($options as $option) {
						echo '<option value="' . $option . '" id="' . $option . '"', $instance['display'] == $option ? ' selected="selected"' : '', '>', __($option, 'epl'), '</option>';
					}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Size', 'epl'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>">
				<?php
					$sizes = epl_get_thumbnail_sizes();
					foreach ($sizes as $k=>$v) {
						$v = implode(" x ", $v);
						echo '<option class="widefat" value="' . $k . '" id="' . $k . '"', $instance['image'] == $k ? ' selected="selected"' : '', '>', __($k, 'epl') . ' (' . __($v, 'epl') . ' )', '</option>';
					}
				?>
			</select>
		</p>
		
		<p>
			<select id="<?php echo $this->get_field_id('p_number'); ?>" name="<?php echo $this->get_field_name('p_number'); ?>">
				<?php
					for ($i=1;$i<=20;$i++) {
						echo '<option value="'.$i.'"'; 	if ($i==$instance['p_number']) echo ' selected="selected"'; echo '>'.__($i, 'epl').'</option>';
					}
				?>
			</select>
			<label for="<?php echo $this->get_field_id('p_number'); ?>"><?php _e('Number of Businesses', 'epl'); ?></label>
		</p>
		
		<p>
			<select id="<?php echo $this->get_field_id('p_skip'); ?>" name="<?php echo $this->get_field_name('p_skip'); ?>">
				<?php
					for ($i=0;$i<=20;$i++) {
						echo '<option value="'.$i.'"'; 	if ($i==$instance['p_skip']) echo ' selected="selected"'; echo '>'.__($i, 'epl').'</option>';
					}
				?>
			</select>
			<label for="<?php echo $this->get_field_id('p_skip'); ?>"><?php _e('Businesses to Skip', 'epl'); ?></label>
		</p>
		
		<p>
			<input type="checkbox" id="<?php echo $this->get_field_id('featured'); ?>" name="<?php echo $this->get_field_name('featured'); ?>" <?php if ($instance['featured']) echo 'checked="checked"' ?> />
			<label for="<?php echo $this->get_field_id('featured'); ?>"><?php _e('Only Show Featured Businesses', 'epl'); ?></label>
		</p>
			
		<p>
			<input type="checkbox" id="<?php echo $this->get_field_id('archive'); ?>" name="<?php echo $this->get_field_name('archive'); ?>" <?php if ($instance['archive']) echo 'checked="checked"' ?> />
			<label for="<?php echo $this->get_field_id('archive'); ?>"><?php _e('Dynamic Archive Page (Overrides Property Type)', 'epl'); ?></label>
		</p>
		
		<p>
			<input type="checkbox" id="<?php echo $this->get_field_id('order_rand'); ?>" name="<?php echo $this->get_field_name('order_rand'); ?>" <?php if ($instance['order_rand']) echo 'checked="checked"' ?> />
			<label for="<?php echo $this->get_field_id('order_rand'); ?>"><?php _e('Random Order', 'epl'); ?></label>
		</p>
        <?php 
    }
}
add_action( 'widgets_init', create_function('', 'return register_widget("EPL_BD_Recent_Business");') );