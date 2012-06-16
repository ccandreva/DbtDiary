<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

class DbtDiary_Controller_Ajax extends Zikula_Controller_AbstractAjax
{

    public function addskill()
    {
        $ret = DbtDiary_Util::checkuser($uid, ACCESS_ADD);
        $this->throwForbiddenUnless(!$ret);
        
        $skill = $this->request->query->get('skill');
        $sid = preg_replace('/[^0-9]+/','',$skill);
        
        $date = $this->request->query->get('date');
        $sqldate = "$date 00:00:00";
        
        // Validate skill sent back in, make sure it is real.
        $obj = DBUtil::selectObjectByID('dbtdiary_skills', $sid);
        if ($obj['id'] == $sid) {
            $skillObj = array('uid' => $uid, 'date' => $sqldate, 'skill' => $sid);
            DBUtil::insertObject($skillObj, 'dbtdiary_skillsused');
        }
        
        $skillsObj = DbtDiary_Util::getSkillsUsed($uid, $sqldate);
        
        Zikula_AbstractController::configureView();
        $this->view->setCaching(Zikula_View::CACHE_DISABLED);
        $this->view->assign('skills', $skillsObj);
        $this->view->assign('date', $date);
        $output = $this->view->fetch('dbtdiary_skillsused.tpl');

        $response = array(
            'output' => $output,
            'id'    => "skill$sid",
        );
        return new Zikula_Response_Ajax($response);
   }

    public function removeskill()
    {
        $ret = DbtDiary_Util::checkuser($uid, ACCESS_ADD);
        $this->throwForbiddenUnless(!$ret);
        
        $skill = $this->request->query->get('skillused');
        $suid = preg_replace('/[^0-9]+/','',$skill);
        
        $date = $this->request->query->get('date');
        $sqldate = "$date 00:00:00";
        
        // Validate skill sent back in, make sure it is real.
        $obj = DBUtil::selectObjectByID('dbtdiary_skillsused', $suid);
        if ($obj['id'] == $suid) {
            $sid = $obj['skill'];
            $obj = DBUtil::deleteObjectByID('dbtdiary_skillsused', $suid);
        }
        
        $skillsObj = DbtDiary_Util::getSkillsUsed($uid, $sqldate);
        
        Zikula_AbstractController::configureView();
        $this->view->setCaching(Zikula_View::CACHE_DISABLED);
        $this->view->assign('skills', $skillsObj);
        $this->view->assign('date', $date);
        $output = $this->view->fetch('dbtdiary_skillsused.tpl');

        $response = array(
            'output' => $output,
            'id'    => "skill$sid",
        );
        return new Zikula_Response_Ajax($response);
   }

   /*
    * Save/update skill ratings.
    */
   
    public function rateskill()
    {
        $ret = DbtDiary_Util::checkuser($uid, ACCESS_ADD);
        $this->throwForbiddenUnless(!$ret);
        
        $skill = $this->request->query->get('id');
        $id = preg_replace('/[^0-9]+/','',$skill);
        $before = $this->request->query->get('before');
        $after = $this->request->query->get('after');
        $table = 'dbtdiary_distress_levels';
        $obj = DBUtil::selectObjectById($table, $id, 'id', array('id'));
        $obj['before'] = $before;
        $obj['after'] = $after;
        if ($obj['id'] == $id) {
            $res = DBUTil::updateObject ($obj, $table);
        }   else {
            $obj['id'] = $id;
            $res = DBUTil::insertObject($obj, $table, true);
        }
        return new Zikula_Response_Ajax(null);
        
    }
    
   
}
