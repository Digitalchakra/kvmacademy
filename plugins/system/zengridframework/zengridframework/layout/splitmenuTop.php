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


if (file_exists(JPATH_ROOT."/templates/$this->template/layout/splitmenuTop.php"))
{
	require(JPATH_ROOT."/templates/$this->template/layout/splitmenuTop.php");
}
else {

	if ($splitMenuTest) {
		// Splitmenu: Get the first level of the menu "mainmenu"
			echo '<div id="splitmenu">';
				echo $zgf->getSplitMenu($splitMenuName, $splitMenuNavStart, $splitMenuNavEnd);
			echo '</div>';

			if ($splitMenuNav) {
			echo '<div id="subnav">';
			// Splitmenu: Get all but the first level of the menu "topmenu"
				echo $zgf->getSplitMenu($splitMenuName, $splitMenuSubNavStart, $splitMenuSubNavEnd);

			echo '</div>';
			}
		}
}
?>
