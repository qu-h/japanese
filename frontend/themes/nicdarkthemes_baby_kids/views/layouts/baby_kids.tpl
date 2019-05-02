{*
http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/color-section/
*}
<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en-US"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en-US"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en-US">
<!--<![endif]-->
<head>
    {include file="_head-seo.tpl"}
    <!--[if lt IE 9]>
    <script type="application/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    {assets type='css'}
    {assets type='js'}
</head>
<body>
<div class="nicdark_site">
    <div class="nicdark_site_fullwidth nicdark_site_fullwidth_boxed nicdark_clearfix">
        <div class="nicdark_overlay"></div>
        {include file="../modules/main-menu.html"}
        <div class="nicdark_space100"></div>
        <div class="page type-page status-publish hentry">
            {$_body}

            <div class="nicdark_space20"></div>
            <section class="nicdark_section">
                <div class="nicdark_container nicdark_clearfix">
                    <div class="grid grid_12 percentage">
                        <div class="nicdark_archive1 nicdark_padding010"
                             style="box-sizing: border-box;">
                            <!--link pagination-->
                            <div class="nicdark_focus">
                                <div class="singlelinkpages"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <div class="nicdark_space3 nicdark_bg_gradient"></div>
        {include file="../modules/footer.html"}
    </div>
</div>

</body>
</html>