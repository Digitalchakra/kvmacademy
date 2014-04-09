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

$zgf = ZenGrid::getInstance();

if (file_exists(JPATH_ROOT."/templates/$this->template/layout/splitmenuSidebar.php"))
{
	require(JPATH_ROOT."/templates/$this->template/layout/splitmenuSidebar.php");
}
else
{
	// Splitmenu: Get all but the first level of the menu "topmenu"
	$main_menu = $zgf->getSplitMenu($splitMenuName, 1, 9);

	if ($main_menu) {
		echo '<div id="jbSplitMenu">';
			echo '<h3><span>';
				echo $splitMenuTitle;
			echo '</span></h3>';


		echo $main_menu;
		echo '</div>';
	}
}