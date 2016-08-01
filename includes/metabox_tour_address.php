<?php $value = get_post_meta( $post->ID, 'pvt_meta_address', true ); ?>


<textarea id="metabox_tour_address" name="metabox_tour_address" style="width:99%;padding:1%" ><?php echo esc_attr( $value ); ?></textarea>