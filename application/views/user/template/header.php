<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Fashi Template">
	<meta name="keywords" content="Fashi, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Toko Cahaya Agung Aluminium</title>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

	<!-- Css Styles -->
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/copy/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/copy/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/copy/css/themify-icons.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/copy/css/elegant-icons.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/copy/css/owl.carousel.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/copy/css/nice-select.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/copy/css/jquery-ui.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/copy/css/slicknav.min.css" type="text/css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_user/copy/css/style.css" type="text/css">
</head>

<!-- Latest Blog Section End -->
<!-- Header Section Begin -->
<header class="header-section">
	<div class="container">
		<div class="inner-header">
			<div class="row">
				<div class="col-lg-7 col-md-7">
					<div class="logo">

						<h3 style="font-weight: bolder;">TOKO CAHAYA AGUNG ALUMINIUM</h3>

					</div>
				</div>
				<div class="col-lg-2 col-md-2">
				</div>
				<div class="col-lg-3 text-right col-md-3">
					<ul class="nav-right">

					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="nav-item">
		<div class="container">
			<div class="nav-depart">
				<!-- <div class="depart-btn">
					<i class="ti-menu"></i>
					<span>All departments</span>
					<ul class="depart-hover">
						<li class="active"><a href="#">Women’s Clothing</a></li>
						<li><a href="#">Men’s Clothing</a></li>
						<li><a href="#">Underwear</a></li>
						<li><a href="#">Kid's Clothing</a></li>
						<li><a href="#">Brand Fashion</a></li>
						<li><a href="#">Accessories/Shoes</a></li>
						<li><a href="#">Luxury Brands</a></li>
						<li><a href="#">Brand Outdoor Apparel</a></li>
					</ul>
				</div> -->
			</div>
			<nav class="nav-menu mobile-menu">
				<ul>
					<li class="active"><a href="<?= site_url('home') ?>">Home</a></li>

					<li><a href="<?= site_url('home/produk') ?>">Produk</a>
						<!-- <ul class="dropdown">
							<li><a href="#">Men's</a></li>
							<li><a href="#">Women's</a></li>
							<li><a href="#">Kid's</a></li>
						</ul> -->
					</li>
					<li><a href="<?= site_url('home/kontak') ?>">Kontak</a></li>
					<li><a href="<?= site_url('home/login') ?>">Login</a></li>
					<li>
						<?php
						$keranjang = '<i class="icon_bag_alt"></i> Keranjang saya : ' . $this->cart->total_items() . ' item'
						?>
						<?php echo  anchor('home/detail_keranjang', $keranjang) ?></li>


				</ul>

			</nav>
			<div id="mobile-menu-wrap"></div>
		</div>
	</div>
</header>
<!-- Header End -->