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
jimport('joomla.html.html');
jimport('joomla.form.formfield');

/**
 * Renders a editors element
 *
 * @package 	Joomla.Framework
 * @subpackage		Form
 * @since		1.6
 */

class JFormFieldZenGrid extends JFormField
{
	/**
	* Element type
	*
	* @access	protected
	* @var		string
	*/
	protected $type = 'zengrid';

	protected function getInput()
	{
		$class = ($this->element['class'] ? 'class="'.$this->element['class'].'"' : 'class="inputbox"');

		$values = array('two' => '2', 'three' => '3', 'four' => '4', 'five' => '5', 'six' => '6', 'seven' => '7', 'eight' => '8', 'nine' => '9', 'ten' => '10', 'eleven' => '11', 'twelve' => '12', 'thirteen' => '13', 'fourteen' => '14', 'sixteen' => '16');

		$options = array ();
		foreach ($values as $val => $text)
		{
			$options[] = JHTML::_('select.option', $val, JText::_($text));
		}

		return JHTML::_('select.genericlist',  $options, $this->name, $class, 'value', 'text', $this->value, $this->id);
	}
}
