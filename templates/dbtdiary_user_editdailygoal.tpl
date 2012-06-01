

{ include file="dbtdiary_user_menu.tpl" }

<h3>{gt text="Daily Goal for "}{$date|date_format:'%a %b %e, %Y'}</h3>

{insert name='getstatusmsg' module='DbtDiary'}

{nocache}
{form cssClass="z-form"}
    <a href="{modurl modname="dbtdiary" func="editdailygoal"
        date=$date-86400}">Yesterday</a>

    {formdateinput id="jumpdate" width=6em}
    {formbutton commandName="Jump" __text="Edit Date" }
        
    <a href="{modurl modname="dbtdiary" func="editdailygoal"
        date=$date+86400}">Tomorrow</a>
        <br />
        {formvalidationsummary}


    <fieldset class="z-linear">
        <legend>{gt text="Daily Goal"}</legend>
        <div class="z-formrow">
            {formlabel for="goal" __text="Goal" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="comments" mandatory=1}
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

{formbutton commandName="submit" __text="Submit" }
{/form}
{/nocache}