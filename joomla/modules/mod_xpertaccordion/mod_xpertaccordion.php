<?php
/**
 * @package Xpert Accordion
 * @version 1.0
 * @author ThemeXpert http://www.themexpert.com
 * @copyright Copyright (C) 2009 - 2011 ThemeXpert
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */
 
// no direct access
defined('_JEXEC') or die('Restricted accessd');


// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$lists = modXpertAccordionHelper::getLists($params);
$module_id = 'xac'.$module->id;

modXpertAccordionHelper::loadStyles($params,$module_id);
modXpertAccordionHelper::loadScripts($params,$module_id);

if($params->get('content_source') == 'mods') require JModuleHelper::getLayoutPath('mod_xpertaccordion', 'modules');
else require JModuleHelper::getLayoutPath('mod_xpertaccordion', 'default');
