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
        $( "#pickdate" ).datepicker({ 
            showAnim: 'blind',
            maxDate: "+0d",
            minDate: "-1y",
            dateFormat: "yy-mm-dd"
            });
        $('#pickdate').change( function() {
            window.location='DbtDiary/editdiaryentry/date/' + $(this).attr('value');
        }
        );
    });

}(jQuery) );
