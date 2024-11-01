<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'SN_WS_INIT' ) ) {

    class SN_WS_INIT {

        /**
         * Constructor
         * @description Function to register and initialize WP actions for the plugin
         */
        function __construct() {

            register_activation_hook( SN_WS_FILE, array( 'SN_WS_INIT', 'install_plugin_data' ) );
            register_uninstall_hook( SN_WS_FILE, array( 'SN_WS_INIT', 'uninstall_plugin_data' ) );

            $this->init_plugin();
        }

        /**
         * Initializer plugin
         * @description Function initialize action for the plugin
         */
        public function init_plugin() {
            add_filter( 'plugin_action_links_' . SN_WS_FILE_NAME, array($this, 'plugin_action_links'));
            add_action( 'admin_enqueue_scripts', array( &$this, 'set_admin_css' ), 10 );
            add_action( 'admin_enqueue_scripts', array( &$this, 'set_admin_js' ), 10 );
            add_action( 'admin_head', array( &$this, 'add_head_js'), 10 );
            add_action( 'admin_menu', array( &$this, 'set_menu' ) );

            add_action( 'phpmailer_init', array( &$this, 'set_mailer_config') );
            add_filter( 'wp_mail', array( &$this, 'update_mail_config_data' ), 10, 1);
        }

        /**
         * Add action links on plugin page
         * @description Function to add plugin action links
         *
         * @param $links
         * @return array
         */
        public function plugin_action_links( $links ) {
            $plugin_links = array(
                '<a target="_blank" href="'.SN_WS_DOCUMENTATION_URL.'">' . __('Documentation', 'smtp-for-wp') . '</a>',
                '<a target="_blank" href="https://wordpress.org/support/plugin/smtp-for-wp/reviews?rate=5#new-post">' . __('Review', 'smtp-for-wp') . '</a>',
            );
            return array_merge($plugin_links, $links);
        }

        /**
         * Set admin CSS
         * @description Function to include the admin CSS
         */
        public function set_admin_css() {
            wp_enqueue_style( 'sn-ws-admin', SN_WS_ASSET_URL . '/css/style.css', array(), SN_WS_PLUGIN_VERSION );
        }

        /**
         * Set admin JS
         * @description Function to include the admin JS
         */
        public function set_admin_js() {
            wp_enqueue_script( 'jquery-form', SN_WS_ASSET_URL . '/js/jquery.form.js', array('jquery'), SN_WS_PLUGIN_VERSION );
        }

        /**
         * Add Head JS
         * @description Function to add global JS variables in adminhead
         */
        public function add_head_js() {
            ?>
<script>
    var sn_ws_admin_url = "<?php echo( esc_url(admin_url()) ); ?>";
</script>
            <?php
        }

        /**
         * Set PHPMailer config
         * @description Function to set PHPMailer config
         *
         */
        public function set_mailer_config( $phpmailer ) {
            $phpmailer->IsSMTP();
            //$phpmailer->SMTPDebug = 2;
            //$phpmailer->debug = 1;
            $phpmailer->Host = get_option('sn_ws_smtp_host');
            $phpmailer->Port = get_option('sn_ws_port');
            $phpmailer->Username = get_option('sn_ws_smtp_username');
            $phpmailer->Password = get_option('sn_ws_smtp_password');
            $phpmailer->SMTPAuth = get_option('sn_ws_authentication');
            $phpmailer->SMTPSecure = get_option('sn_ws_encryption');
            $phpmailer->From = get_option('sn_ws_from_email');
            $phpmailer->FromName = get_option('sn_ws_from_name');
            //$sent = $phpmailer->Send();
        }

        /**
         * Set filter on PHPMailer config data
         * @description Function to apply filter PHPMailer config data
         *
         */
        public function update_mail_config_data( $args ) {
            return( $args );
        }

        /**
         * Set menu
         * @description Function to set the menu for the plugin
         */
        public function set_menu() {
            global $current_user;

            if ( current_user_can( 'administrator' ) || is_super_admin() ) {
                $capabilities = $this->user_capabilities();
                foreach ( $capabilities as $capability => $cap_desc ) {
                    $current_user->add_cap( $capability );
                }
                unset ( $capabilities );
            }

            add_menu_page( __('WordPress SMTP', 'smtp-for-wp'), __('WordPress SMTP', 'smtp-for-wp'), 'sn_ws_manage_setting', 'sn-ws-setting', array('SN_WS_SETTING', 'setting_page') , 'dashicons-email-alt' );
            add_submenu_page( 'sn-ws-setting', __('Setting', 'smtp-for-wp'), __('Setting', 'smtp-for-wp'), 'sn_ws_manage_setting', 'sn-ws-setting', array('SN_WS_SETTING', 'setting_page' ) );
            add_submenu_page( 'sn-ws-setting', __('Test Email', 'smtp-for-wp'), __('Test Email', 'smtp-for-wp'), 'sn_ws_manage_test_email', 'sn-ws-test-email', array('SN_WS_TEST_EMAIL', 'test_email_page' ) );
        }

        /**
         * Install plugin data
         * @description Function to install the data at installation
         */
        public function install_plugin_data() {

        }

        /**
         * Uninstall plugin data
         * @description Function to uninstall the data at un-installation
         */
        public function uninstall_plugin_data() {

        }

        /**
         * Set message
         * @description Function to set the message in session
         * @param $message
         * @param $type
         */
        public static function set_message( $message, $type ) {
            $_SESSION['sn_ws_message'] = ['type' => $type, 'message' => $message];
        }

        /**
         * Show message
         * @description Function to show the message on the top of page
         */
        public static function show_message() {
            $html = '';
            $message = sanitize_text_field( @$_SESSION['sn_ws_message']['message'] );
            if( $message ) {
                $html .= '<div id="message" class="sn-ws-message updated notice notice-success is-dismissible">';
                $html .= '<p>'. __($message, 'smtp-for-wp') .'</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">'.__('Dismiss this notice', 'smtp-for-wp').'</span></button>';
                $html .= '</div>';
                echo(wp_kses($html, 'post'));
            }
            unset($_SESSION['sn_ws_message']);
        }

        /**
         * User capabilities
         * @description Function to return plugin user capabilities
         * @return array
         */
        private function user_capabilities() {

            return array (
                'sn_ws_manage_setting'         => __( 'User can manage Setting', 'smtp-for-wp' ),
                'sn_ws_manage_test_email'      => __( 'User can manage Test Email', 'smtp-for-wp' )
            );
        }
    }
}

$sn_ws_init = new SN_WS_INIT();
