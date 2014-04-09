<?php
/*------------------------------------------------------------------------
# (TZ Module, TZ Plugin, TZ Component)
# ------------------------------------------------------------------------
# author    TemPlaza
# copyright Copyright (C) 2011 TemPlaza. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.TemPlaza.com
# Technical Support:  Forum - http://www.TemPlaza.com/Forum/
-------------------------------------------------------------------------*/
defined('_JEXEC') or die('Restricted access!');
require_once (dirname(__FILE__).DS.'helper.php');
global $mainframe;
jimport('joomla.filesystem.file');
$realw = JURI::root();

$document = &JFactory::getDocument();
$jsurl = $realw . "modules/mod_tz_piecemaker/js/swfobject.js";
$swfurl = $realw . "modules/mod_tz_piecemaker/js/expressInstall.swf";

$document->addScript($jsurl);

$xmlfile = JPATH_BASE . "/modules/mod_tz_piecemaker/banner/xml/piecemakerXML".$module->id.".xml";
$width = $params->get("width");
$height = $params->get("height");

$shadow = $params->get('shadow');
$swf = ($shadow)?'piecemakerShadow.swf':'piecemakerNoShadow.swf';
if( $params->get('rebuildcache') or !file_exists($xmlfile) ) :

//params
$display		=	$params->get('display',0);
$mycategory		=	$params->get('mycategory',0);
$k2category		=	$params->get('k2category',0);
$zDistance = $params->get("zDistance");
$expand = $params->get("expand");
$innerColor = str_replace('#','',$params->get("innerColor"));
$textBackground = str_replace('#','',$params->get("textBackground"));
$shadowDarkness = $params->get("shadowDarkness");
$textDistance = $params->get("textDistance");
$autoplay = $params->get("autoplay");

$playlist = <<<EOP
<?xml version="1.0" encoding="utf-8"?>
<Piecemaker>
<Contents>

  
EOP;
$tz_search	    =	new modTZpIEHelper($mycategory, $k2category, $display);
$images         =   &$tz_search->getImages();
$title    =   array();
$description    =   array();
$link          =   array();
$image          =   array();
foreach ($images as $img){
    $image[] = $img->image;
    $description[] = $img->intro;
    $title[]        =   $img->title;
    $link[]         =   $img->link;
}
$count = count($image);
    $root_url = parse_url ( JURI::base () );
for( $i = 0 ; $i < $count ; $i++ )
{
    $imgurl =   $root_url ['path']. $image[$i];
    
$playlist .= <<<EOQ

<Image Source="$imgurl" Title="$title[$i]">
    <Text><![CDATA[<h1>$title[$i]</h1><p>$description[$i]</p>]]></Text>
</Image>


EOQ;
}
    $playlist .= '</Contents>';
    $playlist .= <<<EOQ
        <Settings ImageWidth="$width"
         ImageHeight="$height"
         LoaderColor="0x333333"
         InnerSideColor="0x222222"
         SideShadowAlpha="0.7"
         DropShadowAlpha="0.7"
         DropShadowDistance="25"
         DropShadowScale="0.95"
         DropShadowBlurX="70"
         DropShadowBlurY="7"
         MenuDistanceX="20"
         MenuDistanceY="40"
         MenuColor1="0x999999"
         MenuColor2="0x333333"
         MenuColor3="0xffffff"
         ControlSize="80"
         ControlDistance="20"
         ControlColor1="0x222222"
         ControlColor2="0xffffff"
         ControlAlpha="0.7"
         ControlAlphaOver="0.9"
         ControlsX="490" ControlsY="220"
         ControlsAlign="center"
         TooltipHeight="30"
         TooltipColor="0x222222"
         TooltipTextY="5"
         TooltipTextStyle="P-Italic"
         TooltipTextColor="0xffffff"
         TooltipMarginLeft="5"
         TooltipMarginRight="7"
         TooltipTextSharpness="50"
         TooltipTextThickness="-100" InfoWidth="400"
         InfoBackground="0xffffff" InfoBackgroundAlpha="0.95"
         InfoMargin="15" InfoSharpness="0"
         InfoThickness="0" 
         Autoplay="$autoplay"
         FieldOfView="45"/>
EOQ;
    $playlist .= <<<EOQ
        <Transitions>
            <Transition Pieces="9" Time="1.2" Transition="easeInOutBack" Delay="0.1" DepthOffset="300" CubeDistance="30"></Transition>
            <Transition Pieces="15" Time="3" Transition="easeInOutElastic" Delay="0.03" DepthOffset="200" CubeDistance="10"></Transition>
            <Transition Pieces="5" Time="1.3" Transition="easeInOutCubic" Delay="0.1" DepthOffset="500" CubeDistance="50"></Transition>
            <Transition Pieces="9" Time="1.25" Transition="easeInOutBack" Delay="0.1" DepthOffset="900" CubeDistance="5"></Transition>
            <Transition Pieces="1" Time="1" Transition="easeInOutBack" Delay="0.2" DepthOffset="700" CubeDistance="50"></Transition>
            <Transition Pieces="7" Time="2" Transition="easeInOutElastic" Delay="0.1" DepthOffset="1000" CubeDistance="25"></Transition>
	    </Transitions>
EOQ;

$playlist .= '</Piecemaker>';
$compat = '';
if (!@JFile::write($xmlfile, $playlist))
{
    printf('<div style="background-color: red;">
<center><span style="font-size: small; color: white;"><strong>Unable to create <span STYLE="color: yellow">
' . str_replace(JPATH_BASE, "", $xmlfile) . '</span> configuration file. <br/>
Please check your permissions!</strong></div>');
}
endif;
?>
<?php ob_start();?>
    var flashvars = {};
    flashvars.cssSource = "<?php echo $realw; ?>/modules/mod_tz_piecemaker/piecemaker.css";
    flashvars.xmlSource = "<?php echo $realw; ?>/modules/mod_tz_piecemaker/banner/xml/piecemakerXML<?php echo $module->id;?>.xml";

    var params = {};
    params.play = "true";
    params.menu = "false";
    params.scale = "showall";
    params.wmode = "transparent";
    params.allowfullscreen = "true";
    params.allowscriptaccess = "always";
    params.allownetworking = "all";

    swfobject.embedSWF('<?php echo $realw; ?>/modules/mod_tz_piecemaker/piecemaker.swf', 'piecemaker', '<?php echo $width + 34 ; ?>', '<?php echo $height + 75 ; ?>', '10', null, flashvars, params, null);


<?php $script = '<script type="text/javascript">'.ob_get_clean().'</script>'; ?>
     <div id="top-piecemaker" style="height:470px; border:none; padding-top:3px; background:none;">
        <!-- this div will be overwritten by SWF object -->		
        <div id="piecemaker">
						<p>You need to <a href="http://www.adobe.com/products/flashplayer/">upgrade your Flash Player</a> to version 10 or newer.</p>
		</div>

         <?php echo $script; ?>
          <div class="bot_shadow"></div>
     </div>

