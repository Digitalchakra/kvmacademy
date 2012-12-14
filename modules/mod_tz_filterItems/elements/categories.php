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
jimport('joomla.form.formfield');

class JFormFieldCategories extends JFormField
{
    var	$type = 'categories';
    function getInput() {
        return $this->fetchElement($this->name, $this->value, $this->element, $this->options['control']);
    }

	function fetchElement($name, $value, &$node, $control_name) {

		$categories = JHtml::_('category.options', 'com_content');

		$category = JHtml::_(
			'select.genericlist',
			$categories,
			$name.'[]',
			'class="inputbox" style="width:90%;" multiple="multiple" size="10"',
			'value', 'text',
			$value
		);

		return $category;
	}

}
