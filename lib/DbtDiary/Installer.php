<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

class DbtDiary_Installer extends Zikula_AbstractInstaller
{
    public function install()
    {
        ModUtil::setVar('DbtDiary', 'modulestylesheet', 'style.css');
        ModUtil::setVar('DbtDiary', 'adminEmail', '');

        if ( !DBUtil::createTable('dbtdiary_diary') ) return false;
        DBUtil::createIndex('dbtdiary_diary_Iud', 'dbtdiary_diary', 
                array('uid', 'date'));
        if ( !DBUtil::createTable('dbtdiary_dailygoals') ) return false;
        DBUtil::createIndex('UidDate', 'dbtdiary_dailygoals', 
                array('uid', 'date'));

        return true;
    }

    public function upgrade($oldversion)
    {

        switch($oldversion) {

            case "0.0.0" :
                // if (!DBUtil::changeTable('dbtdiary_diary')) return false;
                if (!DBUtil::createTable('dbtdiary_dailygoals')) return false;
                DBUtil::createIndex('UidDate', 'dbtdiary_dailygoals', 
                array('uid', 'date'));
                
             // This break should be after the last upgrade
                break;

            default:
                SessionUtil::setVar('errormsg', __("An unknown version is installed!") );
                return false;
        }

        return true;
    }

    public function uninstall()
    {
        ModUtil::delVar('DbtDiary');
        if ( !DBUtil::dropTable('dbtdiary_diary') ) return false;
        return true;
    }
}
