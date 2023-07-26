<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no">
  <link rel="shortcut icon" href="{{url('/')}}/public/assets/images/favicon.png">
  <title>@if(!empty($PageTitle )) {{$PageTitle}} @else Login | ProTutor  @endif</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url('/')}}/public/assets/css/custom.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">
</head>
<body>
  <?php 
  $userid = Session::get('admin_userid');
  $getDataheader = DB::table('userdetails')->where('student_no',$userid)->get();  
 
  ?>
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <div class="site-wrap">
  <div class="login-head">
    <div class="login-head-left">
      <img src="{{url('/')}}/public/assets/images/logo-dark.svg" alt="">
      <div class="mobClick">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="login-head-right">

      <?php 
     
       $notifications = DB::table('notifications')->whereNotIn('read_at',[1])->where('user_id',$userid)->get();

      ?>

      <div class="notific cust-cls">
        <i class="fa-regular fa-bell"></i>
        <span class="notific-count" id="notific_count">
          @php
          if($notifications->count() > 0){ echo $notifications->count(); }else{ echo '0'; }
          @endphp
        </span>
      </div>
      @php
      if($notifications->count() > 0){
        @endphp
        <div class="notific-content">
          <div class="main-txt">
            @foreach($notifications as $notifications_val)
            <div class="inner">
              <p>{{ $notifications_val->data }}</p>
              <a href="#"><button type="button" rel="tooltip" title="Mark as read" class="btn btn-danger btn-link btn-sm mark-as-read" data-id="{{ $notifications_val->id }}">
                <i class="fa-solid fa-xmark"></i>
              </button>
            </a>
            
          </div>
          @endforeach
        </div>
        <div class="mark-btn-cls" >
          <a href="#" id="mark-all"> Mark all as read</a>
        </div>
      </div>
      @php
    }
    @endphp

    <div class="profile-dropdown">
      <div class="dropdown">
        <div class="dropdown-toggle" data-bs-toggle="dropdown">
          <span class="profile-dropdown-img">
            <img src="{{url('/')}}/public/images/{{(isset($getDataheader[0]->profile_img) ? $getDataheader[0]->profile_img : '') }}" alt=""></span>
          <span class="btn-txt">{{ session('admin_userdata.first_name').' '.session('admin_userdata.last_name')}}</span>
        </div>
        <ul class="dropdown-menu">
          <?php
          $session_id = Session::get('admin_userid');
          ?>
          <li><a class="" href="{{ url('admin/view-profile/'.$session_id) }}"><i class="fa-regular fa-user"></i> Edit Profile</a></li>
          <li><a class="" href="{{url('/admin/logout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
