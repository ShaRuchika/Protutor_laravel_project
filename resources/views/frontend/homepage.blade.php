@include('/frontend/common/header')
<section class="hero-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="hero-banner-left">
          <h1 data-aos="fade-up"><?php echo $Homepagedata[0]->sec_1_heading; ?></h1>
          <div class="typed-wrap" data-aos="fade-up" data-aos-delay="400">
           <?php 
           $sec_1_subheading = explode(',', $Homepagedata[0]->sec_1_subheading); 
           foreach ($sec_1_subheading as $key => $subheading_value) {
            ?>
            <span class="typed quotes"><?php echo $subheading_value; ?></span>
          <?php } ?>
        </div>
        <p class="text-start" data-aos="fade-up" data-aos-delay="800">{{$Homepagedata[0]->sec_1_dec}}
        </p>

        <div class="button-group" data-aos="fade-up" data-aos-delay="1200">
          <a class="site-link" href="{{ url('/find-a-tutor') }}">Join as a Tutor</a>
          <a class="site-link bdr ms-md-3 ms-sm-0" href="{{ url('/student-signup') }}">Join as a Student</a>
        </div>
      </div>
    </div>
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="1200">
      <div class="hero-banner-right">
        <div class="t-circle">
          @if (count($sliderdata))
          <ul class="tabs-menu">
            @php
            $i = 1; 
            @endphp
            @foreach($sliderdata as $sliderdata_val)

            <li class="tabs-menu-{{$i}}">

              <a href="#tab-{{$i}}" class="redirect_tutor_url" data-id="{{$sliderdata_val->user_id}}">
                <div class="tab-img"><img src="{{ url('/') }}/public/images/{{$sliderdata_val->profile_img}}" alt=""></div>
                <div class="tab-txt">
                  <div class="tab-txt-top">
                    <p><?php 
                    foreach ($rateAll as $key => $rateAll_data1) { 
                      if($sliderdata_val->hourly_rate==$rateAll_data1->id){
                        echo $rateAll_data1->hourly_rate.'/hr';
                      }
                    }
                  ?> <br> <strong>{{$sliderdata_val->firstname.' '.$sliderdata_val->lastname}}</strong> </p>
                </div>
                <div class="tab-txt-bottom">
                  <?php 
                  foreach ($countryAll as $key => $value) { 
                    if($sliderdata_val->country==$value->id){
                     ?>       
                     <img src="{{url('/')}}/public/assets/frontpage_assets/flags/{{Str::lower($value->iso)}}.png" alt="">
                     <?php 
                     echo '<span>'.$value->nicename.'</span>';
                   }
                 }
                 ?> 
               </div>
             </div>
           </a>
         </li>

         @php
         $i++;
         @endphp
         @endforeach
       </ul>
       @else

       There is no slider records.

       @endif

       @if (count($sliderdata))
       <div class="tab"> 
        @php
        $count = 1; 
        @endphp
        @foreach($sliderdata as $sliderdata_val)
        <div id="tab-{{$count}}" class="tab-content"><img src="{{ url('/') }}/public/images/{{$sliderdata_val->profile_img}}" alt=""></div>

        @php
        $count++;
        @endphp
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>
</div>
</div>
</section>

<section class="competitors">
  <div class="container">
    <h2 class="text-center" data-aos="fade-up">{{$Homepagedata[0]->sec2_main_heading}}</h2>
  </div>
  <div class="competitors-single-wrap">
    <div class="competitors-single">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-up">
            <div class="competitors-left">
              <div class="competitors-circle js-tilt">
                <div class="circle-img"><img src="{{url('/')}}/public/images/{{$Homepagedata[0]->sec2_part1_file}}" alt=""></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="competitors-right">
              <h2>{{$Homepagedata[0]->sec2_part1_heading}}</h2>
              <p class="text-start">{{$Homepagedata[0]->sec2_part1_desc}}</p>
              <a class="site-link" href="{{$Homepagedata[0]->sec2_part1_url}}">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="competitors-single">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6" data-aos="fade-up">
            <div class="competitors-left">
              <div class="competitors-circle js-tilt">
                <div class="circle-img"><img src="{{url('/')}}/public/images/{{$Homepagedata[0]->sec2_part2_file}}" alt=""></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="competitors-right">
              <h2>{{$Homepagedata[0]->sec2_part2_heading}}</h2>
              <p class="text-start">{{$Homepagedata[0]->sec2_part2_desc}}</p>
              <a class="site-link" href="{{$Homepagedata[0]->sec2_part2_url}}">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="cont-space stats">
 <div class="row">
   <?php 
   $get_section3 = $Homepagedata[0]->sec3_data;
   $get_section_all = json_decode($get_section3);
   foreach ($get_section_all as $key => $get_section_value) {
    ?>
    <div class="col-sm-6 col-lg-3" data-aos="fade-up">
      <div class="stats-single">
        <div class="stat-img"><img src="{{ url('/') }}/public/images/{{$get_section_value->icon}}" alt=""></div>
        <p class="text-start"><strong>{{$get_section_value->title}}</strong></p>
        <p class="text-start"><span>{{$get_section_value->description}}</span></p>
      </div>
    </div>
  <?php } ?>

</div>
</section>

<section class="how">
 <div class="title-bg">
  <div class="container">
    <h2 data-aos="fade-up">HOW IT WORKS</h2>
    <h3 data-aos="fade-up" data-aos-delay="400">{{$Homepagedata[0]->sec4_main_heading}}</h3>
  </div>
</div>
<div class="how-txt">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-5">
        <div class="how-txt-single">
          <h2 data-aos="fade-up">{{$Homepagedata[0]->sec4_part1_heading}}</h2>
          <p class="text-start" data-aos="fade-up" data-aos-delay="400">{{$Homepagedata[0]->sec4_part1_desc}}</p>
          <a data-aos="fade-up" data-aos-delay="800" class="site-link" href="{{$Homepagedata[0]->sec4_part1_url}}">Learn More</a>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="how-txt-single">
          <h2 data-aos="fade-up">{{$Homepagedata[0]->sec4_part2_heading}}</h2>
          <p class="text-start" data-aos="fade-up" data-aos-delay="400">{{$Homepagedata[0]->sec4_part2_desc}}
          </p>
          <a data-aos="fade-up" data-aos-delay="800" class="site-link" href="{{$Homepagedata[0]->sec4_part2_url}}">Find a Tutor</a>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<section class="cont-space top-rated">
  <div class="text-center">
    <h2 data-aos="fade-up">Top Rated Tutors</h2>
    <h3 data-aos="fade-up" data-aos-delay="400">Meet our top rated tutors</h3>
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
            <h5>{{$userdata_val->firstname.' '.$userdata_val->lastname}}</h5>

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
         <div class="tutor-button"><a class="site-link mt-5" href="{{url('/tutor-detail/')}}/{{$userdata_val->user_id}}">View Details</a></div>
       </div>
     </div>
     @endforeach
     @else

     There is no records.

     @endif

   </div>
 </div>

</section>

<section class="subject">
  <div class="container">
    <h2 class="text-center" data-aos="fade-up">What Subject Do You Want To Learn?</h2>
    <div class="subject-list">
      @if (count($subjectAll))
      <ul data-aos="fade-up" data-aos-delay="400">

        @foreach($subjectAll as $subjectAll_val)
        <?php
        $tutor_data='SELECT users.id as user_id,users.first_name,users.last_name,users.phone_number,users.role,users.user_status,users.email ,users.email_verify,users.password,userdetails.* FROM `users` LEFT JOIN `userdetails` ON users.id = userdetails.student_no WHERE users.role=3';
        $tutor_data .= " and " .'userdetails.subject='.$subjectAll_val->id;
        $all_tutor_data = DB::select($tutor_data);

        ?>
        <li>
          <div class="subject-single">
            <h5>{{$subjectAll_val->subject}}</h5>
            <p><?php echo count($all_tutor_data); ?> Tutors</p>
          </div>
        </li>

        @endforeach
      </ul>
      @else

      There is no Subject.

      @endif

      <div class="text-center pt-5">
        <a class="more" href="{{ url('/find-a-tutor') }}">See More Subject Tutor</a>
      </div>
    </div>
  </div>
</section>

<section class="cont-space online-tutor">
 <div class="row align-items-center">
   <div class="col-lg-6" data-aos="fade-up">
    <div class="online-tutor-left">
      <h2>{{$Homepagedata[0]->sec7_heading}}</h2>
      <p class="text-start">{{$Homepagedata[0]->sec7_desc}}</p>
      <ul>
        <li><span><i class="fa-solid fa-magnifying-glass"></i></span>{{$Homepagedata[0]->sec7_sub_heading1}}</li>
        <li><span><i class="fa-regular fa-building"></i></span>{{$Homepagedata[0]->sec7_sub_heading2}}</li>
        <li><span><i class="fa-solid fa-money-bills"></i></span>{{$Homepagedata[0]->sec7_sub_heading3}}</li>
      </ul>
      <div class="button-group">
        <a class="site-link white" href="{{ url('/become-a-tutor') }}">Join as a Tutor</a>
        <a class="site-link white ms-md-2 ms-sm-0" href="{{ url('/student-signup') }}">Join as a Student</a>
      </div>
    </div>
  </div>
  <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
    <div class="online-tutor-right">
      <div class="online-tutor-video">
        <iframe width="100%" height="315" src="{{$Homepagedata[0]->sec7_youtube_url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>
</section>

<section class="cont-space testi-list">
  <div class="text-center">
    <h2 data-aos="fade-up">Student Testimonials</h2>
    <h3 data-aos="fade-up" data-aos-delay="400">Don't take our word for it, hear from our students.</h3>
  </div>
  <div class="testi-list-wrap">
    <div class="row scroll">

      @if (count($Alltestimonial))
      @foreach($Alltestimonial as $Alltestimonial_val)
      <div class="col-sm-6 col-lg-4">
        <div class="testi-list-single" data-aos="fade-up">
          <div class="tutor-list-img"><img src="{{ url('/') }}/public/images/{{$Alltestimonial_val->student_image}}" alt=""></div>
          <div class="tutor-info">
            <h5>{{$Alltestimonial_val->student_name}}</h5>
          </div>
          <div class="tutor-ratings">
            <?php  
            for ($x = 1; $x <= $Alltestimonial_val->student_rating; $x++) {
              echo '<span><i class="fa-solid fa-star"></i></span>';
            }
            ?> 
            
          </div>
          <div class="texti-txt">
            <p class="text-start">{{$Alltestimonial_val->student_desc}}</p>
          </div>
          <div class="testi-date">
            @php
            echo date('M Y ',strtotime($Alltestimonial_val->created_at));
            @endphp
          </div>
        </div>
      </div>
      @endforeach
      @else

      There is no student testimonials.

      @endif

    </div>
  </div>
</section>

<section class="apps-banner">
  <div class="container">
    <div class="apps-banner-main" data-aos="fade-up">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <div class="apps-banner-left">
            <h2>{{$Homepagedata[0]->sec9_heading}}</h2>
            <p class="text-start">{{$Homepagedata[0]->sec9_desc}}</p>
            <div class="button-group">
              <a class="" href="{{$Homepagedata[0]->sec9_apple_store_url}}"><img src="{{url('/')}}/public/assets/frontpage_assets/images/app-store.png" alt=""></a>
              <a class="ms-md-3 ms-sm-0" href="{{$Homepagedata[0]->sec9_play_store_url}}"><img src="{{url('/')}}/public/assets/frontpage_assets/images/goole.png" alt=""></a>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="apps-banner-right"><img src="{{url('/')}}/public/images/{{$Homepagedata[0]->sec9_file}}" alt=""></div>
        </div>
      </div>
    </div>
  </div>
</section>
@include('/frontend/common/footer')
<script type="text/javascript">
  $(document).ready(function(){
    $(".redirect_tutor_url").click(function(){
        var id = $(this).attr("data-id");
        var APP_URL = {!! json_encode(url('/')) !!}
        var full_url = APP_URL+'/tutor-detail/'+id;
        window.location.href = full_url;
    }); 
  });
</script>
