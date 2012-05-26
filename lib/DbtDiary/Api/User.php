<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class DbtDiary_Api_User extends Zikula_AbstractApi
{
   /**
     * Get available menu links.
     *
     * @return array array of menu links.
     */
    public function getlinks($args)
    {
        if (SecurityUtil::checkPermission('DbtDiary::', '::', ACCESS_READ)) {
            $links = array(
              array('url' => ModUtil::url('DbtDiary', 'user', 'viewdiary'),
                  text=>$this->__('View Diary'), 'class' => 'z-icon-es-view'),  
              array('url' => ModUtil::url('DbtDiary', 'user', 'editdiaryentry'),
                  text=>$this->__('Edit Diary'), 'class' => 'z-icon-es-edit'),  
            );
        }        
        return $links;
    }

}