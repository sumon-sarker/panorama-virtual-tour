<?php $value = get_post_meta( $post->ID, 'pvt_meta_youtube_url', true ); ?>

<input type="text" id="metabox_tour_youtube_url" name="metabox_tour_youtube_url" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />