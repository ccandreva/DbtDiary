<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

class DbtDiary_Util
{
    public function initListValues($list, $firstnull = null)
    {
            $temp = array();
            if ($firstnull ) $temp[] = array('text' => '', 'value' => '');
            foreach ($list as $item) {
                $v = preg_replace('/.reg;/', '', $item);
                $temp[] = array('text' => $v, 'value' => $v);
            }
            return $temp;
    }

    
}
?>
