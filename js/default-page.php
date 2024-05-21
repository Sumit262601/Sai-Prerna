<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
	<?php $this->load->view('default/head'); ?>
</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
		<?php
			if(!isset($cookie_info))
			{
				$this->load->view('default/cookies'); 
			}
		?>

		<?php $this->load->view('default/header-menu-dark'); ?>
		
		<!-- Page Title
		============================================= -->
		
		<?php $this->load->view('default/page-banner'); ?>
		
		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap pb-0" style="z-index: 1;">
			
				<!-- Video Sections
				============================================= -->
				<div class="section bg-transparent mt-0 clearfix">
					<div class="container clearfix">
						<div class="row justify-content-center col-mb-50">
							<div class="col-sm-12 col-lg-12">
								<?=$page_info->main_content;?>	
							</div>
						</div>
					</div>
				</div>
				<div class="bg-transparent mt-0 clearfix">
					<div class="container clearfix">
						<div class="line"></div>
					</div>
				</div>
				
				<?php
				
				//print_r($page_info);
				if($page_info->form == 'Y')
				{
					$this->load->view('default/bottom-contact-form');
				}
				?>
				
			</div>
		</section><!-- #content end -->

		<?php 
		$this->load->view('default/footer');
		?>

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="<?=base_url();?>js/jquery.js"></script>
	<script src="<?=base_url();?>js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?=base_url();?>js/functions.js"></script>
	<script src="<?=base_url();?>js/gaurav-js.js"></script>
	
	<?php $this->load->view('default/footerScript'); ?>

	<script>
		jQuery(window).on( 'pluginCarouselReady', function(){
			$('#oc-features').owlCarousel({
				items: 1,
				margin: 60,
			    nav: true,
			    navText: ['<i class="icon-line-arrow-left"></i>','<i class="icon-line-arrow-right"></i>'],
			    dots: false,
			    stagePadding: 30,
			    responsive:{
					768: { items: 2 },
					1200: { stagePadding: 200 }
				},
			});
		});
	</script>

</body>
</html>