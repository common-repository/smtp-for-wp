<?php
/*
Plugin Name: SMTP For WP
Plugin URI: https://www.codeteam.in/product/wordpress-smtp/
Description: Configure SMTP details to send emails using your SMTP account.
Version: 1.1
Requires at least: 4.9
Tested up to: 6.4.1
Requires PHP: 5.4
Author: Siddharth Nagar
Author URI: http://www.codeteam.in/
License: GPLv2
*/
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! defined( 'SN_WS_AUTHOR_URL' ) ) {
    define( 'SN_WS_AUTHOR_URL', 'https://www.codeteam.in/' );
}

if ( ! defined( 'SN_WS_PLUGIN_URL' ) ) {
    define( 'SN_WS_PLUGIN_URL', SN_WS_AUTHOR_URL.'product/wordpress-smtp/' );
}

if ( ! defined( 'SN_WS_DOCUMENTATION_URL' ) ) {
    define( 'SN_WS_DOCUMENTATION_URL', SN_WS_AUTHOR_URL.'documentation/wordpress-smtp/introduction/' );
}

if ( ! defined( 'SN_WS_PLUGIN_VERSION' ) ) {
    define( 'SN_WS_PLUGIN_VERSION', '1.1' );
}

if ( ! defined( 'SN_WS_SLUG' ) ) {
    define( 'SN_WS_SLUG', 'smtp-for-wp' );
}

if ( ! defined( 'SN_WS_DIR' ) ) {
      define( 'SN_WS_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'SN_WS_URL' ) ) {
    define( 'SN_WS_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'SN_WS_FILE' ) ) {
      define( 'SN_WS_FILE', __FILE__ );
}

if ( ! defined( 'SN_WS_FILE_NAME' ) ) {
    define( 'SN_WS_FILE_NAME', plugin_basename(__FILE__) );
}

if ( ! defined( 'SN_WS_TEMPLATE_PATH' ) ) {
      define( 'SN_WS_TEMPLATE_PATH', SN_WS_DIR . 'templates' );
}

if ( ! defined( 'SN_WS_ASSET_URL' ) ) {
      define( 'SN_WS_ASSET_URL', SN_WS_URL . 'assets' );
}

/**
 * Initialize plugin
 * @description Function to initialize the plugin
 */
function sn_ws_init() {

    load_plugin_textdomain( SN_WS_SLUG, false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );

    if(file_exists(SN_WS_DIR.'/includes/class.sn-ws-init.php')) {
        require_once(SN_WS_DIR.'/includes/class.sn-ws-init.php');
    }

    if(file_exists(SN_WS_DIR.'/includes/class.sn-ws-setting.php')) {
        require_once(SN_WS_DIR.'/includes/class.sn-ws-setting.php');
    }

    if(file_exists(SN_WS_DIR.'/includes/class.sn-ws-test-email.php')) {
        require_once(SN_WS_DIR.'/includes/class.sn-ws-test-email.php');
    }
}
add_action( 'sn_ws_init', 'sn_ws_init' );


/**
 * Install plugin
 * @description Function to initiate the plugin installation
 */
function sn_ws_install() {
    do_action( 'sn_ws_init' );
}
add_action( 'plugins_loaded', 'sn_ws_install', 10 );