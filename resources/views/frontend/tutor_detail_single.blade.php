@include('/frontend/common/header')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
<link rel="stylesheet" href="{{url('/')}}/public/assets/frontpage_assets/css/tutor-signup.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="{{url('/')}}/public/fullcalendar/fullcalendar.min.css" />
<style type="text/css">
    li.nav-item a {
        color: black;
    }
</style>

<!-- start page title -->
<div class="page-title">
    <div class="container">
        <h1>{{$teacher_data[0]->first_name.' '.$teacher_data[0]->last_name}}</h1>
    </div>
</div>
<!-- end page title -->

<!-- start tutor details section -->
<section class="tutor-details-section">
    <div class="cont-space clearfix">
        <div class="row">

            <div class="col-lg-12 col-xl-8">

                <div class="proView">
                    <!-- card -->
                    <div class="profile">
                        <div class="profile-information">
                            <div class="profile-img">
                                <img src="{{url('/')}}/public/images/{{$teacher_data[0]->profile_img}}" alt="profile-picture">
                            </div>
                            <div class="profile-identity">
                                <div class="identity">
                                    <h3 class="name">{{$teacher_data[0]->first_name.' '.$teacher_data[0]->last_name}}</h3>
                                    <?php 
                                    foreach ($country as $key => $value) { 
                                      if($teacher_data[0]->country==$value->id){
                                         ?>       
                                         <img class="nationality" src="{{url('/')}}/public/assets/frontpage_assets/flags/{{Str::lower($value->iso)}}.png" alt="language">
                                         <?php 
                                     }
                                 }
                                 ?> 
                                 <?php 
                                 if($teacher_data[0]->profile_verified == 1){
                                    echo '<span class="verify"><i class="fa-solid fa-user-check"></i></span>';
                                }else{
                                    echo '<span class="verify"><i class="fa-solid fa-user-xmark" style="color: red;"></i></span>';
                                }
                                ?>


                                <span class="status">
                                    <span class="active-badge">Online</span>
                                </span>
                            </div>
                            <small class="collage-name">{{!empty($degree[0]->degree_name)? $degree[0]->degree_name : 'NA'}} Degrees in {{!empty($degree[0]->specialization) ? $degree[0]->specialization : 'NA'}} with {{$years_of_Exp}} years of experience</small>

                            <div class="tech-subject mt-3">
                                <i class="fa-solid fa-graduation-cap fac"></i>
                                <span class="fw-bold">Teaches</span>
                                <?php 
                                foreach ($subjects as $key => $value) { 
                                  $medi_arr = explode(',', $teacher_data[0]->subject);  
                                  if(count($medi_arr) > 1){
                                    if(in_array($value->id, $medi_arr)){
                                        echo '<span class="text-dark ms-3">'.$value->subject.'</span>';
                                    }
                                }else{
                                    if($teacher_data[0]->subject==$value->id){
                                      echo '<span class="text-dark ms-3">'.$value->subject.'</span>';
                                  }
                              }
                          }
                          ?> 
                      </div>

                      <div class="tech-subject">
                        <i class="fa-solid fa-message fac"></i>
                        <span class="fw-bold"> Speaks</span>
                        <?php 
                        foreach ($languages as $key => $native_lan) { 
                            $medi_arr1 = explode(',', $teacher_data[0]->native_language);  
                            if(count($medi_arr1) > 1){
                                if(in_array($native_lan->id, $medi_arr1)){
                                    echo '<span> &nbsp;'.$native_lan->spoken_language.'</span>';
                                }
                            }else{
                                if($teacher_data[0]->native_language==$native_lan->id){
                                 echo '<span> &nbsp;'.$native_lan->spoken_language.'</span>';
                             }
                         }
                     }
                     echo '  <span class="badge rounded-pill bg-success">Native</span>';
                     ?> 
                     <?php 
                     foreach ($languages as $key => $advance_lang) { 
                        $medi_arr1 = explode(',', $teacher_data[0]->languages);  
                        if(count($medi_arr1) > 1){
                            if(in_array($advance_lang->id, $medi_arr1)){
                                echo '<span> &nbsp;'.$advance_lang->spoken_language.'';
                            }
                        }else{
                            if($teacher_data[0]->languages==$advance_lang->id){
                             echo '<span> &nbsp;'.$advance_lang->spoken_language.'</span>';
                         }
                     }
                 }
                 echo '  <span class="badge rounded-pill bg-primary">Advanced</span>';
                 ?> 
             </div>

             <div class="tech-subject">
                <i class="fa-solid fa-book fac"></i>
                <span class="fw-bold">Lessons</span>
                <span class="ms-3">0</span>
            </div>
        </div>
    </div>
    <!-- profile nav -->
    <div class="profile-nav">
        <ul>
            <li><a href="#about">About</a></li>
            <li><a href="#schedule">Schedule</a></li>
            <li><a href="#review">Review(1)</a></li>
            <li><a href="#resume">Resume</a></li>
        </ul>
    </div>
</div>
<!-- tutor details info -->
<div class="profile-details-info">
    <!-- Intro only visible less than 1200px -->
    <div class="tutor-sec tutor-intro mt-5" id="about">
        <h4 class="t-title fw-bold">Intro</h4>
        <hr>
        <div class="video-section-sm embed-responsive embed-responsive-21by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/wr6_5qdakts" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <div class="video-info">
            <div class="info-header d-flex flex-row justify-content-evenly mt-3">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <span><i class="fa-solid fa-star"></i> 5</span>
                    <span> 1 Review </span>
                </div>
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <span> $ 15</span>
                    <span> Per Hour </span>
                </div>
            </div>
            <div class="buttons d-flex flex-column align-items-center">
                <a href="#"><button class="custom-btn custom-btn-bg my-3">Book Trial Lesson</button></a>
                <a href="#"><button class="custom-btn">Send Message</button></a>
            </div>
            <div class="d-flex flex-row align-items-center my-3 p-3">
                <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                <p class="ms-auto p-v-sm">4 Lessons booked in the last 48 hours</p>
            </div>
            <div class="video-info-footer d-flex flex-row p-3">
                <span><i class="fa-solid fa-star" id="v-star"></i></span>
                <div class="group ms-4">
                    <strong>Super popular</strong>
                    <br>
                    <p class="text-start">16 students contacted this tutor in the last 48 hours</p>
                </div>
            </div>
        </div>

    </div>
    <!-- about tutor -->
    <div class="tutor-sec mt-5" id="about">
        <h4 class="t-title fw-bold">About</h4>
        <hr>


        <p class="about-description">
            {{$teacher_data[0]->desc_about}}
        </p>
    </div>
    <!-- tutor schedule -->
    <div class="tutor-sec mt-5" id="schedule">
        <h4 class="t-title fw-bold mb-2">Schedule</h4>
        <div class="border"></div>

        <div class="tutor-schedule">

            <div id="schedule-calendar"></div>

        </div>
    </div>
    <!-- tutor review -->
    <div class="tutor-sec mt-5" id="review">
        <h4 class="t-title fw-bold">What Students Says</h4>
        <hr>
        <div class="review-info">
            <div class="row">
                <div class="col-md-4">
                    <div class="review">
                        <h1 class="review-rates">5</h1>
                        <div class="review-stars">
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                            <span><i class="fa-solid fa-star"></i></span>
                        </div>
                        <p class="review-count">2 reviews</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="progresses">
                        <div>5 stars</div>
                        <div class="progress progress-color">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div>(2)</div>
                    </div>
                    <div class="progresses">
                        <div>4 stars</div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div>(0)</div>
                    </div>
                    <div class="progresses">
                        <div>3 stars</div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div>(0)</div>
                    </div>
                    <div class="progresses">
                        <div>2 stars</div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div>(0)</div>
                    </div>
                    <div class="progresses">
                        <div>1 stars</div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div>(0)</div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-12 r-border">
                    <div class="review-comment">
                        <h3 class="reviewer-name">
                            Name of Student 
                            <span><i class="fa-solid fa-star"></i>5</span>
                        </h3>
                        <div class="date ">
                            October 10, 2023
                        </div>
                        <p class="comment">
                            I am very happy to have found sarah as a teacher ! I have tested different teacher several times with no success! Sarah is a really friendly teacher and always in a good mood ! Her accent is clear and she has a wide range of different topics. She has also a lot of different ways and vocabulary which are helpling to improve my skills I really like the conversation and lessons with sarah. And i recognized too that teachers from other countries are cheaper than teacher from the UK, but believe me – you can notice the different and quality.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-12 r-border">
                    <div class="review-comment">
                        <h3 class="reviewer-name">
                            Name of Student 
                            <span><i class="fa-solid fa-star"></i>5</span>
                        </h3>
                        <div class="date ">
                            October 10, 2023
                        </div>
                        <p class="comment">
                            I am very happy to have found sarah as a teacher ! I have tested different teacher several times with no success! Sarah is a really friendly teacher and always in a good mood ! Her accent is clear and she has a wide range of different topics. She has also a lot of different ways and vocabulary which are helpling to improve my skills I really like the conversation and lessons with sarah. And i recognized too that teachers from other countries are cheaper than teacher from the UK, but believe me – you can notice the different and quality.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tutor resume -->
    <div class="tutor-sec mt-5" id="resume">
        <h4 class="t-title fw-bold">Resume</h4>
        <hr>
        <!-- education -->
        <div class="education">
            <h4 class="education-t"> Education </h4>
            <hr>
            <?php foreach ($degree as $key => $education) 
            { ?>
                <div class="row">
                    <div class="col-md-3">
                        <p class="education-seassion">{{$education->year_of_study}}</p>
                    </div>
                    <div class="col-md-9 d-flex flex-column justify-content-center gap-2">
                        <span class="clg-name">{{$education->university_name}}</span>
                        <span class="clg-name-2">{{$education->specialization}}</span>
                        <?php 
                        if($teacher_data[0]->profile_verified == 1){
                            echo '<span class="text-success degree-name"><i class="fa-solid fa-check"></i> Degree verified by Tutors Online verification team</span>';
                        }else{
                            echo '<span class="text-danger degree-name">Degree is Not verified by Tutors Online verification team</span>';
                        }
                        ?>

                    </div>
                </div>
                <br>
            <?php } ?>
        </div>
        <hr>
        <!-- work Experience -->
        <div class="work-experience">
            <h4 class="education-t">Work Experience</h4>
            <hr>
            <?php foreach ($experience as $key => $years) 
            { ?>
                <div class="row">
                    <div class="col-md-3">
                        <p class="education-seassion">
                            {{$years->period_of_employment}}
                        </p>
                    </div>
                    <div class="col-md-9 d-flex flex-column justify-content-center gap-2">
                        <span class="clg-name">{{$years->company_name}}</span>
                        <span class="clg-name-2">{{$years->position}}</span>
                    </div>
                </div>
                <br>
            <?php } ?>
        </div>
        <hr>
        <!-- certification -->
        <div class="work-experience">
            <h4 class="education-t">Certification</h4>
            <hr>
            <?php foreach ($certificateAll as $key => $certificate) 
            { ?>
                <div class="row">
                    <div class="col-md-3">
                        <p class="education-seassion">{{$certificate->year_of_study}}</p>
                    </div>
                    <div class="col-md-9 d-flex flex-column justify-content-center gap-2">
                        <span class="clg-name">{{$certificate->issued_by}}</span>
                        <span class="clg-name-2">{{$certificate->certificate_name}}</span>
                        <?php 
                        if($teacher_data[0]->profile_verified == 1){
                            echo '<span class="text-success degree-name"><i class="fa-solid fa-check"></i> certificate verified by Tutors Online verification team</span>';
                        }else{
                            echo '<span class="text-danger degree-name"> certificate is Not verified by Tutors Online verification team</span>';
                        }
                        ?>

                    </div>
                </div>
                <br>
            <?php } ?>
        </div>
    </div>
    <!-- button -->

</div>

</div>

<button class="profile-btn ms-2 fs-6 mt-4 show-more">Show More</button>
</div>
<div class="col-lg-12 col-xl-4">
    <!-- video section -->
    <div class="video-section embed-responsive embed-responsive-21by9">

        <?php 
        if(isset($teacher_data[0]->video_link) and $teacher_data[0]->video_link!=''){
            ?>
            <iframe class="embed-responsive-item" src="{{url('/')}}/public/videos/{{$teacher_data[0]->video_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <?php 
        }else{       
            echo '<div>video not found.</div>';
        }       
        ?>
        <div class="video-info">
            <div class="info-header d-flex flex-row justify-content-evenly mt-3">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <span><i class="fa-solid fa-star"></i> 5</span>
                    <span> 1 Review </span>
                </div>
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <span> 
                     <?php 
                     foreach ($hour_rate as $key => $rateAll_data1) { 
                      if($teacher_data[0]->hourly_rate==$rateAll_data1->id){
                        echo '$'.$rateAll_data1->hourly_rate;
                    }
                }
                ?>


            </span>
            <span> Per Hour </span>
        </div>
    </div>
    <div class="buttons d-flex flex-column align-items-center">
        <a href="#"><button class="custom-btn custom-btn-bg my-3">Book Trial Lesson</button></a>
        <a href="#"><button class="custom-btn">Send Message</button></a>
    </div>
    <div class="d-flex flex-row align-items-center my-3 p-3">
        <span><i class="fa-solid fa-arrow-trend-up"></i></span>
        <p class="ms-auto">4 Lessons booked in the last 48 hours</p>
    </div>
    <div class="video-info-footer d-flex flex-row p-3">
        <span class="star-bg"><i class="fa-solid fa-star" id="v-star"></i></span>
        <div class="group ms-4">
            <strong>Super popular</strong>
            <br>
            <p class="text-start">16 students contacted this tutor in the last 48 hours</p>
        </div>
    </div>
</div>
</div>
</div>

</div>
</div>
</section>
<!-- end tutor details section -->

<!-- text -->
<h1 class="text-dark fw-bold fs-4 text-center mt-5">Find Tutors</h1>

<!-- start banner section -->
<section class="apps-banner">
    <div class="container">
        <div class="apps-banner-main">
            <div class="row align-items-center">
                <div class="col-lg-7" data-aos="fade-up">
                    <div class="apps-banner-left">
                        <h2>{{$content[0]->sec5_heading}}</h2>
                        <p class="mb-3 text-start"> {{$content[0]->sec5_desc}} </p>
                        <div class="button-group">
                            <a class="" href="{{$content[0]->sec5_apple_store_url}}"><img src="{{url('/')}}/public/assets/frontpage_assets/images/app-store.png" alt=""></a>
                            <a class="ms-md-3 ms-sm-0" href="{{$content[0]->sec5_play_store_url}}"><img src="{{url('/')}}/public/assets/frontpage_assets/images/goole.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" data-aos="fade-up">
                    <div class="apps-banner-right"><img src="{{url('/')}}/public/images/{{$content[0]->sec5_file}}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('/frontend/common/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{url('/')}}/public/fullcalendar/lib/moment.min.js"></script>
<script src="{{url('/')}}/public/fullcalendar/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://static.cloudflareinsights.com/beacon.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fecha/2.3.1/fecha.min.js"></script>

<script>
    $('.date-display').datepicker({});

       /* $('#schedule-calendar').fullCalendar({
          defaultView: 'agendaFourDay',
          groupByResource: true,
          header: {
            left: 'prev,next',
            center: 'title',
            right: 'agendaDay,agendaFourDay,month,'
        },
        views: {
            agendaFourDay: {
              type: 'agenda',
              duration: { days: 7 }
          }
        },
              events: "{{url('/')}}/getcalendar_fronted/<?php echo $teacher_data[0]->student_no; ?>",
        });*/

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('schedule-calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek,timeGridDay'
            },
            defaultView: 'timeGridWeek',  
            selectable: true,
            editable:true,   
            events: "{{url('/')}}/getcalendar/<?php echo $teacher_data[0]->student_no; ?>", 

            eventDataTransform: function(event,element,info) {
                if (event.status == 'time_off') {
                    event.editable = false; 
                    event.color = "red";
                    
                }
                return event;
            }, 
        });


        calendar.render();
        calendar.changeView('timeGridWeek');
    });
    
</script>

<script type="text/javascript">
   $(".profile ul li a").click(function(){
    $(".show-more").text(function(i, v){
       return v === 'Show More' ? 'Show Less' : 'Show More'
   })
    $('.proView').toggleClass('act');
    $(".proView").addClass("act");
});
</script>