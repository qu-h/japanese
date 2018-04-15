{assign var=bgColor value=['green','orange','yellow','grey','grey2']}
{*except red*}
{assign var=colorIndex value=0}
<div class="nicdark_archive1 nicdark_bg_red nicdark_radius nicdark_shadow">
    <div class="nicdark_margin20 nicdark_post_archive">
        <h4 class="white">{$title|trans}</h4>
        <div class="nicdark_space20"></div>
        <div class="nicdark_divider left small"><span class="nicdark_bg_white nicdark_radius"></span></div>
        <div class="nicdark_space20"></div>
        <p class="white">
        {foreach $content AS $parts}
            {$colorIndex = $colorIndex + 1}
            {if $colorIndex >= $bgColor|count}
                {$colorIndex = 0}
            {/if}
            <div>
                {foreach $parts AS $p}
                    {btn_text text=$p bg=$bgColor[$colorIndex] }
                {/foreach}
            </div>
            {/foreach}
        </p>
        <div class="nicdark_space5"></div>
    </div>
</div>