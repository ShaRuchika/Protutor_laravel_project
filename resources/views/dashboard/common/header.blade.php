<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no">
  <link rel="shortcut icon" href="{{url('/')}}/public/assets/dashboard_assets/images/favicon.png">
  <title>@if(!empty($PageTitle )) {{$PageTitle}} @else ProTutor | Dashboard @endif</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{url('/')}}/public/assets/dashboard_assets/css/custom.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">
</head>
<body>
  <?php 
  $userid = Session::get('userid');   
  $getData = DB::table('userdetails')->where('student_no',$userid)->get();  
  ?>
  <div class="site-wrap"> 

    <!-- Header -->
    <section class="header">
      <div class="header-left">
        <div class="logo"><img src="{{url('/')}}/public/assets/dashboard_assets/images/logo.png" alt=""></div> 
        <div class="nav-expand"><img src="{{url('/')}}/public/assets/dashboard_assets/images/nav.png" alt=""></div>
      </div>
      <div class="header-right">
        <div class="search">
          <input class="search-inp" type="text" placeholder="Search">
          <span class="inp-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
        </div>
        <div class="notific-bar">
          <?php 

            $notifications = DB::table('notifications')->whereNotIn('read_at',[1])->where('user_id',$userid)->get();

          ?>
          <div class="notific-bell">
            <i class="fa-solid fa-bell"></i>
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

          

          <div class="user-pic">
            <div class="user-thumb">
              <img src="{{url('/')}}/public/images/{{(isset($getData[0]->profile_img) ? $getData[0]->profile_img : '') }}" alt="User Image"></div>
            </div>
          </div>
        </div>
      </section>
  <!-- Header -->