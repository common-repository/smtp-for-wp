<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'SN_WS_SETTING' ) ) {
    class SN_WS_SETTING {

        /**
         * Constructor
         * @description Function to initialize WP actions for the class
         */
        function __construct()
        {
            // Assets
            add_action( 'admin_enqueue_scripts', array( &$this, 'set_page_assets' ), 10 );
            //-------

            // Setting
            add_action( 'admin_post_sn_ws_update_setting', array( &$this, 'update_setting' ) );
            //--------
        }

        /**
         * Set page assets
         * @description Function to include the JS for product page
         */
        public function set_page_assets() {
            $page = @sanitize_key( $_GET['page'] );
            if ( $page == 'sn-ws-setting') {
                wp_enqueue_style('sn-ws-select2', SN_WS_ASSET_URL . '/css/select2.min.css', SN_WS_PLUGIN_VERSION);
                wp_enqueue_script('sn-ws-select2', SN_WS_ASSET_URL . '/js/select2.min.js', array('jquery'), SN_WS_PLUGIN_VERSION);
                wp_enqueue_script( 'sn-ws-setting', SN_WS_ASSET_URL . '/js/setting.js', array('jquery'), SN_WS_PLUGIN_VERSION );
            }
        }

        /**
         * Template page
         * @description Function to show the template page
         */
        public static function setting_page() {
            $page_name = 'setting';
            $encryption_list = ['none' => 'None', 'tls' => 'TLS', 'ssl' => 'SSL'];
            include( SN_WS_TEMPLATE_PATH.'/setting.php' );
        }

        /**
         * Update setting
         * @description Function to update general setting
         */
        public function update_setting() {
            $fn_status = true;

            // Update option variables
            if($fn_status == true) {
                update_option( 'sn_ws_from_email', sanitize_email( $_POST['sn_ws_from_email'] ) );
                update_option( 'sn_ws_from_name', sanitize_text_field( $_POST['sn_ws_from_name'] ) );
                update_option( 'sn_ws_smtp_host', sanitize_text_field( $_POST['sn_ws_smtp_host'] ) );
                update_option( 'sn_ws_encryption', sanitize_text_field( $_POST['sn_ws_encryption'] ) );
                update_option( 'sn_ws_port', sanitize_text_field( $_POST['sn_ws_port'] ) );
                update_option( 'sn_ws_authentication', @intval( $_POST['sn_ws_authentication'] ) );
                update_option( 'sn_ws_smtp_username', sanitize_text_field( $_POST['sn_ws_smtp_username'] ) );
                update_option( 'sn_ws_smtp_password', sanitize_text_field( $_POST['sn_ws_smtp_password'] ) );
            }
            //------------------------

            // Set message
            SN_WS_INIT::set_message(__('Settings updated', 'smtp-for-wp'), 'success');
            //------------

            wp_redirect( 'admin.php?page=sn-ws-setting' );
        }
    }
}

$sn_ws_setting = new SN_WS_SETTING();
