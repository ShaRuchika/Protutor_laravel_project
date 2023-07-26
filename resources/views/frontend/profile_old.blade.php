@include('/dashboard/common/header')
@include('/dashboard/common/sidebar')
<!-- Container -->
<section class="wrapper">
  <div class="page-title">
    <h1>Profile</h1>
  </div>

  <div>
    <ul class="nav tab-nav">
      <li class="nav-item">
        <button class="active" data-bs-toggle="tab" data-bs-target="#tab-1">
          <span>me</span> About
        </button>
      </li>
      <li class="nav-item">
        <button data-bs-toggle="tab" data-bs-target="#tab-2">
          <span><i class="fa-solid fa-images"></i></span> Photo
        </button>
      </li>
      <li class="nav-item">
        <button data-bs-toggle="tab" data-bs-target="#tab-3">
          <span><i class="fa-solid fa-align-left"></i></span> Description
        </button>
      </li>
      <li class="nav-item">
        <button data-bs-toggle="tab" data-bs-target="#tab-4">
          <span><i class="fa-solid fa-video"></i></span> Video
        </button>
      </li>
      <li class="nav-item">
        <button data-bs-toggle="tab" data-bs-target="#tab-5">
          <span><i class="fa-regular fa-object-group"></i></span> Background
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
    <div class="tab-pane fade show active" id="tab-1">
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
                    <input class="inp" type="text" name="first_name" placeholder="First Name" value="{{$listUser[0]->first_name}}">
                  </div>
                  <div class="inp-group">
                    <label for="">Last Name</label>
                    <input class="inp" type="text" name="last_name" placeholder="Last Name" value="{{$listUser[0]->last_name}}">
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
                    <label for="">Email</label>
                    <input class="inp" type="email" name="email" placeholder="uniquename@domain.com" value="{{$listUser[0]->email}}">
                  </div>
                </div>
                <div class="inp-group">
                  <p class="info-txt">Cannot edit First Name, Last Name, Country of origin and email - Please contact admin to change this information</p>
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
                  <label for="">Phone Number</label>
                  <input class="inp" type="text" name="phone" minlength="10" maxlength="10" value="{{$listUser[0]->phone}}" id="phone">
                </div>
                <div class="inp-group">
                  <label for="">Hourly rate - USD ($)</label>
                  <input class="inp" type="text" name="hourly_rate" placeholder="12" value="{{$listUser[0]->hourly_rate}}">
                </div>
              </div>
              <div class="bg-block mt-4">
                <h5 class="text-center">Subjects Taught</h5>
                <p class="info-txt">You can select up to 20 subjects. Some subjects may require a knowledge quiz in the next step.</p>

                <div class="row">
                  <div class="col-lg-3"></div>
                  <div class="col-lg-6">
                    <select name="subject[]" multiple data-allow-clear="1">
                      <option value="">Select Subject</option>

                      <?php foreach ($subject as $key => $value) { ?>

                        <?php  
                        $medi_arr = explode(',', $listUser[0]->subject);  

                        if(count($medi_arr) > 1){ ?>
                          <option value="<?php echo $value->id ?>" <?php echo ($value->id == $medi_arr[$key] ? "selected" : "") ?> ><?php echo $value->subject ?></option>  
                        <?php }else{ ?>
                          <option value="<?php echo $value->id ?>" <?php echo ($value->id == $listUser[0]->subject ? "selected" : "") ?> ><?php echo $value->subject ?></option>  
                        <?php } 
                      } ?> 
                    </select>
                  </div>
                  <div class="col-lg-3"></div>
                  <!-- <div class="col-lg-6">
                    <div class="subject-single">SCIENCE</div>
                  </div>
                  <div class="col-lg-6">
                    <div class="subject-single">BUSINESS</div>
                  </div>
                  <div class="col-lg-6">
                    <div class="subject-single">ENGINEERING & TECHNOLOGY</div>
                  </div>
                  <div class="col-lg-6">
                    <div class="subject-single">ARTS & HUMANITIES</div>
                  </div>
                  <div class="col-lg-6">
                    <div class="subject-single">SOCIAL SCIENCE</div>
                  </div> -->
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

    <div class="tab-pane fade" id="tab-2">
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
            <div class="capture">
              <button type="button"><i class="fa-solid fa-camera-retro"></i> Capture Photo</button>
              <span class="txt-orange">Capture profile photo using webcam</span>
            </div>
            <div class="up-image">
              <p>Or upload image in JPG or PNG format not exceeding 5MB in size <br> <span>UPLOAD IMAGE</span></p>
              <input type="file" name="profile_img">
            </div>
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

  <div class="tab-pane fade" id="tab-3"> 
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

<div class="tab-pane fade" id="tab-4">
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

<div class="tab-pane fade" id="tab-5"> 
  <form method="post" action="{{url('/profile')}}" enctype="multipart/form-data">
   @csrf
   <input type="hidden" name="id" value="{{$listUser[0]->user_id}}"> 
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


        


        <div class="mt-5 box">
          <div class="inp-block">
            <h5>Education</h5>
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
                <select class="block-inp" name="degree_type[]" required>
                  <option value="">Degree Type</option>
                  <option value="BA">BA</option>
                  <option value="MA">MA</option>
                </select>
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
                    </select>
                  </div>
                  <div class="col-6">
                    <select class="block-inp" name="year_of_study_end[]" required>
                      <option value="">End Year</option>
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
                <input type="file" name="degree_verification_pic[]" required>
              </div>
            </div>
              <div class="add-btn add_button"><i class="fa-solid fa-circle-plus  "></i> Add Education</div> 
            <hr>
            <div class="block-inp-wrap text-center">
              <button class="link-bdr">Save</button>
            </div>

          </div>
        </div>





        

        <div class="mt-5 box">
          <div class="inp-block">
            <h5>Certification</h5>
            <div class="block-inp-wrap">
              <label for="">Certificate</label>
              <input class="block-inp" type="text" placeholder="">
            </div>
            <div class="block-inp-wrap">
              <label for="">Description</label>
              <input class="block-inp" type="text" placeholder="">
            </div>
            <div class="block-inp-wrap">
              <label for="">Issued By</label>
              <input class="block-inp" type="text" placeholder="">
            </div>
            <div class="block-inp-wrap">
              <label for="">Year of Study</label>
              <div class="row">
                <div class="col-6">
                  <select class="block-inp" name="" id="">
                    <option value="">Start Year</option>
                  </select>
                </div>
                <div class="col-6">
                  <select class="block-inp" name="" id="">
                    <option value="">End Year</option>
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
              <input type="file">
            </div>
            <div class="add-btn"><i class="fa-solid fa-circle-plus"></i> Add another certificate</div>
            <hr>
            <div class="block-inp-wrap text-center">
              <button type="submit" name="background" value="background" class="link-bdr">Save</button>
            </div>
          </div>
        </div>


        <div class="mt-5 box">
          <div class="inp-block">
            <h5>Experience</h5>
            <div class="block-inp-wrap">
              <label for="">Company</label>
              <input class="block-inp" type="text" placeholder="">
            </div>
            <div class="block-inp-wrap">
              <label for="">Position</label>
              <input class="block-inp" type="text" placeholder="">
            </div>
            <div class="block-inp-wrap">
              <label for="">Period of Employment</label>
              <div class="row">
                <div class="col-6">
                  <select class="block-inp" name="" id="">
                    <option value="">Start Year</option>
                  </select>
                </div>
                <div class="col-6">
                  <select class="block-inp" name="" id="">
                    <option value="">End Year</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="add-btn"><i class="fa-solid fa-circle-plus"></i> Add another Experience</div>
            <hr>
            <div class="block-inp-wrap text-center">
              <button class="link-bdr">Save</button>
            </div>
          </div>
        </div>


        <div class="mt-5 box">
          <div class="inp-block">
            <h5>Identity Verification</h5>
            <div class="block-inp-wrap">
              <label for="">Issued by Country</label>
              <input class="block-inp" type="text" placeholder="">
            </div>
            <div class="block-inp-wrap">
              <label for="">Type of Document</label>
              <select class="block-inp" name="" id="">
                <option value="">Type of Document</option>
              </select>
            </div>
            <div class="block-inp-wrap">
              <label for="">Document identification number</label>
              <input class="block-inp" type="text" placeholder="">
            </div>
            <div class="block-inp-wrap">
              <label for="">Document expiry date</label>
              <div class="row">
                <div class="col-6">
                  <select class="block-inp" name="" id="">
                    <option value="">Select Day</option>
                  </select>
                </div>
                <div class="col-6">
                  <select class="block-inp" name="" id="">
                    <option value="">Select Year</option>
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
                  <input type="file">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="up-image">
                  <p class="txt-blue"><i class="fa-solid fa-upload"></i></p>
                  <p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD Back</span></p>
                  <input type="file">
                </div>
              </div>
            </div>
            <hr>
            <div class="block-inp-wrap text-center">
              <button class="link-bdr">Save</button>
            </div>
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
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) 
      }
    };
    */
    $(document).on("change", ".file_multi_video", function(evt) {
      var $source = $('#video_here');
      $source[0].src = URL.createObjectURL(this.files[0]);
      $source.parent()[0].load();
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
    var fieldHTML = '<div class="field_wrapper"><div class="block-inp-wrap"><label for="">University</label><input class="block-inp" name="university_name[]" required type="text"></div><div class="block-inp-wrap"><label for="">Degree</label><input class="block-inp" name="degree_name[]" type="text" required></div><div class="block-inp-wrap"><label for="">Degree Type</label><select class="block-inp" name="degree_type[]"  required><option value="">Degree Type</option></select></div><div class="block-inp-wrap"><label for="">Specialization</label><input class="block-inp" name="specialization[]" type="text" required></div><div class="block-inp-wrap"><label for="">Year of Study</label><div class="row"><div class="col-6"><select class="block-inp" name="year_of_study[]" required><option value="">Start Year</option></select></div><div class="col-6"><select class="block-inp" name="year_of_study_end[]"  required><option value="">End Year</option></select></div></div></div><div class="block-inp-wrap"><div class="verify-stat gery"><div class="verify-stat-icon"><i class="fa-solid fa-file-lines"></i></div><div class="verify-stat-txt"><h5>Degree Verification</h5><p>Upload most recent degree/certificate for profile verification</p></div></div></div><div class="up-image"><p class="txt-blue"><i class="fa-solid fa-upload"></i></p><p class="txt-green">JPG or PNG format maximum size of 20MB <br> <span>UPLOAD IMAGE</span></p><input type="file" name="degree_verification_pic[]" required></div></div>';
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
</script>