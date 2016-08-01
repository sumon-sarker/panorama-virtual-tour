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
		add_action( 'init', array($this,'setup_post_type'));
		add_action( 'save_post',array($this,'save_post_metas'));

		register_activation_hook( __FILE__,array($this,'install'));
		register_deactivation_hook( __FILE__, array($this,'uninstall'));
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
		add_meta_box(
                'metabox_tour_folder_location',
                __( 'Tour folder location', $this->pvt_text_domain ),
                array( $this, 'metabox_tour_folder_location' ),
                $this->pvt_post_type,
                'advanced',
                'high'
            );
	}

	public function metabox_tour_folder_location($post){
		include_once 'includes/metabox_tour_folder_location.php';
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