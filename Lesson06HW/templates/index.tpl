{config_load file='test.conf' section="setup"}
{include file="header.tpl" title=foo}

<ul>
    {section name=sec1 loop=$menu}
        <li><a href="./index.php?page={$menu[sec1].url}">{$menu[sec1].title}</a></li>
    {/section}
</ul>


<PRE>

{* bold and title are read from the config file *}
{if #bold#}<b>{/if}
{* capitalize the first letters of each word of the title *}
Title: {$title|capitalize}
{if #bold#}</b>{/if}


Дата: {$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}

{if #bold#}<b>{/if}
Содержимое:
{if #bold#}</b>{/if}
{$content}

{include file="footer.tpl"}
