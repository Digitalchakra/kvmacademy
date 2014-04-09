<?php
/**
 * @package     ##package##
 * @subpackage  ##subpackage##
 * @author      ##author##
 * @copyright   ##copyright##
 * @license     ##license##
 * @version     ##version##
 */

// no direct access
defined('_JEXEC') or die('Restricted index access');

class JElementZencache extends JElement
{
	var  $_name = 'Zencache';

	function fetchElement($name, $value, &$node, $control_name)
	{

		$html = '<input type="button" class="clearCacheButton" onclick="zenClearCache(this, \''.$node->attributes('section').'\', \''.JText::_('ZENCLEARCACHE_WAIT').'\', \''.JText::_('ZENCLEARCACHE_DONE').'\', \''.JText::_('ZENCLEARCACHE_ERROR').'\', \''.JText::_('ZENCLEARCACHE_NOCACHE').'\');" value="'.JText::_('ZENCLEARCACHE').'" />';

		return $html;
	}
		function fetchTooltip($label, $description, &$xmlElement, $control_name='', $name='') {
			return false;
		}
}
