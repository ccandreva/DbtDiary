/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

// Wrapper for jQuery namespace.
(function($) {

    // Initializers, to be run on document ready.
    $(document).ready(function() {
        $( "#accordion" ).accordion({ autoHeight: false });
        $("li").click(skillHander);
    });

    // Handler functions go here.
    function skillHander() {
        //alert($(this).attr('id'));
        //$(this).unbind();
        $('#SkillsUsed > h3').html('Loading . . .');
        $.getJSON('/ajax.php',{
            module: 'DbtDiary', func: 'addskill',
            skill: $(this).attr('id')
        }, skillCallback);
    }
    
    function skillCallback(data){
        $('#SkillsUsed').html(data.data.output);

    }
}(jQuery) );
