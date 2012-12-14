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

class JElementZentabclose extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/

	var	$_name = 'Zentabclose';

	function fetchElement($name, $value, &$node, $control_name)
	{
		return '</table></div></div><div id="overlay"></div><table><tr><td>';
	}

	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
		return false;
	}
}
?>
