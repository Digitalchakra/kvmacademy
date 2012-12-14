<?php
/*------------------------------------------------------------------------
# TZ Carousel Slideshow Module
# ------------------------------------------------------------------------
# author    TemPlaza
# copyright Copyright (C) 2011 templaza.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.templaza.com
# Technical Support:  Forum - http://www.templaza.com/Forum/
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$document	=	&JFactory::getDocument();
$document->addStyleSheet('modules/mod_tz_accordion_slideshow/css/kwick.css');
$display		=	$params->get('display',0);
$mycategory		=	$params->get('mycategory',0);
$k2category		=	$params->get('k2category',0);
$space          =   $params->get('space');
$event          =   $params->get('event');
$duration       =   $params->get('duration');
$stick          =   $params->get('stick');
$isVertical     =   $params->get('vertical');
$effect         =   $params->get('easing');

if($stick   ==1){
    $stic   = 'true';
} else {
    $stic   = 'false';
}
if($isVertical==1){
    $ver    = 'true';
} else {
    $ver    = 'false';
}
if (intval($params->get('loadjquery',1))) {
	$document->addScript('modules/mod_tz_accordion_slideshow/js/jquery-1.6.2.js');
}

$document->addScript('modules/mod_tz_accordion_slideshow/js/jquery.easing.1.3.js');
$document->addScript('modules/mod_tz_accordion_slideshow/js/jquery.kwicks.js');


$tz_search	=	new modTZAccordionHelper($mycategory, $k2category, $display);
$images     =   &$tz_search->getImages();
$root_url   =   parse_url(JURI::base());
$root       =   $root_url ['path']; 
if (!count($images)) {
	return;
}
require(JModuleHelper::getLayoutPath('mod_tz_accordion_slideshow'));
