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

class JElementZenmaincontentnav extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/

	var	$_name = 'Zenmaincontentnav';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$zgf = ZenGrid::getInstance();
		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;
		if ($zgfEnabled) {

			$template = $zgf->getTemplateName();
			require(JPATH_ROOT.'/templates/'.$template.'/includes/config.php');

			// include the config file for this template. The settings in the config file determine the menu items that are displayed in the back end.



											$nav = '<div class="maincontentnav"><ul>';
				 if ($centerConfig) {		$nav .= '<li><a href="#2.15" onclick="accordion.display(15)">Center</a></li>';  }
				 if ($twocolsLConfig) {		$nav .= '<li><a href="#2.16" onclick="accordion.display(16)">2 Cols L</a></li>';  }
				 if ($twocolsRConfig) {		$nav .= '<li><a href="#2.17" onclick="accordion.display(17)">2 Cols R</a></li>';  }
				 if ($threecolsConfig) {	$nav .= '<li><a href="#2.18" onclick="accordion.display(18)">3 Cols</a></li>';  }
				 if ($fourcolsConfig) {		$nav .= '<li><a href="#2.19" onclick="accordion.display(19)">4 Cols</a></li>';  }
				 if ($threecolsLCConfig) {	$nav .= '<li><a href="#2.20" onclick="accordion.display(20)">3 Cols L + C</a></li>';  }
				 if ($threecolsCRConfig) {	$nav .= '<li><a href="#2.21" onclick="accordion.display(21)">3 Cols C + R</a></li>';  }
											$nav .= '</ul></div>';

											return $nav;
			}
		}
			function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
				return false;
		}

}
?>
