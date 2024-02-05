<?php  include 'includes/rise2022_header.php'; ?>
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		
		
		<style>
			.heading-block::after {
				content: '';
				display: block;
				margin-top: 30px;
				width: 40px;
				border-top: none !important;
			}
		</style>

		<!-- content
		============================================= -->
		<section id="content">
			<!-- Section 
				============================================= -->
				<div id="" class="page-section pt-0 pb-0 clearfix" >
					<div class="col-mb-40 extra-space-remove">
						    <div class="container mt-5 mb-5">
						        <div class="heading-block mb-4">
								<h3 style="color:#003;" class="heading-block title_new  center border-bottom-0 mb-0"><?=$page->title;?></h3>
						        </div>
                                 <div class="internship-text ul-tag tertiary-font mb-0 ul-leftmg "><?=$page->text_description;?></div>
							</div>
			        </div>
				</div><!-- #section- end -->
		</section><!-- #content end -->


		<style>
			/* social media icons alignment in a footer */
			.social-media-row-alignment {
				justify-content: flex-end !important;
			}
			@media (max-width: 767px){
				.social-media-row-alignment {
					justify-content: center !important;
					}		
			}
		</style>
		
		
	<?php  include 'includes/rise2022_footer.php'; ?>