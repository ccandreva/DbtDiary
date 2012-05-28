{**
* DBT Diary
*
* @copyright (C) 2012, Christopher X. Candreva <chris@westnet.com>
* @link http://github.com/ccandreva/DbtDiary
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*}
{*ajaxheader modname='DbtDiary' filename='highcharts.js'*}
{* pageaddvar name='javascript' value='jquery' *}
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/jquery.min.js'}
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/highcharts.js'}
{pageaddvar name='javascript' value='modules/DbtDiary/javascript/exporting.js'}

{ include file="dbtdiary_user_menu.tpl" }

<h3>Diary</h3>
{nocache}
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
                <th scope="row">{$datum.date|date_format:'%m-%d'}</th>
                <td class="Nemotionlevel{$datum.hurt}">{$datum.hurt}</td>
                <td class="Pemotionlevel{$datum.good}">{$datum.good}</td>
                <td class="Nemotionlevel{$datum.tense}">{$datum.tense}</td>
                <td class="Nemotionlevel{$datum.miserable}">{$datum.miserable}</td>
                <td class="Nemotionlevel{$datum.panic}">{$datum.panic}</td>
                <td class="Nemotionlevel{$datum.overwhelmed}">{$datum.overwhelmed}</td>
                <td class="Nemotionlevel{$datum.angry}">{$datum.angry}</td>
                <td class="Nemotionlevel{$datum.sad}">{$datum.sad}</td>
                <td class="Pemotionlevel{$datum.hopeful}">{$datum.hopeful}</td>
                <td class="Nemotionlevel{$datum.alone}">{$datum.alone}</td>
                <td class="Nemotionlevel{$datum.distracted}">{$datum.distracted}</td>
                <td class="Nemotionlevel{$datum.bad}">{$datum.bad}</td>
                <td class="Nemotionlevel{$datum.guilty}">{$datum.guilty}</td>
                <td class="Nemotionlevel{$datum.unreal}">{$datum.unreal}</td>
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
                <th scope="row">{$datum.date|date_format:'%m-%d'}</th>
                <td class="Nemotionlevel{$datum.injure}">{$datum.injure}</td>
                <td class="Nemotionlevel{$datum.kill}">{$datum.kill}</td>
                <td class="Nemotionlevel{$datum.meds}">{$datum.meds}</td>
                <td class="Nemotionlevel{$datum.skip}">{$datum.skip}</td>
                <td class="Nemotionlevel{$datum.binge}">{$datum.binge}</td>
                <td class="Nemotionlevel{$datum.purge}">{$datum.purge}</td>
                <td class="Nemotionlevel{$datum.alcohol}">{$datum.alcohol}</td>
                <td class="Nemotionlevel{$datum.drugs}">{$datum.drugs}</td>            </tr>
        {/foreach}
    </tbody>
</table>

		<script type="text/javascript">

$(function () {
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
                categories: [{/literal}{foreach item=datum from=$data}'{$datum.date|date_format:'%m-%d'}',{/foreach}{literal}]
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
                {/literal}{foreach item=emotion from=$emotions}{literal}
                {
                name: '{/literal}{$emotion}{literal}',
                data: [{/literal}{foreach item=datum from=$data}{$datum.$emotion},{/foreach}]{literal}
                },
                {/literal}{/foreach}{literal}]
        });
    });
    
});
		</script>
                
{/nocache}

<div id="container" style="min-width: 700px; height: 500px; margin: 0 auto"></div>
