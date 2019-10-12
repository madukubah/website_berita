
<link rel="stylesheet" type="text/css" href="<?= base_url('front-assets/') ?>styles/contact.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('front-assets/') ?>styles/contact_responsive.css">
	<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="<?= base_url('front-assets/') ?>images/222.jpg" data-speed="0.8"></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">Pengaduan</div>
							<div class="breadcrumbs">
								<ul class="d-flex flex-row align-items-start justify-content-start">
									<li><a href="index.html">Home</a></li>
									<li>Pengaduan</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->

	<div class="contact">
		<div class="container">
			<div class="row">
				
				<!-- Contact Content -->
				<div class="col-lg-4 contact_col">
					<div class="contact_content">
						<!-- <div class="contact_title">Get in Touch</div>
						<div class="contact_text">
							<p> Nullam vestibulum convallis risus vel condimentum. Nullam auctor lorem in libero luctus, vel volutpat quam tincidunt. Nullam vestibulum convallis risus vel condimentum. Nullam auctor lorem in libero.Lorem ipsum dolor sit amet, consectetur adipiscin.</p>
						</div> -->
						<div class="contact_social">
							<ul class="contact_social_list d-flex flex-row align-items-center justify-content-start">
								<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="contact_info">
							<ul>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="contact_info_box d-flex flex-column align-items-center justify-content-center">
										<div class="contact_info_icon"><img src="<?= base_url('front-assets/') ?>images/icon_9.svg" alt=""></div>
									</div>
									<div class="contact_info_content">Fakultas Teknik, Universitas Halo Oleo</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="contact_info_box d-flex flex-column align-items-center justify-content-center">
										<div class="contact_info_icon"><img src="<?= base_url('front-assets/') ?>images/icon_15.png" alt=""></div>
									</div>
									<div class="contact_info_content">HMTI.UHO</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="contact_info_box d-flex flex-column align-items-center justify-content-center">
										<div class="contact_info_icon"><img src="<?= base_url('front-assets/') ?>images/icons_19.png" alt=""></div>
									</div>
									<div class="contact_info_content">hmti-uho@gmail.com</div>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Contact Form -->
				<div class="col-lg-8 contact_col">
					<div class="contact_form_container">
						<div class="contact_title">Kirim Pesan</div>
						<form action="<?= site_url("complaint") ?>" method="POST" id="contact_form" class="contact_form">

							<input type="email" class="contact_input" placeholder="E-mail" required="required" name="email" >
							<textarea class="contact_input contact_textarea" placeholder="Pesan" required="required" name="messages" ></textarea>
							
							<button class="contact_button trans_200">Kirim</button>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>

	