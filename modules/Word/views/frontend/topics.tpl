<section class="nicdark_section  vc_row wpb_row vc_row-fluid">
    <div class="nicdark_container nicdark_vc nicdark_clearfix">
        <div class="vc_col-sm-12 wpb_column vc_column_container">
            <div class="wpb_wrapper">
                <h1 style="color:;" class=" subtitle left">Word topic</h1>
                <div class="vc_empty_space" style="height: 20px">
                    <span class="vc_empty_space_inner"></span>
                </div>

                <h3 style="color: #a4a4a4;" class=" subtitle left">FOLLOW OUR
                    MOST IMPORTANT NEWS</h3>
                <div class="vc_empty_space" style="height: 20px">
                    <span class="vc_empty_space_inner"></span>
                </div>

                <div class="nicdark_divider  left big ">
                    <span style="background-color: #74cee4;" class="nicdark_radius"></span>
                </div>
                <div class="vc_empty_space" style="height: 20px">
                    <span class="vc_empty_space_inner"></span>
                </div>


            </div>
        </div>
    </div>
</section>
{assign var="images" value=["autumn.jpg", "cook.jpg", "piano.jpg", "post-bubble.jpg", "vegetable-nature.jpg", "xmas.jpg", 'lunch.jpg'] }
{assign var="bg_color" value=['nicdark_bg_blue','nicdark_bg_green','nicdark_bg_violet','nicdark_bg_red','nicdark_bg_yellow','nicdark_bg_orange'] }
{assign var="colors" value=['blue','green','violet','red','yellow','orange'] }

<section class="nicdark_section  vc_row wpb_row vc_row-fluid">
    <div class="nicdark_container nicdark_vc nicdark_clearfix">
        <div class="vc_col-sm-12 wpb_column vc_column_container ">
            <div class="wpb_wrapper">
                <div class="nicdark_masonry_btns" style="display: none" >
                    <div class="nicdark_margin10">
                        <a data-filter="*"
                           class="nicdark_bg_grey2_hover nicdark_transition nicdark_btn nicdark_bg_grey small nicdark_shadow nicdark_radius grey">ALL</a>
                    </div>
                    <div class="nicdark_margin10">
                        <a data-filter=".art"
                           class="nicdark_bg_grey2_hover nicdark_transition nicdark_btn nicdark_bg_grey small nicdark_shadow nicdark_radius grey">Art</a>
                    </div>
                    <div class="nicdark_margin10">
                        <a data-filter=".music"
                           class="nicdark_bg_grey2_hover nicdark_transition nicdark_btn nicdark_bg_grey small nicdark_shadow nicdark_radius grey">Music</a>
                    </div>
                    <div class="nicdark_margin10">
                        <a data-filter=".sport"
                           class="nicdark_bg_grey2_hover nicdark_transition nicdark_btn nicdark_bg_grey small nicdark_shadow nicdark_radius grey">Sport</a>
                    </div>
                    <div class="nicdark_margin10">
                        <a data-filter=".news"
                           class="nicdark_bg_grey2_hover nicdark_transition nicdark_btn nicdark_bg_grey small nicdark_shadow nicdark_radius grey">News</a>
                    </div>
                    <div class="nicdark_margin10">
                        <a data-filter=".educational"
                           class="nicdark_bg_grey2_hover nicdark_transition nicdark_btn nicdark_bg_grey small nicdark_shadow nicdark_radius grey">Educational</a>
                    </div>
                    <div class="nicdark_space10"></div>
                </div>
                <div class="nicdark_masonry_container nicdark_filter" >

                    {if isset($items) && $items|count > 0}
                        {foreach $items AS $topic}
                            {assign var="color" value=$colors|random }
                            <div
                                    style="box-sizing: border-box; position: absolute; left: 0px; top: 0px;"
                                    class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  art  music ">


                                <div  class="nicdark_archive1 nicdark_radius nicdark_shadow nicdark_bg_{$color}">

                                    <a href="{$urlDetail|cat:'/'|cat:$topic.alias}"
                                       class="nicdark_zoom nicdark_btn_icon nicdark_bg_blue nicdark_border_bluedark white medium nicdark_radius_circle nicdark_absolute_left">
                                        <i class="icon-link-outline"></i>
                                    </a>
                                    <div class="nicdark_featured_image">
                                        <img alt="" src="{theme_url file="images/article/"}{$images|random}">
                                    </div>

                                    <div class="nicdark_margin20 nicdark_post_archive">
                                        <h4 class="white">{$topic.name}</h4>
                                        <div class="nicdark_space20"></div>
                                        <div class="nicdark_divider left small">
                                            <span class="nicdark_bg_white nicdark_radius"></span>
                                        </div>
                                        <div class="nicdark_space20"></div>
                                        <p class="white">Lorem ipsum dolor sit amet, consectetur
                                            adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing
                                            elit psum dolor sit amet.</p>
                                        <div class="nicdark_space20"></div>
                                        <a
                                                href="{$urlDetail|cat:'/'|cat:$topic.alias}"
                                                class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                            More</a>
                                    </div>

                                    <i class="icon-pencil-1 right medium nicdark_iconbg {$color}"></i>

                                </div>
                            </div>
                        {/foreach}
                    {/if}




                    <div
                            style="box-sizing: border-box; position: absolute; left: 399px; top: 0px;"
                            class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  music ">


                        <div
                                class="nicdark_archive1 nicdark_bg_green nicdark_radius nicdark_shadow">


                            <div class="nicdark_margin20 nicdark_post_archive">
                                <h4 class="white">SEE OUR NEW DOWNLOAD AREA</h4>
                                <div class="nicdark_space20"></div>
                                <div class="nicdark_divider left small">
                                    <span class="nicdark_bg_white nicdark_radius"></span>
                                </div>
                                <div class="nicdark_space20"></div>
                                <p class="white">Lorem ipsum dolor sit amet, consectetur
                                    adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing
                                    elit psum dolor sit amet. Aenean consectetur fringilla mi in
                                    mollis. Etiam eleifend sollicitudin dignissim.</p>
                                <div class="nicdark_space20"></div>
                                <a
                                        href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/see-our-new-download-area/"
                                        class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                    More</a>
                            </div>

                            <i class="icon-pencil-1 nicdark_iconbg right medium green"></i>

                        </div>


                    </div>


                    <div
                            style="box-sizing: border-box; position: absolute; left: 799px; top: 0px;"
                            class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  art  educational  music ">


                        <div
                                class="nicdark_archive1 nicdark_bg_violet nicdark_radius nicdark_shadow">

                            <a
                                    href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/say-hallo-to-our-teachers/"
                                    class="nicdark_zoom nicdark_btn_icon nicdark_bg_violet nicdark_border_violetdark white medium nicdark_radius_circle nicdark_absolute_left"><i
                                        class="icon-link-outline"></i></a>
                            <div class="nicdark_featured_image">
                                <img alt=""
                                     src="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-content/uploads/2015/01/flower.jpg">
                            </div>

                            <div class="nicdark_margin20 nicdark_post_archive">
                                <h4 class="white">SAY HALLO TO OUR TEACHERS</h4>
                                <div class="nicdark_space20"></div>
                                <div class="nicdark_divider left small">
                                    <span class="nicdark_bg_white nicdark_radius"></span>
                                </div>
                                <div class="nicdark_space20"></div>
                                <p class="white">Aenean consectetur fringilla mi in mollis.
                                    Etiam eleifend sollicitudin dignissim.</p>
                                <div class="nicdark_space20"></div>
                                <a
                                        href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/say-hallo-to-our-teachers/"
                                        class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                    More</a>
                            </div>

                            <i class="icon-pencil-1 nicdark_iconbg right medium violet"></i>

                        </div>


                    </div>


                    <div
                            style="box-sizing: border-box; position: absolute; left: 399px; top: 271px;"
                            class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  sport ">


                        <div
                                class="nicdark_archive1 nicdark_bg_orange nicdark_radius nicdark_shadow">

                            <a
                                    href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/music-activities-for-all/"
                                    class="nicdark_zoom nicdark_btn_icon nicdark_bg_orange nicdark_border_orangedark white medium nicdark_radius_circle nicdark_absolute_left"><i
                                        class="icon-link-outline"></i></a>
                            <div class="nicdark_featured_image">
                                <img alt=""
                                     src="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-content/uploads/2015/01/piano.jpg">
                            </div>

                            <div class="nicdark_margin20 nicdark_post_archive">
                                <h4 class="white">MUSIC ACTIVITIES FOR ALL</h4>
                                <div class="nicdark_space20"></div>
                                <div class="nicdark_divider left small">
                                    <span class="nicdark_bg_white nicdark_radius"></span>
                                </div>
                                <div class="nicdark_space20"></div>
                                <p class="white">Aenean consectetur fringilla mi in mollis.
                                    Etiam eleifend sollicitudin dignissim.</p>
                                <div class="nicdark_space20"></div>
                                <a
                                        href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/music-activities-for-all/"
                                        class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                    More</a>
                            </div>

                            <i class="icon-pencil-1 nicdark_iconbg right medium orange"></i>

                        </div>


                    </div>


                    <div
                            style="box-sizing: border-box; position: absolute; left: 799px; top: 457px;"
                            class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  sport ">


                        <div
                                class="nicdark_archive1 nicdark_bg_red nicdark_radius nicdark_shadow">

                            <a
                                    href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/christmas-party/"
                                    class="nicdark_zoom nicdark_btn_icon nicdark_bg_red nicdark_border_reddark white medium nicdark_radius_circle nicdark_absolute_left"><i
                                        class="icon-link-outline"></i></a>
                            <div class="nicdark_featured_image">
                                <img alt=""
                                     src="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-content/uploads/2015/01/xmas.jpg">
                            </div>

                            <div class="nicdark_margin20 nicdark_post_archive">
                                <h4 class="white">CHRISTMAS PARTY !</h4>
                                <div class="nicdark_space20"></div>
                                <div class="nicdark_divider left small">
                                    <span class="nicdark_bg_white nicdark_radius"></span>
                                </div>
                                <div class="nicdark_space20"></div>
                                <p class="white">Lorem ipsum dolor sit amet, consectetur
                                    adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing
                                    elit psum dolor sit amet.</p>
                                <div class="nicdark_space20"></div>
                                <a
                                        href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/christmas-party/"
                                        class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                    More</a>
                            </div>

                            <i class="icon-pencil-1 nicdark_iconbg right medium red"></i>

                        </div>


                    </div>


                    <div
                            style="box-sizing: border-box; position: absolute; left: 0px; top: 480px;"
                            class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  art ">


                        <div
                                class="nicdark_archive1 nicdark_bg_green nicdark_radius nicdark_shadow">

                            <a
                                    href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/bio-special-meal/"
                                    class="nicdark_zoom nicdark_btn_icon nicdark_bg_green nicdark_border_greendark white medium nicdark_radius_circle nicdark_absolute_left"><i
                                        class="icon-link-outline"></i></a>
                            <div class="nicdark_featured_image">
                                <img alt=""
                                     src="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-content/uploads/2015/01/vegetable-nature.jpg">
                            </div>

                            <div class="nicdark_margin20 nicdark_post_archive">
                                <h4 class="white">BIO SPECIAL MEAL</h4>
                                <div class="nicdark_space20"></div>
                                <div class="nicdark_divider left small">
                                    <span class="nicdark_bg_white nicdark_radius"></span>
                                </div>
                                <div class="nicdark_space20"></div>
                                <p class="white">Lorem ipsum dolor sit amet, consectetur
                                    adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing
                                    elit psum dolor sit amet.</p>
                                <div class="nicdark_space20"></div>
                                <a
                                        href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/bio-special-meal/"
                                        class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                    More</a>
                            </div>

                            <i class="icon-pencil-1 nicdark_iconbg right medium green"></i>

                        </div>


                    </div>


                    <div
                            style="box-sizing: border-box; position: absolute; left: 399px; top: 729px;"
                            class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  music ">


                        <div
                                class="nicdark_archive1 nicdark_bg_yellow nicdark_radius nicdark_shadow">

                            <a
                                    href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/best-cooking-activities/"
                                    class="nicdark_zoom nicdark_btn_icon nicdark_bg_yellow nicdark_border_yellowdark white medium nicdark_radius_circle nicdark_absolute_left"><i
                                        class="icon-link-outline"></i></a>
                            <div class="nicdark_featured_image">
                                <img alt=""
                                     src="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-content/uploads/2015/01/cook.jpg">
                            </div>

                            <div class="nicdark_margin20 nicdark_post_archive">
                                <h4 class="white">BEST COOKING ACTIVITIES !</h4>
                                <div class="nicdark_space20"></div>
                                <div class="nicdark_divider left small">
                                    <span class="nicdark_bg_white nicdark_radius"></span>
                                </div>
                                <div class="nicdark_space20"></div>
                                <p class="white">Lorem ipsum dolor sit amet, consectetur
                                    adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing
                                    elit psum dolor sit amet.</p>
                                <div class="nicdark_space20"></div>
                                <a
                                        href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/best-cooking-activities/"
                                        class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                    More</a>
                            </div>

                            <i class="icon-pencil-1 nicdark_iconbg right medium yellow"></i>

                        </div>


                    </div>


                    <div
                            style="box-sizing: border-box; position: absolute; left: 799px; top: 926px;"
                            class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  news  sport ">


                        <div
                                class="nicdark_archive1 nicdark_bg_blue nicdark_radius nicdark_shadow">

                            <a
                                    href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/end-of-the-school-year/"
                                    class="nicdark_zoom nicdark_btn_icon nicdark_bg_blue nicdark_border_bluedark white medium nicdark_radius_circle nicdark_absolute_left"><i
                                        class="icon-link-outline"></i></a>
                            <div class="nicdark_featured_image">
                                <img alt=""
                                     src="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-content/uploads/2015/01/post-bubble.jpg">
                            </div>

                            <div class="nicdark_margin20 nicdark_post_archive">
                                <h4 class="white">END OF THE SCHOOL YEAR</h4>
                                <div class="nicdark_space20"></div>
                                <div class="nicdark_divider left small">
                                    <span class="nicdark_bg_white nicdark_radius"></span>
                                </div>
                                <div class="nicdark_space20"></div>
                                <p class="white">Lorem ipsum dolor sit amet, consectetur
                                    adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing
                                    elit psum dolor sit amet.</p>
                                <div class="nicdark_space20"></div>
                                <a
                                        href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/end-of-the-school-year/"
                                        class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                    More</a>
                            </div>

                            <i class="icon-pencil-1 nicdark_iconbg right medium blue"></i>

                        </div>


                    </div>


                    <div
                            style="box-sizing: border-box; position: absolute; left: 0px; top: 948px;"
                            class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  educational ">


                        <div
                                class="nicdark_archive1 nicdark_bg_orange nicdark_radius nicdark_shadow">

                            <a
                                    href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/excursion-presentation/"
                                    class="nicdark_zoom nicdark_btn_icon nicdark_bg_orange nicdark_border_orangedark white medium nicdark_radius_circle nicdark_absolute_left"><i
                                        class="icon-link-outline"></i></a>
                            <div class="nicdark_featured_image">
                                <img alt=""
                                     src="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-content/uploads/2015/01/autumn.jpg">
                            </div>

                            <div class="nicdark_margin20 nicdark_post_archive">
                                <h4 class="white">EXCURSION PRESENTATION</h4>
                                <div class="nicdark_space20"></div>
                                <div class="nicdark_divider left small">
                                    <span class="nicdark_bg_white nicdark_radius"></span>
                                </div>
                                <div class="nicdark_space20"></div>
                                <p class="white">Lorem ipsum dolor sit amet, consectetur
                                    adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing
                                    elit psum dolor sit amet.</p>
                                <div class="nicdark_space20"></div>
                                <a
                                        href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/excursion-presentation/"
                                        class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                    More</a>
                            </div>

                            <i class="icon-pencil-1 nicdark_iconbg right medium orange"></i>

                        </div>


                    </div>


                    <div
                            style="box-sizing: border-box; position: absolute; left: 399px; top: 1210px;"
                            class="grid grid_4 percentage nicdark_padding10 nicdark_masonry_item  news ">


                        <div
                                class="nicdark_archive1 nicdark_bg_red nicdark_radius nicdark_shadow">


                            <div class="nicdark_margin20 nicdark_post_archive">
                                <h4 class="white">DOCTOR IN THE SCHOOL</h4>
                                <div class="nicdark_space20"></div>
                                <div class="nicdark_divider left small">
                                    <span class="nicdark_bg_white nicdark_radius"></span>
                                </div>
                                <div class="nicdark_space20"></div>
                                <p class="white">Lorem ipsum dolor sit amet, consectetur
                                    adcing elit Lorem ipsum dolor sit amet, consectetur adip iscing
                                    elit psum dolor sit amet.</p>
                                <div class="nicdark_space20"></div>
                                <a
                                        href="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/doctor-in-the-school/"
                                        class="white nicdark_btn"><i class="icon-doc-text-1 "></i>Read
                                    More</a>
                            </div>

                            <i class="icon-pencil-1 nicdark_iconbg right medium red"></i>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</section>