<?php
/**
 * $mod_hover
 * 
 * @version	1.0
 * @package	modules
 * @copyright	Copyright (C) Dec 2011 www.joomla51.com All rights reserved.
 * @license	GNU General Public License version 2
 * -------------------------------------
 */
defined( '_JEXEC' ) or die;
$document = JFactory::getDocument();

$style 					= $params->get( 'style', 'style01' ); 

$document->addStyleSheet('modules/mod_j51hover/css/'.$style.'/style.css' );
$document->addStyleSheet('modules/mod_j51hover/css/style_common.css');

$hover_title 			= $params->get('hover_title', 'Title');
$hover_description 		= $params->get('hover_description', 'Description');
$Directory 				= $params->get('Directory', '');
$hover_link 			= $params->get('hover_link', 'http://www.joomla51.com');
$picH 					= $params->get('pxHeight', 0);
$picW 					= $params->get('pxWidth', 0);
$textcolor 				= $params->get('textcolor', 0);
$bgcolor 				= $params->get('bgcolor', 0);
$HOpacity 				= $params->get('HOpacity', 0);
$j51_moduleid        = $module->id ;


require_once 'php/ConvertRGB.php';

$bgcolorRGB 			= hex2RGB($bgcolor);
$HRed 					= $bgcolorRGB[red];
$HGreen 				= $bgcolorRGB[green];
$HBlue 					= $bgcolorRGB[blue];

?>
<div class="imagehoverMain<?php echo $j51_moduleid; ?>">
<div class="imagehoverMain">
                <div class="imagehover<?php echo $style; ?>">                   
					<img src="<?php echo $Directory; ?>"/>
                    <div class="mask" style="background-color: rgba(<?php echo $HRed;?>,<?php echo $HGreen;?>,<?php echo $HBlue;?>, <?php echo $HOpacity;?>);">
                        <h2><?php echo $hover_title; ?></h2>
						<p><?php echo $hover_description; ?></p>
                        <a href="<?php echo $hover_link; ?>" class="info">Read More</a>
                    </div>
                </div>  
</div>
</div>

<style type="text/css" >

.imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverFallIn, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideDown, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideLeft, 
.imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideRight, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideUp, .imagehoverZoomIn,
.imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverFallIn .mask, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideDown .mask, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideLeft .mask, 
.imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideRight .mask, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideUp .mask, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverZoomIn .mask,
.imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverFallIn .content, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideDown .content, 
.imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideLeft .content, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideRight .content, 
.imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideUp .content, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverZoomIn .content
{width:<?php echo $picW;?>px;
height:<?php echo $picH;?>px;}							

.imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverFallIn p, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideDown p, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideLeft p, 
.imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideRight p, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverSlideUp p, .imagehoverMain<?php echo $j51_moduleid; ?> .imagehoverZoomIn p {color: <?php echo $textcolor;?>;}	

</style>


