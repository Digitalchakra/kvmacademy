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

class JElementZentabs extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/

	var	$_name = 'zentabs';



	function fetchElement($name, $value, &$node, $control_name)
	{
		$zgf = ZenGrid::getInstance();

		// Include zen grid
		//jimport('joomla.plugin.helper');
		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;

		if ($zgfEnabled) {

			JHTML::_('behavior.tooltip');

			//require_once(JPATH_ROOT.'/plugins/system/zengridframework/admin/classes/zengrid.php');
			$template = $zgf->getTemplateName();


			// Loads the global Zen Grid Framework Language File
			$zgf->loadLanguage();

			// include the config file for this template. The settings in the config file determine the menu items that are displayed in the back end.
			require_once(JPATH_ROOT.'/templates/'.$template.'/includes/config.php');

			// include the config file for this template. The settings in the config file determine the menu items that are displayed in the back end.
			//if ($cleanCache) {
			//		require_once(JPATH_ROOT.'/templates/zengridframework/admin/assets/clearcache.php');
			//}
			$firstcolor = $zgf->getParam('firstcolor');
			$secondcolor = $zgf->getParam('secondcolor');
			$thirdcolor = $zgf->getParam('thirdcolor');
			$fourthcolor = $zgf->getParam('fourthcolor');
			$fifthcolor = $zgf->getParam('fifthcolor');
			$sixthcolor = $zgf->getParam('sixthcolor');
			$logoColor = $zgf->getParam('logoColour');
			$allEqual = $zgf->getParam('allEqual');

				ob_start();	?>

					<style>
						#imgfirstcolor{background: #<?php echo $firstcolor ?>}
						#imgsecondcolor{background: #<?php echo $secondcolor ?>}
						#imgthirdcolor{background: #<?php echo $thirdcolor ?>}
						#imgfourthcolor{background: #<?php echo $fourthcolor ?>}
						#imgfifthcolor{background: #<?php echo $fifthcolor ?>}
						#imglogoColour{background: #<?php echo $logoColor ?>}
					</style>

				<script type="text/javascript" src="<?php echo JURI::root(true) ?>/plugins/system/zengridframework/admin/js/jquery-1.8.2.min.js"></script>
				<script type="text/javascript" src="<?php echo JURI::root(true) ?>/plugins/system/zengridframework/admin/js/tabs.js"></script>
				 <script type="text/javascript">
					jQuery.noConflict();

					jQuery(window).load(function () {
						jQuery("#element-box").fadeIn('slow');
					});

					window.addEvent('domready', function() {
						var zgfContainer = $('content-box');
						var wSize = window.getSize();
						var zcLeft = (wSize.x - 920)/2;
						zgfContainer.setStyle('position', 'absolute');
						zgfContainer.setStyle('top', '-10px');
						zgfContainer.setStyle('left', zcLeft);
					});
					window.addEvent('resize', function(){
						var zgfContainer = $('content-box');
						var wSize = window.getSize();
						var zcLeft = (wSize.x - 920)/2;
						zgfContainer.setStyle('position', 'absolute');
						zgfContainer.setStyle('top', '-10px');
						zgfContainer.setStyle('left', zcLeft);
					});
					jQuery(document).ready(function() {
						jQuery('#topColour, #toolbar-title, #header-box, #border-top').css({ 'opacity' : 0.1, 'display': 'block' });
					});

					<?php if (($allEqual = $zgf->getParam('allEqual')) && $zgf->getParam('logoPosition') == "above") { ?>
						jQuery(document).ready(function() {
							jQuery("#paramslogoWidth-lbl").html("Logo width <br /> <a href='#2.12' onclick='accordion.display(12)'>Setting overriden by Equalise all module positions</a>");
						});
					<?php } ?>
				</script>

			<div id="actionToolbar">
				<a href="#" onclick="javascript: submitbutton('save')" class="toolbar"><span class="save" title="Save">Save</span></a>
				<a href="#" onclick="javascript: submitbutton('apply')" class="toolbar"><span class="apply" title="Apply">Apply</span></a>
				<a href="#" onclick="javascript: submitbutton('cancel')" class="toolbar"><span class="cancel" title="Close">Close</span></a>
			</div>

			<div id="jbtabs">

				<dl class="toptabs" id="myPane">

			<!--Appearance-->
			<?php if ($overviewConfig || $diagnosticsConfig  || $languagesConfig  || $documentationConfig  || $modulepositionsConfig  || $rebrandingConfig) {?>
			<dt id="overview">
					<a href="#0.0" id="overviewtab" onclick="accordion.display(0)">
						<span class="overview"><?php  echo JText::_("OVERVIEWTAB") ?></span>
					</a>
			</dt>
				<dd>
					<ul class="sub">
						<?php if ($overviewConfig) {?><li><a href="#0.0" class="overview"  onclick="accordion.display(0)"><?php  echo JText::_("OVERVIEWTAB") ?></a></li><?php } ?>
						<?php if ($diagnosticsConfig) {?><li><a href="#0.1" class="overview"  onclick="accordion.display(1)"><?php  echo JText::_("DIAGNOSTICSTAB") ?></a></li><?php } ?>
						<?php if ($languagesConfig) {?><li><a href="#0.3" class="overview"  onclick="accordion.display(3)"><?php  echo JText::_("LANGUAGETAB") ?></a></li><?php } ?>
						<?php if ($documentationConfig) { ?><li><a href="#0.4" class="overview"  onclick="accordion.display(4)"><?php  echo JText::_("DOCUMENTATIONTAB") ?></a></li><?php } ?>
						<?php if ($modulepositionsConfig) {?><li><a  class="positions"  onclick="accordion.display(36)" href="#0.36"><?php  echo JText::_("MODULEPOSITIONS") ?></a></li><?php } ?>
						<?php if ($rebrandingConfig) {?><li><a href="#0.5" onclick="accordion.display(5)"><?php  echo JText::_("REBRANDINGTAB") ?></a></li><?php } ?>
					</ul>
				</dd>
				<?php } ?>
				<?php if ($styleConfig  || $logoConfig  || $taglineConfig  || $fontsConfig  || $cssoverridesConfig) {?>
				<dt id="appearance">
					<a href="#1.0" onclick="accordion.display(6)">
						<span class="appearance"><?php  echo JText::_("APPEARANCETAB") ?></span>
					</a>
				</dt>
				<dd>
					<ul class="sub">
						<?php if ($styleConfig) {?><li><a href="#1.6" onclick="accordion.display(6)"><?php  echo JText::_("STYLETAB") ?></a></li><?php } ?>
						<?php if ($styleConfig) {?><li><a href="#1.7" onclick="accordion.display(7)"><?php  echo JText::_("CUSTOMSTYLE") ?></a></li><?php } ?>
						<?php if ($logoConfig) {?><li><a href="#1.8" onclick="accordion.display(8)"><?php  echo JText::_("LOGOTAB") ?></a></li><?php } ?>
						<?php if ($taglineConfig) {?><li><a href="#1.9" onclick="accordion.display(9)"><?php  echo JText::_("TAGLINETAB") ?></a></li><?php } ?>
						<?php if ($fontsConfig) {?><li><a href="#1.10" onclick="accordion.display(10)"><?php  echo JText::_("FONTSTAB") ?></a></li><?php } ?>
						<?php if ($bodyclassConfig) {?><li><a href="#1.11" onclick="accordion.display(11)"><?php  echo JText::_("BODYCLASSTAB") ?></a></li><?php } ?>
					</ul>
				</dd>
				<?php } ?>
				<?php if ($settingsConfig  || $topConfig  || $headerConfig  ||$menuConfig  || $grid1Config  || $mainConfig  || $grid2Config  ||$bottomConfig  || $footerConfig  || $overridesConfig) {?>
				<dt id="Layout">
					<!---Layout-->
					<a href="#2.12" class="layout" onclick="accordion.display(12)">
						<span class="layout"><?php  echo JText::_("LAYOUTTAB") ?></span>
					</a>
				</dt>
				<dd>
					<ul class="sub">
					<?php if ($settingsConfig) {?><li><a href="#2.12" class="layout" onclick="accordion.display(12)"><?php  echo JText::_("SETTINGSTAB") ?></a></li><?php } ?>
					<?php if ($mobileConfig) {?><li><a href="#2.37" class="layout" onclick="accordion.display(37)"><?php  echo JText::_("MOBILETAB") ?></a></li><?php } ?>
					<?php if ($mainConfig) {?>	<li><a class="submain" href="#2.15" onclick="accordion.display(15)"><?php  echo JText::_("MAINTAB") ?></a></li><?php } ?>
					<?php if ($menuConfig) {?>	<li><a class="subnav" href="#2.14" onclick="accordion.display(14)"><?php  echo JText::_("MENUTAB") ?></a></li><?php } ?>
					<?php if ($allEqual) {
						  if ($widthsConfig) {?><li><a class="subtop inactive hasTip" href="#2.12" title="Disabled::<?php echo JText::_("ZENMENUDISABLED") ?>"><?php  echo JText::_("LAYOUTWIDTHSTAB") ?></a></li><?php } ?>
					<?php }	else { ?>
					<?php if ($widthsConfig) {?>	<li><a class="subtop" href="#2.13" onclick="accordion.display(13)"><?php  echo JText::_("LAYOUTWIDTHSTAB") ?></a></li><?php } ?>
					<?php } ?>
					<?php if ($overridesConfig) {?>	<li><a href="#2.22" onclick="accordion.display(22)"><?php  echo JText::_("OVERRIDESTAB") ?></a></li><?php } ?>
				</ul>
			</dd>
			<?php } ?>

			<!--Menus-->
			<?php if ($superfishmenuConfig  || $panelmenuConfig  || $splitmenuConfig) {?>
				<dt id="menus">
				<a href="#3.23" onclick="accordion.display(23)"><span class="menus"><?php  echo JText::_("MENUSTAB") ?></span></a>
			</dt>
			<dd>
				<ul class="sub">
			<?php if ($menuConfig) {?>	<li><a class="subnav" href="#2.14" onclick="accordion.display(14)"><?php  echo JText::_("MENULAYOUTTAB") ?></a></li><?php } ?>
			<?php if ($superfishmenuConfig) {?>		<li><a href="#3.23" onclick="accordion.display(23)"><?php  echo JText::_("SUPERFISHTAB") ?></a></li><?php } ?>
			<?php if ($panelmenuConfig) {?>		<li><a href="#3.24" onclick="accordion.display(24)"><?php  echo JText::_("PANELTAB") ?></a></li><?php } ?>
			<?php if ($splitmenuConfig) {?>		<li> <a href="#3.25" onclick="accordion.display(25)"><?php  echo JText::_("SPLITTAB") ?></a> </li><?php } ?>
				</ul>
			</dd>
			<?php } ?>

			<!--Tools -->
				<?php if ($hiddenpanelConfig  || $tabbedmodulesConfig  || $carouselConfig  || $slideshowConfig  || $effectsConfig) {?>
					<dt id="Extras">
					<a href="#4.31" onclick="accordion.display(31)"><span class="tools"><?php  echo JText::_("ELEMENTSTAB") ?></span></a>
				</dt>
				<dd>
					<ul class="sub">
					<?php if ($hiddenpanelConfig) {?>	<li><a href="#4.31" onclick="accordion.display(31)"><?php  echo JText::_("HIDDENPANELTAB") ?></a></li><?php } ?>
					<?php if ($tabbedmodulesConfig) {?>	<li><a href="#4.32" onclick="accordion.display(32)"><?php  echo JText::_("TABSTAB") ?></a></li><?php } ?>
					<?php if ($socialiconsConfig) {?>	<li><a href="#4.33" onclick="accordion.display(33)" ><?php  echo JText::_("SOCIALICONSTAB") ?></a></li><?php } ?>
					<?php if ($slideshowConfig) {?><li><a href="#4.34" onclick="accordion.display(34)"><?php  echo JText::_("SLIDESHOWTAB") ?></a></li><?php } ?>
					<?php if ($effectsConfig) { ?>	<li><a href="#4.35" onclick="accordion.display(35)"><?php  echo JText::_("EFFECTSTAB") ?></a></li><?php } ?>
					</ul>
				</dd><!--=Documentation-->
				<?php } ?>

			<!--Settings-->
			<?php if ($performanceConfig  || $tweaksConfig  || $analyticsConfig  || $extrascriptsConfig  || $pngfixConfig || $css3 || $ie6warningConfig) {?>
			<dt id="Extras">
					<a href="#4.26" onclick="accordion.display(26)"><span class="settings"><?php  echo JText::_("TOOLSTAB") ?></span></a>
			</dt>
			<dd>
				<ul class="sub">
				<?php if ($performanceConfig) {?>	<li><a href="#4.26" onclick="accordion.display(26)"><?php  echo JText::_("SCRIPTSTAB") ?></a></li><?php } ?>
				<?php if ($tweaksConfig) {?>	<li><a href="#4.27" onclick="accordion.display(27)"><?php  echo JText::_("JOOMLATAB") ?></a></li><?php } ?>
				<?php if ($analyticsConfig) {?>	<li><a href="#4.28" onclick="accordion.display(28)"><?php  echo JText::_("ANALYTICSTAB") ?></a></li><?php } ?>
				<?php if ($extrascriptsConfig) {?>	<li><a href="#4.29" onclick="accordion.display(29)"><?php  echo JText::_("EXTRASCRIPTSTAB") ?></a></li><?php } ?>
					<li><a href="#4.38" onclick="accordion.display(38)"><?php  echo JText::_("COOKIESTAB") ?></a></li>
				<?php if ($pngfixConfig) {?>	<li><a href="#4.30" onclick="accordion.display(30)"><?php  echo JText::_("IE6TAB") ?></a></li><?php } ?>
				</ul>
			</dd>
			<?php } ?>


				<?php if ($documentationConfig) {?><dt id="doclink">
				<a id="documentation" href="#" onclick="accordion.display(4)">
					<span class="documentation"><?php  echo JText::_("DOCUMENTATIONTAB") ?></span>
				</a>
			</dt>
			<dd>
				<ul class="sub">
					<?php if ($overviewConfig) {?><li><a href="#0.0" class="overview"  onclick="accordion.display(0)"><?php  echo JText::_("OVERVIEWTAB") ?></a></li><?php } ?>
					<?php if ($diagnosticsConfig) {?><li><a href="#0.1" class="overview"  onclick="accordion.display(1)"><?php  echo JText::_("DIAGNOSTICSTAB") ?></a></li><?php } ?>
					<?php if ($languagesConfig) {?><li><a href="#0.3" class="overview"  onclick="accordion.display(3)"><?php  echo JText::_("LANGUAGETAB") ?></a></li><?php } ?>
					<?php if ($documentationConfig) { ?><li><a href="#0.4" class="overview"  onclick="accordion.display(4)"><?php  echo JText::_("DOCUMENTATIONTAB") ?></a></li><?php } ?>
					<?php if ($modulepositionsConfig) {?><li><a  class="positions"  onclick="accordion.display(36)" href="#0.36"><?php  echo JText::_("MODULEPOSITIONS") ?></a></li><?php } ?>
					<?php if ($rebrandingConfig) {?><li><a href="#0.5" onclick="accordion.display(5)"><?php  echo JText::_("REBRANDINGTAB") ?></a></li><?php } ?>
				</ul>
			</dd>
			<?php } ?>
			</dl>



		</div>

		<?php

		return ob_get_clean();
		}

		else { ?>
				<style>
					.paramlist, .adminform legend{display:none;}
					.notice {
						background: #FFF6BF;
						color: #514721;
						border-bottom: 1px solid #FFD324;width:100%;padding:10px;
					}
				</style>
				<div class="notice"><strong>Warning: The Zen Grid Framework Plugin is not currently enabled.</strong>
				<p>Click <a href="index.php?option=com_plugins">here</a> to visit the plugin manager to enable the plugin.</p>
				</div>
			<?php
		}

	}
	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
		return false;
	}

}
?>
