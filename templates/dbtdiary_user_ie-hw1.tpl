

{ include file="dbtdiary_user_menu.tpl" }

<h3>{gt text="Goals and Priorities in Interpersonal Situations"}{*$date|date_format:'%b %e, %Y'*}</h3>

{insert name='getstatusmsg' module='DbtDiary'}

<p>
    Use this sheet to figure out your goals and priorities in any situation that
    creates a problem for you, such as ones where:
</p>
<ol>
    <li>Your rights or wishes are not being respected. </li>
    <li>You want someone to do, change, or give you something.</li>
    <li>You want or neet to say no or resist pressure to do something.</li>
    <li>You want to get your position or point of view taken seriously</li>
    <li>There is conflict with another person.<li>
</ol>
    
<p>
    Observe and describe in writing as clost in time to the situation as possible.
</p>
    

{nocache}
{form cssClass="z-form"}
    {formvalidationsummary}


    <fieldset class="z-linear">
        
        <div class="z-formrow">
            {formlabel for="event" __text="Prompting Event for my problem: Who did what to whom? What led up to what ? What is it about this situation that is a problem for me ?" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="event" mandatory=1}
        </div>
        <h4>My <em>Wants and Desires</em> in this situation:</h4>
        <div class="z-formrow">
            {formlabel for="objectives" __text="Objectives: What specific results do I want ? What changes do I want this person to make ?" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="objectives" mandatory=1}
        </div>
        <div class="z-formrow">
            {formlabel for="relationship" __text="Relationship: How do I want the other person to feel about me after the interaction ?" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="relationship" mandatory=1}
        </div>
        <div class="z-formrow">
            {formlabel for="selfrespect" __text="Self-Respect: How do I want to feel about myself after the interaction ?" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="selfrespect" mandatory=1}
        </div>

        <h4>my <em>priorities</em> in this situaion: Rate priorities in order of importance, 1 most, 3 least.</h4>
        
        <div class="z-formrow">
            {formlabel for="conflicts" __text="<em>Conflicts in Priorities</em> that make it hard to be effective in this situation ?" mandatorysym=1}
            {formtextinput textMode="multiline" rows="4" cols="50"
                maxLength="255" id="conflicts" mandatory=1}
        </div>

    </fieldset>
    <div class="z-buttons z-formbuttons">
        {formbutton class='z-bt-ok' commandName='create' __text='Save'}
        {* formbutton class='z-bt-cancel' commandName='cancel' __text='Cancel' *}
        <a href="{modurl modname='DbtDiary' type='user' func='main'}" title="{gt text="Cancel"}">{img modname=core src=button_cancel.png set=icons/extrasmall __alt="Cancel" __title="Cancel"} {gt text="Cancel"}</a>
    </div>

{/form}
{/nocache}
