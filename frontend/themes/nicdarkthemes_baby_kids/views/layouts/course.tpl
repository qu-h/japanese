{*
http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/color-section/
*}
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en-US"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en-US"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en-US">
<!--<![endif]-->
<head>
	{include file="_head-seo.tpl"}
{assets type='css'}
{assets type='js'}
</head>
<body>
	<div class="nicdark_site">
		<div class="nicdark_site_fullwidth nicdark_site_fullwidth_boxed nicdark_clearfix">
			<div class="nicdark_overlay"></div>
			{include file="../modules/main-menu.html"}
			<div class="nicdark_space160"></div>
			<div class="page type-page status-publish hentry clearfix">
				<section  class="nicdark_section  vc_row wpb_row vc_row-fluid vc_custom_1422455808580">
					<div class="nicdark_container nicdark_vc nicdark_clearfix">
						<div class="vc_col-sm-8 wpb_column vc_column_container">
							<div class="wpb_wrapper">
								{$_body}
							</div>
						</div>

						<div class="vc_col-sm-4 wpb_column vc_column_container">
							<div class="wpb_wrapper">
								{include file="../modules/course-left-col.tpl"}
							</div>
						</div>
					</div>
				</section>


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
			<div class="nicdark_space3 nicdark_bg_gradient mt-3"></div>
			{include file="../modules/footer.html"}
		</div>
	</div>

</body>
</html>