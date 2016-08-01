<?php $value = get_post_meta( $post->ID, 'pvt_meta_copyright_text', true ); ?>

<input type="text" id="metabox_tour_copyright_text" name="metabox_tour_copyright_text" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />