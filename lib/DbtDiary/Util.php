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

        // If not logged in, redirect to login screen
        $uid = UserUtil::getVar('uid');
	if ($uid <= 1)
	{
	    $url = ModUtil::url('users', 'user', 'loginscreen',
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

    
}
?>
