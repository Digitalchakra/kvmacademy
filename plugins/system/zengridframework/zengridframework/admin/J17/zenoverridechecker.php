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




class JFormFieldZenoverridechecker extends JFormField
{


	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/

	protected $type = 'zenoverridechecker';

	protected function getInput()
	{
		$app = JFactory::getApplication();
		$zgf = ZenGrid::getInstance();
		$template = $zgf->getTemplateName();

		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;
		if ($zgfEnabled) {
			$class          = (string) $this->element['class'];

			//require_once(JPATH_ROOT . '/templates/zengridframework/admin/classes/zengrid.php');
			$style = $zgf->getParam('style');
			$path =  JPATH_ROOT . '/templates/' . $template . '/layout/';

			if (file_exists($path.$this->fieldname.".php")) { $html = '<span class="overrideStatus found">'.JText::_('ZENOVERRIDEAVAILABLE').'</span>';  }
			else { $html = '<span class="overrideStatus notfound"> '.JText::_('ZENOVERRIDENOTFOUND').'</span>'; }

			$options = array();
			$options[] = JHTML::_('select.option', '1', JText::_('ZENENABLED'));
			$options[] = JHTML::_('select.option', '0', JText::_('ZENDISABLED'));

			return '<div class="overrideRow ' . $class . '">'.JHTML::_('select.radiolist', $options, $this->name, '', 'value', 'text', $this->value, $this->id) . $html . '</div>';
		}
	}

}
