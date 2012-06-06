<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class DbtDiary_Form_Handler_EditDiaryEntry extends Zikula_Form_AbstractHandler
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
        $data = DBUtil::selectObjectArray ('dbtdiary_diary',$where);
        if (isset($data[0])) {
               $this->view->assign($data[0]);
               $this->id = $data[0]['id'];
        } else {
            $this->insert = true;
        }
                    
        /*
      $gameObj = DBUtil::SelectObjectById('wiifriends_games', $this->gameID);
         */
      $this->view->assign('date',$this->date);
      foreach (DbtDiary_Util::getEmotions() as $emotion)
        $this->view->assign($emotion . 'Items', $emlist);
      $emlist[]=array('text' => 'Y', 'value'=>'10');
      foreach (DbtDiary_Util::getUrges() as $urge)
        $this->view->assign($urge . 'Items', $emlist);
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
                    ModUtil::url('DbtDiary', 'user','editdiaryentry',
                            array('date' => $jumpdate))
                    );
        }

      
        if ($this->insert) {
            $formData['uid'] = $this->uid;
            $formData['date'] = $this->sqldate;
            DBUtil::insertObject($formData,'dbtdiary_diary' );
            LogUtil::registerStatus("Entry Added.");
        } else {
            $formData['id'] = $this->id;

            if (DBUtil::updateObject($formData, 'dbtdiary_diary' )) {
                LogUtil::registerStatus("Entry updated.");
            } else {
                LogUtil::registerError("Error updating entry");
            }
        }
        return $this->view->redirect (ModUtil::url('DbtDiary', 'user','main'));
        
    }

    
}
  
