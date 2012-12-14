<?php
/**
 * @package		Zen Tools
 * @subpackage	Zen Tools
 * @author		Joomla Bamboo - design@joomlabamboo.com
 * @copyright 	Copyright (c) 2012 Joomla Bamboo. All rights reserved.
 * @license		GNU General Public License version 2 or later
 * @version		1.7.2
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
class JElementCheckbox extends JElement
{
   var   $_name = 'Checkbox';

   function fetchElement($name, $value, &$node, $control_name)
   {
   			$html = '<input type="checkbox" name="' . $name . '" value="' . $value . '" id="' . $name . '" />';
	      	$html .= '&nbsp;<label for="' . $name . '">' . $name . '</label>';
	$html .='' . $value . '';
			return $html;
	}
}
