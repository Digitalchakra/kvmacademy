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
$count      =   $params->get('count');
$width1      =   $params->get('width');
$height      =   $params->get('height');
$width      =   100 / ($count);
$document->addStyleDeclaration('
	.kwicks li{
	    width: ' .  $width . '%;
	}
	.kwicks{
	    width:' .  $width1 . 'px;
	    height:' .  $height . 'px;
	}
');

?>
     <?php if (isset($images)) { ?>
    <ul  class="kwicks horizontal">
    <?php foreach ($images as $row) : ?>
        <li>
            <a href="<?php echo $row->link; ?>"> <img src="<?php echo $row->image; ?>" alt="image01" /></a>
            <h2><?php echo $row->title;?> </h2>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php  }  ?>

<script type="text/javascript">
    var tz = jQuery.noConflict();
        tz('.kwicks').kwicks({
                    min : 30,
                    spacing : <?php echo $space;?>,
                    isVertical: <?php echo $ver;?>,
                    sticky : <?php echo $stic;?>,
                    duration: <?php echo $duration;?>,
                    event : '<?php echo $event;?>',
                    easing: '<?php echo $effect; ?>'
				});
</script>
