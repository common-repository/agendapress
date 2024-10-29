<?php

/**
 * The agendapress bootstrap file
 *
 * This file is read by WordPress to generate the agendapress information in the agendapress
 * admin area. This file also includes all of the dependencies used by the agendapress,
 * registers the activation and deactivation functions, and defines a function
 * that starts the agendapress.
 *
 * @link              https://www.blackandwhitedigital.net/
 * @since             1.0.0
 * @package           Agendapress
 *
 * @wordpress-agendapress
 * Plugin Name: AgendaPress
 * Plugin URI:        https://www.agendapress.net/
 * Description:       AgendaPress is a powerful tool for meeting organizers to create and style agendas, orders of service, concert programs etc.
 * Version:           1.0.8
 * Author:            Black and White Digital Ltd
 * Author URI:        https://wordpress.org/plugins/agendapress
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       agendapress
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

if ( !function_exists( 'age_fs' ) ) {
    // Create a helper function for easy SDK access.
    function age_fs()
    {
        global  $age_fs ;
        
        if ( !isset( $age_fs ) ) {
            // Activate multisite network integration.
            if ( !defined( 'WP_FS__PRODUCT_3817_MULTISITE' ) ) {
                define( 'WP_FS__PRODUCT_3817_MULTISITE', true );
            }
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $age_fs = fs_dynamic_init( array(
                'id'             => '3817',
                'slug'           => 'agendapress',
                'type'           => 'plugin',
                'public_key'     => 'pk_9589e67a79ecdc0c41423a8327032',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => true,
                'trial'          => array(
                'days'               => 14,
                'is_require_payment' => true,
            ),
                'menu'           => array(
                'slug'       => 'agendapress',
                'first-path' => 'edit.php?post_type=agenda',
                'support'    => false,
                'network'    => true,
            ),
                'is_live'        => true,
            ) );
        }
        
        return $age_fs;
    }
    
    // Init Freemius.
    age_fs();
    // Signal that SDK was initiated.
    do_action( 'age_fs_loaded' );
}

/**
 * Currently agendapress version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your agendapress and update it as you release new versions.
 */
define( 'AGENDAPRESS_VERSION', '1.0.8' );
/**
 * The code that runs during agendapress activation.
 * This action is documented in vendor/autoload.php
 */
include dirname( __FILE__ ) . '/vendor/autoload.php';
/**
 * The code that runs during agendapress activation.
 * This action is documented in includes/class-agendapress-activator.php
 */
function activate_agendapress()
{
    \Agendapress\Includes\Agendapress_Activator::activate();
}

/**
 * The code that runs during agendapress deactivation.
 * This action is documented in includes/class-agendapress-deactivator.php
 */
function deactivate_agendapress()
{
    \Agendapress\Includes\Agendapress_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_agendapress' );
register_deactivation_hook( __FILE__, 'deactivate_agendapress' );
/**
 * Begins execution of the agendapress.
 *
 * Since everything within the agendapress is registered via hooks,
 * then kicking off the agendapress from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function agendapress()
{
    $agendapress = new \Agendapress\Includes\Agendapress();
    $agendapress->run();
}

agendapress();