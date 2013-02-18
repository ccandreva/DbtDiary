{pageaddvar name='javascript' value='jquery'}
{pageaddvar name='javascript' value='jquery-ui'}
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/dbtdiary_user_editworksheetgp.js'}
{* pageaddvar name="stylesheet" value="javascript/jquery-ui/themes/cupertino/jquery-ui.css" *}


{ include file="dbtdiary_user_menu.tpl" }

<h3>{gt text="Goals and Priorities in Interpersonal Situations"}{*$date|date_format:'%b %e, %Y'*}</h3>

{insert name='getstatusmsg' module='DbtDiary'}

<p>
    Use this sheet to figure out your goals and priorities in any situation that
    creates a problem for you, such as ones where:
</p>
<ol>
    <li>Your rights or wishes are not being respected.</li>
    <li>You want someone to do, change, or give you something.</li>
    <li>You want or need to say no, or resist pressure to do something.</li>
    <li>You want to get your position or point of view taken seriously.</li>
    <li>There is conflict with another person.</li>
</ol>
    
<p>
    Observe and describe in writing as clost in time to the situation as possible.
</p>
    
{nocache}
{form cssClass="z-form"}
    {formvalidationsummary}

    <fieldset class="z-linear">
        
        <div class="z-formrow">
            {formlabel for="event" mandatorysym="1" html="1"
                text="<strong>Prompting Event</strong> for my problem: Who did what to whom? What led up to what ? What is it about this situation that is a problem for me ?"}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="event" mandatory=1}
        </div>
        
        <h4>My <em>Wants and Desires</em> in this situation:</h4>
        <p>
            Write down what you want from this interaction in the three categories. 
            Then sort them based on your <strong>Priorities</strong> using 
            drag and drop.
            Place the most important at the top, least important at the bottom.
       </p>
        
        <ol id="WantsDesires">
            {assign var=wdorder2 value=','|explode:$wdorder}

            {foreach from=$wdorder2 item=wd}
                <li class="ui-state-default">
                    <div class="z-formrow">
                        {formlabel for=$wd text=`$wdText.$wd` mandatorysym=1}
                        {formtextinput textMode="multiline" rows="4" cols="50"
                            maxLength="255" id=$wd mandatory=1}
                    </div>
                </li>
            {/foreach}
        </ol>

        <div class="z-formrow">
            {formlabel for="conflicts" html="1" __text="<strong>Conflicts in Priorities</strong> that make it hard to be effective in this situation ?" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="conflicts" mandatory=1}
        </div>

    </fieldset>
    {formtextinput textMode="hidden" id="wdorder"}
    <div class="z-buttons z-formbuttons">
        {formbutton class='z-bt-ok' commandName='save' __text='Save'}
        {* formbutton class='z-bt-cancel' commandName='cancel' __text='Cancel' *}
        <a href="{modurl modname='DbtDiary' type='user' func='main'}" title="{gt text="Cancel"}">{img modname=core src=button_cancel.png set=icons/extrasmall __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
    </div>

{/form}
{/nocache}
