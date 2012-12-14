<?php
/*------------------------------------------------------------------------

# helper.php - YO SlideGallery

# ------------------------------------------------------------------------

# author    YOphp

# copyright Copyright (C) 2011 yophp.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.yophp.com

# Technical Support:  Forum - http://www.yophp.com/forums/

-------------------------------------------------------------------------*/

// no direct access
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 * mod_yo_slidegallery Helper class
 *
 * @static
 * @package		YO SlideGallery
 * @subpackage	Get Images
 * @since		1.5
 */
require_once JPATH_SITE.'/components/com_content/helpers/route.php';
jimport('joomla.filesystem.folder');
require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'itemlist.php');
require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'utilities.php');
class modTZSlideGalleryHelper {
	
	/**
	 * Image Wall
	 *
	 * @var integer
	 */
	var $_folder 	= 	null;
	var $_category	=	null;
	var $_diplay	=	null;
	var $_recurse	=	null;
	var $_random	=	null;
	
	function modTZSlideGalleryHelper($params) {
		$this->_folder 		= 	$params->get('myfolder','images/stories');
		$this->_category	=	$params->get('mycategory',0);
		$this->_diplay		=	$params->get('display',1);
		$this->_recurse		=	$params->get('recurse',0);
		$this->_random		=	$params->get('randomize',0);
        $category    =  $params->get('k2category');
        $categories  = K2ModelItemlist::getCategoryTree($category);
        $sql = @implode(',', $categories);
        $this->_k2category = $sql;
	}
	
	/**
	 * Method to get the Images Obj
	 *
	 * @since 1.5
	 */
	function getImages() {
		$arr = array ();
		if (intval($this->_diplay)==1) {
			$db = &JFactory::getDBO ();
			
			$query = 'SELECT a.*,
						 CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug,
						 CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug
						 FROM #__content AS a
						 INNER JOIN #__categories AS cc ON cc.id = a.catid ' 
						."WHERE catid=$this->_category AND state=1 AND cc.published = 1";
			$db->setQuery ( $query );
			$rows = $db->loadObjectList ();
			
			for($i = 0; $i < count ( $rows ); $i ++) {
				$image 			= 	new stdClass ();
				$image->alt		= 	$rows [$i]->title;
				$image->intro 	= 	strip_tags ( $rows [$i]->introtext );
				$image->link	=	JRoute::_(ContentHelperRoute::getArticleRoute($rows [$i]->slug, $rows [$i]->catslug));
				$image->src		= 	$this->generateImgWithoutLink($rows[$i]);
				if ($image->src) {
					$arr[]		=	$image;
				}
				
			}
		} elseif ($this->_diplay == 2) {

			$db = &JFactory::getDBO ();

			$query = "select  *, ki.id as kid FROM #__k2_items ki LEFT JOIN #__k2_categories kc ON(ki.catid = kc.id) WHERE catid IN ($this->_k2category) and ki.published = 1 ORDER BY created DESC";
			$db->setQuery ( $query );
			$rows = $db->loadObjectList ();

            foreach ($rows as $item) {

				//Clean title
				$item->title = JFilterOutput::ampReplace($item->title);

				//Images


					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->kid).'_XL.jpg'))
					$item->imageXLarge = JURI::root().'media/k2/items/cache/'.md5("Image".$item->kid).'_XL.jpg';

					$image = 'imageXLarge';
					if (isset($item->$image))
						$item->image = $item->$image;

				//Read more link
				$item->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($item->kid.':'.urlencode($item->alias), $item->catid.':'.urlencode($item->categoryalias))));

				$arr[] = $item;
			}


		} else {
			$myfolder	=	preg_replace('/\//', DS, $this->_folder);
			$recurse	=	intval($this->_recurse) ? true : false;
			$files		=	$this->files(JPATH_SITE.DS.$myfolder, '\.jpg$|\.gif$|\.bmp$|\.png$', $recurse, 1);
			
			$root_url = parse_url ( JURI::base () );
			for ($i = 0; $i < count($files); $i++) {
				$image			=	new stdClass();
				$image->src		=	'modules/mod_tz_slidegallery/slir/w' . 190 . '-h' . 190 . $root_url ['path'] . $this->_folder.'/'.$files[$i];
				$image->link	=	'#';
				$image->alt		=	$files [$i];
				$arr[]			=	$image;
			}
		}
		if (intval($this->_random)) {
			$arr	=	$this->shuffle_assoc($arr);
			
		}
		return $arr;
	}
	
	/**
	 * Utility function to read the files in a folder.
	 *
	 * @param	string	The path of the folder to read.
	 * @param	string	A filter for file names.
	 * @param	mixed	True to recursively search into sub-folders, or an
	 * integer to specify the maximum depth.
	 * @param	boolean	True to return the full path to the file.
	 * @param	array	Array with names of files which should not be shown in
	 * the result.
	 * @return	array	Files in the given folder.
	 * @since 1.5
	 */
	protected function files($path, $filter = '.', $recurse = false, $fullpath = false, $fulllink='', $exclude = array('.svn', 'CVS'))
	{
		// Initialize variables
		$arr = array();

		// Check to make sure the path valid and clean
		$path = JPath::clean($path);

		// Is the path a folder?
		if (!is_dir($path)) {
			JError::raiseWarning(21, 'JFolder::files: ' . JText::_('Path is not a folder'), 'Path: ' . $path);
			return false;
		}

		// read the source directory
		$handle = opendir($path);
		while (($file = readdir($handle)) !== false)
		{
			if (($file != '.') && ($file != '..') && (!in_array($file, $exclude))) {
				$dir = $path . DS . $file;
				$isDir = is_dir($dir);
				if ($isDir) {
					if ($recurse) {
						
						if (is_integer($recurse)) {
							$arr2 = $this->files($dir, $filter, $recurse - 1, $fullpath, $fulllink.'/'.$file);
						} else {
							$arr2 = $this->files($dir, $filter, $recurse, $fullpath, $fulllink.'/'.$file);
						}
						
						$arr = array_merge($arr, $arr2);
					}
				} else {
					if (preg_match("/$filter/", $file)) {
						if ($fullpath) {
							$arr[] = $fulllink . '/' . $file;
						} else {
							$arr[] = $file;
						}
					}
				}
			}
		}
		closedir($handle);

		asort($arr);
		return $arr;
	}
	
	protected function shuffle_assoc($list) {
  		if (!is_array($list)) return $list;

  		$keys = array_keys($list);
  		shuffle($keys);
  		$random = array();
  		foreach ($keys as $key)
    		$random[] = $list[$key];

  		return $random;
	}
	
	protected function generateImgWithoutLink($row) {
		
		preg_match ( '/<img(.*?)>/i', $row->introtext, $match );
		$image = $match [0];
		$item = $match [1];
		
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
			$root_url = parse_url ( JURI::base () );
			$image = 'modules/mod_yo_slidegallery/slir/w' . 190 . '-h' . 190 . $root_url ['path'] . $img->src ;
		} else {
			return false;
		}
		
		return $image;
	
	}
}