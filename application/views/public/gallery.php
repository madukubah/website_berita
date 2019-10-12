<link rel="stylesheet" type="text/css" href="<?= base_url('front-assets/') ?>styles/Galeri1.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('front-assets/') ?>styles/Galeri.css">
<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="<?= base_url('front-assets/') ?>images/222.jpg" data-speed="0.8"></div>		
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">Galeri</div>
							<div class="breadcrumbs">
								<ul class="d-flex flex-row align-items-start justify-content-start">
									<li><a href="index.html">Home</a></li>
									<li>Galeri</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<!-- Intro -->

	<div class="intro">
		<div class="container">
			<div class="row">
			<?php
				foreach( $galleries as $gallery ):
			?>
				<!-- Intro Item -->
					<div class="col-md-3 intro_col">
						<div class="contoh">
								<div class="box">
								<div class="imgbox">	
									<img src="<?= $gallery->images ?>">
									<!-- <div class="detail">
										<div class="content">					
											<h2><?= "";//$gallery->name ?></h2>
											<p><?= "";//$gallery->description ?></p>
										</div>
									</div> -->
									<div class="ba">
									<h4> <?= $gallery->name ?></h4>
								</div>
								</div>
							</div>
						</div>							
					</div>
				<!--  -->
			<?php
				endforeach;
			?>
		
			</div>
		</div>
	</div>
