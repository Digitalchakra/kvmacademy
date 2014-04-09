<?php
/**
 * @package Xpert Accordion
 * @version 1.0
 * @author ThemeXpert http://www.themexpert.com
 * @copyright Copyright (C) 2009 - 2011 ThemeXpert
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */
// no direct access
defined( '_JEXEC' ) or die('Restricted access');

$count = count($list);
$i = 0;

?>
    <!--Xpert Accordion by ThemeXpert- Start-->
   <div id="<?php echo $module_id;?>" class="xac-wrapper <?php echo $params->get('style');?>">
   <?php foreach($lists as $item):?>
       <h3 class="xac-trigger">
           <span><?php echo $item->title;?></span>
       </h3>
       <div class="xac-container">
           <?php echo $item->introtext;?>
       </div>
   <?php endforeach ;?>
   </div>
   <!--Xpert Accordion by ThemeXpert- End-->

