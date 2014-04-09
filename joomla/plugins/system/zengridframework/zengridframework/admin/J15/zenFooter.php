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
 * Renders a text element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JElementZenFooter extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'zenFooter';


		function fetchElement($name, $value, &$node, $control_name)
		{


		//	Placeholder element used in templates in case we want to add a footer at some stage.;
		}

		function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
			return false;
		}
}
