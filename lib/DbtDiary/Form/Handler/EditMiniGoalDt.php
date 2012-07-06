<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class DbtDiary_Form_Handler_EditMiniGoalDt extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
    var $uid, $id, $minigoal, $date;

    /* Functions */
    public function __construct(&$args)
    {
        $this->uid = $args['uid'];
        $this->minigoal = $args['minigoal'];
        $this->date = $args['date'];
        if (isset($args['id'])) $this->id = $args['id'];
    }
    
    public function initialize(Zikula_Form_View $view)
    {
        $yesno = array();
        if (isset($this->id)) {
            $data = DBUtil::selectObjectByID('dbtdiary_minigoaldt', $this->id);
            if ($data['uid'] != $this->uid) {
                return false;
            }
            $this->view->assign($data);
        } else {
            $yesno[] =  array('text' => '', 'value' =>'');
        }
        $yesno[] = array('text' => 'No', 'value' =>'0');
        $yesno[] = array('text' => 'Yes', 'value' => '1');

        $this->view->assign('doneItems', $yesno);
        return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {    
        $command = $args['commandName'];
        if ($command == 'save') {
            if (!$this->view->isValid()) return false;
            $formData = $this->view->getValues();

            if ($this->id) {
                $formData['id'] = $this->id;

                if (DBUtil::updateObject($formData, 'dbtdiary_minigoaldt' )) {
                    LogUtil::registerStatus("Your minigoal has been updated.");
                } else {
                    LogUtil::registerError("Error updating entry");
                }
            } else {
                $formData['minigoal'] = $this->minigoal;
                $formData['date'] = $this->date;
                $formData['uid'] = $this->uid;
                DBUtil::insertObject($formData,'dbtdiary_minigoaldt' );
                LogUtil::registerStatus("Your minigoal has been added.");
            }
        }
        return $this->view->redirect (ModUtil::url('DbtDiary', 'user','main'));
    }

    
}
  
