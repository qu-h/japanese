{if isset($col)}
    <div class="col-md-{$col} wpb_column vc_column_container">
{/if}

    <div class=" nicdark_archive1 nicdark_relative nicdark_shadow nicdark_bg_grey pa-10">
        <div class="nicdark_activity">
            <h4 class="pa-b-20 f-upcase">{$title|trans}</h4>
            <p>{$content}</p>
            <div class="nicdark_space5"></div>
        </div>
    </div>
{if isset($col)}
    </div>
{/if}
