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
		return '/plugins/system/zengridframework';
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
			$this->frameworkManifest = simplexml_load_file(JPATH_ROOT . '/plugins/system/zengridframework.xml');
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
			require_once JPATH_ROOT . '/plugins/system/zengridframework/classes/zengridtemplatemanifest.php';
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
			$template = $this->getTemplateName();
			$cont = null;
			$ini  = JPATH_THEMES . '/' . $template . '/params.ini';
			$xml  = JPATH_THEMES . '/' . $template . '/templateDetails.xml';

			jimport('joomla.filesystem.file');
			if (JFile::exists($ini))
			{
				$cont = JFile::read($ini);
			}
			else
			{
				$cont = null;
			}

			$this->templateParams = new JParameter($cont, $xml, $template);
		}

		return $this->templateParams->get($param);
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
	   $module = JModuleHelper::getModule('mod_mainmenu', 'mainmenu');
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
	 * Replicated from core J helper
	 *
	 * @static
	 * @access public
	 * @param string $condition
	 * @return int
	 */
	public function countModules($condition)
	{
		$result = '';

		$words = explode(' ', $condition);
		for ($i = 0; $i < count($words); $i+=2)
		{
			// odd parts (modules)
			$name		= strtolower($words[$i]);
			$words[$i]	= ((isset($this->_buffer['modules'][$name])) && ($this->_buffer['modules'][$name] === false)) ? 0 : count(self::getModules($name));
		}

		$str = 'return '.implode(' ', $words).';';

		return eval($str);
	}

	/*
	 * Method to determine the number of modules published to a templates module position
	 *
	 * @static
	 * @access public
	 * @param string $name
	 * @return Module Object array
	 */
	public function getModules($position)
	{
		$position	= strtolower($position);
		$result		= array();

		$modules = self::loadPublishedModules();

		$total = count($modules);
		for ($i = 0; $i < $total; $i++) {
			if ($modules[$i]->position == $position) {
				$result[] =& $modules[$i];
			}
		}
		if (count($result) == 0) {
			if (JRequest::getBool('tp')) {
				$result[0] = JModuleHelper::getModule('mod_'.$position);
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
		   $mod_params = new JParameter($module->params);
		   return $mod_params;
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
			   $mod_params = new JParameter($module->params);
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
		   $mod_params = new JParameter($module->params);
		   return $mod_params;
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
		$result		= null;
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
					$result =& $modules[$i];
					break;	// Found it
				}
			}
		}

		// if we didn't find it, and the name is mod_something, create a dummy object
		if (is_null($result) && substr($name, 0, 4) == 'mod_')
		{
			$result				= new stdClass;
			$result->id			= 0;
			$result->title		= '';
			$result->module		= $name;
			$result->position	= '';
			$result->content	= '';
			$result->showtitle	= 0;
			$result->control	= '';
			$result->params		= '';
			$result->user		= 0;
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
		global $mainframe, $Itemid;

		static $modules;

		if (isset($modules)) {
			return $modules;
		}

		$user	= JFactory::getUser();
		$db		= JFactory::getDBO();

		$aid	= $user->get('aid', 0);

		$modules	= array();

		$wheremenu = isset($Itemid) ? ' AND (mm.menuid = '. (int) $Itemid .' OR mm.menuid = 0)' : '';

		$query = 'SELECT id, title, module, position, content, showtitle, control, params'
			. ' FROM #__modules AS m'
			. ' LEFT JOIN #__modules_menu AS mm ON mm.moduleid = m.id'
			. ' WHERE m.published = 1'
			. ' AND m.access <= '. (int)$aid
			. ' AND m.client_id = '. (int)$mainframe->getClientId()
			. $wheremenu
			. ' ORDER BY position, ordering';

		$db->setQuery($query);

		if (null === ($modules = $db->loadObjectList())) {
			JError::raiseWarning('SOME_ERROR_CODE', JText::_('Error Loading Modules') . $db->getErrorMsg());
			return false;
		}

		$total = count($modules);
		for ($i = 0; $i < $total; $i++)
		{
			//determine if this is a custom module
			$file					= $modules[$i]->module;
			$custom 				= substr($file, 0, 4) == 'mod_' ?  0 : 1;
			$modules[$i]->user  	= $custom;
			// CHECK: custom module name is given by the title field, otherwise it's just 'om' ??
			$modules[$i]->name		= $custom ? $modules[$i]->title : substr($file, 4);
			$modules[$i]->style		= null;
			$modules[$i]->position	= strtolower($modules[$i]->position);
		}

		return $modules;
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
			$id	= JRequest::getVar('cid');
			$id = $id[0];

			if (JRequest::getCmd('option') === 'com_templates'
				&& JRequest::getCmd('task') === 'edit'
				&& !empty($id)
			)
			{
				return $id;
			}

			return false;
		}
		else
		{
			return $this->app->getTemplate();
		}
	}
}
