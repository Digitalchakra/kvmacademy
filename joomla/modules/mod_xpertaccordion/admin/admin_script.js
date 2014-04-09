/**
 * @package Xpert Accordion
 * @version 1.0
 * @author ThemeXpert http://www.themexpert.com
 * @copyright Copyright (C) 2009 - 2011 ThemeXpert
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

jQuery.noConflict();
jQuery(document).ready(function(){

    jQuery('#jform_params_catid , #jformparamscategory_id, #jform_params_modules, #jformparamsezb_catid').css('width','280px');
    //Chosen Multiple selector
    jQuery("#jform_params_catid, #jformparamscategory_id, #jform_params_modules, #jformparamsezb_catid").chosen();

    //increae module panel height for chosen
    jQuery('#jform_params_modules, #jformparamsezb_catid').closest('fieldset').css('height', '150px');

    //k2 cat filter selection
    jQuery('#jform_params_catfilter0').click(function(){
        jQuery('#jformparamscategory_id').closest('li').hide();
    });

    jQuery('#jform_params_catfilter1').click(function(){
        jQuery('#jformparamscategory_id').closest('li').show();
    });

    if (jQuery('#jform_params_catfilter0').attr('checked')) {
        jQuery('#jformparamscategory_id').closest('li').hide();
    }

    if (jQuery('#jform_params_catfilter1').attr('checked')) {
        jQuery('#jformparamscategory_id').closest('li').show();
    }

    //EasyBlog cat filter selection
    jQuery('#jform_params_ezb_catfilter0').click(function(){
        jQuery('#jformparamsezb_catid').closest('li').hide();
    });

    jQuery('#jform_params_ezb_catfilter1').click(function(){
        jQuery('#jformparamsezb_catid').closest('li').show();
    });

    if (jQuery('#jform_params_ezb_catfilter0').attr('checked')) {
        jQuery('#jformparamsezb_catid').closest('li').hide();
    }

    if (jQuery('#jform_params_ezb_catfilter1').attr('checked')) {
        jQuery('#jformparamsezb_catid').closest('li').show();
    }
    //Joomla, k2, Easyblog Accordion hide and show effect depend on content source.
    function showJoomla(){
        jQuery('#JOOMLA_CONTENT_SETTINGS-options').parent().show();
        jQuery('#K2_CONTENT_SETTINGS-options').parent().hide();
        jQuery('#MODULE_SETTINGS-options').parent().hide();
        jQuery('#EASYBLOG-options').parent().hide();
    }
    function showK2(){
        jQuery('#JOOMLA_CONTENT_SETTINGS-options').parent().hide();
        jQuery('#K2_CONTENT_SETTINGS-options').parent().show();
        jQuery('#MODULE_SETTINGS-options').parent().hide();
        jQuery('#EASYBLOG-options').parent().hide();
    }
    function showModules(){
        jQuery('#JOOMLA_CONTENT_SETTINGS-options').parent().hide();
        jQuery('#K2_CONTENT_SETTINGS-options').parent().hide();
        jQuery('#EASYBLOG-options').parent().hide();
        jQuery('#MODULE_SETTINGS-options').parent().show();
    }
    function showEasyblog()
    {
        jQuery('#JOOMLA_CONTENT_SETTINGS-options').parent().hide();
        jQuery('#K2_CONTENT_SETTINGS-options').parent().hide();
        jQuery('#MODULE_SETTINGS-options').parent().hide();
        jQuery('#EASYBLOG-options').parent().show();

    }

    //determine which settings is enable in content source and show related container
    switch(jQuery('#jform_params_content_source').val()){

        case 'joomla': showJoomla(); break;
        case 'k2': showK2(); break;
        case 'mods': showModules(); break;
        case 'easyblog' : showEasyblog(); break;

    }

    //change accordion realtime
    jQuery('#jform_params_content_source').change(function(){
        switch(jQuery('#jform_params_content_source').val()){
        case 'joomla':
            showJoomla();
            break;
        case 'k2':
            showK2();
            break;
        case 'mods':
            showModules();
            break;
        case 'easyblog' : showEasyblog(); break;
    }
    });
});