<?php
	wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );
	$metabox_tour_folder_location = get_post_meta( $post->ID, 'pvt_meta_folder_location', true );
	$metabox_tour_type = get_post_meta( $post->ID, 'pvt_meta_tour_type', true );
	$single 	= '';
	$multiple 	='';
	switch ($metabox_tour_type) {
		case 'single':
			$single = 'checked="checked"';
		break;
		case 'multiple':
			$multiple = 'checked="checked"';
		break;
		default:
			$single = 'checked="checked"';
		break;
	}
?>
<table width="100%">
	<tbody>
		<tr>
			<td>Tour location</td>
			<td>
				<input type="text" id="metabox_tour_folder_location" name="metabox_tour_folder_location" value="<?php echo esc_attr( $metabox_tour_folder_location ); ?>" style="width:99%;padding:1%" />
			</td>
		</tr>
		<tr>
			<td>Tour type</td>
			<td>
				<label style="display:block;margin:10px">
					<input <?php echo $single ?> type="radio" name="metabox_tour_type" value="single"> Single
				</label>
				<label style="display:block;margin:10px">
					<input <?php echo $multiple ?> type="radio" name="metabox_tour_type" value="multiple"> Multiple
				</label>
			</td>
		</tr>
	</tbody>
</table>