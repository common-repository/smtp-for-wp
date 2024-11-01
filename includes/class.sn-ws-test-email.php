<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

if ( ! class_exists( 'SN_WS_TEST_EMAIL' ) ) {
    class SN_WS_TEST_EMAIL {

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
            add_action( 'admin_post_sn_ws_send_test_email', array( &$this, 'send_test_email' ) );
            //--------
        }

        /**
         * Set page assets
         * @description Function to include the JS for product page
         */
        public function set_page_assets() {
            $page = @sanitize_key( $_GET['page'] );
            if ( $page == 'sn-ws-test-email') {
                wp_enqueue_style('sn-ws-select2', SN_WS_ASSET_URL . '/css/select2.min.css', SN_WS_PLUGIN_VERSION);
                wp_enqueue_script('sn-ws-select2', SN_WS_ASSET_URL . '/js/select2.min.js', array('jquery'), SN_WS_PLUGIN_VERSION);
                wp_enqueue_script( 'sn-ws-setting', SN_WS_ASSET_URL . '/js/setting.js', array('jquery'), SN_WS_PLUGIN_VERSION );
            }
        }

        /**
         * Template page
         * @description Function to show the template page
         */
        public static function test_email_page() {
            $page_name = 'test-email';
            include( SN_WS_TEMPLATE_PATH.'/test-email.php' );
        }

        /**
         * Send test email
         * @description Function to send test email
         */
        public function send_test_email() {
            $fn_status = true;
            $send_to_email = get_option('admin_email');
            $html_header = 1;

            // Fetch request variables
            $send_to_email = sanitize_email( $_POST['sn_ws_send_to'] );
            $html_header = @intval($_POST['sn_ws_html']);
            //------------------------

            // Update option variables
            if($fn_status == true) {
                if($html_header == 1) {
                    $headers = ['Content-Type: text/html'];
                }
                else {
                    $headers = ['Content-Type: text/plain'];
                }
                $subject = 'Test email from '.' '.get_bloginfo();
                $message = $this->get_test_email_content();
                $fn_status = wp_mail( $send_to_email, $subject, $message, $headers );
            }
            //------------------------

            // Set message
            if($fn_status == true) {
                SN_WS_INIT::set_message(__('Email send successfully', 'smtp-for-wp'), 'success');
            }
            else {
                SN_WS_INIT::set_message(__('Error in sending email', 'smtp-for-wp'), 'error');
            }

            //------------

            wp_redirect( 'admin.php?page=sn-ws-test-email' );
        }

        /**
         * Test email content
         * @description Function to get test email content
         */
        private function get_test_email_content() {
            $html = '';

            $html .= '<div style="background:#F0F0F1;padding:50px 0;">';
                $html .= '<div style="width: 600px;margin:auto;background:#ffffff;padding:20px;border-top:solid 4px #4F8ECB;">';
                    $html .= '<div style="font-size:20px;text-align:center;margin:0px 0 10px 0;">Congrats, test email was sent successfully!</div>';
                    $html .= '<div style="font-size:14px;margin:10px 0;">Thank you for trying our SMTP for WordPress.<br />If you find this free plugin userful, please consider <a href="https://wordpress.org/support/plugin/smtp-for-wp/reviews?rate=5#new-post" target="_blank">giving us a review!</a></div>';
                    $html .= '<div style="font-size:14px;">Thank You</div>';
                $html .= '</div>';
            $html .= '</div>';

            return($html);
        }
    }
}

$sn_ws_test_email = new SN_WS_TEST_EMAIL();
