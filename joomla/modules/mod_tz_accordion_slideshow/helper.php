<?php
/*------------------------------------------------------------------------
# (TZ Module, TZ Plugin, TZ Component)
# ------------------------------------------------------------------------
# author    TemPlaza
# copyright Copyright (C) 2011 TemPlaza. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.TemPlaza.com
# Technical Support:  Forum - http://www.TemPlaza.com/Forum/
-------------------------------------------------------------------------*/

// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * Helper class
 *
 * @static
 * @package		TZ Carousel Slideshow
 * @subpackage	Get Images
 * @since		1.5
 */
class modTZAccordionHelper {
	
	/**
	 * Image Wall
	 *
	 * @var integer
	 */
	var $_catid = null;
    var $_display   =   0;


	function modTZAccordionHelper($mycategory, $k2category, $display) {
        if ($display==0) {
            $this->_catid   =   $mycategory;
        } else {
            $this->_catid   =   $k2category;
        }

        $this->_display =   $display;
	}
	
	/**
	 * Method to get the Images Obj
	 *
	 * @since 1.5
	 */
	function getImages() {
		global $mainframe;
		$db = &JFactory::getDBO ();
        if ($this->_display == 0) {
            $query  =   'SELECT a.*,
                         CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,
                         CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug
                         FROM #__content AS a
                         INNER JOIN #__categories AS cc ON cc.id = a.catid
                         WHERE a.catid='.$this->_catid.' AND a.state=1 AND cc.published = 1';
        } else {
            require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
            
            $query = "SELECT i.*, c.name AS categoryname,c.id AS categoryid, c.alias AS categoryalias, c.params AS categoryparams";
            $query .= " FROM #__k2_items as i LEFT JOIN #__k2_categories c ON c.id = i.catid";
            $query .= " WHERE i.published = 1 AND i.catid=". $this->_catid;
        }
		$db->setQuery ( $query );
		$rows = $db->loadObjectList ();
		$arr = array ();
		for($i = 0; $i < count ( $rows ); $i ++) {
			$obj 		= 	new stdClass ();
			$obj->title = 	$rows [$i]->title;
			$obj->intro = 	strip_tags ( $rows [$i]->introtext );
			$img    	= 	$this->generateImgWithoutLink($rows[$i]);
			$obj->image	= 	$img->src;
            $obj->link  =   ($this->_display == 0 ) ? JRoute::_(ContentHelperRoute::getArticleRoute($rows [$i]->slug, $rows [$i]->catslug, $rows [$i]->sectionid)) : urldecode(JRoute::_(K2HelperRoute::getItemRoute($rows[$i]->id.':'.urlencode($rows[$i]->alias), $rows[$i]->catid.':'.urlencode($rows[$i]->categoryalias))));
			if ($obj->image) {
				$arr[]		=	$obj;
			}
		}

		return $arr;
	}
	
	protected function generateImgWithoutLink($row) {
		
		preg_match ( '/<img(.*?)>/i', $row->introtext.$row->fulltext, $match );
		$image = $match [0];
		$item = $match [1];
        $img    =   new stdClass();
		
		if (preg_match ( '/width="(.*?)"/i', $item, $match )) {
			$img->width = $match [1];
		} else {
			$img->width = '';
		}
		
		if (preg_match ( '/height="(.*?)"/i', $item, $match )) {
			$img->height = $match [1];
		} else {
			$img->height = '';
		}
		
		if (preg_match ( '/alt="(.*?)"/i', $item, $match )) {
			$img->alt = $match [1];
		} else {
			$img->alt = '';
		}
		
		if (preg_match ( '/title="(.*?)"/i', $item, $match )) {
			$img->title = $match [1];
		} else {
			$img->title = '';
		}
		
		if (preg_match ( '/class="(.*?)"/i', $item, $match )) {
			$img->class = $match [1];
		} else {
			$img->class = '';
		}
		
		if (preg_match ( '/src="(.*?)"/i', $item, $match )) {
			$img->src = $match [1];
		} else {
			return false;
		}
		
		return $img;
	
	}
}


