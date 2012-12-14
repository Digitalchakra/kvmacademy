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

class JElementItems extends JElement
{
   var   $_name = 'Items';

   function fetchElement($name, $value, &$node, $control_name)
   {
		if (ZenHelper::isK2Installed())
		{
			$db = &JFactory::getDBO();
			$jnow = &JFactory::getDa2te();

			if (version_compare(JVERSION, '3.0', '<'))
			{
				$now = $jnow->toMySQL();
			}
			else
			{
				$now = $jnow->toSql();
			}

			$nullDate = $db->getNullDate();
			$size = ( $node->attributes('size') ? $node->attributes('size') : 5 );
			$query = "SELECT id, title FROM #__k2_items
					WHERE published = 1
					AND trash = 0
					AND ( publish_up = ".$db->Quote($nullDate)." OR publish_up <= ".$db->Quote($now)." )
					AND ( publish_down = ".$db->Quote($nullDate)." OR publish_down >= ".$db->Quote($now)." )
					ORDER BY title";
			$db->setQuery($query);
			$options = $db->loadObjectList();

		  	return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.'][]', 'class="inputbox" style="width:90%;" multiple="multiple" size="5"', 'id', 'title', $value, $control_name.$name);
		} else {
			return JText::_('K2 is not installed');
		}
	}
}
