<?php
	$metabox_tour_address = get_post_meta( $post->ID, 'pvt_meta_address', true );
	$metabox_tour_email_address = get_post_meta( $post->ID, 'pvt_meta_email_address', true );
	$metabox_tour_contact_number = get_post_meta( $post->ID, 'pvt_meta_contact_number', true );
	$metabox_tour_shopinfo = get_post_meta( $post->ID, 'pvt_meta_shopinfo', true );
	$metabox_tour_place = get_post_meta( $post->ID, 'pvt_meta_place', true );
?>


<table width="100%">
	<tbody>
		<tr>
			<td>Address</td>
			<td>
				<textarea id="metabox_tour_address" name="metabox_tour_address" style="width:99%;padding:1%" ><?php echo esc_attr( $metabox_tour_address ); ?></textarea>
			</td>
		</tr>
		<tr>
			<td>Email ID</td>
			<td>
				<input type="text" id="metabox_tour_email_address" name="metabox_tour_email_address" value="<?php echo esc_attr( $metabox_tour_email_address ); ?>" style="width:99%;padding:1%" />
			</td>
		</tr>
		<tr>
			<td>Contact Number</td>
			<td>
				<input type="text" id="metabox_tour_contact_number" name="metabox_tour_contact_number" value="<?php echo esc_attr( $metabox_tour_contact_number ); ?>" style="width:99%;padding:1%" />
			</td>
		</tr>
		<tr>
			<td>Shop Info</td>
			<td>
				<textarea id="metabox_tour_shopinfo" name="metabox_tour_shopinfo" style="width:99%;padding:1%" ><?php echo esc_attr( $metabox_tour_shopinfo ); ?></textarea>
			</td>
		</tr>
		<tr>
			<td>Place</td>
			<td>
				<input type="text" id="metabox_tour_place" name="metabox_tour_place" value="<?php echo esc_attr( $metabox_tour_place ); ?>" style="width:99%;padding:1%" />
			</td>
		</tr>
	</tbody>
</table>