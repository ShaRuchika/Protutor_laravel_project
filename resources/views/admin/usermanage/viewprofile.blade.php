@include('/admin/common/header')
@include('/admin/common/sidebar')
<div class="main-wrapper">
  <div class="profile-back">
    <a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
  </div>
  <h4 class="fw-700 mt-3">User Profile</h4>
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
    <div class="user-bar-right">
      <a class="site-link sm" href="{{ url('admin/edit-profile/'.$userdata[0]->user_id) }}">Edit user’s details</a>
    </div>
  </div>

  <div>
    <div class="row">
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Date of Birth</label>
          <input class="input" type="date" value="{{$userdata[0]->dob}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">User type</label>
          @php
          if($userdata[0]->role==1){
            $usertype = "Super Admin";
          }

          if($userdata[0]->role==2){
            $usertype = "Admin";
          }

          if($userdata[0]->role==3){
            $usertype = "Teacher";
          }

          if($userdata[0]->role==4){
            $usertype = "Student";
          }
          @endphp
          <input class="input" type="text" value="{{$usertype}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">User ID</label>
          <input class="input" type="text" value="{{$userdata[0]->user_id}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">First Name</label>
          <input class="input" type="text" value="{{$userdata[0]->first_name}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Last Name</label>
          <input class="input" type="text" value="{{$userdata[0]->last_name}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Email Address</label>
          <input class="input" type="text" value="{{$userdata[0]->email}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Phone Number</label>
          <input class="input" type="text" value="{{$userdata[0]->phone_number}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Gender</label>
          <input class="input" type="text" value="{{$userdata[0]->gender}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Level</label>
          <select class="input" name="level" id="" disabled>
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
          <input class="input" type="text" value="{{$userdata[0]->teaching_exp}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Country</label>
          <select class="input" name="country" id="" disabled>
            @foreach($countries as $countries_data)  
            <option value="{{$countries_data->id}}" {{$countries_data->id == $userdata[0]->country  ? 'selected' : ''}}>{{$countries_data->nicename}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Current Situation</label>
          <input class="input" type="text" value="{{$userdata[0]->current_sit}}" disabled>
        </div>
      </div>
      @php
      if($userdata[0]->user_status==1){
        $user_status = "Active";
      }else{
        $user_status = "Inactive";
      }
      @endphp
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Status</label>
          <input class="input" type="text" value="{{$user_status}}" disabled>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="inp-outer">
          <label for="">Native Language</label>
          <select name="native_language" disabled>
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
          <select name="languages[]" multiple data-allow-clear="1" id="languages" disabled>
            <option value="">Select Languages</option>
            <?php foreach ($spoken_languages as $key => $value) { ?>
              <option value="<?php echo $value->id ?>"><?php echo $value->spoken_language ?></option>
            <?php  } ?> 
          </select>
        </div>
      </div>

    </div>

    <div class="inp-outer">
      <label for="">Bio</label>
      <textarea class="input" disabled>{{$userdata[0]->desc_about}}</textarea>
    </div>
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
