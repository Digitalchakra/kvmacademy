<?php
/**
 * @package Expose
 * @subpackage Xpert Contents
 * @version 1.0
 * @author ThemeXpert http://www.themexpert.com
 * @copyright Copyright (C) 2009 - 2011 ThemeXpert
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldUtility extends JFormField{

    protected  $type = 'Utility';

    protected function getInput(){

        $doc =& JFactory::getDocument();

        $doc->addStyleSheet(JURI::root(true).'/modules/mod_xpertaccordion/admin/style.css');

        //load jquery
        $doc->addScript(JURI::root(true).'/modules/mod_xpertaccordion/assets/js/jquery-1.7.2.min.js');
        $doc->addScript(JURI::root(true).'/modules/mod_xpertaccordion/admin/chosen.jquery.min.js');

        //load admin script
        $doc->addScript(JURI::root(true).'/modules/mod_xpertaccordion/admin/admin_script.js');

        //check component and add warning or success info on module
        $k2 = JPATH_SITE.DS."components".DS."com_k2".DS."k2.php";
        $easyblog = JPATH_SITE.DS."components".DS."com_easyblog".DS."easyblog.php";


        $k2Warning = "<h4 class=\"alert_info\">K2 Not Found. In order to use the K2 Content type, you will need to <a href=\"http://www.getk2.org\" target=\"_blank\">download and install it.</a>";
        $k2Success = "<h4 class=\"alert_success\"><strong>K2 Component</strong> has been found and is available to use.</h4>";

        $ebWarning = "<h4 class=\"alert_info\">EasyBlog Not Found. In order to use the EasyBlog Content type, you will need to <a href=\"http://www.stackideas.com\" target=\"_blank\">download and install it.</a>";

        $ebSuccess = "<h4 class=\"alert_success\">EasyBlog Component has been found and is available to use.</h4>";

        if (!file_exists($k2)) {
            //define('K2_CHECK', 0);
			$html =  $k2Warning;
		}
        else  {
			//define('K2_CHECK', 1);
			$html = $k2Success;
		}
        if(!file_exists($easyblog)) $html .= $ebWarning;
        else $html .= $ebSuccess;

        return $html;

    }

    protected function getLabel(){
        return '';
    }
}


