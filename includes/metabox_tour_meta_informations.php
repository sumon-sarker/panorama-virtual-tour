<?php
	$metabox_tour_meta_keywords = get_post_meta( $post->ID, 'pvt_meta_keywords', true );
	$metabox_tour_meta_description = get_post_meta( $post->ID, 'pvt_meta_description', true );
?>
<table width="100%">
	<tbody>
		<tr>
			<td>Meta Keywords</td>
			<td>
				<input type="text" id="metabox_tour_meta_keywords" name="metabox_tour_meta_keywords" value="<?php echo esc_attr( $metabox_tour_meta_keywords ); ?>" style="width:99%;padding:1%" placeholder="Ex: DaysKitchen, Campus, etc"/>
			</td>
		</tr>
		<tr>
			<td>Meta Description</td>
			<td>
				<textarea id="metabox_tour_meta_description" name="metabox_tour_meta_description" style="width:99%;padding:1%" ><?php echo esc_attr( $metabox_tour_meta_description ); ?></textarea>
			</td>
		</tr>
	</tbody>
</table>