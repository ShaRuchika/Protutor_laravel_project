@include('/frontend/common/header')
<!-- start page title -->
<div class="page-title">
	<div class="container">
		<h1>Become a Tutor</h1>
	</div>
</div>
<style type="text/css">
	.get-paid-section{

		background: url('{{url('/')}}/public/images/{{$contentAll[0]->sec4_img}}') center center no-repeat !important;
	}
	.accordion {
		width: 90%;
		max-width: 1000px;
		margin: 0 !important;
	}

</style>
<!-- end page title -->

<!-- start become a author hero section -->
<section class="become-author-hero-section">
	<div class="become-author-hero-section-overlay">
		<div class="container">
			<div class="become-author-hero-main" data-aos="fade-up">
				<div class="sine-up-page-area">
					<div class="row">
						<div class="col-md-12 my-5">
							<h1 class="fw-bold text-dark mb-3">Teach Online</h1>
							<span class="become-author-text">Sign up to earn money on you schedule</span>
							<!-- form -->
							<span style="color: red;">
								@if(session('success_msg'))  
								<div class="alert alert-success alert-dismissible"> 
									{{session('success_msg')}}
									<button type="button" class="btn-close" data-bs-dismiss="alert"><span aria-hidden="true">&times;</span>
									</button>
								</div>
								@elseif(session('error_msg'))
								<div class="alert alert-danger alert-dismissible"> 
									{{session('error_msg')}}
									<button type="button" class="btn-close" data-bs-dismiss="alert"><span aria-hidden="true">&times;</span>
									</button>
								</div>
								@endif 
							</span>

							<form action="{{url('/become-a-tutor')}}" class="form mt-2" method="post">
								@csrf()
								<div class="login-inp-wrap">
									<input class="login-inp" name="email" type="email" placeholder="Email">
									<span style="color: red;">
										@if($errors->has('email'))
										{{ $errors->first('email');}} 
										@endif
									</span>
								</div>
								<div class="login-inp-wrap">
									<input class="login-inp" name="password" id="password" type="password" placeholder="Password">
									<span class="inp-icon">
										<i class="fa-regular fa-eye" id="eye"></i>
									</span>
									<span style="color: red;">
										@if($errors->has('password'))
										{{ $errors->first('password');}} 
										@endif
									</span>
								</div>
								<div class="log-remember">
									<label class="custom-check">Remember me
										<input type="checkbox">
										<span class="checkmark"></span>
									</label>
								</div>
								<input class="form-btn" type="submit" value="Sign up">
							</form>

							<p class="sine-up-p fs-6">Already have an account? <strong style="color: #FF6C0B;" class="fs-6">
								<a href="{{url('/login')}}">Log in</a>
							</strong></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end become a author hero section -->

<!-- start services section -->
<section class="services-section">
	<div class="container">
		<div class="row">
			<?php 
			$get_section1 = $contentAll[0]->sec_data1;
			$get_section_all = json_decode($get_section1);
			?>
			<?php 
			$sec1_count=1;
			foreach ($get_section_all as $key => $get_section_value) {
				?>
				<div class="col-lg-4 col-md-12 mt-3" data-aos="fade-up">
					<span>
						<img src="{{url('/')}}/public/images/{{$get_section_value->icon}}" alt="" width="100" height="100">
					</span>
					<h3 class="fw-blod text-dark my-3">
						{{$get_section_value->title}}
					</h3>
					<p class="fs-6 text-muted">
						{{$get_section_value->description}}
					</p>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<!-- end services section -->

<!-- start information section -->
<section class="information-section">
	<div class="cont-space">
		<div class="row">
			<?php 
			$get_section2 = $contentAll[0]->sec_data2;
			$get_section2_all = json_decode($get_section2);
			?>
			<div class="col-md-6 mt-3" data-aos="fade-up">
				<img src="{{url('/')}}/public/images/{{$contentAll[0]->img_sec2}}">
			</div>
			<div class="col-md-6 info-right" data-aos="fade-up">
				<h1 class="mt-5 mt-md-3 fs-2 text-dark fw-bold">
					{{$contentAll[0]->main_title_sec2}}
				</h1>
				<!-- row 1 -->
				<div class="row">
					<?php 
					$sec2_count=1;
					foreach ($get_section2_all as $key => $get_section_values) {
						?>
						<div class="col-md-6 mt-5" data-aos="fade-up">
							<h3 class="fs-5 text-dark mb-2">{{$get_section_values->title}}</h3>
							<p class="text-muted fs-6">
								{{$get_section_values->description}}
							</p>
						</div>
					<?php } ?>
				</div>

				<!-- single p element -->
				<p class="mt-3 text-muted fs-6">
					{{$contentAll[0]->content_sec2}}
				</p>
				<!-- button -->
				<a href="{{$contentAll[0]->url_sec2}}"><button class="mt-3 info-btn">Apply Now</button></a>
			</div>
		</div>
	</div>
</section>
<!-- end information section -->

<!-- start qna section -->
<section class="qna-section">
	<div class="container">
		<h1 class="text-center text-dark fw-bold mb-5">
			Questions? We have Answers!
		</h1>
		<div class="row">
			<?php 
			$get_section3 = $contentAll[0]->sec_data3;
			$get_section3_all = json_decode($get_section3);
			?>
			<?php 
			$sec3_count=1;
			$var= count($get_section3_all)/2; ?>
			<div class="col-lg-6 col-md-12" data-aos="fade-up">
				<?php 
				foreach (array_slice($get_section3_all, 0, $var) as $key => $get_section3_value) {
					?>
					<div class="accordion">
						<div class="accordion-item">
							<div class="accordion-item-header" id="change-color">
								{{$get_section3_value->title}}
							</div>
							<div class="accordion-item-body">
								<div class="accordion-item-body-content">
									<p class="text-muted fs-6 text-start">
										{{$get_section3_value->description}}
									</p>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<div class="col-lg-6 col-md-12" data-aos="fade-up">
				<?php 
				foreach (array_slice($get_section3_all, 6) as $key => $get_section3_value) {
					?>
					<div class="accordion">
						<div class="accordion-item">
							<div class="accordion-item-header" id="change-color">
								{{$get_section3_value->title}}
							</div>
							<div class="accordion-item-body">
								<div class="accordion-item-body-content">
									<p class="text-muted fs-6 text-start">
										{{$get_section3_value->description}}
									</p>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<p class="text-center text-dark fw-bold fs-5 mt-4">
			Have more questions? <a href="#"><span style="color:#FF6C0B;">Check our Help center <br></span></a> or <a href="#"><span style="color:#FF6C0B;">contact our support team</span></a>
		</p>
	</div>
</section>
<!-- end qna section -->

<!-- start get paid section -->
<section class="get-paid-section">
	<div class="get-paid-section-overlay">
		<div class="container">
			<div class="row">
				<div class="col" data-aos="fade-up">
					<h1 class="find-sec-title">
						{{$contentAll[0]->sec4_title}}
					</h1>
					<p class="find-sec-para">
						{{$contentAll[0]->sec4_desc}}
					</p>
					
					<a href="{{$contentAll[0]->sec4_url}}">
						<button class="find-tutor-btn">Get started</button>
					</a>
					
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end get paid section -->

<!-- start banner section -->
<section class="apps-banner">
	<div class="container">
		<div class="apps-banner-main">
			<div class="row align-items-center">
				<div class="col-lg-7" data-aos="fade-up">
					<div class="apps-banner-left">
						<h2>{{$contentAll[0]->sec5_heading}}</h2>
						<p class="mb-3 text-start"> {{$contentAll[0]->sec5_desc}} </p>
						<div class="button-group">
							<a class="" href="{{$contentAll[0]->sec5_apple_store_url}}"><img src="{{url('/')}}/public/assets/frontpage_assets/images/app-store.png" alt=""></a>
							<a class="ms-md-3 ms-sm-0" href="{{$contentAll[0]->sec5_play_store_url}}"><img src="{{url('/')}}/public/assets/frontpage_assets/images/goole.png" alt=""></a>
						</div>
					</div>
				</div>
				<div class="col-lg-5" data-aos="fade-up">
					<div class="apps-banner-right"><img src="{{url('/')}}/public/images/{{$contentAll[0]->sec5_file}}" alt=""></div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('/frontend/common/footer')