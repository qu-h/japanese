

<section class="nicdark_section  vc_row wpb_row vc_row-fluid ">
    <div class="nicdark_container nicdark_vc nicdark_clearfix">
        <div class="row">
            <div class="col-md-6 offset-md-2">
                <div id="kanjiViewer" class="kanji-char" data-value="{$kanji->word}"></div>
            </div>

            <div class="col-md-4 wpb_column vc_column_container">
                <div class=" nicdark_archive1 nicdark_relative nicdark_shadow nicdark_bg_grey pa-10">
                    <div class="nicdark_activity">

                        <h4 class="pa-b-20 f-upcase">
                            {btn_text text=$kanji->word  bg="red"}
                             : {$kanji->chinese}
                        </h4>
                        <p>{$kanji->vietnamese}</p>
                        <div class="nicdark_space5"></div>
                        {btn_icon title="level" text=$kanji->level icon="emo-thumbsup" bg="green"}
                        {btn_icon title="stroke" text=$kanji->stroke icon="flow-merge" bg='yellow'}

                    </div>
                </div>
                {if !empty($kanji->remember)}
                    <div class="nicdark_space10"></div>
                    <div class=" nicdark_archive1 nicdark_relative nicdark_shadow nicdark_bg_grey pa-10">
                        <div class="nicdark_activity">

                            <h4 class="pa-b-20 f-upcase">{"quick-remember"|trans}</h4>
                            <img src="{$kanji->remember['img']}">
                            <div class="nicdark_space5"></div>
                            <p>{$kanji->remember['text']}</p>


                        </div>
                    </div>
                {/if}
                <div class="nicdark_space10"></div>
                {block_archive_button title="onyomi" content=$kanji->onyomi}
                <div class="nicdark_space10"></div>
                {block_archive_button title="kunyomi" content=$kanji->kunyomi}

            </div>
            <div class="nicdark_space10"></div>

        </div>
        {if $kanji->explanation|count_characters > 0}
        <div class="row">
            {block_archive title="explanation" content=$kanji->explanation col=12}
            <div class="nicdark_space10"></div>
        </div>
        {/if}

        <div class="row">

            {if $kanji->parts|count > 0}
                <div class="col-md-4 ">
                    {block_archive_list title="bo phan cau thanh" content=$kanji->parts col=3}
                </div>
            {/if}

            {if $kanji->example|count > 0}
                <div class="col-md-8 ">
                    {block_archive_group_items title="example" content=$kanji->example col=3}
                </div>
            {/if}

        </div>
    </div>
</section>