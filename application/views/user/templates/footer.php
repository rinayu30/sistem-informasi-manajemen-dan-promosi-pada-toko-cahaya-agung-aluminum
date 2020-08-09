 <!-- Footer Area
        ================================================== -->

 <div class="footer-container">
 	<!-- Begin Footer -->
 	<div class="container">
 		<div id="myWhatsapp">
 			<div class="row footer-row">
 				<div class="span3 footer-col">
 					<h5>Tentang Kami</h5>
 					<address>
 						<strong>Toko Cahaya Agung Aluminium</strong><br />
 						Jalan Garuda Sakti KM 2.5 Simpang Baru, Kel. Binawidya, Kec. Tampan<br />
 						Pekanbaru, Riau<br />
 					</address>
 				</div>
 				<div class="span3 right footer-col">
 					<ul class="social-icons">
 						<li><a href="https://www.facebook.com/cahayaagung91/" class="social-icon facebook"></a></li>
 						<li><a href="https://www.instagram.com/cahaya_agung_aluminium/" class="social-icon dribble"></a></li>
 						<!-- <li><a href="" class="social-icon rss"></a></li> -->
 						<li><a href="https://cahaya-agung-aluminium.business.site/" class="social-icon forrst"></a></li>
 					</ul>
 				</div>
 			</div>

 			<div class="row">
 				<!-- Begin Sub Footer -->
 				<div class="span12 footer-col footer-sub ">
 					<div class="row no-margin ">
 						<div class="span6"><span><strong> Copyright &copy; </strong>
 								<?php echo SITE_NAME . " " . Date('Y') ?></span></div>

 					</div>
 				</div>
 			</div><!-- End Sub Footer -->

 		</div>
 	</div><!-- End Footer -->

 </div>

 <script src="<?= base_url() ?>assets_user/js/floating-wpp.js"></script>
 <script type="text/javascript">
 	$(window).load(function() {
 		$('.myWhatsapp').floatingWhatsApp({
 			phone: '628127774130',
 			popupMessage: 'Hi, Apa yang bisa kami bantu?',
 			message: 'Halo, saya ingin bertanya',
 			showPopup: true,
 			showOnIE: false,
 			headerTitle: 'Selamat Datang di Toko Cahaya Agung Aluminium',
 			headerColor: 'rgb(18, 140, 126)',
 			backgroundColor: '',
 			buttonImage: '<img src="<?= base_url() ?>assets_user/img/wa.png"/>'

 		});
 	});
 </script>
 <!-- Scroll to Top -->
 <div id="toTop" class="hidden-phone hidden-tablet">Kembali Keatas</div>

 </body>

 </html>