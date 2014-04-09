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
 * Renders a radio element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JFormFieldZencache extends JFormField
{
	/**
	* Element type
	*
	* @access	protected
	* @var		string
	*/
	protected  $type = 'Zencache';

	protected function getInput()
	{
		$class = ($this->element['class'] ? 'class="'.$this->element['class'].'"' : '');

		$options = $this->getOptions();

		$html = '<fieldset id="" class="radio">';
		$html .= '<input type="button" class="clearCacheButton" onclick="zenClearCache(this, \''.$this->element['section'].'\', \''.JText::_('ZENCLEARCACHE_WAIT').'\', \''.JText::_('ZENCLEARCACHE_DONE').'\', \''.JText::_('ZENCLEARCACHE_ERROR').'\', \''.JText::_('ZENCLEARCACHE_NOCACHE').'\');" value="'.JText::_('ZENCLEARCACHE').'" />';
		$html .= '</fieldset>';

		return $html;
	}

	/**
	 * Method to get the field options for radio buttons.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		// Initialize variables.
		$options = array();

		foreach ($this->element->children() as $option) {

			// Only add <option /> elements.
			if ($option->getName() != 'option') {
				continue;
			}

			// Create a new option object based on the <option /> element.
			$tmp = JHtml::_('select.option', (string) $option['value'], JText::_(trim((string) $option)), 'value', 'text', ((string) $option['disabled'] == 'true'));

			// Set some option attributes.
			$tmp->class = (string) $option['class'];

			// Set some JavaScript option attributes.
			$tmp->onclick = (string) $option['onclick'];

			// Add the option object to the result set.
			$options[] = $tmp;
		}

		reset($options);

		return $options;
	}

	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
		return false;
	}
}
