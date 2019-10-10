

	<!-- Home -->

	<div class="home">
	<?php
		echo $alert;
	?>
		<!-- Home Slider -->
		<div class="home_slider_container">
			<div class="owl-carousel owl-theme home_slider">
				<!-- Slide -->
				<?php
					foreach( $sliders as $slider ):
				?>
					<div class="owl-item home_slider_item">
						<div class="background_image" style="background-image:url(<?= $slider->images ?>)"></div>
						<div class="home_slider_content text-center">
							<!-- <div class="home_slider_content_inner" data-animation-in="fadeIn" data-animation-out="animate-out fadeOut">
								<div class="home_category"><a href="category.html">technology</a></div>
								<div class="home_title">Building the Future</div>
								<div class="home_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae sapien porttitor, dignissim quam sit amet, aliquam lorem. Fusce id ligula non risus mollis consectetur</div>
								<div class="home_button trans_200"><a href="#">read more</a></div>
							</div> -->
						</div>
					</div>
				<?php
					endforeach;
				?>
			</div>

			<!-- Home Slider Navigation -->
			<div class="home_slider_nav home_slider_prev trans_200"><i class="fa fa-angle-left trans_200" aria-hidden="true"></i></div>
			<div class="home_slider_nav home_slider_next trans_200"><i class="fa fa-angle-right trans_200" aria-hidden="true"></i></div>
		</div>
	</div>
	

	<!-- Intro -->

	

	<!-- Content Container -->
	<!-- <div class="header_extra ml-auto d-flex flex-row align-items-center justify-content-start" style="position: absolute;right: 560px; top: 1670px">
		<a href="#">
			<div class="background_image" style="background-image:url(<?= base_url('front-assets/') ?>images/extra.jpg)"></div>
			<div class="header_extra_content">
				<div class="header_extra_title">save 50%</div>
				<div class="header_extra_subtitle">Buy now in stores</div>
			</div>
		</a>
	</div> -->

	<div class="content_container">
		
		<div class="container">
			<div class="row">

			 	<!-- Main Content -->

				<div class="col-lg-9">
					<div class="main_content">

						<!-- Technology -->

						<div class="technology">
							<div class="section_title_container d-flex flex-row align-items-start justify-content-start">
								<div>
									<div class="section_title">Info Terkini</div>
									<div class="section_subtitle"><?= date("d M Y" ) ?></div>
								</div>
								<div class="section_bar"></div>
							</div>
							<div class="technology_content">

								<?php
									foreach( $newses as $news ):
								?>
										<!-- Post -->
										<div class="post_item post_h_large">
											<div class="row">
												<div class="col-lg-5">
													<div class="post_image"><img src="<?= $news->images ?>" alt="https://unsplash.com/@jmckinven"></div>
												</div>
												<div class="col-lg-7">
													<div class="post_content">
														<div class="post_category cat_technology"><a href="category.html"><?= $news->category_name ?></a></div>
														<div class="post_title"><a href="<?= site_url("article/").$news->file_content ?>"><?= $news->title ?></a></div>
														<div class="post_info d-flex flex-row align-items-center justify-content-start">
															<div class="post_author d-flex flex-row align-items-center justify-content-start">
																<div><div class="post_author_image"><img src="<?= $news->author_image ?>" alt=""></div></div>
																<div class="post_author_name"><a href="#"><?= $news->author ?></a></div>
															</div>
															<div class="post_date"><a href="#"><?= date("d M Y", $news->timestamp ) ?></a></div>
															<!-- <div class="post_comments ml-auto"><a href="#">3 comments</a></div> -->
														</div>
														<div class="post_text">
															<p><?= $news->preview ?></p>
														</div>
													</div>
												</div>
											</div>	
										</div>

										<!-- <div class="load_more">
											<div class="load_more_button"><a href="#">load more</a></div>
											<hr>
										</div> -->
								<?php
									endforeach;
								?>

							</div>
						</div>
					</div>
					<?php echo (isset($pagination_links)) ? $pagination_links : '';  ?>					
				</div>

				<!-- Sidebar -->
				<?php 
					$this->load->view('templates/_public_parts/sidebar_menu' , $right_bar);
				?>				
				<!--  -->
				<!--  -->
			</div>
		</div>

		<div class="intro">
		<div class="container">
			<div class="row">
				<?php
					foreach( $caretakers as $caretaker ):
				?>
					<div class="col-md-3 intro_col">
						<div class="intro_item">
							<img src="<?= $caretaker->images ?>" alt="">
							<center><h4><b><?= $caretaker->description ?></b></h4></center>
						</div>
					</div>
				<?php
					endforeach;
				?>
			</div>
		</div>
	</div>
	</div>