{insert name="getstatusmsg"}
{gt text="DBT Diary" assign=title domain='zikula'}
<h2>{$title|safetext}</h2>
{if $templatetitle}{pagesetvar name=title value=$templatetitle}{/if}
{modulelinks modname='DbtDiary' type='user'}