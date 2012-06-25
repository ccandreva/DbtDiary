

{ include file="dbtdiary_user_menu.tpl" }

<h3>{gt text="Goals and Steps for Week of "}{$date|date_format:'%b %e, %Y'}</h3>

{insert name='getstatusmsg' module='DbtDiary'}

{nocache}
{form cssClass="z-form"}
    {formvalidationsummary}


    <fieldset class="z-linear">
        {*<legend>{gt text="Weekly Goal"}</legend> *}
        <div class="z-formrow">
            {formlabel for="goal" __text="What is the goal that you wish to work on as part of your treatment this week ?" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="goal" mandatory=1}
        </div>

        <div class="z-formrow">
            {formlabel for="steps" __text="What steps do you think you need to take to work on this goal this week ?" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="steps" mandatory=1}
        </div>

        <div class="z-formrow">
            {formlabel for="signs" __text="What are the specific signs that will show that you made progress on this goal this week ?" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="signs" mandatory=1}
        </div>

    </fieldset>
    <div class="z-buttons z-formbuttons">
        {formbutton class='z-bt-ok' commandName='create' __text='Save'}
        {* formbutton class='z-bt-cancel' commandName='cancel' __text='Cancel' *}
        <a href="{modurl modname='DbtDiary' type='user' func='main'}" title="{gt text="Cancel"}">{img modname=core src=button_cancel.png set=icons/extrasmall __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
    </div>

{/form}
{/nocache}
