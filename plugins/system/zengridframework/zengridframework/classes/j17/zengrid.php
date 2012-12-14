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

final class ZenGrid extends ZenGridBase
{
	/**
	 * The framework instance
	 *
	 * @var    ZenGrid
	 *
	 * @since  2.0.0
	 */
	protected static $instance;

	protected $templateManifest;

	protected $frameworkManifest;

	protected $templateParams;

	/**
	 * Returns a refernce to the global ZenGrid object, only creating it if it doesn't already exist.
	 *
	 * This method must be invoked as: $fmwk = ZenGrid::getInstance();
	 *
	 * @return  ZenGrid
	 *
	 * @since   2.0.0
	 */
	public static function getInstance($plugin = null)
	{
		// Only create the object if it doesn't exist.
		if (empty(self::$instance))
		{
			self::$instance = new self($plugin);
		}

		return self::$instance;
	}

	public function getFrameworkPath()
	{
		return '/plugins/system/zengridframework/zengridframework';
	}

	/**
	 * Returns the template manifest
	 *
	 * @param  boolean $force Force to reload the manifest
	 * @return [type]         The manifest XML
	 */
	public function getFrameworkManifest($force = false)
	{
		if (!isset($this->frameworkManifest) || $force)
		{
			$this->frameworkManifest = simplexml_load_file(JPATH_ROOT . $this->getFrameworkPath() . '/../zengridframework.xml');
		}

		return $this->frameworkManifest;
	}

	/**
	 * Returns the template manifest
	 *
	 * @param  boolean $force Force to reload the manifest
	 * @return [type]         The manifest XML
	 */
	public function getTemplateManifest($force = false)
	{
		if (!isset($this->templateManifest) || $force)
		{
			require_once JPATH_ROOT . '/plugins/system/zengridframework/zengridframework/classes/zengridtemplatemanifest.php';
			$this->templateManifest = new ZenGridTemplateManifest(JPATH_ROOT . '/templates/' . $this->getTemplateName() . '/templateDetails.xml');
		}

		return $this->templateManifest;
	}

	/**
	 * Get the template style params
	 *
	 * @param  string $param The param name
	 * @return string        The param value
	 */
	public function getParam($param)
	{
		if (!isset($this->templateParams))
		{
			if ($this->app->isAdmin())
			{
				jimport('joomla.environment.request');
				$id	= JRequest::getInt('id');

				// Load the site template params from the database
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->select('params');
				$query->from('#__template_styles');
				$query->where('id = ' . $id);
				$db->setQuery($query);
				$result = $db->loadObject();

				$this->templateParams = new JRegistry($result->params);
			}
			else
			{
				$template = $this->app->getTemplate(true);
				$this->templateParams = $template->params;
			}
		}

		$value = $this->templateParams->get($param);
		if ($value)
		{
			return $value;
		}
		else
		{
			return false;
		}
	}





	/*
	 * Method to get the HTML of a splitmenu
	 *
	 * @static
	 * @access public
	 * @param string $menu
	 * @param int $startLeve
	 * @param int $endLevel
	 * @param bool $show_children
	 * @return string
	 */
 public function getSplitMenu($menu = 'mainmenu', $startLevel = 0, $endLevel = 1, $show_children = false)
   {
	   // Import the module helper
	   jimport('joomla.application.module.helper');

	   // Get a new instance of the mod_mainmenu module
	   $module = JModuleHelper::getModule('mod_menu', 'mainmenu');
	   if (!empty($module) && is_object($module)) {

		   // Construct the module parameters (as a string)
		   $params = "menutype=".$menu."\n"
			   . "showAllChildren=".$show_children."\n"
			   . "startLevel=".$startLevel."\n"
			   . "endLevel=".$endLevel;
		   $module->params = $params;

		   // Construct the module options
		   $options = array('style' => 'raw');

		   // Render this module
		   $document = JFactory::getDocument();
		   $renderer = $document->loadRenderer('module');
		   $output = $renderer->render($module, $options);
		   return $output;

	   }

	   return null;
   }

	/*
	 * Method to determine the number of modules published to a templates module position
	 *Replicated from core J helper
	 * @static
	 * @access public
	 * @param string $condition
	 * @return int
	 */
	public function countModules($condition)
	{
		$result = '';
		$document = JFactory::getDocument();
		$operators = '(\+|\-|\*|\/| == |\!=|\<\>|\<|\>|\<=|\>=|and|or|xor)';
		$words = preg_split('# '.$operators.' #', $condition, null, PREG_SPLIT_DELIM_CAPTURE);
		for ($i = 0, $n = count($words); $i < $n; $i+=2)
		{
			// odd parts (modules)
			$name      = strtolower($words[$i]);
			$buffer    = $document->getBuffer();
			$words[$i] = ((isset($buffer['modules'][$name])) && ($buffer['modules'][$name] === false)) ? 0 : count(self::getModules($name));
		}

		$str = 'return '.implode(' ', $words).';';

		return eval($str);
	}

	/*
	 * Method to determine the number of modules published to a templates module position

	 * @static
	 * @access public
	 * @param string $name
	 * @return Module Object array
	 */
	public function getModules($position)
	{
		$app		= JFactory::getApplication();
		$position	= strtolower($position);
		$result		= array();

		$modules = self::loadPublishedModules();

		$total = count($modules);
		for ($i = 0; $i < $total; $i++)
		{
			if ($modules[$i]->position == $position) {
				$result[] = &$modules[$i];
			}
		}

		if (count($result) == 0) {
			if (JRequest::getBool('tp') && JComponentHelper::getParams('com_templates')->get('template_positions_display')) {
				$result[0] = self::getModule('mod_'.$position);
				$result[0]->title = $position;
				$result[0]->content = $position;
				$result[0]->position = $position;
			}
		}

		return $result;
	}

	/*
	 * Method to return a certain modules parameters
	 *
	 * @static
	 * @access public
	 * @param string $name
	 * @return array
	 */
	public function getModuleParams($name = '')
	{
		// Import the module helper
		jimport('joomla.application.module.helper');

		$module = JModuleHelper::getModule($name);
		if (is_object($module)) {
			return $module->params;
		}

		return false;
	}


	/*
	 * Method to return a certain module parameter for every instance of a module
	 *
	 * @static
	 * @access public
	 * @param string $name
	 * @return array
	 */
	public function getModuleParamArray($name = '', $param = '')
	{

		$result		= array();
		$modArray 	= array();
		$modules	= self::loadPublishedModules();
		$total		= count($modules);
		for ($i = 0; $i < $total; $i++)
		{
			// Match the name of the module
			if ($modules[$i]->name == $name)
			{
				$modArray[] =& $modules[$i];
			}
		}
		// Import the module helper
		jimport('joomla.application.module.helper');
		foreach ($modArray as $module){
			if (is_object($module)) {
				$result[] = $mod_params->get($param);
			}
		}

		return $result;
	}

	/*
	 * Method to verify if a certain module has a certain parameter value
	 *
	 * @static
	 * @access public
	 * @param string $name, $param, $value
	 * @return boolean
	 */
	public function hasModuleParamValue($name = '', $param = '', $value = '')
	{
		return in_array($value, self::getModuleParamArray($name, $param));
	}


	/*
	 * Method to return a certain modules parameters for plugin events
	 *
	 * @static
	 * @access public
	 * @param string $name
	 * @return array
	 */
	public function getModuleParamsZGF($name = '')
	{
		// Import the module helper
		jimport('joomla.application.module.helper');

		$module = self::getModule($name);
		if (is_object($module)) {
			return $module->params;
		}

		return false;
	}

	/*
	 * Method to return a module
	 *
	 * @static
	 * @access public
	 * @param string $name
	 * @return Module Object
	 */

	function getModule($name, $title = null)
	{
		$result  = null;
		$modules = self::loadPublishedModules();
		$total   = count($modules);

		for ($i = 0; $i < $total; $i++)
		{
			// Match the name of the module
			if ($modules[$i]->name == $name || $modules[$i]->module == $name) {
				// Match the title if we're looking for a specific instance of the module
				if (!$title || $modules[$i]->title == $title) {
					// Found it
					$result = &$modules[$i];
					break;	// Found it
				}
			}
		}

		// If we didn't find it, and the name is mod_something, create a dummy object
		if (is_null($result) && substr($name, 0, 4) == 'mod_') {
			$result            = new stdClass;
			$result->id        = 0;
			$result->title     = '';
			$result->module    = $name;
			$result->position  = '';
			$result->content   = '';
			$result->showtitle = 0;
			$result->control   = '';
			$result->params    = '';
			$result->user      = 0;
		}

		return $result;
	}

	/**
	 * Load published modules
	 *
	 * @access	private
	 * @return	array
	 */
	public static function loadPublishedModules()
	{
		static $clean;

		if (isset($clean)) {
			return $clean;
		}

		$Itemid     = JRequest::getInt('Itemid');
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		$groups		= implode(', ', $user->getAuthorisedViewLevels());
		$lang 		= JFactory::getLanguage()->getTag();
		$clientId 	= (int) $app->getClientId();

		$cache 		= JFactory::getCache ('com_modules', '');
		$cacheid 	= md5(serialize(array($Itemid, $groups, $clientId, $lang)));

		if (!($clean = $cache->get($cacheid))) {
			$db	= JFactory::getDbo();

			$query = $db->getQuery(true);
			$query->select('m.id, m.title, m.module, m.position, m.content, m.showtitle, m.params, mm.menuid');
			$query->from('#__modules AS m');
			$query->join('LEFT', '#__modules_menu AS mm ON mm.moduleid = m.id');
			$query->where('m.published = 1');

			$query->join('LEFT', '#__extensions AS e ON e.element = m.module AND e.client_id = m.client_id');
			$query->where('e.enabled = 1');

			$date = JFactory::getDate();
			$now = $date->toMySQL();
			$nullDate = $db->getNullDate();
			$query->where('(m.publish_up = '.$db->Quote($nullDate).' OR m.publish_up <= '.$db->Quote($now).')');
			$query->where('(m.publish_down = '.$db->Quote($nullDate).' OR m.publish_down >= '.$db->Quote($now).')');

			$query->where('m.access IN ('.$groups.')');
			$query->where('m.client_id = '. $clientId);
			$query->where('(mm.menuid = '. (int) $Itemid .' OR mm.menuid <= 0)');

			// Filter by language
			if ($app->isSite() && $app->getLanguageFilter()) {
				$query->where('m.language IN (' . $db->Quote($lang) . ', ' . $db->Quote('*') . ')');
			}

			$query->order('m.position, m.ordering');

			// Set the query
			$db->setQuery($query);
			$modules = $db->loadObjectList();
			$clean	= array();

			if ($db->getErrorNum()){
				JError::raiseWarning(500, JText::sprintf('JLIB_APPLICATION_ERROR_MODULE_LOAD', $db->getErrorMsg()));
				return $clean;
			}

			// Apply negative selections and eliminate duplicates
			$negId	= $Itemid ? -(int)$Itemid : false;
			$dupes	= array();
			for ($i = 0, $n = count($modules); $i < $n; $i++)
			{
				$module = &$modules[$i];

				// The module is excluded if there is an explicit prohibition or if
				// the Itemid is missing or zero and the module is in exclude mode.
				$negHit	= ($negId === (int) $module->menuid)
				|| (!$negId && (int)$module->menuid < 0);

				if (isset($dupes[$module->id])) {
					// If this item has been excluded, keep the duplicate flag set,
					// but remove any item from the cleaned array.
					if ($negHit) {
						unset($clean[$module->id]);
					}
					continue;
				}

				$dupes[$module->id] = true;

				// Only accept modules without explicit exclusions.
				if (!$negHit) {
					//determine if this is a custom module
					$file				= $module->module;
					$custom				= substr($file, 0, 4) == 'mod_' ?  0 : 1;
					$module->user		= $custom;
					// Custom module name is given by the title field, otherwise strip off "mod_"
					$module->name		= $custom ? $module->title : substr($file, 4);
					$module->style		= null;
					$module->position	= strtolower($module->position);
					$clean[$module->id]	= $module;
				}
			}

			unset($dupes);

			// Return to simple indexing that matches the query order.
			$clean = array_values($clean);

			$cache->store($clean, $cacheid);
		}

		return $clean;
	}

	/**
	 * Get the current template name. If is Site Application, so use the loaded template.
	 * If is Administrator Application, so load the template name from database.
	 *
	 * @return string The template name
	 */
	public function getTemplateName()
	{
		if ($this->app->isAdmin())
		{
			jimport('joomla.environment.request');
			$id	= JRequest::getInt('id');

			if (JRequest::getCmd('option') === 'com_templates'
				&& JRequest::getCmd('view') === 'style'
				&& JRequest::getCmd('layout') === 'edit'
				&& !empty($id)
			)
			{
				// Load the site template name from the database
				$db = JFactory::getDbo();
				$query = $db->getQuery(true);
				$query->select('template');
				$query->from('#__template_styles');
				$query->where('id = ' . $id);
				$db->setQuery($query);
				$result = $db->loadObject();

				return $result->template;
			}

			return false;
		}
		else
		{
			return $this->app->getTemplate();
		}
	}
}
