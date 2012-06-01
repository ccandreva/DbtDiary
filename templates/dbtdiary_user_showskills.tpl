{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}

{pageaddvar name='javascript' value='jquery' }
{pageaddvar name='javascript' value='jquery-ui' }

{ include file="dbtdiary_user_menu.tpl" }

<h3>Skills</h3>

<div id="accordion">
    {foreach item=module from=$modules}
	<h3><a href="#">{$module.name}</a></h3>
        <div>
            {foreach item=skill from=$module.skills}
                {$skill.htname}<br />
            {/foreach}
        </div>
    {/foreach}
</div>

<script type="text/javascript">
    (function($) {
	$( "#accordion" ).accordion({ autoHeight: false });
    }(jQuery) );
</script>


