@include('/dashboard/common/header')
@include('/dashboard/common/sidebar')
<!-- Container -->
<style type="text/css">
	li.nav-item a {
		color: black;
	}
</style>
<?php 

$parts = explode("/", $_SERVER['REQUEST_URI']);
$getVal =  end($parts);  
?>
<section class="wrapper">
	<div class="page-title">
		<h1>Profile</h1>
	</div>

	<div>
		<ul class="nav tab-nav">
			<li class="nav-item">
				<button class="<?php echo (isset($getVal) && $getVal == 'about' ? 'active' : "") ?>" data-bs-toggle="tab" data-bs-target="#tab-1">
					<span>me</span> <a href="{{url('/')}}/profile/about"> About</a> 
				</button>
			</li>
			<li class="nav-item">
				<button data-bs-toggle="tab" data-bs-target="#tab-2" class="<?php echo (isset($getVal) && $getVal == 'photo' ? 'active' : "") ?>">
					<span><i class="fa-solid fa-images"></i></span> <a href="{{url('/')}}/profile/photo"> Photo</a>
				</button>
			</li>
			<li class="nav-item">
				<button data-bs-toggle="tab" data-bs-target="#tab-3" class="<?php echo (isset($getVal) && $getVal == 'description' ? 'active' : "") ?>">
					<span><i class="fa-solid fa-align-left"></i></span> <a href="{{url('/')}}/profile/description"> Description</a> 
				</button>
			</li>
			<li class="nav-item">
				<button data-bs-toggle="tab" data-bs-target="#tab-4" class="<?php echo (isset($getVal) && $getVal == 'video' ? 'active' : "") ?>">
					<span><i class="fa-solid fa-video"></i></span> <a href="{{url('/')}}/profile/video"> Video</a> 
				</button>
			</li>
			<li class="nav-item">
				<button data-bs-toggle="tab" data-bs-target="#tab-5" class="<?php echo (isset($getVal) && $getVal == 'background' ? 'active' : "") ?>">
					<span><i class="fa-regular fa-object-group"></i></span> <a href="{{url('/')}}/profile/background"> Background</a> 
				</button>
			</li>
		</ul>

		<div class="tab-content pt-3">
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
			<?php //print_r($listUser); die; ?>
			<div class="tab-pane fade <?php echo (isset($getVal) && $getVal == 'about' ? 'show active' : "") ?>" id="tab-1">
				<form  method="post" id="form1" action="{{url('/profile')}}">
					@csrf
					<input type="hidden" name="id" value="{{$listUser[0]->user_id}}">
					<div class="box">
						<div class="tab-title">
							<h2>About</h2>
						</div>    
						<div class="row justify-content-center">
							<div class="col-lg-9">
								<div class="bg-block">
									<div class="bg-block-main">
										<div class="inp-group mt-0">
											<label for="">First Name</label>
											<input class="inp" type="text" name="first_name" placeholder="First Name" value="{{$listUser[0]->first_name}}" readonly="">
										</div>
										<div class="inp-group">
											<label for="">Last Name</label>
											<input class="inp" type="text" name="last_name" placeholder="Last Name" value="{{$listUser[0]->last_name}}" readonly="">
										</div>
										<div class="inp-group">
											<label for="">Email</label>
											<input class="inp" type="email" name="email" placeholder="uniquename@domain.com" value="{{$listUser[0]->email}}" readonly="">
										</div>
									</div>
									<div class="inp-group">
										<p class="info-txt">NOTE : Cannot edit First Name, Last Name, Country of origin and email - Please contact admin to change this information</p>
									</div>
								</div>
								<div class="bg-block-main">
									<div class="inp-group">
										<label for="">Describe your teaching experience</label>
										<select class="inp" name="teaching_exp" id="">
											<option value="I have formal teaching experience">I have formal teaching experience</option>
										</select>
									</div>
									<div class="inp-group">
										<label for="">Describe your current situation</label>
										<select class="inp" name="current_sit" id="">
											<option value="I have another teaching job">I have another teaching job</option>
										</select>
									</div>
									<div class="inp-group">
										<label for="">Timezone</label>
										<select class="inp" name="timezone" id="">
											<option value="Asia/Karachi">Asia/Karachi</option>
										</select>
									</div>
									<div class="inp-group">
										<label for="">Country of origin</label>
										<select class="inp" name="country" id="">
											<option value="">Select Country</option>
											<?php 
											foreach ($countries as $key => $value) { ?>
												<option value="<?php echo $value->id; ?>"  <?php echo ($value->id == $listUser[0]->country ? "selected" : "") ?> ><?php echo $value->name; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="inp-group">
										<label for="">Phone Number</label>
										<input class="inp" type="text" name="phone" minlength="10" maxlength="10" value="{{$listUser[0]->phone}}" id="phone">
									</div>
									<div class="inp-group">
										<label for="">Hourly rate - USD ($)</label> 
										<select id="learn" name="hourly_rate" class="shadow-none form-select rounded-pill">
											<option value="">Select</option>
											@foreach($rateAll as $data1)
											<option <?php echo ((isset($listUser[0]->hourly_rate) && $listUser[0]->hourly_rate == $data1->id) ? "selected" : ""); ?> value="{{ $data1->id }}">{{ $data1->hourly_rate }}</option>
											@endforeach
										</select>

									</div>
								</div>
								<div class="bg-block mt-4">
									<h5 class="text-center">Subjects Taught</h5>
									<p class="info-txt">You can select up to 20 subjects. Some subjects may require a knowledge quiz in the next step.</p>

									<div class="row">
										<div class="col-lg-3"></div>
										<div class="col-lg-6">
											<select name="subject[]" multiple data-allow-clear="1" id="subject">
												<option value="">Select Subject</option>
												<?php foreach ($subject as $key => $value) { ?>
													<option value="<?php echo $value->id ?>"><?php echo $value->subject ?></option>  
												<?php  } ?> 
											</select>
										</div>
										<div class="col-lg-3"></div> 
									</div>
								</div>
							</div>
						</div>
						<div class="save-changes">
							<button type="subject" name="about" value="about">Save Changes</button>
						</div>
					</div>
				</form>
			</div>

			<div class="tab-pane fade <?php echo (isset($getVal) && $getVal == 'photo' ? 'show active' : "") ?>" id="tab-2">
				<form method="post" action="{{url('/profile')}}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" value="{{$listUser[0]->user_id}}">
					<div class="box">
						<div class="tab-title">
							<h2>Profile Photo</h2>
							<h3>Make a great first impression</h3>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="profile-photo">
									<div class="profile-photo-top">
										<div class="profile-photo-left"><img src="{{url('/')}}/public/images/{{$listUser[0]->profile_img}}" alt=""></div>
										<div class="profile-photo-right">
											<div class="line-1"></div>
											<div class="line"></div>
											<div class="line"></div>
											<div class="mt-4">
												<div class="line"></div>
												<div class="line"></div>
												<div class="line"></div>
											</div>
										</div>
									</div>
									<div class="row mt-4">
										<div class="col-6">
											<div class="frame"></div>
										</div>
										<div class="col-6">
											<div class="frame"></div>
										</div>
									</div>
								</div>
								<!-- <div class="capture">
									<button type="button" ><i class="fa-solid fa-camera-retro"></i> Capture Photo</button>
									<span class="txt-orange">Capture profile photo using webcam</span>
								</div> -->
								<div class="up-image">
									<p>Or upload image in JPG or PNG format not exceeding 5MB in size <br> <span>UPLOAD IMAGE</span></p>
									<input type="file" name="profile_img" class="chooseIMG">
								</div><br/>
								<div class="imagePre" ></div>
								
							</div>
							<div class="col-lg-6">
								<div class="photo-list-wrap">
									<div class="photo-list">
										<h3>Tips for an amazing profile photo</h3>
										<ul>
											<li>
												<div class="photo-list-single"><img src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""></div>
											</li>
											<li>
												<div class="photo-list-single"><img src="https://images.pexels.com/photos/6976943/pexels-photo-6976943.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""></div>
											</li>
											<li>
												<div class="photo-list-single"><img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt=""></div>
											</li>
										</ul>
									</div>
									<div class="photo-list-txt">
										<ul>
											<li>Smile and look at the camera</li>
											<li>Frame your head and shoulders</li>
											<li>Your photo is centered and upright</li>
											<li>Use neutral lighting and background</li>
											<li>Your face and eyes are fully visible (except for religious reasons)</li>
											<li>Avoid logos or contact information</li>
											<li>You are the only person in the photo</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="save-changes">
							<button type="submit" name="photo" value="photo">Save Changes</button>
						</div>
					</div>
				</form>
			</div>

			<div class="tab-pane fade <?php echo (isset($getVal) && $getVal == 'description' ? 'show active' : "") ?>" id="tab-3"> 
				<form method="post" action="{{url('/profile')}}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" value="{{$listUser[0]->user_id}}"> 
					<div class="box">
						<div class="tab-title">
							<h2>Profile Description</h2>
							<h3>Update or create a new profile headline and description. It will appear on your tutor card on the “Find tutors” page.</h3>
						</div>

						<div class="row">
							<div class="col-lg-8">
								<div class="pro-desc">
									<h4>Description for students</h4>
									<div class="pro-desc-in">
										<div class="pro-desc-left">
											<div class="profile-photo-left"><img src="{{url('/')}}/public/images/{{$listUser[0]->profile_img}}" alt=""></div>
										</div>
										<div class="pro-desc-right">
											<div class="inp-box mt-0">
												<label for="">First Name & Last Name of Tutor</label>
												<input class="inp-box-inp" type="text" placeholder="Certified tutor with extensive experience" name="desc_first_last" value="{{$listUser[0]->desc_first_last}}">
												<p class="info-txt text-start">Good example: “Certified tutor with 5 years of experience”</p>
											</div>
											<div class="inp-box">
												<label for="">About the tutor</label>
												<textarea class="inp-box-inp" name="desc_about" id="">{{$listUser[0]->desc_about}}</textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="save-changes"> 
							<button type="submit" name="description" value="description">Save Changes</button>
						</div>
					</div>
				</form>
			</div>

			<div class="tab-pane fade <?php echo (isset($getVal) && $getVal == 'video' ? 'show active' : "") ?>" id="tab-4">
				<form method="post" action="{{url('/profile')}}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" value="{{$listUser[0]->user_id}}"> 
					<div class="box">
						<div class="tab-title">
							<h2>Profile Introduction Video</h2>
							<h3>Now introduce yourself to students!</h3>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="pro-desc">
									<div class="inp-box mt-0">
										<label for="">Video Link</label>
										<input class="inp-box-inp file_multi_video" type="file" name="upload_video" accept="video/*" placeholder="https://vimeo.com/video_id">
										<p class="info-txt text-start">Good example: “Certified tutor with 5 years of experience”</p>
									</div>
									<div class="inp-box">
										<label for="">Video Preview</label>

										<div class="vid-prev">
											<div class="vid-icon">
												<video width="400" controls>
													<source src="{{url('/')}}/public/videos/{{$listUser[0]->video_link}}" id="video_here">
														Your browser does not support HTML5 video.
													</video>
												</div>
											</div>
											<div class="pt-3"> 
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="photo-list-wrap">
										<div class="photo-list-txt">
											<h2>Tips for an amazing introduction video</h2>
											<h2 class="pt-4">Technical</h2>
											<ul class="pt-2">
												<li>Keep your video between 30 seconds and 2 minutes long</li>
												<li>Record in a horizontal mode</li>
												<li>Position the camera at eye level</li>
												<li>Use neutral lighting and background</li>
												<li>Your face and eyes are fully visible (except for religious reasons)</li>
												<li>No logos, links or contact details</li>
												<li>No slideshows or presentations</li>
											</ul>
											<h2 class="pt-4">Content</h2>
											<ul class="pt-2">
												<li>Greet your students warmly</li>
												<li>Highlight any teaching certification</li>
												<li>Present your tutoring experience</li>
												<li>Invite students to book a lesson</li>
											</ul>
											<h2 class="pt-4">Example</h2>
											<ul class="pt-2">
												<li>Profile introduction video example</li>
											</ul>
										</div>
									</div>
								</div>
							</div>

							<div class="save-changes">
								<button type="submit" name="videoSub" value="videoSub">Save Changes</button>
							</div>
						</div>
					</form>
				</div>

				<div class="tab-pane fade <?php echo (isset($getVal) && $getVal == 'background' ? 'show active' : "") ?>" id="tab-5"> 

					<div class="box">
						<div class="tab-title">
							<h2>Profile Verification</h2>
						</div>
						<div class="row justify-content-center">
							<div class="col-lg-7">
								<div class="box">
									<div class="verify-stat">
										<div class="verify-stat-icon"><i class="fa-solid fa-circle-check"></i></div>
										<div class="verify-stat-txt">
											<h5>Verified</h5>
											<p>See a blue verification badge next to your name on the “Find tutors” page</p>
										</div>
									</div>
									<div class="verify-stat green">
										<div class="verify-stat-icon"><i class="fa-solid fa-lock"></i></div>
										<div class="verify-stat-txt">
											<h5>Safe</h5>
											<p>We do not store your documents on our servers after verification is complete</p>
										</div>
									</div>
								</div> 
								<div class="modal theme-modal fade" id="modal-3">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="fw-500">Edit Spoken Language</h5>
												<div class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
											</div>
											<form method="post" action="{{url('admin/spoken_language/update_spoken_language')}}">
												@csrf
												<div class="modal-body ps-5 pe-5">
													<input type="hidden" name="id" value="id" class="data_id" id="data_check_update_id">
													<div class="inp-outer">
														<label for="">Spoken Language</label>
														<input class="input" id="data_check_update" type="text" name="spoken_language" placeholder=""  >
													</div>
													<div class="modal-btn-group">
														<button class="site-link sm" data-bs-dismiss="modal" type="submit">Save</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>  
								<div class="mt-5 box">
									<button type="button" class="btn btn-info btn-sm educationBtn" style="float: right;margin: 5px;color: #FFF;background: #ff6c0b;border: none;">Add Education</button>
									<div class="inp-block">
										<h5>Education List</h5>
										<table class="table table-striped">
											<tr>
												<th>Document Image</th>
												<th>University</th>
												<th>Degree</th>
												<th>Degree Type</th>
												<th>Action</th>
											</tr>
											<?php 
											if(isset($getEgducation) && $getEgducation !=""){
												foreach ($getEgducation as $key => $value) { ?>
													<tr>
														<td><img src="{{url('/')}}/public/educations/{{$value->degree_verification_pic}}" alt="" style="width: 50px;border-radius: 50%;height: 50px;"> </td>
														<td><?php echo $value->university_name ?></td>
														<td><?php echo $value->degree_name ?></td>
														<td><?php echo $value->degree_type ?></td>
														<td>
															<!-- <a class="edit" href="#" data-id="{{$value->id}}" data-bs-target="#modal-3" data-bs-toggle="modal">Edit</a> -->
															<a class="delete btn btn-danger btn-sm" href="{{url('/')}}/delete_education/{{$value->id}}" onclick="return confirm('Are you sure ?');"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php }
											}
											?> 
										</table>

									</div>
								</div>
								<div class="mt-5 box educationDiv" style="display: none;">
									<div class="inp-block">
										<h5>Education</h5>
										<form method="post" action="{{url('/profile')}}" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="id" value="{{$listUser[0]->user_id}}"> 
											<div class="field_wrapper">
												<div class="block-inp-wrap">
													<label for="">University</label>
													<input class="block-inp" name="university_name[]" type="text" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Degree</label>
													<input class="block-inp" name="degree_name[]" type="text" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Degree Type</label>
													<input type="text" name="degree_type[]" class="block-inp" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Specialization</label>
													<input class="block-inp" name="specialization[]" type="text" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Year of Study</label>
													<div class="row">
														<div class="col-6">
															<select class="block-inp" name="year_of_study[]"  required>
																<option value="">Start Year</option>
																<?php 
																$firstYear = (int)date('Y') - 63;
																$lastYear = $year = date("Y"); 
																for($i=$firstYear;$i<=$lastYear;$i++)
																{
																	echo '<option value='.$i.'>'.$i.'</option>';
																}
																?>
															</select>
														</div>
														<div class="col-6">
															<select class="block-inp" name="year_of_study_end[]" required>
																<option value="">End Year</option>
																<?php 
																$firstYear = (int)date('Y') - 63;
																$lastYear = $year = date("Y"); 
																for($i=$firstYear;$i<=$lastYear;$i++)
																{
																	echo '<option value='.$i.'>'.$i.'</option>';
																}
																?>
															</select>
														</div>
													</div>
												</div>

												<div class="block-inp-wrap">
													<div class="verify-stat gery">
														<div class="verify-stat-icon"><i class="fa-solid fa-file-lines"></i></div>
														<div class="verify-stat-txt">
															<h5>Degree Verification</h5>
															<p>Upload most recent degree/certificate for profile verification</p>
														</div>
													</div>
												</div>
												<div class="up-image">
													<p class="txt-blue"><i class="fa-solid fa-upload"></i></p>
													<p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD IMAGE</span></p>
													<input type="file" name="degree_verification_pic[]" class="degree_verification_pic" required>
												</div><br/>
												<div class="degree_verification_pic_out" > </div>
											</div>
											<div class="add-btn add_button"><i class="fa-solid fa-circle-plus  "></i> Add Education</div> 
											<hr>
											<div class="block-inp-wrap text-center">
												<button class="link-bdr" name="education" value="education">Save</button>
											</div>
										</form>
									</div>
								</div> 

								<div class="mt-5 box ">
									<button type="button" class="btn btn-info btn-sm certificateBtn" style="float: right;margin: 5px;color: #FFF;background: #ff6c0b;border: none;">Add Certificate</button>
									<div class="inp-block">
										<h5>Certificate List</h5>
										<table class="table table-striped">
											<tr>
												<th>Certificate Name</th>
												<th>Description</th> 
												<th>Issued By</th> 
												<th>Action</th>
											</tr>
											<?php 
											if(isset($getCertificate) && $getCertificate !=""){
												foreach ($getCertificate as $key => $value) { ?>
													<tr>
														<td><?php echo $value->certificate_name ?></td>
														<td><?php echo $value->description ?></td> 
														<td><?php echo $value->issued_by ?></td> 
														<td> 
															<a class="delete btn btn-danger btn-sm" href="{{url('/')}}/delete_certificate/{{$value->id}}" onclick="return confirm('Are you sure ?');"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php }
											}
											?> 
										</table>
									</div>
								</div>


								<div class="mt-5 box certificateDiv" style="display: none;">
									<div class="inp-block">
										<h5>Certification</h5>
										<form method="post" action="{{url('/profile')}}" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="id" value="{{$listUser[0]->user_id}}">
											<div class="field_wrapper_certificate">
												<div class="block-inp-wrap">
													<label for="">Certificate</label>
													<input class="block-inp" type="text" name="certificate_name[]" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Description</label>
													<input class="block-inp" type="text" name="description[]" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Issued By</label>
													<input class="block-inp" type="text" name="issued_by[]" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Year of Study</label>
													<div class="row">
														<div class="col-6">
															<select class="block-inp" name="year_of_study[]"  required>
																<option value="">Start Year</option>
																<?php 
																$firstYear = (int)date('Y') - 63;
																$lastYear = $year = date("Y"); 
																for($i=$firstYear;$i<=$lastYear;$i++)
																{
																	echo '<option value='.$i.'>'.$i.'</option>';
																}
																?>
															</select>
														</div>
														<div class="col-6">
															<select class="block-inp" name="year_of_study_end[]" required>
																<option value="">End Year</option>
																<?php 
																$firstYear = (int)date('Y') - 63;
																$lastYear = $year = date("Y"); 
																for($i=$firstYear;$i<=$lastYear;$i++)
																{
																	echo '<option value='.$i.'>'.$i.'</option>';
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="block-inp-wrap">
													<div class="verify-stat gery">
														<div class="verify-stat-icon"><i class="fa-solid fa-file-lines"></i></div>
														<div class="verify-stat-txt">
															<h5>Get a "Certificate Verified" Badge</h5>
															<p>Upload your certificate to increase the credibility of your profile. </p>
														</div>
													</div>
												</div>
												<div class="up-image">
													<p class="txt-blue"><i class="fa-solid fa-upload"></i></p>
													<p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD Certificate</span></p>
													<input type="file" name="certificate_verified_pic[]" class="certificate_verified_pic" required>
												</div>
												<div id="certificate_verified_pic_out"></div>
											</div>
											<div class="add-btn add_button_certificate"><i class="fa-solid fa-circle-plus"></i> Add another certificate</div>
											<hr>
											<div class="block-inp-wrap text-center">
												<button type="submit" name="certificate" value="certificate" class="link-bdr">Save</button>
											</div>
										</form>
									</div>
								</div>

								<div class="mt-5 box">
									<button type="button" class="btn btn-info btn-sm experienceBtn" style="float: right;margin: 5px;color: #FFF;background: #ff6c0b;border: none;">Add Experience</button>
									<div class="inp-block">
										<h5>Experience List</h5>
										<table class="table table-striped">
											<tr>
												<th>Company Name</th>
												<th>Position</th> 
												<th>Action</th>
											</tr>
											<?php 
											if(isset($getExperience) && $getExperience !=""){
												foreach ($getExperience as $key => $value) { ?>
													<tr>
														<td><?php echo $value->company_name ?></td>
														<td><?php echo $value->position ?></td> 
														<td> 
															<a class="delete btn btn-danger btn-sm" href="{{url('/')}}/delete_experience/{{$value->id}}" onclick="return confirm('Are you sure ?');"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php }
											}
											?> 
										</table>
									</div>
								</div>

								<div class="mt-5 box experienceDiv" style="display: none;">
									<div class="inp-block">
										<h5>Experience</h5>
										<form method="post" action="{{url('/profile')}}" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="id" value="{{$listUser[0]->user_id}}"> 
											<div class="field_wrapper_experience">
												<div class="block-inp-wrap">
													<label for="">Company</label>
													<input class="block-inp" type="text" name="company_name[]" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Position</label>
													<input class="block-inp" type="text" name="position[]" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Period of Employment</label>
													<div class="row">
														<div class="col-6">
															<select class="block-inp" name="period_of_employment[]" required>
																<option value="">Start Year</option>
																<?php 
																$firstYear = (int)date('Y') - 43;
																$lastYear = $year = date("Y"); 
																for($i=$firstYear;$i<=$lastYear;$i++)
																{
																	echo '<option value='.$i.'>'.$i.'</option>';
																}
																?>
															</select>
														</div>
														<div class="col-6">
															<select class="block-inp" name="period_of_employment_end[]" required>
																<option value="">End Year</option>
																<?php 
																$firstYear = (int)date('Y') - 43;
																$lastYear = $year = date("Y"); 
																for($i=$firstYear;$i<=$lastYear;$i++)
																{
																	echo '<option value='.$i.'>'.$i.'</option>';
																}
																?>
															</select>
														</div>
													</div>
												</div> 
											</div>
											<div class="add-btn add_button_experience"><i class="fa-solid fa-circle-plus"></i> Add another Experience</div>
											<hr>
											<div class="block-inp-wrap text-center">
												<button class="link-bdr" type="submit" name="experience" value="experience" >Save</button>
											</div>
										</form>
									</div>
								</div>

								<div class="mt-5 box">
									<button type="button" class="btn btn-info btn-sm identityBtn" style="float: right;margin: 5px;color: #FFF;background: #ff6c0b;border: none;">Add Identity</button>
									<div class="inp-block">
										<h5>Identity Verification List</h5>
										<table class="table table-striped">
											<tr>
												<th>Issued by Country</th>
												<th>Type of Document</th>
												<th>Document identification number</th>
												<th>Document expiry date</th>
												<th>Action</th>
											</tr>
											<?php 
											if(isset($getIdentification) && $getIdentification !=""){
												foreach ($getIdentification as $key => $value) { ?>
													<tr>
														<td><?php echo $value->issued_by_country ?></td>
														<td><?php echo $value->type_of_document ?></td>
														<td><?php echo $value->identification_number ?></td>
														<td><?php echo $value->expiry_date ?></td>
														<td>
															<!-- <a class="edit" href="#" data-id="{{$value->id}}" data-bs-target="#modal-3" data-bs-toggle="modal">Edit</a> -->
															<a class="delete btn btn-danger btn-sm" href="{{url('/')}}/delete_identity/{{$value->id}}" onclick="return confirm('Are you sure ?');"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php }
											}
											?> 
										</table>
									</div>
								</div>

								<div class="mt-5 box identityDiv" style="display: none;">
									<div class="inp-block">
										<h5>Identity Verification</h5>
										<form method="post" action="{{url('/profile')}}" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="id" value="{{$listUser[0]->user_id}}"> 
											<div class="field_wrapper_identity">
												<div class="block-inp-wrap">
													<label for="">Issued by Country</label>
													<input class="block-inp" type="text" name="issued_by_country[]" required>
												</div>
												<div class="block-inp-wrap">
													<label for="">Type of Document</label>
													<select class="block-inp" id="type_of_document" name="type_of_document[]" required>
														<option value="">Type of Document</option>
														<option value="1"  >Pan Card</option>
														<option value="2"  >Adhar Card</option>
														<option value="3"  >Driving License</option>
														<option value="4"  >Passport</option>
													</select>
												</div>
												<div class="block-inp-wrap">
													<label for="">Document identification number</label>
													<input class="block-inp" type="text" name="identification_number[]" required>
												</div> 
												<div class="block-inp-wrap">
													<label for="">Document expiry date</label>
													<div class="row">
														<div class="col-6">
															<select class="block-inp" name="expiry_date[]" required>
																<option value="">Select Day</option>
																<?php 
																for($i=1;$i<=30;$i++)
																{
																	echo '<option value='.$i.'>'.$i.'</option>';
																}
																?>
															</select>
														</div>
														<div class="col-6">
															<select class="block-inp" name="expiry_date_end[]" required>
																<option value="">Select Year</option>
																<?php 
																$firstYear = (int)date('Y') - 43;
																$lastYear = $year = date("Y"); 
																for($i=$firstYear;$i<=$lastYear;$i++)
																{
																	echo '<option value='.$i.' >'.$i.'</option>';
																}
																?>
															</select>
														</div>
													</div>
												</div>

												<div class="block-inp-wrap">
													<div class="verify-stat gery">
														<div class="verify-stat-icon"><i class="fa-solid fa-file-lines"></i></div>
														<div class="verify-stat-txt">
															<h5>Identity Document</h5>
															<p>Upload Identity Document for profile verification</p>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-lg-6">
														<div class="up-image">
															<p class="txt-blue"><i class="fa-solid fa-upload"></i></p>
															<p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD Front</span></p>
															<input type="file" name="identity_document_front[]" class="identity_document_front" required>
														</div><br> 
														<div class="identity_document_front_out"></div> 
													</div>


													<div class="col-lg-6"> 
														<div class="up-image">
															<p class="txt-blue"><i class="fa-solid fa-upload"></i></p>
															<p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD Back</span></p>
															<input type="file" name="identity_document_back[]" class="identity_document_back" required>
														</div> <br>
														<div class="identity_document_back_out"></div> 
													</div>
												</div>
											</div>
											<div class="add-btn add_button_identity"><i class="fa-solid fa-circle-plus"></i> Add another Identification</div>
											<div class="block-inp-wrap text-center">
												<button class="link-bdr" type="submit" name="identification" value="identification">Save</button>
											</div>
										</form>
										<hr>

									</div>
								</div>

							</div>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</section>


@include('/dashboard/common/footer') 
<script type="text/javascript">
	$('#subject').val([<?php echo $listUser[0]->subject; ?>]);
	$('#type_of_document').val([<?php echo (isset($getIdentification[0]->type_of_document) && $getIdentification[0]->type_of_document ? $getIdentification[0]->type_of_document : ""); ?>]);
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
	/*var loadFile = function(event) {
		var output = document.getElementById('imagePre');
		output.src = URL.createObjectURL(event.target.files[0]);
		output.onload = function() {
			URL.revokeObjectURL(output.src) 
		}
	};*/

	$('.chooseIMG').change(function(){
		$(".imagePre").html('');
		for (var i = 0; i < $(this)[0].files.length; i++) {
			$(".imagePre").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" style="width:100%;height:250px;"/>');
		}
	});


	$(document).on("change", ".file_multi_video", function(evt) {
		var $source = $('#video_here');
		$source[0].src = URL.createObjectURL(this.files[0]);
		$source.parent()[0].load();
	});

	

	
	$("body").delegate(".identity_document_front", "change", function(){
		$(".identity_document_front_out").html('');
		for (var i = 0; i < $(this)[0].files.length; i++) {
			$(".identity_document_front_out").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" />');
		}
	});

	
	$("body").delegate(".identity_document_back", "change", function(){
		$(".identity_document_back_out").html('');
		for (var i = 0; i < $(this)[0].files.length; i++) {
			$(".identity_document_back_out").append('<img src="'+window.URL.createObjectURL(this.files[i])+'"/>');
		}
	});


	$("body").delegate(".degree_verification_pic", "change", function(){
		$(".degree_verification_pic_out").html('');
		for (var i = 0; i < $(this)[0].files.length; i++) {
			$(".degree_verification_pic_out").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" />');
		}
	});


	
	$("body").delegate(".certificate_verified_pic", "change", function(){
		$("#certificate_verified_pic_out").html('');
		for (var i = 0; i < $(this)[0].files.length; i++) {
			$("#certificate_verified_pic_out").append('<img src="'+window.URL.createObjectURL(this.files[i])+'"  />');
		}
	});



	$('#phone').keyup(function(e){
		if (/\D/g.test(this.value)){ 
			this.value = this.value.replace(/\D/g, '');
		}
	});

</script>

<script type="text/javascript">
	$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $("body").delegate(".degree_verification_pic_"+x+"", "change", function(){
            	$(".degree_verification_pic_out_"+x+"").html('');
            	for (var i = 0; i < $(this)[0].files.length; i++) {
            		$(".degree_verification_pic_out_"+x+"").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" style="width:100%;height:200px;"/>');
            	}
            });
            $(wrapper).append('<div class="field_wrapper"><div class="block-inp-wrap"><label for="">University</label><input class="block-inp" name="university_name[]" required type="text"></div><div class="block-inp-wrap"><label for="">Degree</label><input class="block-inp" name="degree_name[]" type="text" required></div><div class="block-inp-wrap"><label for="">Degree Type</label><input type="text" name="degree_type[]" class="block-inp" required></div><div class="block-inp-wrap"><label for="">Specialization</label><input class="block-inp" name="specialization[]" type="text" required></div><div class="block-inp-wrap"><label for="">Year of Study</label><div class="row"><div class="col-6"><select class="block-inp" name="year_of_study[]" required><option value="">Start Year</option><?php 
            	$firstYear = (int)date('Y') - 43;
            	$lastYear = $year = date("Y"); 
            	for($i=$firstYear;$i<=$lastYear;$i++)
            	{
            		echo '<option value='.$i.'>'.$i.'</option>';
            	}
            	?></select></div><div class="col-6"><select class="block-inp" name="year_of_study_end[]"  required><option value="">End Year</option><?php 
            	$firstYear = (int)date('Y') - 43;
            	$lastYear = $year = date("Y"); 
            	for($i=$firstYear;$i<=$lastYear;$i++)
            	{
            		echo '<option value='.$i.'>'.$i.'</option>';
            	}
    ?></select></div></div></div><div class="block-inp-wrap"><div class="verify-stat gery"><div class="verify-stat-icon"><i class="fa-solid fa-file-lines"></i></div><div class="verify-stat-txt"><h5>Degree Verification</h5><p>Upload most recent degree/certificate for profile verification</p></div></div></div><div class="up-image"><p class="txt-blue"><i class="fa-solid fa-upload"></i></p><p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD IMAGE</span></p><input type="file" name="degree_verification_pic[]" class="degree_verification_pic_'+x+'" required></div><div class="degree_verification_pic_out_'+x+'" > </div><button class="remove_button_education btn btn-danger btn-sm" style="float: right;margin: 10px;">Remove</button></div>'); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_education', function(e){
    	e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    }); 


    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button_certificate'); //Add button selector
    var wrapper2 = $('.field_wrapper_certificate'); //Input field wrapper
    
    var y = 1; 

    $(addButton2).click(function(){
    	if(y < maxField2){ 
    		y++; 

    		$("body").delegate(".certificate_verified_pic_"+y+"", "change", function(){
    			$("#certificate_verified_pic_out_"+y+"").html('');
    			for (var i = 0; i < $(this)[0].files.length; i++) {
    				$("#certificate_verified_pic_out_"+y+"").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" style="width:100%;height:200px;" />');
    			}
    		}); 
    		$(wrapper2).append('<div class="field_wrapper_certificate"><div class="block-inp-wrap"><label for="">Certificate</label><input class="block-inp" type="text" name="certificate_name[]" required></div><div class="block-inp-wrap"><label for="">Description</label><input class="block-inp" type="text" name="description[]" required></div><div class="block-inp-wrap"><label for="">Issued By</label><input class="block-inp" type="text" name="issued_by[]" required></div><div class="block-inp-wrap"><label for="">Year of Study</label><div class="row"><div class="col-6"><select class="block-inp" name="year_of_study[]" required><option value="">Start Year</option><?php 
    			$firstYear = (int)date('Y') - 43;
    			$lastYear = $year = date("Y"); 
    			for($i=$firstYear;$i<=$lastYear;$i++)
    			{
    				echo '<option value='.$i.'>'.$i.'</option>';
    			}
    			?></select></div><div class="col-6"><select class="block-inp" name="year_of_study_end[]" required><option value="">End Year</option><?php 
    			$firstYear = (int)date('Y') - 43;
    			$lastYear = $year = date("Y"); 
    			for($i=$firstYear;$i<=$lastYear;$i++)
    			{
    				echo '<option value='.$i.'>'.$i.'</option>';
    			}
    			?></select></div></div></div><div class="block-inp-wrap"><div class="verify-stat gery"><div class="verify-stat-icon"><i class="fa-solid fa-file-lines"></i></div><div class="verify-stat-txt"><h5>Get a "Certificate Verified" Badge</h5><p>Upload your certificate to increase the credibility of your profile. </p></div></div></div><div class="up-image"><p class="txt-blue"><i class="fa-solid fa-upload"></i></p><p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD Certificate</span></p><input type="file" name="certificate_verified_pic[]" class="certificate_verified_pic_'+y+'" required></div><div id="certificate_verified_pic_out_'+y+'" style="100%;250px!important;"></div><button class="remove_button_certificate btn btn-danger btn-sm" style="float: right;margin: 10px;">Remove</button></div>'); 
    	}
    });
    $(wrapper2).on('click', '.remove_button_certificate', function(e){
    	e.preventDefault();
    	$(this).parent('div').remove();
    	y--; 
    }); 

    var maxField1 = 10; //Input fields increment limitation
    var addButton1 = $('.add_button_experience'); //Add button selector
    var wrapper1 = $('.field_wrapper_experience'); //Input field wrapper
    var fieldHTML1 = '<div class="field_wrapper_experience"><div class="block-inp-wrap"><label for="">Company</label><input class="block-inp" type="text" name="company_name[]" required></div><div class="block-inp-wrap"><label for="">Position</label><input class="block-inp" type="text" name="position[]" required></div><div class="block-inp-wrap"><label for="">Period of Employment</label><div class="row"><div class="col-6"><select class="block-inp" name="period_of_employment[]" required><option value="">Start Year</option><?php 
    $firstYear = (int)date('Y') - 43;
    $lastYear = $year = date("Y"); 
    for($i=$firstYear;$i<=$lastYear;$i++)
    {
    	echo '<option value='.$i.'>'.$i.'</option>';
    }
    ?></select></div><div class="col-6"><select class="block-inp" name="period_of_employment_end[]" required><option value="">End Year</option><?php 
    $firstYear = (int)date('Y') - 43;
    $lastYear = $year = date("Y"); 
    for($i=$firstYear;$i<=$lastYear;$i++)
    {
    	echo '<option value='.$i.'>'.$i.'</option>';
    }
    ?></select></div></div></div> <button class="remove_button_experience btn btn-danger btn-sm" style="float: right;margin: 10px;">Remove</button></div>';

    var z = 1; 
    $(addButton1).click(function(){
    	if(z < maxField1){ 
    		z++; 
    		$(wrapper1).append(fieldHTML1); 
    	}
    });
    $(wrapper1).on('click', '.remove_button_experience', function(e){
    	e.preventDefault();
    	$(this).parent('div').remove();
    	z--; 
    });


    var maxField3 = 10; //Input fields increment limitation
    var addButton3 = $('.add_button_identity'); //Add button selector
    var wrapper3 = $('.field_wrapper_identity'); //Input field wrapper
    var j = 1; 
    $(addButton3).click(function(){
    	if(j < maxField3){ 
    		j++; 
    		$("body").delegate(".identity_document_front_"+j+"", "change", function(){
    			$(".identity_document_front_out_"+j+"").html('');
    			for (var i = 0; i < $(this)[0].files.length; i++) {
    				$(".identity_document_front_out_"+j+"").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" style="width:100%;height:200px;"/>');
    			}
    		});

    		$("body").delegate(".identity_document_back_"+j+"", "change", function(){
    			$(".identity_document_back_out_"+j+"").html('');
    			for (var i = 0; i < $(this)[0].files.length; i++) {
    				$(".identity_document_back_out_"+j+"").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" style="width:100%;height:200px;"/>');
    			}
    		});

    		$(wrapper3).append('<div class="field_wrapper_identity"><div class="block-inp-wrap"><label for="">Issued by Country</label><input class="block-inp" type="text" name="issued_by_country[]" required></div><div class="block-inp-wrap"><label for="">Type of Document</label><select class="block-inp" id="type_of_document" name="type_of_document[]" required><option value="">Type of Document</option><option value="1">Pan Card</option><option value="2" >Adhar Card</option><option value="3" >Driving License</option><option value="4" >Passport</option></select></div><div class="block-inp-wrap"><label for="">Document identification number</label><input class="block-inp" type="text" name="identification_number[]" required></div><div class="block-inp-wrap"><label for="">Document expiry date</label><div class="row"><div class="col-6"><select class="block-inp" name="expiry_date[]" required><option value="">Select Day</option><?php 
    			for($i=1;$i<=30;$i++)
    			{
    				echo '<option value='.$i.'>'.$i.'</option>';
    			}
    			?>
    			</select></div><div class="col-6"><select class="block-inp" name="expiry_date_end[]" required><option value="">Select Year</option><?php 
    			$firstYear = (int)date('Y') - 43;
    			$lastYear = $year = date("Y"); 
    			for($i=$firstYear;$i<=$lastYear;$i++)
    			{
    				echo '<option value='.$i.' >'.$i.'</option>';
    			}
    			?>
    			</select></div></div></div><div class="block-inp-wrap"><div class="verify-stat gery"><div class="verify-stat-icon"><i class="fa-solid fa-file-lines"></i></div><div class="verify-stat-txt"><h5>Identity Document</h5><p>Upload Identity Document for profile verification</p></div></div></div><div class="row"><div class="col-lg-6"><div class="up-image"><p class="txt-blue"><i class="fa-solid fa-upload"></i></p><p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD Front</span></p><input type="file" name="identity_document_front[]"  class="identity_document_front_'+j+'" required></div><br> <div class="identity_document_front_out_'+j+'"></div> </div><div class="col-lg-6"><div class="up-image"><p class="txt-blue"><i class="fa-solid fa-upload"></i></p><p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD Back</span></p><input type="file" name="identity_document_back[]" class="identity_document_back_'+j+'" required></div><br><div class="identity_document_back_out_'+j+'"></div></div></div><button class="remove_button_identity btn btn-danger btn-sm" style="float: right;margin: 10px;">Remove</button></div>'); 
    	}
    });
    $(wrapper3).on('click', '.remove_button_identity', function(e){
    	e.preventDefault();
    	$(this).parent('div').remove();
    	j--; 
    });
});

var isClicked = false;
var isClicked1 = false;
$('.educationBtn').on('click',function(){
	$('.educationDiv').toggle();
	if(isClicked == false){
		isClicked = true;
		$('.educationBtn').text('X');
	} else {
		isClicked = false;
		$('.educationBtn').text('Add Education');
	} 
})
$('.certificateBtn').on('click',function(){
	$('.certificateDiv').toggle();
	if(isClicked1 == false){
		isClicked1 = true;
		$('.certificateBtn').text('X');
	} else {
		isClicked1 = false;
		$('.certificateBtn').text('Add Certificate');
	} 
})
isClicked2 = false;
$('.experienceBtn').on('click',function(){
	$('.experienceDiv').toggle();
	if(isClicked2 == false){
		isClicked2 = true;
		$('.experienceBtn').text('X');
	} else {
		isClicked2 = false;
		$('.experienceBtn').text('Add Experience');
	} 
})
isClicked3 = false;
$('.identityBtn').on('click',function(){
	$('.identityDiv').toggle();
	if(isClicked3 == false){
		isClicked3 = true;
		$('.identityBtn').text('X');
	} else {
		isClicked3 = false;
		$('.identityBtn').text('Add Identity');
	} 
})




  /*$('document').ready(function(){
    $('.edit').on('click', function(event) {
     event.preventDefault();
     var post_id = $(this).data('id'); 
     $.ajax({
      headers: {
        'X-CSRF-TOKEN': '<?php //echo csrf_token() ?>'
      },
      type : 'POST',
      url : "{{ url('/admin/spoken_language/get_spoken_language') }}",
      data : {'id': post_id},
      
      dataType : 'json',
      success : function(result){ 
        $('#data_check_update').val(result.spoken_language);
        $('#data_check_update_id').val(result.id);
      }
    });     
   });
});*/ 

</script>