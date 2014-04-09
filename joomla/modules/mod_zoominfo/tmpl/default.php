<?php
/**
* Module Mod_zoominfo For Joomla 2.5.x
* Version		: 1.7.3
* Created by	: Daniel Pardons
* Email			: daniel.pardons@joompad.be
* Created on	: 12 March 2012
* Last Modified : 12 March 2012
* URL			: www.joompad.be
* License GPLv2.0 - http://www.gnu.org/licenses/gpl-2.0.html
* Based on jquery(http://www.jquery.com) and on the  Zoom-Info jquery tutorial by 
* Addy Osmani (http://addyosmani.com/blog)
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$baseurl 		= JURI::base();
$thumb_margin = 10;
$module_id		= $params->get( 'module_id' );
$add_cleardiv	= $params->get( 'add_cleardiv' );
$gallery_left_margin = $params->get( 'gallery_left_margin' );
$gallery_width	= $params->get( 'gallery_width' );
$gallery_bgcolor= $params->get( 'gallery_bgcolor' );
$gallery_layout	= $params->get( 'gallery_layout' );
$gallery_images	= $params->get( 'gallery_images' ); // nr of images to display in gallery
$gallery_images_use = $params->get( 'gallery_images_use' );
$effect_duration =  $params->get( 'effect_duration' );
$box_css = $params->get( 'box_css' );
$image_width	= $params->get( 'image_width' );
$image_width_without_px = substr($image_width, 0, -2); // without px
$image_height	= $params->get( 'image_height' );
$image_height_without_px = substr($image_height, 0, -2); // without px

$image_width_full = ($params->get( 'image_width_full' )) ? $params->get( 'image_width_full' ) : $image_width;
$image_width_full = substr($image_width_full, 0, -2); // without px
$image_height_full = ($params->get( 'image_height_full' )) ? $params->get( 'image_height_full' ) : $image_height;
$image_height_full = substr($image_height_full, 0, -2); // without px

$image_width_resized = $params->get( 'image_width_resized' );
$image_width_resized = substr($image_width_resized, 0, -2); // without px
$image_height_resized = (int)($image_height_full/($image_width/$image_width_resized));
$marginLeft = ($gallery_layout) ? $image_width_without_px - $image_width_resized - $thumb_margin : $thumb_margin;

$image_margin	= $params->get( 'image_margin' );

$image_color_target = $params->get( 'image_color_target' );

$title_color	= $params->get( 'title_color' );
$title_css		= $params->get( 'title_css' );
$teaser_color	= $params->get( 'teaser_color' );
$teaser_css		= $params->get( 'teaser_css' );


$external_url	= $params->get( 'external_url' );
$folder			= $params->get( 'folder' );
if (empty($external_url)) {
	$folder 	= JURI::base().$folder;
} else {
	$folder	= $external_url;
}

$image_ref = array();
$image_img = array();
$image_bg_color = array(); 
$image_title_color = array();
$image_teaser_color = array();
$image_alt = array();
$image_url = array();
$image_title = array();
$image_teaser = array();
$target_url= array();

$max_images = 20;

for ($i = 1; $i <= $max_images; $i++) {
	if ($params->get( 'image_img'.$i )) {
		$image_ref[]	= $i;
		$image_img[$i] 	= $folder.trim($params->get( 'image_img'.$i ));
		$image_alt[$i] 	= $params->get( 'image_alt'.$i );
		switch ($image_color_target) {
			case 3: 
				$image_bg_color[$i] = $gallery_bgcolor;				
				$image_title_color[$i] = ($params->get( 'image_teaser_bgcolor'.$i )) ? $params->get( 'image_teaser_bgcolor'.$i ) : $title_color;
				$image_teaser_color[$i] = ($params->get( 'image_teaser_bgcolor'.$i )) ? $params->get( 'image_teaser_bgcolor'.$i ) : $teaser_color;
				break;
			case 2: 
				$image_bg_color[$i] = $gallery_bgcolor;				
				$image_title_color[$i] = $title_color;
				$image_teaser_color[$i] = ($params->get( 'image_teaser_bgcolor'.$i )) ? $params->get( 'image_teaser_bgcolor'.$i ) : $teaser_color;
				break;
			case 1: 
				$image_bg_color[$i] = $gallery_bgcolor;				
				$image_title_color[$i] = ($params->get( 'image_teaser_bgcolor'.$i )) ? $params->get( 'image_teaser_bgcolor'.$i ) : $title_color;
				$image_teaser_color[$i] = $teaser_color;
				break;
			case 0:
			default:
				$image_bg_color[$i] = ($params->get( 'image_teaser_bgcolor'.$i )) ? $params->get( 'image_teaser_bgcolor'.$i ) : $gallery_bgcolor;
				$image_title_color[$i] = $title_color;
				$image_teaser_color[$i] = $teaser_color;
		}

		$image_title[$i] 	= $params->get( 'image_title'.$i );
		$image_teaser[$i] 	= ($params->get( 'teaser_nl2br' )) ? nl2br($params->get( 'image_teaser'.$i )) : $params->get( 'image_teaser'.$i );
		$image_url[$i] 	= str_replace('&', '&amp;', $params->get( 'image_url'.$i ));
		$target_url[$i] 	= $params->get( 'target_url'.$i );
	}
}
$image_cnt = count ($image_ref);
if ($gallery_images_use ) {
		shuffle ($image_ref);
}

$document =& JFactory::getDocument();
if ($params->get('load_JQuery')==1)  {
	$document->addScript(JURI::base() . 'modules/mod_zoominfo/js/jquery-1.4.2.min.js');
}

$zics='';
$zics .='
#galleryContainer'.$module_id.'{
margin-left: '.$gallery_left_margin.';
width:'.$gallery_width.' ;
}
#galleryContainer'.$module_id.' img {
margin: 0px;
}

.galleryImage'.$module_id.'{
width:'.$image_width.';
height:'.$image_height.';
overflow:hidden;
margin:'.$image_margin.';
float:left;
'.$box_css.'
}
.galleryImage'.$module_id.' > a {
padding: 0 !important;
}
.galleryImage'.$module_id.' a.title , h2.title {
'.$title_css.'
}
.galleryImage'.$module_id.' a.teaser , p.teaser {
'.$teaser_css.'
}';
// put configuration code in the header
$document->addStyleDeclaration($zics);

?>
<script type="text/javascript"> 
jQuery.noConflict();
jQuery(document).ready(function($)
{
	$('.galleryImage<?php echo $module_id; ?>').hover(
		function()
		{
			$(this).find('img').animate({width:<?php echo $image_width_resized; ?>, height:<?php echo $image_height_resized; ?>, marginTop:<?php echo $thumb_margin; ?>, marginLeft:<?php echo $marginLeft; ?>}, {queue:false,duration:<?php echo $effect_duration; ?>});
		 },
		 function()
		 {
			 $(this).find('img').animate({width:<?php echo $image_width_full; ?>, height:<?php echo $image_height_full; ?>, marginTop:0, marginLeft:0},{queue:false,duration:<?php echo $effect_duration; ?>});
		 });
});
</script>

<!-- zoominfo -->
<div id="galleryContainer<?php echo $module_id; ?>">
<?php
$imagenr = 0;
for ($i= 1; $i <= $gallery_images; $i++) {
	$cur_img = $image_ref[$imagenr] ;
	?>
	<!--galleryEntry <?php echo $imagenr+1; ?> -->
	<div class="galleryImage<?php echo $module_id; ?>" style="background-color:<?php echo $image_bg_color[$cur_img]; ?> ;">
		<?php if ($image_url[$cur_img]) { ?>
            <a href="<?php echo $image_url[$cur_img]; ?>" target="<?php echo $target_url[$cur_img]; ?>"> <img style="display: block;" src="<?php echo $image_img[$cur_img]; ?>" alt="<?php echo $image_alt[$cur_img]; ?>" /> </a>
			<a class="title" style="color:<?php echo $image_title_color[$cur_img]; ?>;" href="<?php echo $image_url[$cur_img]; ?>" target="<?php echo $target_url[$cur_img]; ?>"><?php echo $image_title[$cur_img]; ?></a>
			<a class="teaser" style="color:<?php echo $image_teaser_color[$cur_img]; ?>;" href="<?php echo $image_url[$cur_img]; ?>" target="<?php echo $target_url[$cur_img]; ?>"><?php echo $image_teaser[$cur_img]; ?></a>
		<?php } else { ?>
            <img style="display: block;" src="<?php echo $image_img[$cur_img]; ?>" alt="<?php echo $image_alt[$cur_img]; ?>" />
			<div>
				<h2 class="title" style="color:<?php echo $image_title_color[$cur_img]; ?>;"><?php echo $image_title[$cur_img]; ?></h2>
	            <p class="teaser" style="color:<?php echo $image_teaser_color[$cur_img]; ?>;"><?php echo $image_teaser[$cur_img]; ?></p>
			</div>
	    <?php } ?>
     </div>
	<?php 
	$imagenr++;
  } ?>
</div>
<?php if ($add_cleardiv){ ?>
<div style= "clear:both;"></div>
<?php } ?>