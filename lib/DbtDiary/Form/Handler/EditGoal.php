<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class DbtDiary_Form_Handler_EditGoal extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
    var $uid, $id, $originid, $insert;

    /* Functions */
    public function __construct(&$args)
    {
        $this->uid = $args['uid'];
        if (isset($args['id'])) 
        {
            $this->id = $args['id'];
            $this->originid = $args['originid'];
        }
    }
    
    public function initialize(Zikula_Form_View $view)
    {
        if (isset($this->id)) {
            $data = DBUtil::selectObjectByID('dbtdiary_goals', $this->id);
            if ($data['uid'] != $this->uid) {
                return false;
            }
            $this->view->assign($data);
            $this->originid = $data['originid'];
        } else {
            $this->insert = true;
        }
       $this->view->assign('doneItems', 
        array(
            array('text' => '', value => ''),
            array('text' => 'Yes', value => '1'),
            array('text' => 'No', value =>'0'),
        ));
        return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {    
        // $command = $args['commandName'];
        
        if (!$this->view->isValid()) return false;
        $formData = $this->view->getValues();

        if ($this->insert) {
            $formData['uid'] = $this->uid;
            DBUtil::insertObject($formData,'dbtdiary_goals' );
            // Set originid to the just-assigned id.
            $id = $formData['id'];
            $obj = array('id' => $id, 'originid' => $id);
            DBUtil::updateObject($obj, 'dbtdiary_goals');
            LogUtil::registerStatus("Your goal has been added.");
        } else {
            $formData['id'] = $this->id;

            if (DBUtil::updateObject($formData, 'dbtdiary_goals' )) {
                LogUtil::registerStatus("Your goal has been updated.");
            } else {
                LogUtil::registerError("Error updating entry");
            }
        }
        return $this->view->redirect (ModUtil::url('DbtDiary', 'user','main'));
    }

    
}
  
