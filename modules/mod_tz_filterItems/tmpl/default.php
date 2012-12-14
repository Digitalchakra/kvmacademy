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
$url = JURI::base();
$document   =   &JFactory::getDocument();
$document->addStyleSheet('modules/mod_tz_filterItems/css/tz_filter.css');
if($load == 1){
$document->addScript('modules/mod_tz_filterItems/js/jquery-1.6.4.min.js');
} elseif ($load == 0) {
}
?>
<script type="text/javascript" src="<?php echo $url;?>modules/mod_tz_filterItems/js/mobilyselect.js"></script>
<?php if ($choocontent == 1) { ?>
<div class="itemList selecter">
<div class="selecterBtns">
    <ul id="portfolio_category_sorter">
        <li class="sorter_title">Filter By Category :</li>
        <li><a class="active" rel="all" href="#">All</a></li>
        <?php
            $db			=& JFactory::getDBO();
            $query = "select  * from #__k2_categories where id IN ($sql)";
            $db->setQuery($query);
            $items = $db->loadObjectList();
        if(isset($items)){
        foreach ($items as $item):
        ?>
        <li><a rel="items<?php echo $item->id; ?>" href="#"><?php echo $item->name; ?></a></li>
        <?php endforeach; } ?>
    </ul>
    <!-- end selecter_buttons -->
</div>
<?php if(isset($list)){ ?>
<div class="selecterContent" id="itemListPrimary">
    <ul>
        <?php foreach ($list as $item): ?>
        <li style="width: 25%; position: relative;" class="items<?php echo $item->catid; ?> itemContainer ">

            <!-- Start K2 Item Layout -->
            <div class="catItemView groupPrimary ">
                <div class="boxgrid slideleft ">
                    <img alt="" src="<?php echo $item->image; ?>" class="cover">
                    <div class="content-item" style="display: none;">
                        <div class="catItemHeader">
                            <!-- Item title -->
                            <h3 class="catItemTitle">
                                <a href="<?php echo $item->link; ?>">
                                    <?php echo $item->title; ?>
                                </a>
                            </h3>
                        </div>
                        <div class="catItemBody">
                            <?php
                                $subject='';
                                $subject .= $item->introtext;
                                $subject .= $item->fulltext;
                                $pattern = '/<img.*?src="(.*?)".*?\/>/i';
                                preg_match_all ($pattern,$subject,$match) ;
                                $countimg = count($match);
                            $intro = preg_replace($pattern,'',$item->introtext);
                            $introtext = substr(strip_tags($intro),0,$limit);
                              ?>
                            <div class="catItemIntroText">
                               <p> <?php echo $introtext; ?>...</p>
                            </div>

                              <?php for ($i=0; $i < $countimg; $i++){ ?>
                                 <a style="" href="<?php echo $match[1][$i]; ?>" rel="prettyPhoto[gal<?php echo $item->kid;?>]"> </a>
                            <?php } ?>

                            <div class="clr"></div>
                        </div>

                        <div class="clr"></div>
                        <div class="catItemReadMore">
                            <a href="<?php echo $item->link; ?>"
                               class="k2ReadMore">
                                Read more... </a>
                            <a rel="prettyPhoto[gal<?php echo $item->kid;?>]"
                               href="<?php echo $item->imageLarge; ?>"
                               class="photo"></a>
                            <div class="clr"></div>
                        </div>

                        <div class="clr"></div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
        <div class="clear"></div>
    </ul>
</div>
<?php } ?>
</div>
<?php } if ($choocontent==0) { ?>
    <div class="itemList selecter">
<div class="selecterBtns">
    <ul id="portfolio_category_sorter">
        <li class="sorter_title">Filter By Category :</li>
        <li><a class="active" rel="all" href="#">All</a></li>
        <?php
            $db			=& JFactory::getDBO();
            $query = "select  * from #__categories where id IN ($sqlcontent)";
            $db->setQuery($query);
            $items = $db->loadObjectList();
        if(isset($items)){
        foreach ($items as $item):
        ?>
        <li><a rel="items<?php echo $item->id; ?>" href="#"><?php echo $item->title; ?></a></li>
        <?php endforeach; }?>
    </ul>
    <!-- end selecter_buttons -->
</div>
<?php if(isset($list)){ ?>
<div class="selecterContent" id="itemListPrimary">
    <ul>
        <?php foreach ($list as $item): ?>
        <li style="width: 25%; position: relative;" class="items<?php echo $item->catid; ?> itemContainer ">

            <!-- Start K2 Item Layout -->
            <div class="catItemView groupPrimary ">
                <div class="boxgrid slideleft ">
                    <?php $subject = '';
                        $subject .= $item->introtext;
                        $subject .= $item->fulltext;
                        //die ($subject);
                        $pattern = '/<img.*?src="(.*?)".*?\/>/i';
                        preg_match ($pattern,$subject,$match) ;
                        $intro = preg_replace($pattern,'',$item->introtext);
                        $introtext = substr(strip_tags($intro),0,$limit);
                    ?>
                    <?php if(isset($match[1])) {?>
                        <img alt="" src="<?php echo $match[1];?>" class="cover">
                    <?php } ?>
                    <div class="content-item" style="display: none;">
                        <div class="catItemHeader">
                            <!-- Item title -->
                            <h3 class="catItemTitle">
                                <a href="<?php echo $item->link; ?>">
                                    <?php echo $item->title; ?>
                                </a>
                            </h3>
                        </div>
                        <div class="catItemBody">
                            <div class="catItemIntroText">
                                <p> <?php echo $introtext; ?>...</p>
                            </div>
                            <?php
                                preg_match_all ($pattern,$subject,$match) ;
                                $countimg = count($match);
                              ?>
                              <?php for ($i=0; $i < $countimg; $i++){ ?>
                                 <a style="" href="<?php echo $match[1][$i]; ?>" rel="prettyPhoto[gal<?php echo $item->cid;?>]"> </a>
                            <?php } ?>

                            <div class="clr"></div>
                        </div>

                        <div class="clr"></div>
                        <div class="catItemReadMore">
                            <a href="<?php echo $item->link; ?>"
                               class="k2ReadMore">
                                Read more... </a>
                            <a rel="prettyPhoto[gal<?php echo $item->cid;?>]"
                               href="<?php echo $match[1][0];?>"
                               class="photo"></a>
                            <div class="clr"></div>
                        </div>

                        <div class="clr"></div>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
        <div class="clear"></div>
    </ul>
</div>
<?php }?>
</div>
 <?php } ?>
<script type="text/javascript">
    var $tz_t = jQuery.noConflict();
     $tz_t('.boxgrid').hover(function(){
			$tz_t(this).find('.content-item').fadeIn(800);
			$tz_t(this).find('img.cover').animate({opacity: 0.5}, 800);
		},
		function(){
			$tz_t(this).find('.content-item').fadeOut(800);
			$tz_t(this).find('img.cover').animate({opacity: 1}, 800);
		}
		);

        $tz_t('.selecter').mobilyselect({
                collection: 'all',
                animation: 'absolute',
                duration: 500,
                listClass: 'selecterContent',
                btnsClass: 'selecterBtns',
                btnActiveClass: 'active',
                elements: 'li',
                onChange: function(){},
                onComplete: function(){}
            });
</script>