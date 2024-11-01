<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

?>
<div class="sn-ws-test-email-page">
    <div class="sn-ws-header">
        <h2><?php echo( __('Test Email', SN_WS_SLUG) ); ?></h2>
        <p><?php echo( __('This section allows you to test your SMTP details', SN_WS_SLUG) ); ?></p>
    </div>
    <div class="sn-ws-box-section">
        <?php include( SN_WS_TEMPLATE_PATH.'/navigation.php' );?>
        <div class="test-email-box">
            <form id="form_test_email" action="<?php echo(admin_url('admin-post.php')) ?>" method="post" class="sn-ws-form test-email-form">
                <input type="hidden" id="action" name="action" value="sn_ws_send_test_email" />
                <div class="input-group">
                    <label class="control-label"><?php echo( __('Send To', SN_WS_SLUG) ); ?></label>
                    <input type="text" id="sn_ws_send_to" name="sn_ws_send_to" class="form-control" value="<?php echo(get_option('admin_email')) ?>" />
                    <div class="input-hint"><?php echo( __('Enter email address where test email will be sent.', SN_WS_SLUG) ); ?></div>
                </div>
                <div class="input-group">
                    <label class="control-label"><?php echo( __('HTML', SN_WS_SLUG) ); ?></label>
                    <label class="switch"><input type="checkbox" id="sn_ws_html" name="sn_ws_html" class="form-control" value="1" checked /><span class="switch-slider"></span></label><?php echo( __('ON', SN_WS_SLUG) ); ?>
                </div>
            </form>
            <div class="footer">
                <button type="button" class="button button-primary btn-submit" data-form="form_test_email"><?php echo( __('Send Email', SN_WS_SLUG) ); ?></button>
            </div>
        </div>
    </div>
</div>
