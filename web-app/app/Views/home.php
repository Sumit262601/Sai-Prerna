<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700|Roboto:300,400,500,700|Playfair+Display&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?= site_url('css'); ?>/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?= site_url('css'); ?>/style.css" type="text/css" />
	<link rel="stylesheet" href="<?= site_url('css'); ?>/swiper.css" type="text/css" />

	<!-- One Page Module Specific Stylesheet -->
	<link rel="stylesheet" href="css/onepage.css" type="text/css" />
	<!-- / -->

	<link rel="stylesheet" href="<?= site_url('css'); ?>/dark.css" type="text/css" />
	<link rel="stylesheet" href="<?= site_url('css'); ?>/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?= site_url('css'); ?>/css/et-line.css" type="text/css" />
	<link rel="stylesheet" href="<?= site_url('css'); ?>/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?= site_url('css'); ?>/magnific-popup.css" type="text/css" />
	<link rel="stylesheet" href="<?= site_url('css'); ?>/css/fonts.css" type="text/css" />
	<link rel="stylesheet" href="<?= site_url('css'); ?>/custom.css" type="text/css" />

	<meta name="viewport" content="width=device-width, initial-scale=1" />


	<!-- Document Title
	============================================= -->
	<title>Sai-Prerna</title>
	<style>
		#oc-images img {
			width: 220px;
		}

		.font-secondary {
			font-family: 'Playfair Display', serif !important;
		}

		.slider-element .slider-arrows {
			position: absolute;
			cursor: pointer;
			z-index: 10;
			left: calc(50% + 30px);
			margin: 0;
			transform: translate(-50%, -50%);
			background-color: rgba(255,255,255,1);
			width: 52px;
			height: 52px;
			border: 0;
			border-radius: 50%;
		}

		.slider-element .slider-arrows.slider-arrow-left {
			left: calc(50% - 30px);
		}

		.slider-element .slider-arrows:hover {
			background-color: #FFF !important;
		}

		.slider-element .slider-arrow-left i,
		.slider-element .slider-arrow-right i {
			color: #111;
			text-shadow: none;
		}

		.slider-element .swiper-button-disabled,
		.slider-element .swiper-button-disabled:hover {
			opacity: .7;
			background-color: rgba(255,255,255,0.5) !important;
			cursor: default;
		}

		.owl-stage-outer:before {
			content: '';
			position: fixed;
			top: 0;
			right: 0;
			width: 100px;
			height: 100%;
			background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
			z-index: 1;
		}
	</style>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
		<?php include('default/header.php');  ?>

		<!-- ===================== Slider ======================== -->
		<section id="slider" class="slider-element swiper_wrapper border-top border-light min-vh-100" data-grab="false">
			<div class="slider-inner">
				<div class="swiper-container swiper-parent">
					<div class="swiper-wrapper">

					<?php $i=1; foreach($slider as $sld) { ?>
						<!-- Slide 1 -->
						<div class="swiper-slide" data-index="rs-<?=$i;?>">
							<div class="row justify-content-center align-items-center g-0 h-100">

								<div class="col-md-6 h-100" data-animate="fadeInLeft fast" style="background: url('<?= site_url('images');?>/<?=$image_detail[$sld->img]?>') center /cover; min-height: 360px;"></div>
								<div class="col-md-6 mt-5 mt-md-0">
									<div class="px-5">
										<div class="heading-block border-bottom-0 mb-4">
											<h2 class="fw-bold ls0 nott font-secondary" data-animate="fadeInUp"><?= $sld->top_line?></h2>
										</div>
										<p data-animate="fadeInUp"><?= $sld->bottom_line ?></p>
										<div class="bottommargin-sm d-flex align-items-center" data-animate="fadeInUp">
											<a href="#" class="button button-large button-circle button-dark nott">View More</a>
										</div>
									</div>
									<div class="ms-5 mt-4" data-animate="fadeInUp">
										<div id="oc-images" class="owl-carousel image-carousel carousel-widget" data-margin="20"  data-autowidth="true" data-nav="true" data-pagi="false" data-items-xs="2" data-items-sm="2" data-items-lg="3" data-items-xl="3">
											<?php foreach($slides as $sdl) { ?>

											<a href="#"><img src="<?= site_url('images');?>/<?=$image_detail[$sdl->img]?>" alt="<?= $sdl->alt; ?>" style="height: 300px; width: 15rem;"></a>

											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<div class="swiper-slide-bg" style="background: linear-gradient(to right, rgba(255,255,255,0.75), rgba(255,255,255,1)), url('images/homeslider/bg.jpg') center center /cover;">
							</div>
						</div>
					<?php $i++; } ?>

					</div>
				</div>
			</div>
		</section>

		<!-- ===================== About Us ======================== -->
		<section id="content">
			<div class="content-wrap py-0">
				<div id="section-about" class="center page-section">
					<div class="container clearfix">
						<?php foreach($about as $abt) { ?>
						<div class="clear"></div>
						<div class="row">
							<div class="col-md-6 mt-5 pt-5 px-5">
								<h2 class="mx-auto bottommargin font-body fw-bold ls0 nott font-secondary" style="max-width: 700px; font-size: 40px;"><?= $abt->heading; ?></h2>
								<p><?= $abt->description; ?></p>
							</div>
							<div class="col-md-6 mb-0">
								<div class="team">
									<div class="team-image">
										<img src="<?= site_url('images');?>/<?= $image_detail[$abt->img]?>" style="height: 650px; width: 700px; border-radius: 20px;" alt="John Doe">
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>


				<div id="section-gallery" class="page-section pt-0">
					<div class="section m-0">
						<div class="container clearfix">
							<div class="mx-auto center" style="max-width: 900px;">
								<h1>Gallery</h1>
							</div>
						</div>
					</div>

					<!-- ===================== Portfolio Items ======================== -->
					<div class="portfolio grid-container row g-0">
					
					<?php foreach($gallerys as $glry) { ?>

						<article class="portfolio-item col-lg-6 col-md-4 col-sm-6 col-12 wide">
							<div class="grid-inner">
								<div class="portfolio-image">
									<a href="#">
										<img src="<?= site_url('images');?>/<?=$image_detail[$glry->img]?>" alt="<?= $glry->alt; ?>">
									</a>
									<div class="bg-overlay">
										<div class="bg-overlay-content flex-column" data-hover-animate="fadeIn">
											<div class="portfolio-desc p-0 center" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350">
												<h3><a href="#"><?= $glry->detail;  ?></a></h3>
											</div>
										</div>
										<div class="bg-overlay-bg" data-hover-animate="fadeIn"></div>
									</div>
								</div>
							</div>
						</article>
					<?php } ?>
					</div>
					<!-- #portfolio end -->

				</div>

				<div id="section-services" class="page-section pt-0">
					<div class="section m-0">
						<div class="container clearfix">
							<div class="mx-auto center" style="max-width: 900px;">
								<h1>Services</h1>
							</div>
						</div>
					</div>

					<div class="row align-items-stretch">
						<div class="col-lg-12">
							<div class="row align-items-stretch grid-border clearfix">
								<?php foreach($services as $srv) {  ?>
									<div class="col-lg-4 col-md-8 col-padding">
										<div class="feature-box fbox-center fbox-dark fbox-plain">
											<img src="<?= site_url('images');?>/<?=$image_detail[$srv->img]?>" alt="Service" style=" height: 300px; border-radius: 10px">
											<div class="fbox-content fbox-content-sm">
												<h2><?= $srv->name; ?></h2>
												<p><?= $srv->description; ?></p>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

					<div class="section dark m-0"></div>
					<div class="section parallax m-0 dark" style="background-image: url('images/page/bg-slogan.jpg'); padding: 200px 0;" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position: 0px -100px;">
						<div class="container clearfix">
							<div class="row justify-content-end">
								<div class="col-md-7">
									<div class="fslider testimonial testimonial-full bg-transparent border-0 shadow-none p-0" data-arrows="false">
										<div class="flexslider">
											<div class="slider-wrap">
												<div class="slide">
													<div class="testi-content">
														<p>To keep the heart unwrinkled — to be hopeful, kindly, cheerful, reverent — that is to triumph over old age.</p>
														<div class="testi-meta">
														 Thomas Bailey Aldrich
														</div>
													</div>
												</div>
												<div class="slide">
													<div class="testi-content">
														<p>Protecting the elderly, keeping them alive is keeping our memories alive in real life; it is to keep our past literally in today's time!</p>
														<div class="testi-meta">
															Mehmet Murat ildan
														</div>
													</div>
												</div>
												<div class="slide">
													<div class="testi-content">
														<p>Gray hair is the glory of a long life.</p>
														<div class="testi-meta">
														Lailah Gifty Akita
														</div>
													</div>
												</div>
												<div class="slide">
													<div class="testi-content">
														<p>A beautiful old person is a work of art, like any beautiful young person.</p>
														<div class="testi-meta">
															George Willliam Curtis
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<?php include('form/pagecontact.php'); ?>
		
		<?php include('default/footer_script.php'); ?>
		<!-- #footer end -->

	</div>
	<!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="<?=site_url('js/jquery.js'); ?>"></script>
	<script src="<?= site_url('js/plugins.min.js'); ?>"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?= site_url('js/functions.js'); ?>"></script>

</body>
</html>