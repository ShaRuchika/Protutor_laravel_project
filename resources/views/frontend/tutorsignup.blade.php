@include('/frontend/common/header')
<link rel="stylesheet" href="{{url('/')}}/public/assets/frontpage_assets/css/tutor-signup.css">
<div class="sign-step">
	<div class="sign-step-top">
		<div class="container">
			<ul class="nav nav-tabs">

				<li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#tab-1">
						<span class="circle">1</span>
						<span class="circle-icon"><i class="fa-solid fa-location-dot"></i></span>
						<span class="circle-txt">About</span>
						<span class="circle-arrow"><i class="fa-solid fa-chevron-right"></i></span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tab-2">
						<span class="circle">2</span>
						<span class="circle-icon"><i class="fa-solid fa-location-dot"></i></span>
						<span class="circle-txt">Description</span>
						<span class="circle-arrow"><i class="fa-solid fa-chevron-right"></i></span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tab-3">
						<span class="circle">3</span>
						<span class="circle-icon"><i class="fa-solid fa-location-dot"></i></span>
						<span class="circle-txt">Photo</span>
						<span class="circle-arrow"><i class="fa-solid fa-chevron-right"></i></span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tab-4">
						<span class="circle">4</span>
						<span class="circle-icon"><i class="fa-solid fa-location-dot"></i></span>
						<span class="circle-txt">Video</span>
						<span class="circle-arrow"><i class="fa-solid fa-chevron-right"></i></span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#tab-5">
						<span class="circle">5</span>
						<span class="circle-icon"><i class="fa-solid fa-location-dot"></i></span>
						<span class="circle-txt">Done</span>
						<span class="circle-arrow"><i class="fa-solid fa-chevron-right"></i></span>
					</a>
				</li>


			</ul>
		</div>
	</div>

	<form action="{{url('/submit_tutor_signup')}}" method="post" enctype="multipart/form-data">
		@csrf()
		<div class="sign-step-cont">
			<div class="container">
				<span style="color: red;">
					@if(session('success_msg'))  
					<div class="alert alert-success alert-dismissible"> 
						{{session('success_msg')}}
						<button type="button" class="btn-close" data-bs-dismiss="alert"><span aria-hidden="true"></span>
						</button>
					</div>
					@elseif(session('error_msg'))
					<div class="alert alert-danger alert-dismissible"> 
						{{session('error_msg')}}
						<button type="button" class="btn-close" data-bs-dismiss="alert"><span aria-hidden="true"></span>
						</button>
					</div>
					@endif 
				</span>
				<div class="tab-content">
					<div class="tab-pane fade show active" id="tab-1">
						<div class="row">
							<div class="col-sm-6">
								<div class="inp-wrap mt-0">
									<label for="">First Name <span style="color: red;">*</span></label>
									<input class="inp" type="hidden" name="userid" value="{{$userid}}">
									<input class="inp" type="text" value="{{ old('first_name') }}" name="first_name" id="" placeholder="Tufayel">
									<span style="color: red;">@if($errors->has('first_name'))
										{{ $errors->first('first_name');}} 
									@endif</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="inp-wrap mt-0 alt">
									<label for="">Last name <span style="color: red;">*</span></label>
									<input class="inp" type="text" value="{{ old('last_name') }}" name="last_name" placeholder="Tufayel">
									<span style="color: red;">@if($errors->has('last_name'))
										{{ $errors->first('last_name');}} 
									@endif</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="inp-wrap">
									<label for="">Email <span style="color: red;">*</span></label>
									<input class="inp" type="email" value="{{$email}}" name="email" readonly>
									<span style="color: red;">@if($errors->has('email'))
										{{ $errors->first('email');}} 
									@endif</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="inp-wrap">
									<label for="">Country of origin <span style="color: red;">*</span></label>
									<select class="inp" name="country" id=""> 
										<option value="">Select Country</option>
										@foreach($countries as $countries_data)
										<option {{ old('country') == $countries_data->id ? "selected" : "" }} value="{{$countries_data->id}}">{{$countries_data->nicename}}</option>
										@endforeach
									</select>
								</div>
								<span style="color: red;">@if($errors->has('country'))
									{{ $errors->first('country');}} 
								@endif</span>


							</div>
							<div class="col-sm-6">
								<div class="inp-wrap">
									<label for="">Native Language<span style="color: red;">*</span></label>
									<select class="inp" name="native_language">
									<option value="">Select Native Language</option> 
										@foreach($spoken_languages as $spoken_languages_data)
										<option {{ old('native_language') == $spoken_languages_data->id ? "selected" : "" }} value="{{$spoken_languages_data->id}}">{{$spoken_languages_data->spoken_language}}</option>
										@endforeach
									</select>
									<span style="color: red;">@if($errors->has('native_language'))
										{{ $errors->first('native_language');}} 
									@endif</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="inp-wrap">
									<label for="">Languages spoken <span style="color: red;">*</span></label>
									<select class="inp" name="languages[]" multiple data-allow-clear="1"> 
										@foreach($spoken_languages as $spoken_languages_data)
										<option {{in_array($spoken_languages_data->id, old("languages") ?: []) ? "selected": ""}} value="{{$spoken_languages_data->id}}">{{$spoken_languages_data->spoken_language}}</option>
										@endforeach
									</select>
									<span style="color: red;">@if($errors->has('languages'))
										{{ $errors->first('languages');}} 
									@endif</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="inp-wrap">
									<label for="">Level <span style="color: red;">*</span></label>
									<select class="inp" name="level" id=""> 
										<option value="">Select level</option>
										@foreach($teaches_levels as $teaches_levels_data)
										<option {{ old('level') == $teaches_levels_data->id ? "selected" : "" }} value="{{$teaches_levels_data->id}}">{{$teaches_levels_data->teaches_level}}</option>
										@endforeach
									</select>
									<span style="color: red;">@if($errors->has('level'))
										{{ $errors->first('level');}} 
									@endif</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="inp-wrap">
									<label for="">Subject taught <span style="color: red;">*</span></label>
									<select class="inp" name="subject[]" multiple data-allow-clear="1"> 
										@foreach($subject as $subject_data)

										<option {{in_array($subject_data->id, old("subject") ?: []) ? "selected": ""}} value="{{$subject_data->id}}">{{$subject_data->subject}}</option>
										@endforeach
									</select>
									<span style="color: red;">@if($errors->has('subject'))
										{{ $errors->first('subject');}} 
									@endif</span>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="inp-wrap">
									<label for="">Hourly rate <span style="color: red;">*</span></label>
									<select class="inp" name="hourly_rate" id=""> 
										<option value="">Select Hourly Rate</option>
										@foreach($hourly_rate as $hourly_rate_data)
										<option {{ old('hourly_rate') == $hourly_rate_data->id ? "selected" : "" }} value="{{$hourly_rate_data->id}}">{{$hourly_rate_data->hourly_rate}}</option>
										@endforeach
									</select>

									<span style="color: red;">@if($errors->has('hourly_rate'))
										{{ $errors->first('hourly_rate');}} 
									@endif</span>
								</div>
							</div>

							<div class="inp-wrap">
								<label for="">Phone number (optional)</label>
								<input class="inp" type="text" value="{{ old('phone_number') }}"  name="phone_number" id="" placeholder="">
							</div>

							<div class="inp-wrap">
								<label class="custom-check">I confirm I’m over 18
									<input type="checkbox" name="over_18">
									<span class="checkmark"></span>
								</label>
							</div>

						</div>
						<div class="tab-next">
							<a class="site-link btnNext">Next</a>
						</div>

					</div>

					<div class="tab-pane fade" id="tab-2">
						<div class="">
							<h2>Profile description</h2>
							<p class="pt-2">Update or create a new profile headline and description. It will appear on your tutor card on the “Find tutors” page.</p>
							<h3 class="pt-5">Description for English-speaking students</h3>

							<div class="profile-desc">
								<div class="profile-desc-img"><img src="{{url('/')}}/public/assets/frontpage_assets/images/user.jpg" alt=""></div>
								<div class="profile-desc-txt">
									<div class="inp-wrap mt-0">
										<label for="">Profile Headline<span style="color: red;">*</span></label>
										<input class="inp" type="text" value="{{ old('desc_first_last') }}" name="desc_first_last" id="" placeholder="Your Headline">
										<span style="color: red;">@if($errors->has('desc_first_last'))
											{{ $errors->first('desc_first_last');}} 
										@endif</span>
									</div>
									<div class="inp-wrap">
										<label for="">Profile description <span style="color: red;">*</span></label>
										<textarea class="inp" placeholder="Your description" name="desc_about" id="">{{ old('desc_about') }}</textarea>
										<span style="color: red;">@if($errors->has('desc_about'))
											{{ $errors->first('desc_about');}} 
										@endif</span>
										<p><span>400 characters minimum. 0 characters currently.</span></p>
									</div>
									<div class="tab-next">
										<a class="site-link btnNext">Next</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="tab-3">
						<div class="">
							<h2>Profile photo <span style="color: red;">*</span></h2>
							<p class="pt-2">Make a great first impression</p>

							<div class="inp-wrap">
								<div class="upBtn">
									<a class="site-link">Take a Picture </a>
									<input type="file" name="your_picture" onchange="loadFile(event)">
									<span style="color: red;">@if($errors->has('your_picture'))
										{{ $errors->first('your_picture');}} 
									@endif</span>
								</div>
							</div>



							<div class="photo-area"> 
								<img id="output"/>
								<!--  <input type="file" name="your_photo"> -->
							</div>

							<div class="tab-next">
								<a class="site-link btnNext">Next</a>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="tab-4">
						<div class="">
							<h2>Video introduction <span style="color: red;">*</span></h2>
							<p class="pt-2">Choose a video file to upload. Make sure it follows our guidelines</p>

							<div class="inp-wrap">
								<div class="upBtn">
									<a class="site-link">Upload Video</a>
									<input type="file" name="upload_video" class="file_multi_video" accept="video/*">
									<span style="color: red;">@if($errors->has('upload_video'))
										{{ $errors->first('upload_video');}} 
									@endif</span>
								</div>
							</div>

							<div class="photo-area"> 
								<!-- <input type="file" name="drag_and_drop_video"> -->
								<video width="400" controls>
									<source src="mov_bbb.mp4" id="video_here">
										Your browser does not support HTML5 video.
									</video>
								</div>

								<div class="tab-next">
									<a class="site-link btnNext">Next</a>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="tab-5">
							<div class="success">
								<h2>Please Submit This From</h2>
								<p class="pt-3 text-center">We Wil Review Your Profile For Approval Within The Next 24 Hours</p>

								<button type="submit" class="site-link mt-4">Submit</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</form>

	</div>
	@include('/frontend/common/footer') 

	<script type="text/javascript">
		$(function () {
			$('select').each(function () {
				$(this).select2({
					theme: 'bootstrap4',
					width: 'style',
					placeholder: $(this).attr('placeholder'),
					allowClear: Boolean($(this).data('allow-clear')),
				});
			});
		});
	</script>
	<script type="text/javascript">
		var loadFile = function(event) {
			var output = document.getElementById('output');
			output.src = URL.createObjectURL(event.target.files[0]);
			output.onload = function() {
				URL.revokeObjectURL(output.src) 
			}
		};

		$(document).on("change", ".file_multi_video", function(evt) {
			var $source = $('#video_here');
			$source[0].src = URL.createObjectURL(this.files[0]);
			$source.parent()[0].load();
		});


	</script>