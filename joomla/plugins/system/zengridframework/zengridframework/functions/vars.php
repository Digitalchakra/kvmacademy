<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

defined('_JEXEC') or die();

/***********************************************************************************************************************
 *
 * Check that were running PHP 5.2 or newer Thanks to the Simplex framework for the inspiration.
 *
 **********************************************************************************************************************/

version_compare(PHP_VERSION, '5.0', '<') and exit('<div style="font-size:12px;font-family: helvetica neue, arial, sans serif;width:600px;margin:0 auto;background: #f9f9f9;border:1px solid #ddd ;margin-top:100px;padding:40px;line-height:2em"><h3>The Zen Grid Framework requires PHP 5.0 or newer.</h3><p>This error means that your server is using php v4 while the Zen Grid Framework needs php5 to function properly. Often changing to php5 is a matter of adding a rule to the htaccess file on your site but it is best to ask your host for help in determining the best way to use php on your server.</p></div>');


/***********************************************************************************************************************
 *
 * Joomla variables and globals
 *
 **********************************************************************************************************************/

// Paths
$doc = JFactory::getDocument();
$app = JFactory::getApplication();
$zgf = ZenGrid::getInstance();
$base = $this->baseurl;
$templatePath = JURI::base() . 'templates/' . $zgf->getTemplateName();
$frameworkMedia = JURI::base() . 'media/zengridframework';
$themeCSSPath = JPATH_ROOT."/templates/$this->template/css/";

// Imports
jimport('joomla.filesystem.file');

// 1.5,2.5,3.0
$isOnward = (substr(JVERSION, 0, 3) >= '1.6');
$isPresent = (substr(JVERSION, 0, 3) == '1.5');
$isThree = (substr(JVERSION, 0, 3) >= '3.0');


/***********************************************************************************************************************
 *
 * Joomla 1.5 and 1.7 Parameters
 *
 **********************************************************************************************************************/
if($isOnward) {
	jimport( 'joomla.environment.request' );
	$Itemid = JRequest::getInt('Itemid');
	$db = JFactory::getDbo();
	$query = $db->getQuery(true);
	$query->select('t.params, t.template');
	$query->from('#__template_styles as t');
	$query->from('#__menu as m');
	$query->where('m.id = '.$Itemid);
	$query->where('m.template_style_id = t.id');
	$db->setQuery($query);
	$result = $db->loadObject();

	if($result) {
		$this->params = new JRegistry($result->params);
		$zen = json_decode($result->params);
	//	print_r($zen);
		//echo $zen->hilite;

	} else {
		$query = "
		  SELECT ".$db->nameQuote('params')."
		    FROM ".$db->nameQuote('#__template_styles')."
		    WHERE ".$db->nameQuote('template')." = ".$db->quote(''.$this->template.'')." and ".$db->nameQuote('home')." = ".$db->quote(1).";;
		  ";
		$db->setQuery($query);
		$zen = json_decode($db->loadResult());
	//	print_r($zen);
		//echo $zen->hilite;
	}
}
else {
	if($isPresent) {

		// Get params.ini relative to the current file location (use your own relative path here)
		$paramsFile = JPATH_THEMES .'/'.  $zgf->getTemplateName() . '/params.ini';

		// Only continue if the file exists
		if(file_exists($paramsFile)) {

 			// Get contents from params.ini file
 			$hash = md5($paramsFile . filemtime($paramsFile));

 			// Check for a cached double quoted file
 			$cachedFile = JPATH_SITE . '/cache/zengridframework/' . $hash . '.ini';
 			if (!JFile::exists($cachedFile))
 			{
 				// Create a new params file with double quoted values, fixing non literal chars
		    	$iniString = file_get_contents($paramsFile);
		    	$iniQuoted = preg_replace('/=(.*)\\n/', "=\"$1\"\n", addcslashes($iniString, '"'));
		    	JFile::write($cachedFile, $iniQuoted);
 			}

		    $zen = parse_ini_file($cachedFile);
			$zen = (object)$zen;
		}
	}
}

// Restate some variables here for pre 2.4 themes to reduce work for updates
if(!isset($closePanel)) {
	$zen->closePanel = false;
}


/***********************************************************************************************************************
 *
 *  A Loop through the positions to create some variables that we can use later.
 *
 **********************************************************************************************************************/

	// Derives module positions
	$manifest = $zgf->getTemplateManifest();
	$xmlPositions = json_decode(json_encode($manifest->positions));
	$positions = $xmlPositions->position;

	foreach ($positions as $position) {
		if(isset($zen->{($position.'Width')})) {
			${$position.'Cols'} = $zen->{($position.'Width')};
		}
		${$position.'class'} = "";
		${$position.'pub'} = $this->countModules($position);
	}



/***********************************************************************************************************************
 *
 *  Code to test whether to print a row
 *
 **********************************************************************************************************************/

	if ($zen->logoPosition == "above") {
		$header = ($this->countModules('header2')?1:0)+ ($this->countModules('header3')?1:0)+ ($this->countModules('header4'));
	}
	else  {
		if (($zen->socialiconsposition == "header" && $zen->socialicons)){
			$header = ($this->countModules('header1')?1:0) + ($this->countModules('header2')?1:0)+ ($this->countModules('header3')?1:0)+ 1;
		}
		else {
			$header = ($this->countModules('header1')?1:0) + ($this->countModules('header2')?1:0)+ ($this->countModules('header3')?1:0)+ ($this->countModules('header4'));
		}
	}


	if (($zen->socialiconsposition == "grid1" && $zen->socialicons)){
		$grid1 = ($this->countModules('grid1')?1:0)+ ($this->countModules('grid2')?1:0)+ ($this->countModules('grid3')?1:0)+ 1;
	}
	else {
		$grid1 = ($this->countModules('grid1')?1:0)+ ($this->countModules('grid2')?1:0)+ ($this->countModules('grid3')?1:0)+ ($this->countModules('grid4')?1:0);
	}

	$grid2 = ($this->countModules('grid5')?1:0)+ ($this->countModules('grid6')?1:0)+ ($this->countModules('grid7')?1:0)+ ($this->countModules('grid8')?1:0);
	$grid3 = ($this->countModules('grid9')?1:0)+ ($this->countModules('grid10')?1:0)+ ($this->countModules('grid11')?1:0)+ ($this->countModules('grid12')?1:0);
	$grid4 = ($this->countModules('grid13')?1:0)+ ($this->countModules('grid14')?1:0)+ ($this->countModules('grid15')?1:0)+ ($this->countModules('grid16')?1:0);
	$grid5 = ($this->countModules('grid17')?1:0) + ($this->countModules('grid18')?1:0) + ($this->countModules('grid19')?1:0) + ($this->countModules('grid20')?1:0);

	if (($zen->socialiconsposition == "grid6" && $zen->socialicons)){
		$grid6 = ($this->countModules('grid21')?1:0)+ ($this->countModules('grid22')?1:0)+ ($this->countModules('grid23')?1:0)+ 1;
	}
	else {
		$grid6 = ($this->countModules('grid21')?1:0)+ ($this->countModules('grid22')?1:0)+ ($this->countModules('grid23')?1:0)+ ($this->countModules('grid24')?1:0);
	}
	if (($zen->socialiconsposition == "top" && $zen->socialicons)){
		$top = ($this->countModules('top1')?1:0)+ ($this->countModules('top2')?1:0)+ ($this->countModules('top3')?1:0)+ 1;
	}
	else {
		$top = ($this->countModules('top1')?1:0)+ ($this->countModules('top2')?1:0)+ ($this->countModules('top3')?1:0)+ ($this->countModules('top4')?1:0);
	}

	if (($zen->socialiconsposition == "bottom" && $zen->socialicons)){
		$bottom = ($this->countModules('bottom1')?1:0)+ ($this->countModules('bottom2')?1:0)+ ($this->countModules('bottom3')?1:0)+ ($this->countModules('bottom4')?1:0)+ ($this->countModules('bottom5')?1:0)+ 1;
	}
	else {
		$bottom = ($this->countModules('bottom1')?1:0)+ ($this->countModules('bottom2')?1:0)+ ($this->countModules('bottom3')?1:0)+ ($this->countModules('bottom4')?1:0)+ ($this->countModules('bottom5')?1:0)+ ($this->countModules('bottom6')?1:0);}

	$center = ($this->countModules('center')?1:0);
	$left = ($this->countModules('left')?1:0) + ($this->countModules('left-a')?1:0) + ($this->countModules('left-b')?1:0) + ($this->countModules('left-c')?1:0) + ($this->countModules('left-d')?1:0);
	$right = ($this->countModules('right')?1:0) + ($this->countModules('right-a')?1:0) + ($this->countModules('right-b')?1:0) + ($this->countModules('right-c')?1:0) + + ($this->countModules('right-d')?1:0);
	$slides = ($this->countModules('slide1')?1:0)+ ($this->countModules('slide2')?1:0)+ ($this->countModules('slide3')?1:0)+ ($this->countModules('slide4')?1:0);
	$advert1 = ($this->countModules('advert1')?1:0)+ ($this->countModules('advert2')?1:0)+ ($this->countModules('advert3')?1:0);
	$advert2 = ($this->countModules('advert4')?1:0)+ ($this->countModules('advert5')?1:0)+ ($this->countModules('advert6')?1:0);
	$panel = ($this->countModules('panel1')?1:0)+ ($this->countModules('panel2')?1:0)+ ($this->countModules('panel3')?1:0)+ ($this->countModules('panel4')?1:0);
	$footer = ($this->countModules('footer')?1:0);
	$menuCount= ($this->countModules('menu')?1:0);
	$banner= ($this->countModules('banner')?1:0);
	$tabs = ($this->countModules('tab1')?1:0)+ ($this->countModules('tab2')?1:0)+ ($this->countModules('tab3')?1:0)+ ($this->countModules('tab4')?1:0);
	$panelWidths = ($this->countModules('panel1')?1:0)+ ($this->countModules('panel2')?1:0)+ ($this->countModules('panel3')?1:0)+ ($this->countModules('panel4')?1:0);



// ------------------------------------------------------------------------
// Assigns a class of .zenlast to last module in a row
//


	if (($grid3pub) && ($grid4pub == 0 && !($zen->socialiconsposition == "grid1" && $zen->socialicons))) {$grid3class = "zenlast";}
	if (($grid3pub == 0 && $grid4pub == 0  && !($zen->socialiconsposition == "grid1" && $zen->socialicons))) {$grid2class = "zenlast";}

	if (($grid7pub) && ($grid8pub == 0)) {$grid7class = "zenlast";}
	if (($grid7pub == 0 && $grid8pub == 0)) {$grid6class = "zenlast";}

	if (($grid11pub) && ($grid12pub == 0)) {$grid11class = "zenlast";}
	if (($grid11pub == 0 && $grid12pub == 0)) {$grid10class = "zenlast";}

	if (($grid15pub) && ($grid16pub == 0)) {$grid15class = "zenlast";}
	if (($grid15pub == 0 && $grid16pub == 0)) {$grid14class = "zenlast";}

	if (($grid19pub) && ($grid20pub == 0)) {$grid19class = "zenlast";}
	if (($grid19pub == 0 && $grid20pub == 0)) {$grid18class = "zenlast";}

	if (($grid23pub) && ($grid24pub == 0 && !($zen->socialiconsposition == "grid6" && $zen->socialicons))) {$grid23class = "zenlast";}
	if (($grid23pub == 0 && $grid24pub == 0 && !($zen->socialiconsposition == "grid6" && $zen->socialicons))) {$grid22class = "zenlast";}

	if (($header3pub) && ($header4pub == 0 && !($zen->socialiconsposition == "header" && $zen->socialicons))) {$header3class = "zenlast";}
	if (($header3pub == 0 && $header4pub == 0 && !($zen->socialiconsposition == "header" && $zen->socialicons))) {$header2class = "zenlast";}

	if (($top3pub) && ($top4pub == 0 && !($zen->socialiconsposition == "top" && $zen->socialicons))) {$top3class = "zenlast";}
	if (($top3pub == 0 && $top4pub == 0 && !($zen->socialiconsposition == "top" && $zen->socialicons))){$top2class = "zenlast";}

	if (($advert2pub) && ($advert3pub == 0)) {$advert2class = "zenlast";}
	if (($advert5pub) && ($advert6pub == 0)) {$advert5class = "zenlast";}

	if (($panel3pub) && ($panel4pub == 0)) {$panel3class = "zenlast";}
	if (($panel3pub == 0 && $panel4pub == 0)) {$panel2class = "zenlast";}

	if (($tab3pub) && ($tab4pub == 0)) {$tab3class = "zenlast";}
	if (($tab3pub == 0 && $tab4pub == 0)) {$tab2class = "zenlast";}


	if (($bottom3pub == 0) && ($bottom4pub == 0) && ($bottom5pub == 0) && ($bottom6pub == 0) && !($zen->socialiconsposition == "bottom" && $zen->socialicons)) {$bottom2class = "zenlast";}
	if (($bottom4pub == 0) && ($bottom5pub == 0) && ($bottom6pub == 0) && !($zen->socialiconsposition == "bottom" && $zen->socialicons)) {$bottom3class = "zenlast";}
	if (($bottom5pub == 0) && ($bottom6pub == 0) && !($zen->socialiconsposition == "bottom" && $zen->socialicons)) {$bottom4class = "zenlast";}
	if (($bottom6pub == 0) && !($zen->socialiconsposition == "bottom" && $zen->socialicons)) {$bottom5class = "zenlast";}


/***********************************************************************************************************************
 *
 * Controls the file overrides and tests whether to use the override file or not
 * Set to false unless found and enabled
 *
 **********************************************************************************************************************/

$openFile = false;
$topFile = false;
$headerFile = false;
$navFile = false;
$bannerFile = false;
$tabFile = false;
$grid1File = false;
$grid2File = false;
$grid3File = false;
$frontpageFile = false;
$mainFile = false;
$grid4File = false;
$grid5File = false;
$grid6File = false;
$bottomFile = false;
$panelFile = false;
$footerFile = false;
$closeFile = false;
$logoOverride = false;

// Override files
$overrides = array('openContainer','top','header','nav','banner','jbtabs','grid1','grid2','grid3','grid4','grid5','grid6','frontpage','bottom','footer','closeContainer','logo','panel','main');

// Check for the openContainer file
foreach($overrides as $row) {
	if (file_exists(JPATH_ROOT."/templates/$this->template/layout/$row.php") && $zen->openContainer)
	{
		${$row.'File'} = "templates/$this->template/layout/$row.php";

	}
}



/***********************************************************************************************************************
 *
 * Determines equal columns calculations
 *
 **********************************************************************************************************************/
$cols = 12;

$numbers=array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "sixteen", "sixteen");

if (!($zen->logoPosition == "above")) {
	if ($header!=0 && $zen->headerEqual || $zen->allEqual && $header!=0 && $zen->headerEqual || $header!=0 && $zen->headerEqual || $zen->allEqual && $header!=0) {
		$headerModules = $cols/$header;
		$header1Cols = $header2Cols = $header3Cols = $header4Cols = $numbers[$headerModules];
	}
}
else {
	if ($header!=0 && $zen->headerEqual || $zen->allEqual && $header!=0){
		$headerModules = $cols/($header+1);
		$logoCols = $header2Cols = $header3Cols = $header4Cols = $numbers[$headerModules];
	}
}

if ($top!=0 && $zen->topEqual || $top!=0 && $zen->allEqual) {
$topModules = $cols/$top;
$top1Cols = $top2Cols = $top3Cols = $top4Cols = $numbers[$topModules];
}

if ($bottom!=0 && $zen->bottomEqual || $bottom!=0 && $zen->allEqual) {
$bottomModules = $cols/$bottom;
$bottom1Cols = $bottom2Cols = $bottom3Cols = $bottom4Cols = $bottom5Cols  = $bottom6Cols = $numbers[$bottomModules];
}

if ($grid1!=0 && $zen->grid1Equal || $grid1!=0 && $zen->allEqual) {
	$grid1Modules = $cols/$grid1;
	$grid1Cols = $grid2Cols = $grid3Cols = $grid4Cols = $numbers[$grid1Modules];
}

if ($grid2!=0 && $zen->grid2Equal || $grid2!=0 && $zen->allEqual) {
	$grid2Modules = $cols/$grid2;
	$grid5Cols = $grid6Cols = $grid7Cols = $grid8Cols = $numbers[$grid2Modules];
}


if ($grid3!=0 && $zen->grid3Equal || $grid3!=0 && $zen->allEqual) {
	$grid3Modules = $cols/$grid3;
	$grid9Cols = $grid10Cols = $grid11Cols = $grid12Cols = $numbers[$grid3Modules];
}

if ($grid4!=0 && $zen->grid4Equal || $grid4!=0 && $zen->allEqual) {
	$grid4Modules = $cols/$grid4;
	$grid13Cols = $grid14Cols = $grid15Cols = $grid16Cols = $numbers[$grid4Modules];
}

if ($grid5!=0 && $zen->grid5Equal || $grid5!=0 && $zen->allEqual) {
	$grid5Modules = $cols/$grid5;
	$grid17Cols = $grid18Cols = $grid19Cols = $grid20Cols = $numbers[$grid5Modules];
}

if ($grid6!=0 && $zen->grid6Equal || $grid6!=0 && $zen->allEqual) {
	$grid6Modules = $cols/$grid6;
	$grid21Cols = $grid22Cols = $grid23Cols = $grid24Cols = $numbers[$grid6Modules];
}

if ($panel!=0 && $zen->allEqual) {
	$panelModules = $cols/$panel;
	$panel1Cols = $panel2Cols = $panel3Cols = $panel4Cols = $numbers[$panelModules];
}



/***********************************************************************************************************************
 *
 * Mainwidth Logic
 *
 **********************************************************************************************************************/

if ($left && !$right && !$center) { $mainWidth = 'twoL';}
if($left && $right && !$center) { $mainWidth = 'threeLR';}
elseif (!$left && $right && !$center) { $mainWidth = 'twoR';}
elseif (!$left && !$right && !$center) { $mainWidth = 'one';}
elseif (!$left && !$right && $center) { $mainWidth = 'one';}
elseif ($left && $right && $center) { $mainWidth = 'fourLRC';}
elseif ($left && !$right && $center) { $mainWidth = 'threeLC';}
elseif (!$left && $right && $center) { $mainWidth = 'threeRC';}

$splitMenuLeft = false;
$splitMenuRight = false;
$splitMenuNav = false;

if($zen->splitMenu) {
$splitMenuTest = $zen->splitMenu;
$splitMenuNav = (($splitMenuTest ? $splitMenuNav : $splitMenuTest) && $zgf->getSplitMenu($splitMenuName, $splitMenuNavStart, $splitMenuNavEnd)); ;
$splitMenuRight = (($splitMenuTest ? $splitMenuRight : $splitMenuTest) && $zgf->getSplitMenu($splitMenuName, $splitMenuRightStart, $splitMenuRightEnd));
$splitMenuLeft = (($splitMenuTest ? $splitMenuLeft : $splitMenuTest) && $zgf->getSplitMenu($splitMenuName, $splitMenuLeftStart, $splitMenuLeftEnd));
}

if ((($splitMenuLeft) || ($this->countModules( 'left' ))) && (!(($splitMenuRight) || ($this->countModules( 'right' )))) && !$center)
{ 	$mainWidth = 'twoL';
	$midColFloat = "float:right";
	$midCols = $zen->midCols2L;
	$leftCols = $zen->leftCols2L;}

elseif ((($splitMenuLeft) || $left ) && (($splitMenuRight) || $right) && !$center)
{ 	$mainWidth = 'threeLR';
	$midColFloat = "float:left";
	$midCols = $zen->midCols3LR;
	$leftCols = $zen->leftCols3LR;
	$rightCols = $zen->rightCols3LR;}

elseif ((!($splitMenuLeft) || $left) && (($splitMenuRight) || $right) && !$center)
{ 	$mainWidth = 'twoR';
	$midColFloat = "float:left";
	$midCols = $zen->midCols2R;
	$rightCols = $zen->rightCols2R;
}

elseif ((!($splitMenuLeft) || !$left) && (!(($splitMenuRight) || $right)) && !$center)
{ 	$mainWidth = 'one';
	$midCols = $numbers[$cols];
	$midColFloat = "float:left";}


elseif ((($splitMenuLeft) || $left) && (($splitMenuRight) || $right) && $center)
{ 	$mainWidth = 'fourLRC';
	$midColFloat = "float:left";
	$midCols = $zen->midCols4LRC;
	$leftCols = $zen->leftCols4LRC;
	$rightCols = $zen->rightCols4LRC;
	$centerCols = $zen->centerCols4LRC;}

elseif ((($splitMenuLeft) || $left) && (!(($splitMenuRight) || $right)) && $center)
{ 	$mainWidth = 'threeLC';
	$midColFloat = "float:right";
	$midCols = $zen->midCols3LC;
	$leftCols = $zen->leftCols3LC;
	$centerCols = $zen->centerCols3LC;}

elseif ((!(($splitMenuLeft) || $left)) && (($splitMenuRight) || $right) && $center)
{ 	$mainWidth = 'threeRC';
	$midColFloat = "float:left";
	$midCols = $zen->midCols3RC;
	$rightCols = $zen->rightCols3RC;
	$centerCols = $zen->centerCols3RC;}


/***********************************************************************************************************************
 *
 * Push and Pull for left and mid columns to get the main content to be sourced ordered.
 *
 **********************************************************************************************************************/
$midColPull ="";
$leftColPush = "";
$centerColPush = "";
$centerColPull = "";


	if ($mainWidth == "threeLR" or $mainWidth == "fourLRC"){
		$midColPull = $leftCols."cols_push";
		$leftColPush = $midCols."cols_pull";
	}


/***********************************************************************************************************************
 *
 * Disable TP=1
 *
 **********************************************************************************************************************/

if ($zen->disableTP) {
JRequest::setVar('tp', 0);
}


/***********************************************************************************************************************
 *
 * Load Template Variables
 *
 **********************************************************************************************************************/

   if (file_exists(JPATH_ROOT."/templates/$this->template/includes/templateVariables.php"))
{
	include_once (JPATH_ROOT."/templates/$this->template/includes/templateVariables.php");
}


/***********************************************************************************************************************
 *
 * Font Logic
 *
 **********************************************************************************************************************/

if ($zen->fonts == "1" or $zen->fonts == "3") {
	include_once (dirname(__FILE__) . '/elements/fonts.php');
	$fontcss ="fonts";
	$fonts = "1";
}


/***********************************************************************************************************************
 *
 * Browser detection for mobile devices
 *
 **********************************************************************************************************************/

	// Default Values
	$iPadpublish ="";
	$iPhonepublish ="";
	$androidpublish ="";
	$topMob = 1;
	$headerMob = 1;
	$bannerMob = 1;
	$logoMob = 1;
	$navMob = 1;
	$tabMob = 1;
	$grid1Mob = 1;
	$grid2Mob = 1;
	$grid3Mob = 1;
	$grid4Mob = 1;
	$grid5Mob = 1;
	$grid6Mob = 1;
	$bottomMob =1;

	// Test for ios devices
	$isiPad = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPad');
	$isiPhone = (bool) strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone');

	// Test for android
	$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
	$isAndroid="";
	if (stripos($ua, 'android') !== false) { $isAndroid = 1;}

	$mobileDetect = $zgf->getParam('mobileDetect');
	$devicearray=($mobileDetect);

		// Check to see if its an array
		if (is_array($devicearray)){
			foreach ($devicearray as $device){
				${$device.'publish'} = 1;
			}
		}

		// If not an array
		else {
			${$zgf->getParam('mobileDetect').'publish'} = $zgf->getParam('mobileDetect');
			${$zgf->getParam('mobileDetect').'publish'} = 1;
		}

			if (($iPhonepublish && $isiPhone) || ($iPadpublish && $isiPad) || ($androidpublish && $isAndroid)) {

				// The following can be used to toggle certain rows off for small screen browsers
				$topMob = $zen->topMob;
				$headerMob = $zen->headerMob;
				$bannerMob = $zen->bannerMob;
				$logoMob = $zen->logoMob;
				$navMob = $zen->navMob;
				$tabMob = $zen->tabMob;
				$grid1Mob = $zen->grid1Mob;
				$grid2Mob = $zen->grid2Mob;
				$grid3Mob = $zen->grid3Mob;
				$grid4Mob = $zen->grid4Mob;
				$grid5Mob = $zen->grid5Mob;
				$grid6Mob = $zen->grid6Mob;
				$bottomMob  = $zen->bottomMob;
			}

	// Test for mobile css files int he template css folder
	if (file_exists(JPATH_ROOT."/templates/$this->template/css/ipad.css") && $isiPad)
	{
		// Load the core theme.css
		$themecss[] = ''.$templatePath.'/css/ipad.css';
	}

	if (file_exists(JPATH_ROOT."/templates/$this->template/css/iphone.css") && $isiPhone)
	{
		// Load the core theme.css
		$themecss[] = ''.$templatePath.'/css/iphone.css';
	}

	if (file_exists(JPATH_ROOT . "/templates/$this->template/css/android.css") && $isAndroid)
	{
		// Load the core theme.css
		$themecss[] = ''.$templatePath.'/css/android.css';
	}



/***********************************************************************************************************************
 *
 * CSS files that get loaded by the framework
 *
 **********************************************************************************************************************/

	// Definitions for css files and compression

	require_once($frameworkPath . '/functions/elements/zenurirewriter.php');

	// If the user has not set a hilite
	if ($zen->hilite == "-1") { $zen->hilite=0;}

	if ($zen->csscompress) { $systemCSSPath = JPATH_ROOT . "/media/zengridframework/css/";}
	else {$systemCSSPath = JURI::base() . "templates/system/css/";}

	$frameworkcss = array(''.$frameworkMedia.'/css/base.css', ''.$frameworkMedia.'/css/grid.css', ''.$frameworkMedia.'/css/type.css', ''.$frameworkMedia.'/css/forms.css');
	if ($zen->superfish) $frameworkcss[] = ''.$frameworkMedia.'/css/superfish.css';
	if ($zen->cookies) $frameworkcss[] = ''.$frameworkMedia.'/css/cookiecuttr.css';
	if ($zen->socialicons)	$frameworkcss[] = ''.$frameworkMedia.'/css/social.css';
	if ($zgf->isBrowser('ie6')) { $frameworkcss[] = ''.$frameworkMedia.'/css/grid-ie6.css';}
	if ($fonts == "1" or $fonts == "3") $frameworkcss[] = ''.$frameworkMedia.'/css/fonts.css';


	// Virtuemart test
	if (!isset($zen->virtuemart))
	{
		$zen->virtuemart = 0;
	}

	if (file_exists(JPATH_ROOT.'/templates/'.$this->template.'/css/virtuemart.css')) {
		if ($zen->virtuemart) $frameworkcss[] = ''.$templatePath.'/css/virtuemart.css';
	}
	else {
		if ($zen->virtuemart) $frameworkcss[] = ''.$frameworkMedia.'/css/virtuemart.css';
	}


	if(($zen->fontStackLogo || $zen->fontStackBody || $zen->fontStackHeadings || $zen->fontStackNav) == "League+Gothic" ) $frameworkcss[] = ''.$frameworkMedia.'/css/leagueGothic.css';

	// Code to allow users to uipload scripts to templates/yourtemplate/user folder to have it automatically included
	$path= "templates/$this->template/user";
	if (JFolder::exists($path)) {
		$usercssfiles = JFolder::files($path, 'css', false, true);
		$usercssfiles = str_replace('\\', "/", $usercssfiles);
		$usercssfilesresult = count($usercssfiles);
	}
	else {
		$usercssfiles = array();
		$usercssfilesresult = 0;
	}

	// Combine the core framework and theme.css into an array
	$mergecss = array_merge($frameworkcss, $themecss, $usercssfiles);

	if (!$zen->csscompress) {
		foreach ($mergecss as $cssfile) {
			$doc->addStyleSheet($cssfile, 'text/css', 'screen');
		}
	}
	else {
		$md5sum = '';
		$outfile = '';
		foreach ($mergecss as $cssfile) {
			$md5sum .= md5($cssfile);
		}

		$cache_time ="";
		// Setting up the file name and path to the file
		$path = "cache/zengridframework/css";
		$cache_filename = "css-".md5($md5sum).".php";
		$cache_fullpath = $path . '/' . $cache_filename;
		$cache_fullpath = str_replace('\\', "/", $cache_fullpath);

		// Grab the cache time from the template parameters
		$cache_time = '80000';

		if (JFile::exists($cache_fullpath)) {
			$diff = (time()-filectime($cache_fullpath));
		} else {
			$diff = $cache_time+1;
		}
		if ($diff > $cache_time)
			{
				$outfile='<?php
				ob_start ("ob_gzhandler");
				ob_start("compress");
				header("Content-type: text/css;charset: UTF-8");
				header("Cache-Control: must-revalidate");
				$offset = 1000000 * 60 ;
				$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
				header($ExpStr);

				function compress($buffer) {
					$buffer = preg_replace("!/\*[^*]*\*+([^/][^*]*\*+)*/!", "", $buffer);
					$buffer = str_replace(array("\r\n", "\r", "\n", "\t", "  ", "    ", "    "), "", $buffer);
					$buffer = str_replace("{ ", "{", $buffer);
					$buffer = str_replace(" }", "}", $buffer);
					$buffer = str_replace("; ", ";", $buffer);
					$buffer = str_replace(", ", ", ", $buffer);
					$buffer = str_replace(" {", "{", $buffer);
					$buffer = str_replace("} ", "}", $buffer);
					$buffer = str_replace(": ", ":", $buffer);
					$buffer = str_replace(" , ", ", ", $buffer);
					$buffer = str_replace(" ;", ";", $buffer);
				return $buffer;
				}
				?>';

			foreach ($frameworkcss as $cssfile)
			{
				// We nominate the template/system pathj here since the framework doesnt have any images to load
				$css = ZenUriRewriter::rewrite(file_get_contents($cssfile), $systemCSSPath);
				$outfile .= $css;
			}

			foreach ($themecss as $cssfile)
			{
				$css = ZenUriRewriter::rewrite(file_get_contents($cssfile), $themeCSSPath);
				$outfile .= $css;
			}

			if ($usercssfilesresult > 0) {
				foreach ($usercssfiles as $cssfile)
				{
					$css = ZenUriRewriter::rewrite(file_get_contents($cssfile), $themeCSSPath);
					$outfile .= $css;
				}
			}
			JFile::write($cache_fullpath, $outfile);
		}
		$doc->addStyleSheet($cache_fullpath, 'text/css', 'screen');
	};

	// Print css
	if (file_exists(JPATH_ROOT.'/templates/'.$this->template.'/css/print.css')) {
		$doc->addStyleSheet('templates/'.$this->template.'/css/print.css', 'text/css', 'print');
	}
	else {
		$doc->addStyleSheet('media/zengridframework/css/print.css', 'text/css', 'print');
	}


/***********************************************************************************************************************
 *
 * Style Declarations
 *
 **********************************************************************************************************************/
	$css_code ="";
	$containerOffset ="";
	$frontWidth ="";

	// In some cases we might want to apply a unique width to the front page of a site
	if (isset($zen->frontpageWidth)) {
		$frontWidth = "body.frontpage .container, body.featured .container {width: $zen->frontpageWidth;max-width: $zen->frontpageWidth}";
	} else {
		$frontWidth = "";
	}

	// Logic for the alignment of the site
	if ($zen->containerPosition == "left") {$containerOffset = "margin: 0 0 0 $zen->containerMargin";}
	if ($zen->containerPosition == "right") {$containerOffset = "margin: 0 $zen->containerMargin 0 0";}
	if ($zen->containerPosition == "center") {$containerOffset = "";}

	if ($zen->layoutType == "fixed" or $zen->layoutType == "fluid") {
		$css_code .= "body {font-size: $zen->fontSize} .container {width: $zen->tWidth;$containerOffset} $frontWidth";
	}
	elseif ($zen->layoutType="1140") {
		$css_code .= "body {font-size: $zen->fontSize} .container {width: 100%;	max-width: 1140px;} $frontWidth";
	}

	if ($zen->overwriteCSS) {
		if (($zen->extraCSS) !== "")  		{$css_code .= ''.$zen->extraCSS.'';}
		if (($zen->firstcolorelement) !== "") {$css_code .= ''.$zen->firstcolorelement.' {'.$zen->firstcolorAtt.':#'.$zen->firstcolor.'}';}
		if (($zen->secondcolorelement) !== ""){$css_code .= ''.$zen->secondcolorelement.'{'.$zen->secondcolorAtt.':#'.$zen->secondcolor.'}';}
		if (($zen->thirdcolorelement) !== "") {$css_code .= ''.$zen->thirdcolorelement.'{'.$zen->thirdcolorAtt.':#'.$zen->thirdcolor.'}';}
		if (($zen->fourthcolorelement) !== ""){$css_code .= ''.$zen->fourthcolorelement.'{'.$zen->fourthcolorAtt.':#'.$zen->fourthcolor.'}';}
		if (($zen->fifthcolorelement) !== "") {$css_code .= ''.$zen->fifthcolorelement.'{'.$zen->fifthcolorAtt.':#'.$zen->fifthcolor.'}';}
		if (($zen->sixthcolourelement) !== "") {$css_code .= ''.$zen->sixthcolourelement.'{'.$zen->sixthcolorAtt.':#'.$zen->sixthcolor.'}';}
	}

	if ($zen->socialicons && $zen->socialfonticons) {
		$css_code .= '#socialicons i {font-size: '.$zen->iconsize.';color:#'.$zen->iconcolor.';'.$zen->iconcss.'}';

		if (isset($zen->iconcssmedia)) {
			$css_code .='@media only screen and (max-width:'.$zen->iconcssbreakpoint.') { '.$zen->iconcssmedia.'}}';
		}
	}

	if ($zen->logoColour !== "") 	{$css_code .= '	#logo '.$zen->logoClass.' a{color:#'.$zen->logoColour.'}';}
	$css_code .= '#tagline span{top: '.$zen->taglineTop.';left:'.$zen->taglineLeft.';'.$zen->taglineCSS.'}';
	$doc->addStyleDeclaration($css_code);


/***********************************************************************************************************************
 *
 * Browser Specific Files
 *
 **********************************************************************************************************************/
	$ie7CSS = "";
	$ie6CSS = "";
	$ie8CSS = "";
	$ie9CSS = "";
	$extraJS = "";
	$customCSS ="";
	$loadCustom ="";
	$iosCSS ="";


	// Check for ie9 css override
	if (file_exists(JPATH_ROOT."/templates/$this->template/css/ie9.css"))
	{
		$ie9CSS = "1";
	}

	// Check for ie7 css override
	if (file_exists(JPATH_ROOT."/templates/$this->template/css/ie8.css"))
	{
		$ie8CSS = "1";
	}


	// Check for ie7 css override
	if (file_exists(JPATH_ROOT."/templates/$this->template/css/ie7.css"))
	{
		$ie7CSS = "1";
	}

	// Check for ie6 css override
	if (file_exists(JPATH_ROOT."/templates/$this->template/css/ie6.css"))
	{
		$ie6CSS = "1";
	}

	if ($zgf->isBrowser('ie9') && $ie9CSS) {
		$doc->addCustomTag('<link href="'.$this->baseurl.'/templates/'.$this->template.'/css/ie9.css" rel="stylesheet" type="text/css" media="screen" />');
	}

	if ($zgf->isBrowser('ie8') && $ie8CSS) {
		$doc->addCustomTag('<link href="'.$this->baseurl.'/templates/'.$this->template.'/css/ie8.css" rel="stylesheet" type="text/css" media="screen" />');
		$ie8_code = 'img {max-width:none}';
		$doc->addStyleDeclaration($ie8_code);
	}

	if ($zgf->isBrowser('ie7') && $ie7CSS) {
		$doc->addCustomTag('<link href="'.$this->baseurl.'/templates/'.$this->template.'/css/ie7.css" rel="stylesheet" type="text/css" media="screen" />');
	}

	if ($zgf->isBrowser('ie6') && $ie6CSS) {
		$doc->addCustomTag('<link href="'.$this->baseurl.'/templates/'.$this->template.'/css/ie6.css" rel="stylesheet" type="text/css" media="screen" />');
	}

	if ($zgf->isBrowser('ie6') && $pngfix) {
	$doc->addCustomTag('<script src="'.$this->baseurl.'/templates/zengridframework/js/tools/DD_belatedPNG0.0.8a-min.js"></script>
		<script>
			DD_belatedPNG.fix('.$pngfixrules.');
		</script>');
	}

	//Load Responsive Design Script fot IE 6, 7 and 8
	if ($zgf->isBrowser('ie6') && $zgf->isBrowser('ie7') && $zgf->isBrowser('ie8')) {
		if ($zen->mediqueries == 1 && $zen->jQueryVersion != 'none') {
			$doc->addScript($frameworkMedia.'/js/tools/respond.min.js"');
		}
	}


/***********************************************************************************************************************
 *
 * Typekit script inclusion
 *
 **********************************************************************************************************************/
	if ($zen->typekit && $fonts == "2" or $zen->typekit && $fonts == "3") {
		$doc->addScript('http://use.typekit.com/'.$zen->typekitId.'.js');
	}



/***********************************************************************************************************************
 *
 * Body classes - used to insert hooks into the body tag so we can get some more styling
 *
 **********************************************************************************************************************/
		$menus     = JFactory::getApplication()->getMenu();
		$menu      = $menus->getActive();
		$pageclass = "";

		if (is_object($menu)) {
			if ($isPresent) {
				$params = new JParameter($menu->params);
			}
			else {
				$params = new JRegistry($menu->params);
			}

			$pageclass = $params->get('pageclass_sfx');
		}


		// Detecting Active Variables
		$option = JRequest::getCmd('option', '');
		$view = JRequest::getCmd('view', '');
		$layout = JRequest::getCmd('layout', '');
		$task = JRequest::getCmd('task', '');
		$itemid = JRequest::getCmd('Itemid', '');
		$catid = JRequest::getInt('catid');

		$bodyClass = "";

		if ($fonts == '1' or $fonts == '3' or $pageclass !='') {
			if ($zen->fontStackBody[1] !== "-") $bodyClass .="$zen->fontStackBody";
		}
		if ($pageclass !='') {
			$bodyClass .=" $pageclass";
		}

		if ($zen->bodyclassOption) {
			$bodyClass .=" $option";
		}

		if ($zen->bodyclassView) {
			if($view =="frontpage") {
				$bodyClass .=" featured";
			}
			else {
				$bodyClass .=" $view";
			}
		}

		if ($zen->bodyclassLayout) {
			$bodyClass .=" $layout";
		}

		if ($zen->bodyclassTask) {
			$bodyClass .=" $task";
		}

		if ($zen->bodyclassItem) {
			$bodyClass .=" itemid$itemid";
		}

		if ($zen->bodyclassMainWidth) {
			$bodyClass .=" $mainWidth";
		}

		if ($isPresent) {
			$bodyClass .=" present";
		}

		else {
			$bodyClass .=" onward";
		}

		$bodyClass .= ' '.$zgf->getBrowser();
		$bodyClass .=" $zen->containerPosition";


/***********************************************************************************************************************
 *
 * Superfish, TypeKit and Extra Script Declarations
 *
 **********************************************************************************************************************/

	$zen->sfType="";

	// Logic for the superfish animation
	if ($zen->sfEffect == "1") {
		$sfType = '{height:"show"}';
	}
	else if ($zen->sfEffect == "2") {
		$sfType = '{width:"show"}';
	}
	else if ($zen->sfEffect == "3") {
		$sfType = '{opacity:"show"}';
	}
	else if ($zen->sfEffect == "4") {
		$sfType = '{width:"show", opacity:"show"}';
	}
	else if ($zen->sfEffect == "5") {
		$sfType = '{height:"show", opacity:"show"}';
	}
	else if ($zen->sfEffect == "6") {
		$sfType = '{height:"show", width:"show", opacity:"show"}';
	}
	else if ($zen->sfEffect == "7") {
		$sfType = '{height:"show", width:"show"}';
	}

	$zengridJS ="";
	if ($zen->superfish || $zen->lazyload) {
	$zengridJS .= 'jQuery(document).ready(function(){';

	if ($zen->superfish) {
		$zengridJS .= "		jQuery('.moduletable-superfish ul, #nav ul')\n";
		$zengridJS .= "			.supersubs({ \n";
		$zengridJS .= "       		minWidth:    '$zen->sfMinWidth',   // minimum width of sub-menus in em units \n";
		$zengridJS .= "    			maxWidth:    '$zen->sfMaxWidth',   // maximum width of sub-menus in em units \n";
		$zengridJS .= "				disableHI:   true,  // set to true to disable hoverIntent detection\n";
		$zengridJS .= "				extraWidth:  1     // \n";
		$zengridJS .= "			})\n";
		$zengridJS .= "			.superfish({\n";
		$zengridJS .= "				animation : {$sfType}, \n";
		$zengridJS .= "				speed:       '$zen->sfSpeed', \n";
		$zengridJS .= "				delay : $zen->sfDelay \n";
		$zengridJS .= "			});	\n";
		$zengridJS .= "\n";
	}

	if ($zen->panelMenu) {
		$zengridJS .= "jQuery('.moduletable-panelmenu').zenaccordion({";
			if($zen->accordionFirst) {
				$zengridJS .= "openfirst: true,";
			}
			else {
				$zengridJS .= "openfirst: false,";
			}
			if($zen->accordionShowActive) {
				$zengridJS .= "showactive: true,";
			}
			if($zen->panelMenuType == "2") {
				$zengridJS .= "submenu: 'show'";
			}

		$zengridJS .= "});";
	}
		$zengridJS .= "		});\n";
	}


	if ($zen->typekit && $fonts == "2" or $zen->typekit && $fonts == "3") {
		$zengridJS .= "try{Typekit.load();}catch(e){}";
	}

	if ($zen->extraScripts != "") {
		$zengridJS .= $zen->extraScripts;
	}

	// Load the Script Declaration
	if (!$zen->bottomScripts) {
		$doc->addScriptDeclaration($zengridJS);
	}


	/***********************************************************************************************************************
	 *
	 * Remove Joomla Metagen
	 *
	 **********************************************************************************************************************/

	if ($zen->removeJgen == '1') {
		$this->setGenerator('');
	}
