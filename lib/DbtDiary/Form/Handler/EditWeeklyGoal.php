<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class DbtDiary_Form_Handler_EditWeeklyGoal extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
    var $date, $uid, $id, $insert, $sqldate;

    /* Functions */
    public function __construct(&$args)
    {
        $this->uid = $args['uid'];
        if (isset($args['date'])) 
        {
            $d = $args['date'];
            if (!is_numeric($d)) $d = strtotime($d);
            $this->date = $d;
        } else {
            $this->date = time();
        }
        $this->sqldate = date('Y-m-d', $this->date);
    }
    
    public function initialize(Zikula_Form_View $view)
    {
        $where = "uid=$this->uid and date='$this->sqldate'";
        $data = DBUtil::selectObjectArray ('dbtdiary_weeklygoals',$where);
        if (isset($data[0])) {
               $this->view->assign($data[0]);
               $this->id = $data[0]['id'];
        } else {
            $this->insert = true;
        }
                    
      $this->view->assign('date',$this->date);
      return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {    
        // $command = $args['commandName'];
        
        if (!$this->view->isValid()) return false;
        $formData = $this->view->getValues();

        if ($this->insert) {
            $formData['uid'] = $this->uid;
            $formData['date'] = $this->sqldate;
            DBUtil::insertObject($formData,'dbtdiary_weeklygoals' );
            LogUtil::registerStatus("Entry Added.");
        } else {
            $formData['id'] = $this->id;

            if (DBUtil::updateObject($formData, 'dbtdiary_weeklygoals' )) {
                LogUtil::registerStatus("Entry updated.");
            } else {
                LogUtil::registerError("Error updating entry");
            }
        }
        return $this->view->redirect (ModUtil::url('DbtDiary', 'user','main'));
    }

    
}
  
