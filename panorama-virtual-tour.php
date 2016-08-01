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
			array(
				'id'		=>'metabox_tour_folder_location',
				'title'		=>'<span style="color:red">{Main}</span> Tour folder location',
				'function' 	=>'metabox_tour_folder_location'
			),
			#Logo=============================================
			array(
				'id'		=>'metabox_tour_logo_url',
				'title'		=>'<span style="color:red">{Logo}</span> Logo URL',
				'function' 	=>'demo'
			),
			#Homepage=========================================
			array(
				'id'		=>'metabox_tour_homepage_url',
				'title'		=>'<span style="color:yellow">{Homepage}</span> Homepage URL',
				'function' 	=>'demo'
			),
			#SocialMedia======================================
			array(
				'id'		=>'metabox_tour_facebook_url',
				'title'		=>'<span style="color:green">{SocialMedia}</span> Facebook URL',
				'function' 	=>'demo'
			),
			array(
				'id'		=>'metabox_tour_twitter_url',
				'title'		=>'<span style="color:green">{SocialMedia}</span> Twitter URL',
				'function' 	=>'demo'
			),
			array(
				'id'		=>'metabox_tour_linkedin_url',
				'title'		=>'<span style="color:green">{SocialMedia}</span> Linkedin URL',
				'function' 	=>'demo'
			),
			array(
				'id'		=>'metabox_tour_googleplug_url',
				'title'		=>'<span style="color:green">{SocialMedia}</span> Google+ URL',
				'function' 	=>'demo'
			),
			array(
				'id'		=>'metabox_tour_line_url',
				'title'		=>'<span style="color:green">{SocialMedia}</span> LINE URL',
				'function' 	=>'demo'
			),
			array(
				'id'		=>'metabox_tour_youtube_url',
				'title'		=>'<span style="color:green">{SocialMedia}</span> Youtube URL',
				'function' 	=>'demo'
			),
			#Contact==========================================
			array(
				'id'		=>'metabox_tour_email_address',
				'title'		=>'<span style="color:#3cf">{Contact}</span> Email address',
				'function' 	=>'demo'
			),
			array(
				'id'		=>'metabox_tour_contact_number',
				'title'		=>'<span style="color:#3cf">{Contact}</span> Contact number',
				'function' 	=>'demo'
			),
			#Location=========================================
			array(
				'id'		=>'metabox_tour_address',
				'title'		=>'<span style="color:blue">{Location}</span> Address',
				'function' 	=>'demo'
			),
			array(
				'id'		=>'metabox_tour_shopinfo',
				'title'		=>'<span style="color:blue">{Location}</span> Shop information',
				'function' 	=>'demo'
			),
			array(
				'id'		=>'metabox_tour_place',
				'title'		=>'<span style="color:blue">{Location}</span> Place',
				'function' 	=>'demo'
			),
			#OtherInfo========================================
			array(
				'id'		=>'metabox_tour_copyright_text',
				'title'		=>'<span style="color:lime">{OtherInfo}</span> Copyright text',
				'function' 	=>'demo'
			),
			#MetaInfo=========================================
			array(
				'id'		=>'metabox_tour_meta_keywords',
				'title'		=>'<span style="color:#A52A2A">{MetaInfo}</span> Meta keywords',
				'function' 	=>'demo'
			),
			array(
				'id'		=>'metabox_tour_meta_description',
				'title'		=>'<span style="color:#A52A2A">{MetaInfo}</span> Mets descriptions',
				'function' 	=>'demo'
			),
			#CustomCSS========================================
			array(
				'id'		=>'metabox_tour_meta_custom_css',
				'title'		=>'<span style="color:#ADFF2F">{CustomCSS}</span> Custom CSS',
				'function' 	=>'demo'
			),
			#Map==============================================
			array(
				'id'		=>'metabox_tour_embed_map_url',
				'title'		=>'<span style="color:#FF1493">{Map}</span> Embed map URL',
				'function' 	=>'demo'
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
        $folder_location = sanitize_text_field( $_POST['metabox_tour_folder_location'] );
        #Update the meta field.
        update_post_meta( $post_id, 'pvt_meta_folder_location', $folder_location);
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