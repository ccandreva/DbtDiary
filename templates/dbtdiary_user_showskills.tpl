{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{pageaddvar name="stylesheet" value="javascript/jquery-ui/themes/cupertino/jquery-ui.css"}
{pageaddvar name='javascript' value='jquery' }
{pageaddvar name='javascript' value='jquery-ui' }
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/dbtdiary_user_showskills.js'}
{* Set up some initial javascript values *}
<script type="text/javascript">
{/literal}
    var date='{$date}';
    var initialSkills=[{foreach item=skill from=$skills}'{$skill.skill_id}', {/foreach}];
{literal}
</script>

{ include file="dbtdiary_user_menu.tpl" }


<h3>Skills for {$date}</h3>
<br />
<p class="z-formnote z-informationmsg">
    These are the skills you used today. To remove one, simply click on it.
</p>
<div id="SkillsUsed">
    {include file='dbtdiary_skillsused.tpl'}
</div>

<br />

<p class="z-formnote z-informationmsg">
    Select skills that you used today by clicking on the in the window below. 
    Click on a DBT module name to show the skills in that module.
</p>
<div id="accordion">
    {foreach item=module from=$modules}
	<h3><a href="#">{$module.name}</a></h3>
        <div class="{$module.name|strip:''}">
            {foreach item=head from=$module.headings}
                <div class="skills {$head.name|strip:''}">
                    <h3 class="skills">{$head.name}</h3>
                    <ul>
                    {foreach item=skill from=$head.skills}
                        <li class="skills" id="skill{$skill.id}">{$skill.htname}</li>
                    {/foreach}
                    </ul>
                </div>
            {/foreach}
        </div>
    {/foreach}
</div>
