<?php
/**
 * @version   $Id$
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Provider_Cfs_GroupPopulator implements RokCommon_Filter_IPicklistPopulator
{
    /**
     *
     * @return array;
     */
    public function getPicklistOptions()
    {
        $groups = get_posts(array('post_type'=>'cfs', 'order'=> 'ASC', 'orderby' => 'title'));
        if(count($groups)){
            foreach($groups as $group){
                $options[$group->ID] = $group->title;
            }
        }
        return $options;
    }
}
