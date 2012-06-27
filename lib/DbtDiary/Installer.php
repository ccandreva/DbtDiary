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
        $this->LoadSkills();
        if (!DBUtil::createTable('dbtdiary_skillsused')) return false;
        if (!DBUtil::createTable('dbtdiary_distress_levels')) return false;
        if (!DBUtil::createTable('dbtdiary_proscons')) return false;
        DBUtil::createIndex('UidDate', 'dbtdiary_skillsused', 
            array('uid', 'date', 'skill'), array('UNIQUE' => true));
        if ( !DBUtil::createTable('dbtdiary_dailygoals') ) return false;
        DBUtil::createIndex('UidDate', 'dbtdiary_dailygoals', 
                array('uid', 'date'));
        if ( !DBUtil::createTable('dbtdiary_weeklygoals') ) return false;
        DBUtil::createIndex('UidDate', 'dbtdiary_weeklygoals', 
                array('uid', 'date'));
        if ( !DBUtil::createTable('dbtdiary_goals') ) return false;
        DBUtil::createIndex('UidDate', 'dbtdiary_goals', 
                array('uid', 'cr_date'));
        if ( !DBUtil::createTable('dbtdiary_minigoals') ) return false;
        DBUtil::createIndex('UidGoal', 'dbtdiary_minigoals', 
                array('uid', 'goal'));
        if ( !DBUtil::createTable('dbtdiary_minigoaldt') ) return false;
        DBUtil::createIndex('GoalDate', 'dbtdiary_minigoaldt', 
                array('minigoal', 'date'));
        DBUtil::createIndex('DateGoal', 'dbtdiary_minigoaldt', 
                array('date', 'minigoal'));

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

            case "0.0.8" :
                $this->LoadSkills();

            case "0.0.10" :
                if (!DBUtil::createTable('dbtdiary_skillsused')) return false;
                DBUtil::createIndex('UidDateSkill', 'dbtdiary_skillsused', 
                    array('uid', 'date', 'skill'),
                    array('UNIQUE' => true) );

            case "0.0.11" :
                    if ( !DBUtil::createTable('dbtdiary_weeklygoals') ) return false;
                    DBUtil::createIndex('UidDate', 'dbtdiary_weeklygoals', 
                    array('uid', 'date'),
                    array('UNIQUE' => true) );

            case "0.0.12" :
                if (!DBUtil::createTable('dbtdiary_distress_levels')) return false;
                if (!DBUtil::createTable('dbtdiary_proscons')) return false;

            case "0.0.13" :
                if (!DBUtil::changeTable('dbtdiary_weeklygoals')) return false;
                if (!DBUtil::createTable('dbtdiary_goals')) return false;
                DBUtil::createIndex('UidDate', 'dbtdiary_goals', 
                array('uid', 'cr_date'));
                
            case "0.0.14" :
                if ( !DBUtil::createTable('dbtdiary_minigoals') ) return false;
                DBUtil::createIndex('UidGoal', 'dbtdiary_minigoals', 
                        array('uid', 'minigoal'));
                if ( !DBUtil::createTable('dbtdiary_minigoaldt') ) return false;
                DBUtil::createIndex('GoalDate', 'dbtdiary_minigoaldt', 
                        array('minigoal', 'date'));
                DBUtil::createIndex('DateGoal', 'dbtdiary_minigoaldt', 
                        array('date', 'minigoal'));

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
        if ( !DBUtil::dropTable('dbtdiary_dailygoals') ) return false;
        DBUtil::dropTable('dbtdiary_modules');
        DBUtil::dropTable('dbtdiary_headings');
        DBUtil::dropTable('dbtdiary_skills');
        return true;
    }
    
    /*
     * Load Skills from csv file into database.
     * Create the tables also while we are here.
     */
    private function LoadSkills()
    {
        
        $mID=0;
        $hID=0;

        DBUtil::dropTable('dbtdiary_modules');
        DBUtil::dropTable('dbtdiary_headings');
        DBUtil::dropTable('dbtdiary_skills');
        DBUtil::createTable('dbtdiary_modules');
        DBUtil::createTable('dbtdiary_headings');
        DBUtil::createTable('dbtdiary_skills');
        
        $f = fopen('modules/DbtDiary/docs/Skills.csv', 'r');
        while (($rec = fgets($f)) !== false) {
            $rec = chop($rec);
            list($mod, $head, $skill) = explode(',', $rec);
            
            $htskill = preg_replace('/~(\w)/', '<strong>$1</strong>', $skill);
            $skill = preg_replace('/<[^>]+>|~/', '', $skill);
            
            
            if ($mod) {
                $modObject = array('name' => $mod);
                DBUtil::insertObject($modObject,'dbtdiary_modules' );
                $mID = $modObject['id'];
                
                if (!$head) {
                    $hObj = array('name' => '', 'module' => $mID);
                    DBUtil::insertObject($hObj,'dbtdiary_headings' );
                    $hID = $hObj['id'];
                }
            }
                
            if ($head){
                $hObj = array('name' => $head, 'module' => $mID);
                DBUtil::insertObject($hObj,'dbtdiary_headings' );
                $hID = $hObj['id'];
            }
            if ($skill){
                $sObj = array('name' => $skill, 'htname' => $htskill,
                    'heading' => $hID);
                DBUtil::insertObject($sObj,'dbtdiary_skills' );
            }
            
        }
        fclose($f);
        
        return true;
    }

}
