

<section id="main-pack-row-price" class="nicdark_section  vc_row wpb_row vc_row-fluid vc_custom_1422883163860">
    <div class="nicdark_container nicdark_vc nicdark_clearfix">
        <div class="row">
            <div class="col-md-6 offset-md-2">
                <div class="kanji-char">{$kanji->word}</div>
            </div>
            <div class="col-md-4">
                {btn_icon title="level" text=$kanji->level icon="emo-thumbsup"}
                {btn_icon title="stroke" text=$kanji->stroke icon="flow-merge"}
            </div>
        </div>
        <div class="row">
            {block_archive title="y-nghia" content=$kanji->vietnamese col=3}
            {block_archive title="explanation" content=$kanji->explanation col=3}
            {block_archive_button title="onyomi" content=$kanji->onyomi col=3}
            {block_archive_button title="kunyomi" content=$kanji->kunyomi col=3}



        </div>
        <div class="row">
            {if $kanji->parts|count > 0}
                <div class="col-md-6 ">
                    {block_archive_list title="bo phan cau thanh" content=$kanji->parts col=3}
                </div>
            {/if}

            {if $kanji->example|count > 0}
                <div class="col-md-6 ">
                    {block_archive_list title="bo phan cau thanh" content=$kanji->example col=3}
                </div>
            {/if}

        </div>
    </div>
</section>