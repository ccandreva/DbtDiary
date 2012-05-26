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
  $tables['dbtdiary_diary'] = DBUtil::getLimitedTablename('dbtdiary_diary');
  
  $tables['dbtdiary_diary_column'] = array(
    'id'	=> 'diary_id',
    'uid'      => 'diary_uid',
    'date'    => 'diary_date',
    'hurt'	=>	'diary_hurt',
    'good'	=>	'diary_good',
    'tense'	=>	'diary_tense',
    'miserable'	=>	'diary_miserable',
    'panic'	=>	'diary_panic',
    'overwhelmed'	=>	'diary_overwhelmed',
    'angry'	=>	'diary_angry',
    'sad'	=>	'diary_sad',
    'hopeful'	=>	'diary_hopeful',
    'alone'	=>	'diary_alone',
    'distracted'	=>	'diary_distracted',
    'bad'	=>	'diary_bad',
    'guilty'	=>	'diary_guilty',
    'unreal'	=>	'diary_unreal',
    'injure'	=>	'diary_injure',
    'kill'	=>	'diary_kill',
    'meds'	=>	'diary_meds',
    'skip'	=>	'diary_skip',
    'binge'	=>	'diary_binge',
    'purge'	=>	'diary_purge',
    'alcohol'	=>	'diary_alcohol',
    'drugs'	=>	'diary_drugs',
    'comments'  =>      'diary_comments',
  );

  $tables['dbtdiary_diary_column_def'] = array(
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
  ObjectUtil::addStandardFieldsToTableDefinition ($tables['dbtdiary_diary_column'], 'dbtdiary_diary_');
  ObjectUtil::addStandardFieldsToTableDataDefinition($tables['dbtdiary_diary_column_def']);

    
  return $tables;

}
 