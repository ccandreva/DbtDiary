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

    public function checkuser(&$uid, $access = ACCESS_READ)
    {

        $uid = UserUtil::getVar('uid');
        
        // If not logged in, redirect to login screen
        if (!UserUtil::isLoggedIn()) {
	{
	    $url = ModUtil::url('users', 'user', 'login',
		    array( 'returnpage' => urlencode(System::getCurrentUri()),
			)
	    );
	    return System::redirect($url);
	}

        // Perform access check
        if (!SecurityUtil::checkPermission('DbtDiary::', '::', $access)) {
            return LogUtil::registerPermissionError();
        }

        // Return false to signify everything is OK.
        return false;
    }
}
    
    public function getSkillsUsed($uid, $date)
    {
        $joinInfo = array(
            array ( 'join_table' => 'dbtdiary_skills',
                'join_field' => array('name','id'),
                'object_field_name' => array('name','skill_id'),
                'compare_field_table' => 'skill',
                'compare_field_join' => 'id'
            ),
            array ( 'join_table' => 'dbtdiary_headings',
                'join_field' => array('name'),
                'object_field_name' => array('heading'),
                'compare_field_table' => 'skills_heading',
                'compare_field_join' => 'id'
            ),
            array ( 'join_table' => 'dbtdiary_modules',
                'join_field' => array('name'),
                'object_field_name' => array('module'),
                'compare_field_table' => 'headings_module',
                'compare_field_join' => 'id'
            ),
            array ( 'join_table' => 'dbtdiary_distress_levels',
                'join_field' => array('before', 'after'),
                'object_field_name' => array('before', 'after'),
                'compare_field_table' => 'id',
                'compare_field_join' => 'id'
            ),
            array ( 'join_table' => 'dbtdiary_proscons',
                'join_field' => array('behavior', 'tolerate_pros', 'tolerate_cons', 'nottolerate_pros', 'nottolerate_cons'),
                'object_field_name' => array('behavior', 'tolerate_pros', 'tolerate_cons', 'nottolerate_pros', 'nottolerate_cons'),
                'compare_field_table' => 'id',
                'compare_field_join' => 'id'
            ),
        );
        
        $where = "skillsused_uid=$uid and skillsused_date='$date'";
        $skillsObj = DBUtil::selectExpandedObjectArray ('dbtdiary_skillsused',
                $joinInfo, $where, 'skill');
        return $skillsObj;


    }
    
    public function getWeek(&$start, &$end)
    {
        $w = date('w') - 1;
        if ($w < 0) $w = 6;
        $start = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')-$w, date('Y')));
        $end = date('Y-m-d', strtotime("+6 days", strtotime($start)));
    }
    
    public function initListValues($list, $firstnull = null)
    {
            $temp = array();
            if ($firstnull ) $temp[] = array('text' => '', 'value' => '');
            foreach ($list as $item) {
                $temp[] = array('text' => $item, 'value' => $item);
            }
            return $temp;
    }
    
    public function getEmotions()
    {
        return array('hurt', 'good', 'tense', 'miserable', 'panic', 
        'overwhelmed', 'angry', 'sad', 'hopeful', 'alone', 'distracted', 
        'bad', 'guilty', 'unreal');
    }

    public function getEmotionTypes()
    {
        return array(
        'hurt' => 'N',
        'good' => 'P',
        'tense' => 'N',
        'miserable' => 'N',
        'panic' => 'N',
        'overwhelmed' => 'N',
        'angry' => 'N',
        'sad' => 'N',
        'hopeful' => 'P',
        'alone' => 'N',
        'distracted' => 'N',
        'bad' => 'N',
        'guilty' => 'N',
        'unreal' => 'N',
        );
    }

    public function getUrges()
    {
        return array('injure', 'kill', 'meds', 'skip', 
                     'binge', 'purge', 'alcohol', 'drugs');
    }

/* Urges table again for later
    public function Urges()
    {
        array(
          array('key' => 'injure', 'name' => 'Injure Self'),  
          array('key' => 'kill', 'name' => 'Suicide'),  
          array('key' => 'meds', 'name' => 'Skip Meds'),  
          array('key' => 'skip', 'name' => 'Skip Job'),  
          array('key' => 'binge', 'name' => 'Binge'),  
          array('key' => 'purge', 'name' => 'Purge'),  
          array('key' => 'alcohol', 'name' => 'Alcohol'),  
          array('key' => 'drugs', 'name' => 'Drugs'),  
        );
    }
*/  
}
?>
