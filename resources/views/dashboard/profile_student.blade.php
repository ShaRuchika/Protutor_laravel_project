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
        <!-- <button class="active" data-bs-toggle="tab" data-bs-target="#tab-1">
          <span>me</span> About
        </button> -->

        <button class="<?php echo (isset($getVal) && $getVal == 'about' ? 'active' : "") ?>" data-bs-toggle="tab" data-bs-target="#tab-1">
          <span>me</span> <a href="{{url('/')}}/profile/about"> About</a> 
        </button>

      </li>
      <li class="nav-item">
        <button data-bs-toggle="tab" data-bs-target="#tab-2" class="<?php echo (isset($getVal) && $getVal == 'photo' ? 'active' : "") ?>">
          <span><i class="fa-solid fa-images"></i></span> <a href="{{url('/')}}/profile/photo"> Photo</a>
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
      <div class="tab-pane fade <?php echo (isset($getVal) && $getVal == 'about' ? 'show active' : "") ?>" id="tab-1">
        <div class="box">
          <div class="tab-title">
            <h2>About</h2>
          </div>
          <div class="row justify-content-center">
            <form  method="post" id="form1" action="{{url('/profile')}}">
              @csrf
              <input type="hidden" name="id" value="{{$listUser[0]->user_id}}">
              <div class="col-lg-9">
                <div class="bg-block">
                  <div class="bg-block-main">
                    <div class="inp-group mt-0">
                      <label for="">Student Number</label>
                      <input class="inp" type="text" value="{{$listUser[0]->id}}" placeholder="Auto assigned by system e.g. TO-00000" readonly="">
                    </div>
                    <div class="inp-group">
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
                    <p class="info-txt orange">NOTE : Cannot edit First Name, Last Name, email - Please contact admin to change this information</p>
                  </div>
                </div>
                <div class="bg-block-main">
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
                    <label for="">Country of origin</label>
                    <select class="inp" name="country" id="">
                      <option value="">Select Country</option>
                      <?php 
                      foreach ($countries as $key => $value) { ?>
                        <option value="<?php echo $value->id; ?>"  <?php echo ($value->id == $listUser[0]->country ? "selected" : "") ?> ><?php echo $value->name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="save-changes">
                <button type="submit" name="updateStudent" value="updateStudent">Save Changes</button>
              </div>
            </form>
          </div>

          
        </div>
      </div>

      <div class="tab-pane fade <?php echo (isset($getVal) && $getVal == 'photo' ? 'show active' : "") ?>" id="tab-2">
        <form  method="post" id="form1" action="{{url('/profile')}}" enctype="multipart/form-data">
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
                <div class="up-image">
                  <p>Or upload image in JPG or PNG format not exceeding 5MB in size <br> <span>UPLOAD IMAGE</span></p>
                  <input type="file" name="profile_img" class="profile_img">
                  <br/>
                </div>
                <div class="previewIMG"></div> 
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
              <button type="submit" name="updatePhoto" value="updatePhoto">Save Changes</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

@include('/dashboard/common/footer')  

<script type="text/javascript">
  $('.profile_img').change(function(){
    $(".previewIMG").html('');
    for (var i = 0; i < $(this)[0].files.length; i++) {
      $(".previewIMG").append('<img src="'+window.URL.createObjectURL(this.files[i])+'" style="width:100%;height:250px;" />');
    }
  });
</script>