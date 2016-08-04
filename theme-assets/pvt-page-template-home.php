<?php
/*
Template Name: Panorama - Virtual Tour
*/
$current_page_id = get_the_ID();
$content = get_post($current_page_id);
$content = $content->post_content;
$tour_id = explode('tour-id="', $content);
if (count($tour_id)>1) {
	$tour_id = explode('"', $tour_id[1]);
	$tour_id = (int) $tour_id[0];
}else{
	wp_die('<div style="text-align:center">Invalid <strong style="color:red">Virtual tour shortcode</strong>, Please ensure proper tour shortcode for this page.</div>');
}
$tour = get_post($tour_id);
if($tour==null){
	wp_die('Invalid <strong style="color:red">Virtual tour</strong>, Maybe deleted, Unpublish, Drafts or not post yet.');
}
$post_metas = get_post_meta($tour_id);
$thumb_image 	= wp_get_attachment_url(get_post_thumbnail_id($tour_id));
$tour_parmalink = get_permalink($current_page_id);
$tour_assets = plugins_url('panorama-virtual-tour');
?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">	
	<meta name="keywords" content="<?php echo $post_metas['pvt_meta_keywords'][0] ?>" />
	<meta name="description" content="<?php echo $post_metas['pvt_meta_description'][0] ?>" />
	<title><?php echo bloginfo('blogname') .' &rsaquo;&rsaquo; '. $tour->post_title ?></title>
	<meta name="medium" content="mult" />
	<meta name="video_height" content="480" />
	<meta name="video_width" content="640" />

	<meta name="thumbnail" content="<?php echo $thumb_image ?>" />
	<meta property="og:url" content="<?php echo $tour_parmalink ?>">
	<meta property="og:image" content="<?php echo $thumb_image ?>">
	<link rel="image_src" href="<?php echo $thumb_image ?>" />

	<meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<!--[if !IE]><!-->
	<script type="text/javascript" src="<?php echo $tour_assets .'/js/jquery-2.1.1.min.js'; ?>"></script>
	<!--<![endif]-->
	<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php echo $tour_assets .'/js/jquery-1.11.1.min.js'; ?>"></script>
	<![endif]-->
	<!--[if gt IE 8]>
	<script type="text/javascript" src="<?php echo $tour_assets .'/js/jquery-2.1.1.min.js'; ?>"></script>
	<![endif]-->
	<link type="text/css" href="<?php echo $tour_assets .'/css/jquery-ui.min.css'; ?>" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="<?php echo $tour_assets .'/css/panorama-virtual-tour.css'; ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo $tour_assets .'/css/panorama-virtual-'.$post_metas['pvt_meta_tour_type'][0].'.css'; ?>" />
	<style type="text/css"><?php echo $post_metas['pvt_meta_custom_css'][0] ?></style>
	<script type="text/javascript">
		function readDeviceOrientation() {
			var winH = window.innerHeight ? window.innerHeight : jQuery(window).height();
			var winW = window.innerWidth ? window.innerWidth : jQuery(window).width();
			if(!winH || winH == 0){
				winH = '100%';
			}
			jQuery('html').css('height', winH);
			window.scrollTo(0,0);
		}
		jQuery( document ).ready(function() {
			if (/(iphone|ipod|ipad|android|iemobile|webos|fennec|blackberry|kindle|series60|playbook|opera\smini|opera\smobi|opera\stablet|symbianos|palmsource|palmos|blazer|windows\sce|windows\sphone|wp7|bolt|doris|dorothy|gobrowser|iris|maemo|minimo|netfront|semc-browser|skyfire|teashark|teleca|uzardweb|avantgo|docomo|kddi|ddipocket|polaris|eudoraweb|opwv|plink|plucker|pie|xiino|benq|playbook|bb|cricket|dell|bb10|nintendo|up.browser|playstation|tear|mib|obigo|midp|mobile|tablet)/.test(navigator.userAgent.toLowerCase())) {
				if (window.addEventListener) {
					window.addEventListener("load", readDeviceOrientation);
					window.addEventListener("resize", readDeviceOrientation);
					window.addEventListener("orientationchange", readDeviceOrientation);
				}
				setTimeout(function(){readDeviceOrientation();},10);
			}
		});
	</script>
</head>
<body>
	<?php
		if (have_posts()) {
			while(have_posts()){
				the_post();
				the_content();
			}
		}
	?>
	<script type="text/javascript" src="<?php echo $post_metas['pvt_meta_folder_location'][0] ?>/indexdata/index.js"></script>
	<script type="text/javascript">
		embedpano({
			swf 	: "<?php echo $post_metas['pvt_meta_folder_location'][0] ?>/indexdata/index.swf",
			target 	: "panoDIV",
			passQueryParameters : true,
			wmode 	: "opaque"
		});
	</script>
	<script type="text/javascript">
		var CROSS_DOMAIN_PATH = '<?php echo $post_metas['pvt_meta_folder_location'][0] ?>/';
	</script>
	<script type="text/javascript" src="<?php echo $tour_assets .'/js/jquery-ui.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo $tour_assets .'/js/jquery.ui.touch-punch.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo $tour_assets .'/js/KolorTools.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo $tour_assets .'/js/KolorBootstrap.js'; ?>"></script>
</body>
</html>