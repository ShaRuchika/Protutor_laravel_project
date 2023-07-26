@include('/frontend/common/header')
<section class="page-title">
  <div class="container">
    <h1>Sign up</h1>
  </div>
</section>

<section class="login-sec alt">
  <div class="login-sec-overlay">
    <div class="container">
      <div class="sign-white">
        <div class="row">
          <div class="col-sm-6">
            <div class="sign-white-left">
              <img src="{{url('/')}}/public/assets/frontpage_assets/images/sign-img.jpg" alt="">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="sign-white-right">
              <h5>Welcom back to Pro<span>Tutor</span></h5>
              <h2>Sign Up</h2>
              <p>Not a Tutor? Sign up as a Student?</p>

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

              <form action="{{url('/student-signup')}}" method="post">
                @csrf()

                <div class="login-inp-wrap">
                  <input class="login-inp" name="first_name" type="text" placeholder="First Name">
                  <span style="color: red;">
                      @if($errors->has('first_name'))
                        {{ $errors->first('first_name');}} 
                      @endif
                    </span>
                </div>

                 <div class="login-inp-wrap">
                  <input class="login-inp" name="last_name" type="text" placeholder="Last Name">
                  <span style="color: red;">
                      @if($errors->has('last_name'))
                        {{ $errors->first('last_name');}} 
                      @endif
                    </span>
                </div>

                <div class="login-inp-wrap">
                  <input class="login-inp" name="email" type="email" placeholder="Email">
                  <span style="color: red;">
                      @if($errors->has('email'))
                        {{ $errors->first('email');}} 
                      @endif
                    </span>
                </div>
                <div class="login-inp-wrap">
                  <input class="login-inp" name="password" id="password" type="password" placeholder="Password">
                  <span class="inp-icon"><i class="fa-regular fa-eye" id="eye"></i></span>
                    <span style="color: red;">
                      @if($errors->has('password'))
                        {{ $errors->first('password');}} 
                      @endif
                    </span>
                </div>
                <div class="log-remember">
                  <label class="custom-check">Remember me
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="login-inp-wrap">
                  <button type="submit" class="site-link full">Sign Up</button>
                </div>
              </form>

              <div class="log-remember">
                <p class="p-0" href="">Already have an account? <a class="link-orange" href="{{url('/login')}}">Log in</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('/frontend/common/footer')