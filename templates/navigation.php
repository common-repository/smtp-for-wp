<?php SN_WS_INIT::show_message(); ?>
<div class="sn-ws-navigation-box">
    <a href="admin.php?page=sn-ws-setting" class="nav-link <?php echo($page_name=='setting'?'active':'') ?>"><?php echo( __('Setting', SN_WS_SLUG) ); ?></a>
    <a href="admin.php?page=sn-ws-test-email" class="nav-link <?php echo($page_name=='test-email'?'active':'') ?>"><?php echo( __('Test Email', SN_WS_SLUG) ); ?></a>
    <div class="support-links">
        <a href="<?php echo( SN_WS_PLUGIN_URL ); ?>" target="_blank"><?php echo( __('Documentation', SN_WS_SLUG) ); ?></a> | <a href="<?php echo( SN_WS_AUTHOR_URL ); ?>contact-us" target="_blank"><?php echo( __('Support', SN_WS_SLUG) ); ?></a>
    </div>
</div>
