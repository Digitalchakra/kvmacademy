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

$doc = JFactory::getDocument();



	/**
	 * Non-google font array
	 *
	 * Zen Grid Framework v1.1
	 *  I'm sure this can be improved but cuts down on code used in 1.1.
	 */

	$nongoogle = array('Cambria, Georgia, Times, Times New Roman, serif',
	'Adobe Caslon Pro, Georgia, Garamond, Times, serif',
	'Courier new, Courier, Andale Mono',
	'Garamond, ‘Times New Roman’, Times, serif',
	'Georgia, Times, ‘Times New Roman’, serif',
	'GillSans, Calibri, Trebuchet, arial sans-serif',
	'Helvetica Neue, Helvetica, Arial, sans-serif',
	'Lucida Grande, Geneva, Helvetica, sans-serif',
	'Palatino, ‘Times New Roman’, serif',
	'Tahoma, Verdana, Geneva',
	'Trebuchet ms, Tahoma, Arial, sans-serif, ',
	'------------------- Standard ---------------------',
	'--------------------- Serif ---------------------',
	'------------------- Sans Serif -------------------',
	'------------------- Handwriting -------------------',
	'------------------- Display -------------------',
	'sans-serif'
	);


	// Sets a default value for the fonstackbody, fontstacknav etc
	$fsb = 1;
	$fsn = 1;
	$fsh = 1;
	$fsc1 = 1;
	$fsc2 = 1;
	$fsc3 = 1;
	$fsl = 1;


	$gfonts = array();

	if (in_array($zen->fontStackBody, $nongoogle)) {
		$fontStackRBody = "";
		$fsb=0;
	} else {
		$gfonts[] = "'$zen->fontStackBody$zen->fontStackBodySub'";
	}

	if (in_array($zen->fontStackNav, $nongoogle)) {
		$fontStackRNav = "";
		$fsn=0;
	} else {
		$gfonts[] = "'$zen->fontStackNav$zen->fontStackNavSub'";
	}

	if (in_array($zen->fontStackHeading, $nongoogle)) {
		$fontStackRHeading = "";
		$fsh = 0;
	} else {
		$gfonts[] = "'$zen->fontStackHeading$zen->fontStackHeadingSub'";
	}

	if (in_array($zen->fontStackCustom1, $nongoogle)) {
		$fontStackRCustom1 = "";
		$fsc1 = 0;
	} else {
		$gfonts[] = "'$zen->fontStackCustom1$zen->fontStackCustom1Sub'";
	}

	if (in_array($zen->fontStackCustom2, $nongoogle)) {
		$fontStackRCustom2 = "";
		$fsc2 = 0;
	} else {
		$gfonts[] = "'$zen->fontStackCustom2$zen->fontStackCustom2Sub'";
	}

	if (in_array($zen->fontStackCustom3, $nongoogle)) {
		$fontStackRCustom3 = "";
		$fsc3 = 0;
	} else {
		$gfonts[] = "'$zen->fontStackCustom3$zen->fontStackCustom3Sub'";
	}

	if (in_array($zen->fontStackLogo, $nongoogle)) {
		$fontStackRLogo = "";
		$fsl = 0;
	} else {
		$gfonts[] = "'$zen->fontStackLogo$zen->fontStackLogoSub'";
	}

	// Remove Duplicates
	$gfonts = array_unique($gfonts);

	// Remove comma from last font
	$lastfont = end($gfonts);

	// Test to load fonts
	$googlefonts = $fsb + $fsn +$fsh + $fsc1 + $fsc2 + $fsc3 + $fsl;


	// Font name clean up for body tag so we dont have , and spaces in the body class.
	if (in_array($zen->fontStackBody, $nongoogle)) {
		$zen->fontStackBody = explode(', ', $zen->fontStackBody);
		$zen->fontStackBody = str_replace(' ', '', ''.$zen->fontStackBody[0].'');
	}


	/**
	* Clean up the font names and make them suitable for css files
	*
	* Zen Grid Framework v2.2
	*
	*/

	$fontCssreplaceBody =  str_replace('+', ' ', ''.$zen->fontStackBody.'');
	$fontCssreplaceNav =  str_replace('+', ' ', ''.$zen->fontStackNav.'');
	$fontCssreplaceHeading =  str_replace('+', ' ', ''.$zen->fontStackHeading.'');

	if ($zen->logoType == "text") {
		$fontCssreplaceLogo =  str_replace('+', ' ', ''.$zen->fontStackLogo.'');
		$fontStackLogo =  str_replace('+', '', ''.$zen->fontStackLogo.'');
	}
	elseif ($zen->logoType == "image") {
		$fontCssreplaceLogo ="";
	}



	// ------------------------------------------------------------------------

	/**
	 * The css rules based on logic above
	 *
	 * Zen Grid Framework v1.1
	 *
	 */
	$zen->fontStackBody[1];
	$fontOutput ="";
	if ($zen->fontStackBody[1] !== "-") $fontOutput .= "body, span.$zen->fontStackBody {font-family: $fontCssreplaceBody }";
	if ($zen->fontStackHeading[1] !== "-")  $fontOutput .=  "h1, h2, h3, h4, h5, h6, .blockquote, .componentheading, .contentheading {font-family:  $fontCssreplaceHeading}";
	if ($zen->fontStackNav[1] !== "-") $fontOutput .= "#nav, .moduletable-superfish, .moduletable-menu, #togglemenu  {font-family: $fontCssreplaceNav}";

	if ($zen->logoType == "text" && $fontStackLogo[1] !== "-") {
		$fontOutput .= "#logo $zen->logoClass a.$zen->fontStackLogo, #logo $zen->logoClass a span.$zen->fontStackLogo  {font-family: $fontCssreplaceLogo;font-size: $zen->logoFontSize}";
	}


	if ($zen->fontStackSelector1 !== "" && $zen->fontStackCustom1[1] !== "-") {
		$zen->fontStackCustom1 = str_replace('+', ' ', ''.$zen->fontStackCustom1.'');
		$fontOutput .= "$zen->fontStackSelector1 {font-family: $zen->fontStackCustom1}";
	}

	if ($zen->fontStackSelector2 !== "" && $zen->fontStackCustom2[1] !== "-") {
		$zen->fontStackCustom2 = str_replace('+', ' ', ''.$zen->fontStackCustom2.'');
		$fontOutput .= "$zen->fontStackSelector2 {font-family: $zen->fontStackCustom2}";
	}
	if ($zen->fontStackSelector3 !== "" && $zen->fontStackCustom3[1] !== "-") {
		$zen->fontOutput .= "$zen->fontStackSelector3 {font-family: $zen->fontStackCustom3}";
		$zen->fontStackCustom3 = str_replace('+', ' ', ''.$zen->fontStackCustom3.'');
	}


	/**
	 * Creates the font.css file
	 *
	 * Zen Grid Framework v1.1
	 *
	 */


	JFile::write(JPATH_ROOT.'/media/zengridframework/css/fonts.css', $fontOutput);
