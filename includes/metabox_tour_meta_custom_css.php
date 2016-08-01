<?php $value = get_post_meta( $post->ID, 'pvt_meta_custom_css', true ); ?>


<textarea id="metabox_tour_meta_custom_css" name="metabox_tour_meta_custom_css" style="width:99%;padding:1%" ><?php echo esc_attr( $value ); ?></textarea>