@include('/frontend/common/header')

<!-- start page title -->
<div class="page-title">
  <div class="container">
   <h1>Find Tutor</h1>
</div>
</div>
<!-- end page title -->

<!-- start find tutor hero section -->
<section class="find-tutor-section">
  <div class="find-tutor-section-overlay">
     <div class="container">
        <div class="row">
           <div class="col" data-aos="fade-up">
              <h1 class="find-sec-title">
                 Top Tutors waiting for you
             </h1>
             <h2 class="find-sec-sub-title">
                Find the best tutor meant for you.
            </h2>
            <p class="find-sec-para">
             Learn anywhere anytime at your own convince. <br> Self-paced learning <br>1-on-1  Live classes <br> Sound and Qualified tutors only
         </p>
         <a href="{{url('/signup')}}">
             <button class="find-tutor-btn">Sign Up</button>
         </a>
     </div>
 </div>
</div>
</div>
</section>
<!-- end find tutor hero section -->

<!-- start filter section -->
<section class="filter-section">
    <div class="container">
        <div class="filter-section-area">
            <form action="{{url('/find-a-tutor')}}" method="get">
                <div class="row mb-3">
                    <div class="col-xl-3 col-lg-6 col-md-12 mt-2">
                        <label class="text-dark mb-1" for="learn">What do you want to learn?</label>
                        <select id="learn" name="subject" class="shadow-none form-select rounded-pill">
                            <option value="">Select</option>
                            @foreach($subjectAll as $data2)
                            <option <?php echo ((isset($_GET['subject']) && $_GET['subject'] == $data2->id) ? "selected" : ""); ?> value="{{ $data2->id }}">{{ $data2->subject }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12 mt-2">

                        <label class="text-dark mb-1" for="learn">Price per hour</label>
                        <select id="learn" name="hourly_rate" class="shadow-none form-select rounded-pill">
                          <option value="">Select</option> 
                          <option value="1-5" <?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='1-5' ? 'selected' : "") ?>>$1-5</option>
                          <option value="6-10" <?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='6-10' ? 'selected' : "") ?>>$6-10</option>
                          <option value="11-15"<?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='11-15' ? 'selected' : "") ?>>$11-15</option>
                          <option value="16-20"<?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='16-20' ? 'selected' : "") ?>>$16-20</option>
                          <option value="21-25"<?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='21-25' ? 'selected' : "") ?>>$21-25</option>
                          <option value="26-30"<?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='26-30' ? 'selected' : "") ?>>$26-30</option> 
                          <option value="31-35"<?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='31-35' ? 'selected' : "") ?>>$31-35</option> 
                          <option value="36-40"<?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='36-40' ? 'selected' : "") ?>>$36-40</option> 
                          <option value="41-45"<?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='41-45' ? 'selected' : "") ?>>$41-45</option> 
                          <option value="46-50"<?php echo (isset($_GET['hourly_rate']) && $_GET['hourly_rate']=='46-50' ? 'selected' : "") ?>>$46-50</option> 
                      </select>

                  </div>
                  <div class="col-xl-3 col-lg-6 col-md-12 mt-2">

                    <label class="text-dark mb-1" for="learn">Tutor is form</label>
                    <select id="learn" name="country" class="shadow-none form-select rounded-pill">
                        <option value="">Select</option>
                        @foreach($countryAll as $data)
                        <option <?php echo ((isset($_GET['country']) && $_GET['country'] == $data->id) ? "selected" : ""); ?> value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-xl-3 col-lg-6 col-md-12 mt-2">

                    <label class="text-dark mb-1" for="learn">I'm available</label>
                    <select id="learn" name="user_status" class="shadow-none form-select rounded-pill">
                      <option value="">Select</option>

                      <option value="1" <?php echo ((isset($_GET['user_status']) && $_GET['user_status'] == 1) ? "selected" : ""); ?> >Active</option>
                      <option value="0" <?php echo ((isset($_GET['user_status']) && $_GET['user_status'] == 0) ? "selected" : ""); ?> >Inactive</option>
                  </select>

              </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mt-2">

                        <select id="learn" name="spoken_language" class="form-select-sm shadow-none form-select rounded-pill">
                            <option value="">Also speaks</option>
                            @foreach($Spoken_language as $spoken_language_data)
                            <option <?php echo ((isset($_GET['spoken_language']) && $_GET['spoken_language'] == $spoken_language_data->id) ? "selected" : ""); ?> value="{{ $spoken_language_data->id }}">{{ $spoken_language_data->spoken_language }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-lg-3 col-md-6 mt-2">

                        <select id="learn" name="native_language" class="form-select-sm shadow-none form-select rounded-pill">
                            <option value="">Native Speaker</option>
                            @foreach($Spoken_language as $spoken_language_data)
                            <option <?php echo ((isset($_GET['native_language']) && $_GET['native_language'] == $spoken_language_data->id) ? "selected" : ""); ?> value="{{ $spoken_language_data->id }}">{{ $spoken_language_data->spoken_language }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-lg-3 col-md-6 mt-2">
                        <select id="learn" name="certified" class="form-select-sm shadow-none form-select rounded-pill">
                            <option value="">Certified</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                 <div class="col-lg-3 col-md-6 mt-2"> 
                    <button class="rounded-pill site-link1">Search</button>
                </div>
                <div class="col-lg-3 col-md-6 mt-2"> 
                    <a href="{{url('/find-a-tutor')}}" class="site-link1 rounded-pill">Clear</a>
                </div>
            </div>
        </div>            
    </div>
</form>
</div>
</div>
</section>
<!-- end filter section -->

<!-- start top rated tutors section -->
<section class="cont-space top-rated">
    <div class="text-center">
        <h2 >Top Rated Tutors</h2>
        <h3 >Meet our top rated tutors</h3>
    </div>

    <div class="top-tutor-list">
        <div class="row scroll">
            @if (count($userdata))
            @foreach($userdata as $userdata_val)
            <div class="col-sm-6 col-lg-4 col-xl-3" data-aos="fade-up">
                <div class="tutor-list-single">
                    <div class="tutor-price">
                        <?php 
                        foreach ($rateAll as $key => $rateAll_data1) { 
                            if($userdata_val->hourly_rate==$rateAll_data1->id){
                                echo $rateAll_data1->hourly_rate.'/hr';
                            }
                        }
                        ?>
             </div>
             <div class="tutor-list-img"><img src="{{ url('/') }}/public/images/{{$userdata_val->profile_img}}" alt=""></div>
             <div class="tutor-info">
                <h5>{{$userdata_val->first_name.' '.$userdata_val->last_name}}</h5>

                <?php 
                foreach ($subjectAll as $key => $value) { 
                    $medi_arr = explode(',', $userdata_val->subject);  
                    if(count($medi_arr) > 1){
                      if(in_array($value->id, $medi_arr)){
                        echo '<p>'.$value->subject.' Tutor</p>';

                    }
                }else{
                  if($userdata_val->subject==$value->id){
                      echo '<p>'.$value->subject.' Tutor</p>';
                  }
              }
          }

          ?> 

      </div>
      <div class="tutor-ratings">
        <span><i class="fa-solid fa-star"></i></span>
        <span><i class="fa-solid fa-star"></i></span>
        <span><i class="fa-solid fa-star"></i></span>
        <span><i class="fa-solid fa-star"></i></span>
        <span><i class="fa-solid fa-star"></i></span>
    </div>
    <div class="tutor-country">
        <?php 
        foreach ($countryAll as $key => $value) { 
          if($userdata_val->country==$value->id){
             ?>       
             <span><img src="{{url('/')}}/public/assets/frontpage_assets/flags/{{Str::lower($value->iso)}}.png" alt=""></span>
             <span>
             </span>
             <?php 
             echo $value->nicename;
         }
     }
     ?> 
 </div>
 <div class="tutor-button"><a class="site-link mt-5" href="{{url('/tutor-detail')}}/{{$userdata_val->user_id}}">View Details</a></div>
</div>
</div>
@endforeach
@else

There is no records.

@endif

</div>
</div>

</section>
<!-- end top rated tutors section -->

<!-- start get paid section -->
<section class="get-paid-section">
  <div class="get-paid-section-overlay">
     <div class="container">
        <div class="row">
           <div class="col" data-aos="fade-up">
              <h1 class="find-sec-title">
                 Start learning your dream <br> course today
             </h1>
             <p class="find-sec-para">
                 Connect with thousands of learners and <br> tutors around the world and learn from <br> your living room
             </p>
             <a href="{{url('/signup')}}">
                 <button class="find-tutor-btn">Get started</button>
             </a>
         </div>
     </div>
 </div>
</div>
</section>
<!-- end get paid section -->

<!-- start banner section -->
<section class="apps-banner">
  <div class="container">
     <div class="apps-banner-main">
        <div class="row align-items-center">
            <div class="col-lg-7" data-aos="fade-up">
               <div class="apps-banner-left">
                  <h2>Manage yourself from your mobile device.</h2>
                  <p class="text-start mb-3">There are many variations of passages of Lorem Ipsum avail the majority have suffered alteration in some form, by injected or randomised words which don't look </p>
                  <div class="button-group">
                     <a class="" href=""><img src="{{url('/')}}/public/assets/frontpage_assets/images/app-store.png" alt=""></a>
                     <a class="ms-md-3 ms-sm-0" href=""><img src="{{url('/')}}/public/assets/frontpage_assets/images/goole.png" alt=""></a>
                 </div>
             </div>
         </div>
         <div class="col-lg-5" data-aos="fade-up">
          <div class="apps-banner-right"><img src="{{url('/')}}/public/assets/frontpage_assets/images/phone.png" alt=""></div>
      </div>
  </div>
</div>
</div>
</section>

@include('/frontend/common/footer')