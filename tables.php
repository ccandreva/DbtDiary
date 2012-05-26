<?php
/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

function DbtDiary_tables()
{
  //Initialize table aray
  $tables = array();
  
  /* Diary card table
   * This is the information on the main Diary Card, one table.
   * One record per day per user
   */
  $tables['DbtDiary_Diary'] = DBUtil::getLimitedTablename('DbtDiary_Diary');
  
  $tables['DbtDiary_Diary_column'] = array(
    'id'	=> 'Diary_id',
    'uid'      => 'Diary_uid',
    'date'    => 'Diary_date',
    'hurt'	=>	'Diary_hurt',
    'good'	=>	'Diary_good',
    'tense'	=>	'Diary_tense',
    'miserable'	=>	'Diary_miserable',
    'panic'	=>	'Diary_panic',
    'overwhelmed'	=>	'Diary_overwhelmed',
    'angry'	=>	'Diary_angry',
    'sad'	=>	'Diary_sad',
    'hopeful'	=>	'Diary_hopeful',
    'alone'	=>	'Diary_alone',
    'distracted'	=>	'Diary_distracted',
    'bad'	=>	'Diary_bad',
    'guilty'	=>	'Diary_guilty',
    'unreal'	=>	'Diary_unreal',
    'injure'	=>	'Diary_injure',
    'kill'	=>	'Diary_kill',
    'meds'	=>	'Diary_meds',
    'skip'	=>	'Diary_skip',
    'binge'	=>	'Diary_binge',
    'purge'	=>	'Diary_purge',
    'alcohol'	=>	'Diary_alcohol',
    'drugs'	=>	'Diary_drugs',
    'comments'  =>      'Diary_comments',
  );

  $tables['DbtDiary_Diary_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL PRIMARY',
    'uid'     => 'I UNSIGNED NOTNULL',
    'date'    => 'T NOTNULL',
    'hurt'	=>	'I1',
    'good'	=>	'I1',
    'tense'	=>	'I1',
    'miserable'	=>	'I1',
    'panic'	=>	'I1',
    'overwhelmed'	=>	'I1',
    'angry'	=>	'I1',
    'sad'	=>	'I1',
    'hopeful'	=>	'I1',
    'alone'	=>	'I1',
    'distracted'	=>	'I1',
    'bad'	=>	'I1',
    'guilty'	=>	'I1',
    'unreal'	=>	'I1',
    'injure'	=>	'I1',
    'kill'	=>	'I1',
    'meds'	=>	'I1',
    'skip'	=>	'I1',
    'binge'	=>	'I1',
    'purge'	=>	'I1',
    'alcohol'	=>	'I1',
    'drugs'	=>	'I1',
    'comments'  =>      'X',
  );

  // add standard data fields
  ObjectUtil::addStandardFieldsToTableDefinition ($tables['DbtDiary_Diary_column'], 'DbtDiary_Diary_');
  ObjectUtil::addStandardFieldsToTableDataDefinition($tables['DbtDiary_Diary_column_def']);

    
  return $tables;

}
 