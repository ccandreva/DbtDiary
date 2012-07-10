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

    var Before, After, EditID;  // The ID we are editing in the modal dialog.
    var AjaxPhp=Zikula.Config.baseURL + 'ajax.php';
    // skill51 is Pros and Cons

    // Initializers, to be run on document ready.
    $(document).ready(function() {
        // Activate tabs for Skills list
        $("#AllSkills").tabs();
        skillHide(initialSkills);  // Hide the skills already selected

        // Add skills when clicked on
        $("li.skills img").click(AddSkillHandler);
        
        // Setup the Pre/Post skill form
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
        
        // Activate the Pros/Cons form
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

        HookMenuButton();
        // Get the DOM objects for the Before/After skill form fields
        Before = $('#before');
        After = $('#after');
        
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
    
    /*
     * Hook the menu activation button
     */
    function HookMenuButton() {
	$.contextMenu({
            'selector': "img.EditSkill",
            'trigger': 'left',
	    'items':  {
                "remove": {name: "Remove Skill",
                    callback: RemoveSkillHandler,
                    icon: 'delete'},
                "rate": {name: "Rate Skill", 
                    "callback": EditSkillHandler, 
                    "disabled": function(key, opt) { return !opt.$trigger.hasClass('EditDistress');},
                    icon: 'rate'},
                "proscons": {name: "Evaluate Pros/Cons", 
                    callback: ProsConsHandler, 
                    "disabled": function(key, opt) { return !opt.$trigger.hasClass('EditProsCons');},
                    icon: 'proscons'}
                },
            'events': {
                'show': function(opt) {opt.$trigger.removeClass('r90'); },
                'hide': function(opt) {opt.$trigger.addClass('r90'); }
                }
	});

        $('#SkillsUsedTable th')
            .ajaxStart(function() {
                $(this).addClass('AjaxLoading');
            })
            .ajaxStop(function() {
                $(this).removeClass('AjaxLoading');
            });
        
    }

// Handler functions go here.
    function AddSkillHandler() {
        $.getJSON(AjaxPhp, {
            module: 'DbtDiary', func: 'addskill',
            date: date,
            skill: $(this).parent().attr('id')
        }, skillCallback);
    }

function RemoveSkillHandler(action, opt) {
        $.getJSON(AjaxPhp,{
            module: 'DbtDiary', func: 'removeskill',
            date: date,
            skillused: opt.$trigger.parent().attr('id')
        }, RemoveSkillCallback);
    }
    function RemoveSkillCallback(data){
        $('#SkillsUsed').html(data.data.output);
        if (data.data) $('#'+data.data.id).show('slow');
        HookMenuButton();
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


    function skillCallback(data){
	if (data.data) {
	    $('#SkillsUsed').html(data.data.output);
	    $('#'+data.data.id).hide('slow');
            $('p#message').text(data.data.message);
	}
        HookMenuButton();
    }
    
    function skillHide(skills){
        for (var i in skills) {
            $('#skill' + skills[i]).hide();
        }
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

    function ProsConsHandler(action, opt) {
        EditID=opt.$trigger.parent().attr('id');
	$.getJSON(AjaxPhp,{
	    module: 'DbtDiary', func: 'loadProsCons',
	    id: EditID
            }, ProsConsHandlerCallback);
    }

    function ProsConsHandlerCallback(obj) {
        if (obj.data) {
            $('#behavior').val(obj.data.behavior);
            $('#tolerate_pros').val(obj.data.tolerate_pros);
            $('#tolerate_cons').val(obj.data.tolerate_cons);
            $('#nottolerate_pros').val(obj.data.nottolerate_pros);
            $('#nottolerate_cons').val(obj.data.nottolerate_cons);
        }
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
