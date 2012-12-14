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

class JFormFieldZenMainContentNav extends JFormField
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/

	protected $type = 'zenmaincontentnav';

	protected function getInput()
	{
		$zgf = ZenGrid::getInstance();
		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;

		if ($zgfEnabled) {

			// include the config file for this template. The settings in the config file determine the menu items that are displayed in the back end.
			$template = $zgf->getTemplateName();
			require(JPATH_ROOT.'/templates/'.$template.'/includes/config.php');


									$nav = '<div class="maincontentnav"><ul>';
		 if ($centerConfig) {		$nav .= '<li><a href="#2.15" onclick="accordion.display(15)">Center</a></li>';  }
		 if ($twocolsLConfig) {		$nav .= '<li><a href="#2colL">2 Cols L</a></li>';  }
		 if ($twocolsRConfig) {		$nav .= '<li><a href="#2colR">2 Cols R</a></li>';  }
		 if ($threecolsConfig) {	$nav .= '<li><a href="#3col">3 Cols</a></li>';  }
		 if ($fourcolsConfig) {		$nav .= '<li><a href="#4col">4 Cols</a></li>';  }
		 if ($threecolsLCConfig) {	$nav .= '<li><a href="#3colLC">3 Cols L + C</a></li>';  }
		 if ($threecolsCRConfig) {	$nav .= '<li><a href="#3colRC">3 Cols C + R</a></li>';  }
		 if (!$mainConfig && !$centerConfig || !$twocolsLConfig || !$twocolsRConfig || !$threecolsConfig || !$fourcolsConfig || !$threecolsLCConfig || !$threecolsCRConfig){
									$nav .= '<li><a style="display:none" href="#">Dummy</a></li>';
		}
									$nav .='</ul></div>';
		return $nav;
	}

	}

		public function getLabel() {
			return '<span class="hideLabel">' . parent::getLabel() . '</span>';
		}

}
