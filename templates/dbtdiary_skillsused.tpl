{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{assign var=n value=$skills|@count}
{assign var=n value=$n/3|ceil}
<table id="SkillsUsedTable">
    <tr>
        <caption>
            Skills Used: 
            <img id="skillWaiting" src="images/ajax/icon_animated_busy.gif" />
        </caption>
    </tr>
    {*foreach item=skill from=$skills*}
    {section name="skills" start=0 loop=$n}
        {assign var=i value=$smarty.section.skills.index}
        <tr>
            {section name="cols" start=0 loop=3}
                {if $skills[$i]}
                    <td class="skillsused" id="skillused{$skills[$i].id}" sid="{$skills[$i].skill_id}">{$skills[$i].module} : {$skills[$i].heading} : {$skills[$i].name}</td>
                {/if}
                {assign var=i value=$i+$n}
            {/section}
        </tr>                
    {/section}
</table>
