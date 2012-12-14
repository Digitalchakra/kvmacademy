<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

// Check to ensure this file is within the rest of the framework
defined('_JEXEC') or die();

class ZenGridBase
{
	/**
	 * The global application object.
	 * We use this as a cache avoiding a lot of variables
	 * with the same reference for JApplication instances.
	 * So we should use: $framework->app->method();
	 * instead of call $app = JFactory::getApplication();
	 * $app->method(); everywhere.
	 *
	 * @var    JApplication
	 *
	 * @since  3.0.0
	 */
	public $app;

	/**
	 * The global document object
	 *
	 * @var    JDocument
	 *
	 * @since  3.0.0
	 */
	public $doc;

	public static $hasOldFramework = null;

	public static $hasJbLibrary = null;

	protected $plugin;

	public function __construct($plugin = null)
	{
		$this->app = JFactory::getApplication();
		$this->doc = JFactory::getDocument();
		$this->plugin = $plugin;

		$this->plugin->loadLanguage();
	}

	public static function hasOldFramework()
	{
		if (self::$hasOldFramework === null)
		{
			$path = JPATH_ROOT . '/templates/zengridframework/index.php';
			self::$hasOldFramework = (bool) file_exists($path);
		}

		return self::$hasOldFramework;
	}

	public static function hasJbLibrary()
	{
		if (self::$hasJbLibrary === null)
		{
			if (substr(JVERSION, 0, 3) === '1.5')
			{
				$path = JPATH_ROOT . '/plugins/system/jblibrary.php';
			}
			else
			{
				$path = JPATH_ROOT . '/plugins/system/jblibrary/jblibrary.php';
			}

			self::$hasJbLibrary = (bool) file_exists($path);
		}

		return self::$hasJbLibrary;
	}

	/**
	 * Load language files for this plugin
	 *
	 * @param   string $extension Extension name
	 * @param   string $basePath  The base path
	 */
	public function loadLanguage($extension = 'plg_system_zengridframework', $basePath = JPATH_ADMINISTRATOR)
	{
		// Load the admin language file
		$this->plugin->loadLanguage($extension, $basePath);

		// Loads English language file as fallback (for undefined stuff in other language file)
		JFactory::getLanguage()->load($extension, $basePath, 'en-GB', true);
	}

	public function getFrameworkMediaPath()
	{
		return '/media/system/zengridframework';
	}

	public function templateIsOldFramework()
	{

	}

	public function templateIsCompatible()
	{
		$template = $this->getTemplateName();

		if (!$template)
		{
			return false;
		}

		return file_exists(JPATH_SITE . '/templates/' . $template . '/includes/config.php');
	}

	/*
	 * Method to get the parent Menu-Item of the current page
	 *
	 * @static
	 * @access public
	 * @param int $level
	 * @return string
	 */
	public function getActiveParent($level = 0)
	{
		// Fetch the active menu-item
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();

		// Get the parent (at a certain level)
		$parent = $active->tree[$level];

		// Return the title of this Menu-Item
		return $menu->getItem($parent)->name;
	}

	/*
	 * Method to determine whether the current page is the Joomla! homepage
	 *
	 * @static
	 * @access public
	 * @param null
	 * @return bool
	 */
	public function isHome()
	{
		// Fetch the active menu-item
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();

		// Return whether this active menu-item is home or not
		if (isset($active)) 
		return (boolean)$active->home;
		else return;
	}

	/*
	 * Method to add a global title to every page title
	 *
	 * @static
	 * @access public
	 * @param string $global_title
	 * @return null
	 */
	public function addGlobalTitle($global_title = null)
	{
		// Get the current title
		$document = JFactory::getDocument();
		$title = $document->getTitle();

		// Add the global title to the current title
		$document->setTitle($title . '' . $global_title);
	}

	/*
	 * Method to detect a certain browser type
	 *
	 * @static
	 * @access public
	 * @param string $shortname
	 * @return string
	 */
	public function isBrowser($shortname = 'ie6')
	{
		jimport('joomla.environment.browser');
		$browser = JBrowser::getInstance();
		$agent = $browser->getAgentString();

		$rt = false;
		switch ($shortname) {
			case 'ie6':
				$rt = (stripos($agent, 'msie 6')) ? true : false;
				break;

			case 'ie7':
				$rt = (stripos($agent, 'msie 7')) ? true : false;
				break;

			case 'ie8':
				$rt = (stripos($agent, 'msie 8')) ? true : false;
				break;
		}

		return $rt;
	}

	/*
	 * Method to return browser type
	 *
	 * @static
	 * @access public
	 * @param none
	 * @return string
	 */
	public function getBrowser()
	{
		jimport('joomla.environment.browser');
		$browser = JBrowser::getInstance();
		$agent_string = $browser->getAgentString();


		if (stripos($agent_string, 'firefox') !== false) :
		$agent = 'firefox';
		elseif (stripos($agent_string, 'chrome') !== false) :
		$agent = 'chrome';
		elseif (stripos($agent_string, 'msie 9') !== false) :
			$agent = 'ie9';
		elseif (stripos($agent_string, 'msie 8') !== false) :
		$agent = 'ie8';
		elseif (stripos($agent_string, 'msie 7') !== false) :
		$agent = 'ie7';
		elseif (stripos($agent_string, 'msie 6') !== false) :
		$agent = 'ie6';
		elseif (stripos($agent_string, 'iphone') !== false || stripos($agent_string, 'ipod') !== false) :
		$agent = 'iphone';
		elseif (stripos($agent_string, 'ipad') !== false) :
		$agent = 'ipad';
		elseif (stripos($agent_string, 'blackberry') !== false) :
		$agent = 'blackberry';
		elseif (stripos($agent_string, 'palmos') !== false) :
		$agent = 'palm';
		elseif (stripos($agent_string, 'android') !== false) :
		$agent = 'android';
		elseif (stripos($agent_string, 'safari') !== false) :
		$agent = 'safari';
		elseif (stripos($agent_string, 'opera') !== false) :
		$agent = 'opera';
		else :
		$agent = null;
		endif;

		return $agent;
	}

	/**
	 * Count modules for an array of positions
	 *
	 * @param  array  $positions Array with the positions
	 * @return int               The sum of modules on that positions
	 */
	public function countModulesForPositions($positions = array())
	{
		$total = 0;

		foreach ($positions as $position)
		{
			$total += $this->countModules($position);
		}

		return $total;
	}

	/*
	* Method to determine whether a certain module is loaded or not
	*
	* @static
	* @access public
	* @param mixed $name Can be a module name, or an array of names
	* @return boolean
	*/
	public static function hasModule($name, $title = null)
	{
		if (is_array($name))
		{
			foreach ($name as $module)
			{
				if (self::hasModule($module))
				{
					return true;
				}
			}
		}
		else
		{
			$modules	= self::loadPublishedModules();
			$total		= count($modules);
			for ($i = 0; $i < $total; $i++)
			{
				// Match the name of the module
				if ($modules[$i]->name == $name)
				{
					// Match the title if we're looking for a specific instance of the module
					if (! $title || $modules[$i]->title == $title)
					{
						return true;
					}
				}
			}
		}

		return false;
	}


	/**
	 * This function will be overridden
	 * @return array
	 */
	public static function loadPublishedModules()
	{
		return array();
	}
}