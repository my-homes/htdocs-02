{assign var ='pref' value ='Toyama'}
{$pref}
<br>
{* short-hand *}
{assign 'pref02' 'Hyogo'}
{$pref02}

<table border="1">
    <tr>
        <td>total</td><td>{$total}</td><td>diff_total</td><td>{$diff_total}</td>
    </tr>
</table>

<table border="1">
    <tr>
        <th>title</th>
        <th>view</th>
        <th>view+</th>
    </tr>
    {foreach $list as $rec}
        <tr>
            <td>
                <a target="_blank" href="{$rec.url}">{$rec.title}</a>
            </td>
            <td>
                {$rec.view}
            </td>
            <td>
                {$rec['view+']}
            </td>
        </tr>
    {/foreach}
</table>