<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

//no direct access
    defined('_JEXEC') or die('Restricted access');
    jimport('joomla.application.component.view');

class TZ_PortfolioViewTags extends JView
{
    function display($tpl = null){
        $state  = $this -> get('state');
        $params = $state -> params;
        $list   = $this -> get('Tags');
        foreach($list as $row){
            $dispatcher	= JDispatcher::getInstance();
                    //
            // Process the content plugins.
            //
            JPluginHelper::importPlugin('content');
            $results = $dispatcher->trigger('onContentPrepare', array ('com_tz_portfolio.tags', &$row, &$params, $state -> offset));

            $row->event = new stdClass();
            $results = $dispatcher->trigger('onContentAfterTitle', array('com_tz_portfolio.tags', &$row, &$params, $state -> offset));
            $row->event->afterDisplayTitle = trim(implode("\n", $results));

            $results = $dispatcher->trigger('onContentBeforeDisplay', array('com_tz_portfolio.tags', &$row, &$params,$state -> offset));
            $row->event->beforeDisplayContent = trim(implode("\n", $results));

            $results = $dispatcher->trigger('onContentAfterDisplay', array('com_tz_portfolio.tags', &$row, &$params, $state -> offset));
            $row->event->afterDisplayContent = trim(implode("\n", $results));
        }

        $this -> assign('listsTags',$list);
        $this -> assignRef('pagination',$this -> get('Pagination'));
        $this -> assignRef('tagsParams',$params);
        $this -> assignRef('mediaParams',$params);
        $params = $this -> get('state') -> params;
        $doc    = &JFactory::getDocument();
        $doc -> addScript(JURI::root()."components/com_tz_portfolio/js/jquery-1.7.2.min.js");

        if($params -> get('tz_use_image_hover',1) == 1):
            $doc -> addStyleDeclaration('
                .tz_image_hover{
                    opacity: 0;
                    position: absolute;
                    top:0;
                    left: 0;
                    transition: opacity '.$params -> get('tz_image_timeout',0.35).'s ease-in-out;
                   -moz-transition: opacity '.$params -> get('tz_image_timeout',0.35).'s ease-in-out;
                   -webkit-transition: opacity '.$params -> get('tz_image_timeout',0.35).'s ease-in-out;
                }
                .tz_image_hover:hover{
                    opacity: 1;
                    margin: 0;
                }
            ');
        endif;

        if($params -> get('tz_use_lightbox') == 1){
            $doc -> addScript('components/com_tz_portfolio/js/jquery.fancybox.pack.js');
            $doc -> addStyleSheet('components/com_tz_portfolio/assets/jquery.fancybox.css');

            $width      = null;
            $height     = null;
            $autosize   = null;
            if($params -> get('tz_lightbox_width')){
                if(preg_match('/%|px/',$params -> get('tz_lightbox_width'))){
                    $width  = 'width:\''.$params -> get('tz_lightbox_width').'\',';
                }
                else
                    $width  = 'width:'.$params -> get('tz_lightbox_width').',';
            }
            if($params -> get('tz_lightbox_height')){
                if(preg_match('/%|px/',$params -> get('tz_lightbox_height'))){
                    $height  = 'height:\''.$params -> get('tz_lightbox_height').'\',';
                }
                else
                    $height  = 'height:'.$params -> get('tz_lightbox_height').',';
            }
            if($width || $height){
                $autosize   = 'fitToView: false,autoSize: false,';
            }
            $doc -> addScriptDeclaration('
                jQuery(\'.fancybox\').fancybox({
                    type:\'iframe\',
                    openSpeed:'.$params -> get('tz_lightbox_speed',350).',
                    openEffect: "'.$params -> get('tz_lightbox_transition','elastic').'",
                    '.$width.$height.$autosize.'
		            closeClick	: false,
		            helpers:  {
                        title : {
                            type : "inside"
                        },
                        overlay : {
                            opacity:'.$params -> get('tz_lightbox_opacity',0.75).',
                            css : {
                                "background-color" : "#000"
                            }
                        }
                    }

                });
            ');
        }

        // Add feed links
		if ($params->get('show_feed_link', 1)) {
			$link = '&format=feed&limitstart=';
			$attribs = array('type' => 'application/rss+xml', 'title' => 'RSS 2.0');
			$doc->addHeadLink(JRoute::_($link . '&type=rss'), 'alternate', 'rel', $attribs);
			$attribs = array('type' => 'application/atom+xml', 'title' => 'Atom 1.0');
			$doc->addHeadLink(JRoute::_($link . '&type=atom'), 'alternate', 'rel', $attribs);
		}
        parent::display($tpl);
    }
}
