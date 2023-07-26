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
            <div class="col-lg-5">
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
                <div class="login-right-main">
                    <div class="otp-title">
                      <h5>Kindly enter OTP sent to you</h5>
                      <a href="{{url('/forget-password')}}">
                          <i class="fa-solid fa-xmark"></i>
                      </a>
                  </div>
                <form action="{{url('/forgetpassotpsubmit')}}" method="post">
                  @csrf()
                  <div class="otp-field">
                    <input type="text" name="otpfirst" id="" placeholder="0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    <input type="text" name="otpsecond" id="" placeholder="0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    <input type="text" name="otpthird" id="" placeholder="0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    <input type="text" name="otpfour" id="" placeholder="0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    <input type="text" name="otpfive" id="" placeholder="0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                    <input type="text" name="otpsix" id="" placeholder="0" maxlength="1" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                </div>
                <div class="inp-wrap pt-3 text-center">
                 <button type="submit" class="site-link sm">Validate OTP</button>
             </div>
         </form>
         <p class="pt-4 text-center"><a href="{{url('/forget-password')}}">Didn’t get OTP?</a></p>
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
