<section id="info-row-contact" class="nicdark_section  vc_row wpb_row vc_row-fluid ">
    <div class="nicdark_container nicdark_vc nicdark_clearfix">
        <div class="vc_col-sm-4 wpb_column vc_column_container">
            <div class="wpb_wrapper">
                <section class="nicdark_section  vc_row wpb_row vc_inner vc_row-fluid">
                    <div class="vc_col-sm-12 nicdark_radius nicdark_shadow nicdark_bg_grey  wpb_column vc_column_container vc_custom_1421226288661">
                        <div class="wpb_wrapper">
                            <div class=" nicdark_archive1 nicdark_relative nicdark_margin20">

                                <a target="" href=""
                                   class="nicdark_btn_icon nicdark_bg_yellow extrabig nicdark_radius_circle white nicdark_absolute nicdark_shadow"><i
                                            class="icon-location-outline"></i></a>

                                <div class="nicdark_activity nicdark_marginleft100">
                                    <h4>{"New Word"|trans}</h4>
                                    <div class="nicdark_space10"></div>
                                    <p style="font-size: 35px; line-height: 50px;">{$word->kanji}</p>

                                </div>
                            </div>


                        </div>
                    </div>
                </section>

            </div>
        </div>

        <div class="vc_col-sm-8 wpb_column vc_column_container">
            <div class="wpb_wrapper">
                <div class="vc_wp_text wpb_content_element">
                    <div class="widget widget_text"><h2 class="widgettitle">{"Add new Word"|trans}</h2>
                        <div class="textwidget">
                            <div class="wpcf7" id="wpcf7-f875-p244-o1" lang="en-US" dir="ltr">
                                <div class="screen-reader-response"></div>
                                <form name="" action="#"
                                      method="post" class="wpcf7-form" novalidate="novalidate">

                                    <p><input type="text"
                                                      name="hiragana"
                                                      value="{$word->hiragana}"
                                                      aria-required="true"
                                                      aria-invalid="false">
                                    </p>
                                    <p><span class="wpcf7-form-control-wrap your-email"><input type="email"
                                                                                               name="your-email"
                                                                                               value="EMAIL" size="40"
                                                                                               class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email"
                                                                                               aria-required="true"
                                                                                               aria-invalid="false"></span>
                                    </p>
                                    <p><span class="wpcf7-form-control-wrap message"><textarea name="message" cols="40"
                                                                                               rows="5"
                                                                                               class="wpcf7-form-control wpcf7-textarea"
                                                                                               aria-invalid="false"
                                                                                               placeholder="MESSAGE"></textarea></span>
                                    </p>
                                    <p>
                                        <input type="submit" value="Send"
                                              class="wpcf7-form-control wpcf7-submit nicdark_bg_orange nicdark_shadow nicdark_zoom">
                                    </p>
                                    <iframe src="https://j-dict.com/?keyword={$word->kanji}" style="height: 500px; width: 800px;"></iframe>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>