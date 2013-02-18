<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class DbtDiary_Form_Handler_EditWorksheetGP extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
    var $uid, $id, $date, $formData;
    var $wdText = array (
        'objectives'   => 'Objectives: What specific results do I want ? What changes do I want this person to make ?',
        'relationship' => 'Relationship: How do I want the other person to feel about me after the interaction ?',
        'selfrespect'  => 'Self-Respect: How do I want to feel about myself after the interaction ?',
    );
    /* Functions */
    public function __construct(&$args)
    {
        $this->uid = $args['uid'];
        $this->date = $args['date'];
        if (isset($args['id'])) $this->id = $args['id'];
    }
    
    public function initialize(Zikula_Form_View $view)
    {
        if (isset($this->id)) {
            $data = DBUtil::selectObjectByID('dbtdiary_worksheetgp', $this->id);
            if ($data['uid'] != $this->uid) {
                return false;
            }
        } else {
            $data = array('wdorder' => implode(',', array_keys($this->wdText)));
        }
        /*
        $formData = $this->view->getValues();
        if (isset($formData)) {
            $data['wdorder'] = $formData['wdorder'];
        }
        */
        
        $this->view->assign($data);
        $this->view->assign('wdText', $this->wdText);
        return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {    
        $command = $args['commandName'];
        if ($command == 'save') {
            $formData = $this->view->getValues();
            LogUtil::registerStatus("Wdorder is " . $formData['wdorder']);
            return true;
            
            if (!$this->view->isValid()) return false;

            if ($this->id) {
                $formData['id'] = $this->id;

                if (DBUtil::updateObject($formData, 'dbtdiary_editworksheetgp' )) {
                    LogUtil::registerStatus("Your worksheet has been updated.");
                } else {
                    LogUtil::registerError("Error updating entry");
                }
            } else {
                $formData['date'] = $this->date;
                $formData['uid'] = $this->uid;
                DBUtil::insertObject($formData,'dbtdiary_editworksheetgp' );
                LogUtil::registerStatus("Your worksheet has been added.");
            }
        }
        return $this->view->redirect (ModUtil::url('DbtDiary', 'user','main'));
    }

    
}
