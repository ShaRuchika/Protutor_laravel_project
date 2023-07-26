@include('/dashboard/common/header')
@include('/dashboard/common/sidebar')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="{{url('/')}}/public/fullcalendar/fullcalendar.min.css" />

<!-- Container -->
<section class="wrapper">
    <div class="page-title">
      <h1>Tutors</h1>
  </div>

  <ul class="nav tab-nav">
    <li class="nav-item">
        <a href="{{url('/tutors')}}">
            <button><span><i class="fa-solid fa-chevron-left"></i></span> Back to Tutors</button>
        </a>
    </li>
</ul>

<div class="tutor-details-wrap">
    <div class="tutor-details-left">
        <div class="box">
            <div class="tutor-list-single alt">
                <div class="tutor-list-left">
                  <div class="tutor-list-img">
                    <a href="#"><img src="{{url('/')}}/public/images/{{$teacher_data[0]->profile_img}}" alt=""></a>
                </div>
                <div class="tutor-list-txt">
                    <div class="tutor-list-info">
                      <h5><a href="#">{{$teacher_data[0]->first_name.' '.$teacher_data[0]->last_name}}&nbsp; </a></h5>
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
                        echo '<span class="verify"><i class="fas fa-user-check" style="color: #3f8307;"></i></span>';
                    }else{
                        echo '<span class="verify"><i class="fa-solid fa-user-xmark" style="color: red;"></i></span>';
                    }
                    ?>
                    <span class="tutor-stat"><i class="fa-solid fa-circle"></i> Online</span>
                </div>
                <p class="pt-2 pb-2"><strong>{{!empty($degree[0]->degree_name)? $degree[0]->degree_name : 'NA'}} Degrees in {{!empty($degree[0]->specialization) ? $degree[0]->specialization : 'NA'}} with {{$years_of_Exp}} years of experience</strong></p>

                <div class="tutor-spec"><span><i class="fa-solid fa-graduation-cap"></i></span><span><strong>Teaches</strong></span> 
                 <?php 
                 foreach ($subjects as $key => $value) { 
                  $medi_arr = explode(',', $teacher_data[0]->subject);  
                  if(count($medi_arr) > 1){
                    if(in_array($value->id, $medi_arr)){
                        echo '<span class="text-dark">'.$value->subject.'</span>';
                    }
                }else{
                    if($teacher_data[0]->subject==$value->id){
                      echo '<span class="text-dark">'.$value->subject.'</span>';
                  }
              }
          }
          ?> 
      </div>

      <div class="tutor-spec"><span><i class="fa-solid fa-comments"></i></span><span><strong>Speaks:</strong></span><span>
        <?php 
        foreach ($languages as $key => $native_lan) { 
/*        echo "<pre>";
print_r($languages); die;*/
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
echo '<span class="spec">Native</span> ';
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
echo '&nbsp;&nbsp;<span class="spec adv">Advanced</span>';
?> 
</div>

<div class="tutor-spec"><span><i class="fa-solid fa-book"></i></span><span><strong>Lessons</strong></span> <span>0</span></div>
</div>
</div>
</div>

<div class="tutor-menu">
 <ul>
     <li><a class="anchor" href="#link-1">About</a></li>
     <li><a class="anchor" href="#link-2">Schedule</a></li>
     <li><a class="anchor" href="#link-3">Reviews (1)</a></li>
     <li><a class="anchor" href="#link-4">Resume</a></li>
 </ul>
</div>
</div>

<div class="box mt-3" id="link-1">
 <div class="tab-title">
     <h2>About</h2>
 </div>
 <div class="tutor-about">
     <p class="pt-0">{{$teacher_data[0]->desc_about}}</p>
 </div>
</div>

<div class="box mt-3" id="link-2">
 <div class="tab-title">
     <h2>Schedule</h2>
 </div>
 <div class="tutor-schedule">
  <div id="schedule-calendar"></div>
</div>
</div>

<div class="box mt-3" id="link-3">
    <div class="tab-title">
        <h2>What Student Says</h2>
    </div>
    <div class="tutor-says">
        <div class="feedback-sec">
            <div class="feedback-sec-left">
                <div class="feedback-sec-left-main">
                    <h5>5</h5>
                    <p>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                        <span><i class="fa-solid fa-star"></i></span>
                    </p>
                    <p>2 Review</p>
                </div>
            </div>
            <div class="feedback-sec-right">
                <ul>
                    <li>
                        <div>5 Stars</div>
                        <div class="bar-feed">
                            <div class="bar-progress" style="width: 100%;"></div>
                        </div>
                        <div>(2)</div>
                    </li>
                    <li>
                        <div>4 Stars</div>
                        <div class="bar-feed">
                            <div class="bar-progress"></div>
                        </div>
                        <div>(0)</div>
                    </li>
                    <li>
                        <div>3 Stars</div>
                        <div class="bar-feed">
                            <div class="bar-progress"></div>
                        </div>
                        <div>(0)</div>
                    </li>
                    <li>
                        <div>2 Stars</div>
                        <div class="bar-feed">
                            <div class="bar-progress"></div>
                        </div>
                        <div>(0)</div>
                    </li>
                    <li>
                        <div>1 Stars</div>
                        <div class="bar-feed">
                            <div class="bar-progress"></div>
                        </div>
                        <div>(0)</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="student-review">
            <div class="student-review-single">
                <div class="student-review-img"><img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg" alt=""></div>
                <div class="student-review-txt">
                    <h6>Name of the student <span><i class="fa-solid fa-star"></i> 5</span></h6>
                    <p class="txt-green"><small>October 10, 2021</small></p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
            <div class="student-review-single">
                <div class="student-review-img"><img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg" alt=""></div>
                <div class="student-review-txt">
                    <h6>Name of the student <span><i class="fa-solid fa-star"></i> 5</span></h6>
                    <p class="txt-green"><small>October 10, 2021</small></p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="box mt-3" id="link-4">
    <div class="tab-title mb-0">
        <h2>Resume</h2>
    </div>
    <div class="tutor-resume">
        <div class="tutor-resume-block">
            <h6>Education</h6>
            <?php foreach ($degree as $key => $education) 
            { ?>
                <div class="resume-block-single">
                    <div class="resume-block-left">{{$education->year_of_study}}</div>
                    <div class="resume-block-right">
                        <p>
                            <strong>{{$education->university_name}}</strong> <br>
                            <small>{{$education->specialization}}</small> <br>
                            <?php 
                            if($teacher_data[0]->profile_verified == 1){
                                echo '<small class="txt-green"><i class="fa-regular fa-circle-check"></i> Degree is verified by Tutors Online Verification team</small>';
                            }else{
                                echo '<small class="txt-red"><i class="fa-regular fa-circle-xmark"></i> Degree is not Degree verified by Tutors Online Verification team</small>';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="tutor-resume-block">
            <h6>Work Experience</h6>
            <?php foreach ($experience as $key => $years) 
            { ?>
                <div class="resume-block-single">
                    <div class="resume-block-left">{{$years->period_of_employment}}</div>
                    <div class="resume-block-right">
                        <p>
                            <strong>{{$years->company_name}}</strong> <br>
                            <small>{{$years->position}}</small> <br>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="tutor-resume-block">
            <h6>Certification</h6>
            <?php foreach ($certificateAll as $key => $certificate) 
            { ?>
                <div class="resume-block-single">
                    <div class="resume-block-left">{{$certificate->year_of_study}}</div>
                    <div class="resume-block-right">
                        <p>
                            <strong>{{$certificate->issued_by}}</strong> <br>
                            <small>{{$certificate->certificate_name}}</small> <br>

                            <?php 
                            if($teacher_data[0]->profile_verified == 1){
                                echo '<small class="txt-green"><i class="fa-regular fa-circle-check"></i> Certificate is verified by Tutors Online Verification team</small>';
                            }else{
                                echo '<small class="txt-red"><i class="fa-regular fa-circle-xmark"></i>Certificate is not Degree verified by Tutors Online Verification team</small>';
                            }
                            ?>

                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

</div>
<div class="tutor-details-right">
    <div class="box">
        <div class="tutor-list-single alt">
            <div class="tutor-list-right">
                <div class="tutor-video">
                    <?php 
                    if(isset($teacher_data[0]->video_link) and $teacher_data[0]->video_link!=''){
                        ?>
                        <iframe class="embed-responsive-item" src="{{url('/')}}/public/videos/{{$teacher_data[0]->video_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        <?php 
                    }else{       
                        echo '<div>video not found.</div>';
                    }       
                    ?>
                </div>
                <div class="tutor-info">
                    <ul>
                        <li><span><i class="fa-solid fa-star"></i> 5</span> 
                            <span>
                                <?php 
                                foreach ($hour_rate as $key => $rateAll_data1) { 
                                  if($teacher_data[0]->hourly_rate==$rateAll_data1->id){
                                    echo '$'.$rateAll_data1->hourly_rate;
                                }
                            }
                            ?>
                        </span>
                    </li>
                    <li><span>1 Review</span> <span>Per Hour</span></li>
                </ul>
            </div>
            <div class="pt-2">
                <a class="theme-btn-sm full" href="">Book Trial Lesson</a>
                <a class="theme-btn-sm full bdr mt-2" href="chat.html">Send Message</a>
            </div>
            <div class="lesson-time"><i class="fa-solid fa-chart-line"></i> 4 Lessons booked in the last 48 hours</div>
            <div class="pop-badge">
                <div class="pop-badge-left"><i class="fa-solid fa-star"></i></div>
                <div class="pop-badge-right">
                    <p><strong>Super popular</strong></p>
                    <p>16 students contacted this tutor in the last 48 hours</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

</section>
<!-- Container -->

<!-- Footer -->
<footer class="site-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4">
                <p>+00 000 000 000 <span>support@tutorsonline.com</span></p>
            </div>
            <div class="col-xl-4">
                <p class="text-center">All Rights Reserved by Tutors Online</p>
            </div>
            <div class="col-xl-4">
                <p class="text-end">Designed & Developed With Love by Coding Pro</p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer -->

</div>  


<div class="modal common-modal modal-full modal-slot fade" id="booking-screen">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="txt-orange"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body d-block">
                <div id="booking_screen_data">

                </div>

            </div>
        </div>
    </div>
</div>




@include('/dashboard/common/footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{url('/')}}/public/fullcalendar/lib/moment.min.js"></script>
<script src="{{url('/')}}/public/fullcalendar/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://static.cloudflareinsights.com/beacon.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fecha/2.3.1/fecha.min.js"></script>  
<script>
    $('.date-display').datepicker({});


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

            eventClick: function (eventClickInfo, jsEvent, view) {  

                eventID = eventClickInfo.el.fcSeg.eventRange.def.publicId;
                var student_no = '<?php echo $teacher_data[0]->student_no; ?>';

                //$('#booking-screen').modal('toggle');
                //$('#booking-screen').modal('show');    

                if(eventID){


                    $.ajax({
                        url:"{{url('/')}}/purchase-data",
                        data : {'eventID': eventID},
                        type:"POST",
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
                        }, 
                        success:function(resource)
                        {
                            if(resource.status == "time_off"){ 
                                $('#booking-screen').modal('hide');
                            }else{
                                $.ajax({
                                    url:"{{url('/')}}/purchase-lession-by-student",
                                    data : {'eventID': eventID,'student_no': student_no},
                                    type:"POST",
                                    headers: {
                                        'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
                                    }, 
                                    success:function(resource)
                                    { 
                                        $("#booking_screen_data").html(resource);
                                        $('#booking-screen').modal('toggle');
                                        $('#booking-screen').modal('show');
                                    }
                                }) 
                            }
                        }
                    }) 
                }                
            },

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