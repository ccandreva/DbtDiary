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
        ModUtil::setVar('wiifriends', 'modulestylesheet', 'wiifriends.css');
        ModUtil::setVar('wiifriends', 'adminEmail', '');

        if ( !DBUtil::createTable('wiifriends_console') ) return false;
        if ( !DBUtil::createTable('wiifriends_wfc') ) return false;
        DBUtil::createIndex('wiifriends_wfc_Igames', 'wiifriends_wfc', 'game');
        if ( !DBUtil::createTable('wiifriends_games') ) return false;


        return true;
    }

    public function upgrade($oldversion)
    {
        switch($oldversion) {
            case "1.0" :
                ModUtil::setVar('wiifriends', 'adminEmail', '');

                case "1.1" :
                case "1.1.1" :

            /* This break should be after the last upgrade */
                break;

            default:
                SessionUtil::setVar('errormsg', __("An unknown version is installed!") );
                return false;
        }

        return true;
    }

    public function uninstall()
    {
        ModUtil::delVar('wiifriends');
        if ( !DBUtil::dropTable('wiifriends_console') ) return false;
        if ( !DBUtil::dropTable('wiifriends_wfc') ) return false;
        if ( !DBUtil::dropTable('wiifriends_games') ) return false;
        return true;
    }
}
