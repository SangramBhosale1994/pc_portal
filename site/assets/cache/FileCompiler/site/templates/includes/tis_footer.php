<!-- Footer
		============================================= -->
		<footer id="footer" class="dark mt-5" style="background:#020202;">
			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row col-mb-30 justify-content-center">

						

						<div class="order-lg-1 col-lg-3 ">
						    <div class="d-flex justify-content-center justify-content-lg-start">
										<?php
											if($pages->get("name=tis2022-footer")->heading2!=""){
										?>
							            <a target="_blank" href="<?=$pages->get("name=tis2022-footer")->heading2;?>" class="social-icon si-small si-borderless si-linkedin">
											<i class="white-color icon-linkedin" style="color: #fff;font-size: 1rem;"></i>
											<i class="icon-linkedin" style="font-size: 1rem;"></i>
										</a>
										<?php
											}
											?>

										<?php
											if($pages->get("name=tis2022-footer")->heading3!=""){
										?>
										<a target="_blank" href="<?=$pages->get("name=tis2022-footer")->heading3;?>" class="social-icon si-small si-borderless si-instagram">
											<i class="white-color icon-instagram" style="color: #fff;font-size: 1rem;"></i>
											<i class="icon-instagram" style="font-size: 1rem;"></i>
										</a>
										<?php
											}
											?>
										
										<?php
											if($pages->get("name=tis2022-footer")->heading4!=""){
										?>
		                                <a target="_blank" href="<?=$pages->get("name=tis2022-footer")->heading4;?>" class="social-icon si-small si-borderless si-facebook">
											<i class="white-color icon-facebook" style="color: #fff;font-size: 1rem;"></i>
											<i class="icon-facebook" style="font-size: 1rem;"></i>
										</a>
										<?php
											}
											?>

										<?php
											if($pages->get("name=tis2022-footer")->heading5!=""){
										?>
		                                <a target="_blank" href="<?=$pages->get("name=tis2022-footer")->heading5;?>" class="social-icon si-small si-borderless si-gplus">
											<i class="white-color icon-line2-social-youtube" style="color: #fff;font-size: 1rem;"></i>
											<i class="icon-line2-social-youtube" style="font-size: 1rem;"></i>
										</a>
										<?php
											}
											?>

										<?php
											if($pages->get("name=tis2022-footer")->heading6!=""){
										?>
										<a target="_blank" href="<?=$pages->get("name=tis2022-footer")->heading6;?>" class="social-icon si-small si-borderless si-twitter">
											<i class="icon-twitter" style="color: #fff;font-size: 1rem;"></i>
											<i class="icon-twitter" style="font-size: 1rem;"></i>
										</a>
										<?php
											}
											?>
										
										<?php
											if($pages->get("name=tis2022-footer")->heading7!=""){
										?>
										<a target="_blank"  href="<?=$pages->get("name=tis2022-footer")->heading7;?>" class="social-icon si-small si-borderless  si-tripadvisor">
											<i class="white-color icon-tree" style="color: #fff;font-size: 1rem;"></i>
											<i class="icon-tree" style="font-size: 1rem;"></i>
										</a>
										<?php
											}
											?>
							</div>
						</div>

						<div class="order-lg-2 copyright-links col-lg-4 text-center text-lg-right">
						<?php
							if($pages->get("name=tis2022-footer")->ally_social_title_color!=""){
							?>
							<a href="tel:<?=$pages->get("name=tis2022-footer")->ally_social_title_color;?>"><i style="margin-right: 0.3rem" class="icon-whatsapp icon-line-phone-call">&nbsp;</i><i style="margin-right: 0.3rem" class="icon-whatsapp"></i><?=$pages->get("name=tis2022-footer")->ally_social_title_color;?></a>
							<?php
							}
							?>
								<br>
							<?php
								if($pages->get("name=tis2022-footer")->heading8!=""){
							?>
							<a href="mailto:<?=$pages->get("name=tis2022-footer")->heading8;?>"><i class="icon-envelope2" style="margin-right: 0.3rem"></i><?=$pages->get("name=tis2022-footer")->heading8;?></a>
							<?php
								}
								?>
						</div>

						<div class="order-lg-0 col-lg-5 text-center text-lg-left">
						<div class="copyright-links"><a href="<?=$pages->get("name=tis-privacy-policy")->httpUrl;?>" ><?=$pages->get("name=tis-privacy-policy")->title;?></a> / <a href="<?=$pages->get("name=tis_disclaimer")->httpUrl;?>"><?=$pages->get("name=tis_disclaimer")->title;?></a></div>
						Copyrights &copy; <?php $year = date("Y"); echo $year;?> All Rights Reserved by Pride Circle.<br>
						</div>

					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->
<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="<?=$rootpath?>scripts/js_canvas/jquery.js"></script>
	<script src="<?=$rootpath?>scripts/js_canvas/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?=$rootpath?>scripts/js_canvas/functions.js"></script>

</body>
</html>


