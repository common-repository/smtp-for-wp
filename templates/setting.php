<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

?>
<div class="sn-ws-setting-page">
    <div class="sn-ws-header">
        <h2><?php echo( __('Setting', SN_WS_SLUG) ); ?></h2>
        <p><?php echo( __('This section allows you to manage Mail and SMTP settings', SN_WS_SLUG) ); ?></p>
    </div>
    <div class="sn-ws-box-section">
        <?php include( SN_WS_TEMPLATE_PATH.'/navigation.php' );?>
        <div class="setting-box">
            <form id="form_setting" action="<?php echo(admin_url('admin-post.php')) ?>" method="post" class="sn-ws-form  setting-form">
                <input type="hidden" id="action" name="action" value="sn_ws_update_setting" />
                <div class="input-row">
                    <div class="input-group left">
                        <label class="control-label"><?php echo( __('From Email', SN_WS_SLUG) ); ?></label>
                        <input type="text" id="sn_ws_from_email" name="sn_ws_from_email" class="form-control" value="<?php echo(get_option('sn_ws_from_email')) ?>" />
                        <div class="input-hint"><?php echo( __('The email address that emails are sent from.', SN_WS_SLUG) ); ?></div>
                        <div class="input-hint"><?php echo( __('Please note that other plugins can change this, to prevent this use the setting below.', SN_WS_SLUG) ); ?></div>
                    </div>
                    <div class="input-group right">
                        <label class="control-label"><?php echo( __('From Name', SN_WS_SLUG) ); ?></label>
                        <input type="text" id="sn_ws_from_name" name="sn_ws_from_name" class="form-control" value="<?php echo(get_option('sn_ws_from_name')) ?>" />
                        <div class="input-hint"><?php echo( __('The name that emails are sent from.', SN_WS_SLUG) ); ?></div>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group left">
                        <label class="control-label"><?php echo( __('SMTP Host', SN_WS_SLUG) ); ?></label>
                        <input type="text" id="sn_ws_smtp_host" name="sn_ws_smtp_host" class="form-control" value="<?php echo(get_option('sn_ws_smtp_host')) ?>" />
                    </div>
                    <div class="input-group right">
                        <label class="control-label"><?php echo( __('Encryption', SN_WS_SLUG) ); ?></label>
                        <select id="sn_ws_encryption" name="sn_ws_encryption" class="form-control custom-select" style="width:100%;">
                            <?php
                            foreach($encryption_list as $key => $encryption) {
                                ?>
                                <option value="<?php echo($key) ?>" <?php echo(get_option('sn_ws_encryption')==$key?'selected':'') ?>><?php echo($encryption) ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <div class="input-hint"><?php echo( __('For most servers TLS is the recommended option. If your SMTP provider offers both SSL and TLS options, we recommend using TLS.', SN_WS_SLUG) ); ?></div>
                    </div>
                </div>

                <div class="input-row" style="clear:both;">
                    <div class="input-group left">
                        <label class="control-label"><?php echo( __('SMTP Port', SN_WS_SLUG) ); ?></label>
                        <input type="text" id="sn_ws_port" name="sn_ws_port" class="form-control" value="<?php echo(get_option('sn_ws_port')) ?>" />
                    </div>
                    <div class="input-group right">
                        <label class="control-label"><?php echo( __('Authentication', SN_WS_SLUG) ); ?></label>
                        <label class="switch"><input type="checkbox" id="sn_ws_authentication" name="sn_ws_authentication" class="form-control" value="1" <?php if(get_option('sn_ws_authentication') == 1) { echo('checked'); } ?> /><span class="switch-slider"></span></label><?php echo( __('ON', SN_WS_SLUG) ); ?>
                    </div>
                </div>

                <div class="input-row">
                    <div class="input-group left">
                        <label class="control-label"><?php echo( __('SMTP Username', SN_WS_SLUG) ); ?></label>
                        <input type="text" id="sn_ws_smtp_username" name="sn_ws_smtp_username" class="form-control" value="<?php echo(get_option('sn_ws_smtp_username')) ?>" />
                    </div>
                    <div class="input-group right">
                        <label class="control-label"><?php echo( __('SMTP Password', SN_WS_SLUG) ); ?></label>
                        <input type="password" id="sn_ws_smtp_password" name="sn_ws_smtp_password" class="form-control" value="<?php echo(get_option('sn_ws_smtp_password')) ?>" />
                    </div>
                </div>
            </form>
            <div class="footer">
                <button type="button" class="button button-primary btn-submit" data-form="form_setting"><?php echo( __('Save', SN_WS_SLUG) ); ?></button>
            </div>
        </div>
    </div>
</div>
