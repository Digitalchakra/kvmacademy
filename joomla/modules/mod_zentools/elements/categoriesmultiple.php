<?php/** * @package		Zen Tools * @subpackage	Zen Tools * @author		Joomla Bamboo - design@joomlabamboo.com * @copyright 	Copyright (c) 2012 Joomla Bamboo. All rights reserved. * @license		GNU General Public License version 2 or later * @version		1.7.2 */// no direct accessdefined('_JEXEC') or die('Restricted access');require_once(JPATH_SITE . '/modules/mod_zentools/includes/zenhelper.php');class JElementCategoriesmultiple extends JElement{	var	$_name = 'categoriesmultiple';	function fetchElement($name, $value, &$node, $control_name)	{		if (ZenHelper::isK2Installed())		{			$db = &JFactory::getDBO();			$query = 'SELECT m.* FROM #__k2_categories m WHERE published=1 AND trash = 0 ORDER BY parent, ordering';			$db->setQuery( $query );			$mitems = $db->loadObjectList();			$children = array();			if ($mitems){				foreach ( $mitems as $v ){					$pt 	= $v->parent;					$list = @$children[$pt] ? $children[$pt] : array();					array_push( $list, $v );					$children[$pt] = $list;				}			}			$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );			$mitems = array();			foreach ( $list as $item ) {				$mitems[] = JHTML::_('select.option',  $item->id, '&nbsp;&nbsp;&nbsp;'.$item->treename );			}			$doc = & JFactory::getDocument();			$output= JHTML::_('select.genericlist',  $mitems, ''.$control_name.'['.$name.'][]',				'class="inputbox" style="width:90%;" multiple="multiple" size="10"', 'value', 'text', $value );			return $output;		}	}}