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
  $tables['dbtdiary_diary'] = 'dbtdiary_diary';
  
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
    'kill'	=>	'suicide',
    'meds'	=>	'meds',
    'skip'	=>	'skip',
    'binge'	=>	'binge',
    'purge'	=>	'foodpurge',
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


  $tables['dbtdiary_modules'] = 'dbtdiary_modules';
  $tables['dbtdiary_modules_column'] = array(
    'id'	=> 'modules_id',
    'name'      => 'modules_name',
    );
  $tables['dbtdiary_modules_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'name'    => 'C(30)',
    );

  $tables['dbtdiary_headings'] = 'dbtdiary_headings';
  $tables['dbtdiary_headings_column'] = array(
    'id'	=> 'headings_id',
    'name'      => 'headings_name',
    'module'    => 'headings_module',
    );
  $tables['dbtdiary_headings_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'name'    => 'C(50)',
    'module'  => 'I UNSIGNED NOTNULL',
    );
  
  $tables['dbtdiary_skills'] = 'dbtdiary_skills';
  $tables['dbtdiary_skills_column'] = array(
    'id'	=> 'skills_id',
    'name'      => 'skills_name',
    'htname'  => 'skills_htname',
    'heading' => 'skills_heading',
    );
  $tables['dbtdiary_skills_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'name'    => 'C(60)',
    'htname'    => 'C(60)',
    'heading'   => 'I UNSIGNED NOTNULL',
    );
    
  $tables['dbtdiary_skillsused'] = 'dbtdiary_skillsused';
  $tables['dbtdiary_skillsused_column'] = array(
    'id'	=> 'skillsused_id',
    'uid'	=> 'skillsused_uid',
    'date'      => 'skillsused_date',
    'skill'	=> 'skillsused_skill',
    );
  $tables['dbtdiary_skillsused_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'uid'	=> 'I UNSIGNED',
    'date'    => 'T NOTNULL',
    'skill'	=> 'I UNSIGNED',
    );

  $tables['dbtdiary_distress_levels'] = 'dbtdiary_distress_levels';
  $tables['dbtdiary_distress_levels_column'] = array(
    'id'	=> 'distress_levels_id',
    'before'	=> 'distress_levels_before',
    'after'      => 'distress_levels_after',
    );
  $tables['dbtdiary_distress_levels_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL PRIMARY',
    'before'	=> 'I1 UNSIGNED',
    'after'    => 'I1 UNSIGNED',
    );

  $tables['dbtdiary_proscons'] = 'dbtdiary_pros_cons';
  $tables['dbtdiary_proscons_column'] = array(
    'id'	=> 'proscons_id',
    'behavior'  => 'proscons_behavior',
    'tolerate_pros'	=> 'proscons_tolerate_pros',
    'tolerate_cons'      => 'proscons_tolerate_cons',
    'nottolerate_pros'	=> 'proscons_nottolerate_pros',
    'nottolerate_cons'      => 'proscons_nottolerate_cons',
    );
  $tables['dbtdiary_proscons_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'behavior'  => 'C(255)',
    'tolerate_pros'	=> 'C(255)',
    'tolerate_cons'      => 'C(255)',
    'nottolerate_pros'	=> 'C(255)',
    'nottolerate_cons'      => 'C(255)',
    );

  $tables['dbtdiary_dailygoals'] = 'dbtdiary_dailygoals';
  $tables['dbtdiary_dailygoals_column'] = array(
    'id'	=> 'id',
    'uid'      => 'uid',
    'date'      => 'date',
    'goal'      => 'goal',
    'motivators' => 'motivators',
    'barriers'  => 'barriers',
    'done'      => 'done',
    );
  $tables['dbtdiary_dailygoals_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'uid'     => 'I UNSIGNED NOTNULL',
    'date'    => 'T NOTNULL',
    'goal'  =>  'C(255)',
    'motivators'  => 'C(255)',
    'barriers'  =>  'C(255)',
    'done'      => 'L NULL'
      );
  ObjectUtil::addStandardFieldsToTableDefinition (
          $tables['dbtdiary_dailygoals_column'], '');
  ObjectUtil::addStandardFieldsToTableDataDefinition(
          $tables['dbtdiary_dailygoals_column_def']);

  $tables['dbtdiary_weeklygoals'] = 'dbtdiary_weeklygoals';
  $tables['dbtdiary_weeklygoals_column'] = array(
    'id'        => 'id',
    'uid'       => 'uid',
    'date'      => 'date',
    'goal'      => 'goal',
    'steps'     => 'steps',
    'signs'     => 'signs',
    'steps2'    => 'steps2',
    'signs2'    => 'signs2',
    );
  $tables['dbtdiary_weeklygoals_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'uid'       => 'I UNSIGNED NOTNULL',
    'date'      => 'D NOTNULL',
    'goal'      => 'X',
    'steps'     => 'X',
    'signs'     => 'X',
    'steps2'    => 'X',
    'signs2'    => 'X',
      );

  /* 
   * Overall treatment goals
   */
  $tables['dbtdiary_goals'] = 'dbtdiary_goals';
  $tables['dbtdiary_goals_column'] = array(
    'id'	=> 'id',
    'originid'  => 'originid',
    'previousid' => 'previousid',
    'uid'      => 'uid',
    'goal'      => 'goal',
    'motivators' => 'motivators',
    'barriers'  => 'barriers',
    'steps'     => 'steps',
    'signs'     => 'signs',
    'replaced'  => 'replaced',
    'done'      => 'done',
    );
  $tables['dbtdiary_goals_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'originid'     => 'I UNSIGNED NOTNULL',
    'previousid'     => 'I UNSIGNED NOTNULL',
    'uid'     => 'I UNSIGNED NOTNULL',
    'goal'  =>  'X',
    'motivators'  => 'X',
    'barriers'  =>  'X',
    'steps'     => 'X',
    'signs'     => 'X',
    'replaced'  =>  'L NOTNULL',
    'done'      => 'L NULL'
      );
  ObjectUtil::addStandardFieldsToTableDefinition (
          $tables['dbtdiary_goals_column'], '');
  ObjectUtil::addStandardFieldsToTableDataDefinition(
          $tables['dbtdiary_goals_column_def']);

  $tables['dbtdiary_minigoals'] = 'dbtdiary_minigoals';
  $tables['dbtdiary_minigoals_column'] = array(
    'id'	=> 'id',
    'uid'      => 'uid',
    'goal'      => 'goal',
    'motivators' => 'motivators',
    'barriers'  => 'barriers',
    'finished'      => 'finished',
    );
  $tables['dbtdiary_minigoals_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'uid'     => 'I UNSIGNED NOTNULL',
    'goal'  =>  'C(255)',
    'motivators'  => 'C(255)',
    'barriers'  =>  'C(255)',
    'finished'      => 'L NULL'
      );
  ObjectUtil::addStandardFieldsToTableDefinition (
          $tables['dbtdiary_minigoals_column'], '');
  ObjectUtil::addStandardFieldsToTableDataDefinition(
          $tables['dbtdiary_minigoals_column_def']);

  $tables['dbtdiary_minigoaldt'] = 'dbtdiary_minigoaldt';
  $tables['dbtdiary_minigoaldt_column'] = array(
    'id'	=> 'id',
    'uid'	=> 'uid',
    'date'      => 'date',
    'minigoal'	=> 'minigoal',
    'done'      => 'done',
    );
  $tables['dbtdiary_minigoaldt_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'uid'	=> 'I UNSIGNED',
    'date'    => 'D NOTNULL',
    'minigoal'	=> 'I UNSIGNED',
    'done'      => 'L NULL'
    );

  $tables['dbtdiary_worksheetgp'] = 'dbtdiary_worksheetgp';
  $tables['dbtdiary_worksheetgp_column'] = array(
    'id'	=> 'id',
    'uid'	=> 'uid',
    'date'      => 'date',
    'event'  =>  'event',
    'objectives'  =>  'objectives',
    'relationship'  =>  'relationship',
    'selfrespect'  =>  'selfrespect',
    'conflicts'  =>  'conflicts',
    'wdorder'   => 'wdorder',
    );
  $tables['dbtdiary_worksheetgp_column_def'] = array(
    'id'	=> 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'uid'	=> 'I UNSIGNED',
    'date'    => 'D NOTNULL',
    'event'  =>  'X',
    'objectives'  =>  'X',
    'relationship'  =>  'X',
    'selfrespect'  =>  'X',
    'conflicts'  =>  'X',
    'wdorder'   => '',
    );

  
/* urges table, not using yet.
  $tables['dbtdiary_urges'] = 'dbtdiary_urges';
  $tables['dbtdiary_urges_column'] = array(
    'id'        => 'id',
    'uid'       => 'uid',
    'key'       => 'key',
    'name'      => 'name',
    );
  $tables['dbtdiary_urges_column_def'] = array(
    'id'        => 'I UNSIGNED NOTNULL AUTOINCREMENT PRIMARY',
    'uid'       => 'I UNSIGNED NOTNULL',
    'key'       => 'C(255)',
    'name'      => 'C(255)',
    );
*/  
  
  return $tables;

}
 