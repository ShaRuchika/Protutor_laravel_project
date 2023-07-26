@include('/admin/common/header')
@include('/admin/common/sidebar')
<div class="main-wrapper">
  <div class="profile-back">
    <a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
  </div>
  <!-- <h4 class="fw-700 mt-3">Edit Homepage</h4> -->
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
  <h4 class="fw-700 mt-3" style="text-align: center;">Section 1</h4>

  <div>
    <form action="{{url('admin/update_homepage/1')}}" method="post" enctype="multipart/form-data">
      @csrf()
      <div class="row">
        <div class="col-sm-6 col-lg-4">
          <div class="inp-outer">
            <label for="">Heading</label>
            <input class="input" type="text" value="{{$Homepagedata[0]->sec_1_heading}}" name="sec_1_heading">
          </div>
        </div>
        <div class="col-sm-6 col-lg-4 field_wrapper1">

          <?php 
          $sec_1_subheading = explode(',', $Homepagedata[0]->sec_1_subheading);
          ?>

          <?php 
          $subheading_count=1;
          foreach ($sec_1_subheading as $key => $subheading_value) {
            ?>
            <div class="field_wrapper">
              <div class="inp-outer"> 
                <label for="">Sub Heading</label>
                <input class="input" type="text" value="<?php echo $subheading_value; ?>" name="sec_1_subheading[]">
              </div>
              <?php if($subheading_count!='1'){ ?>
                <div class="add-btn remove_button"><i class="fa-solid fa-circle-plus  "></i> Remove</div>
              <?php } ?>
            </div>
            <?php $subheading_count++; } ?>

          </div>

          <div class="col-sm-6 col-lg-4" style="margin-top: 60px;">
            <div class="add-btn add_button"><i class="fa-solid fa-circle-plus  "></i> Add Sub Heading</div>
          </div>

          <div class="inp-outer">
            <label for="">Description</label>
            <textarea name="sec_1_dec" id="" class="input">{{$Homepagedata[0]->sec_1_dec}}</textarea>
          </div>

          <h4 class="fw-700 mt-3" style="text-align: center;">Section 2</h4>

          <div class="col-sm-12 col-lg-12">
            <div class="inp-outer">
              <label for="">Section2 Main Heading</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec2_main_heading}}" name="sec2_main_heading">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Image</label>
              <input class="input" type="file" name="sec2_part1_file">
              <?php if(isset($Homepagedata[0]->sec2_part1_file)){ ?>
                <input type="hidden" name="hidden_sec2_part1_file" value="{{$Homepagedata[0]->sec2_part1_file}}">
                <img src="{{url('/')}}/public/images/{{$Homepagedata[0]->sec2_part1_file}}" alt="" width="100" height="100">
              <?php } ?>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Heading</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec2_part1_heading}}" name="sec2_part1_heading">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Learn More URL</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec2_part1_url}}" name="sec2_part1_url">
            </div>
          </div>

          <div class="col-sm-12 col-lg-12">
            <div class="inp-outer">
              <label for="">Description</label>
              <textarea name="sec2_part1_desc" rows="4" class="input">{{$Homepagedata[0]->sec2_part1_desc}}</textarea>
            </div>
          </div>


          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Image</label>
              <input class="input" type="file" name="sec2_part2_file">
              <?php if(isset($Homepagedata[0]->sec2_part2_file)){ ?>
                <input type="hidden" name="hidden_sec2_part2_file" value="{{$Homepagedata[0]->sec2_part2_file}}">
                <img src="{{url('/')}}/public/images/{{$Homepagedata[0]->sec2_part2_file}}" alt="" width="100" height="100">
              <?php } ?>
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Heading</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec2_part2_heading}}" name="sec2_part2_heading">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Learn More URL</label>
              <input class="input" type="text"  value="{{$Homepagedata[0]->sec2_part2_url}}" name="sec2_part2_url">
            </div>
          </div>

          <div class="col-sm-12 col-lg-12">
            <div class="inp-outer">
              <label for="">Description</label>
              <textarea name="sec2_part2_desc" rows="4" class="input">{{$Homepagedata[0]->sec2_part2_desc}}</textarea>
            </div>
          </div>

          <h4 class="fw-700 mt-3" style="text-align: center;">Section 3</h4>

          <div class="row field_wrapper_main">
            <?php 
            $get_section3 = $Homepagedata[0]->sec3_data;
            $get_section_all = json_decode($get_section3);
            ?>
            <?php 
            $sec3_count=1;
            foreach ($get_section_all as $key => $get_section_value) {
              ?>
              <div class="row field_wrapper_inner">  
                <div class="col-sm-6 col-lg-4">
                  <div class="inp-outer">
                    <label for="">Icon</label>
                    <input class="input" type="file" name="icon[]">
                    <?php if(isset($get_section_value->icon)){ ?>
                      <input type="hidden" name="hidden_icon_file[]" value="{{$get_section_value->icon}}">
                      <img src="{{url('/')}}/public/images/{{$get_section_value->icon}}" alt="" width="100" height="100">
                    <?php } ?>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="inp-outer">
                    <label for="">Title</label>
                    <input class="input" type="text" name="title[]" value="{{$get_section_value->title}}">
                  </div>
                </div>
                <div class="col-sm-12 col-lg-12">
                  <div class="inp-outer">
                    <label for="">Description</label>
                    <textarea class="input" name="description[]">{{$get_section_value->description}}</textarea>
                  </div>
                </div>

                <?php if($sec3_count!='1'){ ?>
                  <div class="add-btn remove_button1"  style="cursor: pointer;"><i class="fa-solid fa-circle-plus  "></i> Remove</div>
                <?php } ?>

              </div>
            <?php $sec3_count++; } ?>

          </div>

          <div class="add-btn add_button1" style="cursor: pointer;"><i class="fa-solid fa-circle-plus"></i> Add more</div> 



          <h4 class="fw-700 mt-3" style="text-align: center;">Section 4</h4>

          <div class="col-sm-12 col-lg-12">
            <div class="inp-outer">
              <label for="">Section4 Main Heading</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec4_main_heading}}" name="sec4_main_heading">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Heading</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec4_part1_heading}}" name="sec4_part1_heading">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Learn More URL</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec4_part1_url}}" name="sec4_part1_url">
            </div>
          </div>

          <div class="col-sm-12 col-lg-12">
            <div class="inp-outer">
              <label for="">Description</label>
              <textarea name="sec4_part1_desc" rows="4" class="input">{{$Homepagedata[0]->sec4_part1_desc}}</textarea>
            </div>
          </div>


          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Heading</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec4_part2_heading}}" name="sec4_part2_heading">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Learn More URL</label>
              <input class="input" type="text"  value="{{$Homepagedata[0]->sec4_part2_url}}" name="sec4_part2_url">
            </div>
          </div>

          <div class="col-sm-12 col-lg-12">
            <div class="inp-outer">
              <label for="">Description</label>
              <textarea name="sec4_part2_desc" rows="4" class="input">{{$Homepagedata[0]->sec4_part2_desc}}</textarea>
            </div>
          </div>

          <h4 class="fw-700 mt-3" style="text-align: center;">Section 7</h4>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Youtube URL</label>
              <input class="input" type="text"  value="{{$Homepagedata[0]->sec7_youtube_url}}" name="sec7_youtube_url">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Heading</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec7_heading}}" name="sec7_heading">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">

          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Sub Heading1</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec7_sub_heading1}}" name="sec7_sub_heading1">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Sub Heading2</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec7_sub_heading2}}" name="sec7_sub_heading2">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Sub Heading3</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec7_sub_heading3}}" name="sec7_sub_heading3">
            </div>
          </div>

          <div class="col-sm-12 col-lg-12">
            <div class="inp-outer">
              <label for="">Description</label>
              <textarea name="sec7_desc" rows="4" class="input">{{$Homepagedata[0]->sec7_desc}}</textarea>
            </div>
          </div>

          <h4 class="fw-700 mt-3" style="text-align: center;">Section 9</h4>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Image</label>
              <input class="input" type="file" name="sec9_file">
              <?php if(isset($Homepagedata[0]->sec9_file)){ ?>
                <input type="hidden" name="hidden_sec9_file" value="{{$Homepagedata[0]->sec9_file}}">
                <img src="{{url('/')}}/public/images/{{$Homepagedata[0]->sec9_file}}" alt="" width="100" height="100">
              <?php } ?>
            </div>
          </div>  

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Heading</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec9_heading}}" name="sec9_heading">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">

          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Play Store URL</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec9_play_store_url}}" name="sec9_play_store_url">
            </div>
          </div>

          <div class="col-sm-6 col-lg-4">
            <div class="inp-outer">
              <label for="">Apple Store URL</label>
              <input class="input" type="text" value="{{$Homepagedata[0]->sec9_apple_store_url}}" name="sec9_apple_store_url">
            </div>
          </div>

          <div class="col-sm-12 col-lg-12">
            <div class="inp-outer">
              <label for="">Description</label>
              <textarea name="sec9_desc" rows="4" class="input">{{$Homepagedata[0]->sec9_desc}}</textarea>
            </div>
          </div>

          <div class="update-btn" style="text-align: center;" >
            <button type="submit" class="site-link sm">Update Homepage</button>
          </div>
        </div>
      </form>
    </div>

  </div>

</div>  
@include('/admin/common/footer')

<script type="text/javascript">
  $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper1'); //Input field wrapper
    var fieldHTML = '<div class="field_wrapper"><div class="inp-outer"><label for="">Sub Heading</label><input class="input" type="text" name="sec_1_subheading[]"></div><div class="add-btn remove_button"><i class="fa-solid fa-minus-circle"></i>Remove</div></div>';
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
    $(wrapper).on('click', '.remove_button', function(e){
      e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
      }); 
  }); 


  $(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button1'); //Add button selector
    var wrapper = $('.field_wrapper_main'); //Input field wrapper
    var fieldHTML = '<div class="row field_wrapper_inner"><div class="col-sm-6 col-lg-4"><div class="inp-outer"><label for="">Icon</label><input class="input" type="file" name="icon[]" value=""></div></div><div class="col-sm-6 col-lg-4"><div class="inp-outer"><label for="">Title</label><input class="input" type="text" name="title[]" value=""></div></div><div class="col-sm-12 col-lg-12"><div class="inp-outer"><label for="">Description</label><textarea class="input" name="description[]"></textarea></div></div><div class="add-btn remove_button1" style="cursor: pointer;"><i class="fa-solid fa-circle-minus"></i> Remove</div></div>';
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

</script>