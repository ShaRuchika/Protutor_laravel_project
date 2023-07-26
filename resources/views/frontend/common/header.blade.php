<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{url('/')}}/public/assets/frontpage_assets/images/favicon.png">
    <title>@if(!empty($PageTitle )) {{$PageTitle}} @else ProTutor | Home  @endif</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/frontpage_assets/css/custom.css">
    <link rel="stylesheet" href="{{url('/')}}/public/assets/frontpage_assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">
  </head>
  <body>

  
  <header class="cont-space site-header">
    <div class="header-in">
      <div class="logo">
        <a href="{{url('/')}}"><img src="{{url('/')}}/public/assets/frontpage_assets/images/logo-dark.svg" alt=""></a>
        <div class="mobClick">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="site-nav">
        <ul>
          <li><a class="active" href="{{url('/')}}">Home</a></li>
          <li><a href="{{url('/find-a-tutor')}}">Find tutors</a></li>
          <li><a href="">Enterprise</a></li>
          <li><a href="{{url('/become-a-tutor')}}">Become a tutor</a></li>
          <li style="background: #ff6c0b;margin-right: 5px;font-family: 'Inter', sans-serif;border-radius: 5px;color: white !important;"><a style="color: white !important;" href="{{url('/signup')}}">Sign Up</a></li>
          <li><a href="{{url('/login')}}">Login</a></li>
        </ul>
      </div>
    </div>
  </header>