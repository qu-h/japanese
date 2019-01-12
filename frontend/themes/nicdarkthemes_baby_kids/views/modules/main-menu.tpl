<div class="nicdark_section nicdark_navigation nicdark_upper_level2 slowdown">
	<!--decide fullwidth or boxed header-->
	<div class="nicdark_menu_boxed nicdark_menu_fullwidth_boxed">
		<!--start top header-->
		<!--start before navigation-->
		<div
			class="nicdark_section nicdark_bg_greydark nicdark_displaynone_responsive">
			<div class="nicdark_container nicdark_clearfix">

				<div class="grid grid_6">
					<div class="nicdark_focus">
						<h6 class="white">
							<i class="icon-calendar-outlilne"></i>&nbsp;&nbsp;
							<a class="white title" href="javascript:void(0)">{lang text="Our Events"}</a>
							<span class="grey nicdark_marginright10 nicdark_marginleft10">&middot;</span>
							
							<i class="icon-pencil-1"></i>&nbsp;&nbsp; <a class="white title" href="#">{lang text="News"}</a>
							
							{if isset($config.phone)}
							<span class="grey nicdark_marginright10 nicdark_marginleft10">&middot;</span>
							<a href="tel:{$config.phone}" class="white" ><i class="icon-phone-outline"></i>&nbsp;&nbsp;{$config.phone}</a>
							{/if}
						</h6>
					</div>
				</div>
				<div class="grid grid_6 right">
					<div class="nicdark_focus right">
						<h6 class="white">
							<i class="icon-contacts"></i>&nbsp;&nbsp;
							<a class="white title" href="/contact">{lang txt="Contacts"}</a>
							<span class="grey nicdark_marginright10 nicdark_marginleft10">&middot;</span>
							<i class="icon-plus-outline"></i>&nbsp;&nbsp;
							<a class="white title" href="javascript:void(0)">{lang txt="Register"}</a>
							<span class="grey nicdark_marginright10 nicdark_marginleft10">&middot;</span>
							<i class="icon-lock-1"></i>&nbsp;&nbsp;
							<a class="white title" href="/login">{lang txt="Login"}</a>
						</h6>
					</div>
				</div>

			</div>
		</div>
		<!--end before navigation-->





		<!--end top header-->

		<!--decide gradient or not-->
		<div class="nicdark_space3 nicdark_bg_gradient"></div>
		<!--start header-->
		<div
			class="nicdark_bg_grey nicdark_section nicdark_shadow nicdark_radius_bottom fade-down animated fadeInDown">

			<!--start container-->
			<div class="nicdark_container nicdark_clearfix">

				<div class="grid grid_12 percentage">

					<div class="nicdark_space20"></div>

					<!--logo-->
					<div class="nicdark_logo nicdark_marginleft10">
						<a href=""><img alt="{lang text="SiteName"}" src="{theme_url}images/logo.png"></a>
					</div>
					<!--end logo-->

					<!--start btn left/right sidebar open-->
					<a
						class="nicdark_btn_icon nicdark_zoom nicdark_bg_orange_hover nicdark_right_sidebar_btn_open nicdark_marginright10 nicdark_bg_orange extrasmall nicdark_radius white right"><i
						class="icon-basket-1"></i></a> <a
						class="nicdark_btn_icon nicdark_zoom nicdark_bg_orange_hover nicdark_left_sidebar_btn_open nicdark_marginright20 nicdark_bg_orange extrasmall nicdark_radius white right"><i
						class="icon-lightbulb-1"></i></a>
					<!--end btn left/right sidebar open-->

					<div class="menu-menu-baby-kids-container">
						<ul id="menu-menu-baby-kids"
							class="menu sf-js-enabled sf-arrows l_tinynav1">
							
							
							{mainmenu_items}
						
						</ul>
						{*
						<select id="tinynav1" class="tinynav tinynav1"><option>MENU</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/">HOME</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/advanced-search/">-
								With Search</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/">-
								Home Default</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/color-section/">-
								Color Sections</option>
							<option value="#">PAGES</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/prices/">-
								Prices</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/shop/">-
								Shop</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/teachers/">-
								Teachers</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/teachers/">-
								- All Teachers</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/single-teacher/">-
								- Single Teacher</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/excursions/">-
								Excursions</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/excursions/">-
								- All Excursions</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/excursions/a-day-at-the-zoo/">-
								- Single Excursion</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/course/">-
								Courses</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/course/">-
								- Search</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/courses/">-
								- Archive Courses</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/courses/informatic-course/">-
								- Single Course</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/event/">-
								Events</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/event/">-
								- Search</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/events/">-
								- Archive Events</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/events/christmas-party-2/">-
								- Single Event</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/single-class/">-
								TimeTable</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/faq/">-
								Faq</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/course/">COURSES</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/course/">-
								Search</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/courses/">-
								Archive Courses</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/courses/informatic-course/">-
								Single Course</option>
							<option value="#">MEGA MENU</option>
							<option value="#">- COURSES</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/course/">-
								- Search</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/courses/informatic-course/">-
								- Single Course</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/courses/">-
								- Archive Courses</option>
							<option value="#">- EVENTS</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/event/">-
								- Search</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/events/christmas-party-2/">-
								- Single Event</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/events/">-
								- Archive Events</option>
							<option value="#">- EXCURSIONS</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/excursions/">-
								- Search</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/excursions/a-day-at-the-zoo/">-
								- Single Excursion</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/excursions/">-
								- Archive Excursions</option>
							<option value="#">- CLASSES</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/teachers/">-
								- Teachers</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/prices/">-
								- Prices</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/single-teacher/">-
								- Single Teacher</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/blog/">BLOG</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/blog/">-
								Masonry Layout</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/tag/educational/">-
								Standard Layout</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/say-hallo-to-our-teachers/">-
								Post Right Sidebar</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/christmas-party/">-
								Post Left Sidebar</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/excursion-presentation/">-
								Post Full Width</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/event/">EVENTS</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/event/">-
								Search</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/events/">-
								Archive Events</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/events/christmas-party-2/">-
								Single Event</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/shop/">SHOP</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/shop/">-
								Shop</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/product/computer-course/">-
								Product</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/cart/">-
								Cart</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/checkout/">-
								Checkout</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/my-account/">-
								My Account</option>
							<option
								value="http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/contact-1/">CONTACTS</option></select>

							*}
					</div>

					<div class="nicdark_space20"></div>

				</div>

			</div>
			<!--end container-->

		</div>
		<!--end header-->
	</div>

</div>