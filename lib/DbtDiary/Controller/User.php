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

        DbtDiary_Util::getWeek($start, $end);
        $startSQL = "$start 00:00:00";
        $endSQL = "$end 00:00:00";
        $today = date('Y-m-d');
        
        $where = "uid=$uid"; // and date>='$startSQL' and date <='$endSQL'";
        $diaryObj = DBUtil::selectObjectArray ('dbtdiary_diary', $where,
            '',-1, -1, 'date', null, null, array('id','date'));
        $dailygoalsObj = DBUtil::selectObjectArray ('dbtdiary_dailygoals', $where,
            '',-1, -1, 'date', null, null, array('id','date'));
        $where = "skillsused_uid=$uid"; // and skillsused_date>='$startSQL' and skillsused_date <='$endSQL'";
        $skillsObj = DBUtil::selectObjectArray ('dbtdiary_skillsused', $where,
            '',-1, -1, 'date', null, null, array('id', 'date'), 'y');

        $weeks = array();
        $t1 = strtotime($start);
        $t2 = $t1 - (86400 * 7);
        foreach ( array($t1, $t2) as $t) {
            $data = array();
            for ($i = 1; $i<=7; $i++) {
                $date = date('Y-m-d', $t);
                $dateSQL = "$date 00:00:00";
                $t+=86400; // add 24 hours
                $data[$date]['date'] = $date;
                if ($diaryObj[$dateSQL]) $data[$date]['diary'] = 'y';
                if ($dailygoalsObj[$dateSQL]) $data[$date]['dailygoals'] = 'y';
                if ($skillsObj[$dateSQL]) $data[$date]['skills'] = 'y';
                if ($date <= $today) $data[$date]['canedit'] = true;
            }
            $weeks[] = array('start' => date('Y-m-d', $t), 'data' => $data );
        }

        $this->view->assign('start', $start);
        $this->view->assign('end', $end);
        $this->view->assign('today', $today);
        $this->view->assign('weeks', $weeks);
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

    public function ShowSkills()
    {
        $ret = DbtDiary_Util::checkuser($uid, ACCESS_OVERVIEW);
        if ($ret) return $ret;
        
        $date = FormUtil :: getPassedValue('date',date('Y-m-d') );

        $this->view->assign('templatetitle', 'DbtDiary :: Skils Test');
        $this->view->assign('date', $date);
        
        $modules = DBUtil::selectObjectArray ('dbtdiary_modules','','name');
        foreach ($modules as &$mod)
        {
            $id = $mod['id'];
            $where = "headings_module=$id";
            $mod['headings'] = DBUtil::selectObjectArray ('dbtdiary_headings', $where);
            $headings = &$mod['headings'];
            
            foreach ($headings as &$head)
            {
                $id = $head['id'];
                $where = "skills_heading=$id";
                $head['skills'] = DBUtil::selectObjectArray ('dbtdiary_skills', $where);
            }
        } 

        $this->view->assign('modules', $modules);
        $this->view->assign('skills', DbtDiary_Util::getSkillsUsed($uid, $date));
        return $this->view->fetch('dbtdiary_user_showskills.tpl');
    }
}
