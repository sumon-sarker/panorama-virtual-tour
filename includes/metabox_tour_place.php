<?php $value = get_post_meta( $post->ID, 'pvt_meta_place', true ); ?>

<input type="text" id="metabox_tour_place" name="metabox_tour_place" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />