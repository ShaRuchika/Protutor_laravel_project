@include('/admin/common/header')
@include('/admin/common/sidebar')
<div class="main-wrapper">
	<div class="profile-back">
		<a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
	</div>
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
	<div>
		<div class="row">
			<form method="post" action="{{url('/admin/save_footer')}}" enctype="multipart/form-data">
				@csrf				
				<h4 class="fw-700 mt-3" style="text-align: center;">Footer</h4>

				<div class="row field_wrapper_main">
					<div class="row field_wrapper_inner">
						<div class="col-sm-6 col-lg-6"> 
							<div class="inp-outer">
								<label for="">Icon</label>
								<input class="input" type="file" name="icon">
								<?php if(isset($Footerdata->icon)){ ?>
									<input type="hidden" name="hidden_icon" value="{{$Footerdata->icon}}">
									<img src="{{url('/')}}/public/images/{{$Footerdata->icon}}" alt="" width="100" height="100">
								<?php } ?>
							</div> 
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="inp-outer">
								<label for="">Title</label>
								<input class="input" type="text" name="f_title" value="{{$Footerdata->title}}">
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="inp-outer">
								<label for="">Mail</label>
								<input class="input" type="text" name="f_mail" value="{{$Footerdata->email}}">
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="inp-outer">
								<label for="">Contact</label>
								<input class="input" type="text" name="f_contact" value="{{$Footerdata->contact}}">
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="inp-outer">
								<label for="">Copyright</label>
								<input class="input" type="text" name="f_copyright" value="{{$Footerdata->copyright}}">
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="inp-outer">
								<label for="">Description1</label>
								<input class="input" type="text" name="f_desc1" value="{{$Footerdata->desc1}}">
							</div>
						</div>
						<div class="col-sm-6 col-lg-6">
							<div class="inp-outer">
								<label for="">Description2</label>
								<input class="input" type="text" name="f_desc2" value="{{$Footerdata->desc2}}">
							</div>
						</div>
					</div>
					<div class="update-btn" style="text-align: center;">
						<input type="submit" name="submit" class="site-link sm" value="Save">
					</div>
				</div>
			</form>
		</div>
	</div>

	@include('/admin/common/footer')

