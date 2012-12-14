<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

require 'zenbench.php';

define('ZGF_VERSION', '##version##');

if (substr(JVERSION, 0, 3) >= '1.6') {
	JLoader::register('ZenGridBase', JPATH_ROOT . '/plugins/system/zengridframework/zengridframework/classes/zengridbase.php');
	JLoader::register('ZenGrid', JPATH_ROOT . '/plugins/system/zengridframework/zengridframework/classes/j17/zengrid.php');
} else {
	JLoader::register('ZenGridBase', JPATH_ROOT . '/plugins/system/zengridframework/classes/zengridbase.php');
	JLoader::register('ZenGrid', JPATH_ROOT . '/plugins/system/zengridframework/classes/zengrid.php');
}

jimport('joomla.plugin.plugin');

/**
 * Zen Grid Framework System Plugin Class
 */
class plgSystemZengridframework extends JPlugin
{
	private $zgf;

	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);

		// Instantiate the Framework
		$this->zgf = ZenGrid::getInstance($this);
	}

	public function onAfterRoute()
	{
		// ZenBench::start('onAfterRoute');

		// Check if the current template is compatible with Zen Grid Framework
		if (!$this->zgf->templateIsCompatible()) return;

		$app = JFactory::getApplication();
		if ($app->isAdmin()) return;

		$template = $this->zgf->getTemplateName();

		$this->combinescripts      = $this->zgf->getParam('combinescripts', 0);
		$this->bottomScripts       = $this->zgf->getParam('bottomScripts', 0);
		$this->pngfix              = $this->zgf->getParam('pngfix', 0);
		$this->pngfixrules         = $this->zgf->getParam('pngfixrules', '');
		$this->jQuerySource        = $this->zgf->getParam('jQuerySource', 'local');
		$this->jQueryVersion       = $this->zgf->getParam('jQueryVersion');
		$this->noconflict          = $this->zgf->getParam('noConflict', 0);
		$this->stripOtherJquery    = $this->zgf->getParam('stripOtherJquery', 1);
		$this->scrollbottom        = $this->zgf->getParam('scrollbottom');
		$this->scrolltop           = $this->zgf->getParam('scrolltop');
		$this->removeMootools      = $this->zgf->getParam('removeMootools', 0);
		$this->removeModal         = $this->zgf->getParam('removeModal', 0);
		$this->removeK2            = $this->zgf->getParam('removeK2', 0);
		$this->stripCustom         = $this->zgf->getParam('stripCustom', 0);
		$this->customScripts       = $this->zgf->getParam('customScripts');
		$this->stickynav           = $this->zgf->getParam('stickynav', 0);
		$this->stickynavthreshold  = $this->zgf->getParam('stickynavthreshold', '200');
		$this->lazyLoad            = $this->zgf->getParam('lazyload', 0);
		$this->lazyloadSelector    = $this->zgf->getParam('lazyloadSelector', 'img');
		$this->superfish           = $this->zgf->getParam('superfish', 0);
		$this->sfhover             = $this->zgf->getParam('sfhover', 1);
		$this->browser             = $this->zgf->getBrowser();
		$this->disableIECompatMode = $this->zgf->getParam('disableiecompatmode', 0);
		$this->isIE                = substr($this->zgf->getBrowser(), 0, 2) === 'ie';
		$this->isIE6               = $this->zgf->isBrowser('ie6');
		$this->ie6Warning          = $this->zgf->getParam('ie6Warning', 0);
		$this->cookies          = $this->zgf->getParam('cookies', 0);
		$this->extraJS             = (file_exists(JPATH_ROOT."/templates/".$template."/js/template.js")) ? "1" : "0";

		$this->filePath = $this->combinescripts ? JPATH_SITE . '/' : JURI::base();

		$document = JFactory::getDocument();

		// Include JS MIn if combine scripts is enabled
		if ($this->combinescripts)
		{
			include_once dirname(__FILE__) . '/zengridframework/functions/elements/jsmin-1.1.1.php';
		}

		// Start of the array
		$files = array();

		if ($this->removeMootools == 2)
		{
			if (substr(JVERSION, 0, 3) >= '1.6')
			{
				$files[] = $this->filePath . "media/system/js/mootools-core.js";
				$files[] = $this->filePath . "media/system/js/core.js";
				$files[] = $this->filePath . "media/system/js/mootools-more.js";
			}
			else
			{
				$files[] = $this->filePath . "media/system/js/mootools.js";
			}
		}

		if ($this->removeModal == 2)
		{
			$files[]=$this->filePath . "media/system/js/modal.js";
		}

		// Check to see if we should load jQuery
		if (($this->jQueryVersion != 'none') && ($app->get('jquery') == false))
		{
			//$app->set('jquery', true);
			if (!$this->bottomScripts) {
				if ($this->jQuerySource == 'local' && $this->jQueryVersion !== "google") {
					$files[]=$this->filePath . "media/zengridframework/js/jquery/jquery-" . $this->jQueryVersion . ".min.js";
					if ($this->noconflict) $files[]= $this->filePath . "media/zengridframework/js/jquery/noconflict.js";
					$app->set('jquery', true);
				}
			} else {
				if ($this->jQuerySource == 'local' && $this->jQueryVersion !== "google") {
					$this->jscripts .= '<script type="text/javascript" src="'.JURI::base(true).'media/zengridframework/js/jquery/jquery-'.$this->jQueryVersion.'.min.js"></script>';
					if ($this->noconflict) $this->jscripts .= '<script type="text/javascript" src="'.JURI::base(true).'media/zengridframework/js/jquery/noconflict.js"></script>';
					$app->set('jquery', true);
				}
			}
		}
		
		if ($this->cookies) $files[]= $this->filePath . "media/zengridframework/js/cookie/jquery.cookiecuttr.js";
		
		if ($this->removeK2 == 2) $files[]=$this->filePath . "/components/com_k2/js/k2.js";

		if ($this->lazyLoad) $files[]= $this->filePath . "media/zengridframework/js/effects/jquery.lazyload.min.js";

			// Load Superfish
		if ($this->superfish) $files[] = $this->filePath . "media/zengridframework/js/menus/superfish.min.js";

			// Load Superfish Hover Intent
		if ($this->superfish && $this->sfhover) $files[] = $this->filePath . "media/zengridframework/js/menus/jquery.hoverIntent.min.js";

		// IE Compatibility mode
		if ($this->isIE && $this->disableIECompatMode)
		{
			if (!headers_sent())
			{
				header('X-UA-Compatible: IE=edge');
			}
		}
			// ie6 Warning
		if ($this->isIE6 && $this->ie6Warning) {
			$files[] = $this->filePath . "media/zengridframework/js/tools/jquery.badBrowser.min.js";
		}

			// ie6 PNG Fix
		if ($this->isIE6 && $this->pngfix) {
			$files[] = $this->filePath . "media/zengridframework/js/pngfix/DD_belatedPNG0.0.8a-min.js";
		}

			// Code to allow users to uipload scripts to templates/yourtemplate/user folder to have it automatically included
		$path= 'templates/'.$template.'/user';

		if (JFolder::exists($path)) {
			$userfiles = JFolder::files($path, 'js', false, true);
			$userfiles = str_replace("\\", "/", $userfiles);
			$result = count($userfiles);

		} else {
			$userfiles ="";
			$result = 0;
		}
		if ($result > 0) {
			foreach ($userfiles as $jsfile) {
				$files[] = $this->filePath . "$jsfile";
			}
		}

		// Load Core Framework js file
		//$files[] = $this->filePath . "media/zengridframework/js/zen.min.js";
		$files[] = $this->filePath . "media/zengridframework/js/zen.js";

		// Load the template js file
		if ($this->extraJS) $files[] = $this->filePath . "/templates/$template/js/template.js";

		$js = "";
		$zengridJSDec ="";
		$zengridJS ="";

			//This guarantees loading order of the scripts.
		if (($this->jQueryVersion != 'none') && ($app->get('jquery') == false)) {

			if (($this->jQuerySource == 'google') && ($this->jQueryVersion != 'none') or ($this->jQuerySource == 'local') && ($this->jQueryVersion == 'google')) {
				if (!$this->bottomScripts) {
					$document->addScript("https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js");
					$app->set('jquery', true);
				} else {
					$this->jscripts .= '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>'. "\n";
					$app->set('jquery', true);
				}

				if ($this->noconflict) {
					if (!$this->bottomScripts) {
						$document->addScript(JURI::base(true)."/media/zengridframework/js/tools/noconflict.js");
					} else {
						$this->jscripts .= '<script type="text/javascript" src="'.JURI::base(true).'/media/zengridframework/tools/noconflict.js"></script>'. "\n";
					}

				}
			}
		}

			// If we are only combining scripts.
		if (!$this->combinescripts) {
			foreach ($files as $file) {
				if (!$this->bottomScripts) {
					$document->addScript($file);
				} else {
					$this->jscripts .= '<script type="text/javascript" src="'.$file.'"></script>'. "\n";
				}
			}
		}

			// If we are caching and or combining or compressing
		if ($this->combinescripts) {

			// Set up the md5 hash
			$md5sum = '';
			foreach ($files as $js) {
				$md5sum .= md5($js);
			}

			// Setting up the file name and path to the file
			$path = "cache/zengridframework/js/";
			$cache_filename = "js-" . md5($md5sum) . ".php";
			$cache_fullpath = $path . '/' . $cache_filename;

			// Grab the cache time from the template parameters
			$cache_time = '100000';

			// Set up the check to see if the file exists already or hasnt expired
			// The following was originally referenced from the Motif framework created by Cory Webb.
			if (JFile::exists($cache_fullpath)) {
				$diff = (time()-filectime($cache_fullpath));
			} else {
				$diff = $cache_time+1;
			}

			if ($diff > $cache_time) {
				$outfile='<?php
				ob_start ("ob_gzhandler");
				header("Content-type: application/x-javascript; charset: UTF-8");
				header("Cache-Control: must-revalidate");
				$offset = 60 * 60 ;
				$ExpStr = "Expires: " .
				gmdate("D, d M Y H:i:s",
					time() + $offset) . " GMT";
				header($ExpStr);
				?>';

				foreach ($files as $file) {
					if (JFile::exists($file)) {
						$outfile .= JFile::read($file);

					}
				}

				// Output the combined and compressed file
				JFile::write(JPATH_ROOT.'/cache/zengridframework/js/zengridtemp.js', $outfile);
				$newjs = JSMin::minify(file_get_contents(JPATH_ROOT.'/cache/zengridframework/js/zengridtemp.js'));

				// Create the js file
				JFile::write($cache_fullpath, $newjs);
			}

			// Set the ZenGridJS variable which gets output in the zgf index

			if ($this->bottomScripts) {
				$this->jscripts .= '<script type="text/javascript" src="'.JURI::base(true).'/cache/zengridframework/js/'.$cache_filename.'"></script>'. "\n";
			} else {
				$document = JFactory::getDocument();
				$document->addScript(JURI::base(true)."/cache/zengridframework/js/".$cache_filename);
			}
		}

		// ZenBench::stop('onAfterRoute');
	}

	public function onAfterRender()
	{
		// ZenBench::start('onAfterRender');

		$app = JFactory::getApplication();

		if ($app->isAdmin()) {
			return $this->checkClearCacheAction();
		}

		if (!$this->zgf->templateIsCompatible()) return;

		// ------------------------------------------------------------------------
		// Remove javascript from the page output
		//
		$document = JFactory::getDocument();
		$body = JResponse::getBody();

		if ($this->removeMootools == 2 || $this->removeModal == 2 || $this->removeK2 == 2 || $this->stripCustom || $this->removeMootools == 1 || $this->removeModal == 1 || $this->removeK2 == 1) {

				// ------------------------------------------------------------------------
				// Remove Mootools
				//

			if (($this->removeMootools == 2 && $this->combinescripts) || ($this->removeMootools == 1)) {
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)mootools.js#", "", $body);
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)mootools-core.js#", "", $body);
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)mootools-more.js#", "", $body);
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)core.js#", "", $body);
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)caption.js#", "", $body);
				$body = preg_replace('%window\.addEvent\(\'load\', \s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%', '', $body);
			}

				// ------------------------------------------------------------------------
				// Remove modal js
				//

			if (($this->removeModal == 2 && $this->combinescripts) || ($this->removeModal == 1)) {
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)modal.js#", "", $body);
			}

				// ------------------------------------------------------------------------
				// Remove k2
				//

			if (($this->removeK2 == 2 && $this->combinescripts) || ($this->removeK2 == 1)) {
				$body = preg_replace("#([\/a-zA-Z0-9_:\.-]*)k2.js#", "", $body);
			}

				// ------------------------------------------------------------------------
				// Remove custom scripts from the output
				//

			if ($this->stripCustom && $this->customScripts !== "") {

				$customScripts = preg_split("/[\s, ]+/", trim($this->customScripts));

				foreach ($customScripts as $scriptName) {
					$scriptRegex = '([\/a-zA-Z0-9_:\.-]*)'.trim($scriptName);
					$body = preg_replace("#$scriptRegex#", "", $body);
				}
			}
		}

				// Cleans up any fragmented Script tags after we remove them above.
		$body = str_ireplace('<script src="" type="text/javascript"></script>', "", $body);

		$this->jscripts = "";
		$scripts = $this->bottomScripts ? $this->jscripts : '';
		$scrollText= $this->zgf->getParam('scrollText');;

				// ------------------------------------------------------------------------
				// Scroll to top effect
				//

				//Load Scroll To Top if Not IE6
		$scrollIncompatible = array('ie6', 'iphone', 'ipod', 'ipad', 'blackberry', 'palmos', 'android');
		if ($this->scrolltop && !(in_array($this->browser, $scrollIncompatible))) {
			$scripts .= '
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery(function () {
					var scrollDiv = document.createElement("div");
					jQuery(scrollDiv).attr("id", "toTop").html("'.$scrollText.'").appendTo("body");
					jQuery(window).scroll(function () {
						if (jQuery(this).scrollTop() != 0) {
							jQuery("#toTop").fadeIn();
						} else {
							jQuery("#toTop").fadeOut();
						}
					});
			jQuery("#toTop").click(function () {
				jQuery("body, html").animate({
					scrollTop: 0
				},
				800);
			});
			});
			});
			</script>
			';
		}

		// ------------------------------------------------------------------------
		// Scroll to bottom
		//

		if ($this->scrollbottom && !(in_array($this->browser, $scrollIncompatible))) {
			$scripts .= '
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("a.scroll").click(function() {
					if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "")
						&& location.hostname == this.hostname) {
			var jQuerytarget = jQuery(this.hash);
			jQuerytarget = jQuerytarget.length && jQuerytarget || jQuery("[name=\" + this.hash.slice(1) +\"]");
			if (jQuerytarget.length) {
				var targetOffset = jQuerytarget.offset().top;
				jQuery("html, body").animate({scrollTop: targetOffset}, 1000);

				return false;
			}
		}
		});
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() != 0) {
				jQuery(".scroll").fadeOut();
			} else {
				jQuery(".scroll").fadeIn();
			}
		});
		});
		</script>
		';

		}

		if ($this->lazyLoad) {
				// ------------------------------------------------------------------------
				// Lazyload Effect
				//
			$scripts .= '
			<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("'.$this->lazyloadSelector.'").lazyload({
					effect : "fadeIn"
				});
		});
		</script>
		';
		}

		if ($this->stickynav) {
			$scripts .= '
			<script type="text/javascript">
						// Sticky Nav
			jQuery(window).scroll(function(e){
				el = jQuery("#navwrap"); // element you want to scroll
				var navHeight = jQuery(el).height();

				jQueryscrolling = 0; // Position you want element to assume during scroll
				jQuerybounds = '.$this->stickynavthreshold.'; // boundary of when to change element to fixed and scroll

				if (jQuery(this).scrollTop() > jQuerybounds && el.css("position") != "fixed") {
					jQuery(el).css({"position": "fixed", "top": jQueryscrolling, "display": "none"}).addClass("sticky").fadeIn("slow");
					jQuery("body").addClass("sticky");

					jQuery("body").prepend("<div id=\"stickyreplace\"></div>");
					jQuery("#stickyreplace").height(navHeight);
				}
				if (jQuery(this).scrollTop() < jQuerybounds && el.css("position") != "absolute") {
					jQuery(el).css({"position": "relative", "top": "0px"}).removeClass("sticky");
					jQuery("body").removeClass("sticky");
					jQuery("#stickyreplace").remove();
				}
			});
		</script>
		';
		}

		$body = str_replace ("__BOTTOMSCRIPTS__", $scripts, $body);
		JResponse::setBody($body);

		// ZenBench::stop('onAfterRender');

		return true;
	}

	/**
	 * Check if should clear the cache, based on request params
	 *
	 * @return mixed
	 */
	protected function checkClearCacheAction()
	{
		// Check for clear cache command
		$clearCache = JRequest::getVar('clearcache', 0, 'get');
		if ($clearCache === 'css' || $clearCache === 'js') {
			$hasCache = false;
			$cacheDir = JPATH_ROOT . '/cache/zengridframework/' . $clearCache . '/';

			foreach (glob($cacheDir.'*') as $file) {
				chmod($file, 0777);
				unlink($file);
				$hasCache = true;
			}

			if (file_exists($cacheDir)) {
				chmod($cacheDir, 0777);
				rmdir($cacheDir);
			}

			// Check if the cache was completely cleaned
			$resp = new stdClass;
			if ($hasCache) {
				$resp->result = count(glob($cacheDir.'*')) > 0 ? 0 : 1;
			} else {
				$resp->result = -1;
			}

			JResponse::setBody(json_encode($resp));

			return true;
		}

		return;
	}
}