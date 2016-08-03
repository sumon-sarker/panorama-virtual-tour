<?php
	$facebook 	= get_post_meta( $post->ID, 'pvt_meta_facebook_url', true );
	$twitter 	= get_post_meta( $post->ID, 'pvt_meta_twitter_url', true );
	$linkedin 	= get_post_meta( $post->ID, 'pvt_meta_linkedin_url', true );
	$googleplus = get_post_meta( $post->ID, 'pvt_meta_googleplus_url', true );
	$line 		= get_post_meta( $post->ID, 'pvt_meta_line_url', true );
	$youtube 	= get_post_meta( $post->ID, 'pvt_meta_youtube_url', true );
?>
<table width="100%">
	<tbody>
		<tr>
			<td>Facebook</td>
			<td>
				<input type="text" id="metabox_tour_facebook_url" name="metabox_tour_facebook_url" value="<?php echo esc_attr( $facebook ); ?>" style="width:99%;padding:1%" placeholder="Facebook link"/>
			</td>
		</tr>
		<tr>
			<td>Twitter</td>
			<td>
				<input type="text" id="metabox_tour_twitter_url" name="metabox_tour_twitter_url" value="<?php echo esc_attr( $twitter ); ?>" style="width:99%;padding:1%" placeholder="Twitter link"/>
			</td>
		</tr>
		<tr>
			<td>LinkedIn</td>
			<td>
				<input type="text" id="metabox_tour_linkedin_url" name="metabox_tour_linkedin_url" value="<?php echo esc_attr( $linkedin ); ?>" style="width:99%;padding:1%" placeholder="LinkedIn link"/>
			</td>
		</tr>
		<tr>
			<td>Google+</td>
			<td>
				<input type="text" id="metabox_tour_googleplug_url" name="metabox_tour_googleplug_url" value="<?php echo esc_attr( $googleplus ); ?>" style="width:99%;padding:1%" placeholder="Google+ link"/>
			</td>
		</tr>
		<tr>
			<td>LINE</td>
			<td>
				<input type="text" id="metabox_tour_line_url" name="metabox_tour_line_url" value="<?php echo esc_attr( $line ); ?>" style="width:99%;padding:1%" placeholder="LINE link"/>
			</td>
		</tr>
		<tr>
			<td>Youtube</td>
			<td>
				<input type="text" id="metabox_tour_youtube_url" name="metabox_tour_youtube_url" value="<?php echo esc_attr( $youtube ); ?>" style="width:99%;padding:1%" placeholder="Youtube link"/>
			</td>
		</tr>
	</tbody>
</table>