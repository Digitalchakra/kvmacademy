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
 * Renders a editors element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementZenoverridechecker extends JElement
{


	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/

	var	$_name = 'Zenoverridechecker';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$app = JFactory::getApplication();
		$zgf = ZenGrid::getInstance();
		$template = $zgf->getTemplateName();

		$zgf = ZenGrid::getInstance();
		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;
		if ($zgfEnabled) {

			$style = $zgf->getParam('style');
			$path =  JPATH_ROOT . '/templates/' . $template . '/layout/';
			$class = $node->attributes('class') ? 'class="' . $node->attributes('class') . '"' : '';

			if (file_exists($path.$name.".php")) { $html = '<img src="images/tick.png" /> '.JText::_('ZENOVERRIDEAVAILABLE').'';  }
			else { $html = '<img src="images/publish_x.png" />'.JText::_('ZENOVERRIDENOTFOUND').''; }

			$options = array();
			$options[] = JHTML::_('select.option', '1', JText::_('Enabled'));
			$options[] = JHTML::_('select.option', '0', JText::_('Disabled'));

			return JHTML::_('select.radiolist', $options, ''.$control_name.'['.$name.']', $class, 'value', 'text', $value, $control_name.$name) . $html;
		}
	}

}
?>
