@include('/admin/common/header')
@include('/admin/common/sidebar')
<div class="main-wrapper">
  <div class="profile-back">
    <a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
  </div>
  <h4 class="fw-700 mt-3">User Profile</h4>

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
  
  <div class="user-bar">
    <div class="user-bar-left">
      <div class="user-bar-profile"><img src="{{ url('/') }}/public/images/{{$userdata[0]->profile_img}}" alt=""></div>
      <div class="user-bar-txt">
        <h5>{{$userdata[0]->first_name.' '.$userdata[0]->last_name}} - {{$userdata[0]->user_id}}</h5>
        <p>@php
          if($userdata[0]->role==1){
            echo "Super Admin";
          }

          if($userdata[0]->role==2){
            echo "Admin";
          }

          if($userdata[0]->role==3){
            echo "Teacher";
          }

          if($userdata[0]->role==4){
            echo "Student";
          }

        @endphp</p>
      </div>
    </div>
  </div>

  <div>
    <form action="{{url('admin/update_user_profile')}}" method="post">
      @csrf()
      <div class="row">
        <div class="col-sm-6 col-lg-4">
          <div class="inp-outer">
            <label for="">Date of Birth</label>
            <input class="input" type="date" name="dob" value="{{$userdata[0]->dob}}">
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
         <div class="inp-outer">
          <label for="">User type</label>

          <select class="input" name="role" id="">
            <option value="1" <?php if($userdata[0]->role=='1'){ echo 'selected'; } ?>>Super Admin</option>

            <option value="2" <?php if($userdata[0]->role=='2'){ echo 'selected'; } ?>>Admin</option>

            <option value="3" <?php if($userdata[0]->role=='3'){ echo 'selected'; } ?>>Teacher</option>

            <option value="4" <?php if($userdata[0]->role=='4'){ echo 'selected'; } ?>>Student</option>

          </select>
        </div>

      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">User ID</label>
          <input type="hidden" name="userrealid" value="{{$userdata[0]->user_id}}">
          <input class="input" type="text" name="userid" value="{{$userdata[0]->user_id}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">First Name</label>
          <input class="input" type="text" name="first_name" value="{{$userdata[0]->first_name}}">
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Last Name</label>
          <input class="input" type="text" name="last_name" value="{{$userdata[0]->last_name}}">
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Email Address</label>
          <input class="input" type="text" name="email" value="{{$userdata[0]->email}}">
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Phone Number</label>
          <input class="input" type="text" name="phone" value="{{$userdata[0]->phone_number}}">
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Gender</label>
          <select class="input" name="gender" id="">
            <option value="1" <?php if($userdata[0]->gender=='1'){ echo 'selected'; } ?>>Male</option>

            <option value="2" <?php if($userdata[0]->gender=='2'){ echo 'selected'; } ?>>Female</option>

          </select>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Level</label>
           <select class="input" name="level">
            <option value="">--- Select Level---</option> 
            @foreach($teaches_levels as $teaches_levels_data) 
            <option value="{{$teaches_levels_data->id}}" {{$teaches_levels_data->id == $userdata[0]->level  ? 'selected' : ''}}>{{$teaches_levels_data->teaches_level}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Teaching Experience</label>
          <input class="input" type="text" name="teaching_exp" value="{{$userdata[0]->teaching_exp}}">
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Country</label>
           <select class="input" name="country" id="">
            @foreach($countries as $countries_data)  
            <option value="{{$countries_data->id}}" {{$countries_data->id == $userdata[0]->country  ? 'selected' : ''}}>{{$countries_data->nicename}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Current Situation</label>
          <input class="input" type="text" name="current_sit" value="{{$userdata[0]->current_sit}}">
        </div>
      </div>
      
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Status</label>
          <select class="input" name="status" id="">
            <option value="0" <?php if($userdata[0]->user_status=='0'){ echo 'selected'; } ?>>Inactive</option>

            <option value="1" <?php if($userdata[0]->user_status=='1'){ echo 'selected'; } ?>>Active</option>

          </select>
        </div>
      </div>

       <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Native Language</label>
          <select name="native_language">
            <option value="">Select Language</option>
            <?php foreach ($spoken_languages as $key => $value) { ?>
              <option <?php if($value->id==$userdata[0]->native_language){ echo "selected"; } ?> value="<?php echo $value->id ?>"><?php echo $value->spoken_language ?></option>
            <?php  } ?> 
          </select>

        </div>
      </div>

      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Spoken Languages</label>
          <select name="languages[]" multiple data-allow-clear="1" id="languages">
            <option value="">Select Spoken Languages</option>
            <?php foreach ($spoken_languages as $key => $value) { ?>
              <option value="<?php echo $value->id ?>"><?php echo $value->spoken_language ?></option>
            <?php  } ?> 
          </select>

        </div>
      </div>
    </div>

    <div class="inp-outer">
      <label for="">Bio</label>
      <textarea class="input" name="desc_about" >{{$userdata[0]->desc_about}}</textarea>
    </div>

    <div class="update-btn">
      <button type="submit" class="site-link sm">Update User Details</button>
    </div>
  </form>

</div>
</div>  
@include('/admin/common/footer')

<script type="text/javascript">
  $('#languages').val([<?php echo $userdata[0]->languages; ?>]);
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
