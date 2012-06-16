{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{img modname='core' src='14_layer_deletelayer.png' set='icons/extrasmall' 
    alt='Remove Skill' class="RemoveSkill" assign='delIcon'}
{img modname='core' src='xedit.png' set='icons/extrasmall' 
    alt='Edit' class="EditSkill" assign='editIcon'}
{assign var=n value=$skills|@count}
{assign var=n value=$n/3|ceil}
<table id="SkillsUsedTable">
    <tr>
        <caption>
            Skills Used: 
            <img id="skillWaiting" src="images/ajax/icon_animated_busy.gif" />
        </caption>
    </tr>
    {section name="skills" start=0 loop=$n}
        {assign var=i value=$smarty.section.skills.index}
        <tr>
            {section name="cols" start=0 loop=3}
                {if $skills[$i]}
                    <td class="skillsused" id="skillused{$skills[$i].id}"
                        sid="{$skills[$i].skill_id}" name="{$skills[$i].name}">
                        {$skills[$i].module} : {$skills[$i].heading} : {$skills[$i].name}
                        {if $skills[$i].module == 'Distress Tolerance'}
                            <span id="rating{$skills[$i].id}">{if $skills[$i].before}({$skills[$i].before}/{$skills[$i].after|default:'-'}){/if}</span>
                            {$editIcon.imgtag}
                        {/if}
                        {$delIcon.imgtag}
                    </td>
                {/if}
                {assign var=i value=$i+$n}
            {/section}
        </tr>                
    {/section}
</table>
