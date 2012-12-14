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

class JFormFieldZeninfo extends JFormField
{

	protected  $type = 'Zeninfo';

	protected function getInput()
	{
		$zgf = ZenGrid::getInstance();

		$zgfEnabled = JPluginHelper::isEnabled ('system', 'zengridframework');

		if ($zgfEnabled)
		{
			global $mainframe;

			$display		= (string) $this->element['display'];
			$image			= (string) $this->element['image'];
			$section		= (string) $this->element['section'];
			$url			= (string) $this->element['url'];
			$desc			= (string) $this->element['desc'];
			$class          = (string) $this->element['class'];

			$template = $zgf->getTemplateName();

			$manifest = $zgf->getFrameworkManifest();

				// Title
			if ($display == "title") {
				return '<h4 class="jbtitle ' . $class . '">' . JText::_($this->element['label']) . '</h4>';
			}

			if ($display == "paneltitle") {
				return '<div class="zenPanelTitle ' . $class . '"><h2 class="'.$section.'">' . JText::_($this->element['desc']) . '</h2>';
			}


				// Heading
			elseif ($display == "heading") {
				return '<div class="heading '. $section .' '. $class . '"><h3>' . JText::_($this->element['desc']) . '</h3></div>';
			}

				// Text
			elseif ($display == "text") {
				return '<p class="zentext ' . $class . '">' . JText::_($this->element['label']) . '</p>';
			}

				// Desc
			elseif ($display == "desc") {
				return '<p class="jbdesc ' . $class . '">' . JText::_($this->element['desc']) . '</p>';
			}

				// Image
			elseif ($display == "image") {
				return '<div class="padding ' . $class . '"><img src="'.$image.'" class="zenImage" alt="'.$image.'"></a>';
			}

				// Position Image
			elseif ($display == "position") {
				return '<div class="padding ' . $class . '"><img src="'.JURI::root(true) .'/templates/'.$template.'/'. $template .'_positions.png" class="zenImage" alt="'.$image.'"></a>';
			}

				// type Kit
			elseif ($display == "typekit") {
				return '<div class="links ' . $class . '"><p><a href="http://typekit.com/" target="_blank">Visit Typekit</a>  <a href="http://typekit.com/libraries/full" target="_blank">Browse Typekit fonts</a></div>';
			}

				// Google Fonts
			elseif ($display == "googlefonts") {
				return '<div class="links ' . $class . '"><p><a href="http://www.google.com/webfonts" target="_blank">Visit Google Fonts</a>  <a href="http://www.google.com/webfonts/preview#font-family=Aclonica" target="_blank">Preview Google Fonts</a></div>';
			}

				// Google Fonts
			elseif ($display == "zenoverview") {

				ob_start();	?>

				<div class="intro <?php echo $class ?>">
					<div class="jbTemplateOverview">
						<a href="http://www.joomlabamboo.com">
							<img src="<?php echo JURI::root(true) ?>/templates/<?php echo $template?>/templateTeaser.jpg" alt="joomla Bamboo" class="zgfTeaser" />
						</a>
					</div>
					<div class="clear"></div>
					<div id="manifest">
						<?php //	echo $manifest->description ?>
					</div>
				</div>
				<ul id="zgf_overview"></ul>

				<?php	return ob_get_clean();


			}



				// Links to theme.css
			elseif ($display == "overviewstyle") {

				$hilite = $zgf->getParam('hilite');
				$legacy = $zgf->getParam('legacy');

				$css = $legacy ? 'legacy' : 'theme';


				ob_start();
				// Include zen grid
				?>
					<div class="links">
						<h4>Active css for your template</h4>
						<a href="<?php echo JURI::root() ?>/templates/<?php echo $template ?>/css/<?php echo $css; ?>.css" class="modal positions" rel="{handler: 'iframe', size: {x: 700, y: 600}}"><?php echo ucfirst($css); ?> CSS</a>

						<?php if ($hilite >= 0) : ?>
						<a href="<?php echo JURI::root() ?>/templates/<?php echo $template ?>/css/<?php echo $hilite ?>.css" class="modal positions" rel="{handler: 'iframe', size: {x: 700, y: 600}}"><?php echo $hilite ?> CSS</a>
					<?php endif; ?>
				</div>
				<?php
				return ob_get_clean();

			}


			elseif ($display == "doc") {

				$docprefix ='<li><a class="modal positions" rel="{handler: \'iframe\', size: {x: 600, y: 800}}" href="http://docs.joomlabamboo.com/item/';
				$doctemplate='?template=none';

				$docs = '<div class="heading doc"><h3>' . JText::_($this->element['title']) . '</h3></div>';
				$docs .= '<div class="kbpadding"><ul>';

						// Docs for diagnostic panel
				if ($section == "diagnostics") {
					$docs .= '<a '.$modal.' href="'.$url.'">' . JText::_($this->element['label']) . '</a>';
				}

						// Docs for translation Panel
				elseif ($section == "translation") {
					$docs .=  ''.$docprefix.'726-language-settings-for-zen-grid-framework-templates'.$doctemplate.'">Language settings and translating the Zen Grid Framework</a></li>';
				}

						// Docs for rebrandingPanel
				elseif ($section == "rebranding") {
					$docs .=  ''.$docprefix.'700-copyright-removal-and-branding'.$doctemplate.'">Rebranding your template</a></li>';
				}

						// Docs for Style Panel
				elseif ($section == "style") {
					$docs .=  ''.$docprefix.'560-zen-grid-framework-css-overrides-appearance'.$doctemplate.'">Zen Grid Framework CSS Overrides</a></li>';
				}

						// Docs for Custom Style Panel
				elseif ($section == "customstyle") {
					$docs .=  ''.$docprefix.'560-zen-grid-framework-css-overrides-appearance'.$doctemplate.'">Zen Grid Framework CSS Overrides</a></li>';
					$docs .=  ''.$docprefix.'725-customising-zen-grid-framework-css-javascript-and-php'.$doctemplate.'">Customising Zen Grid Framework CSS, Javascript and PHP</a></li>';

				}

						// Docs for Logo Panel
				elseif ($section == "logo") {
					$docs .=  ''.$docprefix.'562-zen-grid-2-logo-options'.$doctemplate.'">Controlling the logo in the Zen Grid Framework</a></li>';
				}

						// Docs for Tagline Panel
				elseif ($section == "tagline") {
					$docs .=  ''.$docprefix.'559-tagline-appearance'.$doctemplate.'">Controlling the tagline</a></li>';
				}

						// Docs for Fonts Panel
				elseif ($section == "Fonts") {
					$docs .=  ''.$docprefix.'549-font-stacks'.$doctemplate.'">Understanding font stacks</a></li>';
					$docs .=  ''.$docprefix.'723-using-typekit-fonts-with-the-zen-grid-framework'.$doctemplate.'">Using Typekit in your template</a></li>';
				}

						// Docs for Body Classes Panel
				elseif ($section == "bodyclasses") {
					$docs .=  ''.$docprefix.'563-template-hilites'.$doctemplate.'">Understanding template hilites</a></li>';
				}

						// Docs for rStyle Panel
				elseif ($section == "layoutsettings") {
					$docs .=  ''.$docprefix.'550-controlling-module-layouts'.$doctemplate.'">Controlling module layouts</a></li>';
					$docs .=  ''.$docprefix.'561-general-layout-settings'.$doctemplate.'">General layout settings</a></li>';
					$docs .=  ''.$docprefix.'558-exploring-template-overrides'.$doctemplate.'">Exploring template layout overrides</a></li>';
					$docs .=  ''.$docprefix.'545-exploring-the-framework-template-setup'.$doctemplate.'">Exploring the the framework template setup</a></li>';
					$docs .=  ''.$docprefix.'731-adding-a-module-position-to-a-zen-grid-framework-template'.$doctemplate.'">Adding a module position to a Zen Grid Framework template</a></li>';
				}

						// Docs for Mobile Panel
				elseif ($section == "mobile") {
					$docs .=  ''.$docprefix.'563-template-hilites'.$doctemplate.'">Understanding template hilites</a></li>';
				}

						// Docs for Main Panel
				elseif ($section == "main") {
					$docs .=  ''.$docprefix.'544-controlling-the-main-content-area'.$doctemplate.'">Controlling the main content area</a></li>';
					$docs .=  ''.$docprefix.'550-controlling-module-layouts'.$doctemplate.'">Controlling module layouts</a></li>';
				}

						// Docs for Menu Panel
				elseif ($section == "menu") {
					$docs .=  ''.$docprefix.'563-template-hilites'.$doctemplate.'">Understanding template hilites</a></li>';
				}

						// Docs for Module Widths Panel
				elseif ($section == "modulewidths") {
					$docs .=  ''.$docprefix.'550-controlling-module-layouts'.$doctemplate.'">Controlling module layouts</a></li>';
				}

						// Docs for Overrides Panel
				elseif ($section == "overrides") {
					$docs .=  ''.$docprefix.'558-exploring-template-overrides'.$doctemplate.'">Exploring template layout overrides</a></li>';
				}

						// Docs for Superfish Panel
				elseif ($section == "superfish") {
					$docs .=  ''.$docprefix.'552-setting-up-the-superfish-menu'.$doctemplate.'">Setting up the superfish menu</a></li>';
					$docs .=  ''.$docprefix.'590-how-to-create-parentchild-menu-items-in-joomla'.$doctemplate.'">Creating parent child items in Joomla</a</li>';
				}

						// Docs for Panel Menu Panel
				elseif ($section == "panelmenu") {
					$docs .=  ''.$docprefix.'553-setting-up-the-panel-menu'.$doctemplate.'">Setting up the panel menu</a></li>';
					$docs .=  ''.$docprefix.'590-how-to-create-parentchild-menu-items-in-joomla'.$doctemplate.'">Creating parent child items in Joomla</a></li>';
				}

						// Docs for Split menu Panel
				elseif ($section == "splitmenu") {
					$docs .=  ''.$docprefix.'699-zen-grid-menu-options'.$doctemplate.'">Zen Grid Framework Menu options</a></li>';
					$docs .=  ''.$docprefix.'590-how-to-create-parentchild-menu-items-in-joomla'.$doctemplate.'">Creating parent child items in Joomla</a></li>';
				}

						// Docs for Hidden Panel Panel
				elseif ($section == "hiddenpanel") {

				}

						// Docs for Tabbed Modules Panel
				elseif ($section == "tabbedmodules") {

				}

						// Docs for Social Icons Panel
				elseif ($section == "socialicons") {

				}

						// Docs for Effects Panel
				elseif ($section == "effects") {
					$docs .=  ''.$docprefix.'786-how-to-add-the-sticky-nav'.$doctemplate.'">Sticky Nav Overview</a></li>';
				}

						// Docs for Performance Panel
				elseif ($section == "performance") {

				}

						// Docs for Joomla Tweaks Panel
				elseif ($section == "joomlatweaks") {

				}

						// Docs for Analytics Panel
				elseif ($section == "analytics") {

				}

						// Docs for Extra Scripts Panel
				elseif ($section == "extrascripts") {

				}

						// Docs for IE6 Fixes Panel
				elseif ($section == "ie6fixes") {

				}

				$docs .='</ul></div>';
				return $docs;
			}
		}
	}


	function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='')
	{
		return false;
	}
}
