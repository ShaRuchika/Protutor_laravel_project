@include('/dashboard/common/header')
@include('/dashboard/common/sidebar')

<!-- Container -->
<section class="wrapper">
  <div class="page-title">
    <h1>Tutors</h1>
  </div>

  <div class="box">
    <form action="{{url('/tutors')}}" method="get">
      <div class="tutor-filter">
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="tutor-filter-single">
              <label for="">I WANT TO LEARN</label>
              <select id="learn" name="subject" class="shadow-none form-select rounded-pill">
                <option value="">Select</option>
                @foreach($subjectAll as $data2)
                <option <?php echo ((isset($_GET['subject']) && $_GET['subject'] == $data2->id) ? "selected" : ""); ?> value="{{ $data2->id }}">{{ $data2->subject }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="tutor-filter-single">
              <label for="">PRICE PER HOUR</label>
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
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="tutor-filter-single">
              <label for="">TUTOR IS FROM</label>
              <select id="learn" name="country" class="shadow-none form-select rounded-pill">
                <option value="">Select</option>
                @foreach($countryAll as $data)
                <option <?php echo ((isset($_GET['country']) && $_GET['country'] == $data->id) ? "selected" : ""); ?> value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="tutor-filter-single">
              <label for="">I'M AVAILABLE</label>
              <select id="learn" name="user_status" class="shadow-none form-select rounded-pill">
                <option value="">Select</option>

                <option value="1" <?php echo ((isset($_GET['user_status']) && $_GET['user_status'] == 1) ? "selected" : ""); ?> >Active</option>
                <option value="0" <?php echo ((isset($_GET['user_status']) && $_GET['user_status'] == 0) ? "selected" : ""); ?> >Inactive</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="tutor-filter-sm">

        <div class="tutor-filter-sm-single">
          <select id="learn" name="spoken_language" class="form-select-sm shadow-none form-select rounded-pill">
            <option value="">Also speaks</option>
            @foreach($Spoken_language as $spoken_language_data)
            <option <?php echo ((isset($_GET['spoken_language']) && $_GET['spoken_language'] == $spoken_language_data->id) ? "selected" : ""); ?> value="{{ $spoken_language_data->id }}">{{ $spoken_language_data->spoken_language }}</option>
            @endforeach
          </select>
        </div>
        <div class="tutor-filter-sm-single">
          <select id="learn" name="native_language" class="form-select-sm shadow-none form-select rounded-pill">
            <option value="">Native Speaker</option>
            @foreach($Spoken_language as $spoken_language_data)
            <option <?php echo ((isset($_GET['native_language']) && $_GET['native_language'] == $spoken_language_data->id) ? "selected" : ""); ?> value="{{ $spoken_language_data->id }}">{{ $spoken_language_data->spoken_language }}</option>
            @endforeach
          </select>
        </div>
        <div class="tutor-filter-sm-single">
          <select name="" id="">
            <option value="">Certified</option>
          </select>
        </div>

        <div class="col-md-6">
          <div class="row">
           <div class="col-lg-3 col-md-6 mt-2"> 
            <button class="rounded-pill site-link1">Search</button>
          </div>
          <div class="col-lg-3 col-md-6 mt-2"> 
            <a href="{{url('/tutors')}}" class="site-link1 rounded-pill">Clear</a>
          </div>
        </div>
      </div>   
    </div>
  </form>
</div>

<h5 class="pt-3"><strong>{{count($userdata)}} Teachers Available</strong></h5>

<div class="mt-3">
  <div class="tutor-list">

   @if (count($userdata))
   @foreach($userdata as $userdata_val)
   <div class="tutor-list-single">
    <div class="tutor-list-left">
      <div class="tutor-list-img">
        <a href="{{url('/tutor')}}/{{$userdata_val->user_id}}"><img src="{{ url('/') }}/public/images/{{$userdata_val->profile_img}}" alt=""></a>
      </div>
      <div class="tutor-list-txt">
        <div class="tutor-list-info">
          <h5><a href="{{url('/tutor')}}/{{$userdata_val->user_id}}">{{$userdata_val->first_name.' '.$userdata_val->last_name}}</a></h5>
          <span><?php 
          foreach ($countryAll as $key => $value) { 
            if($userdata_val->country==$value->id){
             ?>       
             <img class="nationality" src="{{url('/')}}/public/assets/frontpage_assets/flags/{{Str::lower($value->iso)}}.png" alt="language">
             <?php 
           }
         }
       ?> </span>

       <?php 
       if($userdata_val->profile_verified == 1){
        echo '<span class="txt-green"><i class="fa-solid fa-user-check"></i></span>';
      }else{
        echo '<span class="txt-green"><i class="fa-solid fa-user-xmark" style="color: red;"></i></span>';
      }
      ?>

      <span class="tutor-stat"><i class="fa-solid fa-circle"></i> Online</span>
    </div>
    <p class="pt-2"><span> Subject:<?php 
    foreach ($subjectAll as $key => $value) { 
      $medi_arr = explode(',', $userdata_val->subject);  
      if(count($medi_arr) > 1){
        if(in_array($value->id, $medi_arr)){
          echo '<span class="text-dark ms-3">'.$value->subject.'</span>';

        }
      }else{
        if($userdata_val->subject==$value->id){
          echo '<span class="text-dark ms-3">'.$value->subject.'</span>';
        }
      }
    }

  ?> </span></p>
  <p class="pt-3"><strong>17 Active Students - 97 Lessons Delivered</strong></p>

  <div class="tutor-spec">
    <?php 
    foreach ($Spoken_language as $key => $native_lan) { 
      $medi_arr1 = explode(',', $userdata_val->native_language);  
      if(count($medi_arr1) > 1){
        if(in_array($native_lan->id, $medi_arr1)){
          echo '<span>Speaks: '.$native_lan->spoken_language.'</span>';
        }
      }else{
        if($userdata_val->native_language==$native_lan->id){
         echo '<span>Speaks: '.$native_lan->spoken_language.'</span>';
       }
     }
   }
   echo '  <span class="spec">Native</span>';
   ?> 
   <?php 
   foreach ($Spoken_language as $key => $advance_lang) { 
    $medi_arr1 = explode(',', $userdata_val->languages);  
    if(count($medi_arr1) > 1){
      if(in_array($advance_lang->id, $medi_arr1)){
        echo '<span>'.$advance_lang->spoken_language.'</span>';
      }
    }else{
      if($userdata_val->languages==$advance_lang->id){
       echo '<span>'.$advance_lang->spoken_language.'</span>';
     }
   }
 }
 echo '  <span class="spec adv">Advanced</span>';
 ?> 

</div>
<?php 
$degree = DB::select('SELECT educations.degree_name, educations.specialization, educations.university_name, educations.year_of_study FROM `educations` join userdetails on educations.userdetail_id = userdetails.student_no
  where userdetails.student_no="'.$userdata_val->user_id.'";');

$experience = DB::select('SELECT experiences.period_of_employment, experiences.company_name, experiences.position FROM `experiences` join userdetails on experiences.userdetail_id = userdetails.student_no
  where userdetails.student_no="'.$userdata_val->user_id.'";');

if(!empty($experience)){
  $years_of_Exps = [];
  foreach ($experience as $key => $value) {
    $year = explode('-', $value->period_of_employment);
    $years_of_Exps[] = $year[1]- $year[0];
  }
  $years_of_Exp = array_sum($years_of_Exps); 
}else{  
  $years_of_Exp = 0;
}
?>

<p class="pt-3"><strong>{{!empty($degree[0]->degree_name)? $degree[0]->degree_name : 'NA'}} Degrees in {{!empty($degree[0]->specialization) ? $degree[0]->specialization : 'NA'}} with {{$years_of_Exp}} years of experience</strong></p>{{$userdata_val->desc_about}}</p>
<p><a class="txt-green" href="{{url('/tutor')}}/{{$userdata_val->user_id}}">Read More</a></p>
</div>
</div>
<div class="tutor-list-right">
  <div class="tutor-video">

   <?php 
   if(isset($userdata_val->video_link) and $userdata_val->video_link!=''){
    ?>
    <iframe width="100%" height="315" src="{{url('/')}}/public/videos/{{$userdata_val->video_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

    <?php 
  }else{       
    echo '<div>video not found.</div>';
  }       
  ?>

</div>
<div class="tutor-info">
  <ul>
    <li><span><i class="fa-solid fa-star"></i> 5</span> <span> 
      <?php 
      foreach ($rateAll as $key => $rateAll_data1) { 
        if($userdata_val->hourly_rate==$rateAll_data1->id){
          echo '$'.$rateAll_data1->hourly_rate;
        }
      }
      ?>
    </span></li>
    <li><span>1 Review</span> <span>Per Hour</span></li>
  </ul>
</div>
<div class="pt-2">
  <a class="theme-btn-sm full" href="tutor-details.html">Book Trial Lesson</a>
  <a class="theme-btn-sm full bdr mt-2" href="chat.html">Send Message</a>
</div>
</div>
</div>

@endforeach
@else

There is no records.

@endif

</div>
</div>
</section>
<!-- Container -->




@include('/dashboard/common/footer')  
