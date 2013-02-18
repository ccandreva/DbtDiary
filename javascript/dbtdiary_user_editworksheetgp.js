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
        $( "#WantsDesires" ).sortable({ 
            items: 'li',
            placeholder: "ui-state-highlight",
            axis: 'y',
            cursor: 'crosshair'
        });
        $( "#WantsDesires" ).disableSelection();
        
        // On submit, get order of Wants/Desires, put into hidden field.
        $('form.z-form').submit(function() {
            var a = '';
            $('#WantsDesires label').each(function(index) {
                //alert(index + ': ' + $(this).attr('for') );
                if (a) a = a + ',';
                a = a + $(this).attr('for');
            });
            $('#wdorder').prop('value', a);
        });
    });

}(jQuery) );
