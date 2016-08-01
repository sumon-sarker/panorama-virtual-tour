<?php $value = get_post_meta( $post->ID, 'pvt_meta_shopinfo', true ); ?>

<input type="text" id="metabox_tour_shopinfo" name="metabox_tour_shopinfo" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />