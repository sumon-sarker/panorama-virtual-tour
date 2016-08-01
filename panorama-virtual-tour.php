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

/**
* 
*/
class PanoramaVirtualTour{
	
	function __construct(){
		add_action( 'init', array($this,'setup_post_type'));
		register_activation_hook( __FILE__,array($this,'install'));
		register_deactivation_hook( __FILE__, array($this,'uninstall'));
	}

	public function setup_post_type(){
		$labels = array(
			'name'               => _x( 'VirtualTours', 'post type general name', 'sumon-pvt' ),
			'singular_name'      => _x( 'VirtualTour', 'post type singular name', 'sumon-pvt' ),
			'menu_name'          => _x( 'VirtualTours', 'admin menu', 'sumon-pvt' ),
			'name_admin_bar'     => _x( 'VirtualTour', 'add new on admin bar', 'sumon-pvt' ),
			'add_new'            => _x( 'Add New', 'virtual-tour', 'sumon-pvt' ),
			'add_new_item'       => __( 'Add New VirtualTour', 'sumon-pvt' ),
			'new_item'           => __( 'New VirtualTour', 'sumon-pvt' ),
			'edit_item'          => __( 'Edit VirtualTour', 'sumon-pvt' ),
			'view_item'          => __( 'View VirtualTour', 'sumon-pvt' ),
			'all_items'          => __( 'All VirtualTours', 'sumon-pvt' ),
			'search_items'       => __( 'Search VirtualTours', 'sumon-pvt' ),
			'parent_item_colon'  => __( 'Parent VirtualTours:', 'sumon-pvt' ),
			'not_found'          => __( 'No VirtualTours found.', 'sumon-pvt' ),
			'not_found_in_trash' => __( 'No VirtualTours found in Trash.', 'sumon-pvt' )
		);

		$args = array(
			'labels'             => $labels,
	        'description'        => __( 'Description.', 'sumon-pvt' ),
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
				'author',
				'thumbnail',
				'excerpt',
				'comments',
				'custom-fields'
			),
			'taxonomies'		 => array('category')
		);
		register_post_type('virtual-tour', $args);
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