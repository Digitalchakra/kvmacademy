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

class JElementBuffer extends JElement {
	var	$_name = 'buffer';
	function fetchElement($name, $value, &$node, $control_name){
		// Output
		return '
		<div style="font-weight:bold;font-size:14px;color:#333;padding:4px;margin:0;background:#eee">
			'.JText::_($value).'
		</div>
		';
	}
	function fetchTooltip($label, $description, &$node, $control_name, $name){
		// Output
		return '&nbsp;';
	}
}
