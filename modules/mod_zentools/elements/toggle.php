<?php
/**
 * @package		Zen Tools
 * @subpackage	Zen Tools
 * @author		Joomla Bamboo - design@joomlabamboo.com
 * @copyright 	Copyright (c) 2012 Joomla Bamboo. All rights reserved.
 * @license		GNU General Public License version 2 or later
 * @version		1.7.2
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class JElementToggle extends JElement {
	var	$_name = 'close';
	function fetchElement($name, $value, &$node, $control_name){
		// Output
		return '
		<div id="toggleWrap">
			<div id="toggleAll"><a href="#" class="btn btn-primary"><span>Toggle all options</span></a></div>
		</div>
		';
	}
	function fetchTooltip($label, $description, &$node, $control_name, $name){
		// Output
		return '&nbsp;';
	}
}
