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
    'id'	=> 'id',
    'uid'      => 'uid',
    'date'    => 'date',
    'hurt'	=>	'hurt',
    'good'	=>	'good',
    'tense'	=>	'tense',
    'miserable'	=>	'miserable',
    'panic'	=>	'panic',
    'overwhelmed'	=>	'overwhelmed',
    'angry'	=>	'angry',
    'sad'	=>	'sad',
    'hopeful'	=>	'hopeful',
    'alone'	=>	'alone',
    'distracted'	=>	'distracted',
    'bad'	=>	'bad',
    'guilty'	=>	'guilty',
    'unreal'	=>	'unreal',
    'injure'	=>	'injure',
    'kill'	=>	'kill',
    'meds'	=>	'meds',
    'skip'	=>	'skip',
    'binge'	=>	'binge',
    'purge'	=>	'purge',
    'alcohol'	=>	'alcohol',
    'drugs'	=>	'drugs',
    'comments'  =>      'comments',
  );

  $tables['dbtdiary_diary_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
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
  ObjectUtil::addStandardFieldsToTableDefinition (
          $tables['dbtdiary_diary_column'], '');
  ObjectUtil::addStandardFieldsToTableDataDefinition(
          $tables['dbtdiary_diary_column_def']);

  $tables['dbtdiary_dailygoals'] = 'dbtdiary_dailygoals';
  
  $tables['dbtdiary_dailygoals_column'] = array(
    'id'	=> 'id',
    'date'      => 'date',
    'goal'      => 'goal',
    'motivators' => 'motivators',
    'barrriers'  => 'barriers',
    'done'      => 'done',
    );

  $tables['dbtdiary_dailygoals_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'date'    => 'T NOTNULL',
    'goal'  =>  'C(255)',
    'motivators'  => 'C(255)',
    'barrriers'  =>  'C(255)',
    'done'      => 'L NULL'
      );
  ObjectUtil::addStandardFieldsToTableDefinition (
          $tables['dbtdiary_dailygoals_column'], '');
  ObjectUtil::addStandardFieldsToTableDataDefinition(
          $tables['dbtdiary_dailygoals_column_def']);

    
  return $tables;

}
 