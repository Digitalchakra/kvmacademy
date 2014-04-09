<?php
/**
 * @version   $Id: compatability.php 4051 2012-10-01 22:40:44Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('_JEXEC') or die('Restricted access');

if (!class_exists('RokSprocketLegacyJView', false)) {
  $jversion = new JVersion();
  if (version_compare($jversion->getShortVersion(), '2.5.5', '>')) {
    class RokSprocketLegacyJView extends JViewLegacy
    {
    }

    class RokSprocketLegacyJController extends JControllerLegacy
    {
    }

    class RokSprocketLegacyJModel extends JModelLegacy
    {
    }
  } else {
    jimport('joomla.application.component.view');
    jimport('joomla.application.component.controller');
    jimport('joomla.application.component.model');
    class RokSprocketLegacyJView extends JView
    {
    }

    class RokSprocketLegacyJController extends JController
    {
    }

    class RokSprocketLegacyJModel extends JModel
    {
    }
  }
}
