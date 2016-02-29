<?php
function epl_slider_license_options_filter($fields = null) {
	$fields[] = array(
		'label'		=>	'',
		'fields'	=>	array(
			array(
				'name'	=>	'sliders',
				'label'	=>	'Sliders license key',
				'type'	=>	'text'
			)
		)
	);
	
	return $fields;
}
add_filter('epl_license_options_filter', 'epl_slider_license_options_filter', 10, 3);

function epl_slider_extensions_options_filter($epl_fields = null) {

	$arrow_images = array_map( 'basename', glob(EPL_SLIDER_PLUGIN_PATH.'img/arrows/*.png') );
	$arrow_images = array_combine($arrow_images,$arrow_images );
	if ( function_exists( 'epl_get_thumbnail_sizes' ) ) {
		$opts_sizes = array();
		$sizes = epl_get_thumbnail_sizes();
		foreach ($sizes as $k=>$v) {
			$v = implode(" x ", $v);
			$opts_sizes[ $k ] = $k . ' ' . $v;
		}
	}

	$fields = array();
	$epl_slider_fields = array(
		'label'		=>	__('Sliders')
	);
	$fields[] = array(
		'label'		=>	'Single',
		'intro'		=>	__('Configure the slider settings when viewing a single listing','epl'),
		'fields'	=>	apply_filters('epl_slider_tab_settings',array(
		
			array(
				'name'		=>	'epl_slider_width',
				'label'		=>	__('Slider Width','epl'),
				'type'		=>	'number',
				'default'	=>	'',
				'help'		=>	__( 'Provide width in pixels, leave blank for auto width' , 'epl')
			),
			
			array(
				'name'		=>	'epl_slider_height',
				'label'		=>	__('Slider Height','epl'),
				'type'		=>	'number',
				'default'	=>	'',
				'help'		=>	__( 'Provide height in pixels, leave blank for auto height' , 'epl')
			),

			//  $DragOrientation
			array(
				'name'	=>	'epl_allow_swipe',
				'label'	=>	__('Swipe to change slider?','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'0'	=>	__('Disable','epl'),
					'1'	=>	__('Horizontal','epl'),
					'2'	=>	__('Vertical','epl'),
					'3'	=>	__('Both','epl'),
				),
				'default'	=>	'3'
			),

			array(
				'name'	=>	'epl_slider_reverseorder',
				'label'	=>	__('Reverse Image Order','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'true'		=>	__('Enable','epl'),
					'false'		=>	__('Disable','epl'),
				),
				'default'	=>	'true'
			),
			
			// $ArrowNavigatorOptions.$ChanceToShow
			array(
				'name'	=>	'epl_slider_controlNav',
				'label'	=>	__('Navigation Controls','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'0'		=>	__('Disable','epl'),
					'1'		=>	__('Mouse Over','epl'),
					'2'		=>	__('Always','epl'),
				),
				'default'	=>	'1'
			),
			
			// $ArrowKeyNavigation
			array(
				'name'	=>	'epl_slider_keyboard',
				'label'	=>	__('Navigation via keyboard','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'true'		=>	__('Enable','epl'),
					'false'		=>	__('Disable','epl'),
				),
				'default'	=>	'true'
			),
			
			array(
				'name'	=>	'epl_slider_arrow_style',
				'label'	=>	__('Navigation Arrow Style','epl'),
				'type'	=>	'select',
				'opts'	=>	$arrow_images,
				'default'	=>	'a17.png'
			),

			array(
				'name'	=>	'epl_slider_popup',
				'label'	=>	__('Display images in popup','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'true'		=>	__('Enable','epl'),
					'false'		=>	__('Disable','epl'),
				),
				'default'	=>	'false',
			),
			array(
				'name'	=>	'epl_slider_single_price_sticker',
				'label'	=>	__('Display price sticker','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'true'		=>	__('Enable','epl'),
					'false'		=>	__('Disable','epl'),
				),
				'default'	=>	'false',
			),

			// $AutoPlay
			array(
				'name'		=>	'epl_slider_slideshow',
				'label'		=>	__('Slide show','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'true'		=>	__('Enable','epl'),
					'false'		=>	__('Disable','epl'),
				),
				'default'	=>	'true',
				'help'		=> ' Setup a slide show for the slider to animate automatically'
			),
			
			// $SlideshowOptions._SlideshowTransitions
			array(
				'name'	=>	'epl_slider_transition',
				'label'	=>	__('Slide show Transition Effect','epl'),
				'type'	=>	'select',
				'opts'	=>	array(
					'fade_in_l'			=>	__('Fade In Left','epl'),
					'fade_in_r'			=>	__('Fade In Right','epl'),
					'zoom_in'			=>	__('Zoom In','epl'),
					'zoom_out'			=>	__('Zoom Out','epl'),
					'rotate_zoom_in'		=>	__('Rotate Zoom In','epl'),
					'rotate_zoom_out'		=>	__('Rotate Zoom In','epl'),
					'hdouble_zoom_in'		=>	__('Hdouble Zoom In','epl'),
					'hdouble_zoom_out'		=>	__('Hdouble Zoom Out','epl'),
					'rotate_zoom_in_left'		=>	__('Rotate Zoom In Left','epl'),
					'rotate_zoom_out_right'		=>	__('Rotate Zoom Out Right','epl'),
					'rotate_zoom_out_left'		=>	__('Rotate Zoom Out Left','epl'),
					'rotate_zoom_in_right'		=>	__('Rotate Zoom In Right','epl'),
					'rotate_hdouble_in'		=>	__('Rotate Hdouble In','epl'),
					'rotate_hdouble_out'		=>	__('Rotate Hdouble Out','epl'),
					'rotate_vfork'			=>	__('Rotate Vfork','epl'),
					'rotate_hfork'			=>	__('Rotate Hfork','epl')
				),
				'default'	=>	'fade_in_l'
			),
			
			// $PauseOnHover
			array(
				'name'	=>	'epl_slider_pauseOnHover',
				'label'	=>	__('Slide show pause on hover','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'0'		=>	__('Disable','epl'),
					'1'		=>	__('Enable','epl'),
				),
				'default'	=>	'1'
			),
			
			// $AutoPlayInterval
			array(
				'name'		=>	'epl_slider_slideshowSpeed',
				'label'		=>	__('Slide show between slides speed','epl'),
				'type'		=>	'number',
				'default'	=>	'7000'
			),
			// $SlideDuration
			array(
				'name'		=>	'epl_slider_animationSpeed',
				'label'		=>	__('Slide show transition speed','epl'),
				'type'		=>	'number',
				'default'	=>	'600'
			),

			// $ThumbnailNavigatorOptions.$ChanceToShow
			array(
				'name'	=>	'epl_slider_use_thumbnails',
				'label'	=>	__('Thumbnail Navigation','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					2		=>	__('Enable','epl'),
					0		=>	__('Disable','epl'),
				),
				'default'	=>	'true'
			),
			
			array(
				'name'		=>	'epl_slider_thumb_width',
				'label'		=>	__('Thumbnail Width','epl'),
				'type'		=>	'number',
				'default'	=>	'',
				'help'		=>	__( 'Provide width in pixels, leave blank for wordpress default thumbnail size' , 'epl')
			),
			
			array(
				'name'		=>	'epl_slider_thumb_height',
				'label'		=>	__('Thumbnail Height','epl'),
				'type'		=>	'number',
				'default'	=>	'',
				'help'		=>	__( 'Provide height in pixels, leave blank for wordpress default thumbnail size' , 'epl')
			),
			
			//  $ThumbnailNavigatorOptions.$SpacingX
			array(
				'name'		=>	'epl_slider_spacingx',
				'label'		=>	__('Thumbnail Horizontal spacing','epl'),
				'type'		=>	'number',
				'default'	=>	'14'
			),
			//  $ThumbnailNavigatorOptions.$SpacingY
			array(
				'name'		=>	'epl_slider_spacingy',
				'label'		=>	__('Thumbnail Vertical spacing','epl'),
				'type'		=>	'number',
				'default'	=>	'12'
			),
			
			//  $DisplayPieces
			array(
				'name'	=>	'epl_display_pieces',
				'label'	=>	__('Thumbnail to display ( default 6 )','epl'),
				'type'	=>	'select',
				'opts'	=>	array(
					'1'		=>	__('1','epl'),
					'2'		=>	__('2','epl'),
					'3'		=>	__('3','epl'),
					'4'		=>	__('4','epl'),
					'5'		=>	__('5','epl'),
					'6'		=>	__('6','epl'),
					'7'		=>	__('7','epl'),
					'8'		=>	__('8','epl'),
					'9'		=>	__('9','epl'),
					'10'		=>	__('10','epl'),
				),
				'default'	=>	'6'
			),
			
			// $ArrowNavigatorOptions.$ChanceToShow 
			array(
				'name'	=>	'epl_slider_thumb_orientation',
				'label'	=>	__('Thumbnail Orientation','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'2'		=>	__('Vertical','epl'),
					'1'		=>	__('Horizontal','epl'),
				),
				'default'	=>	'1'
			),
			
			array(
				'name'	=>	'epl_slider_thumb_lanes',
				'label'	=>	__('Thumbnail Lanes','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'2'		=>	__('Two','epl'),
					'1'		=>	__('One','epl'),
				),
				'default'	=>	'1'
			),
		) )
	);
	
	$fields[] = array(
		'label'		=>	'Archive',
		'intro'		=>	__('Configure the slider settings for your listings archive','epl'),
		'fields'	=>	apply_filters('epl_slider_tab_archive_settings',array(
			array(
				'name'	=>	'epl_slider_enable_archive',
				'label'	=>	__('Use Slider on Archives','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					1		=>	__('Enable','epl'),
					0		=>	__('Disable','epl'),
				),
				'default'	=>	0
			),
			
			array(
				'name'	=>	'epl_slider_archive_image_size',
				'label'	=>	'Image size of slide on Archives',
				'type'	=>	'select',
				'opts'	=>	$opts_sizes,
				'default'	=>	'medium'
			),
			
			array(
				'name'		=>	'epl_slider_archive_wrapper_width',
				'label'		=>	__('Slider Wrapper Width','epl'),
				'type'		=>	'number',
				'default'	=>	'',
				'help'		=>	__( 'Slider wrapper width in pixels' , 'epl')
			),
			
			array(
				'name'		=>	'epl_slider_archive_wrapper_height',
				'label'		=>	__('Slider Wrapper Height','epl'),
				'type'		=>	'number',
				'default'	=>	'',
				'help'		=>	__( 'Slider wrapper height in pixels' , 'epl')
			),
			
			array(
				'name'	=>	'epl_slider_archive_price_sticker',
				'label'	=>	__('Display price sticker','epl'),
				'type'	=>	'radio',
				'opts'	=>	array(
					'true'		=>	__('Enable','epl'),
					'false'		=>	__('Disable','epl'),
				),
				'default'	=>	'false',
			),
		) )
	);
	$fields = apply_filters('epl_slider_option_fields',$fields);
	$epl_slider_fields['fields'] = $fields;
	$epl_fields['sliders'] = $epl_slider_fields;
	return $epl_fields;
}
add_filter('epl_extensions_options_filter_new', 'epl_slider_extensions_options_filter', 10, 3);

function epl_slider_admin_css() {
	$screen = get_current_screen();
	/*
	if( isset($screen->id) && $screen->id == 'easy-property-listings_page_epl-extensions' && isset($_GET['tab']) && $_GET['tab'] == 'sliders') {
		echo '
			<style>
				.epl-half-left > label {
					font-size: 1.1em;
					font-style: oblique;
					font-weight: bold;
				}
			</style>
		';
	}
	*/
	if(is_epl_post()) {
		echo '
		<style>
		  	#epl-slider-post-attachments { list-style-type: none; margin: 0; padding: 0; }
			#epl-slider-post-attachments li { 
				margin: 3px 3px 3px 0; padding: 1px; float: left; 
				text-align: center; cursor: all-scroll;
			}
  		</style>';
  		echo '
		<script>
  			jQuery(function($) {
  			
				if( $("#epl-slider-post-attachments").length ) {
				  $( "#epl-slider-post-attachments" ).sortable({
					update: function (event, ui) {
						 var order="";
						$("#epl-slider-post-attachments li").each(function(i) {
							if (order=="")
								order = $(this).attr("data-id");
							else
								order += "," + $(this).attr("data-id");
						});
						console.log(order);
						$.ajax({
							data: {order :order , id : $("#post_ID").val(), action : "epl_slider_save_order" },
							type: "POST",
							url: ajaxurl,
							
						});
					}
				  });
				  $( "#epl-slider-post-attachments" ).disableSelection();
			  	}
			});
		</script>
		';
	}
}
add_action('admin_head','epl_slider_admin_css');

if ( ! function_exists('epl_all_post_types')) {
	function epl_all_post_types() {
		$epl_posts  = epl_get_active_post_types();
			$epl_posts	= array_keys($epl_posts);
			return apply_filters('epl_additional_post_types',$epl_posts);
	}
}
/** add meta box for attachments **/
function epl_slider_attachments_mb() {
	
	foreach ( epl_all_post_types() as $screen) {

		add_meta_box(
			'epl_slider_attachments',
			__( 'EPL Slider Gallery', 'epl' ),
			'epl_slider_attachments_callback',
			$screen
		);
	}
}
add_action('add_meta_boxes','epl_slider_attachments_mb');

function epl_slider_attachments_callback($post) {

	$args = array(
		'post_parent' 		=> $post->ID,
		'post_type'   		=> 'attachment', 
		'numberposts' 		=> -1,
		'post_mime_type'	=>	'image'
	);
	
	if(get_post_meta($post->ID,'epl_slides_order',true) != '') {
		$args['post__in'] 	= explode(',', get_post_meta($post->ID,'epl_slides_order',true) );
		$args['orderby']	= 'post__in';	
	}
	
	if ( has_post_thumbnail($post->ID) ) {
		$featured_image 	= get_post_thumbnail_id($post->ID);
		$args['exclude'] 	= $featured_image;
		$attachments 		= get_posts($args);
	} else {
		$attachments 		= get_posts($args);
	}

	if ( $attachments ) {

		$content = '<ul id="epl-slider-post-attachments" class="epl-slider-post-attachments">';
		foreach ( $attachments as $attachment ) {
			$thumb      	 = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
			$content 		.= '<li data-id="'.$attachment->ID.'" class="ui-state-default epl_slider_admin_thumb"><img src="'.$thumb[0].'" /></li>';
			
		}
		$content .= '</ul>';
		$content .= '<div class="epl-clearfix"></div>';
		$content .= '<div class="update-nag">'.__('Drag to reorder images in your slider.','epl').'</div>';
	} else {
		$content = '<div class="update-nag">'.__('Add images to the slider using add media button.','epl').'</div>';
	}
	echo $content;
}

function epl_slider_save_order() {
	if( is_admin() ) {
		if(isset($_POST['id']) && intval($_POST['id']) > 0 ) {
			$order = sanitize_text_field($_POST['order']);
			update_post_meta(intval($_POST['id']),'epl_slides_order',$order);
		}
	}
	die;
}
add_action('wp_ajax_epl_slider_save_order','epl_slider_save_order');
