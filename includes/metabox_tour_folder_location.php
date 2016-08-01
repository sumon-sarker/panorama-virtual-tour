<?php
	wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );
	$value = get_post_meta( $post->ID, 'pvt_meta_folder_location', true );
?>

<input type="text" id="metabox_tour_folder_location" name="metabox_tour_folder_location" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />