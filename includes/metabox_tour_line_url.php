<?php $value = get_post_meta( $post->ID, 'pvt_meta_line_url', true ); ?>

<input type="text" id="metabox_tour_line_url" name="metabox_tour_line_url" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />