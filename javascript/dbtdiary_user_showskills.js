/**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

// Wrapper for jQuery namespace.
(function ($) {

    /* Some Globals
     */

    var Before, After, EditID, First=true;  // The ID we are editing in the modal dialog.
    var AjaxPhp=Zikula.Config.baseURL + 'ajax.php';
    // skill51 is Pros and Cons

    // Initializers, to be run on document ready.
    $(document).ready(function() {
        Before = $('#before');
        After = $('#after');
        $("#AllSkills").tabs({ autoHeight: false });
        skillHide(initialSkills);
        $("li.skills").click(skillHandler);
        $("#PrePostForm").dialog({
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
        $("#ProsConsForm").dialog({
            autoOpen: false,
            height: 480,
            width: 580,
            modal: true,
            resizable: false,
            show: "blind",
            hide: "blind",
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

        HookEditDelete();
        
        // Return AJAX token in headers
        if (Zikula.Config.sessionName) {
            var token = new RegExp(Zikula.Config.sessionName + '=(.*?)(;|$)').exec(document.cookie);
            if (token[1]) {
                $.ajaxSetup({
                    headers: {
                        'X-ZIKULA-AJAX-TOKEN': token[1]
                    }
                });
            }
        }
  

    });
    
    function SkillMenuCallback(action, el, pos) {

        // Get the ID of whatever we are working on.
        // Save in a global so callbacks can use it.
        EditID = $(el).parent().attr('id');
        var name = $(el).parent().attr('name');
        
	switch (action)
	{
	    case 'remove':
		$('img#skillWaiting').show();
		$.getJSON(AjaxPhp,{
		    module: 'DbtDiary', func: 'removeskill',
		    date: date,
		    skillused: EditID
		}, RemoveSkillCallback);
		break;

	    case 'rate':
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
		break;
                
            case 'proscons':
                // Load the pros/cons information via ajax,
                // Launch form when the data comes back.
                $.getJSON(AjaxPhp,{
                    module: 'DbtDiary', func: 'loadProsCons',
                    id: EditID
                    }, ProsConsHandlerCallback);
                $('img#skillWaiting').show();
                break;
	    
            default:
                alert('Invalid action: ' + action);
                
	}
    }

    function HookEditDelete() {
        if (First) {
            $('ul#SkillsMenu').clone().attr('id', 'DistressMenu').insertAfter('ul#SkillsMenu');
            $('ul#SkillsMenu').clone().attr('id', 'ProsConsMenu').insertAfter('ul#SkillsMenu');
            First = false;
        }
	$("img.EditSkill").contextMenu({
	    menu: 'SkillsMenu',
	    Button: 0
	}, SkillMenuCallback);

        $("img.EditDistress").contextMenu({
	    menu: 'DistressMenu',
	    Button: 0
	}, SkillMenuCallback);
        $('ul#DistressMenu').disableContextMenuItems('#proscons');
        
	$("img.EditProsCons").contextMenu({
	    menu: 'ProsConsMenu',
	    Button: 0
	}, SkillMenuCallback);
        $('ul#SkillsMenu').disableContextMenuItems('#rate,#proscons');
        
    }

    // Handler functions go here.
    function skillHandler() {
        $('img#skillWaiting').show();
        $.getJSON(AjaxPhp, {
            module: 'DbtDiary', func: 'addskill',
            date: date,
            skill: $(this).attr('id')
        }, skillCallback);
    }
    
    function skillCallback(data){
        $('img#skillWaiting').hide();
	if (data.data) {
	    $('#SkillsUsed').html(data.data.output);
	    $('#'+data.data.id).hide('slow');
            $('p#message').text(data.data.message);
	}
        HookEditDelete();
    }
    
    function skillHide(skills){
        for (var i in skills) {
            $('#skill' + skills[i]).hide();
        }
    }

    function RemoveSkillCallback(data){
        $('img#skillWaiting').hide();
        $('#SkillsUsed').html(data.data.output);
        if (data.data) $('#'+data.data.id).show('slow');
        HookEditDelete();
    }

    function RateSkillHandler() {
        B=Before.val();
        A=After.val();
        if (B>=0 && B<=100 && A>=0 && A<=100) {
            $.getJSON(AjaxPhp,{
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
	$.getJSON(AjaxPhp,{
	    module: 'DbtDiary', func: 'loadProsCons',
	    id: EditID
            }, ProsConsHandlerCallback);
        $('img#skillWaiting').show();
    }

    function ProsConsHandlerCallback(obj) {
	$('#behavior').val(obj.data.behavior);
	$('#tolerate_pros').val(obj.data.tolerate_pros);
	$('#tolerate_cons').val(obj.data.tolerate_cons);
	$('#nottolerate_pros').val(obj.data.nottolerate_pros);
	$('#nottolerate_cons').val(obj.data.nottolerate_cons);
        $('img#skillWaiting').hide();
        $( '#ProsConsForm' ).dialog( "open" );
    }

    function ProsConsSave() {
            $.getJSON(AjaxPhp,{
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
