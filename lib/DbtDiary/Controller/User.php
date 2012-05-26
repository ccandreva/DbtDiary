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

        $uid = UserUtil::getVar('uid');

        if (!SecurityUtil::checkPermission('DbtDiary::', '::', ACCESS_OVERVIEW)) {
            return LogUtil::registerPermissionError();
        }

        return "<p>Hello, world</p>";
    }

    public function EditDiaryEntry()
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'DbtDiary::', "::", ACCESS_ADD)) {
            return LogUtil::registerPermissionError();
        }
        $uid = UserUtil::getVar('uid');
        $GLOBALS['info']['title'] = 'DbtDiary :: Edit Entry';

        $view = FormUtil::newForm('DbtDiary', $this);

        $tmplfile = 'dbtdiary_user_editdiaryentry.tpl';
        $args = array('uid' => $uid);
        $formobj = new DbtDiary_Form_Handler_EditDiaryEntry($args);
        $output = $view->execute($tmplfile, $formobj);
        return $output;

    }
}
