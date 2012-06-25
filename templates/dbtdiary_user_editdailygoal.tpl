

{ include file="dbtdiary_user_menu.tpl" }

<h3>{gt text="Daily Goal for "}{$date|date_format:'%a %b %e, %Y'}</h3>

{insert name='getstatusmsg' module='DbtDiary'}

{nocache}
{form cssClass="z-form"}
        {formvalidationsummary}


    <fieldset class="z-linear">
        <legend>{gt text="Daily Goal"}</legend>
        <div class="z-formrow">
            {formlabel for="goal" __text="Goal" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="goal" mandatory=1}
        </div>

        <div class="z-formrow">
            {formlabel for="motivators" __text="Motivators" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="motivators" mandatory=1}
        </div>

        <div class="z-formrow">
            {formlabel for="barriers" __text="Barriers" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="barriers" mandatory=1}
        </div>

        <div class="z-formrow">
            {formlabel for="done" __text="Completed ?" mandatorysym=0}
            {formdropdownlist id="done" width="5em" mandatory="0"}
        </div>

    </fieldset>

    <div class="z-buttons z-formbuttons">
        {formbutton class='z-bt-ok' commandName='create' __text='Save'}
        {* formbutton class='z-bt-cancel' commandName='cancel' __text='Cancel' *}
        <a href="{modurl modname='DbtDiary' type='user' func='main'}" title="{gt text="Cancel"}">{img modname=core src=button_cancel.png set=icons/extrasmall __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
    </div>
{/form}
{/nocache}
