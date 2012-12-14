<?php
/**
 * @version   $Id$
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Provider_Cfs_CategoryPopulator implements RokCommon_Filter_IPicklistPopulator
{
    /**
     *
     * @return array;
     */
    public function getPicklistOptions()
    {
        $args = array(
        	'type'                     => 'post',
        	'child_of'                 => 0,
        	'parent'                   => '',
        	'orderby'                  => 'name',
        	'order'                    => 'ASC',
        	'hide_empty'               => 1,
        	'hierarchical'             => 1,
        	'exclude'                  => '',
        	'include'                  => '',
        	'number'                   => '',
        	'taxonomy'                 => 'category',
        	'pad_counts'               => false );

        $categories = get_categories( $args );

        foreach ( $categories as $cat) {
            $options[$cat->term_id] = $cat->name;
        }
        return $options;
    }
}
