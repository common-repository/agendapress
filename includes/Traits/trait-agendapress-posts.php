<?php
namespace Agendapress\Includes\Traits;

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://wordpress.org/plugins/agendapress
 * @since      1.0.0
 *
 * @package    Agendapress
 * @subpackage Agendapress/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Agendapress
 * @subpackage Agendapress/includes
 * @author     Md Kabir Uddin <bd.kabiruddin@gmail.com>
 */
trait Agendapress_Posts {

	public function screen($screen_element) {
		$screen_element = explode('/', $screen_element);
		return current($screen_element);
	}

	public function screen_s($screen_element) {
		$screen_element = explode('/', $screen_element);
		return $screen_element[1] ? $screen_element[1] : $screen_element[0];
	}
	/**
	 * Register a agenda post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function registe_posts() {


		$screen_type = get_option( 'screen_type') ? get_option( 'screen_type') : 'default';

		$screen_elements = get_option( 'screen_elements') ? get_option( 'screen_elements')[$screen_type] : array (
            'agenda' => 'Agenda/ Agendas',
            'meeting' => 'Meeting / Meetings',
            'organization' => 'Organization / Organizations',
            'session' => 'Session / Sessions',
            'speaker' => 'Speaker / Speakers',
            'venue' => 'Venue / Venues',
		);


		$screen_elements['agenda']= $screen_elements['agenda'] ? $screen_elements['agenda'] : 'Agenda/ Agendas';
		$screen_elements['meeting']= $screen_elements['meeting'] ? $screen_elements['meeting'] : 'Meeting / Meetings';
		$screen_elements['organization']= $screen_elements['organization'] ? $screen_elements['organization'] : 'Organization / Organizations';
		$screen_elements['session']= $screen_elements['session'] ? $screen_elements['session'] : 'Session / Sessions';
		$screen_elements['speaker']= $screen_elements['speaker'] ? $screen_elements['speaker'] : 'Speaker / Speakers';
		$screen_elements['venue']= $screen_elements['venue'] ? $screen_elements['venue'] : 'Venue / Venues';



		$labels = array(
			'name'               => _x( $this->screen_s($screen_elements['agenda']), 'post type general name', 'agendapress' ),
			'singular_name'      => _x( $this->screen($screen_elements['agenda']), 'post type singular name', 'agendapress' ),
			'menu_name'          => _x( $this->screen_s($screen_elements['agenda']), 'admin menu', 'agendapress' ),
			'name_admin_bar'     => _x( $this->screen($screen_elements['agenda']), 'add new on admin bar', 'agendapress' ),
			'add_new'            => _x( 'Add New', $this->screen($screen_elements['agenda']), 'agendapress' ),
			'add_new_item'       => __( 'Add New '.$this->screen($screen_elements['agenda']), 'agendapress' ),
			'new_item'           => __( 'New '.$this->screen($screen_elements['agenda']), 'agendapress' ),
			'edit_item'          => __( 'Edit '.$this->screen($screen_elements['agenda']), 'agendapress' ),
			'view_item'          => __( 'View '.$this->screen($screen_elements['agenda']), 'agendapress' ),
			'all_items'          => __( $this->screen_s($screen_elements['agenda']), 'agendapress' ),
			'search_items'       => __( 'Search '.$this->screen_s($screen_elements['agenda']), 'agendapress' ),
			'parent_item_colon'  => __( 'Parent '.$this->screen_s($screen_elements['agenda']).':', 'agendapress' ),
			'not_found'          => __( 'No '.strtolower($this->screen_s($screen_elements['agenda'])).' found.', 'agendapress' ),
			'not_found_in_trash' => __( 'No '.strtolower($this->screen_s($screen_elements['agenda'])).' found in Trash.', 'agendapress' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'agendapress' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'agendapress',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'agenda' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'author' )
		);

		register_post_type( 'agenda', $args );

		$labels = array(
			'name'               => _x( $this->screen_s($screen_elements['session']), 'post type general name', 'agendapress' ),
			'singular_name'      => _x( $this->screen($screen_elements['session']), 'post type singular name', 'agendapress' ),
			'menu_name'          => _x( $this->screen_s($screen_elements['session']), 'admin menu', 'agendapress' ),
			'name_admin_bar'     => _x( $this->screen($screen_elements['session']), 'add new on admin bar', 'agendapress' ),
			'add_new'            => _x( 'Add New', $this->screen($screen_elements['session']), 'agendapress' ),
			'add_new_item'       => __( 'Add New '.$this->screen($screen_elements['session']), 'agendapress' ),
			'new_item'           => __( 'New '.$this->screen($screen_elements['session']), 'agendapress' ),
			'edit_item'          => __( 'Edit '.$this->screen($screen_elements['session']), 'agendapress' ),
			'view_item'          => __( 'View '.$this->screen($screen_elements['session']), 'agendapress' ),
			'all_items'          => __( $this->screen_s($screen_elements['session']), 'agendapress' ),
			'search_items'       => __( 'Search '.$this->screen_s($screen_elements['session']), 'agendapress' ),
			'parent_item_colon'  => __( 'Parent '.$this->screen_s($screen_elements['session']).':', 'agendapress' ),
			'not_found'          => __( 'No '.strtolower($this->screen_s($screen_elements['session'])).' found.', 'agendapress' ),
			'not_found_in_trash' => __( 'No '.strtolower($this->screen_s($screen_elements['session'])).' found in Trash.', 'agendapress' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'agendapress' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'session' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'author' ),
			'capabilities' => array(
				'create_posts' => false,
			),
			'map_meta_cap' => true,
		);

		register_post_type( 'session', $args );

		$labels = array(
			'name'               => _x( $this->screen_s($screen_elements['venue']), 'post type general name', 'agendapress' ),
			'singular_name'      => _x( $this->screen($screen_elements['venue']), 'post type singular name', 'agendapress' ),
			'menu_name'          => _x( $this->screen_s($screen_elements['venue']), 'admin menu', 'agendapress' ),
			'name_admin_bar'     => _x( $this->screen($screen_elements['venue']), 'add new on admin bar', 'agendapress' ),
			'add_new'            => _x( 'Add New', $this->screen($screen_elements['venue']), 'agendapress' ),
			'add_new_item'       => __( 'Add New '.$this->screen($screen_elements['venue']), 'agendapress' ),
			'new_item'           => __( 'New '.$this->screen($screen_elements['venue']), 'agendapress' ),
			'edit_item'          => __( 'Edit '.$this->screen($screen_elements['venue']), 'agendapress' ),
			'view_item'          => __( 'View '.$this->screen($screen_elements['venue']), 'agendapress' ),
			'all_items'          => __( $this->screen_s($screen_elements['venue']), 'agendapress' ),
			'search_items'       => __( 'Search '.$this->screen_s($screen_elements['venue']), 'agendapress' ),
			'parent_item_colon'  => __( 'Parent '.$this->screen_s($screen_elements['venue']).':', 'agendapress' ),
			'not_found'          => __( 'No '.strtolower($this->screen_s($screen_elements['venue'])).' found.', 'agendapress' ),
			'not_found_in_trash' => __( 'No '.strtolower($this->screen_s($screen_elements['venue'])).' found in Trash.', 'agendapress' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'agendapress' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'agendapress',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'venue' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'author', 'thumbnail' )
		);

		register_post_type( 'venue', $args );

		$labels = array(
			'name'               => _x( $this->screen_s($screen_elements['speaker']), 'post type general name', 'agendapress' ),
			'singular_name'      => _x( $this->screen($screen_elements['speaker']), 'post type singular name', 'agendapress' ),
			'menu_name'          => _x( $this->screen_s($screen_elements['speaker']), 'admin menu', 'agendapress' ),
			'name_admin_bar'     => _x( $this->screen($screen_elements['speaker']), 'add new on admin bar', 'agendapress' ),
			'add_new'            => _x( 'Add New', $this->screen($screen_elements['speaker']), 'agendapress' ),
			'add_new_item'       => __( 'Add New '.$this->screen($screen_elements['speaker']), 'agendapress' ),
			'new_item'           => __( 'New '.$this->screen($screen_elements['speaker']), 'agendapress' ),
			'edit_item'          => __( 'Edit '.$this->screen($screen_elements['speaker']), 'agendapress' ),
			'view_item'          => __( 'View '.$this->screen($screen_elements['speaker']), 'agendapress' ),
			'all_items'          => __( $this->screen_s($screen_elements['speaker']), 'agendapress' ),
			'search_items'       => __( 'Search '.$this->screen_s($screen_elements['speaker']), 'agendapress' ),
			'parent_item_colon'  => __( 'Parent '.$this->screen_s($screen_elements['speaker']).':', 'agendapress' ),
			'not_found'          => __( 'No '.strtolower($this->screen_s($screen_elements['speaker'])).' found.', 'agendapress' ),
			'not_found_in_trash' => __( 'No '.strtolower($this->screen_s($screen_elements['speaker'])).' found in Trash.', 'agendapress' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'agendapress' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'agendapress',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'speaker' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'author', 'thumbnail' )
		);

		register_post_type( 'speaker', $args );

		$labels = array(
			'name'               => _x( $this->screen_s($screen_elements['organization']), 'post type general name', 'agendapress' ),
			'singular_name'      => _x( $this->screen($screen_elements['organization']), 'post type singular name', 'agendapress' ),
			'menu_name'          => _x( $this->screen_s($screen_elements['organization']), 'admin menu', 'agendapress' ),
			'name_admin_bar'     => _x( $this->screen($screen_elements['organization']), 'add new on admin bar', 'agendapress' ),
			'add_new'            => _x( 'Add New', $this->screen($screen_elements['organization']), 'agendapress' ),
			'add_new_item'       => __( 'Add New '.$this->screen($screen_elements['organization']), 'agendapress' ),
			'new_item'           => __( 'New '.$this->screen($screen_elements['organization']), 'agendapress' ),
			'edit_item'          => __( 'Edit '.$this->screen($screen_elements['organization']), 'agendapress' ),
			'view_item'          => __( 'View '.$this->screen($screen_elements['organization']), 'agendapress' ),
			'all_items'          => __( $this->screen_s($screen_elements['organization']), 'agendapress' ),
			'search_items'       => __( 'Search '.$this->screen_s($screen_elements['organization']), 'agendapress' ),
			'parent_item_colon'  => __( 'Parent '.$this->screen_s($screen_elements['organization']).':', 'agendapress' ),
			'not_found'          => __( 'No '.strtolower($this->screen_s($screen_elements['organization'])).' found.', 'agendapress' ),
			'not_found_in_trash' => __( 'No '.strtolower($this->screen_s($screen_elements['organization'])).' found in Trash.', 'agendapress' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'agendapress' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'agendapress',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'organization' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'author', 'thumbnail' )
		);

		register_post_type( 'organization', $args );

		$labels = array(
			'name'               => _x( 'Templates', 'post type general name', 'agendapress' ),
			'singular_name'      => _x( 'Template Style', 'post type singular name', 'agendapress' ),
			'menu_name'          => _x( 'Templates', 'admin menu', 'agendapress' ),
			'name_admin_bar'     => _x( 'Template Style', 'add new on admin bar', 'agendapress' ),
			'add_new'            => _x( 'Add New', 'template style', 'agendapress' ),
			'add_new_item'       => __( 'Add New Template Style', 'agendapress' ),
			'new_item'           => __( 'New Template Style', 'agendapress' ),
			'edit_item'          => __( 'Edit Template Style', 'agendapress' ),
			'view_item'          => __( 'View Template Style', 'agendapress' ),
			'all_items'          => __( 'Templates', 'agendapress' ),
			'search_items'       => __( 'Search Template Styles', 'agendapress' ),
			'parent_item_colon'  => __( 'Parent Template Styles:', 'agendapress' ),
			'not_found'          => __( 'No template styles found.', 'agendapress' ),
			'not_found_in_trash' => __( 'No template styles found in Trash.', 'agendapress' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'agendapress' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'agendapress',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'template-style' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'author' )
		);

		register_post_type( 'template-style', $args );


	}




}
