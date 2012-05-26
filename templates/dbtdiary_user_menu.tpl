{insert name="getstatusmsg"}
{gt text="DBT Diary" assign=title domain='zikula'}
<h2>{$title|safetext}</h2>
{pagesetvar name=title value=$templatetitle}
{modulelinks modname='DbtDiary' type='user'}