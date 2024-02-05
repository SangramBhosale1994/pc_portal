<!-- Footer
		============================================= -->
<?php
$footer_page = $pages->get('name=training-footer');
?>
<footer id="footer" class=" border-top-0" style="background-color:#fff !important;">

	<div class="container footer_container">

		<!-- Footer Widgets
				============================================= -->
		<div class="footer-widgets-wrap footer_section">

			<div class="row clearfix footer_row">

				<div class="widget clearfix">
					<div class="row">

						<div class="col-12 col-md-2 col-sm-12 widget_links footer_space_mobile">
							<a target="_blank" href="<?= $pages->get("name=training-header")->header_logo1->description; ?>" class="standard-logo">
								<img src="<?= $pages->get('name=training-header')->header_logo1->httpUrl; ?>" alt="Image" class="footer-logo logo-image-footer"></a>
						</div>
						<div class="col-12 col-md-5 col-sm-12 widget_links footer_discription_menu footer_space_mobile">
							<div class="footer_discription_menu_inner_div">
								<?= $footer_page->text_description; ?>
							</div>
						</div>

						<div class="col-12 col-md-2 col-sm-12 widget_links footer_space_mobile footer_service_menu">
							<div class="footer_service_menu_inner_div">
								<h3><?= $pages->get('name=training-footer')->ally_social_title_color; ?></h3>
								<ul>
									<?php
									foreach ($pages->get('name=training-footer')->title_link_repeater as $menu) {
									?>
										<li><a href="<?= $menu->page_redirection_url ?>"><?= $menu->text_1 ?></a></li>
									<?php
									}
									?>
								</ul>
							</div>
						</div>
						<div class="col-12 col-md-3 col-sm-12 widget_links footer_space_mobile">
							<div class="footer_contact_menu_inner_div">
								<div class="contact_details">
									<h3><?= $footer_page->heading7; ?></h3>
									<div>
										<?php
										if ($footer_page->general_title != "") {
										?>
											<a href="tel:<?= $footer_page->general_title; ?>">
												<i class="icon-phone" aria-hidden="true"></i>
												<?= $footer_page->general_title; ?>
											</a>
										<?php
										}
										?>
									</div>
									<div>
										<?php
										if ($footer_page->heading9 != "") {
										?>
											<a href="tel:<?= $footer_page->heading9; ?>">
												<i class="icon-phone" aria-hidden="true"></i>
												<?= $footer_page->heading9; ?>
											</a>
										<?php
										}
										?>
									</div>
									<div class="pt-1">
										<a href="mailto:<?= $footer_page->text_1; ?>">
											<i class="icon-envelope" aria-hidden="true"></i>
											<?= $footer_page->text_1; ?>
										</a>
									</div>
								</div>
								<div class="social_media_details mt-4">
									<h3><?= $footer_page->heading8; ?></h3>
									<div class="clearfix" data-class-xl="float-end" data-class-lg="float-end" data-class-md="float-end" data-class-sm="" data-class-xs="">
										<a href="<?= $footer_page->heading2; ?>" target="_blank" class="social-icon si-rounded si-small si-colored si-linkedin">
											<i class="icon-linkedin"></i>
											<i class="icon-linkedin"></i>
										</a>

										<a href="<?= $footer_page->heading3; ?>" target="_blank" class="social-icon si-rounded si-small si-colored si-instagram">
											<i class="icon-instagram"></i>
											<i class="icon-instagram"></i>
										</a>

										<a href="<?= $footer_page->heading4; ?>" target="_blank" class="social-icon si-rounded si-small si-colored si-facebook">
											<i class="icon-facebook"></i>
											<i class="icon-facebook"></i>
										</a>

										<a href="<?= $footer_page->heading6; ?>" target="_blank" class="social-icon si-rounded si-small si-colored si-twitter">
											<i class="icon-twitter"></i>
											<i class="icon-twitter"></i>
										</a>

										<a href="<?= $footer_page->heading5; ?>" target="_blank" class="social-icon si-rounded si-small si-colored si-youtube">
											<i class="icon-youtube"></i>
											<i class="icon-youtube"></i>
										</a>

										<a href="<?= $footer_page->linktree_link; ?>" target="_blank" class="social-icon si-rounded si-small si-colored si-link" style="background-color: #28BF7B;">
											<i class="icon-link"></i>
											<i class="icon-link"></i>
										</a>

									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="d-none d-md-block d-lg-none bottommargin-sm"></div>

				<!-- <div class="w-100 d-block d-md-block d-lg-none line"></div> -->



			</div>

		</div><!-- .footer-widgets-wrap end -->

	</div>

	<!-- Copyrights
			============================================= -->
	<div id="copyrights p-0 footer_copyrights" style="background-color:#fff !important;">

		<div class="container text-left pb-2 footer_copyrights_content">

			&copy;thepridecircle.com

		</div>

	</div><!-- #copyrights end -->

</footer>
<!-- #footer end -->
<!-- Go To Top
	============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>



<script src="<?= $rootpath ?>scripts/js_canvas/jquery.js"></script>
<!-- <script src="<?= $rootpath; ?>scripts/jquery.min.js" type="text/javascript"></script> -->
<script src="<?= $rootpath; ?>scripts/popper.min.js"></script>
<script src="<?= $rootpath; ?>scripts/bootstrap.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" integrity="sha512-oL84kLQMEPIS350nZEpvFH1whU0HHGNUDq/X3WBdDAvKP7jn06gHTsCsymsoPYKF/duN8ZxzzvQgOaaZSgcYtQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script> -->


<!-- JavaScripts
	============================================= -->

<!-- <script src="<?= $rootpath ?>scripts/js_canvas/jquery.min.js"></script> -->
<script src="<?= $rootpath ?>scripts/js_canvas/plugins.js"></script>
<!-- <script src="<?= $rootpath ?>scripts/js_canvas/plugins.min.js"></script> -->

<!-- Footer Scripts
	============================================= -->
<script src="<?= $rootpath ?>scripts/js_canvas/functions.js"></script>


<script>
	$(document).ready(function() {
		$("#navbar-toggler").on("click", function() {
			console.log("5");

			if (!$("#navbar-toggler").hasClass("collapsed")) {
				console.log("6");
				// $("#navbar-toggler").addClass("collapsed");
				$("#navbar-toggler").attr("aria-expanded", "false");
				$("#navbarNav").removeClass("show");
				$("#navbarNav").attr("class", "[ navbar-collapse ]");
				if ($("#navbarNav").hasClass("show")) {
					$("#navbarNav").addClass("d-none");
				}
				// $("#navbarNav").addClass("collapsing");

			}
		})
		$(".mob_header_menu_container .menu-link").on("click", function() {

			$("#primary-menu-trigger").trigger("click");
			$(".mob_header_menu_container").css("display", "none");
			$(".svg-trigger").replaceWith('<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>');
		});
	});

	$(document).ready(function() {
		$(".foundation_module_slider .owl-item").css("width", "69rem");
		// $("#btn_read_more").css("margin-top", "5rem");

		// 		$('#btn_read_more').click(function() {
		// 			$('.read_more_text').slideToggle();
		// 			if ($('#btn_read_more').text() == "Read more") {
		// 				$(this).text("Read less")
		// 			} else {
		// 				$(this).text("Read more")
		// 			}
		// 		});
	});



	$(document).ready(function() {
		$("#btn_read_more").click(function() {
			var elem = $("#btn_read_more").text();
			if (elem == "READ MORE") {
				//Stuff to do when btn is in the read more state
				$("#btn_read_more").text("READ LESS");
				$(".read_more_text").slideDown();
			} else {
				//Stuff to do when btn is in the read less state
				$("#btn_read_more").text("READ MORE");
				$(".read_more_text").slideUp();
			}
		});


		$(".module_grid_read_more").click(function() {
			let btn_id = $(this).attr('id');
			console.log("id" + btn_id);
			let id_counter = btn_id.substr(btn_id.lastIndexOf("_") + 1);
			// let id_counter = str.split('_');
			console.log("counter" + id_counter);
			var elem = $(this).text();
			console.log(elem);
			if (elem == "read more") {
				//Stuff to do when btn is in the read more state
				$(this).text("read less");
				$("#module_read_more_text_" + id_counter).slideDown();
			} else {
				//Stuff to do when btn is in the read less state
				$(this).text("read more");
				$("#module_read_more_text_" + id_counter).slideUp();
			}
		});

		$(".intermediate_module_grid_read_more").click(function() {
			let btn_id = $(this).attr('id');
			console.log("id" + btn_id);
			let id_counter = btn_id.substr(btn_id.lastIndexOf("_") + 1);
			console.log("id_counter" + id_counter);
			var elem = $(this).text();
			if (elem == "read more") {
				//Stuff to do when btn is in the read more state
				$(this).text("read less");
				$("#intermediate_module_read_more_text_" + id_counter).slideDown();
			} else {
				//Stuff to do when btn is in the read less state
				$(this).text("read more");
				$("#intermediate_module_read_more_text_" + id_counter).slideUp();
			}
		});

		/**module slider */


	});

	// <script>

	// $(".intermediate_carousel ol li").on("click",function(){
	// 	console.log("4");
	// 	// click: function(event, direction, distance, duration, fingerCount, fingerData) {

	// 	// if (direction == 'left') 
	// 	$(this).carousel('next');
	// 	// if (direction == 'right')
	// 	 $(this).carousel('prev');

	// // },
	// // allowPageScroll:"vertical"

	// });
	//  });
</script>

</body>

</html>