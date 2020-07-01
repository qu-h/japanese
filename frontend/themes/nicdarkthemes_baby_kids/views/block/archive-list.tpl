{assign var=bgColor value=['green','grey','orange','yellow','grey2']}
{*except red*}
{assign var=colorIndex value=0}
<div class="nicdark_archive1 nicdark_bg_red nicdark_radius nicdark_shadow">
    <div class="nicdark_margin20 nicdark_post_archive">
        <h4 class="white font-up">{$title|trans}</h4>

        <div class="nicdark_divider left small ma-t-b-20">
            <span class="nicdark_bg_white nicdark_radius"></span>
        </div>


        {foreach $content AS $parts}
            {$colorIndex = $colorIndex + 1}
            {if $colorIndex >= $bgColor|count}
                {$colorIndex = 0}
            {/if}
            <p class="white pa-b-2">
                {foreach $parts AS $p}
                    {btn_text text=$p bg=$bgColor[$colorIndex]  }
                {/foreach}
            </p>
        {/foreach}

        <div class="nicdark_space5"></div>
    </div>
</div>