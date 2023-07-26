@include('/frontend/common/header')
<section class="page-title">
  <div class="container">
    <h1>Login</h1>
  </div>
</section>

<section class="login-sec">
  <div class="login-sec-overlay">
    <div class="container">
      <div class="login-main">
        <div class="login-main-in">
          <h5>Welcom back to Pro<span>Tutor</span></h5>
          <h2>Login</h2>
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

          <form action="{{url('/login')}}" method="post">
          @csrf()

          <div class="login-inp-wrap">
            <input class="login-inp" name="email" type="email" placeholder="Email">
            <span style="color: red;">@if($errors->has('email'))
              {{ $errors->first('email');}} 
            @endif</span>
          </div>
          <div class="login-inp-wrap">
            <input class="login-inp" name="password" type="password" placeholder="Password" id="password">
            <span class="inp-icon"><i class="fa-regular fa-eye" id="eye"></i></span>
            <span style="color: red;">@if($errors->has('password'))
              {{ $errors->first('password');}} 
            @endif</span>
          </div>
          <div class="log-remember">
            <label class="custom-check">Remember me
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
            <a href="{{url('/forget-password')}}">Forget Password?</a>
          </div>
          <div class="login-inp-wrap">
              <button type="submit" class="site-link full">Login</button>
          </div>
          </form>
          <div class="log-remember">
            Don’t have an account?
            <a class="link-orange" href="{{url('/signup')}}">Get Started</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('/frontend/common/footer')