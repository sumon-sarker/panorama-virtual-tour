<?php $value = get_post_meta( $post->ID, 'pvt_meta_keywords', true ); ?>

<input type="text" id="metabox_tour_meta_keywords" name="metabox_tour_meta_keywords" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />