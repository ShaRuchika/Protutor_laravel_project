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
        <div class="login-head-left"><a href="{{url('/')}}"><img src="{{url('/')}}/public/assets/images/logo-dark.svg" alt=""></a></div>
    </div>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="login-right-main">
                    <h2 class="text-center">Check your mail</h2>
                    <p class="pt-4 text-center">If your account exist for <strong>@if(!empty($email )) {{$email}} @else Login | ProTutor  @endif</strong> <br>you’ll receive OTP confirmation code on your email</p>
                    <div class="inp-wrap">
                        <a href="{{ url('/forgetpassotp') }}"><button class="site-link full">Okay</button></a>
                    </div>
                </div>
            </div>
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
