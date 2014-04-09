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
class JElementZendiagnostics extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'Zendiagnostics';
	function fetchElement($name, $value, &$node, $control_name)
	{
		$zgf = ZenGrid::getInstance();
		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;

		if ($zgfEnabled) {

			global $mainframe;
			$controlMainArea = $zgf->getParam('controlMainArea');
			$zen->logoType = $zgf->getParam('logoType');

			$superfish = $zgf->getParam('superfish');
			$splitmenu = $zgf->getParam('splitMenu');
			$splitMenuNavPos = $zgf->getParam('splitMenuNavPos');
			$csscompress = $zgf->getParam('csscompress');
			$jQuery = $zgf->getParam('jQueryVersion');

			$style = $zgf->getParam('style');

			$oldframework = JPATH_SITE . '/templates/zengridframework/index.php';


			$html = '';
			$html .= '<h3 class="toggler atStart"></h3><div class="element atStart"></div>';
			$html .= '<div class="diagnostics">';
			$html .='<span class="diagnosticsoverview">'.JText::_('ZENDIAGNOSTICSDESCRIPTION').'</span>';
			$html .='<ul>';

			if ($jQuery == "none") {

				$html .= '<li><span class="warning important">'.JText::_("ZENJQUERYDISABLEDWARNING").'</span></li>';
			}

			if ($controlMainArea) {
				$mainAreaWarning = "<li><span class='warning'>".JText::_('ZENPLEASENOTETHATYOURMAINCONTENTAREAISHIDDENONTHEFRONTPAGE').'&nbsp;'.JText::_('ZENYOUCANCHANGETHATSETTING')."<a href='#' onclick='accordion.display(12)'>".JText::_('ZENHERE')."</a></span></li>";

				$html .= ''. $mainAreaWarning.'<br />';
			}

			if ($superfish && $splitmenu && $splitMenuNavPos == "menu") {

				$html .= '<li><span class="warning">'.JText::_("ZENSUPERFISHWARNING").'</span></li>';
			}
			if ($csscompress) {

				$html .= '<li><span class="warning">'.JText::_("ZENCSSCOMPRESSWARNING").'</span></li>';
			}

			if (file_exists($oldframework)) {
					$html .= '<li><span class="warning">'.JText::_("ZENOLDFRAMEWORKWARNING").'</span></li>';
			}
			$html .= '</ul>';
			$html .= '</div>';

			return $html;
		}


		function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
			return false;
		}
	}
}
?>
