<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

class DbtDiary_Controller_User extends Zikula_AbstractController
{

    public function main()
    {
        $ret = DbtDiary_Util::checkuser($uid, ACCESS_OVERVIEW);
        if ($ret) return $ret;

        $this->view->assign('templatetitle', 'DbtDiary');

        return $this->view->fetch('dbtdiary_user_main.tpl');
    }

    public function EditDiaryEntry()
    {
        $ret = DbtDiary_Util::checkuser($uid, ACCESS_OVERVIEW);
        if ($ret) return $ret;

        $this->view->assign('templatetitle', 'DbtDiary :: Edit Diary');
        $date = FormUtil :: getPassedValue('date');
        $view = FormUtil::newForm('DbtDiary', $this);
        $view->assign('templatetitle', 'DbtDiary :: Edit Diary');

        $tmplfile = 'dbtdiary_user_editdiaryentry.tpl';
        $args = array('uid' => $uid);
        if ($date) $args['date'] = $date;
        $formobj = new DbtDiary_Form_Handler_EditDiaryEntry($args);
        $output = $view->execute($tmplfile, $formobj);
        return $output;
    }
    
    public function ViewDiary()
    {
        $ret = DbtDiary_Util::checkuser($uid, ACCESS_OVERVIEW);
        if ($ret) return $ret;

        $startnum = (int) FormUtil::getPassedValue('startnum', null, 'GET');
        $numrows = 7;

        $where = "uid=$uid";
        $data = DBUtil::selectObjectArray ('dbtdiary_diary', $where, 
                'date desc', $startnum, $numrows);
        $this->view->assign('templatetitle', 'DbtDiary :: View Diary');
        $this->view->assign('data', $data);
        $this->view->assign('emotions', DbtDiary_Util::getEmotions());
        $this->view->assign('emtype', DbtDiary_Util::getEmotionTypes());
        $this->view->assign('urges', DbtDiary_Util::getUrges());
        // Assign the values for the smarty plugin to produce a pager.
        $this->view->assign('pager', array(
            'numitems' => DBUtil::selectObjectCount('dbtdiary_diary', $where),
            'itemsperpage' => $numrows,
            )
        );

        return $this->view->fetch('dbtdiary_user_viewdiary.tpl');
    }
    public function EditDailyGoal()
    {
        $ret = DbtDiary_Util::checkuser($uid, ACCESS_OVERVIEW);
        if ($ret) return $ret;

        $this->view->assign('templatetitle', 'DbtDiary :: Edit Daily Goal');
        $date = FormUtil :: getPassedValue('date');
        $view = FormUtil::newForm('DbtDiary', $this);
        $view->assign('templatetitle', 'DbtDiary :: Edit Diary');

        $tmplfile = 'dbtdiary_user_editdailygoal.tpl';
        $args = array('uid' => $uid);
        if ($date) $args['date'] = $date;
        $formobj = new DbtDiary_Form_Handler_EditDailyGoal($args);
        $output = $view->execute($tmplfile, $formobj);
        return $output;
    }
    
}
