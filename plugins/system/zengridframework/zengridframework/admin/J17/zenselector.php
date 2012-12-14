<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

// no direct access
defined('_JEXEC') or die('Restricted index access');

/**
 * Renders a list element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JFormFieldZenselector extends JFormField
{
	/**
	* Element type
	*
	* @access	protected
	* @var		string
	*/
protected  $type = 'Zenselector';

 protected function getInput()
{
		$class = ($this->element['class'] ? 'class="'.$this->element['class'].'"' : 'class="inputbox"');

		$values = array('color' => 'Color', 'border-color' => 'Border-color', 'background-color' => 'Background Color');

		$options = array ();
		foreach ($values as $val => $text)
		{
			$options[] = JHTML::_('select.option', $val, JText::_($text));
		}

		return JHTML::_('select.genericlist',  $options, $this->name, $class, 'value', 'text', $this->value, $this->id);
	}
}
