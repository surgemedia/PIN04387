<?php
/**
 * Register custom meta fields for Listing Unlimited post type
 *
 * @package     EPL-LU
 * @subpackage  Meta
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.3
 */
  
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Variables List required for meta boxes
 *
 * @since 1.0
 */
global $epl_lu_meta_boxes;
$epl_lu_meta_boxes = array(
	array(
		'id'		=>	'epl-listing-unlimited-section-id',
		'label'		=>	__('Listing Unlimited Details', 'epl-lu'),
		'post_type'	=>	'listing_unlimited',
		'context'	=>	'normal',
		'priority'	=>	'high',
		'groups'	=>	array(
			array(
				'columns'	=>	'1',
				'label'		=>	'',
				'fields'	=>	array(
	
					array(
						'name'		=>	'property_unique_id',
						'label'		=>	__('Unique Listing ID', 'epl-lu'),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),
					
					array(
						'name'		=>	'listing_linked',
						'label'		=>	__('Linked Listing', 'epl-lu'),
						'type'		=>	'locked',
						'maxlength'	=>	'99'
					),
					
					array(
						'name'		=>	'listing_unlimited_video',
						'label'		=>	__('Video URL', 'epl-lu'),
						'type'		=>	'url',
						'maxlength'	=>	'200'
					),
					
					array(
						'name'		=>	'listing_unlimited_pdf',
						'label'		=>	__('PDF URL', 'epl-lu'),
						'type'		=>	'file',
					)
				)
			),
			
			array(
				'columns'	=>	'2',
				'label'		=>	'',
				'fields'	=>	array(
	
					array(
						'name'		=>	'listing_unlimited_list_item_1',
						'label'		=>	epl_lu_meta_list(1),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),
	
					array(
						'name'		=>	'listing_unlimited_list_item_2',
						'label'		=>	epl_lu_meta_list(2),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_3',
						'label'		=>	epl_lu_meta_list(3),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_4',
						'label'		=>	epl_lu_meta_list(4),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_5',
						'label'		=>	epl_lu_meta_list(5),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_6',
						'label'		=>	epl_lu_meta_list(6),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_7',
						'label'		=>	epl_lu_meta_list(7),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_8',
						'label'		=>	epl_lu_meta_list(8),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_9',
						'label'		=>	epl_lu_meta_list(9),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_10',
						'label'		=>	epl_lu_meta_list(10),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					)
				)
			),
			
			array(
				'columns'	=>	'2',
				'label'		=>	'',
				'fields'	=>	array(

					array(
						'name'		=>	'listing_unlimited_list_item_11',
						'label'		=>	epl_lu_meta_list(11),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),
	
					array(
						'name'		=>	'listing_unlimited_list_item_12',
						'label'		=>	epl_lu_meta_list(12),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_13',
						'label'		=>	epl_lu_meta_list(13),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_14',
						'label'		=>	epl_lu_meta_list(14),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_15',
						'label'		=>	epl_lu_meta_list(15),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_16',
						'label'		=>	epl_lu_meta_list(16),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_17',
						'label'		=>	epl_lu_meta_list(17),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_18',
						'label'		=>	epl_lu_meta_list(18),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_19',
						'label'		=>	epl_lu_meta_list(19),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					),

					array(
						'name'		=>	'listing_unlimited_list_item_20',
						'label'		=>	epl_lu_meta_list(20),
						'type'		=>	'text',
						'maxlength'	=>	'60'
					)
				)
			)
		)
	)
);

/**
 * Add meta boxes to the post-edit page
 *
 * @since 1.0
 */
function epl_lu_add_meta_boxes() {
	global $epl_lu_meta_boxes;
	if(!empty($epl_lu_meta_boxes)) {
		foreach($epl_lu_meta_boxes as $epl_lu_meta_box) {
			if( is_array($epl_lu_meta_box['post_type']) ) {
				foreach($epl_lu_meta_box['post_type'] as $post_type) {
					add_meta_box($epl_lu_meta_box['id'], __( $epl_lu_meta_box['label'], 'epl-lu' ), 'epl_lu_meta_box_inner_custom_box', $post_type, $epl_lu_meta_box['context'], $epl_lu_meta_box['priority'], $epl_lu_meta_box);
				}
			} else {
				add_meta_box($epl_lu_meta_box['id'], __( $epl_lu_meta_box['label'], 'epl-lu' ), 'epl_lu_meta_box_inner_custom_box', $epl_lu_meta_box['post_type'], $epl_lu_meta_box['context'], $epl_lu_meta_box['priority'], $epl_lu_meta_box);
			}
		}
	}
}

/**
 * Add sub meta boxes to the post-edit page
 *
 * @since 1.0
 */
function epl_lu_meta_box_inner_custom_box($post, $args) {
	$groups = $args['args']['groups'];
	if(!empty($groups)) {
		wp_nonce_field( 'epl_lu_inner_custom_box', 'epl_lu_inner_custom_box_nonce' );
		foreach($groups as $group) { ?>
			<div class="epl-inner-div col-<?php echo $group['columns']; ?> table-<?php echo $args['args']['context']; ?>">
				<?php
					$group['label'] = trim($group['label']);
					if(!empty($group['label'])) {
						echo '<h3>'.__($group['label'], 'epl-lu').'</h3>';
					}
				?>
				<table class="form-table epl-form-table">
					<tbody>
						<?php
							$fields = $group['fields'];
							if(!empty($fields)) {
								foreach($fields as $field) {
									if(!empty($field['exclude'])) {
										if( in_array($post->post_type, $field['exclude']) ) {
											continue;
										}
									}
									
									if(!empty($field['include'])) {
										if( !in_array($post->post_type, $field['include']) ) {
											continue;
										}
									} ?>
									<tr class="form-field">
										<th valign="top" scope="row">
											<label for="<?php echo $field['name']; ?>"><?php _e($field['label'], 'epl-lu'); ?></label>
										</th>
										
										<?php if($group['columns'] > 1) { ?>
											</tr><tr class="form-field">
										<?php } ?>
										
										<td>
											<?php
												$val = get_post_meta($post->ID, $field['name'], true);
												switch($field['type']) {
													case 'select':
														echo '<select name="'.$field['name'].'" id="'.$field['name'].'">';
															if(!empty($field['default'])) {
																echo '<option value="" selected="selected">'.__($field['default'], 'epl-lu').'</option>';
															}
										
															if(!empty($field['opts'])) {
																foreach($field['opts'] as $k=>$v) {
																	$selected = '';
																	if($val == $k) {
																		$selected = 'selected="selected"';
																	}
																	
																	if(is_array($v)) {
																		if(!empty($v['exclude'])) {
																			if( in_array($post->post_type, $v['exclude']) ) {
																				continue;
																			}
																		} else if(!empty($v['include'])) {
																			if( !in_array($post->post_type, $v['include']) ) {
																				continue;
																			}
																		}
																		$v = $v['label'];
																	}
																	
																	echo '<option value="'.$k.'" '.$selected.'>'.__($v, 'epl-lu').'</option>';
																}
															}
														echo '</select>';
														break;
							
													case 'checkbox':
														if(!empty($field['opts'])) {
															foreach($field['opts'] as $k=>$v) {
																$checked = '';
																if(!empty($val)) {
																	if( in_array($k, $val) ) {
																		$checked = 'checked="checked"';
																	}
																}
																echo '<span class="epl-field-row"><input type="checkbox" name="'.$field['name'].'[]" id="'.$field['name'].'_'.$k.'" value="'.$k.'" '.$checked.' /> <label for="'.$field['name'].'_'.$k.'">'.__($v, 'epl-lu').'</label></span>';
															}
														}
														break;
							
													case 'radio':
														if(!empty($field['opts'])) {
															foreach($field['opts'] as $k=>$v) {
																$checked = '';
																if($val == $k) {
																	$checked = 'checked="checked"';
																}
																echo '<span class="epl-field-row"><input type="radio" name="'.$field['name'].'" id="'.$field['name'].'_'.$k.'" value="'.$k.'" '.$checked.' /> <label for="'.$field['name'].'_'.$k.'">'.__($v, 'epl-lu').'</label></span>';
															}
														}
														break;
							
													case 'editor':
														wp_editor(stripslashes($val), $field['name'], $settings = array('textarea_rows'=>5));
														break;
									
													case 'textarea':
														$atts = '';
														if($field['maxlength'] > 0) {
															$atts = ' maxlength="'.$field['maxlength'].'"';
														}
														echo '<textarea name="'.$field['name'].'" id="'.$field['name'].'" '.$atts.'>'.stripslashes($val).'</textarea>';
														break;
													
													case'decimal':
														$atts = '';
														if($field['maxlength'] > 0) {
															$atts = ' maxlength="'.$field['maxlength'].'"';
														}
														echo '<input type="text" name="'.$field['name'].'" id="'.$field['name'].'" value="'.stripslashes($val).'" class="validate[custom[onlyNumberWithDecimal]]" '.$atts.' />';
														break;
														
													case 'number':
														$atts = '';
														if($field['maxlength'] > 0) {
															$atts = ' maxlength="'.$field['maxlength'].'"';
														}
														echo '<input type="text" name="'.$field['name'].'" id="'.$field['name'].'" value="'.stripslashes($val).'" class="validate[custom[onlyNumber]]" '.$atts.' />';
														break;
														
													case 'url':
														echo '<input type="text" name="'.$field['name'].'" id="'.$field['name'].'" value="'.stripslashes($val).'" class="validate[custom[url]]" />';
														break;
														
														
													case 'locked':
														$atts = '';
														if($field['maxlength'] > 0) {
															$atts = ' maxlength="'.$field['maxlength'].'"';
														}
														echo '<span>'.stripslashes($val).'</span>';
														break;
														
													case 'image':
													case 'file':
														if($val != '') {
															$img = $val;
														} else {
															$img = plugin_dir_url( __FILE__ ).'images/no_image.jpg';
														}
														echo '
															<div class="epl-media-row">
																<input type="text" name="'.$field['name'].'" id="'.$field['name'].'" value="'.stripslashes($val).'" />
																&nbsp;&nbsp;<input type="button" name="epl_lu_upload_button" class="button" value="'.__('Add File', 'epl-lu').'" />';
					
																if( in_array( pathinfo($img, PATHINFO_EXTENSION), array('jpg','jpeg','png','gif') ) ) {
																	echo '&nbsp;&nbsp;<img src="'.$img.'" alt="" />';
																}
														echo		
																'<div class="epl-clear"></div>
															</div>
														';
														break;

													default:
														$atts = '';
														if($field['maxlength'] > 0) {
															$atts = ' maxlength="'.$field['maxlength'].'"';
														}
														echo '<input type="'.$field['type'].'" name="'.$field['name'].'" id="'.$field['name'].'" value="'.stripslashes($val).'" '.$atts.' />';
												}						
												
												if(isset($field['help'])) {
													$field['help'] = trim($field['help']);
													if(!empty($field['help'])) {
														echo '<span class="epl-help-text">'.__($field['help'], 'epl-lu').'</span>';
													}
												}
											?>
										</td>
									</tr>
								<?php }
							}
						?>
					</tbody>
				</table>
			</div>
			<?php
		} ?>
		<input type="hidden" name="epl_lu_meta_box_ids[]" value="<?php echo $args['id']; ?>" />
		<div class="epl-clear"></div>
		<?php
	}
}
add_action( 'add_meta_boxes', 'epl_lu_add_meta_boxes' );



function epl_lu_save_meta_boxes( $post_ID ) {
	if ( ! isset( $_POST['epl_lu_inner_custom_box_nonce'] ) )
		return $post_ID;
	$nonce = $_POST['epl_lu_inner_custom_box_nonce'];
	if ( ! wp_verify_nonce( $nonce, 'epl_lu_inner_custom_box' ) )
		return $post_ID;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_ID;
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_ID ) )
			return $post_ID;
	} else {
		if ( ! current_user_can( 'edit_post', $post_ID ) )
		return $post_ID;
	}
	
	$epl_lu_meta_box_ids = $_POST['epl_lu_meta_box_ids'];
	if(!empty($epl_lu_meta_box_ids)) {
		global $epl_lu_meta_boxes;
		if(!empty($epl_lu_meta_boxes)) {
			foreach($epl_lu_meta_box_ids as $epl_lu_meta_box_id) {
				foreach($epl_lu_meta_boxes as $epl_lu_meta_box) {
					if($epl_lu_meta_box['id'] == $epl_lu_meta_box_id) {
						if(!empty($epl_lu_meta_box['groups'])) {
							foreach($epl_lu_meta_box['groups'] as $group) {
								if(!empty($group['fields'])) {
									foreach($group['fields'] as $field) {
										if (  $field['type'] == 'locked'  ) {
										} else { 
											update_post_meta( $post_ID, $field['name'], $_POST[ $field['name'] ] );
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	
	epl_lu_save_linked_address_meta( $post_ID );

	epl_lu_custom_post_type_title( $post_ID );

	
}
add_action( 'save_post', 'epl_lu_save_meta_boxes' );

function epl_lu_custom_post_type_title ( $post_ID ) {
    global $wpdb;
    if ( get_post_type( $post_ID ) == 'listing_unlimited' ) {
	
        $title			= get_post_meta( $post_ID, 'property_unique_id', true );
        $where 			= array( 'ID' => $post_ID );
		
        $wpdb->update( $wpdb->posts, array( 'post_title' => $title ), $where );
    }
}

function epl_lu_save_linked_address_meta( $post_ID ) {

	$result = epl_lu_get_linked_listing_address();
	update_post_meta( $post_ID, 'listing_linked' , $result );
	
}
