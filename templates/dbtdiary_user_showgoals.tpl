{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{img modname='core' src='button_ok.png' set='icons/extrasmall' alt='Completed' assign='Done'}
{img modname='DbtDiary' src='button_ok_check.png'  alt='To Do' assign='ToDo'}
{img modname='core' src='xedit.png' set='icons/extrasmall' alt='Edit' assign='editIcon'}

{ include file="dbtdiary_user_menu.tpl" }
<h3>Overall Treatment Goals</h3>
<ol>
{foreach item=goal from=$goals}
    <li> <a href="{modurl modname="dbtdiary" func="editgoal" id=$goal.id}">{$editIcon.imgtag}</a>
            {$goal.goal}
            <ul>
                {if $goal.motivators}
                    <li>
                        {gt text="Motivators"}: {$goal.motivators}
                    </li>
                {/if}
                {if $goal.barriers}
                    <li>
                        {gt text="Barriers"}: {$goal.barriers}
                    </li>
                {/if}
                {if $goal.steps}
                    <li>
                        {gt text="Steps"}: {$goal.steps}
                    </li>
                {/if}
                {if $goal.signs}
                    <li>
                        {gt text="Signs"}: {$goal.signs}
                    </li>
                {/if}
            </ul>
    </li>
{/foreach}
</ol>
    