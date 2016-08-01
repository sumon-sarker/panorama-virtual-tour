<?php
/*
Plugin Name: Panorama - VirtualTours
Plugin URI:  https://github.com/sumon-sarker/panorama-virtual-tour
Description: A panorama is any wide-angle view or representation of a physical space, this plugin will help you to add your ready tour to your wordpress site.
Version:     1.0
Author:      Sumon Sarker
Author URI:  http://sumonsarker.com/
License:     GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Domain Path: /languages
Text Domain: sumon-pvt
*/

class PanoramaVirtualTour{

	private $pvt_post_type 		= 'virtual-tour';

	private $pvt_text_domain 	= 'sumon-pvt';

	function __construct(){
		add_action('init', array($this,'setup_post_type'));
		add_action('save_post',array($this,'save_post_metas'));

		register_activation_hook( __FILE__,array($this,'install'));
		register_deactivation_hook( __FILE__, array($this,'uninstall'));
	}

	public function pvt_get_post_type(){
		return $this->pvt_post_type;
	}

	public function setup_post_type(){
		$labels = array(
			'name'               => _x( 'VirtualTours', 'post type general name', $this->pvt_text_domain ),
			'singular_name'      => _x( 'VirtualTour', 'post type singular name', $this->pvt_text_domain ),
			'menu_name'          => _x( 'VirtualTours', 'admin menu', $this->pvt_text_domain ),
			'name_admin_bar'     => _x( 'VirtualTour', 'add new on admin bar', $this->pvt_text_domain ),
			'add_new'            => _x( 'Add New', 'virtual-tour', $this->pvt_text_domain ),
			'add_new_item'       => __( 'Add New VirtualTour', $this->pvt_text_domain ),
			'new_item'           => __( 'New VirtualTour', $this->pvt_text_domain ),
			'edit_item'          => __( 'Edit VirtualTour', $this->pvt_text_domain ),
			'view_item'          => __( 'View VirtualTour', $this->pvt_text_domain ),
			'all_items'          => __( 'All VirtualTours', $this->pvt_text_domain ),
			'search_items'       => __( 'Search VirtualTours', $this->pvt_text_domain ),
			'parent_item_colon'  => __( 'Parent VirtualTours:', $this->pvt_text_domain ),
			'not_found'          => __( 'No VirtualTours found.', $this->pvt_text_domain ),
			'not_found_in_trash' => __( 'No VirtualTours found in Trash.', $this->pvt_text_domain )
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Description.', $this->pvt_text_domain ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'virtual-tour' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'menu_icon' 		 => 'dashicons-admin-site',
			'supports'           => array(
				'title',
				'editor',
				#'author',
				'thumbnail',
				#'excerpt',
				#'comments',
				#'custom-fields'
			),
			'taxonomies'		 => array('category'),
			'register_meta_box_cb'=>array($this,'set_metaboxes')
		);
		register_post_type($this->pvt_post_type, $args);
	}

	public function set_metaboxes(){

		$meta_boxes = array(
			#Logo=============================================
			array(
				'id'		=>'metabox_tour_logo_url',
				'title'		=>'<span style="color:red" class="dashicons dashicons-awards"></span> Logo URL',
				'function' 	=>'metabox_tour_logo_url'
			),
			#TourFolder
			array(
				'id'		=>'metabox_tour_folder_location',
				'title'		=>'<span style="color:green" class="dashicons dashicons-marker"></span> Tour folder location',
				'function' 	=>'metabox_tour_folder_location'
			),
			#Homepage=========================================
			array(
				'id'		=>'metabox_tour_homepage_url',
				'title'		=>'<span style="color:lime" class="dashicons dashicons-admin-home"></span> Homepage URL',
				'function' 	=>'metabox_tour_homepage_url'
			),
			#Contact==========================================
			array(
				'id'		=>'metabox_tour_email_address',
				'title'		=>'<span style="color:#3cf" class="dashicons dashicons-email"></span> Email address',
				'function' 	=>'metabox_tour_email_address'
			),
			array(
				'id'		=>'metabox_tour_contact_number',
				'title'		=>'<span style="color:#3cf" class="dashicons dashicons-email"></span> Contact number',
				'function' 	=>'metabox_tour_contact_number'
			),
			#SocialMedia======================================
			array(
				'id'		=>'metabox_tour_facebook_url',
				'title'		=>'<span style="color:green" class="dashicons dashicons-networking"></span> Facebook URL',
				'function' 	=>'metabox_tour_facebook_url'
			),
			array(
				'id'		=>'metabox_tour_twitter_url',
				'title'		=>'<span style="color:green" class="dashicons dashicons-networking"></span> Twitter URL',
				'function' 	=>'metabox_tour_twitter_url'
			),
			array(
				'id'		=>'metabox_tour_linkedin_url',
				'title'		=>'<span style="color:green" class="dashicons dashicons-networking"></span> Linkedin URL',
				'function' 	=>'metabox_tour_linkedin_url'
			),
			array(
				'id'		=>'metabox_tour_googleplug_url',
				'title'		=>'<span style="color:green" class="dashicons dashicons-networking"></span> Google+ URL',
				'function' 	=>'metabox_tour_googleplug_url'
			),
			array(
				'id'		=>'metabox_tour_line_url',
				'title'		=>'<span style="color:green" class="dashicons dashicons-networking"></span> LINE URL',
				'function' 	=>'metabox_tour_line_url'
			),
			array(
				'id'		=>'metabox_tour_youtube_url',
				'title'		=>'<span style="color:green" class="dashicons dashicons-networking"></span> Youtube URL',
				'function' 	=>'metabox_tour_youtube_url'
			),
			#Location=========================================
			array(
				'id'		=>'metabox_tour_address',
				'title'		=>'<span style="color:blue" class="dashicons dashicons-location-alt"></span> Address',
				'function' 	=>'metabox_tour_address'
			),
			array(
				'id'		=>'metabox_tour_shopinfo',
				'title'		=>'<span style="color:blue" class="dashicons dashicons-location-alt"></span> Shop information',
				'function' 	=>'metabox_tour_shopinfo'
			),
			array(
				'id'		=>'metabox_tour_place',
				'title'		=>'<span style="color:blue" class="dashicons dashicons-location-alt"></span> Place',
				'function' 	=>'metabox_tour_place'
			),
			#OtherInfo========================================
			array(
				'id'		=>'metabox_tour_copyright_text',
				'title'		=>'<span style="color:lime" class="dashicons dashicons-warning"></span> Copyright text',
				'function' 	=>'metabox_tour_copyright_text'
			),
			#MetaInfo=========================================
			array(
				'id'		=>'metabox_tour_meta_keywords',
				'title'		=>'<span style="color:#A52A2A" class="dashicons dashicons-clipboard"></span> Meta keywords',
				'function' 	=>'metabox_tour_meta_keywords'
			),
			array(
				'id'		=>'metabox_tour_meta_description',
				'title'		=>'<span style="color:#A52A2A" class="dashicons dashicons-clipboard"></span> Mets descriptions',
				'function' 	=>'metabox_tour_meta_description'
			),
			#CustomCSS========================================
			array(
				'id'		=>'metabox_tour_meta_custom_css',
				'title'		=>'<span style="color:#ACDC2F" class="dashicons dashicons-editor-spellcheck"></span> Custom CSS',
				'function' 	=>'metabox_tour_meta_custom_css'
			),
			#Map==============================================
			array(
				'id'		=>'metabox_tour_embed_map_url',
				'title'		=>'<span class="dashicons dashicons-location"></span> Embed map URL',
				'function' 	=>'metabox_tour_embed_map_url'
			),
		);

		foreach($meta_boxes as $key => $value) {
			add_meta_box(
                $value['id'],
                __($value['title'],$this->pvt_text_domain),
                array($this, $value['function']),
                $this->pvt_post_type,
                'advanced',
                'high'
            );
		}
	}

	public function metabox_tour_folder_location($post){
		include_once 'includes/metabox_tour_folder_location.php';
	}

	public function metabox_tour_logo_url($post){
		include_once 'includes/metabox_tour_logo_url.php';
	}

	public function metabox_tour_homepage_url($post){
		include_once 'includes/metabox_tour_homepage_url.php';
	}

	public function metabox_tour_email_address($post){
		include_once 'includes/metabox_tour_email_address.php';
	}

	public function metabox_tour_contact_number($post){
		include_once 'includes/metabox_tour_contact_number.php';
	}

	public function metabox_tour_address($post){
		include_once 'includes/metabox_tour_address.php';
	}

	public function metabox_tour_shopinfo($post){
		include_once 'includes/metabox_tour_shopinfo.php';
	}

	public function metabox_tour_place($post){
		include_once 'includes/metabox_tour_place.php';
	}

	public function metabox_tour_facebook_url($post){
		include_once 'includes/metabox_tour_facebook_url.php';
	}

	public function metabox_tour_twitter_url($post){
		include_once 'includes/metabox_tour_twitter_url.php';
	}

	public function metabox_tour_linkedin_url($post){
		include_once 'includes/metabox_tour_linkedin_url.php';
	}

	public function metabox_tour_googleplug_url($post){
		include_once 'includes/metabox_tour_googleplug_url.php';
	}

	public function metabox_tour_line_url($post){
		include_once 'includes/metabox_tour_line_url.php';
	}

	public function metabox_tour_youtube_url($post){
		include_once 'includes/metabox_tour_youtube_url.php';
	}

	public function metabox_tour_copyright_text($post){
		include_once 'includes/metabox_tour_copyright_text.php';
	}

	public function metabox_tour_meta_keywords($post){
		include_once 'includes/metabox_tour_meta_keywords.php';
	}

	public function metabox_tour_meta_description($post){
		include_once 'includes/metabox_tour_meta_description.php';
	}

	public function metabox_tour_meta_custom_css($post){
		include_once 'includes/metabox_tour_meta_custom_css.php';
	}

	public function metabox_tour_embed_map_url($post){
		include_once 'includes/metabox_tour_embed_map_url.php';
	}

	public function demo($post){
		include_once 'includes/metabox_demo.php';
	}

	public function save_post_metas($post_id){
		if (!isset($_POST['myplugin_inner_custom_box_nonce'] )) {
            return $post_id;
        }
        $nonce = $_POST['myplugin_inner_custom_box_nonce'];
        if (!wp_verify_nonce($nonce,'myplugin_inner_custom_box')){
            return $post_id;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
            return $post_id;
        }

        #Check the user's permissions.
        if ('page'==$_POST['post_type']){
            if (! current_user_can( 'edit_page', $post_id)){
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)){
                return $post_id;
            }
        }


        #Sanitize the user input.
        $logo_url 			= sanitize_text_field($_POST['metabox_tour_logo_url']);
        $folder_location 	= sanitize_text_field($_POST['metabox_tour_folder_location']);
        $homepage_url 		= sanitize_text_field($_POST['metabox_tour_homepage_url']);

        $email_address 		= sanitize_text_field($_POST['metabox_tour_email_address']);
        $contact_number 	= sanitize_text_field($_POST['metabox_tour_contact_number']);

        $address 			= sanitize_text_field($_POST['metabox_tour_address']);
        $shopinfo 			= sanitize_text_field($_POST['metabox_tour_shopinfo']);
        $place 				= sanitize_text_field($_POST['metabox_tour_place']);

        $facebook_url		= sanitize_text_field($_POST['metabox_tour_facebook_url']);
        $twitter_url		= sanitize_text_field($_POST['metabox_tour_twitter_url']);
        $linkedin_url		= sanitize_text_field($_POST['metabox_tour_linkedin_url']);
        $googleplus_url		= sanitize_text_field($_POST['metabox_tour_googleplug_url']);
        $line_url			= sanitize_text_field($_POST['metabox_tour_line_url']);
        $youtube_url		= sanitize_text_field($_POST['metabox_tour_youtube_url']);

        $copyright_text		= sanitize_text_field($_POST['metabox_tour_copyright_text']);

        $meta_keywords		= sanitize_text_field($_POST['metabox_tour_meta_keywords']);
        $meta_description	= sanitize_text_field($_POST['metabox_tour_meta_description']);
        
        $custom_css			= sanitize_text_field($_POST['metabox_tour_meta_custom_css']);

        $embed_map_ur		= sanitize_text_field($_POST['metabox_tour_embed_map_url']);

        #Update the meta field.
        update_post_meta( $post_id, 'pvt_meta_logo_url', $logo_url);
        update_post_meta( $post_id, 'pvt_meta_folder_location', $folder_location);
        update_post_meta( $post_id, 'pvt_meta_homepage_url', $homepage_url);
        update_post_meta( $post_id, 'pvt_meta_email_address', $email_address);
        update_post_meta( $post_id, 'pvt_meta_contact_number', $contact_number);

        update_post_meta( $post_id, 'pvt_meta_address', $address);
        update_post_meta( $post_id, 'pvt_meta_shopinfo', $shopinfo);
        update_post_meta( $post_id, 'pvt_meta_place', $place);

        update_post_meta( $post_id, 'pvt_meta_facebook_url', $facebook_url);
        update_post_meta( $post_id, 'pvt_meta_twitter_url', $twitter_url);
        update_post_meta( $post_id, 'pvt_meta_linkedin_url', $linkedin_url);
        update_post_meta( $post_id, 'pvt_meta_googleplus_url', $googleplus_url);
        update_post_meta( $post_id, 'pvt_meta_line_url', $line_url);
        update_post_meta( $post_id, 'pvt_meta_youtube_url', $youtube_url);

        update_post_meta( $post_id, 'pvt_meta_copyright_text', $copyright_text);

        update_post_meta( $post_id, 'pvt_meta_keywords', $meta_keywords);
        update_post_meta( $post_id, 'pvt_meta_description', $meta_description);
        
        update_post_meta( $post_id, 'pvt_meta_custom_css', $custom_css);
        update_post_meta( $post_id, 'pvt_meta_embed_map_url', $embed_map_ur);


	}

	public function install(){
	    $this->setup_post_type();
	    flush_rewrite_rules();
	}

	public function uninstall(){
		flush_rewrite_rules();
	}
}

(new PanoramaVirtualTour());