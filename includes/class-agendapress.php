<?php

namespace Agendapress\Includes;

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
class Agendapress
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Agendapress_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected  $loader ;
    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected  $plugin_name ;
    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected  $version ;
    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        
        if ( defined( 'AGENDAPRESS_VERSION' ) ) {
            $this->version = AGENDAPRESS_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        
        $this->plugin_name = 'agendapress';
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }
    
    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Agendapress_Loader. Orchestrates the hooks of the plugin.
     * - Agendapress_i18n. Defines internationalization functionality.
     * - Agendapress_Admin. Defines all hooks for the admin area.
     * - Agendapress_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {
        $this->loader = new \Agendapress\Includes\Agendapress_Loader();
    }
    
    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Agendapress_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {
        $plugin_i18n = new \Agendapress\Includes\Agendapress_i18n();
        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
    }
    
    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new \Agendapress\Agendapress_Admin\Agendapress_Admin( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action( 'init', $plugin_admin, 'registe_posts' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu' );
        $this->loader->add_action(
            'add_meta_boxes',
            $plugin_admin,
            'add_meta_boxes',
            1
        );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_template_style_general_info_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_template_style_session_style_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_speaker_general_info_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_organization_general_info_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_venue_general_info_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_venue_rooms_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_session_general_info_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_session_speakers_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_session_venue_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_session_style_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_agenda_template_style_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_agenda_general_info_save' );
        $this->loader->add_action( 'save_post', $plugin_admin, 'meta_box_agenda_grid_setting_save' );
        $this->loader->add_action(
            'manage_agenda_posts_custom_column',
            $plugin_admin,
            'agenda_columns',
            10,
            2
        );
        $this->loader->add_filter( 'manage_agenda_posts_columns', $plugin_admin, 'set_agenda_columns' );
        $this->loader->add_action(
            'manage_session_posts_custom_column',
            $plugin_admin,
            'session_columns',
            10,
            2
        );
        $this->loader->add_filter( 'manage_session_posts_columns', $plugin_admin, 'set_session_columns' );
        $this->loader->add_filter( 'manage_edit-session_sortable_columns', $plugin_admin, 'set_session_sortable_columns' );
        $this->loader->add_action(
            'manage_venue_posts_custom_column',
            $plugin_admin,
            'venue_columns',
            10,
            2
        );
        $this->loader->add_filter( 'manage_venue_posts_columns', $plugin_admin, 'set_venue_columns' );
        $this->loader->add_action(
            'manage_speaker_posts_custom_column',
            $plugin_admin,
            'speaker_columns',
            10,
            2
        );
        $this->loader->add_filter( 'manage_speaker_posts_columns', $plugin_admin, 'set_speaker_columns' );
        $this->loader->add_filter( 'manage_edit-speaker_sortable_columns', $plugin_admin, 'set_speaker_sortable_columns' );
        $this->loader->add_action(
            'manage_organization_posts_custom_column',
            $plugin_admin,
            'organization_columns',
            10,
            2
        );
        $this->loader->add_filter( 'manage_organization_posts_columns', $plugin_admin, 'set_organization_columns' );
        $this->loader->add_action(
            'pre_get_posts',
            $plugin_admin,
            'custom_orderby',
            10,
            2
        );
        $this->loader->add_action( 'rest_api_init', $plugin_admin, 'register_rest_route_agenda_sessions' );
        $this->loader->add_action( 'rest_api_init', $plugin_admin, 'register_rest_route_agenda_resources' );
        $this->loader->add_action( 'wp_ajax_update_agenda_session', $plugin_admin, 'update_agenda_session' );
        $this->loader->add_action( 'wp_ajax_nopriv_update_agenda_session', $plugin_admin, 'update_agenda_session' );
        $this->loader->add_action( 'wp_ajax_delete_agenda_session', $plugin_admin, 'delete_agenda_session' );
        $this->loader->add_action( 'wp_ajax_nopriv_delete_agenda_session', $plugin_admin, 'delete_agenda_session' );
        $this->loader->add_action( 'wp_ajax_delete_session', $plugin_admin, 'delete_session' );
        $this->loader->add_action( 'wp_ajax_nopriv_delete_session', $plugin_admin, 'delete_session' );
        $this->loader->add_action( 'wp_ajax_create_new_session_aj', $plugin_admin, 'create_new_session_aj' );
        $this->loader->add_action( 'wp_ajax_nopriv_create_new_session_aj', $plugin_admin, 'create_new_session_aj' );
        $this->loader->add_action( 'init', $this, 'capability_create_agenda' );
    }
    
    public function capability_create_agenda()
    {
        $post_types = get_post_types( array(), 'objects' );
        $wp_count_agenda = count( get_posts( array(
            'post_type'      => 'agenda',
            'posts_per_page' => -1,
        ) ) );
        foreach ( $post_types as $post_type ) {
            
            if ( $post_type->name === 'agenda' ) {
                if ( age_fs()->is_not_paying() ) {
                    if ( $wp_count_agenda < 1 ) {
                        return;
                    }
                }
                $cap = 'create_' . $post_type->name;
                $post_type->cap->create_posts = $cap;
                map_meta_cap( $cap, 1 );
            }
        
        }
    }
    
    function agenda_press_rename_fields( $active_tab )
    {
        
        if ( $active_tab == 'screen' ) {
            $act = 'nav-tab-active';
        } else {
            $act = '';
        }
        
        echo  '<a href="?page=agendapress-settings&tab=screen" class="nav-tab ' . $act . '">' . __( 'Screen Elements', 'agendapress' ) . '</a>' ;
    }
    
    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new \Agendapress\Agendapress_Public\Agendapress_Public( $this->get_plugin_name(), $this->get_version() );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        $this->loader->add_action( 'the_content', $plugin_public, 'single_content_extend' );
        add_shortcode( 'agenda', array( $plugin_public, 'single_agenda_sortcode' ) );
        add_shortcode( 'venue-list', array( $plugin_public, 'venue_sortcode' ) );
        add_shortcode( 'speaker-list', array( $plugin_public, 'speaker_sortcode' ) );
        add_shortcode( 'organization-list', array( $plugin_public, 'organization_sortcode' ) );
        $this->loader->add_action( 'wp_ajax_pop_action', $plugin_public, 'pop_action' );
        $this->loader->add_action( 'wp_ajax_nopriv_pop_action', $plugin_public, 'pop_action' );
    }
    
    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }
    
    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }
    
    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Agendapress_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }
    
    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

}