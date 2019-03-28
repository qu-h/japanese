{include file="common/article-title.tpl" title=$topic.name }
<section class="nicdark_section  vc_row wpb_row vc_row-fluid">
    <div class="nicdark_container nicdark_vc nicdark_clearfix">
        <div class="vc_col-sm-8 wpb_column vc_column_container ">
            <div class="wpb_wrapper">
                {if $topic.words|count > 0}
                    <div class="row">
                        {foreach $topic.words AS $word}
                            <div class="col-md-4 mt-4">
                                <div class="nicdark_relative nicdark_shadow nicdark_bg_grey p-2">
                                    <p class="text-center" style="font-size: 50px; line-height: 60px;">{$word.kanji}</p>

                                    <p class="mt-1">
                                        <span class="btn-icon nicdark_bg_green small nicdark_shadow nicdark_radius  white">Romaji</span>
                                        {$word.romaji}
                                    </p>
                                    {if $word.hiragana|count_characters > 0}
                                    <p class="mt-1">
                                        <span class="btn-icon nicdark_bg_yellow small nicdark_shadow nicdark_radius  white">hiragana</span>
                                        {$word.hiragana}
                                    </p>
                                    {/if}

                                    {if $word.vietnamese|count_characters > 0}
                                    <p class="mt-1">
                                        <span class="btn-icon nicdark_bg_red small nicdark_shadow nicdark_radius  white">vietnamese</span>
                                        {$word.vietnamese}
                                    </p>
                                    {/if}

                                    {if $word.english|count_characters > 0}
                                    <p class="mt-1">
                                        <span class="btn-icon nicdark_bg_green small nicdark_shadow nicdark_radius  white">english</span>
                                        {$word.english}
                                    </p>
                                    {/if}
                                </div>
                            </div>
                        {/foreach}
                    </div>
                {/if}
            </div>
        </div>
    </div>
</section>

