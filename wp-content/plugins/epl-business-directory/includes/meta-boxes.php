<?php
/**
 * Register custom meta fields for Business Directory post type
 *
 * @package     EPL-BD
 * @subpackage  Meta
 * @copyright   Copyright (c) 2014, Merv Barrett
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Variables List required for meta boxes
 *
 * @since 1.0
 */
 
$opts_users = array();
$users = get_users('orderby=display_name&order=ASC');
if(!empty($users)) {
	foreach ($users as $user) {
		$opts_users[ $user->ID ] = $user->display_name;
	}
}
global $epl_bd_meta_boxes;
$epl_bd_meta_boxes = array(
		
	array(
		'id'		=>	'epl-property-listing-section-id',
		'label'		=>	'Business Details',
		'post_type'	=>	'business_directory',
		'context'	=>	'normal',
		'priority'	=>	'default',
		'groups'	=>	array(
			array(
				'columns'	=>	'1',
				'label'		=>	'',
				'fields'	=>	array(
					array(
						'name'		=>	'epl_bd_name_first',
						'label'		=>	'First Name',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_name_last',
						'label'		=>	'Last Name',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_phone',
						'label'		=>	'Phone',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_email',
						'label'		=>	'Email',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_address_street_no',
						'label'		=>	'Street Number',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_address_street_name',
						'label'		=>	'Street Name',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_address_street_name_2',
						'label'		=>	'Street Name 2',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_address_suburb',
						'label'		=>	'Suburb',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_address_state',
						'label'		=>	'State',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_address_postcode',
						'label'		=>	'Postcode',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_address_coords',
						'label'		=>	'Coordinates',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_website',
						'label'		=>	'Website',
						'type'		=>	'text',
						'maxlength'	=>	'150'
					),
					
					array(
						'name'		=>	'epl_bd_notes',
						'label'		=>	'Notes',
						'type'		=>	'text',
						'maxlength'	=>	'6500'
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
function epl_bd_add_meta_boxes() {
	global $epl_bd_meta_boxes;
	if(!empty($epl_bd_meta_boxes)) {
		foreach($epl_bd_meta_boxes as $epl_meta_box) {
			if( is_array($epl_meta_box['post_type']) ) {
				foreach($epl_meta_box['post_type'] as $post_type) {
					add_meta_box($epl_meta_box['id'], __( $epl_meta_box['label'], 'epl-bd' ), 'epl_bd_meta_box_inner_custom_box', $post_type, $epl_meta_box['context'], $epl_meta_box['priority'], $epl_meta_box);
				}
			} else {
				add_meta_box($epl_meta_box['id'], __( $epl_meta_box['label'], 'epl-bd' ), 'epl_bd_meta_box_inner_custom_box', $epl_meta_box['post_type'], $epl_meta_box['context'], $epl_meta_box['priority'], $epl_meta_box);
			}
		}
	}
}
/**
 * Add sub meta boxes to the post-edit page
 *
 * @since 1.0
 */
function epl_bd_meta_box_inner_custom_box($post, $args) {
	$groups = $args['args']['groups'];
	if(!empty($groups)) {
		wp_nonce_field( 'epl_inner_custom_box', 'epl_inner_custom_box_nonce' );
		foreach($groups as $group) { ?>
			<div class="epl-inner-div col-<?php echo $group['columns']; ?> table-<?php echo $args['args']['context']; ?>">
				<?php
					$group['label'] = trim($group['label']);
					if(!empty($group['label'])) {
						echo '<h3>'.__($group['label'], 'epl-bd').'</h3>';
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
											<label for="<?php echo $field['name']; ?>"><?php _e($field['label'], 'epl-bd'); ?></label>
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
																echo '<option value="" selected="selected">'.__($field['default'], 'epl-bd').'</option>';
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
																	
																	echo '<option value="'.$k.'" '.$selected.'>'.__($v, 'epl-bd').'</option>';
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
																echo '<span class="epl-field-row"><input type="checkbox" name="'.$field['name'].'[]" id="'.$field['name'].'_'.$k.'" value="'.$k.'" '.$checked.' /> <label for="'.$field['name'].'_'.$k.'">'.__($v, 'epl-bd').'</label></span>';
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
																echo '<span class="epl-field-row"><input type="radio" name="'.$field['name'].'" id="'.$field['name'].'_'.$k.'" value="'.$k.'" '.$checked.' /> <label for="'.$field['name'].'_'.$k.'">'.__($v, 'epl-bd').'</label></span>';
															}
														}
														break;
									
													case 'image':
														if($val != '') {
															$img = $val;
														} else {
															$img = plugin_dir_url( __FILE__ ).'images/no_image.jpg';
														}
														echo '
															<div class="epl-media-row">
																<input type="text" name="'.$field['name'].'" id="'.$field['name'].'" value="'.stripslashes($val).'" />
																&nbsp;&nbsp;<input type="button" name="epl_upload_button" class="button" value="'.__('Add File', 'epl-bd').'" />
																&nbsp;&nbsp;<img src="'.$img.'" alt="" />
																<div class="epl-clear"></div>
															</div>
														';
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
														
													default:
														$atts = '';
														if($field['maxlength'] > 0) {
															$atts = ' maxlength="'.$field['maxlength'].'"';
														}
														echo '<input type="'.$field['type'].'" name="'.$field['name'].'" id="'.$field['name'].'" value="'.stripslashes($val).'" '.$atts.' />';
												}
												
												if( isset($field['geocoder']) && $field['geocoder'] == 'true' ) {
													echo '<span class="epl-geocoder-button"></span>';
												}												
												
												if(isset($field['help'])) {
													$field['help'] = trim($field['help']);
													if(!empty($field['help'])) {
														echo '<span class="epl-help-text">'.__($field['help'], 'epl-bd').'</span>';
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
		<input type="hidden" name="epl_bd_meta_box_ids[]" value="<?php echo $args['id']; ?>" />
		<div class="epl-clear"></div>
		<?php
	}
}
add_action( 'add_meta_boxes', 'epl_bd_add_meta_boxes' );
/**
 * Save and update meta box values to the post-edit page
 *
 * @since 1.0
 */
function epl_bd_save_meta_boxes( $post_ID ) {
	if ( ! isset( $_POST['epl_inner_custom_box_nonce'] ) )
		return $post_ID;
	$nonce = $_POST['epl_inner_custom_box_nonce'];
	if ( ! wp_verify_nonce( $nonce, 'epl_inner_custom_box' ) )
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
	
	
	$epl_bd_meta_box_ids = '';
	if(isset($_POST['epl_bd_meta_box_ids'])) {
		$epl_bd_meta_box_ids = $_POST['epl_bd_meta_box_ids'];
	}
	
	if(!empty($epl_bd_meta_box_ids)) {
		global $epl_bd_meta_boxes;
		if(!empty($epl_bd_meta_boxes)) {
			foreach($epl_bd_meta_box_ids as $epl_meta_box_id) {
				foreach($epl_bd_meta_boxes as $epl_meta_box) {
					if($epl_meta_box['id'] == $epl_meta_box_id) {
						if(!empty($epl_meta_box['groups'])) {
							foreach($epl_meta_box['groups'] as $group) {
								if(!empty($group['fields'])) {
									foreach($group['fields'] as $field) {
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
add_action( 'save_post', 'epl_bd_save_meta_boxes' );