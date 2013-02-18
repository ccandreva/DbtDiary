<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

class DbtDiary_Controller_Print extends Zikula_AbstractController
{
    public function main()
    {
	
    }
    
    public function DiaryCard()
    {
        $ret = DbtDiary_Util::checkuser($uid, ACCESS_OVERVIEW);
        if ($ret) return $ret;

        $startdate = trim(FormUtil::getPassedValue('startdate', null, 'GET'));
	if ( date('Y-m-d', strtotime($startdate)) != $startdate) {
	    return false;
	}
	$enddate = strtotime("+7 days", $startdate);
        //$numrows = 7;

        $where = "uid=$uid and date>='$startdate' and date <'$enddate'";
        $data = DBUtil::selectObjectArray ('dbtdiary_diary', $where, 
                'date desc');
        $this->view->assign('templatetitle', 'DbtDiary :: Print Diary Card');
        $this->view->assign('data', $data);
        $this->view->assign('emotions', DbtDiary_Util::getEmotions());
        $this->view->assign('emtype', DbtDiary_Util::getEmotionTypes());
        $this->view->assign('urges', DbtDiary_Util::getUrges());

        return $this->view->fetch('dbtdiary_print_diarycard.tpl');
    }

}
