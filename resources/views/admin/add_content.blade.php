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
			<form method="post" action="{{url('/admin/save_content')}}" enctype="multipart/form-data">
				@csrf
				<h4 class="fw-700 mt-3" style="text-align: center;">Section 1</h4>

				<div class="row field_wrapper_main">
					<?php 
					$get_section1 = $Homepagedata[0]->sec_data1;
					$get_section_all = json_decode($get_section1);
					?>
					<?php 
					$sec1_count=1;
					foreach ($get_section_all as $key => $get_section_value) {
						?>
						<div class="row field_wrapper_inner">  
							<div class="col-sm-6 col-lg-4">
								<div class="inp-outer">
									<label for="">Icon</label>
									<input class="input" type="file" name="icon[]">
									<?php if(isset($get_section_value->icon)){ ?>
										<input type="hidden" name="hidden_icon_file1[]" value="{{$get_section_value->icon}}">
										<img src="{{url('/')}}/public/images/{{$get_section_value->icon}}" alt="" width="100" height="100">
									<?php } ?>
								</div>
							</div>
							<div class="col-sm-6 col-lg-4">
								<div class="inp-outer">
									<label for="">Title</label>
									<input class="input" type="text" name="title1[]" value="{{$get_section_value->title}}">
								</div>
							</div>
							<div class="col-sm-12 col-lg-12">
								<div class="inp-outer">
									<label for="">Description</label>
									<textarea class="input" name="description1[]">{{$get_section_value->description}}</textarea>
								</div>
							</div>
							<?php if($sec1_count!='1'){ ?>
								<div class="add-btn remove_button1"  style="cursor: pointer;"><i class="fa-solid fa-circle-minus  "></i> Remove</div>
							<?php } ?>


						</div>
						<?php $sec1_count++; } ?>


					</div>

					<div class="add-btn add_button1" style="cursor: pointer;"><i class="fa-solid fa-circle-plus "></i> Add</div>
					<hr>
					<h4 class="fw-700 mt-3" style="text-align: center;">Section 2</h4>

					<div class="row sec2_field_wrapper_main">
						<?php 
						$get_section2 = $Homepagedata[0]->sec_data2;
						$get_section2_all = json_decode($get_section2);
						?>
						<div class="col-sm-6 col-lg-4">
							<div class="inp-outer">
								<label for="">Image</label>
								<input class="input" type="file" name="image">
								<?php if(isset($Homepagedata[0]->img_sec2)){ ?>
									<input type="hidden" name="hidden_icon_file" value="{{$Homepagedata[0]->img_sec2}}">
									<img src="{{url('/')}}/public/images/{{$Homepagedata[0]->img_sec2}}" alt="" width="100" height="100">
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-6 col-lg-4">
							<div class="inp-outer">
								<label for="">Main Title</label>
								<input class="input" type="text" name="main_title" value="{{$Homepagedata[0]->main_title_sec2}}">
							</div>
						</div>
						<div class="col-sm-6 col-lg-4">
							<div class="inp-outer">
								<label for="">Button Url</label>
								<input class="input" type="text" name="url" value="{{$Homepagedata[0]->url_sec2}}">
							</div>
						</div>

						<div class="sec2_field_wrapper_main1">
							<?php 
							$sec2_count=1;
							foreach ($get_section2_all as $key => $get_section_values) {
								?>

								<div class="row sec2_field_wrapper_inner">  
									<div class="col-sm-6 col-lg-4">
										<div class="inp-outer">
											<label for="">Title</label>
											<input class="input" type="text" name="title2[]" value="{{$get_section_values->title}}">
										</div>
									</div>
									<div class="col-sm-6 col-lg-4">
										<div class="inp-outer">
											<label for="">Description</label>
											<textarea class="input" name="description2[]">{{$get_section_values->description}}</textarea>
										</div>
									</div>
									<?php if($sec2_count!='1'){ ?>
										<div class="add-btn remove_button2"  style="cursor: pointer;"><i class="fa-solid fa-circle-plus  "></i> Remove</div>
									<?php } ?>
								</div>
								<?php $sec2_count++; } ?>
							</div>
							<div class="add-btn add_button2" style="cursor: pointer;"><i class="fa-solid fa-circle-plus "></i> Add</div>


							<div class="col-sm-12 col-lg-12">
								<div class="inp-outer">
									<div class="inp-outer">
										<label for="">Main Description</label>
										<textarea class="input" name="content">{{$Homepagedata[0]->content_sec2}}</textarea>
									</div>
								</div>
							</div>
						</div>

						<hr>
						<h4 class="fw-700 mt-3" style="text-align: center;">Section 3</h4>

						<div class="row field_wrapper_main3">
							<?php 
							$get_section3 = $Homepagedata[0]->sec_data3;
							$get_section3_all = json_decode($get_section3);
							?>
							<?php 
							$sec3_count=1;
							foreach ($get_section3_all as $key => $get_section3_value) {
								?>
								<div class="row field_wrapper_inner3">  
									<div class="col-sm-6 col-lg-4">
										<div class="inp-outer">
											<label for="">Title</label>
											<input class="input" type="text" name="title3[]" value="{{$get_section3_value->title}}">
										</div>
									</div>
									<div class="col-sm-12 col-lg-12">
										<div class="inp-outer">
											<label for="">Description</label>
											<textarea class="input" name="description3[]">{{$get_section3_value->description}}</textarea>
										</div>
									</div>
									<?php if($sec3_count!='1'){ ?>
										<div class="add-btn remove_button3"  style="cursor: pointer;"><i class="fa-solid fa-circle-minus  "></i> Remove</div>
									<?php } ?>


								</div>
								<?php $sec3_count++; } ?>


							</div>

							<div class="add-btn add_button3" style="cursor: pointer;"><i class="fa-solid fa-circle-plus "></i> Add</div>

							<hr>
							<h4 class="fw-700 mt-3" style="text-align: center;">Section 4</h4>

							<div class="row sec2_field_wrapper_main">
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Image</label>
										<input class="input" type="file" name="bg_img">
										<?php if(isset($Homepagedata[0]->sec4_img)){ ?>
											<input type="hidden" name="hidden_bg_img" value="{{$Homepagedata[0]->sec4_img}}">
											<img src="{{url('/')}}/public/images/{{$Homepagedata[0]->sec4_img}}" alt="" width="100" height="100">
										<?php } ?>
									</div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Title</label>
										<input class="input" type="text" name="title4" value="{{$Homepagedata[0]->sec4_title}}">
									</div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Description</label>
										<input class="input" type="text" name="description4" value="{{$Homepagedata[0]->sec4_desc}}">
									</div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Button Url</label>
										<input class="input" type="text" name="url4" value="{{$Homepagedata[0]->sec4_url}}">
									</div>
								</div>
							</div>

							<hr>
							<h4 class="fw-700 mt-3" style="text-align: center;">Section 5</h4>

							<div class="row sec2_field_wrapper_main">
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Image</label>
										<input class="input" type="file" name="bck_img">
										<?php if(isset($Homepagedata[0]->sec5_file)){ ?>
											<input type="hidden" name="hidden_bck_img" value="{{$Homepagedata[0]->sec5_file}}">
											<img src="{{url('/')}}/public/images/{{$Homepagedata[0]->sec5_file}}" alt="" width="100" height="100">
										<?php } ?>
									</div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Title</label>
										<input class="input" type="text" name="title5" value="{{$Homepagedata[0]->sec5_heading}}">
									</div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Description</label>
										<input class="input" type="text" name="description5" value="{{$Homepagedata[0]->sec5_desc}}">
									</div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Button Url 1</label>
										<input class="input" type="text" name="playstore" value="{{$Homepagedata[0]->sec5_play_store_url}}">
									</div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Button Url 2</label>
										<input class="input" type="text" name="applestore" value="{{$Homepagedata[0]->sec5_apple_store_url}}">
									</div>
								</div>
							</div>

							<div class="update-btn" style="text-align: center;">
								<input type="submit" name="submit" class="site-link sm" value="Save">
							</div>

							

						</form>

					</div>
				</div>

				@include('/admin/common/footer')

				<script type="text/javascript">

					$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button1'); //Add button selector
    var wrapper = $('.field_wrapper_main'); //Input field wrapper
    var fieldHTML = '<div class="row field_wrapper_inner"><div class="col-sm-6 col-lg-4"><div class="inp-outer"><label for="">Icon</label><input class="input" type="file" name="icon[]" value=""></div></div><div class="col-sm-6 col-lg-4"><div class="inp-outer"><label for="">Title</label><input class="input" type="text" name="title1[]" value=""></div></div><div class="col-sm-12 col-lg-12"><div class="inp-outer"><label for="">Description</label><textarea class="input" name="description1[]"></textarea></div></div> <div class="add-btn remove_button1" style="cursor: pointer;"><i class="fa-solid fa-circle-minus"></i> Remove</div></div>';
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
    	if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button1', function(e){
    	e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    }); 
});

					$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button2'); //Add button selector
    var wrapper_sec2 = $('.sec2_field_wrapper_main1'); //Input field wrapper
    var fieldHTML_sec2 = '<div class="sec2_field_wrapper_inner"><div class="col-sm-6 col-lg-4"><div class="inp-outer"><label for="">Title</label><input class="input" type="text" name="title2[]" value=""></div></div><div class="col-sm-12 col-lg-12"><div class="inp-outer"><label for="">Description</label><textarea class="input" name="description2[]"></textarea></div></div><div class="add-btn remove_button2" style="cursor: pointer;"><i class="fa-solid fa-circle-minus"></i> Remove</div></div></div>';
    var q = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
    	if(q < maxField){ 
            q++; //Increment field counter
            $(wrapper_sec2).append(fieldHTML_sec2); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper_sec2).on('click', '.remove_button2', function(e){
    	e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        q--; //Decrement field counter
    }); 
});

					$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button3'); //Add button selector
    var wrapper_sec3 = $('.field_wrapper_main3'); //Input field wrapper
    var fieldHTML_sec3 = '<div class="field_wrapper_inner3"><div class="col-sm-6 col-lg-4"><div class="inp-outer"><label for="">Title</label><input class="input" type="text" name="title3[]" value=""></div></div><div class="col-sm-12 col-lg-12"><div class="inp-outer"><label for="">Description</label><textarea class="input" name="description3[]"></textarea></div></div><div class="add-btn remove_button3" style="cursor: pointer;"><i class="fa-solid fa-circle-minus"></i> Remove</div></div>';
    var r = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
    	if(r < maxField){ 
            r++; //Increment field counter
            $(wrapper_sec3).append(fieldHTML_sec3); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper_sec3).on('click', '.remove_button3', function(e){
    	e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        r--; //Decrement field counter
    }); 
});

</script>
