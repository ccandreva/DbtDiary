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
    var $emotions = array('hurt', 'good', 'tense', 'miserable', 'panic', 
        'overwhelmed', 'angry', 'sad', 'hopeful', 'alone', 'distracted', 
        'bad', 'guilty', 'unreal');

    public function main()
    {

        if (!SecurityUtil::checkPermission('DbtDiary::', '::', ACCESS_OVERVIEW)) {
            return LogUtil::registerPermissionError();
        }

        // $uid = UserUtil::getVar('uid');
        $this->view->assign('templatetitle', 'DbtDiary');

        return $this->view->fetch('dbtdiary_user_main.tpl');
    }

    public function EditDiaryEntry()
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'DbtDiary::', "::", ACCESS_ADD)) {
            return LogUtil::registerPermissionError();
        }
        $uid = UserUtil::getVar('uid');
        $GLOBALS['info']['title'] = 'DbtDiary :: Edit Entry';
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
        // Security check
        if (!SecurityUtil::checkPermission( 'DbtDiary::', "::", ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $uid = UserUtil::getVar('uid');
        //$date = FormUtil :: getPassedValue('date');
        $where = "diary_uid=$uid";
        $data = DBUtil::selectObjectArray ('dbtdiary_diary',$where);
        $this->view->assign('templatetitle', 'DbtDiary :: View Diary');
        $this->view->assign('data', $data);
        $this->view->assign('emotions', $this->emotions);
        return $this->view->fetch('dbtdiary_user_viewdiary.tpl');
    }
}
