{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{pageaddvar name='javascript' value='jquery'}
{pageaddvar name='javascript' value='jquery-ui'}
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/dbtdiary_user_main.js'}
{pageaddvar name="stylesheet" value="javascript/jquery-ui/themes/cupertino/jquery-ui.css"}
{img modname='core' src='button_ok.png' set='icons/extrasmall' alt='Completed' assign='Done'}
{img modname='DbtDiary' src='button_ok_check.png'  alt='To Do' assign='ToDo'}
{img modname='core' src='xedit.png' set='icons/extrasmall' alt='Edit' assign='editIcon'}
{*img modname='DbtDiary' src='xedit-gray.png'  alt='' assign='noeditIcon' *}

{ include file="dbtdiary_user_menu.tpl" }

<p><strong>Edit Diary for Date: </strong>
<input type="text" id="pickdate" maxlength="8" style="width:4em;">
</p>


{*<h3>Diary</h3> *}

{foreach item=week from=$weeks}
    {assign var=data value=$week.data}

    <table class="DbtSummary">
        <caption>Summary for Week of {$week.start}</caption>
        <thead>
            <tr>
                <th>&nbsp;</th>
                {foreach item=datum from=$data}
                    <th>{$datum.date|date_format:'%a<br />%b %e'}</th>
                {/foreach}
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Diary</th>
                {foreach item=datum from=$data}
                    <td>
                        {if $datum.diary}{$Done.imgtag}{else}{$ToDo.imgtag}{/if}
                        {if $datum.canedit}
                            <a href="{modurl modname="dbtdiary" func="editdiaryentry" date=$datum.date}">{$editIcon.imgtag}</a>
                        {/if}
                    </td>
                {/foreach}
            </tr>
            <tr>
                <th>Skills</th>
                {foreach item=datum from=$data}
                    <td>
                        {if $datum.skills}{$Done.imgtag}{else}{$ToDo.imgtag}{/if}
                        {if $datum.canedit}
                            <a href="{modurl modname="dbtdiary" func="ShowSkills" date=$datum.date}">{$editIcon.imgtag}</a>
                        {/if}
                    </td>
                {/foreach}
            </tr>
            <tr>
                <th>Daily Goals</th>
                {foreach item=datum from=$data}
                    <td>
                        {if $datum.dailygoals}{$Done.imgtag}{else}{$ToDo.imgtag}{/if}
                        {if $datum.canedit}
                            <a href="{modurl modname="dbtdiary" func="EditDailyGoal" date=$datum.date}">{$editIcon.imgtag}</a>
                        {/if}
                    </td>
                {/foreach}
            </tr>
            <tr>
                <th>Weekly Goal</th>
                <td>
                    {if $week.weeklygoal}{$Done.imgtag}{else}{$ToDo.imgtag}{/if}
                    <a href="{modurl modname="dbtdiary" func="EditWeeklyGoal" 
                        date=$week.weeklygoal[0].date}">{$editIcon.imgtag}</a>
                </td>
            </tr>
            {foreach item=minigoal from=$minigoals}
                <tr>
                    <th>{$minigoal.goal|truncate:15}</th>
                    {foreach item=date from=$week.dates}
                        <td>
                            {if $minigoal.used.$date.done}
                                {$Done.imgtag}{else}{$ToDo.imgtag}
                            {/if}
                            {if $date <= $today}
                                <a href="{modurl modname="dbtdiary" func="EditMiniGoalDt" id=$minigoal.used.$date.id minigoal=$minigoal.id date=$date}">{$editIcon.imgtag}</a>
                            {/if}
                        </td>
                    {/foreach}
                </tr>
            {/foreach}
                
        </tbody>
    </table>

{/foreach}
