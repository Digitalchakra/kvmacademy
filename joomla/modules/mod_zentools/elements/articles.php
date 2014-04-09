<?php
/**
 * @package    Zen Tools
 * @subpackage Zen Tools
 * @author     Joomla Bamboo - design@joomlabamboo.com
 * @copyright  Copyright (c) 2012 Joomla Bamboo. All rights reserved.
 * @license    GNU General Public License version 2 or later
 * @version    1.7.2
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
class JElementArticles extends JElement
{
	var   $_name = 'Articles';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$db = JFactory::getDBO();
		$size = ( $node->attributes('size') ? $node->attributes('size') : 5 );
	  $query = 'SELECT id, title FROM #__content WHERE state=1 ORDER BY title';
		$db->setQuery($query);
		$options = $db->loadObjectList();

		return JHTML::_('select.genericlist',  $options, ''.$control_name.'['.$name.'][]',  'class="inputbox" style="width:90%;" multiple="multiple" size="5"', 'id', 'title', $value, $control_name.$name);
	}
}
