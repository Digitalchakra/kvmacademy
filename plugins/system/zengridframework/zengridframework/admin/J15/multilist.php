<?php
/**
 * @package		Joomla Bamboo Zen Grid Framework
 * @Type        Core Framework Files
 * @version		v1.2
 * @author		Joomal Bamboo http://www.joomlabamboo.com
 * @copyright 	Copyright (C) 2007 - 2010 Joomla Bamboo
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

// no direct access
defined('_JEXEC') or die('Restricted index access');

/**
 * Renders a multiple item select element
 *
 */

class JElementMultiList extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'MultiList';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;
		if ($zgfEnabled) {
			// Base name of the HTML control.
			$ctrl	= $control_name .'['. $name .']';

			// Construct an array of the HTML OPTION statements.
			$options = array ();
			foreach ($node->children() as $option)
			{
				$val	= $option->attributes('value');
				$text	= $option->data();
				$options[] = JHTML::_('select.option', $val, JText::_($text));
			}

			// Construct the various argument calls that are supported.
			$attribs	= ' ';
			if ($v = $node->attributes('size')) {
				$attribs	.= 'size="'.$v.'"';
			}
			if ($v = $node->attributes('class')) {
				$attribs	.= 'class="'.$v.'"';
			} else {
				$attribs	.= 'class="inputbox"';
			}
			if ($m = $node->attributes('multiple'))
			{
				$attribs	.= ' multiple="multiple"';
				$ctrl		.= '[]';
			}

			// Render the HTML SELECT list.
			return JHTML::_('select.genericlist', $options, $ctrl, $attribs, 'value', 'text', $value, $control_name.$name);
		}
	}
}
?>
