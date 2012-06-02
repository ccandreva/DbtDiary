{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{pageaddvar name="stylesheet" value="/javascript/jquery-ui/themes/cupertino/jquery-ui.css"}
{pageaddvar name='javascript' value='jquery' }
{pageaddvar name='javascript' value='jquery-ui' }

{ include file="dbtdiary_user_menu.tpl" }

<h3>Skills</h3>

<div id="accordion">
    {foreach item=module from=$modules}
	<h3><a href="#">{$module.name}</a></h3>
        <div class="{$module.name|strip:''}">
            {foreach item=head from=$module.headings}
                <div class="skills {$head.name|strip:''}">
                    <h3 class="skills">{$head.name}</h3>
                    <ul>
                    {foreach item=skill from=$head.skills}
                        <li class="skills">{$skill.htname}</li>
                    {/foreach}
                    </ul>
                </div>
            {/foreach}
        </div>
    {/foreach}
</div>

<script type="text/javascript">
    (function($) {
	$( "#accordion" ).accordion({ autoHeight: false });
    }(jQuery) );
</script>


