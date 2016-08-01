<?php $value = get_post_meta( $post->ID, 'pvt_meta_email_address', true ); ?>

<input type="text" id="metabox_tour_email_address" name="metabox_tour_email_address" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />