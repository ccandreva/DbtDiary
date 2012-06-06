<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class DbtDiary_Form_Handler_EditDailyGoal extends Zikula_Form_AbstractHandler
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
        $emlist = DbtDiary_Util::InitListValues(range(0,9));
        $where = "uid=$this->uid and date='$this->sqldate'";
        $data = DBUtil::selectObjectArray ('dbtdiary_dailygoals',$where);
        if (isset($data[0])) {
               $this->view->assign($data[0]);
               $this->id = $data[0]['id'];
        } else {
            $this->insert = true;
        }
                    
      $this->view->assign('date',$this->date);
      $this->view->assign('doneItems', 
        array(
            array('text' => '', value => ''),
            array('text' => 'Yes', value => '1'),
            array('text' => 'No', value =>'0'),
        )
      );

      return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {    
        $command = $args['commandName'];
        
        if (!$this->view->isValid()) return false;
        $formData = $this->view->getValues();

        if ($command == 'Jump') {
            $jumpdate = strtotime($formData['jumpdate']);
            return $this->view->redirect (
                    ModUtil::url('DbtDiary', 'user','editdailygoals',
                            array('date' => $jumpdate))
                    );
        }

      
        if ($this->insert) {
            $formData['uid'] = $this->uid;
            $formData['date'] = $this->sqldate;
            DBUtil::insertObject($formData,'dbtdiary_dailygoals' );
            LogUtil::registerStatus("Entry Added.");
        } else {
            $formData['id'] = $this->id;

            if (DBUtil::updateObject($formData, 'dbtdiary_dailygoals' )) {
                LogUtil::registerStatus("Entry updated.");
            } else {
                LogUtil::registerError("Error updating entry");
            }
        }
        return $this->view->redirect (ModUtil::url('DbtDiary', 'user','main'));
    }

    
}
  
