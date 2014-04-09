<?php
/*------------------------------------------------------------------------
    # (TZ Module, TZ Plugin, TZ Component)
    # ------------------------------------------------------------------------
    # author    Sunland .,JSC
    # copyright Copyright (C) 2011 Sunland .,JSC. All Rights Reserved.
    # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
    # Websites: http://www.TemPlaza.com
    # Technical Support:  Forum - http://www.TemPlaza.com/forums/
-------------------------------------------------------------------------*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class modFillterItemsHelper
{
	function getItemsCategory(&$params)
	{
        
		global $mainframe;
        $choosecontent  =  $params->get('choose');
        if($choosecontent == 1){
        require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
        require_once(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'utilities.php');
        require_once (JPATH_SITE.DS.'components'.DS.'com_content'.DS.'helpers'.DS.'route.php');
		$db			=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$userId		= (int) $user->get('id');

		$count		= (int) $params->get('count', 4);
        $cid = $params->get('category_id', NULL);
        $columns	= $params->get('columns', 2);
        $aid		= $user->get('aid', 0);
        $imagesize = $params->get('itemImgSize', '');
        require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'itemlist.php');
        $categories = K2ModelItemlist::getCategoryTree($cid);
        $sql = @implode(',', $categories);
		$query = "select  *, ki.id as kid, kc.id as catid  FROM #__k2_items ki LEFT JOIN #__k2_categories kc ON(ki.catid = kc.id) LEFT JOIN #__users us ON(ki.created_by = us.id) WHERE catid IN($sql)  ORDER BY created DESC";
        $db->setQuery($query, 0, $count);
        $items = $db->loadObjectList();
        require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'models'.DS.'item.php');
		$model = new K2ModelItem;

        if (count($items)) {

			foreach ($items as $item) {

				//Clean title
				$item->title = JFilterOutput::ampReplace($item->title);

				//Images
				if ($params->get('itemImage')) {

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->kid).'_XS.jpg'))
					$item->imageXSmall = JURI::root().'media/k2/items/cache/'.md5("Image".$item->kid).'_XS.jpg';

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->kid).'_S.jpg'))
					$item->imageSmall = JURI::root().'media/k2/items/cache/'.md5("Image".$item->kid).'_S.jpg';

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->kid).'_M.jpg'))
					$item->imageMedium = JURI::root().'media/k2/items/cache/'.md5("Image".$item->kid).'_M.jpg';

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->kid).'_L.jpg'))
					$item->imageLarge = JURI::root().'media/k2/items/cache/'.md5("Image".$item->kid).'_L.jpg';

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->kid).'_XL.jpg'))
					$item->imageXLarge = JURI::root().'media/k2/items/cache/'.md5("Image".$item->kid).'_XL.jpg';

					if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$item->kid).'_Generic.jpg'))
					$item->imageGeneric = JURI::root().'media/k2/items/cache/'.md5("Image".$item->kid).'_Generic.jpg';

					$image = 'image'.$params->get('itemImgSize','Small');
					if (isset($item->$image))
						$item->image = $item->$image;

				}

				//Read more link
				$item->link = urldecode(JRoute::_(K2HelperRoute::getItemRoute($item->kid.':'.urlencode($item->alias), $item->catid.':'.urlencode($item->categoryalias))));

				//Tags
				if ($params->get('itemTags')) {
					$tags = $model->getItemTags($item->id);
					for ($i = 0; $i < sizeof($tags); $i++) {
						$tags[$i]->link = JRoute::_(K2HelperRoute::getTagRoute($tags[$i]->name));
					}
					$item->tags = $tags;
				}

				//Category link
				if ($params->get('itemCategory'))
				$item->categoryLink = urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($item->catid.':'.urlencode($item->categoryalias))));


				// Introtext
				$item->text = '';
				if ($params->get('itemIntroText')) {
					// Word limit
					if ($params->get('itemIntroTextWordLimit')) {
						$item->text .= K2HelperUtilities::wordLimit($item->introtext, $params->get('itemIntroTextWordLimit'));
					} else {
						$item->text .= $item->introtext;
					}
				}

				//Clean the plugin tags
				$item->introtext = preg_replace("#{(.*?)}(.*?){/(.*?)}#s", '', $item->introtext);

				//Author


				$rows[] = $item;
			}

			return $rows;

		}
        } if($choosecontent ==0){
            $db			=& JFactory::getDBO();
            $user		=& JFactory::getUser();
            $count		= (int) $params->get('count', 12);
            $category   =  $params->get('category_content');
            $cnt      = count($category);
            if($cnt !=1){
            $sql = implode(",", $category);
            } else {
               $sql =  $category[0];
            }
            $query1 = "select  *, cat.id as catid, ct.id as cid FROM #__content ct LEFT JOIN #__categories cat ON(ct.catid = cat.id)  WHERE catid IN($sql) ORDER BY ct.ordering ASC";
            $db->setQuery($query1, 0, $count);
            $items = $db->loadObjectList();
            if(count($items)){
                foreach ($items as $item) {
                    $item->title = JFilterOutput::ampReplace($item->title);
                    if ($params->get('itemIntroText')) {
                        // Word limit
                        if ($params->get('itemIntroTextWordLimit')) {
                            $item->text .= K2HelperUtilities::wordLimit($item->introtext, $params->get('itemIntroTextWordLimit'));
                        } else {
                            $item->text .= $item->introtext;
                        }
                    }

                    $item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->cid, $item->catid, $item->sectionid));

                    $rows[] = $item;
                }
                return $rows;

            }
        }

	}

}

