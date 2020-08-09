<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Toko Cahaya Agung ALuminium</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSS
================================================== -->
	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/css/prettyPhoto.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/css/flexslider.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/css/custom-styles.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/css/floating-wpp.css" />
	<!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="css/style-ie.css"/>
<![endif]-->

	<!-- Favicons
================================================== -->
	<link rel="shortcut icon" href="<?= base_url() ?>assets_user/img//gallery/caa3.svg">
	<link rel="apple-touch-icon" href="<?= base_url() ?>assets_user/img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url() ?>assets_user/img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url() ?>assets_user/img/apple-touch-icon-114x114.png">

	<!-- JS
================================================== -->
	<script src="https://code.jquery.com/jquery-1.8.3.min.js"></script>
	<script src="<?= base_url() ?>assets_user/js/bootstrap.js"></script>
	<script src="<?= base_url() ?>assets_user/js/jquery.prettyPhoto.js"></script>
	<script src="<?= base_url() ?>assets_user/js/jquery.flexslider.js"></script>
	<script src="<?= base_url() ?>assets_user/js/jquery.custom.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			$("#btn-blog-next").click(function() {
				$('#blogCarousel').carousel('next')
			});
			$("#btn-blog-prev").click(function() {
				$('#blogCarousel').carousel('prev')
			});

			$("#btn-client-next").click(function() {
				$('#clientCarousel').carousel('next')
			});
			$("#btn-client-prev").click(function() {
				$('#clientCarousel').carousel('prev')
			});

		});

		$(window).load(function() {

			$('.flexslider').flexslider({
				animation: "slide",
				slideshow: true,
				start: function(slider) {
					$('body').removeClass('loading');
				}
			});
		});
	</script>

</head>

<body class="home">
	<!-- Color Bars (above header)-->
	<div class="color-bar-1"></div>
	<div class="color-bar-2 color-bg"></div>

	<div class="container">

		<div class="row header">
			<!-- Begin Header -->

			<!-- Logo
        ================================================== -->
			<div class="span5 logo">
				<h1>Toko Cahaya Agung Aluminium</h1>
			</div>

			<!-- Main Navigation
        ================================================== -->
			<div class="span7 navigation">
				<div class="navbar hidden-phone">

					<ul class="nav">
						<li class="active">
							<a class="dropdown-toggle" href="<?= site_url('home') ?>">Home</a>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="page-full-width.htm">Produk <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="page-full-width.htm">Semua produk</a></li>
								<li><a href="page-right-sidebar.htm">Lemari</a></li>
								<li><a href="page-left-sidebar.htm">Meja</a></li>
								<li><a href="page-left-sidebar.htm">Steling Jualan</a></li>
								<li><a href="page-left-sidebar.htm">Booth</a></li>
								<li><a href="page-double-sidebar.htm">Dan lain-lain</a></li>
							</ul>
						</li>
						<li><a href="page-contact.htm">Keranjang</a></li>
						<li><a href="<?= site_url('home/kontak') ?>">Kontak</a></li>
						<li><a href="page-contact.htm">Masuk</a></li>
					</ul>

				</div>

				<!-- Mobile Nav
            ================================================== -->
				<form action="#" id="mobile-nav" class="visible-phone">
					<div class="mobile-nav-select">
						<select onchange="window.open(this.options[this.selectedIndex].value,'_top')">
							<option value="">Navigate...</option>
							<option value="index.htm">Home</option>
							<option value="page-full-width.htm">Produk</option>
							<option value="page-full-width.htm">- Semua produk</option>
							<option value="page-right-sidebar.htm">- Lemari</option>
							<option value="page-right-sidebar.htm">- Meja</option>
							<option value="page-right-sidebar.htm">- Steling Jualan</option>
							<option value="page-right-sidebar.htm">- Booth</option>
							<option value="page-double-sidebar.htm">- Dan lain-lain</option>
							<option value="gallery-4col.htm">Keranjang</option>
							<option value="page-contact.htm">Kontak</option>
							<option value="gallery-4col.htm">Masuk</option>
						</select>
					</div>
				</form>

			</div>

		</div><!-- End Header -->