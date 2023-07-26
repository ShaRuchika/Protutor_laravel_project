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
</head>
<body>


  <div class="login-wrap">

    <div class="login-head">
      <div class="login-head-left">
        <a href="{{url('/')}}"> <img src="{{url('/')}}/public/assets/images/logo-dark.svg" alt=""></a></div>
    </div>
    
    <div class="login-left">
      <div class="login-left-img"><img src="{{url('/')}}/public/assets/images/login.png" alt=""></div>
    </div>
    <div class="login-right">
      <div class="login-right-main">
        <h2 class="text-center">Login</h2>
        <p class="pt-3 text-center">Login into your Account</p>
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
        <form action="{{url('/check_login')}}" method="post">
          @csrf()
          <div class="inp-wrap">
            <label for="">Email address</label>
            <input class="inp" type="email" name="email" placeholder="Example@gmail.com">
            <span style="color: red;">@if($errors->has('email'))
              {{ $errors->first('email');}} 
            @endif</span>
          </div>
          <div class="inp-wrap">
            <label for="">Password</label>
            <input class="inp" type="password" name="password" placeholder="Enter your password" >
            <span style="color: red;">@if($errors->has('password'))
              {{ $errors->first('password');}} 
            @endif</span>
          </div>
          <p class="pt-3"><a href="{{url('/forget-password')}}">Forgot password?</a></p>
          <div class="inp-wrap">
            <button type="submit" class="site-link full">Sign in</button>
          </div>
        </form>
        <!-- <p class="pt-4 text-center"><a href="">Add User</a></p> -->
      </div>
    </div>
  </div>  


  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/tilt.js@1.2.1/dest/tilt.jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  <script src="{{url('/')}}/public/assets/js/custom.js"></script>  
</body>
</html>
