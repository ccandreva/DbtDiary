{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{img modname='core' src='/14_layer_lowerlayer.png' set='icons/extrasmall' 
    alt='View actions for this skill.' class="EditSkill r90" assign='menuIcon'}
{img modname='core' src='/14_layer_lowerlayer.png' set='icons/extrasmall' 
    alt='View actions for this skill.' class="EditSkill EditDistress r90" assign='menuIconDistress'}
{img modname='core' src='/14_layer_lowerlayer.png' set='icons/extrasmall' 
    alt='View actions for this skill.' class="EditSkill EditDistress EditProsCons r90" assign='menuIconProsCons'}
    
{nocache}
{assign var=n value=$skills|@count}
{assign var=n value=$n/3|ceil}
<table id="SkillsUsedTable">
    <tr>
        <th colspan="5">
        These are the skills you used today. Click the triangle next to a
        skill to show options.
        </th>
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
                            {if $skills[$i].skill_id == 51}
                                {$menuIconProsCons.imgtag}
                            {else}
                                {$menuIconDistress.imgtag}
                            {/if}
                        {else}
                            {$menuIcon.imgtag}
                        {/if}
                    </td>
                {/if}
                {assign var=i value=$i+$n}
            {/section}
        </tr>      
    {sectionelse}
        <tr><td><em>{gt text="No skills have been selected yet."}</em></td></tr>
    {/section}
</table>
{/nocache}
