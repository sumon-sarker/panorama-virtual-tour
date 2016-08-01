<?php $value = get_post_meta( $post->ID, 'pvt_meta_logo_url', true ); ?>

<?php if ($value!="") { ?>
	<div style="text-align:center">
		<img src="<?php echo $value ?>" alt="<?php echo $value ?>"  style="max-width:100px" />
	</div>
<?php } ?>

<input type="text" id="metabox_tour_logo_url" name="metabox_tour_logo_url" value="<?php echo esc_attr( $value ); ?>" style="width:99%;padding:1%" />