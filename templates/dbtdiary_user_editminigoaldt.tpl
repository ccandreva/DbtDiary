

{ include file="dbtdiary_user_menu.tpl" }

<h3>{gt text="Goals and Steps"}</h3>

{insert name='getstatusmsg' module='DbtDiary'}

{nocache}
{form cssClass="z-form"}
    {formvalidationsummary}


    <fieldset class="z-linear">
        {*<legend>{gt text="Weekly Goal"}</legend> *}

        <div class="z-formrow">
            {formlabel for="done" __text="Was this done today ?" mandatorysym=0}
            {formdropdownlist id="done" width="5em" mandatory="0"}
        </div>

    </fieldset>
    <div class="z-buttons z-formbuttons">
        {formbutton class='z-bt-ok' commandName='save' __text='Save'}
        {formbutton class='z-bt-cancel' commandName='cancel' __text='Cancel' }
    </div>

{/form}
{/nocache}
