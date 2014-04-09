<?php
/*------------------------------------------------------------------------

# mod_yo_image_wall.php - YO Image Wall Module

# ------------------------------------------------------------------------

# author    YOphp

# copyright Copyright (C) 2011 yophp.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.yophp.com

# Technical Support:  Forum - http://www.yophp.com/Forum/

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

$document	=	&JFactory::getDocument();
//$document->addStyleSheet('modules/mod_tz_slidegallery/css/style.css');
$document->addStyleSheet('modules/mod_tz_slidegallery/css/gridNavigation.css');
$document->addStyleSheet('http://fonts.googleapis.com/css?family=PT+Sans+Narrow');
$document->addStyleSheet('http://fonts.googleapis.com/css?family=Oswald');

$rows			=	$params->get('rows',2);
$mode			=	$params->get('mode','def');
$speed			=	$params->get('speed','');
$speed			=	$speed ? $speed : "''";
$easing			=	$params->get('easing','easeOutQuad');
$easing			=	$easing ? $easing : "''";
$factor			=	$params->get('factor','');
$factor			=	$factor ? $factor : "''";
$reverse		=	$params->get('reverse',0);
$reverse		=	intval($reverse) ? 'true' : 'false';

$document->addStyleDeclaration("
.tj_container{
	height:".(200*$rows)."px;
}
");
	
if (intval($params->get('loadjquery',1))) {
	$document->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js');
}
if (intval($params->get('noconflict',1))) {
	$document->addScript('modules/mod_tz_slidegallery/js/jQuery.noConflict.js');
}
$document->addScript('modules/mod_tz_slidegallery/js/jquery.easing.1.3.js');
$document->addScript('modules/mod_tz_slidegallery/js/jquery.mousewheel.js');
$document->addScript('modules/mod_tz_slidegallery/js/jquery.gridnav.js');

$document->addScriptDeclaration("
	jQuery(function() {
		jQuery('#tj_container').gridnav({
			rows	: $rows,
			type	: {
				mode		: '$mode', 	// use def | fade | seqfade | updown | sequpdown | showhide | disperse | rows
				speed		: $speed,			// for fade, seqfade, updown, sequpdown, showhide, disperse, rows
				easing		: '$easing',			// for fade, seqfade, updown, sequpdown, showhide, disperse, rows	
				factor		: $factor,			// for seqfade, sequpdown, rows
				reverse		: $reverse			// for sequpdown
			}
		});
	});
");

$TZ_slidegallery	=	new modTZSlideGalleryHelper($params);
$images      = &$TZ_slidegallery->getImages();
if (!count($images)) {
	return;
}

require(JModuleHelper::getLayoutPath('mod_tz_slidegallery'));