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
			<form method="post" action="{{url('/admin/save_support')}}" enctype="multipart/form-data">
				@csrf
				<h4 class="fw-700 mt-3" style="text-align: center;">Section 1</h4>

				<div class="row field_wrapper_main1">
					<?php 
					$get_sup_data1 = $Supportdata[0]->support_sec1;
					$get_sup_datas1 = json_decode($get_sup_data1);
					?>
					<?php 
					$sec1_count=1; 
					foreach ($get_sup_datas1 as $key => $sup_value1) {
						?>
						<div class="row field_wrapper_inner1">  
							<div class="col-sm-6 col-lg-4">
								<div class="inp-outer">
									<label for="">Title</label>
									<input class="input" type="text" name="title_sup1[]" value="{{$sup_value1->title}}">
								</div>
							</div>
							<div class="col-sm-12 col-lg-12">
								<div class="inp-outer">
									<label for="">Description</label>
									<textarea class="input" name="description_sup1[]">{{$sup_value1->description}}</textarea>
								</div>
							</div>
							<div class="col-sm-6 col-lg-4">
								<div class="inp-outer">
									<label for="">Url</label>
									<input class="input" type="text" name="url_sup1[]" value="{{$sup_value1->url}}">
								</div>
							</div>
							<?php if($sec1_count!='1'){ ?>
								<div class="add-btn remove_button1"  style="cursor: pointer;"><i class="fa-solid fa-circle-minus "></i> Remove</div>
							<?php } ?>
						</div>
						<?php $sec1_count++; } ?>
					</div>
					<div class="add-btn add_button1" style="cursor: pointer;"><i class="fa-solid fa-circle-plus "></i> Add</div>
					
					<h4 class="fw-700 mt-3" style="text-align: center;">Section 2</h4>

					<div class="row field_wrapper_main2">
						<?php 
						$get_sup_data2 = $Supportdata[0]->support_sec2;
						$get_sup_datas2 = json_decode($get_sup_data2);
						?>
						<?php 
						$sec2_count=1; 
						foreach ($get_sup_datas2 as $key => $sup_value2) {
							?>
							<div class="row field_wrapper_inner2">  
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Title</label>
										<input class="input" type="text" name="title_sup2[]" value="{{$sup_value2->title}}">
									</div>
								</div>
								<div class="col-sm-12 col-lg-12">
									<div class="inp-outer">
										<label for="">Description</label>
										<textarea class="input" name="description_sup2[]">{{$sup_value2->description}}</textarea>
									</div>
								</div>
								<?php if($sec2_count!='1'){ ?> 
									<div class="add-btn remove_button2"  style="cursor: pointer;"><i class="fa-solid fa-circle-minus "></i> Remove</div>
								<?php } ?>
							</div>
							<?php $sec2_count++; } ?>
						</div>
						<div class="add-btn add_button2" style="cursor: pointer;"><i class="fa-solid fa-circle-plus "></i> Add</div> <hr>

						<h4 class="fw-700 mt-3" style="text-align: center;">Section 3</h4>

						<div class="row field_wrapper_main">
							<div class="row field_wrapper_inner">  
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Live Chat Url</label>
										<input class="input" type="text" name="sec_url1" value="{{$Supportdata[0]->live_chat}}">
									</div>
								</div>
								<div class="col-sm-6 col-lg-4">
									<?php 
									$get_data = $Supportdata[0]->call_us;
									$get_data_all = json_decode($get_data);
									foreach ($get_data_all as $key => $dataValue1) {
										?>
										<div class="inp-outer">
											<label for="">Call Us Url</label>
											<input class="input" type="text" name="sec_url2[]" value="{{$dataValue1->url}}">
											<label for="">Contact no.</label>
											<input class="input" type="text" name="contact2[]" value="{{$dataValue1->contact}}">
											<label for="">Date & Time</label>
											<input class="input" type="text" name="time2[]" value="{{$dataValue1->time}}">
										</div>
									<?php } ?>
								</div>
								<div class="col-sm-6 col-lg-4">
									<div class="inp-outer">
										<label for="">Email id</label>
										<input class="input" type="text" name="id3" value="{{$Supportdata[0]->mail}}">
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
    var maxField1 = 15; //Input fields increment limitation
    var addButton1 = $('.add_button1'); //Add button selector
    var wrapper1 = $('.field_wrapper_main1'); //Input field wrapper
    var fieldHTML1 = '<div class="row field_wrapper_inner1">  <div class="col-sm-6 col-lg-4"><div class="inp-outer"><label for="">Title</label><input class="input" type="text" name="title_sup1[]" value=""></div></div><div class="col-sm-12 col-lg-12"><div class="inp-outer"><label for="">Description</label><textarea class="input" name="description_sup1[]"></textarea></div></div><div class="col-sm-6 col-lg-4"><div class="inp-outer"><label for="">Url</label><input class="input" type="text" name="url_sup1[]" value=""></div></div><div class="add-btn remove_button1"  style="cursor: pointer;"><i class="fa-solid fa-circle-minus"></i> Remove</div></div>';

    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton1).click(function(){
        //Check maximum number of input fields
        if(x < maxField1){ 
            x++; //Increment field counter
            $(wrapper1).append(fieldHTML1); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper1).on('click', '.remove_button1', function(e){
    	e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    }); 
});

					$(document).ready(function(){
    var maxField2 = 15; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper_main2'); //Input field wrapper
    var fieldHTML2 = '<div class="row field_wrapper_inner2"><div class="col-sm-6 col-lg-4"><div class="inp-outer"><label for="">Title</label><input class="input" type="text" name="title_sup2[]"></div></div><div class="col-sm-12 col-lg-12"><div class="inp-outer"><label for="">Description</label><textarea class="input" name="description_sup2[]"></textarea></div></div><div class="add-btn remove_button2"  style="cursor: pointer;"><i class="fa-solid fa-circle-minus "></i> Remove</div></div>';

    var y = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton2).click(function(){
        //Check maximum number of input fields
        if(y < maxField2){ 
            y++; //Increment field counter
            $(wrapper2).append(fieldHTML2); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper2).on('click', '.remove_button2', function(e){
    	e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        y--; //Decrement field counter
    }); 
});0

</script>
