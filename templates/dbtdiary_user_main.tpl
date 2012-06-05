{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{*ajaxheader modname='DbtDiary' filename='highcharts.js'*}
{* pageaddvar name='javascript' value='jquery' *}
{*pageaddvar name='javascript' value='modules/DbtDiary/javascript/jquery.min.js'}
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/highcharts.js'}
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/exporting.js' *}
{img modname='core' src='button_ok.png' set='icons/extrasmall' alt='Completed' assign='Done'}
{img modname='DbtDiary' src='button_ok_check.png'  alt='To Do' assign='ToDo'}
{img modname='core' src='xedit.png' set='icons/extrasmall' alt='Edit' assign='editIcon'}
{*img modname='DbtDiary' src='xedit-gray.png'  alt='' assign='noeditIcon' *}

{ include file="dbtdiary_user_menu.tpl" }

{*<h3>Diary</h3> *}

{foreach item=week from=$weeks}
    {assign var=data value=$week.data}

    <table>
        <caption>Summary for Week of {$week.start}</caption>
        <thead>
            <tr>
                <th>&nbsp;</th>
                {foreach item=datum from=$data}
                    <th>{$datum.date|date_format:'%a %m/%e'}</th>
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
        </tbody>
    </table>

{/foreach}
