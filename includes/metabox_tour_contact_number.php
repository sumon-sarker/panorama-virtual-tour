<?php $value = get_post_meta( $post->ID, 'pvt_meta_contact_number', true ); ?>

<input type="text" id="metabox_tour_contact_number" name="metabox_tour_contact_number" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />