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

    /* Some Globals
     */

     var    Before, After, EditID;  // The ID we are editing in the modal dialog.
     // skill51 is Pros and Cons
     // 
    // Initializers, to be run on document ready.
    $(document).ready(function() {
        Before = $('#before');
        After = $('#after');
        $( "#accordion" ).accordion({ autoHeight: false });
        skillHide(initialSkills);
        $("li.skills").click(skillHandler);
        HookEditDelete();
        $( "#PrePostForm" ).dialog({
            autoOpen: false,
            height: 350,
            width: 350,
            modal: true,
            resizable: false,
            show: "blind",
            hide: "blind" ,
            buttons: {
                    "Rate Skill": RateSkillHandler,
                    Cancel: function() {
                            $( this ).dialog( "close" );
                    }
            },
            close: function() {
                    //allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });
        $( "#ProsConsForm" ).dialog({
            autoOpen: false,
            height: 480,
            width: 580,
            modal: true,
            resizable: false,
            show: "blind",
            hide: "blind" ,
            buttons: {
                    "Save": ProsConsSave,
                    Cancel: function() {
                            $( this ).dialog( "close" );
                    }
            },
            close: function() {
                    //allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });
    });

    function HookEditDelete() {
        $("img.RemoveSkill").click(RemoveSkillHandler);
        $("img.EditSkill").click(EditSkillHandler);
        $("img.EditProsCons").click(ProsConsHandler);
    }

    // Handler functions go here.
    function skillHandler() {
        $('img#skillWaiting').show();
/*        if (csrftoken) {
            $.ajaxSetup({
                headers: {
                    'X-ZIKULA-AJAX-TOKEN': csrftoken
                }
            });
        }
*/
        $.getJSON('/ajax.php',{
            module: 'DbtDiary', func: 'addskill',
            date: date,
            skill: $(this).attr('id')
        }, skillCallback);
    }
    
    function skillCallback(data){
        $('img#skillWaiting').hide();
        $('#SkillsUsed').html(data.data.output);
        HookEditDelete();
        $('#'+data.data.id).hide('slow');
    }
    
    function skillHide(skills){
        for (var i in skills) {
            $('#skill' + skills[i]).hide();
        }
    }

    // Handler functions go here.
    function RemoveSkillHandler() {
        $('img#skillWaiting').show();
        $.getJSON('/ajax.php',{
            module: 'DbtDiary', func: 'removeskill',
            date: date,
            skillused: $(this).parent().attr('id')
        }, RemoveSkillCallback);
    }
    
    function RemoveSkillCallback(data){
        $('img#skillWaiting').hide();
        $('#SkillsUsed').html(data.data.output);
        $('#'+data.data.id).show('slow');
        HookEditDelete();
    }

    function EditSkillHandler() {
        EditID=$(this).parent().attr('id');
        var name=$(this).parent().attr('name');
        var nums = $( '#' + EditID ).find('span').text().match(/^\((\d+)\/(\d+)/);
        if (nums) {
            Before.val(nums[1]);
            After.val(nums[2]);
        } else {
            Before.val('');
            After.val('');
        }
        $( '#PrePostForm' ).dialog( "option", "title", 'Rate Skill: ' + name );
        $( '#PrePostForm' ).dialog( "open" );
    }

    function RateSkillHandler() {
        B=Before.val();
        A=After.val();
        if (B>=0 && B<=100 && A>=0 && A<=100) {
            $.getJSON('/ajax.php',{
                module: 'DbtDiary', func: 'rateskill',
                id: EditID,
                before: B,
                after: A
            }, skillCallback);
            if (B == '') { 
                B = '-';
            }
            $( '#' + EditID ).find('span').text('(' + B + '/' + A + ')');
            $( this ).dialog( "close" );
        }
    }

    function ProsConsHandler() {
        EditID=$(this).parent().attr('id');
        var name=$(this).parent().attr('name');
        var nums = $( '#' + EditID ).find('span').text().match(/^\((\d+)\/(\d+)/);
/*        if (nums) {
            Before.val(nums[1]);
            After.val(nums[2]);
        } else {
            Before.val('');
            After.val('');
        } */
        $( '#ProsConsForm' ).dialog( "option", "title", 'Rate Skill: ' + name );
        $( '#ProsConsForm' ).dialog( "open" );
    }

    function ProsConsSave() {
            $.getJSON('/ajax.php',{
                module: 'DbtDiary', func: 'saveProsCons',
                id: EditID,
                behavior: $('#behavior').val(),
                tolerate_pros: $('#tolerate_pros').val(),
                tolerate_cons: $('#tolerate_cons').val(),
                nottolerate_pros: $('#nottolerate_pros').val(),
                nottolerate_cons: $('#nottolerate_cons').val()
            }, skillCallback);
            $( this ).dialog( "close" );
    }


}(jQuery) );
