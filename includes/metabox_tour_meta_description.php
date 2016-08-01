<?php $value = get_post_meta( $post->ID, 'pvt_meta_description', true ); ?>


<textarea id="metabox_tour_meta_description" name="metabox_tour_meta_description" style="width:99%;padding:1%" ><?php echo esc_attr( $value ); ?></textarea>