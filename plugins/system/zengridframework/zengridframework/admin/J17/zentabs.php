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

class JFormFieldZentabs extends JFormField
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/

	protected $type = 'zentabs';

	protected function getInput()
	{
		$zgf = ZenGrid::getInstance();
		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework')	;
		if ($zgfEnabled) {

				$app = JFactory::getApplication();
				jimport('joomla.environment.browser');

				//require_once(JPATH_ROOT . '/plugins/system/zengridframework/zengridframework/admin/classes/zengrid.php');
				$document = JFactory::getDocument();
				$document->addStylesheet(JURI::root(true).'/plugins/system/zengridframework/zengridframework/admin/css/zentabs.css');

				$browser = JBrowser::getInstance();
				if (substr_count(strtolower($browser->getBrowser()), 'msie') && $browser->getVersion() < 8)
					$document->addStylesheet(JURI::root(true).'/plugins/system/zengridframework/zengridframework/admin/css/zentabs_ie.css');

				JHTML::_('behavior.modal', 'a.modal');
				JHTML::_('behavior.tooltip');

				// Loads the global Zen Grid Framework Language File
				$zgf->loadLanguage();

				$template = $zgf->getTemplateName();
				// include the config file for this template. The settings in the config file determine the menu items that are displayed in the back end.
				require_once(JPATH_ROOT . '/templates/' . $template . '/includes/config.php');

				$allEqual = $zgf->getParam('allEqual');

				$firstcolor = $zgf->getParam('firstcolor');
				$secondcolor = $zgf->getParam('secondcolor');
				$thirdcolor = $zgf->getParam('thirdcolor');
				$fourthcolor = $zgf->getParam('fourthcolor');
				$fifthcolor = $zgf->getParam('fifthcolor');
				$sixthcolor = $zgf->getParam('sixthcolor');
				$logoColor = $zgf->getParam('logoColour');
				$allEqual = $zgf->getParam('allEqual');
						ob_start();	?>
				<!-- Sets the colors for the colorpickers until we can fix it -->
				<style>
					#imgfirstcolor{background: #<?php echo $firstcolor ?>}
					#imgsecondcolor{background: #<?php echo $secondcolor ?>}
					#imgthirdcolor{background: #<?php echo $thirdcolor ?>}
					#imgfourthcolor{background: #<?php echo $fourthcolor ?>}
					#imgfifthcolor{background: #<?php echo $fifthcolor ?>}
					#imglogoColour{background: #<?php echo $logoColor ?>}
				</style>

				<script type="text/javascript" src="<?php echo JURI::root(true) ?>/plugins/system/zengridframework/zengridframework/admin/js/jquery-1.8.2.min.js"></script>
				<script type="text/javascript">jQuery.noConflict()</script>
				<script type="text/javascript" src="<?php echo JURI::root(true) ?>/plugins/system/zengridframework/zengridframework/admin/js/zentabs.js"></script>
				<script type="text/javascript">

					jQuery(window).load(function () {
						jQuery("#content-box").fadeIn();
					});

					jQuery(document).ready(function() {

						//jQuery(".inputbox").chosen();

						if (jQuery('#menu-assignment').length) {
							jQuery('#menu-assignment').hide();

							jQuery('a#menuassign').click(function() {
								jQuery('#menu-assignment').fadeToggle();
							});

							jQuery('#jbtabs a').click(function() {
								jQuery('#menu-assignment').fadeOut();
							});
						}

						jQuery("#jbtabs a.parent").click(function() {
							jQuery("#jbtabs li").removeClass('zenactive');
							jQuery(this).parent().toggleClass('zenactive');
						});

						jQuery('#topColour, #toolbar-title, #header-box, #border-top').css({ 'opacity' : 0.1, 'display': 'block' });
					});
				</script>
				<a href="#" id="menuassign">Assign to menu</a>
				<div id="actionToolbar">
					<a href="#" onclick="javascript:Joomla.submitbutton('style.save')" class="toolbar">
					<span class="save" title="Save">Save
					</span>

					</a>



					<a href="#" onclick="javascript:Joomla.submitbutton('style.apply')" class="toolbar">
					<span class="apply" title="Apply">Apply
					</span>

					</a>



					<a href="#" onclick="javascript:Joomla.submitbutton('style.cancel')" class="toolbar">
					<span class="cancel" title="Close">Close
					</span>

					</a>
			</div>

				<div id="jbtabs">
					<ul class="tabs">



				<?php if ($overviewConfig || $diagnosticsConfig  || $languagesConfig  || $modulepositionsConfig  || $rebrandingConfig) {?>
				<!--Overview-->
				<li class="zenactive"><a class="parent active" href="#overview"><span class="overview"><?php echo JText::_('OVERVIEWTAB')?></span></a>
					<ul class="sub overview">
						<?php if ($overviewConfig) {?><li><a class="child" href="#overview"><?php echo JText::_('OVERVIEWTAB');?></a></li><?php } ?>
						<?php if ($diagnosticsConfig) {?><li><a class="child" href="#diagnostics"><?php echo JText::_('DIAGNOSTICSTAB')?></a></li><?php } ?>
						<?php if ($languagesConfig) {?><li><a class="child" href="#translation"><?php echo JText::_('LANGUAGETAB')?></a></li><?php } ?>
						<?php if ($modulepositionsConfig) {?><li><a class="child" href="#positions"><?php echo JText::_('MODULEPOSITIONS')?></a></li><?php } ?>
						<?php if ($rebrandingConfig) {?><li><a class="child" href="#rebranding" onclick="accordion.display(5)"><?php  echo JText::_("REBRANDINGTAB") ?></a></li><?php } ?>
					</ul>
				</li>
				<?php } ?>
				<?php if ($styleConfig  || $logoConfig  || $taglineConfig  || $fontsConfig  || $cssoverridesConfig) {?>
				<!--Appearance-->
				<li><a class="parent" href="#style"><span class="appearance"><?php echo JText::_('APPEARANCETAB')?></span></a>
					<ul class="sub appearance">
						<?php if ($styleConfig) {?><li><a class="child" href="#style"><?php echo JText::_('STYLETAB')?></a></li><?php } ?>
						<?php if ($styleConfig) {?><li><a class="child" href="#customstyle"><?php echo JText::_('CUSTOMSTYLE')?></a></li><?php } ?>
						<?php if ($logoConfig) {?><li><a class="child" href="#logo"><?php echo JText::_('LOGOTAB')?></a></li><?php } ?>
						<?php if ($taglineConfig) {?><li><a class="child" href="#tagline"><?php echo JText::_('TAGLINETAB')?></a></li><?php } ?>
						<?php if ($fontsConfig) {?> <li><a class="child" href="#fonts"><?php echo JText::_('FONTSTAB')?></a></li><?php } ?>
						<?php if ($bodyclassConfig) {?><li><a class="child" href="#bodyclasses"><?php echo JText::_('BODYCLASSTAB')?></a></li><?php } ?>
					</ul>
				</li>
				<?php } ?>
				<?php if ($settingsConfig  || $topConfig  || $headerConfig  ||$menuConfig  || $grid1Config  || $mainConfig  || $grid2Config  ||$bottomConfig  || $footerConfig  || $overridesConfig) {?>
				<!--Layout-->
				<li><a class="parent" href="#settings"><span class="layout"><?php echo JText::_('LAYOUTTAB')?></span></a>
					<ul class="sub layout">

						<!--All Equal On-->
						<?php if ($settingsConfig) {?><li><a class="child" href="#settings"><?php echo JText::_('SETTINGSTAB')?></a></li><?php } ?>
						<?php if ($mobileConfig) {?><li><a class="child" href="#mobile"><?php echo JText::_('MOBILETAB')?></a></li> <?php } ?>
						<?php if ($mainConfig) {?><li><a class="child" href="#2colL"><?php echo JText::_('MAINTAB')?></a></li><?php } ?>
						<?php if ($menuConfig) {?><li><a class="child" href="#menu"><?php echo JText::_('MENUTAB')?></a></li><?php } ?>

						<?php if ($allEqual) { ?>
						<?php if ($widthsConfig) {?><li><a class="child inactive thisisatooltip hasTip" href="#" title="Disabled::<?php echo JText::_('ZENMENUDISABLED')?>">
								<?php echo JText::_('LAYOUTWIDTHSTAB')?></a>
							</li><?php } ?>
						<?php } else { ?>
						<?php if ($widthsConfig) {?><li><a class="child" href="#modulewidths"><?php echo JText::_('LAYOUTWIDTHSTAB')?></a></li><?php } ?>
						<?php } ?>
						<?php if ($overridesConfig) {?><li><a class="child" href="#overrides"><?php echo JText::_('OVERRIDESTAB')?></a></li><?php } ?>

					</ul>
				</li>
				<?php } ?>

				<!--Menus-->
				<?php if ($superfishmenuConfig  || $panelmenuConfig  || $splitmenuConfig) {?>
				<!--Menus-->
				<li><a class="parent" href="#superfishmenu"><span class="menus"><?php echo JText::_('MENUSTAB')?></span></a>
					<ul class="sub menus">
					<?php if ($menuConfig) {?>	<li><a class="child" href="#menu" onclick="accordion.display(14)"><?php  echo JText::_("MENULAYOUTTAB") ?></a></li><?php } ?>
					<?php if ($superfishmenuConfig) {?><li><a class="child" href="#superfishmenu"><?php echo JText::_('SUPERFISHTAB')?></a></li><?php } ?>
					<?php if ($panelmenuConfig) {?><li><a class="child" href="#panelmenu"><?php echo JText::_('PANELTAB')?></a></li><?php } ?>
					<?php if ($splitmenuConfig) {?><li><a class="child" href="#splitmenu"><?php echo JText::_('SPLITTAB')?></a></li>    <?php } ?>
					</ul>
				</li>
				<?php } ?>

				<!--Tools -->
				<?php if ($hiddenpanelConfig  || $tabbedmodulesConfig  || $carouselConfig  || $slideshowConfig  || $effectsConfig) {?>
				<!--Tools-->
				<li><a class="parent" href="#hiddenpanel"><span class="tools"><?php echo JText::_('ELEMENTSTAB')?></span></a>
					<ul class="sub elements">
						<?php if ($hiddenpanelConfig) {?><li><a class="child" href="#hiddenpanel"><?php echo JText::_('HIDDENPANELTAB')?></a></li><?php } ?>
						<?php if ($tabbedmodulesConfig) {?><li><a class="child" href="#tabbedmodules"><?php echo JText::_('TABSTAB')?></a></li><?php } ?>
						<?php if ($socialiconsConfig) {?><li><a class="child" href="#socialicons"><?php echo JText::_('SOCIALICONSTAB')?></a></li>  <?php } ?>
						<?php if ($slideshowConfig) {?><li><a class="child" href="#slideshow"><?php echo JText::_('SLIDESHOWTAB')?></a></li>  <?php } ?>
						<?php if ($effectsConfig) { ?>	<li><a class="child" href="#effects"><?php  echo JText::_("EFFECTSTAB") ?></a></li><?php } ?>
					</ul>
				</li>
				<?php } ?>

				<!--Settings-->
				<?php if ($performanceConfig  || $tweaksConfig  || $analyticsConfig  || $extrascriptsConfig  || $pngfixConfig  || $ie6warningConfig) {?>
				<!--Settings-->
				<li><a class="parent" href="#performance"><span class="settings"><?php echo JText::_('TOOLSTAB')?></span></a>
					<ul class="sub tools">
					<?php if ($performanceConfig) {?><li><a class="child" href="#performance"><?php echo JText::_('SCRIPTSTAB')?></a></li><?php } ?>
					<?php if ($tweaksConfig) {?><li><a class="child" href="#joomlatweaks"><?php echo JText::_('JOOMLATAB')?></a></li><?php } ?>
					<?php if ($analyticsConfig) {?><li><a class="child" href="#analytics"><?php echo JText::_('ANALYTICSTAB')?></a></li>  <?php } ?>
					<?php if ($extrascriptsConfig) {?><li><a class="child" href="#extrascripts"><?php echo JText::_('EXTRASCRIPTSTAB')?></a></li> <?php } ?>
						<li><a class="child" href="#cookies"><?php  echo JText::_("COOKIESTAB") ?></a></li>
					<?php if ($pngfixConfig) {?><li><a class="child" href="#ie6fixes"><?php echo JText::_('IE6TAB')?></a></li> <?php } ?>
					</ul>
				</li>
			   <?php } ?>
				<?php if ($documentationConfig  || $modulepositionsConfig) {?>
				<!--Overview-->
				<li><a class="parent" href="#documentation"><span class="documentation"><?php echo JText::_('DOCUMENTATIONTAB')?></span></a>
					<ul class="sub bottomdocs">
						<?php if ($documentationConfig) { ?><li><a class="child" href="#documentation"><?php echo JText::_('DOCUMENTATIONTAB')?></a></li><?php } ?>
						<?php if ($modulepositionsConfig) {?><li><a class="child" href="#positions"><?php echo JText::_('MODULEPOSITIONS')?></a></li><?php } ?>
					</ul>
				</li>
				<?php } ?>



			</ul>
		</div> <?php
		return ob_get_clean();
			}
			else { ?>
					<style>
						.pane-toggler{display:none;}
						.pane-sliders {border:0;}
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

	public function getLabel() {
		return '<span class="hideLabel">' . parent::getLabel() . '</span>';
	}

}
