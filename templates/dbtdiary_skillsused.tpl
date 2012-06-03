{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
<h3>Skills Used on {$date}</h3>
{assign var=n value=$skills|@count}
{assign var=n value=$n/3|ceil}
<table id="SkillsUsed">
    {*foreach item=skill from=$skills*}
    {section name="skills" start=0 loop=$n}
        {assign var=i value=$smarty.section.skills.index}
        <tr>
            {section name="cols" start=0 loop=3}
                {if $skills[$i]}
                    <td>{$skills[$i].module} : {$skills[$i].heading} : {$skills[$i].name}</td>
                {/if}
                {assign var=i value=$i+$n}
            {/section}
        </tr>                
    {/section}
</table>
