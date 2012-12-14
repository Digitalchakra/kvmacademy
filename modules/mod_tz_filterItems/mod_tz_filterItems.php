<?php
/*------------------------------------------------------------------------
    # (TZ Module, TZ Plugin, TZ Component)
    # ------------------------------------------------------------------------
    # author    Sunland .,JSC
    # copyright Copyright (C) 2011 Sunland .,JSC. All Rights Reserved.
    # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
    # Websites: http://www.TemPlaza.com
    # Technical Support:  Forum - http://www.TemPlaza.com/forums/
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access');
   require_once (dirname(__FILE__).DS.'helper.php');
// Include the syndicate functions only once
$choocontent = $params->get('choose');
$limit = $params->get('limit');
$list = modFillterItemsHelper::getItemsCategory($params);

$category  =  $params->get('category_content');
$count = count($category);
if($choocontent==0){
if($count !=1){
$sqlcontent = implode(",", $category);
}
}

$load = $params->get('loadjquery');
$cid = $params->get('category_id', NULL);
if($choocontent ==1){
require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'itemlist.php');
$categories = K2ModelItemlist::getCategoryTree($cid);
$sql = @implode(',', $categories);
}
require(JModuleHelper::getLayoutPath('mod_tz_filterItems'));
