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
    var $date, $uid, $id, $insert;
    var $emotions = array('hurt', 'good', 'tense', 'miserable', 'panic', 
        'overwhelmed', 'angry', 'sad', 'hopeful', 'alone', 'distracted', 
        'bad', 'guilty', 'unreal');
    var $urges = array('injure', 'kill', 'meds', 'skip', 
        'binge', 'purge', 'alcohol', 'drugs');

    /* Functions */
    public function __construct(&$args)
    {
        $this->uid = $args['uid'];
        if (isset($args['date']))
            $this->date = $args['date'];
        else
            $this->date = date('Y-m-d');
    }
    
    public function initialize(Zikula_Form_View $view)
    {
        $emlist = DbtDiary_Util::InitListValues(range(0,9));
        $where = "diary_uid=$this->uid and diary_date='$this->date'";
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
      foreach ($this->emotions as $emotion)
        $this->view->assign($emotion . 'Items', $emlist);
      $emlist[]=array('text' => 'Y', 'value'=>'10');
      foreach ($this->urges as $urge)
        $this->view->assign($urge . 'Items', $emlist);
      return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {    
      if (!$this->view->isValid()) return false;

      $formData = $this->view->getValues();
      
        $formData['uid'] = $this->uid;
        $formData['date'] = $this->date;
        if ($this->insert) {
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
    }

    
}
  
