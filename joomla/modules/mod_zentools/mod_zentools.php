<?php
/**
 * @package		Zen Tools
 * @subpackage	Zen Tools
 * @author		Joomla Bamboo - design@joomlabamboo.com
 * @copyright 	Copyright (c) 2012 Joomla Bamboo. All rights reserved.
 * @license		GNU General Public License version 2 or later
 * @version		1.7.2
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once

// Import the file / foldersystem
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

// Sets variables so we can check if framework or library is present
$jblibrary = JPATH_SITE.'/media/plg_jblibrary/helpers/image.php';
$framework = JPATH_SITE . '/media/zengridframework/helpers/image.php';

// Checks to see if framework is installed
if (file_exists($framework)){
	require_once($framework);
	$zgf = 1;
	$library = JURI::base(true).'/media/zengridframework/';
}
// Checks to see if JB Library is installed
elseif (file_exists($jblibrary)){
	require_once($jblibrary);
	$zgf = 0;
	$library = JURI::base(true).'/media/plg_jblibrary/';
}
// Else throw an error to let the user know
else {
	echo '<div style="font-size:12px;font-family: helvetica neue, arial, sans serif;width:600px;margin:0 auto;background: #f9f9f9;border:1px solid #ddd ;margin-top:100px;padding:40px"><h3>Ooops. It looks like JbLibrary plugin or the Zen Grid Framework plugin is not installed!</h3> <br />Please install it and ensure that you have enabled the plugin by navigating to extensions > plugin manager. <br /><br />JB Library is a free Joomla extension that you can download directly from the <a href="http://www.joomlabamboo.com/joomla-extensions/jb-library-plugin-a-free-joomla-jquery-plugin">Joomla Bamboo website</a>.</div>';
	exit;
}

if (substr(JVERSION, 0, 3) >= '1.6') {
	if ($app->getCfg('caching')) {
		$cache = 1;
	}
	else {
		$cache = 0;
	}
}
else {
	// Test to see if cache is enabled
	if ($mainframe->getCfg('caching')) {
		$cache = 1;
	}
	else {
		$cache = 0;
	}
}

// Globals
$document = JFactory::getDocument();

$modbase = JURI::base(true).'/modules/mod_zentools/';

$moduleID = $module->id;

// Parameters
$responsiveimages = $params->get('responsiveimages');
$resizeImage = $params->get('resizeImage',1);
$layout = $params->get('layout', 'content');
$contentSource = $params->get('contentSource', '3');
$overlayGrid = $params->get('overlayGrid', 0);
$overlayCarousel = $params->get('overlayCarousel', 0);

// Helper Files
require_once dirname(__FILE__) . '/includes/zenhelper.php';

//get items from helper
if($contentSource=="1") {
	require_once dirname(__FILE__) . '/includes/zenimagehelper.php';
}
else if ($contentSource=="2") {
	if (substr(JVERSION, 0, 3) >= '1.6') {
		require_once dirname(__FILE__) . '/includes/zenj17contenthelper.php';
	}
	else {
		require_once dirname(__FILE__) . '/includes/zencontenthelper.php';
	}
}
else if ($contentSource=="3") {
	require_once dirname(__FILE__) . '/includes/zenk2helper.php';
}


// Parameters
$scripts = $params->get('scripts',1);
$itemImage = $params->get('itemImage',1);
$itemText = $params->get('itemText',1);
$itemTitle = $params->get('itemTitle',1);

$videosOnly = $params->get('videosOnly',1);
$imagesreplace = $params->get('imagesreplace',0);
$option= $params->get( 'option');

// Fancybox
$fancyOverlayShow = $params->get('fancyOverlayShow','true');
$fancyOverlay = $params->get('fancyOverlay','0.6');
$fancyPadding = str_replace('px', '', $params->get('fancyPadding','10'));

// Grid Variables
if($layout=="accordion") {
	$imagesPerRow = "1";
}
else {
	$imagesPerRow = $params->get( 'imagesPerRow','3');
}

// Category Filter
$categoryFilter = $params->get('categoryFilter');

if($contentSource == 1) {
	$categoryFilter = 0;
}

$zoomClass = 'flickrZoom';
$imageNumber = 0;
$startDiv = 0;

$layout = $params->get('layout',0);
$link = $params->get('link');
$modalTitle = $params->get('modalTitle',0);
$modalText = $params->get('modalText',0);
$modalImage = $params->get('modalImage',0);
$modalWidth = $params->get('modalWidth',0);
$modalHeight = $params->get('modalHeight',0);

if($imagesPerRow == "1") $gridclass = "twelve";
if($imagesPerRow == "2") $gridclass = "six";
if($imagesPerRow == "3") $gridclass = "four";
if($imagesPerRow == "4") $gridclass = "three";
if($imagesPerRow == "5") $gridclass = "5";
if($imagesPerRow == "6") $gridclass = "two";
if($imagesPerRow == "7") $gridclass = "7";
if($imagesPerRow == "8") $gridclass = "8";
if($imagesPerRow == "9") $gridclass = "9";
if($imagesPerRow == "10") $gridclass = "10";
if($imagesPerRow == "11") $gridclass = "11";
if($imagesPerRow == "12") $gridclass = "one";

$firstrow = $params->get('firstrow','date');
$secondrow = $params->get('secondrow','title');
$thirdrow = $params->get('thirdrow','image');
$fourthrow = $params->get('fourthrow','text');
$titleClass = $params->get('titleClass','h2');
$elements = $params->get('useditems');


$border = $params->get('imageBorder');


$image_height = str_replace('px', '', $params->get( 'image_height','20'));
$image_width = str_replace('px', '', $params->get( 'image_width','20'));
$thumb_width = str_replace('px', '', $params->get( 'thumb_width','20'));
$thumb_height = str_replace('px', '', $params->get( 'thumb_height','20'));
$slideTrigger = $params->get('slideshowPaginationType','thumb');
$slideshowTheme = $params->get('slideshowTheme');

$navigator = JBrowser::getInstance();
$browser = $navigator->getBrowser();
$major = $navigator->getMajor();

//include css styles in head
if($scripts) {
	//if(!$zgf) {
		if(!$cache){

			$document->addStyleSheet($modbase.'css/zentools.css');

			if(!$zgf) {
				$document->addStyleSheet($modbase.'css/grid.css');
			}

			if ($link == 1){
				$document->addStyleSheet($modbase.'js/jquery.fancybox/jquery.fancybox-1.3.4.css');
				$zoomClass .= $moduleID;
				$document->addScript($modbase . "js/jquery.fancybox/jquery.fancybox-1.3.4.pack.js");
			}

			if($layout == "pagination" || $slideTrigger =="title") {
				$document->addStyleSheet($modbase.'css/pagination.css');
				$document->addScript($modbase . "js/jPages.js");
			}

			if($layout == "slideshow") {
				$document->addScript($modbase.'js/slideshow/jquery.flexslider-min.js');
				$document->addStyleSheet($modbase.'css/slideshow.css');

				// Fix for IE 8 when image's column doesn't have 12 columns
				if(($browser == 'msie') && ($major == 8))
				{
					$usedItems = $params->get('useditems');

					// Has image
					if (substr_count($usedItems, 'image') > 0)
					{
						$imageColumn = 1;

						// Has more than 1 column
						if (substr_count($usedItems, 'column') > 0)
						{
							// Use more than 1 column, so get image column
							preg_match_all('/image|column([\d])/', $usedItems, $match);

							foreach ($match[1] as $value)
							{
								if (empty($value))
								{
									// image
									break;
								}
								else
								{
									$imageColumn = (int) $value;
								}
							}
						}

						// Apply fix just for column less than 12
						if ($params->get("col{$imageColumn}Width") !== 'twelve')
						{
							$document->addStyleDeclaration('.flexslider .slides img {max-width: none !important;}');
						}

						unset($imageColumn);
					}
					unset($usedItems);
				}
				unset($browser, $major, $navigator);
			}

			if($layout == "masonry") {
				$document->addScript($modbase.'js/masonry/jquery.masonry.js');
				$document->addStyleSheet($modbase.'css/masonry.css');
			}


			if($layout == "accordion") {
				$document->addStyleSheet($modbase.'css/accordion.css');
			}

			if($layout == "carousel") {
				$document->addStyleSheet($modbase.'css/elastislide.css');
				$document->addScript($modbase.'js/carousel/jquery.easing.1.3-min.js');
				$document->addScript($modbase.'js/carousel/jquery.elastislide-min.js');
			}

			if($categoryFilter && ($layout == "grid" or $layout =="list")) {
				$document->addScript($modbase.'js/filter/jquery.isotope.min.js');

				if(($browser == 'msie') && ($major == 8))
				{
					$document->addScript($modbase.'js/filter/jquery.isotope.ie8.min.js');
				}

				$document->addStyleSheet($modbase.'css/masonry.css');
			}

			if($responsiveimages) {
				$document->addScript($modbase.'js/responsive/response.js');
			}
		}
	//}
}

//get items from helper
if($contentSource=="1") {
	$list = ModZentoolsImageHelper::getList($params, $moduleID);
}
else if ($contentSource=="2") {
	$list = ModZentoolsHelper::getList($params, $moduleID);
}
else if ($contentSource=="3") {
	$list = ModZentoolsK2Helper::getList($params, $moduleID);
}


if($layout =="twitter") {
	$count=0;
	require(JModuleHelper::getLayoutPath('mod_zentools','twitter'));
}

else {
		require(JModuleHelper::getLayoutPath('mod_zentools','default'));
}
