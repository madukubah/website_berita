

	<!-- Header -->
	<header class="header">
		<!-- Header Content -->
		<div class="header_content_container">
			<div class="container">
				<div class="row">
					<div class="col-1" >
						<div class="logohtmi"  >
							<img src="<?= FAVICON_IMAGE ?>" width="100x" >
							<!-- <img src="<?="";// base_url('front-assets/') ?>images/Logo.png" width="100x" > -->
						</div>
					</div>
					<div class="col">
							<!--  -->
							<div style="margin-left:20px" class="header_content d-flex flex-row align-items-center justfy-content-start">
								<div class="logo_container">
									<a href="<?= base_url() ?>">
										<div class="logo"><span>HMTI</span>UHO</div>
										<div class="logo_sub">Himpunan Mahasiswa Teknik Informatika</div>
									</a>
								</div>
								<!-- <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start">
									<a href="<?= base_url() ?>">
										<div class="background_image" style="background-image:url(<?= base_url('front-assets/') ?>images/extra.jpg)"></div>
										<div class="header_extra_content">
											<div class="header_extra_title">save 50%</div>
											<div class="header_extra_subtitle">Buy now in stores</div>
										</div>
									</a>
								</div> -->
							</div>
						<!--  -->
					</div>
				</div>
			</div>
		</div>

		<!-- Header Navigation & Search -->
		<div class="header_nav_container" id="header">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
							
							<!-- Logo -->
							<div class="logo_container">
								<a href="<?= base_url() ?>">
									<div class="logo"><span>HMTI</span>UHO</div>
									<div class="logo_sub">Himpunan Mahasiswa Teknik Informatika</div>
								</a>
							</div>

							<!-- Navigation -->
							<nav class="main_nav">
								<ul class="main_nav_list d-flex flex-row align-items-center justify-content-start">
									<li><a href="<?= base_url() ?>">home</a></li>
									<li><a href="<?= base_url("visi_misi") ?>">Visi-Misi</a></li>
									<li><a href="<?= base_url("structure") ?>">struktur organisasi</a></li>
									<li><a href="<?= base_url("gallery") ?>">Galeri</a></li>
									<li><a href="<?= base_url("contact") ?>">pengaduan</a></li>
								</ul>
							</nav>

							<!-- Search -->
							<div class="header_search_container ml-auto">
								<div class="header_search">
									<form action="#" id="header_search_form" class="header_search_form d-flex flex-row align-items-center justfy-content-start">
										<div><div class="header_search_activation"><i class="fa fa-search" aria-hidden="true"></i></div></div>
										<input type="text" class="header_search_input" placeholder="Search" required="required">
									</form>
								</div>
							</div>

							<!-- Hamburger -->
							<div class="hamburger ml-auto menu_mm"><i class="fa fa-bars  trans_200 menu_mm" aria-hidden="true"></i></div>
						</div>
					</div>
				</div>
			</div>		
		</div>
    </header>
<!-- ##################################################### -->

	<!-- Menu -->
	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="search">
			<form action="#" class="header_search_form menu_mm" >
				<input type="search" class="search_input menu_mm" placeholder="Search" required="required">
				<button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
					<i class="fa fa-search menu_mm" aria-hidden="true"></i>
				</button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li><a href="<?= base_url() ?>">home</a></li>
				<li><a href="<?= base_url("visi_misi") ?>">Visi-Misi</a></li>
				<li><a href="<?= base_url("structure") ?>">struktur organisasi</a></li>
				<li><a href="<?= base_url("gallery") ?>">Galeri</a></li>
				<li><a href="<?= base_url("contact") ?>">pengaduan</a></li>
			</ul>
		</nav>
		<div class="menu_subscribe"><a href="#">Subscribe</a></div>
		<div class="menu_extra">
			<div class="menu_social">
				<ul>
					<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
<!-- ##################################################### -->