	<?php
/**
 * @package		Zen Tools
 * @subpackage	Zen Tools
 * @author		Joomla Bamboo - design@joomlabamboo.com
 * @copyright 	Copyright (c) 2012 Joomla Bamboo. All rights reserved.
 * @license		GNU General Public License version 2 or later
 * @version		1.7.2
 */

defined('_JEXEC') or die('Restricted access');

// Module Class Suffix
$moduleclass_sfx = $params->get('moduleclass_sfx');

// View Parameters
$masonryColumnWidth = $params->get('masonryColumnWidth');
$masonryGutter = $params->get('masonryGutter');
$masonryWidths = $params->get('masonryWidths');
$masonryColWidths = $params->get('masonryColWidths');
$browserThreshold = $params->get('browserThreshold');
$border = $params->get('imageEffect');
$itemsperpage = $params->get('itemsperpage',3);
$slideTitleHide = str_replace('px', '', $params->get('slideTitleHide'));
$slideTitleWidth = str_replace('%', '', $params->get('slideTitleWidth'));
$slideshowPaginationWidth = $params->get('slideshowPaginationWidth','twelve');
$linktarget = $params->get('linktarget');
$fullwidthimage = $params->get('fullwidthimage');
$typeclass = null;

$replace=array(" ","'",".","/","-","&","%","*","#","_","+","=","(",")");
$filterstart = strtolower(str_replace($replace, '', $params->get('filterstart')));

if ($filterstart == "")
{
	$filterstart = "showall";
}

if ($params->get('overlayMore'))
{
	$moreClass= 'overlaymore';
}
else
{
	$moreClass= '';
}


// Lightbox
$modalVideo = $params->get('modalVideo');
$modalFullText = $params->get('modalFullText');
$modaltitle = $params->get('modaltitle');

// Place Holder Image
$usePlaceholder = $params->get('usePlaceholder', 0);
$placeHolderImage = $params->get('placeHolderImage');

$slideCountSep = $params->get('slideCountSep');
$slideCount = $params->get('slideCount');

// Null some variables
$joomla15 = false;
$isFeatured = false;
// Set the default path for the placeholder image
if (substr(JVERSION, 0, 3) >= '1.6') {
	$imagesPath = 'images/';
}
else {
	$joomla15 = 1;
	$imagesPath = 'images/stories/';
}

if (substr(JVERSION, 0, 3) >= '2.5') {
	$joomla25 = 1;
	$altlink = $params->get('altlink');
}
else {
	$joomla25 = 0;
	$altlink = 0;
}

// Grid Layout
$disableMargin = $params->get('disableMargin');


// Image title attribute
$imageTitle = $params->get('imageTitleAtt', 1);

// Images
$imageFade= $params->get('imageFade', 0);

// Logic for applying zenlast class to the last column.
$lastcolumn2 = false;
$lastcolumn3 = false;
$column2 = false;
$column3 = false;
$column4 = false;

$presetwarning = "<div class='notice'><strong>Warning</strong><br />It appears as though you have not applied the layout preset.<br />
After selecting the preset in the layout select list in the zentools admin, please hit the apply preset button to avoid seeing this message.</div>";

// Pagination is the same as the grid layour - well almost
// Sanistise the layotu variable in case the user selected a preset but didnt apply it.
if($layout =="pagination") {
	$layout ="grid";
}
elseif($layout =="gridtwocol") {
	$layout ="grid";
	echo $presetwarning;
	$elements = false;
}
elseif($layout =="gridfilter") {
	$layout ="grid";
	echo $presetwarning;
	$elements = false;
}
elseif($layout =="list2col") {
	$layout ="list";
	echo $presetwarning;
	$elements = false;
}
elseif($layout =="list3col") {
	$layout ="list";
	echo $presetwarning;
	$elements = false;
}
elseif($layout =="list4col") {
	$layout ="list";
	echo $presetwarning;
	$elements = false;
}
elseif($layout =="slideshowOverlay") {
	$layout ="slideshow";
	echo $presetwarning;
	$elements = false;
}
elseif($layout =="slideshowFlat") {
	$layout ="slideshow";
	echo $presetwarning;
	$elements = false;
}



	if($elements) {
		$enabled  = 1;
		$displayitems = explode(",", $elements);

		if(array_search('column2', $displayitems) !== false){	$column2 = 1;}
		if(array_search('column3', $displayitems) !== false){	$column3 = 1;}
		if(array_search('column4', $displayitems) !== false){	$column4 = 1;}

		if(!$column4 && !$column3) {$lastcolumn2 = "zenlast";}
		if(!$column4) {$lastcolumn3 = "zenlast";}


		// Remove non-image as directory options from array
		if($contentSource =="1") {
			if(array_search('extrafields', $displayitems) !== false){
				unset($displayitems[array_search('extrafields',$displayitems)]);
			}
			if(array_search('comments', $displayitems) !== false){
				unset($displayitems[array_search('comments',$displayitems)]);
			}
			if(array_search('attachments', $displayitems) !== false){
				unset($displayitems[array_search('attachments',$displayitems)]);
			}
			if(array_search('video', $displayitems) !== false){
				unset($displayitems[array_search('video',$displayitems)]);
			}
			if(array_search('date', $displayitems) !== false){
				unset($displayitems[array_search('video',$displayitems)]);
			}
			if(array_search('category', $displayitems) !== false){
				unset($displayitems[array_search('category',$displayitems)]);
			}
			// Resets the array
			$displayitems = array_values($displayitems);
		}


		// Remove k2 items from the array if content as a source
		if($contentSource =="2") {

			if(array_search('extrafields', $displayitems) !== false){
				unset($displayitems[array_search('extrafields',$displayitems)]);

			}

			if(array_search('comments', $displayitems)!== false){
				unset($displayitems[array_search('comments',$displayitems)]);
			}

			if(array_search('video', $displayitems) !== false){
				unset($displayitems[array_search('video',$displayitems)]);
			}
			//print_r($displayitems);

			// Resets the array
			$displayitems = array_values($displayitems);

		}

		// Test for tweet in the list of tags
		if(array_search('tweet', $displayitems) !== false){
			$tweet = true;
		}
		else {
			$tweet = false;
		}

		$countElements = count($displayitems);
	}
	else {
		echo "<div class='notice'>No content assigned to be displayed.</div>";
		$enabled = 0;
	}
	if($link !==0) {
		$closelink ="</a>";
	}
	$catlinkclose ="</a>";
	$readmoreclose ="</span></a>";


	// External Links
	if($link==3) {
		$extlinks = explode("\r\n", $params->get('extlinks'));
		$extlinks = explode("\n", $params->get('extlinks'));
	}


	// Params for column markup in the module
	if(!$column2 && !$column3 && !$column4) {
		$column1col = "twelve";
	}
	else {
		$column1col = $params->get('col1Width');
	}
	$column2col = $params->get('col2Width');
	$column3col = $params->get('col3Width');
	$column4col = $params->get('col4Width');

	$column2Markup="</div><div class='column2 grid_$column2col $lastcolumn2'>";
	$column3Markup="</div><div class='column3 grid_$column3col $lastcolumn3'>";
	$column4Markup="</div><div class='column4 grid_$column4col zenlast'>";


	// Null some of the item variables
	$titleMarkup = false;
	$textMarkup = false;
	$imageMarkup = false;

	$numMB = sizeof($list);

	if($enabled) {

		/**
		*
		* Filter triggerLoop
		*
		**/

			if($categoryFilter && ($layout == "grid" or $layout =="list")) {
			?>
			<ul id="filters" class="module<?php echo $moduleID ?>">
				<li class="showallID">
					<a href="#" data-filter="*" data-behavior="filter"><?php echo JText::_('ZEN_SHOW_ALL') ?></a>
				</li>
				<?php foreach($list as $key => $item) :
					$item->catname = strtolower(str_replace($replace, '', $item->category));
					?>
					<li class="<?php echo $item->catname ?>ID">
						<a href="#" data-filter=".<?php echo $item->catname ?>" data-behavior="filter"><?php echo $item->category ?></a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php } ?>

		<div id="zentools<?php echo $moduleID ?>" class="<?php if($layout=="slideshow") { ?>slideshow slideshow<?php echo $slideshowTheme; } ?> <?php if($layout=="carousel") {?>es-carousel-wrapper<?php } ?><?php if($params->get('layout') == "pagination" || $slideTrigger == "tabs") { ?> zenpagination<?php }?> <?php echo $moduleclass_sfx;?>">
			<div class="zentools <?php echo $layout ?> <?php if($layout=="slideshow") {?>flexslider<?php } ?> <?php echo $border ?> count<?php echo $countElements ?> <?php if($layout == "carousel") { ?>es-carousel<?php } ?><?php if($layout == "grid" && $disableMargin) {?> nomargin<?php }?><?php if(($layout == "grid" && $overlayGrid) || ($layout == "carousel" && $overlayCarousel)) {?> overlay<?php }?>">

				<?php if($params->get('layout') == "pagination"){ ?>
				<div class="zenpages">
						<div id="paginationinner<?php echo $moduleID ?>"></div>
				</div>
				<?php } ?>

				<ul id="zentoolslist<?php echo $moduleID ?>"  <?php if($layout=="slideshow") {?>class="slides <?php echo $params->get('slideshowPaginationPos', 'zenleft'); ?>"<?php } ?>>

					<?php
					if (is_array($list)) {

						foreach($list as $key => $item) :

							$item->cleantitle = $item->title;

							/**
							*
							* Read More
							*
							**/

							if($link==1){

								if($altlink && $item->newlink && $joomla25) {
									$item->more = '<a rel="group3'. $moduleID .'" class="iframe '.$moreClass.'"'.$item->altlink.' data-behavior="lightbox"><span class="readon">'.$params->get('readonText').$readmoreclose;
								}
								else {
									$item->more = '<a rel="group3'. $moduleID .'" class="inline '.$moreClass.'"'.$item->link.' '.$moreClass.' data-behavior="lightbox"><span class="readon">'.$params->get('readonText').$readmoreclose;
								}
							}
							elseif($link==2) {
								if($altlink && isset($item->altlink) && $joomla25) {
									$item->more = '<a target="'.$linktarget.'" class="inline" '.$item->altlink.' '.$moreClass.' data-behavior="content"><span class="readon">'.$params->get('readonText').$readmoreclose;
								}
								else {
									$item->more = '<a target="'.$linktarget.'" class="'.$moreClass.'" '.$item->link.' data-behavior="content"><span class="readon">'.$params->get('readonText').$readmoreclose;
								}

							}
							elseif($link==3) {
								if(isset($extlinks[$key])) {
									$item->link = $extlinks[$key];
									$item->more = '<a target="'.$linktarget.'" class="'.$moreClass.'" href="'.$item->link.'" data-behavior="external"><span class="readon">'.$params->get('readonText').$readmoreclose;
								}
								else {
									$item->more = null;
								}
							}
							else {
								$item->more = false;
							}




							/**
							*
							* Slideshow links
							*
							**/


								if($layout=="slideshow") {
									if($slideTrigger=="thumb"){
										if($item->image !=="") {
											$item->trigger = '<img src="'.$item->thumb.'" alt="'.$item->cleantitle.'" title="'.$item->title.'"/>';
										}
										else {
											$item->trigger = '<img src="'.resizeImageHelper::getResizedImage('modules/mod_zentools/images/placeholder.jpg', $thumb_width, $thumb_height, $option).'" alt="image"  title="'.$item->title.'"/>';
										}
									}
									elseif($slideTrigger=="title"){
										$item->trigger = $item->title;
									}

									elseif($slideTrigger=="tabs"){
										if($item->image !=="") {
											$item->trigger = '<div class="pagthumbs"><img src="'.$item->thumb.'" alt="'.$item->cleantitle.'" title="'.$item->title.'"/>';
											$item->trigger .= ''.$item->title.'</div>';
											$item->trigger .= '<div class="clear"></div>';
										}
										else {
											$item->trigger = '<img src="'.resizeImageHelper::getResizedImage('modules/mod_zentools/images/placeholder.jpg', $thumb_width, $thumb_height, $option).'" alt="image"  title="'.$item->title.'"/>';
										}
									}


									elseif($slideTrigger=="numbers" || $slideTrigger=="discs"){
										$item->trigger = $key+1;
									}
									else {
										$item->trigger = false;
									}
								}


							/**
							*
							* Title and Link
							*
							**/

							if ($params->get('renderPlugin') == 'render'){
								if (substr(JVERSION, 0, 3) >= '1.6') {
										$item->title = JHtml::_('content.prepare', $item->title);
								} else {
									$plgparams 	   = $mainframe->getParams('com_content');
									$dispatcher	   = JDispatcher::getInstance();
									JPluginHelper::importPlugin('content');
									$results = $dispatcher->trigger('onPrepareContent', array (& $item, & $plgparams));
									$item->title = $item->title;
								}
							} else {
									$item->title = preg_replace('/{([a-zA-Z0-9\-_]*)\s*(.*?)}/i','', $item->title);

							}

							// Clean title for image titles etc
							$item->cleantitle = preg_replace('/{([a-zA-Z0-9\-_]*)\s*(.*?)}/i','', $item->title);

							if(($layout == "accordion") && ($displayitems[0] == "title")) {
								$item->title = '<'.$titleClass.'>'.$item->title.'</'.$titleClass.'>';
							}
							else {
								if($link==1){
									$item->title = '<'.$titleClass.'><a rel="group2'. $moduleID .'" class="inline" '.$item->link.' data-behavior="lightbox">'.$item->title.$closelink.'</'.$titleClass.'>';
								}
								elseif($link==2){
									if($altlink && isset($item->altlink) && $joomla25) {
										$item->title = '<'.$titleClass.'><a target="'.$linktarget.'" '.$item->altlink.' data-behavior="content">'.$item->title.$closelink.'</'.$titleClass.'>';
									}
									else {
										$item->title = '<'.$titleClass.'><a target="'.$linktarget.'" '.$item->link.' data-behavior="content">'.$item->title.$closelink.'</'.$titleClass.'>';
									}
								}
								elseif($link==3){
									if(isset($extlinks[$key])) {
										$item->link = $extlinks[$key];
										$item->title = '<'.$titleClass.'><a target="'.$linktarget.'" href="'.$item->link.'" data-behavior="external">'.$item->title.$closelink.'</'.$titleClass.'>';
									}
									else {
										$item->link = null;
									}


								}
								else {
									$item->title = '<'.$titleClass.'>'.$item->title.'</'.$titleClass.'>';
								}
							}

							if($contentSource == "1") {
								$item->id = $key;
							}


							/**
							*
							* Image and Link
							*
							**/

							if($imageTitle) {
							 $imageTitleText = 'title="'.$item->cleantitle.'"';
							}
							else {
								$imageTitleText = false;
							}

							if(!empty($item->image)) {

									if($responsiveimages) {


										$img = '<img
													data-original="'.$item->{'image'.$params->get('sourceImage')}.'"
													src="'.$item->{'image'.$params->get('sourceImage')}.'"
													data-src320="'.$item->{'image'.$params->get('mobile')}.'"
													data-src481="'.$item->{'image'.$params->get('tabletPortrait')}.'"
													data-src769="'.$item->{'image'.$params->get('tabletLandscape')}.'"
													data-src1025="'.$item->{'image'.$params->get('desktopImage')}.'"
													data-src1281="'.$item->{'image'.$params->get('wideImage')}.'"
													alt="'.$item->cleantitle.'" '.$imageTitleText.'/>';
									}
									else {
										$img = '<img data-original="'.$item->image.'"  src="'.$item->image.'"  alt="'.$item->cleantitle.'" '.$imageTitleText.'/>';

									}

								if($imagesreplace && isset($item->video) && $contentSource == 3) {
									if (substr(JVERSION, 0, 3) >= '1.6') {
										$item->video = JHtml::_('content.prepare', $item->video);
									}

									$item->image = '<div class="video-container"><div class="zenvideo">'.$item->video.'</div></div>';

									$typeclass = "video";
								}
								else {
									if($link==1){
										$item->image = '<a rel="group1'. $moduleID .'" class="inline" '.$item->link.' data-behavior="lightbox">'.$img.$closelink;
									}
									elseif($link==2) {
										if($altlink && isset($item->altlink) && $joomla25) {
											$item->image = '<a target="'.$linktarget.'" '.$item->altlink.' data-behavior="content">'.$img.$closelink;
										}
										else {
											$item->image = '<a target="'.$linktarget.'" '.$item->link.' data-behavior="content">'.$img.$closelink;
										}
									}
									elseif($link==3) {
										if(isset($extlinks[$key])) {
											$item->link = $extlinks[$key];
											$item->image = '<a target="'.$linktarget.'" href="'.$item->link.'" data-behavior="external">'.$img.$closelink;
										}
										else {
											$item->link = null;
											$item->image = $img;
										}
									}
									else {
										$item->image = $img;
									}
									$typeclass = "text";
								}
							}
							else {
								if($usePlaceholder) {
									if($link==1){
										$item->image = '<a rel="group1'. $moduleID .'" class="inline"'.$item->link.' data-behavior="lightbox"><img src="'.resizeImageHelper::getResizedImage(''.$imagesPath.$placeHolderImage.'', $image_width, $image_height,  $option).'" alt="'.$item->cleantitle.'" '.$imageTitleText.'/>'.$closelink;
									}
									else {
										$item->image = '<a target="'.$linktarget.'" '.$item->link.' data-behavior="lightbox"><img src="'.resizeImageHelper::getResizedImage(''.$imagesPath.$placeHolderImage.'', $image_width, $image_height,  $option).'" alt="'.$item->cleantitle.'" '.$imageTitleText.'/>'.$closelink;
									}
								}
								else {
									$item->image = "";
								}
							}



							/**
							*
							* Category and Link
							*
							**/

							$item->catname = strtolower(str_replace(' ', '', $item->category));
							if(($layout == "accordion") && ($displayitems[0] == "category") or ($layout == "grid")) {
								$item->category = '<span>'.$item->category.'</span>';
							}
							else {
								$item->category = $item->catlink.'<span>'.$item->category.'</span>'.$catlinkclose;
							}

							// Adds zenlast to the last item in the row
							$lastitem = ($key == ($numMB -1)) ? "zenlast" : "";

							// Assigns the last image in the row to have 0 margin
							$imageNumber++;

							$rowFlag = ($imageNumber % $imagesPerRow) ? 0 : 1;

							if($contentSource == "3") {
								// K2 Extra fields
								if(is_array($item->extrafields)) {
									foreach ($item->extrafields as $key=>$extraField):
										$item->extrafields .= $extraField->value;
										$item->extrafields .= '<br />';
										endforeach;
									}
									$item->extrafields = str_replace("Array", "", $item->extrafields);
							}


							if($contentSource !=="1") {
								$meta = explode(" ", $item->metakey);
							}
							if($layout == "masonry") {
								if($masonryWidths && $contentSource !=="1") {
									$gridclass = $meta[0];
								}
								else {
									$gridclass = $masonryColWidths;
								}
							}
							elseif($layout == "list" || $layout == "accordion" || $layout =="slideshow"|| $layout =="carousel") {
								$gridclass="twelve";
							}


							/*
							* Code for adding the featured class
							*/


							if($joomla15 && $contentSource =="2") {
									$meta = explode(" ", $item->metakey);
									if($meta[0] =="featured") {
										$item->featured = 1;
									}
									else {
										$item->isfeatured = 0;
									}
							}



							/*
							* Process the prepare content plugins
							*/

							if ($params->get('renderPlugin') == 'render'){
								if (substr(JVERSION, 0, 3) >= '1.6') {
										$item->text = JHtml::_('content.prepare', $item->text);
									} else {
										$plgparams 	   = $mainframe->getParams('com_content');
										$dispatcher	   = JDispatcher::getInstance();
										JPluginHelper::importPlugin('content');
										$results = $dispatcher->trigger('onPrepareContent', array (& $item, & $plgparams));
										$results = $dispatcher->trigger('onPrepareContent', array (& $item, & $plgparams));
										$item->text = $item->text;
									}
								} else {
									$item->text = preg_replace('/{([a-zA-Z0-9\-_]*)\s*(.*?)}/i','', $item->text);

								}


							/*
							* Prepare plugins for video field - used if not using the traditional methods
							*/
							if(isset($item->video)) {
								if (substr(JVERSION, 0, 3) >= '1.6') {
									$item->video = JHtml::_('content.prepare', $item->video);
								}
							}

							/*
							* Tweet This button
							*/

							$item->tweet ='
							<a href="https://twitter.com/share" class="twitter-share-button" data-behavior="twitter" data-count="'. $params->get('twitterCount') .'" data-url="'. $item->link .'" data-via="'. $params->get('twittername','joomlabamboo') .'" data-lang="en" data-text="'. $params->get('tweetPre') .' '. $item->cleantitle .'"></a>
							';

							// Leading then title view. Basically nulls the elements for all items after the first one
							if($layout =="leading") {
								if($key !==0){$item->image = $item ->category = $item->text = $item->more = $item->date ="";}
							}


							?>

					<li class="grid_<?php if($layout !=="slideshow") { echo $gridclass;} ?> element <?php if($categoryFilter && ($layout == "grid" or $layout =="list")) { echo strtolower(str_replace($replace, '', $item->catname)); }?><?php if($rowFlag && $slideTrigger !=="tabs") { echo " zenlast"; } if($item->featured) { echo " featured";}?>">
							<div class="zenitem zenitem<?php echo $key + 1; ?> <?php if($item->featured) { echo "featured"; } ?> <?php echo $displayitems[0]; ?> <?php echo $fullwidthimage; ?>">
								<div class="zeninner">
									<div class="column grid_<?php echo $column1col; ?>">

										<?php if(count($displayitems) > 0)  {?>
											<div class="zen<?php echo $displayitems[0]; ?> element1 firstitem"><?php echo $item->$displayitems[0]; ?></div>
										<?php } ?>

										<?php if($layout == "accordion" || ($layout =="slideshow" && $slideshowTheme == "overlay") || ($layout =="slideshow" && $slideshowTheme == "lifestyle") || ($layout =="slideshow" && $slideshowTheme == "overlayFrame") || ($layout == "grid" && $overlayGrid) ||  ($layout == "carousel" && $overlayCarousel)) {?>
											<div class="allitems <?php echo $typeclass ?> container"><div>
										<?php } ?>
											<?php if(count($displayitems) > 1)  {
												if($displayitems[1] == "column2" || $displayitems[1] == "column3"  || $displayitems[1] ==  "column4") {echo ${$displayitems[1].'Markup'}; } else {	?>
												<div class="zen<?php echo $displayitems[1]; ?> element2"><?php echo $item->$displayitems[1]; ?></div>
											<?php } } ?>

											<?php if(count($displayitems) > 2)  {

												if($displayitems[2] == "column2" || $displayitems[2] == "column3"  || $displayitems[2] ==  "column4") {echo ${$displayitems[2].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[2]; ?> element3"><?php echo $item->$displayitems[2]; ?></div>
											<?php } }?>

											<?php if(count($displayitems) > 3)  {
												if($displayitems[3] == "column2" || $displayitems[3] == "column3"  || $displayitems[3] ==  "column4") {echo ${$displayitems[3].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[3]; ?> element4"><?php echo $item->$displayitems[3]; ?></div>
											<?php } } ?>

											<?php if(count($displayitems) > 4)  {
												if($displayitems[4] == "column2" || $displayitems[4] == "column3"  || $displayitems[4] ==  "column4") {echo ${$displayitems[4].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[4]; ?> element5"><?php echo $item->$displayitems[4]; ?></div>
											<?php } }?>

											<?php if(count($displayitems) > 5)  {
												if($displayitems[5] == "column2" || $displayitems[5] == "column3"  || $displayitems[5] ==  "column4") {echo ${$displayitems[5].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[5]; ?> element6"><?php echo $item->$displayitems[5]; ?></div>
											<?php } } ?>

											<?php if(count($displayitems) > 6)  {
												if($displayitems[6] == "column2" || $displayitems[6] == "column3"  || $displayitems[6] ==  "column4") {echo ${$displayitems[6].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[6]; ?> element7"><?php echo $item->$displayitems[6]; ?></div>
											<?php } } ?>

											<?php if(count($displayitems) > 7)  {
												if($displayitems[7] == "column2" || $displayitems[7] == "column3"  || $displayitems[7] ==  "column4") {echo ${$displayitems[7].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[7]; ?> element8"><?php echo $item->$displayitems[7]; ?></div>
											<?php } } ?>

											<?php if(count($displayitems) > 8)  {
												if($displayitems[8] == "column2" || $displayitems[8] == "column3"  || $displayitems[8] ==  "column4") {echo ${$displayitems[8].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[8]; ?> element9"><?php echo $item->$displayitems[8]; ?></div>
											<?php } } ?>

											<?php if(count($displayitems) > 9)  {
												if($displayitems[9] == "column2" || $displayitems[9] == "column3"  || $displayitems[9] ==  "column4") {echo ${$displayitems[9].'Markup'};} else {	?>
												<div class="zen<?php echo $displayitems[9]; ?> element10"><?php echo $item->$displayitems[9]; ?></div>
											<?php } }?>

											<?php if($layout == "accordion" || ($layout =="slideshow" && $slideshowTheme == "overlay") || ($layout =="slideshow" && $slideshowTheme == "lifestyle") || ($layout =="slideshow" && $slideshowTheme == "overlayFrame") || ($layout == "grid" && $overlayGrid) ||  ($layout == "carousel" && $overlayCarousel)) {?>
											</div></div>
										<?php } ?>
									</div>
									<div class="clear"></div>
								</div>
							</div>

						<?php if($link == 1) {?>

							<div style="display:none">
								<div id="data<?php echo $item->id ?>">
									<?php if($item->modalimage !=="") {
											if($modalImage) { ?>
												<img src="<?php echo $item->modalimage; ?>" alt="<?php echo $item->modaltitle ?>" />
									<?php 	}
										} ?>
									<?php if($modalTitle) { ?>
										<?php echo '<h2>'.$item->modaltitle.'</h2>'; ?>
									<?php } ?>
										<?php if($modalVideo && $contentSource == 3) { ?>
											<?php if($item->video !=="") { echo $item->video; }?>
										<?php } ?>
									<?php if($modalText) { ?>
										<?php echo $item->modaltext; ?>
									<?php } ?>

									<?php if($params->get('modalMore')) { ?>
										<a <?php echo $item->lightboxmore; ?> data-behavior="lightbox">
											<span class="readon"><?php echo $params->get('readonText') ?></span>
										</a>

									<?php } ?>

								</div>
							</div>
						<?php } ?>
					</li>
						<?php
							if($rowFlag && ($layout =="grid") or ($layout =="leading")) { ?><li class="clear"></li>
						<?php } ?>
					<?php endforeach;
				} else {
					echo "<div class='notice'>No content assigned to be displayed.</div>";
				}?>
				</ul>

				<?php if($layout=="slideshow") {?>
					<div class="slide-controller <?php if($slideTrigger !=="title") { ?>zenrelative<?php } else { echo $params->get('slideshowTitleTheme', 'none'); }?> zenlast <?php if($slideTrigger !=="none" || $slideCount) {?>zenpadding<?php } ?>">
						<div class="slidenav<?php echo $slideTrigger ?> slidenav<?php echo $moduleID ?>">
						<?php $numMB = sizeof($list);
							if($numMB > 1) { ?>

								<ul class="slidenav <?php echo $params->get('slideshowPaginationPos', 'zenleft'); ?>">
									<?php foreach($list as $key => $item) :
										echo '<li>';
										echo '<span>';
										echo $item->trigger;
										echo '</span>';
										echo '</li>';
										endforeach; ?>
										<?php if($slideTrigger == "title"){ ?>
										<div class="zenpages">
												<div id="paginationinner<?php echo $moduleID ?>"></div>
										</div>
										<?php } ?>
								</ul>
						<?php } ?>
						</div>
						<?php if($slideCount) {?>
						<div class="slidecount">
							<span class="current-slide"></span>
							<span class="slide-count-sep"><?php echo $slideCountSep ?></span>
							<span class="total-slides"></span>
						</div>
						<?php } ?>
					</div>

					<div class="clear"></div>
				<?php } ?>
		</div>
	</div>
	<div class="clear"></div>
	<?php // Scripts if cache is on
	if($scripts) {
		//if(!$zgf) {
			if($cache){ ?>

				<link rel="stylesheet" href="<?php echo $modbase?>css/zentools.css" type="text/css" />
				<?php if(!$zgf) { ?>
				<link rel="stylesheet" href="<?php echo $modbase?>css/grid.css" type="text/css" />
				<?php } ?>

				<?php if ($link == 1){
					$zoomClass .= $moduleID;
				?>
					<link rel="stylesheet" href="<?php echo $modbase?>js/jquery.fancybox/jquery.fancybox-1.3.4.css" type="text/css" />
					<script type="text/javascript" src="<?php echo $modbase?>js/jquery.fancybox/jquery.fancybox-1.3.4.pack.js"></script>
				<?php }

				if($layout == "slideshow") { ?>
					<link rel="stylesheet" href="<?php echo $modbase?>css/slideshow.css" type="text/css" />
					<script type="text/javascript" src="<?php echo $modbase?>js/slideshow/jquery.flexslider-min.js"></script>
				<?php }

				if($layout == "masonry") { ?>
					<link rel="stylesheet" href="<?php echo $modbase?>css/masonry.css" type="text/css" />
					<script type="text/javascript" src="<?php echo $modbase?>js/masonry/jquery.masonry.js"></script>
				<?php }


				if($layout == "pagination" || $slideTrigger =="title") { ?>
						<link rel="stylesheet" href="<?php echo $modbase?>css/pagination.css" type="text/css" />
						<script type="text/javascript" src="<?php echo $modbase?>js/pagination/jPages.js"></script>
				<?php }

				if($layout == "accordion") { ?>
						<link rel="stylesheet" href="<?php echo $modbase?>css/accordion.css" type="text/css" />
				<?php }

				if($layout == "carousel") { ?>
					<link rel="stylesheet" href="<?php echo $modbase?>css/elastislide.css" type="text/css" />
					<script type="text/javascript" src="<?php echo $modbase?>js/carousel/jquery.easing.1.3-min.js"></script>
					<script type="text/javascript" src="<?php echo $modbase?>js/carousel/jquery.elastislide-min.js"></script>
				<?php }

				if($categoryFilter && ($layout == "grid" or $layout =="list")) { ?>
					<link rel="stylesheet" href="<?php echo $modbase?>css/masonry.css" type="text/css" />
					<script type="text/javascript" src="<?php echo $modbase?>js/filter/jquery.isotope.min.js"></script>
					<!--[if IE 8]>
						<script type="text/javascript" src="<?php echo $modbase?>js/filter/jquery.isotope.ie8.min.js"></script>
					<![endif]-->
				<?php }
			}
			//}
	} ?>

	<?php if($tweet) {?>
		<script type="text/javascript" charset="utf-8">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

	<?php }

	if($layout == "slideshow") {
		$slideshowAuto = $params->get('slideshowAuto');
		$slideshowNav = $params->get('slideshowNav');
		$slideshowLoop = $params->get('slideshowLoop');
		$slideshowPagination = $params->get('slideshowPagination');
		$slideshowPause = $params->get('slideshowPause');
		$slideshowSpeed = $params->get('slideshowSpeed');
		$slideshowDuration = $params->get('slideshowDuration');
		$transition = $params->get('transition','slide');
		$pauseText = $params->get('pauseText','');
		$playText = $params->get('playText','');
		$overlayAnimation = $params->get('overlayAnimation','');
		?>


		<script type="text/javascript" charset="utf-8">
		  jQuery(window).load(function() {
			jQuery('#zentools<?php echo $moduleID ?>').flexslider({
				animation: "<?php echo $transition ?>",
				slideDirection: "horizontal",
				manualControls: ".slidenav<?php echo $moduleID ?> ul li",
				<?php if($slideshowAuto) { ?>
					slideshow: true,
					slideshowSpeed: <?php echo $slideshowSpeed ?>,
					animationDuration: <?php echo $slideshowDuration ?>,
				<?php }
				else { ?>
					slideshow: false,
				<?php }
				if($slideshowNav) { ?>
					directionNav: true,
				<?php } else { ?>
					directionNav: false,
				<?php }
				if($slideshowPagination !=="none") { ?>
					controlNav: true,
				<?php } else { ?>
					controlNav: false,
				<?php } ?>
					keyboardNav: true,
					mousewheel: false,
				<?php if($slideshowPause) { ?>
					pausePlay: true,
					pauseText: '<?php echo $pauseText; ?>',
					playText: '<?php echo $playText; ?>',
				<?php } ?>
				<?php if($slideshowPagination) { ?>
					randomize: false,
				<?php } ?>
					slideToStart: 0,
				<?php if($slideshowLoop) { ?>
					animationLoop: true,
				<?php } else { ?>
					animationLoop: false,
				<?php }?>
					pauseOnAction: true,
					pauseOnHover:false,
					controlsContainer: '.slide-controller',

					start: function(slider){
						jQuery('#zentools<?php echo $moduleID ?> .current-slide').text(slider.currentSlide + 1);
						jQuery('#zentools<?php echo $moduleID ?> .total-slides').text(slider.count);
						jQuery('#zentools<?php echo $moduleID ?> .slidecount').fadeIn();

					},

					<?php if($overlayAnimation or $slideTrigger  == "tabs") { ?>
					before: function(slider){

						<?php if($overlayAnimation) { ?>
							jQuery("#zentools<?php echo $moduleID ?> .allitems.text").slideUp();
						<?php } ?>

						<?php if($slideTrigger  == "title") { ?>
							if(slider.currentSlide == (<?php echo $itemsperpage ?> - 1)) {
								jQuery("#paginationinner<?php echo $moduleID ?>").jPages(2);
							}
							if(slider.currentSlide == ((<?php echo $itemsperpage ?> * 2) - 1)) {
								jQuery("#paginationinner<?php echo $moduleID ?>").jPages(3);
							}
							if(slider.currentSlide == ((<?php echo $itemsperpage ?> * 3) - 1)) {
								jQuery("#paginationinner<?php echo $moduleID ?>").jPages(4);
							}
							if(slider.currentSlide == ((<?php echo $itemsperpage ?> * 4) - 1)) {
								jQuery("#paginationinner<?php echo $moduleID ?>").jPages(5);
							}
						<?php } ?>
					},
					<?php } ?>
					after: function(slider){
						<?php if($overlayAnimation) { ?>
							jQuery("#zentools<?php echo $moduleID ?> .allitems.text").slideDown();
						<?php } ?>
							jQuery('#zentools<?php echo $moduleID ?> .current-slide').text(slider.currentSlide + 1);

							<?php if($slideTrigger  == "title") { ?>
							if(slider.currentSlide == 0) {
								jQuery("#paginationinner<?php echo $moduleID ?>").jPages(1);
							}
							<?php } ?>
					}
				});

				<?php if($overlayAnimation) { ?>
					jQuery("#zentools<?php echo $moduleID ?> .flex-control-nav a,#zentools<?php echo $moduleID ?> .flex-direction-nav a,.slidenav<?php echo $moduleID ?> ul li").click(function() {
						jQuery("#zentools<?php echo $moduleID ?> .allitems.text").slideUp();
					});
				<?php } ?>

			<?php if($slideTrigger =="title") { ?>
					var slideshowheight = jQuery("#zentools<?php echo $moduleID ?> .zenimage").height();
					jQuery("#zentools<?php echo $moduleID ?> ul.slidenav").css({"width": "<?php echo $params->get('slideTitleWidth'); ?>"}).fadeIn();
					jQuery("#zentools<?php echo $moduleID ?> ul.slides").addClass("title").width("100-<?php echo $slideTitleWidth ?>");
					jQuery("#zentools<?php echo $moduleID ?> ul.slides li").css({"width" : (100-<?php echo $slideTitleWidth ?>) + '%'});
					jQuery("#zentools<?php echo $moduleID ?> ul.slides.title.zenleft").css({"margin-left": "<?php echo $params->get('slideTitleWidth'); ?>"});
				//	jQuery("#zentools<?php echo $moduleID ?> ul.slidenav li").height(((slideshowheight/<?php echo $itemsperpage ?>)-(<?php echo $itemsperpage ?> * 12)));

				jQuery.fn.tabWidth = function() {
					var browserWidth = jQuery(window).width();
					if (browserWidth < <?php echo $slideTitleHide; ?>) {
						jQuery("#zentools<?php echo $moduleID ?> ul.slidenav").hide();
						jQuery("#zentools<?php echo $moduleID ?> li.element").addClass("grid_twelve");
						jQuery("#zentools<?php echo $moduleID ?> ul.slides.title.zenleft").css({"margin-left": "0"})
						jQuery("#zentools<?php echo $moduleID ?> ul.slides li").css({"width" : '100%'});
					}

					if (browserWidth > <?php echo $slideTitleHide; ?>) {
						jQuery("#zentools<?php echo $moduleID ?> ul.slidenav").show();
						jQuery("#zentools<?php echo $moduleID ?> ul.slides.title.zenleft").css({"margin-left": "<?php echo $params->get('slideTitleWidth'); ?>"});
						jQuery("#zentools<?php echo $moduleID ?> ul.slides li").css({"width" : (100-<?php echo $slideTitleWidth ?>) + '%'});
					}
				}

				// Sets the width of the slideshow
				jQuery(this).tabWidth();

				jQuery(window).resize(function () {
					// Sets the width of the module
					jQuery(this).tabWidth();
				});
			<?php } ?>
	  });
		</script>

		<?php if($slideTrigger  == "title") { ?>
		<script type="text/javascript">
		jQuery(function() {

			jQuery("#paginationinner<?php echo $moduleID ?>").jPages({
				containerID : "itemContainer",
				perPage      : <?php echo $itemsperpage ?>,
				first       : false,
				previous    : false,
				next        : false,

				last        : false

			});

		});
		</script>
		<?php } ?>
	<?php } ?>

	<?php if($layout == "masonry") { ?>
	<script type="text/javascript">

		jQuery(document).ready(function(){
			var jQuerycontainer = jQuery('#zentoolslist<?php echo $moduleID ?>');

			<?php if($masonryWidths) { ?>
			jQuerycontainer.imagesLoaded( function(){
				jQuerycontainer.masonry({
					itemSelector: '#zentoolslist<?php echo $moduleID ?> li',
					isAnimated: true,
					isResizable: true,
					columnWidth: <?php echo $masonryColumnWidth ?>,
					gutterWidth: <?php echo $masonryGutter ?>
				});
			});
			<?php }
			else { ?>
				jQuerycontainer.imagesLoaded( function(){
					jQuerycontainer.masonry({
						itemSelector: '#zentoolslist<?php echo $moduleID ?> li',
						isResizable: true,
						isAnimated: true,
						columnWidth: (jQuerycontainer.width() - 15) / <?php echo $masonryColWidths; ?>
					});
				});
				jQuery(window).resize(function(){
					var windowsize = jQuery(window).width();

					if(windowsize > <?php echo $browserThreshold; ?>) {
						jQuery("#zentoolslist<?php echo $moduleID ?> li");
							jQuerycontainer.masonry({
								isResizable: true,
								isAnimated: true,
								columnWidth: jQuerycontainer.width() / <?php echo $masonryColWidths; ?>
						});
					}
					else {
						jQuery("#zentoolslist<?php echo $moduleID ?> li");
								jQuerycontainer.masonry({
								isResizable: true,
								isAnimated: true,
								columnWidth: jQuerycontainer.width() / 1
						});
					}
				});
			<?php } ?>

			jQuery('#jbToggle').click(function(){
				// We use this as a hook for templates to trigger and retrigger the masonry layout
				setTimeout( function() {
					var jQuerycontainer = jQuery('#zentoolslist<?php echo $moduleID ?>');

					jQuerycontainer.masonry({
						itemSelector: '#zentools<?php echo $moduleID ?> li',
						isResizable: true,
						isAnimated: true,
						columnWidth: jQuerycontainer.width() / <?php echo $masonryColWidths; ?>
						});
					}, 500 );
				});
		});
	</script>
	<?php }
	if($categoryFilter && ($layout == "grid" or $layout =="list")) {?>

	<script type="text/javascript">
		var reLayouTriggered = false;
		jQuery(document).ready(function(){

			// Strips duplicates form the list
			var seen = {};
			jQuery('#filters.module<?php echo $moduleID ?> li').each(function() {
				var txt = jQuery(this).text();
				if (seen[txt])
					jQuery(this).remove();
				else
					seen[txt] = true;
			});

			// cache container
			var jQuerycontainer = jQuery('#zentoolslist<?php echo $moduleID ?>');
			// initialize isotope
			jQuerycontainer.imagesLoaded( function(){
				var options = {animationEngine: "best-available"};

				<?php if ($filterstart !== "showall" && !empty($filterstart)) : ?>
					options.filter = '.<?php echo $filterstart ?>';
				<?php endif; ?>

				<?php if ($layout == "list") : ?>
					options.layoutMode = 'straightDown';
				<?php elseif ($layout == "grid") : ?>
					options.masonry = { columnWidth: jQuerycontainer.width() / <?php echo $imagesPerRow ?> };
				<?php endif; ?>

				jQuerycontainer.isotope(options, function () {
					// Force a relayout after complete load
					if (!reLayouTriggered)
					{
						var t = setInterval(function ()
						{
							var instance = jQuerycontainer.data('isotope');
							if (instance && !reLayouTriggered)
							{
								defaultFilter = '*';
								<?php if ($filterstart !== "showall" && !empty($filterstart)) : ?>
									defaultFilter = '.<?php echo $filterstart; ?>';
								<?php endif; ?>
								// jQuerycontainer.isotope('reLayout');
								jQuerycontainer.isotope({filter: defaultFilter});
								reLayouTriggered = true;
								clearTimeout(t);
							}
						}, 100);
					}
				});

				// update columnWidth on window resize
				jQuery(window).smartresize(function(){
					jQuerycontainer.isotope({
						masonry: { columnWidth: jQuerycontainer.width() / <?php echo $imagesPerRow ?> }
					});
				});
			});

			// filter items when filter link is clicked
			jQuery('#filters.module<?php echo $moduleID ?> a').click(function(){
				jQuery('#zentoolslist<?php echo $moduleID ?> li').css({'height' : 'auto','display':'block'});
				var selector = jQuery(this).attr('data-filter');
				jQuerycontainer.isotope({
					filter: selector,
					masonry: { columnWidth: jQuerycontainer.width() / <?php echo $imagesPerRow ?> }
					//layoutMode: 'fitRows'
				});

				jQuery('#filters.module<?php echo $moduleID ?> a').removeClass('active');
				jQuery(this).toggleClass('active');

				return false;
			});

			// Filter tabs hidden by css and then shown after load
			jQuery('#filters.module<?php echo $moduleID ?> li a').show();

			<?php if ($filterstart !== "showall") { ?>
				// jQuery('#zentoolslist<?php echo $moduleID ?> li').css({'height' : '0','display':'none' });
				// jQuery('#zentoolslist<?php echo $moduleID ?> li.<?php echo $filterstart ?>').css({'height' : 'auto','display':'block'});
			<?php } ?>

			jQuery('#filters.module<?php echo $moduleID ?> li.<?php echo $filterstart ?>ID a').addClass("active");

			// Force a reLayout to fix unorganized content right after load
			//setTimeout(function () {jQuery('#zentoolslist<?php echo $moduleID ?>').isotope('reLayout')}, 150);
		});
	</script>
	<?php } ?>


	<?php if($layout == "accordion") { ?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#zentools<?php echo $moduleID ?> .firstitem').click(function() {

					jQuery('#zentools<?php echo $moduleID ?> .firstitem').removeClass('open');
					jQuery('#zentools<?php echo $moduleID ?> .allitems').slideUp(300);

					if(jQuery(this).next().is(':hidden') == true) {
						jQuery(this).addClass('open');
						jQuery(this).next().animate({
							height: 'toggle'
						});
					 }

				 });

				jQuery('#zentools<?php echo $moduleID ?> .allitems').hide();

				<?php if($params->get('accordionOpen')) { ?>
					jQuery('#zentools<?php echo $moduleID ?> li:first-child .firstitem').addClass('open');
					jQuery('#zentools<?php echo $moduleID ?> li:first-child .allitems').slideDown();
				<?php } ?>
			});
		</script>
	<?php } ?>


	<?php if($layout == "carousel") {

	$minItems= $params->get('minItems');
	$carouselSpeed= $params->get('carouselSpeed');
	$imageW= $params->get('imageW');

	?>
	<script type="text/javascript">
	jQuery('#zentools<?php echo $moduleID ?>').elastislide({
			minItems	: <?php echo $minItems; ?>,
			speed		: <?php echo $carouselSpeed; ?>,
			imageW		: <?php echo $imageW; ?>
	});
	</script>
	<?php } ?>

	<?php if ($link == 1) {
		$fancyTitle = $params->get('fancyTitle', 0);
		$fancyTitleType = $params->get('fancyTitleType', 'over');
		?>
		<script type="text/javascript">
			jQuery("#zentools<?php echo $moduleID ?> a.inline").fancybox({
				'hideOnContentClick': true,
				'autoDimensions': false,
				'width': <?php echo $modalWidth ?>,
				'height': <?php echo $modalHeight ?>,
				'centerOnScroll': true,
				'zoomOpacity': false,
				'padding': <?php echo $fancyPadding ?>,
				'overlayOpacity': <?php echo $fancyOverlay ?>,
				'overlayShow'			: <?php echo $fancyOverlayShow ?>,
				'zoomSpeedIn'			: 600,
				'zoomSpeedOut'			: 500,
				'showNavArrows'			: true,
				'hideOnContentClick'	: false,
				'scrolling'	: 'auto',
				'titlePosition': '<?php echo $fancyTitleType ?>',
				<?php if ($fancyTitle) { ?>
				'titleShow': true
				<?php } else { ?>
				'titleShow': false
				<?php } ?>
			});

			// jQuery("a.fancybox").attr('rel', 'gallery').fancybox();

		<?php // Load external urls in a iframe lightbox.
		if($altlink && $joomla25) { ?>
			jQuery("#zentools<?php echo $moduleID ?> a.iframe").fancybox({
				'hideOnContentClick': true,
				'autoDimensions': false,
				'width': '98%',
				'height': '98%',
				'centerOnScroll': true,
				'zoomOpacity': false,
				'padding': <?php echo $fancyPadding ?>,
				'overlayOpacity': <?php echo $fancyOverlay ?>,
				'overlayShow'			: <?php echo $fancyOverlayShow ?>,
				'zoomSpeedIn'			: 600,
				'zoomSpeedOut'			: 500,
				'showNavArrows'			: true,
				'hideOnContentClick'	: false,
				'titlePosition': '<?php echo $fancyTitleType ?>',
				<?php if ($fancyTitle) { ?>
				'titleShow': true
				<?php } else { ?>
				'titleShow': false
				<?php } ?>
			});
		<?php } ?>
		</script>
	<?php } ?>

	<?php if ($link == 2 || $link == 3) { ?>
		<script type="text/javascript">
			jQuery('#zentoolslist<?php echo $moduleID; ?> a[data-behavior="content"], #zentoolslist<?php echo $moduleID; ?> a[data-behavior="external"]').click(function(e) {
				e.preventDefault();
				window.location = jQuery(this).attr('href');
			});
		</script>
	<?php } ?>

	<?php if($imageFade) { 	?>
			<script type="text/javascript">
				jQuery('#zentools<?php echo $moduleID ?> img').fadeTo('fast', 1.0);
				jQuery('#zentools<?php echo $moduleID ?> img').hover(function(){
				jQuery(this).fadeTo('fast', 0.3);
					},function(){
						jQuery(this).fadeTo('fast', 1.0); // This should set the opacity back to 60% on mouseout
					});
			</script>
	<?php } ?>


	<?php if($params->get('layout') == "pagination") { ?>
	<script type="text/javascript">
	jQuery(function() {
		/* initiate plugin */
		jQuery("#paginationinner<?php echo $moduleID ?>").jPages({
			containerID  : "zentoolslist<?php echo $moduleID ?> li",
			perPage      : <?php echo $imagesPerRow ?>,
			startPage    : <?php echo $params->get('pagStartPage') ?>,
			startRange   : <?php echo $params->get('pagStartRange') ?>,
			midRange     : <?php echo $params->get('pagMidRange') ?>,
			endRange     : <?php echo $params->get('pagEndRange') ?>,
			previous     : "\u2190",
			next         : "\u2192",
		});
	});
	</script>
	<?php } ?>

	<?php
	$animateOverlay = $params->get('animateOverlay');
	$animateOverlayCarousel = $params->get('animateOverlayCarousel');

	if(($layout == "grid" && $animateOverlay) ||  ($layout == "carousel" && $animateOverlayCarousel)) { 	?>
		<script type="text/javascript">
		jQuery(document).ready(function(){


			var captionHeight = jQuery("#zentools<?php echo $moduleID ?> .allitems").innerHeight();

			jQuery("#zentools<?php echo $moduleID ?> .allitems").css({'bottom': '-' + captionHeight +'px','display': 'none'});

			jQuery('#zentools<?php echo $moduleID ?> li').hover(
				function(){
					jQuery(this).find('.allitems').show().animate({bottom:"0"}, 400);
				},
				function(){
					jQuery(this).find('.allitems').animate({bottom:'-' + captionHeight}, 100).fadeOut('slow');
				}
			);

			});
		</script>
		<?php }
		// Responsive Images just some standard breakpoints at this stage
		if($responsiveimages) {	?>
		<script type="text/javascript">
				Response.create({ mode: 'src',  prefix: 'src', breakpoints: [0,320,481,769,1025,1281] });
		</script>


		<?php } if($params->get('animateMoreOverlay')) {?>
		<script type="text/javascript">
		jQuery(document).ready(function(){

			var more = "#zentools<?php echo $moduleID ?> .zenmore";

			jQuery(more).hide().addClass("overlaymore");

			jQuery("#zentools<?php echo $moduleID ?> li").hover(
				function() {
				 jQuery(this).find(".zenmore").fadeIn();
			},
			function(){
				 jQuery(this).find(".zenmore").fadeOut();
			});

		});
		</script>
	<?php } ?>
<?php } ?>
