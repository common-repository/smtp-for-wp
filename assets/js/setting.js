jQuery(document).ready(function()
{
    var $setting_box = jQuery('.sn-ws-setting-page .setting-box');
    var $test_email_box = jQuery('.sn-ws-test-email-page .test-email-box');

    // Form Submit Event
    $setting_box.find('.btn-submit').click(function() {
        jQuery('form#'+jQuery(this).data('form')).submit();
    });
    $test_email_box.find('.btn-submit').click(function() {
        jQuery('form#'+jQuery(this).data('form')).submit();
    });
    //------------------

    // Apply Custom Select
    $setting_box.find('.custom-select').select2({'minimumResultsForSearch': -1});
    //--------------------
});


