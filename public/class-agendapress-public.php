<?php

namespace Agendapress\Agendapress_Public;

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/agendapress
 * @since      1.0.0
 *
 * @package    Agendapress
 * @subpackage Agendapress/public
 */
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Agendapress
 * @subpackage Agendapress/public
 * @author     Md Kabir Uddin <bd.kabiruddin@gmail.com>
 */
class Agendapress_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Agendapress_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Agendapress_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/agendapress-public.css',
            array(),
            $this->version,
            'all'
        );
    }
    
    public function check_lic()
    {
        if ( age_fs()->is_not_paying() ) {
            return 'free';
        }
    }
    
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Agendapress_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Agendapress_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'js/agendapress-public.js',
            array( 'jquery' ),
            $this->version,
            false
        );
        wp_localize_script( $this->plugin_name, '_agenda', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        ) );
    }
    
    public function get_data_by_agenda_id( $agenda_id )
    {
        $data = array();
        $session = ( get_post_meta( $agenda_id, 'listed_session', true ) ? get_post_meta( $agenda_id, 'listed_session', true ) : array() );
        $sessionnew = array();
        $speakers = array();
        $venues = array();
        $organizations = array();
        foreach ( $session as $key => $value ) {
            array_push( $sessionnew, $value->id );
            if ( get_post_meta( $value->id, 'speaker', true ) ) {
                foreach ( get_post_meta( $value->id, 'speaker', true ) as $key => $speake ) {
                    array_push( $speakers, $speake );
                }
            }
            
            if ( get_post_meta( $value->id, 'venue', true ) ) {
                $vn = explode( ':', get_post_meta( $value->id, 'venue', true ) );
                array_push( $venues, $vn[0] );
            }
        
        }
        foreach ( $speakers as $key => $spw ) {
            array_push( $organizations, get_post_meta( $spw, 'organization', true ) );
        }
        $data['sessions'] = array_unique( $sessionnew );
        $data['speakers'] = array_unique( $speakers );
        $data['venues'] = array_unique( $venues );
        $data['organizations'] = array_unique( $organizations );
        return $data;
    }
    
    public function single_agenda_sortcode( $atts )
    {
        $data = shortcode_atts( array(
            'id'  => null,
            'pop' => false,
        ), $atts );
        if ( !$data['id'] ) {
            return 'Agenda ID required';
        }
        $html = '';
        if ( $data['pop'] ) {
            $html .= '<div class="agenda-en">';
        }
        $html .= $this->single_agenda( $data['id'] );
        if ( $data['pop'] ) {
            $html .= '</div>';
        }
        return $html;
    }
    
    public function venue_sortcode( $atts )
    {
        $html = '';
        $data = shortcode_atts( array(
            'id'     => null,
            'agenda' => null,
        ), $atts );
        if ( age_fs()->is_not_paying() ) {
            return 'Please upgrade your plan';
        }
        
        if ( !$data['id'] && !$data['agenda'] ) {
            $get_venue = get_posts( array(
                'post_type'      => 'venue',
                'posts_per_page' => -1,
            ) );
            
            if ( $get_venue ) {
                $ids = '';
                foreach ( $get_venue as $key => $post ) {
                    $ids .= $post->ID . ',';
                }
                $data['id'] = $ids;
            }
        
        }
        
        
        if ( $data['agenda'] && !$data['id'] ) {
            $agendaVenue = $this->get_data_by_agenda_id( $data['agenda'] );
            $agendaVenue = $agendaVenue['venues'];
            foreach ( $agendaVenue as $key => $id ) {
                if ( $id ) {
                    if ( get_post( $id ) ) {
                        if ( get_post( $id )->post_type === 'venue' ) {
                            $html .= $this->single_venue( $id );
                        }
                    }
                }
            }
        }
        
        
        if ( $data['id'] ) {
            $ids = explode( ',', $data['id'] );
            foreach ( $ids as $key => $id ) {
                if ( $id ) {
                    if ( get_post( $id ) ) {
                        if ( get_post( $id )->post_type === 'venue' ) {
                            $html .= $this->single_venue( $id );
                        }
                    }
                }
            }
        }
        
        return $html;
    }
    
    public function speaker_sortcode( $atts )
    {
        $html = '';
        $data = shortcode_atts( array(
            'id'     => null,
            'agenda' => null,
        ), $atts );
        if ( age_fs()->is_not_paying() ) {
            return 'Please upgrade your plan';
        }
        
        if ( !$data['id'] && !$data['agenda'] ) {
            $get_speaker = get_posts( array(
                'post_type'      => 'speaker',
                'posts_per_page' => -1,
            ) );
            
            if ( $get_speaker ) {
                $ids = '';
                foreach ( $get_speaker as $key => $post ) {
                    $ids .= $post->ID . ',';
                }
                $data['id'] = $ids;
            }
        
        }
        
        
        if ( $data['agenda'] && !$data['id'] ) {
            $agendaSpearker = $this->get_data_by_agenda_id( $data['agenda'] );
            $agendaSpearker = $agendaSpearker['speakers'];
            foreach ( $agendaSpearker as $key => $id ) {
                if ( $id ) {
                    if ( get_post( $id ) ) {
                        if ( get_post( $id )->post_type === 'speaker' ) {
                            $html .= $this->single_speaker( $id );
                        }
                    }
                }
            }
        }
        
        
        if ( $data['id'] ) {
            $ids = explode( ',', $data['id'] );
            foreach ( $ids as $key => $id ) {
                if ( $id ) {
                    if ( get_post( $id ) ) {
                        if ( get_post( $id )->post_type === 'speaker' ) {
                            $html .= $this->single_speaker( $id );
                        }
                    }
                }
            }
        }
        
        return $html;
    }
    
    public function organization_sortcode( $atts )
    {
        $html = '';
        $data = shortcode_atts( array(
            'id'     => null,
            'agenda' => null,
        ), $atts );
        if ( age_fs()->is_not_paying() ) {
            return 'Please upgrade your plan';
        }
        
        if ( !$data['id'] && !$data['agenda'] ) {
            $get_organization = get_posts( array(
                'post_type'      => 'organization',
                'posts_per_page' => -1,
            ) );
            
            if ( $get_organization ) {
                $ids = '';
                foreach ( $get_organization as $key => $post ) {
                    $ids .= $post->ID . ',';
                }
                $data['id'] = $ids;
            }
        
        }
        
        
        if ( $data['agenda'] && !$data['id'] ) {
            $agendaOrganization = $this->get_data_by_agenda_id( $data['agenda'] );
            $agendaOrganization = $agendaOrganization['organizations'];
            foreach ( $agendaOrganization as $key => $id ) {
                if ( $id ) {
                    if ( get_post( $id ) ) {
                        if ( get_post( $id )->post_type === 'organization' ) {
                            $html .= $this->single_organization( $id );
                        }
                    }
                }
            }
        }
        
        
        if ( $data['id'] ) {
            $ids = explode( ',', $data['id'] );
            foreach ( $ids as $key => $id ) {
                if ( $id ) {
                    if ( get_post( $id ) ) {
                        if ( get_post( $id )->post_type === 'organization' ) {
                            $html .= $this->single_organization( $id );
                        }
                    }
                }
            }
        }
        
        return $html;
    }
    
    public function single_agenda( $agenda_id )
    {
        error_reporting( 0 );
        $resources_url = site_url() . '/wp-json/agendapress/v1/agenda/' . $agenda_id . '/resources';
        $sessions_url = site_url() . '/wp-json/agendapress/v1/agenda/' . $agenda_id . '/sessions';
        $response = wp_remote_get( $resources_url, array(
            'sslverify' => false,
        ) );
        
        if ( is_array( $response ) && !is_wp_error( $response ) ) {
            $headers = $response['headers'];
            // array of http header lines
            $resourcesBody = $response['body'];
            // use the content
        }
        
        $response = wp_remote_get( $sessions_url, array(
            'sslverify' => false,
        ) );
        
        if ( is_array( $response ) && !is_wp_error( $response ) ) {
            $headers = $response['headers'];
            // array of http header lines
            $sessionsBody = $response['body'];
            // use the content
        }
        
        $resources = ( json_decode( $resourcesBody ) ? json_decode( $resourcesBody ) : array() );
        $sessions = ( json_decode( $sessionsBody ) ? json_decode( $sessionsBody ) : array() );
        $template_id = get_post_meta( $agenda_id, 'template_style', true );
        $template = get_post_meta( $template_id, 'style', true );
        $sessionsTemp = array();
        foreach ( $sessions as $key => $session ) {
            $sessionsTemp[$key] = $session->start;
        }
        array_multisort( $sessionsTemp, SORT_ASC, $sessions );
        $sessionsByDayTime = array();
        foreach ( $sessions as $key => $session ) {
            $day = new \DateTime( $session->start );
            $day = $day->format( 'Y-m-d' );
            $sessionsByDayTime[$day][$session->start][$session->resourceId][] = $session;
        }
        $custom_content = '';
        foreach ( $sessionsByDayTime as $key => $sessionsByTime ) {
            $custom_content .= '<h3>' . $key . '</h3>';
            $custom_content .= '<table class="agenda-table">';
            $noVenue = false;
            if ( count( $resources ) === 1 ) {
                if ( $resources[0]->id === 'no' ) {
                    $noVenue = true;
                }
            }
            
            if ( !$noVenue ) {
                $custom_content .= '<tr>';
                $custom_content .= '<td>';
                //$custom_content .= 'Time';
                $custom_content .= '</td>';
                foreach ( $resources as $key => $resource ) {
                    $custom_content .= '<td>';
                    $custom_content .= $resource->title;
                    $custom_content .= '</td>';
                }
                $custom_content .= '</tr>';
            }
            
            foreach ( $sessionsByTime as $key => $hall ) {
                $custom_content .= '<tr>';
                $custom_content .= '<td valign="top">';
                $time = new \DateTime( $key );
                
                if ( get_post_meta( $agenda_id, 'clock_type', true ) == 12 ) {
                    $time = $time->format( 'h:i:s a' );
                } else {
                    $time = $time->format( 'H:i:s' );
                }
                
                $custom_content .= '<div style="width:160px;">';
                $custom_content .= $time;
                $custom_content .= '</div>';
                $custom_content .= '</td>';
                foreach ( $resources as $key => $resource ) {
                    $custom_content .= '<td valign="top">';
                    foreach ( $hall as $keyh => $sessions ) {
                        foreach ( $sessions as $key => $session ) {
                            
                            if ( $resource->id === $session->resourceId ) {
                                $session_meta = get_post_meta( $session->id );
                                $session_type = get_post_meta( $session->id, 'session_type', true );
                                $session_type = strtolower( str_replace( ' ', '_', $session_type ) );
                                $style = strtolower( str_replace( ' ', '_', $session_type ) );
                                $style = $template[$session_type];
                                
                                if ( $this->check_lic() == 'premium' || $this->check_lic() == 'professional' ) {
                                    $stylex = get_post_meta( $session->id, 'style', true );
                                    
                                    if ( $stylex ) {
                                        $stylex = $stylex['default'];
                                        
                                        if ( !$stylex['override'] ) {
                                            $style = get_post_meta( $session->id, 'style', true );
                                            if ( $style ) {
                                                $style = $style['default'];
                                            }
                                        }
                                    
                                    }
                                
                                }
                                
                                $session_container = '';
                                if ( $style['session_container'] ) {
                                    $session_container = '
										background-color: ' . $style['session_container']['bgcolor'] . '; 
										border-style: ' . $style['session_container']['border_style'] . '; 
										border-width: ' . $style['session_container']['border_width'] . '; 
										border-color: ' . $style['session_container']['border_color'] . '; 
										padding: ' . $style['session_container']['padding'] . '; 
										margin: ' . $style['session_container']['margin'] . ';
										';
                                }
                                $title = '';
                                if ( $style['title'] ) {
                                    $title = '
										font-family: ' . $style['title']['font'] . '; 
										font-size: ' . $style['title']['font_size'] . '; 
										color: ' . $style['title']['color'] . '; 
										text-align: ' . $style['title']['font_aligenment'] . '; 
										font-style: ' . $style['title']['font_style'] . ';
										';
                                }
                                //print_r($session->start);
                                $custom_content .= '<div data-session-type="' . $session_type . '" class="session-container-inner" data-session-td="' . $session_container . '">';
                                $custom_content .= '<div class="session-title" style="' . $title . '">';
                                $start = new \DateTime( $session->start );
                                $start = $start->format( 'h:i:s a' );
                                $end = new \DateTime( $session->end );
                                $end = $end->format( 'h:i:s a' );
                                $custom_content .= '<div>';
                                $custom_content .= '<span><small>' . $start . ' - ' . $end . '</small></span>';
                                $custom_content .= '</div>';
                                if ( $style['title'] ) {
                                    if ( $style['title']['heading'] ) {
                                        $custom_content .= '<' . $style['title']['heading'] . '>';
                                    }
                                }
                                $custom_content .= $session->title;
                                if ( $style['title'] ) {
                                    if ( $style['title']['heading'] ) {
                                        $custom_content .= '</' . $style['title']['heading'] . '>';
                                    }
                                }
                                $custom_content .= '</div>';
                                $session_general_info_summery = get_post_meta( $session->id, 'session_general_info_summery', true );
                                
                                if ( $session_general_info_summery ) {
                                    $custom_content .= '<div class="session-summary">';
                                    $custom_content .= $session_general_info_summery;
                                    $custom_content .= '</div>';
                                }
                                
                                $session_general_info_aditional_details = get_post_meta( $session->id, 'session_general_info_aditional_details', true );
                                
                                if ( $session_general_info_aditional_details ) {
                                    $custom_content .= '<div class="session-aditional-details">';
                                    $custom_content .= $session_general_info_aditional_details;
                                    $custom_content .= '</div>';
                                }
                                
                                $custom_content .= '<div class="session-speaker">';
                                $custom_content .= '<div class="session-speaker-inner">';
                                $speaker_ids = get_post_meta( $session->id, 'speaker', true );
                                if ( !empty($speaker_ids) ) {
                                    foreach ( $speaker_ids as $key => $speaker_id ) {
                                        $custom_content .= '<div class="speaker-single">';
                                        $speaker = get_the_title( $speaker_id );
                                        $organization_id = get_post_meta( $speaker_id, 'organization', true );
                                        $organization = get_the_title( $organization_id );
                                        $speaker_style = $style['speaker'];
                                        
                                        if ( isset( $style['speaker']['show'] ) ) {
                                            $custom_content .= '<ul class="speaker-single-inner inline-image-name">';
                                            if ( isset( $style['speaker']['image'] ) ) {
                                                
                                                if ( get_the_post_thumbnail_url( $speaker_id ) ) {
                                                    $custom_content .= '<li>';
                                                    $custom_content .= '<div class="speaker-image">';
                                                    if ( isset( $style['speaker']['profile_link'] ) ) {
                                                        if ( $this->check_lic() != 'free' ) {
                                                            $custom_content .= '<a data-pop-id="' . $speaker_id . '" href="' . $this->get_the_permalink_check_lic( $speaker_id ) . '">';
                                                        }
                                                    }
                                                    $custom_content .= '<img height="25" src="' . get_the_post_thumbnail_url( $speaker_id ) . '">';
                                                    if ( isset( $style['speaker']['profile_link'] ) ) {
                                                        if ( $this->check_lic() != 'free' ) {
                                                            $custom_content .= '</a>';
                                                        }
                                                    }
                                                    $custom_content .= '</div>';
                                                    $custom_content .= '</li>';
                                                }
                                            
                                            }
                                            $speaker_name_style = '
																font-family: ' . $style['speaker']['font'] . '; 
																font-size: ' . $style['speaker']['font_size'] . '; 
																color: ' . $style['speaker']['font_color'] . '; 
																text-align: ' . $style['speaker']['font_aligenment'] . '; 
																font-weight: ' . $style['speaker']['font_style']['bold'] . ';
																text-decoration: ' . $style['speaker']['font_style']['underline'] . ';
																font-style: ' . $style['speaker']['font_style']['italic'] . ';
																';
                                            $custom_content .= '<li>';
                                            $custom_content .= '<div class="speaker-name" style="' . $speaker_name_style . '">';
                                            if ( isset( $style['speaker']['profile_link'] ) ) {
                                                if ( $this->check_lic() != 'free' ) {
                                                    $custom_content .= '<a data-pop-id="' . $speaker_id . '" href="' . $this->get_the_permalink_check_lic( $speaker_id ) . '">';
                                                }
                                            }
                                            $custom_content .= $speaker;
                                            if ( isset( $style['speaker']['profile_link'] ) ) {
                                                if ( $this->check_lic() != 'free' ) {
                                                    $custom_content .= '</a>';
                                                }
                                            }
                                            $custom_content .= '</div>';
                                            $custom_content .= '</li>';
                                            $custom_content .= '</ul>';
                                            
                                            if ( isset( $style['organization']['show'] ) ) {
                                                $custom_content .= '<ul class="organization-single-inner inline-image-name">';
                                                if ( isset( $style['organization']['image'] ) ) {
                                                    
                                                    if ( get_the_post_thumbnail_url( $organization_id ) ) {
                                                        $custom_content .= '<li>';
                                                        $custom_content .= '<div class="organization-image">';
                                                        if ( isset( $style['organization']['profile_link'] ) ) {
                                                            if ( $this->check_lic() != 'free' ) {
                                                                $custom_content .= '<a data-pop-id="' . $organization_id . '" href="' . $this->get_the_permalink_check_lic( $organization_id ) . '">';
                                                            }
                                                        }
                                                        $custom_content .= '<img height="25" src="' . get_the_post_thumbnail_url( $organization_id ) . '">';
                                                        if ( isset( $style['organization']['profile_link'] ) ) {
                                                            if ( $this->check_lic() != 'free' ) {
                                                                $custom_content .= '</a>';
                                                            }
                                                        }
                                                        $custom_content .= '</div>';
                                                        $custom_content .= '</li>';
                                                    }
                                                
                                                }
                                                $organization_name_style = '
																font-family: ' . $style['organization']['font'] . '; 
																font-size: ' . $style['organization']['font_size'] . '; 
																color: ' . $style['organization']['font_color'] . '; 
																text-align: ' . $style['organization']['font_aligenment'] . '; 
																font-weight: ' . $style['organization']['font_style']['bold'] . ';
																text-decoration: ' . $style['organization']['font_style']['underline'] . ';
																font-style: ' . $style['organization']['font_style']['italic'] . ';
																';
                                                $custom_content .= '<li>';
                                                $custom_content .= '<div class="organization-name" style="' . $organization_name_style . '">';
                                                if ( isset( $style['organization']['profile_link'] ) ) {
                                                    if ( $this->check_lic() != 'free' ) {
                                                        $custom_content .= '<a data-pop-id="' . $organization_id . '" href="' . $this->get_the_permalink_check_lic( $organization_id ) . '">';
                                                    }
                                                }
                                                $custom_content .= $organization;
                                                if ( isset( $style['organization']['profile_link'] ) ) {
                                                    if ( $this->check_lic() != 'free' ) {
                                                        $custom_content .= '</a>';
                                                    }
                                                }
                                                $custom_content .= '</div>';
                                                $custom_content .= '</li>';
                                                $custom_content .= '</ul>';
                                            }
                                        
                                        }
                                        
                                        $custom_content .= '</div>';
                                    }
                                }
                                $custom_content .= '</div>';
                                $custom_content .= '</div>';
                                $venue_id = get_post_meta( $session->id, 'venue', true );
                                $venue_id = explode( ':', $venue_id );
                                $venue_id = $venue_id[0];
                                
                                if ( $venue_id ) {
                                    $venue = get_the_title( $venue_id );
                                    
                                    if ( isset( $style['venue']['show'] ) ) {
                                        $custom_content .= '<div class="session-venue">';
                                        $custom_content .= '<ul class="venue-single-inner inline-image-name">';
                                        if ( isset( $style['venue']['image'] ) ) {
                                            
                                            if ( get_the_post_thumbnail_url( $venue_id ) ) {
                                                $custom_content .= '<li>';
                                                $custom_content .= '<div class="venue-image">';
                                                if ( isset( $style['venue']['details_link'] ) ) {
                                                    if ( $this->check_lic() != 'free' ) {
                                                        $custom_content .= '<a data-pop-id="' . $venue_id . '" href="' . $this->get_the_permalink_check_lic( $venue_id ) . '">';
                                                    }
                                                }
                                                $custom_content .= '<img height="25" src="' . get_the_post_thumbnail_url( $venue_id ) . '">';
                                                if ( isset( $style['venue']['details_link'] ) ) {
                                                    if ( $this->check_lic() != 'free' ) {
                                                        $custom_content .= '</a>';
                                                    }
                                                }
                                                $custom_content .= '</div>';
                                                $custom_content .= '</li>';
                                            }
                                        
                                        }
                                        $organization_name_style = '
											font-family: ' . $style['venue']['font'] . '; 
											font-size: ' . $style['venue']['font_size'] . '; 
											color: ' . $style['venue']['font_color'] . '; 
											text-align: ' . $style['venue']['font_aligenment'] . ';
											font-weight: ' . $style['venue']['font_style']['bold'] . ';
											text-decoration: ' . $style['venue']['font_style']['underline'] . ';
											font-style: ' . $style['venue']['font_style']['italic'] . ';
											';
                                        $custom_content .= '<li>';
                                        $custom_content .= '<div class="venue-name" style="' . $organization_name_style . '">';
                                        if ( isset( $style['venue']['details_link'] ) ) {
                                            if ( $this->check_lic() != 'free' ) {
                                                $custom_content .= '<a data-pop-id="' . $venue_id . '" href="' . $this->get_the_permalink_check_lic( $venue_id ) . '">';
                                            }
                                        }
                                        $custom_content .= $venue;
                                        if ( isset( $style['venue']['details_link'] ) ) {
                                            if ( $this->check_lic() != 'free' ) {
                                                $custom_content .= '</a>';
                                            }
                                        }
                                        $custom_content .= '</div>';
                                        $custom_content .= '</li>';
                                        $custom_content .= '</ul>';
                                    }
                                
                                }
                                
                                $custom_content .= '</div>';
                                $custom_content .= '</div>';
                                if ( $keyh == 0 ) {
                                    $custom_content .= '</div>';
                                }
                            }
                        
                        }
                    }
                    $custom_content .= '</td>';
                }
                $custom_content .= '</tr>';
            }
            $custom_content .= '</table>';
        }
        return $custom_content;
    }
    
    public function get_the_permalink_check_lic( $post_id )
    {
        if ( age_fs()->is_not_paying() ) {
            return '#';
        }
        return get_the_permalink( $post_id );
    }
    
    public function single_speaker( $post_id )
    {
        $get_post_meta = get_post_meta( $post_id );
        $html = '';
        $html .= '<div class="single-speaker">';
        $html .= '<h3>' . get_the_title( $post_id ) . '</h3>';
        $html .= '<p>' . get_post_meta( $post_id, 'job_title', true ) . '
		<br> <a href="' . get_the_permalink( get_post_meta( $post_id, 'organization', true ) ) . '">' . get_the_title( get_post_meta( $post_id, 'organization', true ) ) . '</a></p>';
        $html .= '<p><strong>Biography</strong><br>' . get_post_meta( $post_id, 'job_title', true ) . '</p>';
        $html .= '<ul class="single-post-social">
		<li class="linkedin-ico"><a target="_blank" href="' . get_post_meta( $post_id, 'linkedin', true ) . '"></a></li>
		<li class="facebook-ico"><a target="_blank" href="' . get_post_meta( $post_id, 'facebook', true ) . '"></a></li>
		<li class="twitter-ico"><a target="_blank" href="' . get_post_meta( $post_id, 'twitter', true ) . '"></a></li>
		</ul>';
        $html .= '</div>';
        return $html;
    }
    
    public function single_venue( $post_id )
    {
        $get_post_meta = get_post_meta( $post_id );
        //print_r($get_post_meta);
        $html = '';
        $html .= '<div class="single-venue">';
        $html .= '<h3>' . get_the_title( $post_id ) . '</h3>';
        $html .= '<p>Address is: ' . get_post_meta( $post_id, 'address', true ) . '</p>';
        $html .= '<p>Phone: ' . get_post_meta( $post_id, 'phone', true ) . '</p>';
        $html .= '<p>Email: ' . get_post_meta( $post_id, 'email', true ) . '</p>';
        $html .= '<p>Website: ' . get_post_meta( $post_id, 'website', true ) . '</p>';
        $html .= '<p><strong>Notes</strong><br> ' . get_post_meta( $post_id, 'venue_general_info_notes', true ) . '</p>';
        $html .= '<ul class="single-post-social">
		<li class="linkedin-ico"><a target="_blank" href="' . get_post_meta( $post_id, 'linkedin', true ) . '"></a></li>
		<li class="facebook-ico"><a target="_blank" href="' . get_post_meta( $post_id, 'facebook', true ) . '"></a></li>
		<li class="twitter-ico"><a target="_blank" href="' . get_post_meta( $post_id, 'twitter', true ) . '"></a></li>
		</ul>';
        $html .= '</div>';
        return $html;
    }
    
    public function single_organization( $post_id )
    {
        $get_post_meta = get_post_meta( $post_id );
        //print_r($get_post_meta);
        $html = '';
        $html .= '<div class="single-organization">';
        $html .= '<h3>' . get_the_title( $post_id ) . '</h3>';
        $html .= '<p>Address is: ' . get_post_meta( $post_id, 'address', true ) . '</p>';
        $html .= '<p>Phone: ' . get_post_meta( $post_id, 'phone', true ) . '</p>';
        $html .= '<p>Email: ' . get_post_meta( $post_id, 'email', true ) . '</p>';
        $html .= '<p>Website: ' . get_post_meta( $post_id, 'website', true ) . '</p>';
        $html .= '<p><strong>Profile</strong><br> ' . get_post_meta( $post_id, 'organization_general_info_profile', true ) . '</p>';
        $html .= '<ul class="single-post-social">
		<li class="linkedin-ico"><a target="_blank" href="' . get_post_meta( $post_id, 'linkedin', true ) . '"></a></li>
		<li class="facebook-ico"><a target="_blank" href="' . get_post_meta( $post_id, 'facebook', true ) . '"></a></li>
		<li class="twitter-ico"><a target="_blank" href="' . get_post_meta( $post_id, 'twitter', true ) . '"></a></li>
		</ul>';
        $html .= '</div>';
        return $html;
    }
    
    public function single_content_extend( $content )
    {
        global  $post ;
        
        if ( is_single() && 'agenda' == get_post_type() ) {
            $custom_content = $this->single_agenda( $post->ID );
            $custom_content .= $content;
            return $custom_content;
        } elseif ( is_single() && 'speaker' == get_post_type() ) {
            $custom_content = $this->single_speaker( $post->ID );
            $custom_content .= $content;
            return $custom_content;
        } elseif ( is_single() && 'venue' == get_post_type() ) {
            $custom_content = $this->single_venue( $post->ID );
            $custom_content .= $content;
            return $custom_content;
        } elseif ( is_single() && 'organization' == get_post_type() ) {
            $custom_content = $this->single_organization( $post->ID );
            $custom_content .= $content;
            return $custom_content;
        } else {
            return $content;
        }
    
    }
    
    public function pop_action()
    {
        if ( !$_POST['id'] ) {
            return;
        }
        $post_id = $_POST['id'];
        if ( !get_post( $post_id ) ) {
            return;
        }
        $post_type = get_post( $post_id )->post_type;
        $custom_content = '<div class="agenda-pop-inner">';
        $custom_content .= '<div class="agenda-pop-header">';
        $custom_content .= '<span class="agenda-pop-close">&times;</span>';
        $custom_content .= '</div>';
        $custom_content .= '<div class="agenda-pop-content">';
        
        if ( 'speaker' == $post_type ) {
            //print_r($post_type);
            $custom_content .= $this->single_speaker( $post_id );
            $custom_content .= $content;
        } elseif ( 'venue' == $post_type ) {
            //print_r($post_type);
            $custom_content .= $this->single_venue( $post_id );
            $custom_content .= $content;
        } elseif ( 'organization' == $post_type ) {
            //print_r($post_type);
            $custom_content .= $this->single_organization( $post_id );
            $custom_content .= $content;
        } else {
            return;
        }
        
        $custom_content .= '</div>';
        $custom_content .= '</div>';
        echo  $custom_content ;
        die;
    }

}