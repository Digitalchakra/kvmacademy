<?php
/**
 * @package		Zen Tools
 * @subpackage	Zen Tools
 * @author		Joomla Bamboo - design@joomlabamboo.com
 * @copyright 	Copyright (c) 2012 Joomla Bamboo. All rights reserved.
 * @license		GNU General Public License version 2 or later
 * @version		1.7.2
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

require_once(JPATH_SITE . '/modules/mod_zentools/includes/zenhelper.php');

// Create a category selector

class JFormFieldK2items extends JFormField
{
	protected $type = 'k2items';

	protected function getInput()
	{
		// Is K2 required but not installed?
		if (!ZenHelper::checkK2Requirement($this->element['requirement']))
		{
			return '';
		}

		return parent::getInput();
	}
}
