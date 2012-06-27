<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class DbtDiary_Version extends Zikula_AbstractVersion
{
    public function getMetaData()
    {
        $meta = array();
        $meta['name']         = $this->__('DbtDiary');
        $meta['displayname']  = $this->__('DBT Diary');
        $meta['description']  = $this->__('Keep a log of the skills learned in DBT');
        $meta['url']         = $this->__('DbtDiary');
        $meta['version']      = '0.0.15';
        $meta['core_min']      =   '1.3.3';
        $meta['core_max']      =   '1.3.99';
        $meta['official']     = true;
        $meta['author']       = 'Chris Candreva';
        $meta['contact']      = 'http://github.com/ccandreva/DbtDiary';
        $meta['securityschema'] = array('DbtDiary::' => 'DbtDiary::');

        return $meta;
    }
}
        