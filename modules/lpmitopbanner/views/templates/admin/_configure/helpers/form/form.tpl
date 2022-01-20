{extends file="helpers/form/form.tpl"}
{block name="defaultForm"}
    <div class="row">
        <div class="col-lg-2">
            <div id="options_tab" class="">
                <ul class="list-group nav-tabs">
                    {foreach $fields as $tab}
                        {if $tab.form.tab_name != 'save_tab'}
                        <li {if $tab.form.tab_name == 'main_tab'}class="active"{/if}><a class="list-group-item" data-toggle="tab"
                                                                                        href="#{$tab.form.tab_name|escape:'htmlall':'UTF-8'}">{$tab.form.legend.title|escape:'htmlall':'UTF-8'}</a></li>{/if}
                    {/foreach}
                    <ul>
            </div>
        </div>
        <div id="list-container" class="col-lg-10 tab-content">
            {$smarty.block.parent}
        </div>
    </div>
{/block}


{block name="fieldset"}
    {if $fieldset.form.tab_name != 'save_tab'}
        <div class="tab-pane {if $f < 1}active{/if}" id="{$fieldset.form.tab_name|escape:'htmlall':'UTF-8'}">
        {if isset($fieldset.form.assigned_list)}
            <div class="tab-pane clearfix">{$fieldset.form.assigned_list}</div>
        {/if}
        <div class="tab-pane">
    {/if}
    {$smarty.block.parent}
    {if $fieldset.form.tab_name != 'save_tab'}
        </div>
        </div>{/if}
{/block}

{block name="input"}
    {if $input.type == 'checkbox'}
        {if isset($input.expand)}
            <a class="btn btn-default show_checkbox{if strtolower($input.expand.default) == 'hide'} hidden{/if}" href="#">
                <i class="icon-{$input.expand.show.icon}"></i>
                {$input.expand.show.text}
                {if isset($input.expand.print_total) && $input.expand.print_total > 0}
                    <span class="badge">{$input.expand.print_total}</span>
                {/if}
            </a>
            <a class="btn btn-default hide_checkbox{if strtolower($input.expand.default) == 'show'} hidden{/if}" href="#">
                <i class="icon-{$input.expand.hide.icon}"></i>
                {$input.expand.hide.text}
                {if isset($input.expand.print_total) && $input.expand.print_total > 0}
                    <span class="badge">{$input.expand.print_total}</span>
                {/if}
            </a>
        {/if}
        {foreach $input.values.query as $value}
            {assign var=id_checkbox value=$input.name|cat:'_'|cat:$value[$input.values.id]}
            <div class="checkbox{if isset($input.expand) && strtolower($input.expand.default) == 'show'} hidden{/if}">
                {strip}
                    <label for="{$id_checkbox}">
                        <input type="checkbox" name="{$input.name}[]" id="{$id_checkbox}" class="{if isset($input.class)}{$input.class}{/if}"{if isset($value[$input.values.id])} value="{$value[$input.values.id]|escape:'html':'UTF-8'}"{/if}{if isset($fields_value[$input.name]) && $value[$input.values.id]|in_array:$fields_value[$input.name]} checked="checked"{/if} />
                        {$value[$input.values.name]}
                    </label>
                {/strip}
            </div>
        {/foreach}

    {else}
        {$smarty.block.parent}
    {/if}
{/block}
