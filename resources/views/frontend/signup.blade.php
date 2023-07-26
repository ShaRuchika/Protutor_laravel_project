@include('/frontend/common/header')
  <section class="page-title">
    <div class="container">
      <h1>Sign up</h1>
    </div>
  </section>

  <section class="login-sec">
    <div class="login-sec-overlay">
      <div class="container">
        <div class="login-main">
          <h5 class="text-center">Sign up as a Tutor or Student</h5>
          <div class="sign-opt">
            <ul class="nav-list">
              <li>
                <a href="{{url('/become-a-tutor')}}">
                  <div class="sign-opt-single">
                    <img src="{{url('/')}}/public/assets/frontpage_assets/images/pana.png" alt="">
                    <p>Sign up as a Tutor</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="{{url('/student-signup')}}">
                  <div class="sign-opt-single">
                    <img src="{{url('/')}}/public/assets/frontpage_assets/images/amico.png" alt="">
                    <p>Sign up as a Student</p>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <!-- <div class="login-main-in text-center">
            <a href="./signup-2.html"><button class="site-link full">Next</button></a>
          </div> -->
        </div>
      </div>
    </div>
  </section>
@include('/frontend/common/footer')
