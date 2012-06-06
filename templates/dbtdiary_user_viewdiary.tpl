{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{pageaddvar name='javascript' value='jquery'}
{* Highcharts does client-side graphs in javascript *}
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/highcharts.js'}
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/exporting.js'}

{ include file="dbtdiary_user_menu.tpl" }

<h3>Diary</h3>
{nocache}
{pager rowcount=$pager.numitems limit=$pager.itemsperpage maxpages='10' posvar='startnum'}
{assign var=data value=$data|@array_reverse}
<table class="comments">
    <caption>Comments</caption>
    <thead>
        <tr>
            {foreach item=datum from=$data}
                <th scope="row">
                    <a href="{modurl modname="dbtdiary" func="editdiaryentry" date=$datum.date}">
                    {$datum.date|date_format:'%a %m/%d'}</a>
                </th>
            {/foreach}
        </tr>
    </thead>
    <tbody>
        <tr>
            {foreach item=datum from=$data}
                <td>{$datum.comments}</td>
            {/foreach}
        </tr>
    </tbody>
    
</table>

<table class="emotions" id='Emotions'>
    <caption>Emotions Felt</caption>
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th scope="col">{gt text="Hurt"}</th>
            <th scope="col">{gt text="Happy"}</th>
            <th scope="col">{gt text="Tense"}</th>
            <th scope="col">{gt text="Misery"}</th>
            <th scope="col">{gt text="Panic"}</th>
            <th scope="col">{gt text="Overwhelmed"}</th>
            <th scope="col">{gt text="Angry"}</th>
            <th scope="col">{gt text="Sad"}</th>
            <th scope="col">{gt text="Hopeful"}</th>
            <th scope="col">{gt text="Alone"}</th>
            <th scope="col">{gt text="Distracted"}</th>
            <th scope="col">{gt text="Bad"}</th>
            <th scope="col">{gt text="Guilty"}</th>
            <th scope="col">{gt text="Unreal"}</th>
        </tr>
    </thead>
    
    <tbody>
        {foreach item=datum from=$data}
            <tr>
                <th scope="row">
                    <a href="{modurl modname="dbtdiary" func="editdiaryentry" date=$datum.date}">
                    {$datum.date|date_format:'%a %m/%d'}</a>
                </th>
                {foreach item=emotion from=$emotions}
                    <td class="{$emtype.$emotion}emotionlevel{$datum.$emotion}">{$datum.$emotion}</td>
                    {if $datum.$emotion > 0}{assignel var='Was' key=$emotion value=1}{/if}
                {/foreach}
           </tr>
        {/foreach}
    </tbody>
</table>

    <table class="emotions" id='Urges'>
    <caption>Urges Felt</caption>
    <thead>
        <tr>
            <th></th>
            <th scope="col">{gt text="Injure"}</th>
            <th scope="col">{gt text="Suicide"}</th>
            <th scope="col">{gt text="Skip Meds"}</th>
            <th scope="col">{gt text="Skip Job"}</th>
            <th scope="col">{gt text="Binge"}</th>
            <th scope="col">{gt text="Pure"}</th>
            <th scope="col">{gt text="Alcohol"}</th>
            <th scope="col">{gt text="Drugs"}</th>
        </tr>
    </thead>
    
    <tbody>
        {foreach item=datum from=$data}
            <tr>
                <th scope="row">{$datum.date|date_format:'%a %m/%d'}</th>
                {foreach item=urge from=$urges}
                    <td class="Nemotionlevel{$datum.$urge}">{$datum.$urge}</td>
                {/foreach}
        {/foreach}
    </tbody>
</table>

		<script type="text/javascript">
(function ($) {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line',
                marginRight: 80,
                marginBottom: 25
            },
            title: {
                text: 'Emotion Ratings',
                x: -20 //center
            },
            subtitle: {
                text: 'As Recorded By Patient',
                x: -20
            },
            xAxis: {
                categories: [{/literal}{foreach item=datum from=$data}'{$datum.date|date_format:'%a %m/%d'}',{/foreach}{literal}]
            },
            yAxis: {
                title: {
                    text: 'Emotion Level'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y;
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: 10,
                y: 100,
                borderWidth: 0
            },
            series: [
                {/literal}{foreach item=emotion from=$emotions}{if $Was.$emotion > 0}{literal}
                {
                name: '{/literal}{$emotion}{literal}',
                data: [{/literal}{foreach item=datum from=$data}{$datum.$emotion|default:'0'},{/foreach}]{literal}
                },
                {/literal}{/if}{/foreach}{literal}]
        });
    });
})(jQuery);
		</script>
                
{/nocache}

<div id="container" style="min-width: 700px; height: 500px; margin: 0 auto"></div>
