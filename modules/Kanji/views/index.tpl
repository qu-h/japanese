<section class="nicdark_section vc_row wpb_row vc_row-fluid ">
    <div class="nicdark_container nicdark_vc nicdark_clearfix">
        <div class="container">
            <div class="nd_learning_section nd_learning_box_sizing_border_box">
                <form class="" action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="staticEmail" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Level</label>
                                <div class="col-sm-10">
                                    <select class="nicdark_bg_grey2 nicdark_radius nicdark_shadow grey medium" name="post_tag">
                                        <option value="">All Tags</option>
                                        <option value="baby">Baby</option>
                                        <option value="children">Children</option>
                                        <option value="kids">Kids</option>
                                        <option value="kindergarten">Kindergarten</option>
                                        <option value="lessons">Lessons</option>
                                        <option value="primary">Primary</option>
                                        <option value="school">School</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            {moduleRun m='pagination'}

        </div>
        <div class="container">
            <div class="row">
                {if $items|count > 0}
                    {foreach $items AS $ite}
                        <a href="{site_url uri="kanji/"|cat:$ite.ascii}" class="col-md-2 character red">
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
    </div>
</section>