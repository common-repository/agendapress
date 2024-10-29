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
trait Agendapress_Post_Meta
{
    public static function meta_content_editor_get_meta( $value )
    {
        global  $post ;
        $field = get_post_meta( $post->ID, $value, true );
        
        if ( !empty($field) ) {
            return ( is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) ) );
        } else {
            return false;
        }
    
    }
    
    public static function get_post_as_option( $post_type, $selected )
    {
        $query = new \WP_Query( array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
        ) );
        $html = '';
        if ( $query->posts ) {
            foreach ( $query->posts as $key => $post ) {
                
                if ( is_array( $selected ) ) {
                    
                    if ( in_array( $post->ID, $selected ) ) {
                        $html .= '<option selected="selected" value="' . $post->ID . '">' . get_the_title( $post->ID ) . '</option>';
                    } else {
                        $html .= '<option value="' . $post->ID . '">' . get_the_title( $post->ID ) . '</option>';
                    }
                
                } else {
                    
                    if ( $selected == $post->ID ) {
                        $html .= '<option selected="selected" value="' . $post->ID . '">' . get_the_title( $post->ID ) . '</option>';
                    } else {
                        $html .= '<option value="' . $post->ID . '">' . get_the_title( $post->ID ) . '</option>';
                    }
                
                }
            
            }
        }
        return $html;
    }
    
    public static function get_post_as_option_group( $post_type, $selected )
    {
        $query = new \WP_Query( array(
            'post_type'      => $post_type,
            'posts_per_page' => -1,
        ) );
        $html = '';
        if ( $query->posts ) {
            foreach ( $query->posts as $key => $post ) {
                $rooms = get_post_meta( $post->ID, 'rooms', true );
                
                if ( $rooms ) {
                    $html .= '<optgroup label="' . get_the_title( $post->ID ) . '">';
                    foreach ( $rooms as $roomKey => $room ) {
                        $identifire = $post->ID . ':' . $room;
                        
                        if ( $selected == $identifire ) {
                            $html .= '<option selected="selected" value="' . $identifire . '">' . get_the_title( $post->ID ) . ' - ' . $room . '</option>';
                        } else {
                            $html .= '<option value="' . $identifire . '">' . $room . '</option>';
                        }
                    
                    }
                    $html .= '</optgroup >';
                } else {
                    
                    if ( $selected == $post->ID ) {
                        $html .= '<option selected="selected" value="' . $post->ID . '">' . get_the_title( $post->ID ) . '</option>';
                    } else {
                        $html .= '<option value="' . $post->ID . '">' . get_the_title( $post->ID ) . '</option>';
                    }
                
                }
            
            }
        }
        return $html;
    }
    
    public function add_meta_boxes()
    {
        add_meta_box(
            'template-style-general',
            __( 'General Information', 'agendapress' ),
            array( $this, 'meta_box_template_style_general_info_html' ),
            'template-style',
            'normal',
            'high'
        );
        add_meta_box(
            'template-style-session-style',
            __( 'Session styling', 'agendapress' ),
            array( $this, 'meta_box_template_style_session_style_html' ),
            'template-style',
            'normal',
            'high'
        );
        add_meta_box(
            'organization-general',
            __( 'General Information', 'agendapress' ),
            array( $this, 'meta_box_organization_general_info_html' ),
            'organization',
            'normal',
            'high'
        );
        add_meta_box(
            'speaker-general',
            __( 'General Information', 'agendapress' ),
            array( $this, 'meta_box_speaker_general_info_html' ),
            'speaker',
            'normal',
            'high'
        );
        add_meta_box(
            'venue-general',
            __( 'General Information', 'agendapress' ),
            array( $this, 'meta_box_venue_general_info_html' ),
            'venue',
            'normal',
            'high'
        );
        add_meta_box(
            'venue-rooms',
            __( 'Rooms', 'agendapress' ),
            array( $this, 'meta_box_venue_rooms_html' ),
            'venue',
            'normal',
            'high'
        );
        add_meta_box(
            'agenda-general',
            __( 'General Information', 'agendapress' ),
            array( $this, 'meta_box_agenda_general_info_html' ),
            'agenda',
            'normal',
            'high'
        );
        add_meta_box(
            'agenda-grid-setting',
            __( 'Grid Setting', 'agendapress' ),
            array( $this, 'meta_box_agenda_grid_setting_html' ),
            'agenda',
            'normal',
            'high'
        );
        add_meta_box(
            'agenda-sessions',
            __( 'Sessions', 'agendapress' ),
            array( $this, 'meta_box_agenda_sessions_html' ),
            'agenda',
            'normal',
            'high'
        );
        add_meta_box(
            'agenda-grid',
            __( 'Grid', 'agendapress' ),
            array( $this, 'meta_box_agenda_grid_html' ),
            'agenda',
            'normal',
            'high'
        );
        add_meta_box(
            'agenda-grid-template-style',
            __( 'Template Style', 'agendapress' ),
            array( $this, 'meta_box_agenda_template_style_html' ),
            'agenda',
            'side',
            'high'
        );
        add_meta_box(
            'session-general',
            __( 'General Information', 'agendapress' ),
            array( $this, 'meta_box_session_general_info_html' ),
            'session',
            'normal',
            'high'
        );
        add_meta_box(
            'session-speakers',
            __( 'Speakers', 'agendapress' ),
            array( $this, 'meta_box_session_speakers_html' ),
            'session',
            'normal',
            'high'
        );
        add_meta_box(
            'session-venue',
            __( 'Session Location', 'agendapress' ),
            array( $this, 'meta_box_session_venue_html' ),
            'session',
            'normal',
            'high'
        );
    }
    
    /******************************************************************************************************************************
     ** 
     *******************************************************************************************************************************/
    public function meta_box_agenda_template_style_html( $post )
    {
        wp_nonce_field( '_agenda_template_style_meta_nonce', 'agenda_template_style_meta_nonce' );
        $template_style = ( get_post_meta( $post->ID, 'template_style', true ) ? get_post_meta( $post->ID, 'template_style', true ) : null );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/agenda-template-style.php';
    }
    
    public function meta_box_agenda_template_style_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['agenda_template_style_meta_nonce'] ) || !wp_verify_nonce( $_POST['agenda_template_style_meta_nonce'], '_agenda_template_style_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        if ( isset( $_POST['template_style'] ) ) {
            $template_style = $_POST['template_style'];
            if ( !is_int( $template_style ) ) {
                return;
            }
            update_post_meta( $post_id, 'template_style', $template_style );
        }
    
    }
    
    public function meta_box_agenda_general_info_html( $post )
    {
        wp_nonce_field( '_agenda_general_info_meta_nonce', 'agenda_general_info_meta_nonce' );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/agenda-general-info.php';
    }
    
    public function meta_box_agenda_general_info_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['agenda_general_info_meta_nonce'] ) || !wp_verify_nonce( $_POST['agenda_general_info_meta_nonce'], '_agenda_general_info_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['agenda_general_info_description'] ) ) {
            update_post_meta( $post_id, 'agenda_general_info_description', wp_kses( $_POST['agenda_general_info_description'], wp_kses_allowed_html( 'post' ) ) );
        }
    }
    
    public function meta_box_agenda_grid_setting_html( $post )
    {
        wp_nonce_field( '_agenda_grid_setting_meta_nonce', 'agenda_grid_setting_meta_nonce' );
        $start_date = ( get_post_meta( $post->ID, 'start_date', true ) ? get_post_meta( $post->ID, 'start_date', true ) : null );
        $start_date = new \DateTime( $start_date );
        $start_date = $start_date->format( 'Y-m-d' );
        $end_date = ( get_post_meta( $post->ID, 'end_date', true ) ? get_post_meta( $post->ID, 'end_date', true ) : null );
        $end_date = new \DateTime( $end_date );
        $end_date = $end_date->format( 'Y-m-d' );
        $satrt_time = ( get_post_meta( $post->ID, 'satrt_time', true ) ? get_post_meta( $post->ID, 'satrt_time', true ) : '08:00am' );
        $end_time = ( get_post_meta( $post->ID, 'end_time', true ) ? get_post_meta( $post->ID, 'end_time', true ) : '04:00pm' );
        $time_increments = ( get_post_meta( $post->ID, 'time_increments', true ) ? get_post_meta( $post->ID, 'time_increments', true ) : '15' );
        $clock_type = ( get_post_meta( $post->ID, 'clock_type', true ) ? get_post_meta( $post->ID, 'clock_type', true ) : '12' );
        $dispaly_first_col = ( get_post_meta( $post->ID, 'dispaly_first_col', true ) ? get_post_meta( $post->ID, 'dispaly_first_col', true ) : null );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/agenda-grid-setting.php';
    }
    
    public function meta_box_agenda_grid_setting_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['agenda_grid_setting_meta_nonce'] ) || !wp_verify_nonce( $_POST['agenda_grid_setting_meta_nonce'], '_agenda_grid_setting_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        $start_date = new \DateTime( $_POST['gt']['start_date'] );
        $_POST['gt']['start_date'] = $start_date->format( \DateTime::ATOM );
        $end_date = new \DateTime( $_POST['gt']['end_date'] );
        $_POST['gt']['end_date'] = $end_date->format( \DateTime::ATOM );
        if ( isset( $_POST['gt'] ) ) {
            foreach ( $_POST['gt'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }
    }
    
    public function meta_box_agenda_sessions_html( $post )
    {
        $listed_session = ( get_post_meta( $post->ID, 'listed_session', true ) ? get_post_meta( $post->ID, 'listed_session', true ) : array() );
        $resourcesId = array();
        $resources = $this->get_agenda_resources( $post->ID );
        foreach ( $resources as $key => $value ) {
            array_push( $resourcesId, $value['id'] );
        }
        foreach ( $listed_session as $keyres => $value ) {
            if ( !in_array( $value->resourceId, $resourcesId ) ) {
                unset( $listed_session[$keyres] );
            }
        }
        update_post_meta( $post->ID, 'listed_session', $listed_session );
        $listed_session_id = array();
        foreach ( $listed_session as $key2 => $value ) {
            array_push( $listed_session_id, $value->id );
        }
        $args = array(
            'post_type'  => 'session',
            'meta_query' => array( array(
            'key'     => 'event',
            'value'   => $post->ID,
            'compare' => 'IN',
        ) ),
        );
        $query = new \WP_Query( $args );
        if ( $query->posts ) {
            foreach ( $query->posts as $key => $session ) {
                $session->meta = get_post_meta( $session->ID );
            }
        }
        $session = $query->posts;
        foreach ( $session as $key2 => $value2 ) {
            if ( !get_post_meta( $value2->ID, 'repeat', true ) ) {
                if ( in_array( $value2->ID, $listed_session_id ) ) {
                    unset( $session[$key2] );
                }
            }
        }
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/agenda-sessions.php';
    }
    
    public function meta_box_agenda_grid_html( $post )
    {
        wp_nonce_field( '_agenda_grid_meta_nonce', 'agenda_grid_meta_nonce' );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/agenda-grid.php';
    }
    
    /******************************************************************************************************************************
     **
     *******************************************************************************************************************************/
    public function meta_box_session_general_info_html( $post )
    {
        wp_nonce_field( '_session_general_info_meta_nonce', 'session_general_info_meta_nonce' );
        $event = ( get_post_meta( $post->ID, 'event', true ) ? get_post_meta( $post->ID, 'event', true ) : null );
        $session_type = ( get_post_meta( $post->ID, 'session_type', true ) ? get_post_meta( $post->ID, 'session_type', true ) : null );
        $more_link = ( get_post_meta( $post->ID, 'more_link', true ) ? get_post_meta( $post->ID, 'more_link', true ) : null );
        $repeat = ( get_post_meta( $post->ID, 'repeat', true ) ? get_post_meta( $post->ID, 'repeat', true ) : null );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/session-general-info.php';
    }
    
    public function meta_box_session_general_info_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['session_general_info_meta_nonce'] ) || !wp_verify_nonce( $_POST['session_general_info_meta_nonce'], '_session_general_info_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['session_general_info_summery'] ) ) {
            update_post_meta( $post_id, 'session_general_info_summery', wp_kses( $_POST['session_general_info_summery'], wp_kses_allowed_html( 'post' ) ) );
        }
        if ( isset( $_POST['session_general_info_aditional_details'] ) ) {
            update_post_meta( $post_id, 'session_general_info_aditional_details', wp_kses( $_POST['session_general_info_aditional_details'], wp_kses_allowed_html( 'post' ) ) );
        }
        
        if ( isset( $_POST['more_link'] ) ) {
            update_post_meta( $post_id, 'more_link', '1' );
        } else {
            delete_post_meta( $post_id, 'more_link' );
        }
        
        
        if ( isset( $_POST['repeat'] ) ) {
            update_post_meta( $post_id, 'repeat', '1' );
        } else {
            delete_post_meta( $post_id, 'repeat' );
        }
        
        if ( isset( $_POST['gt'] ) ) {
            foreach ( $_POST['gt'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }
    }
    
    public function meta_box_session_speakers_html( $post )
    {
        wp_nonce_field( '_session_speakers_meta_nonce', 'session_speakers_meta_nonce' );
        $speaker = ( get_post_meta( $post->ID, 'speaker', true ) ? get_post_meta( $post->ID, 'speaker', true ) : array() );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/session-speakers.php';
    }
    
    public function meta_box_session_speakers_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['session_speakers_meta_nonce'] ) || !wp_verify_nonce( $_POST['session_speakers_meta_nonce'], '_session_speakers_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        if ( isset( $_POST['speaker'] ) ) {
            $speakers = $_POST['speaker'];
            if ( !is_array( $speakers ) ) {
                return;
            }
            update_post_meta( $post_id, 'speaker', $speakers );
        }
    
    }
    
    public function meta_box_session_venue_html( $post )
    {
        wp_nonce_field( '_session_venue_meta_nonce', 'session_venue_meta_nonce' );
        $venue = ( get_post_meta( $post->ID, 'venue', true ) ? get_post_meta( $post->ID, 'venue', true ) : null );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/session-venue.php';
    }
    
    public function meta_box_session_venue_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['session_venue_meta_nonce'] ) || !wp_verify_nonce( $_POST['session_venue_meta_nonce'], '_session_venue_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        if ( isset( $_POST['venue'] ) ) {
            $venue = sanitize_text_field( $_POST['venue'] );
            update_post_meta( $post_id, 'venue', $venue );
        }
    
    }
    
    public function meta_box_session_style_html( $post )
    {
        wp_nonce_field( '_session_style_meta_nonce', 'session_style_meta_nonce' );
        $style = get_post_meta( $post->ID, 'style', true );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/session-style.php';
    }
    
    public function meta_box_session_style_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['session_style_meta_nonce'] ) || !wp_verify_nonce( $_POST['session_style_meta_nonce'], '_session_style_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['gt'] ) ) {
            foreach ( $_POST['gt'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }
    }
    
    /******************************************************************************************************************************
     **
     *******************************************************************************************************************************/
    public function meta_box_venue_general_info_html( $post )
    {
        wp_nonce_field( '_venue_general_info_meta_nonce', 'venue_general_info_meta_nonce' );
        $address = ( get_post_meta( $post->ID, 'address', true ) ? get_post_meta( $post->ID, 'address', true ) : null );
        $address = ( get_post_meta( $post->ID, 'address', true ) ? get_post_meta( $post->ID, 'address', true ) : null );
        $phone = ( get_post_meta( $post->ID, 'phone', true ) ? get_post_meta( $post->ID, 'phone', true ) : null );
        $email = ( get_post_meta( $post->ID, 'email', true ) ? get_post_meta( $post->ID, 'email', true ) : null );
        $website = ( get_post_meta( $post->ID, 'website', true ) ? get_post_meta( $post->ID, 'website', true ) : null );
        $linkedin = ( get_post_meta( $post->ID, 'linkedin', true ) ? get_post_meta( $post->ID, 'linkedin', true ) : null );
        $facebook = ( get_post_meta( $post->ID, 'facebook', true ) ? get_post_meta( $post->ID, 'facebook', true ) : null );
        $twitter = ( get_post_meta( $post->ID, 'twitter', true ) ? get_post_meta( $post->ID, 'twitter', true ) : null );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/venue-general-info.php';
    }
    
    public function meta_box_venue_general_info_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['venue_general_info_meta_nonce'] ) || !wp_verify_nonce( $_POST['venue_general_info_meta_nonce'], '_venue_general_info_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['venue_general_info_notes'] ) ) {
            update_post_meta( $post_id, 'venue_general_info_notes', wp_kses( $_POST['venue_general_info_notes'], wp_kses_allowed_html( 'post' ) ) );
        }
        if ( isset( $_POST['gt'] ) ) {
            foreach ( $_POST['gt'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }
    }
    
    public function meta_box_venue_rooms_html( $post )
    {
        wp_nonce_field( '_venue_rooms_meta_nonce', 'venue_rooms_meta_nonce' );
        $rooms = ( get_post_meta( $post->ID, 'rooms', true ) ? get_post_meta( $post->ID, 'rooms', true ) : null );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/venue-rooms.php';
    }
    
    public function meta_box_venue_rooms_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['venue_rooms_meta_nonce'] ) || !wp_verify_nonce( $_POST['venue_rooms_meta_nonce'], '_venue_rooms_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        $rooms = array();
        if ( isset( $_POST['rooms'] ) ) {
            foreach ( $_POST['rooms'] as $key => $room ) {
                if ( $room ) {
                    array_push( $rooms, $room );
                }
            }
        }
        update_post_meta( $post_id, 'rooms', $rooms );
    }
    
    /******************************************************************************************************************************
     **
     *******************************************************************************************************************************/
    public function meta_box_speaker_general_info_html( $post )
    {
        wp_nonce_field( '_speaker_general_info_meta_nonce', 'speaker_general_info_meta_nonce' );
        $organization = ( get_post_meta( $post->ID, 'organization', true ) ? get_post_meta( $post->ID, 'organization', true ) : null );
        $job_title = ( get_post_meta( $post->ID, 'job_title', true ) ? get_post_meta( $post->ID, 'job_title', true ) : null );
        $address = ( get_post_meta( $post->ID, 'address', true ) ? get_post_meta( $post->ID, 'address', true ) : null );
        $phone = ( get_post_meta( $post->ID, 'phone', true ) ? get_post_meta( $post->ID, 'phone', true ) : null );
        $email = ( get_post_meta( $post->ID, 'email', true ) ? get_post_meta( $post->ID, 'email', true ) : null );
        $website = ( get_post_meta( $post->ID, 'website', true ) ? get_post_meta( $post->ID, 'website', true ) : null );
        $linkedin = ( get_post_meta( $post->ID, 'linkedin', true ) ? get_post_meta( $post->ID, 'linkedin', true ) : null );
        $facebook = ( get_post_meta( $post->ID, 'facebook', true ) ? get_post_meta( $post->ID, 'facebook', true ) : null );
        $twitter = ( get_post_meta( $post->ID, 'twitter', true ) ? get_post_meta( $post->ID, 'twitter', true ) : null );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/speaker-general-info.php';
    }
    
    public function meta_box_speaker_general_info_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['speaker_general_info_meta_nonce'] ) || !wp_verify_nonce( $_POST['speaker_general_info_meta_nonce'], '_speaker_general_info_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['speaker_general_info_biography'] ) ) {
            update_post_meta( $post_id, 'speaker_general_info_biography', wp_kses( $_POST['speaker_general_info_biography'], wp_kses_allowed_html( 'post' ) ) );
        }
        if ( isset( $_POST['gt'] ) ) {
            foreach ( $_POST['gt'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }
    }
    
    /******************************************************************************************************************************
     **
     *******************************************************************************************************************************/
    public function meta_box_organization_general_info_html( $post )
    {
        wp_nonce_field( '_organization_general_info_meta_nonce', 'organization_general_info_meta_nonce' );
        $address = ( get_post_meta( $post->ID, 'address', true ) ? get_post_meta( $post->ID, 'address', true ) : null );
        $phone = ( get_post_meta( $post->ID, 'phone', true ) ? get_post_meta( $post->ID, 'phone', true ) : null );
        $email = ( get_post_meta( $post->ID, 'email', true ) ? get_post_meta( $post->ID, 'email', true ) : null );
        $website = ( get_post_meta( $post->ID, 'website', true ) ? get_post_meta( $post->ID, 'website', true ) : null );
        $linkedin = ( get_post_meta( $post->ID, 'linkedin', true ) ? get_post_meta( $post->ID, 'linkedin', true ) : null );
        $facebook = ( get_post_meta( $post->ID, 'facebook', true ) ? get_post_meta( $post->ID, 'facebook', true ) : null );
        $twitter = ( get_post_meta( $post->ID, 'twitter', true ) ? get_post_meta( $post->ID, 'twitter', true ) : null );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/organization-general-info.php';
    }
    
    public function meta_box_organization_general_info_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['organization_general_info_meta_nonce'] ) || !wp_verify_nonce( $_POST['organization_general_info_meta_nonce'], '_organization_general_info_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['organization_general_info_profile'] ) ) {
            update_post_meta( $post_id, 'organization_general_info_profile', wp_kses( $_POST['organization_general_info_profile'], wp_kses_allowed_html( 'post' ) ) );
        }
        if ( isset( $_POST['gt'] ) ) {
            foreach ( $_POST['gt'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }
    }
    
    /******************************************************************************************************************************
     **
     *******************************************************************************************************************************/
    public function meta_box_template_style_general_info_html( $post )
    {
        wp_nonce_field( '_template_style_general_info_meta_nonce', 'template_style_general_info_meta_nonce' );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/template-style-general-info.php';
    }
    
    public function meta_box_template_style_general_info_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['template_style_general_info_meta_nonce'] ) || !wp_verify_nonce( $_POST['template_style_general_info_meta_nonce'], '_template_style_general_info_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['template_style_general_info_description'] ) ) {
            update_post_meta( $post_id, 'template_style_general_info_description', wp_kses( $_POST['template_style_general_info_description'], wp_kses_allowed_html( 'post' ) ) );
        }
    }
    
    public function meta_box_template_style_session_style_html( $post )
    {
        wp_nonce_field( '_template_style_session_style_meta_nonce', 'template_style_session_style_meta_nonce' );
        $style = get_post_meta( $post->ID, 'style', true );
        require_once plugin_dir_path( __FILE__ ) . '../../admin/partials/meta-boxes/template-style-session-style.php';
    }
    
    public function meta_box_template_style_session_style_save( $post_id )
    {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        if ( !isset( $_POST['template_style_session_style_meta_nonce'] ) || !wp_verify_nonce( $_POST['template_style_session_style_meta_nonce'], '_template_style_session_style_meta_nonce' ) ) {
            return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        if ( isset( $_POST['gt'] ) ) {
            foreach ( $_POST['gt'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }
    }
    
    public function check_op_value( $givva, $dbval )
    {
        if ( $givva === $dbval ) {
            return 'selected="selected"';
        }
    }
    
    public function check_rc_value( $givva, $dbval )
    {
        if ( $givva === $dbval ) {
            return 'checked="checked"';
        }
    }

}