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
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/jquery.contextMenu.js'}
{pageaddvar name='stylesheet' value='modules/DbtDiary/style/jquery.contextMenu.css'}
{* Set up some initial javascript values *}
<script type="text/javascript">
{/literal}
    var date='{$date}';
    var initialSkills=[{foreach item=skill from=$skills}'{$skill.skill_id}', {/foreach}];
    {* var csrftoken="{insert name='csrftoken'}"; *}
{literal}
</script>
{img modname='core' src='/up.png' set='icons/extrasmall' 
    alt='I used this skill today.' class="AddSkill" assign='addIcon'}

{ include file="dbtdiary_user_menu.tpl" }

{* Pop-up form for pre/post skill use *}
<div id="PrePostForm" title="Distress Tolerance Evaluation">
    <p class="validateTips">
        Rate your level of distress tolerance both before and after using the 
        skill. Use 0 for "No tolerance", to 100 for "Easy tolerance, no problem".
        If you are about to use the skill, you may rate just your pre-skill ability
        now, and come back later to finish.
    </p>
    <form>
        <fieldset>
            <label for="before">Pre-Skill</label>
            <input  type="text" name="before" id="before" maxlength="3" size="3"
                     class="text ui-widget-content ui-corner-all">
            <label for="after">Post-Skill</label>
            <input  type="text" name="after" id="after" maxlength="3" size="3"
                    class="text ui-widget-content ui-corner-all">
        </fieldset>
    </form>
</div>

{* Pop-up form for PROS and CONS skill *}
<div id="ProsConsForm" title="PROS and CONS Evaluation">
    <p class="validateTips">
        Select a crisis where you found it <strong>really</strong> hard to
        tolerate distress, avoid destructive behavior, and not act impulsively.
    </p>
    <form>
        <fieldset>
            <label for="behavior"><strong>Destructive</strong> behavior I wanted to do:</label>
            <input  type="text" name="behavior" id="behavior" maxlength="100" size="200"
                     class="text ui-widget-content ui-corner-all">
            <table>
                <tr>
                    <td >
                        <label for="tolerate_pros"><strong>Tolerating: Pros</strong> <br />(Advantages of tolerating)</label>
                        <textarea  type="text" name="tolerate_pros" id="tolerate_pros" cols="40" rows="5"
                                maxlength="255" class="text ui-widget-content ui-corner-all"></textarea>
                    </td>
                    <td>
                        <label for="tolerate_cons"><strong>Tolerating: Cons</strong> <br />(Disadvantages of tolerating)</label>
                        <textarea  type="text" name="tolerate_cons" id="tolerate_cons" cols="40" rows="5"
                                maxlength="255" class="text ui-widget-content ui-corner-all"></textarea>
                    </td>
                </tr>
                <tr>
                    <td >
                        <label for="nottolerate_pros"><strong>Not Tolerating: Pros</strong><br />(Advantages of not tolerating)</label>
                        <textarea  type="text" name="nottolerate_pros" id="nottolerate_pros" cols="40" rows="5"
                                maxlength="255" class="text ui-widget-content ui-corner-all"></textarea>
                    </td>
                    <td>
                        <label for="nottolerate_cons"><strong>Tolerating: Cons</strong> <br />(Disadvantages of not tolerating)</label>
                        <textarea  type="text" name="nottolerate_cons" id="nottolerate_cons" cols="40" rows="5"
                                maxlength="255" class="text ui-widget-content ui-corner-all"></textarea>
                    </td>
                </tr>
                    
            </table>
        </fieldset>
    </form>
</div>

<h3>Skills for {$date}</h3>
<p id="message"></p>
<div id="SkillsUsed">
    {include file='dbtdiary_skillsused.tpl'}
</div>

<p class="z-formnote z-informationmsg">
    {gt text="Select skills that you used today 
    by clicking on the arrow icon in the lists below."}
</p>
<div id="AllSkills">
    <ul id="SkillsTabsMenu">
        {foreach item="module" from=$modules}
            {assign var=modname value=$module.name|strip:''}
            <li id="Tab{$modname}">
                <a href="#{$modname}">{$module.name}</a>
            </li>
            {/foreach}
    </ul>
    {foreach item=module from=$modules}
        <div id="{$module.name|strip:''}">
            {foreach item=head from=$module.headings}
                <div class="skills {$head.name|strip:''}">
                    <h4 class="skills">{$head.name}</h4>
                    <ul>
                    {foreach item=skill from=$head.skills}
                        <li class="skills" id="skill{$skill.id}">
                            <a href="{modurl modname="Wikula" func="show" tag=$skill.name|strip:'_'}">{$skill.htname}</a>
                            {$addIcon.imgtag}
                        </li>
                    {/foreach}
                    </ul>
                </div>
            {/foreach}
        </div>
	    <div style="clear: left"></div>
    {/foreach}
</div>
