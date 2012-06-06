

{ include file="dbtdiary_user_menu.tpl" }

<h3>{gt text="Diary for "}{$date|date_format:'%a %b %e, %Y'}</h3>

{insert name='getstatusmsg' module='DbtDiary'}

{nocache}
{form cssClass="z-form"}
        {formvalidationsummary}


    <fieldset class="z-linear">
        <legend>{gt text="Diary"}</legend>
        <p class="z-formnote z-informationmsg">
            <strong>Comments About the Day</strong>
        </p>
        <div class="z-formrow">
            {*formlabel for="comments" __text="Comments:" mandatorysym=0*}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="2048" id="comments"}
        </div>
    </fieldset>

    <fieldset id="Emotions" class="z-linear dbt-grid">
        <legend>{gt text="Emotions"}</legend>
        <p class="z-formnote z-informationmsg">
            <strong>Today I felt (rate 0-9)</strong>
            <br />
            1 = least intensity, 9= most intense
        </p>

        <div class="z-formrow">
            {formlabel for="hurt" __text="Hurt:" mandatorysym=0}
            {formdropdownlist id="hurt" width="3em" mandatory="1"}
        </div>
        <div class="z-formrow">
            {formlabel for="good" __text="Good/Happy:" mandatorysym=0}
            {formdropdownlist id="good" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="tense" __text="Anxious/Tense:" mandatorysym=0}
            {formdropdownlist id="tense" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="miserable" __text="Miserable:" mandatorysym=0}
            {formdropdownlist id="miserable" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="panic" __text="Panic:" mandatorysym=0}
            {formdropdownlist id="panic" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="overwhelmed" __text="Overwhelmed:" mandatorysym=0}
            {formdropdownlist id="overwhelmed" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="angry" __text="Angry:" mandatorysym=0}
            {formdropdownlist id="angry" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="sad" __text="Depressed/Sad:" mandatorysym=0}
            {formdropdownlist id="sad" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="hopeful" __text="Hopeful:" mandatorysym=0}
            {formdropdownlist id="hopeful" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="alone" __text="Empty/Alone:" mandatorysym=0}
            {formdropdownlist id="alone" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="distracted" __text="Easily Distracted:" mandatorysym=0}
            {formdropdownlist id="distracted" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="bad" __text="Physically Bad:" mandatorysym=0}
            {formdropdownlist id="bad" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="guilty" __text="Shameful/Guilty:" mandatorysym=0}
            {formdropdownlist id="guilty" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="unreal" __text="Unreal/Disconnected:" mandatorysym=0}
            {formdropdownlist id="unreal" width="3em" mandatory="1"}
        </div>
    </fieldset>

    <fieldset id="Emotions" class="z-linear dbt-grid">
        <legend>{gt text="Urges"}</legend>

        <p class="z-formnote z-informationmsg">
            <strong>Today I felt an urge to (rate 0-9)</strong>
            <br />
            1 = least intensity, 9= most intense, Y Indicates I took Action
        </p>

        <div class="z-formrow">
            {formlabel for="injure" __text="Injure Self:" mandatorysym=0}
            {formdropdownlist id="injure" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="kill" __text="Kill Self:" mandatorysym=0}
            {formdropdownlist id="kill" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="meds" __text="Skip Meds:" mandatorysym=0}
            {formdropdownlist id="meds" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="skip" __text="Skip Pgrm/Job:" mandatorysym=0}
            {formdropdownlist id="skip" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="binge" __text="Binge:" mandatorysym=0}
            {formdropdownlist id="binge" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="purge" __text="Purge:" mandatorysym=0}
            {formdropdownlist id="purge" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="alcohol" __text="Alcohol:" mandatorysym=0}
            {formdropdownlist id="alcohol" width="3em" mandatory="1"}
        </div>

        <div class="z-formrow">
            {formlabel for="drugs" __text="Illicit Drugs:" mandatorysym=0}
            {formdropdownlist id="drugs" width="3em" mandatory="1"}
        </div>
    </fieldset>
    <div class="z-buttons z-formbuttons">
        {formbutton class='z-bt-ok' commandName='create' __text='Save'}
        {* formbutton class='z-bt-cancel' commandName='cancel' __text='Cancel' *}
        <a href="{modurl modname='DbtDiary' type='user' func='main'}" title="{gt text="Cancel"}">{img modname=core src=button_cancel.png set=icons/extrasmall __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
    </div>
{/form}
{/nocache}
