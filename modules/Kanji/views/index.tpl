<section class="nicdark_section  vc_row wpb_row vc_row-fluid ">
    <div class="nicdark_container nicdark_vc nicdark_clearfix">
        <div class="row">
            {if $items|count > 0}
                {foreach $items AS $ite}
                    <a href="{site_url uri="kanji/"|cat:$ite.ascii}" class="col-2 character red">
                        <ruby class="wr" data-id="{$ite.ascii}">
                            {$ite.word}
                            <rp>(</rp>
                            <rt>{$ite.chinese}</rt>
                            <rp>)</rp>
                        </ruby>
                    </a>
                {/foreach}
            {/if}

        </div>
    </div>
</section>