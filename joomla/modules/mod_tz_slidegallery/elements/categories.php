<?php
/**
 * @version		$Id: categories.php 888 2011-07-07 14:06:47Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks, a business unit of Nuevvo Webware Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

if(K2_JVERSION=='16'){
	jimport('joomla.form.formfield');
	class JFormFieldCategories extends JFormField {

		var	$type = 'categories';

		function getInput(){
			return JElementCategories::fetchElement($this->name, $this->value, $this->element, $this->options['control']);
		}
	}
}

jimport('joomla.html.parameter.element');

class JElementCategories extends JElement
{

	var	$_name = 'categories';

	function fetchElement($name, $value, &$node, $control_name) {
		$db = &JFactory::getDBO();

		$query = "SELECT * FROM #__categories  WHERE published = 1 AND extension='com_content' ORDER BY parent_id";
		$db->setQuery( $query );
		$mitems = $db->loadObjectList();
//		var_dump($mitems);
        $children = array();
		if ( $mitems )
		{
			foreach ( $mitems as $v )
			{
				if(K2_JVERSION=='16'){
					$v->title = $v->title;
//					$v->parent_id = $v->parent;

				}
				$pt = $v->parent_id;
//                echo "<p style='color:red;'>  $pt </p>";
				$list = @$children[$pt] ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}
		}
//		$list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );
//        var_dump($list);
//        die();
		$mitems = array();
		$mitems [] = JHTML::_ ( 'select.option', '0', '- ' . JText::_ ( 'K2_NONE' ) . ' -' );
		
		foreach ( $list as $item ) {
			$item->treename = JString::str_ireplace('&#160;', ' -', $item->treename);
			$mitems[] = JHTML::_('select.option',  $item->id, '   '.$item->title );
		}
		if(K2_JVERSION=='16'){
			$fieldName = $name;
		}
		else {
			$fieldName = $control_name.'['.$name.']';
			if($node->attributes('multiple')){
				$fieldName .= '[]';
			}
		}

		return JHTML::_('select.genericlist',  $mitems, $fieldName, '', 'value', 'text', $value );
	}

}
