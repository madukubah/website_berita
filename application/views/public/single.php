<link rel="stylesheet" type="text/css" href="<?= base_url('front-assets/') ?>styles/single.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('front-assets/') ?>styles/single_responsive.css">
	<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="<?= base_url('front-assets/') ?>images/222.jpg" data-speed="0.8" ></div>
		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title">Artikel</div>
							<div class="breadcrumbs">
								<ul class="d-flex flex-row align-items-start justify-content-start">
									<li><a href="index.html">Home</a></li>
									<li><a href="category.html">Info</a></li>
									<li>Artikel</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Content Container -->

	<div class="content_container">
		<div class="container">
			<div class="row">

				<!-- Single Post -->

				<div class="col-lg-9">

					<div class="single_post">
						<div class="post_image"><img src="<?= $news->images ?>" alt="https://unsplash.com/@cgower"></div>
						<div class="post_content">
							<div class="post_category cat_technology"><a href="#"><?= $news->category_name ?></a></div>
							<div class="post_title"><a href="#"><?= $news->title ?></a></div>
							<div class="post_info d-flex flex-row align-items-center justify-content-start">
								<div class="post_author d-flex flex-row align-items-center justify-content-start">
									<div><div class="post_author_image"><img src="<?= $news->author_image ?>" alt=""></div></div>
									<div class="post_author_name"><a href="#"><?= $news->author ?></a></div>
								</div>
								<div class="post_date"><a href="#"><?= date("d M Y", $news->timestamp ) ?></a></div>
								<div class="post_comments_num ml-auto"><a href="#">3 comments</a></div>
							</div>
							<div class="post_text">
								<?= $file_content ?>
							</div>
						</div>

						<!-- Social Share -->
						<div class="post_share d-flex flex-row align-items-center justify-content-start">
							<div class="post_share_title">Bagikan:</div>
							<ul class="post_share_list d-flex flex-row align-items-center justify-content-center">
								<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						
						<!-- Comments -->
					
						<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v4.0&appId=236183243598839&autoLogAppEvents=1"></script>
						<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-width="" data-numposts="5"></div>
						<!-- Reply  -->
						
					</div>

				</div>

				
				<!-- Sidebar -->

				<?php 
					$this->load->view('templates/_public_parts/sidebar_menu', $right_bar);
				?>		
				<!--  -->
				<!--  -->
			</div>
		</div>
	</div>

	