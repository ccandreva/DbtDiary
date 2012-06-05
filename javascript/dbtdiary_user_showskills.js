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
        //$('img#skillWaiting').hide();
        $( "#accordion" ).accordion({ autoHeight: false });
        $("li").click(skillHander);
        skillHide(initialSkills);
    });

    // Handler functions go here.
    function skillHander() {
        //alert($(this).attr('id'));
        //$(this).unbind();
        //$('th#skillshead').html('Loading . . .');
        $('img#skillWaiting').show();
        $.getJSON('/ajax.php',{
            module: 'DbtDiary', func: 'addskill',
            date: date,
            skill: $(this).attr('id')
        }, skillCallback);
    }
    
    function skillCallback(data){
        $('img#skillWaiting').hide();
        $('#SkillsUsed').html(data.data.output);
        $('#'+data.data.id).hide('slow');
    }
    
    function skillHide(skills){
        for (var i in skills) {
            $('#skill' + skills[i]).hide();
        }
    }
}(jQuery) );
