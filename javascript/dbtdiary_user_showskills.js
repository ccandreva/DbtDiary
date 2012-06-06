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
        $("li.skills").click(skillHander);
        $("td.skillsused").click(skillusedHander);
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

    // Handler functions go here.
    function skillusedHander() {
        $('img#skillWaiting').show();
        $.getJSON('/ajax.php',{
            module: 'DbtDiary', func: 'removeskill',
            date: date,
            skillused: $(this).attr('id')
        }, skillusedCallback);
    }
    
    function skillusedCallback(data){
        $('img#skillWaiting').hide();
        $('#SkillsUsed').html(data.data.output);
        alert(data.data.id);
        $('#'+data.data.id).show('slow');
    }
    


}(jQuery) );
