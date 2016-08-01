<?php if($post->ID) { ?>
	Paste this <strong style="color:red;margin:0px 20px">[virtual_tour tour-id="<?php echo $post->ID ?>"]</strong> shortcode to your page or post
<?php } else{ ?>
	<strong>No shortcode found, You have to save this post first</strong>
<?php } ?>