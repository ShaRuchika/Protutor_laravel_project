@include('/dashboard/common/header')
@include('/dashboard/common/sidebar')
<!-- Container -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" href="{{url('/')}}/public/fullcalendar/fullcalendar.min.css" />

<?php 

$parts = explode("/", $_SERVER['REQUEST_URI']);
$getVal =  end($parts);  
$getId = Session::get('userid');
?>
<section class="wrapper">
	<div class="page-title">
		<h1>Calendar</h1>
	</div>

	<div>
		<ul class="nav tab-nav">
			<li class="nav-item">
				<button class="active" data-bs-toggle="tab" data-bs-target="#tab-1">
					<span><i class="fa-solid fa-book"></i></span> Schedule new lesson
				</button>
			</li>
			<li class="nav-item">
				<button data-bs-toggle="tab" data-bs-target="#tab-2">
					<span><i class="fa-regular fa-clock"></i></span> Add time off
				</button>
			</li>
			<li class="nav-item">
				<button data-bs-toggle="tab" data-bs-target="#tab-3">
					<span><i class="fa-regular fa-calendar-check"></i></span> Set up availability
				</button>
			</li>
		</ul>

		<div class="tab-content pt-3">
			<div class="tab-pane fade show active" id="tab-1">
				<div class="calendar-wrap">
					<div class="calendar-left">
						<div class="box">
							<div class="date-display"></div>
							<!-- <div class="calendar-tags">
								<h5>Tags</h5>
								<label class="custom-check">First lesson
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
								<label class="custom-check">Single lesson
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
								<label class="custom-check">Weekly lesson
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
								<label class="custom-check">Time off
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
								<label class="custom-check">Confirmed by student
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
								<label class="custom-check">Not confirmed by student
									<input type="checkbox">
									<span class="checkmark"></span>
								</label>
							</div> -->
						</div>
					</div>
					<div class="calendar-right">
						<div class="box">
							<!-- <div class="calendar-head">
								<div class="calendar-btn"><i class="fa-solid fa-chevron-left"></i></div>
								<div class="calendar-btn"><i class="fa-solid fa-chevron-right"></i></div>
								<span class="today">Oct 16 - 22, 2021</span>
							</div> -->
							<div class="table-responsive">

								<div id="schedule-calendar"></div>

								<div class="modal fade" id="schedule-add">

								</div> 

								<div id="event-action-response">
									<div class="schedule-box-wrap">
										<div class="schedule-box">
											<div class="schedule-box-close"><i class="fa-solid fa-xmark"></i></div>
											<div>
												<h3>Schedule New Lesson</h3>
												<form method="post" id="formSche">
													@csrf
													<div class="row">
														<div class="col-lg-6">
															<div class="row">
																<div class="col-lg-12">
																	<div class="block-inp-wrap">
																		<label for="">Starts</label>
																		<input type="datetime-local" class="block-inp" name="start_date" id="start_date" > 
																	</div>
																</div> 
															</div>
														</div>
														<div class="col-lg-6">
															<div class="row">
																<div class="col-lg-12">
																	<div class="block-inp-wrap">
																		<label for="">Ends</label>
																		<input type="datetime-local" class="block-inp" name="end_date" id="end_date" >
																	</div>
																</div>
															</div>
														</div>
													</div>
													<input class="block-inp" type="hidden"  name="student_no" id="student_no" value="<?php echo $getId; ?>" readonly>
													<!-- <div class="row">
														<div class="col-lg-6">
															<div class="block-inp-wrap">
																<label for="">Student Number</label>
																<input class="block-inp" type="text"  name="student_no" id="student_no" value="<?php //echo $getId; ?>" readonly>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="block-inp-wrap">
																<label for="">Student Name</label>
																<input class="block-inp" type="text" value="John Doe" id="student_name" readonly>
															</div>
														</div>
													</div> -->

													<div class="row">
														<div class="col-lg-6">
															<div class="block-inp-wrap">
																<label for="">Grade</label>
																<select class="block-inp" name="grade" id="grade" >
																	<option value="">Select Grade</option>
																	<?php 

																	foreach ($teache_level as $teache_level_val) 
																	{ 
																		?>
																		<option value="<?php echo $teache_level_val->id; ?>"><?php echo $teache_level_val->teaches_level; ?></option>
																		<?php 
																	}
																	?>
																</select>
															</div>
														</div>
														<div class="col-lg-6">
															<div class="block-inp-wrap">
																<label for="">Subject</label>
																<select class="block-inp" name="subject" id="subject" >
																	<option value="">Select Subject</option>
																	<?php 

																	foreach ($subject as $subject_val) 
																	{ 
																		?>
																		<option value="<?php echo $subject_val->id; ?>"><?php echo $subject_val->subject; ?></option>
																		<?php 
																	}
																	?>
																</select>
															</div>
														</div>
													</div>

													<div class="block-inp-wrap">
														<label for="">Note</label>
														<textarea class="block-inp" name="note" id="note" placeholder="Enter Note"></textarea>
													</div>
													<hr>
													<input type="hidden" name="id" id="id">
													<div class="text-center"><button class="link-bdr" type="button" id="clickBTN">Schedule Lesson</button></div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div id="calendar" class="time clickable"></div> 
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="tab-pane fade" id="tab-2">
				<div class="calendar-wrap">
					<div class="calendar-left disable">
						<div class="box">
							<div class="date-display"></div>
							<div class="calendar-tags">
								

							</div>
						</div>
					</div>
					<div class="calendar-right">
						<div class="box position-relative">
							<div class="time-off">
								<div class="tab-title d-flex align-items-center justify-content-between">
									<h2>Schedule time off</h2>
									
								</div>
								<div class="row">
									<form method="post" id="schedule_form">
										<input type="hidden" name="student_no_s" value="<?php echo $getId; ?>" id="student_no_s">
										<div class="col-lg-8">
											<div id="msgSchedule"></div>
											<div class="block-inp-wrap mt-0">
												<label for="">Title</label>
												<input class="block-inp" type="text" placeholder="Busy" name="note_s" id="note_s">
											</div>

											<div class="block-inp-wrap">
												<label for="">Starts</label>
												<div class="row">
													<div class="col-lg-12">
														<input type="datetime-local" class="block-inp" name="start_date_s" id="start_date_s" > 
													</div>
													<div class="col-lg-5"></div>
												</div>
											</div>

											<div class="block-inp-wrap">
												<label for="">Ends</label>
												<div class="row">
													<div class="col-lg-12">
														<input type="datetime-local" class="block-inp" name="end_date_s" id="end_date_s" >
													</div> 
												</div>
											</div>

											<hr>

											<div class="block-inp-wrap text-center"><button class="link-bdr" type="button" id="schedule_form_btn">Schedule time off</button></div> 
										</div>
									</form>
								</div>
							</div>

						</div>
					</div>
					<div class="schedule-box-wrap">
						<div class="schedule-box">
							<div class="schedule-box-close"><i class="fa-solid fa-xmark"></i></div>
							<div>
								<h3>Schedule New Lesson</h3>
								<div class="row">
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-7">
												<div class="block-inp-wrap">
													<label for="">Starts</label>
													<select class="block-inp" name="" id="">
														<option value="">22 - 10 - 2021</option>
													</select>
												</div>
											</div>
											<div class="col-lg-5">
												<div class="block-inp-wrap">
													<label for="">&nbsp;</label>
													<select class="block-inp" name="" id="">
														<option value="">17:00</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-7">
												<div class="block-inp-wrap">
													<label for="">Ends</label>
													<select class="block-inp" name="" id="">
														<option value="">22 - 10 - 2021</option>
													</select>
												</div>
											</div>
											<div class="col-lg-5">
												<div class="block-inp-wrap">
													<label for="">&nbsp;</label>
													<select class="block-inp" name="" id="">
														<option value="">17:00</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="block-inp-wrap">
											<label for="">Student Number</label>
											<input class="block-inp" type="text" placeholder="Enter Student Number">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="block-inp-wrap">
											<label for="">Student Name</label>
											<input class="block-inp" type="text" value="John Doe" readonly>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6">
										<div class="block-inp-wrap">
											<label for="">Grade</label>
											<select class="block-inp" name="" id="">
												<option value="">Select Grade</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="block-inp-wrap">
											<label for="">Subject</label>
											<select class="block-inp" name="" id="">
												<option value="">Select Subject</option>
											</select>
										</div>
									</div>
								</div>

								<div class="block-inp-wrap">
									<label for="">Note</label>
									<textarea class="block-inp" name="" id="" placeholder="Enter Student Number"></textarea>
								</div>

								<hr>
								<div class="text-center"><button class="link-bdr">Schedule Lesson</button></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="tab-3">
				<div class="calendar-wrap">
					<div class="calendar-left disable">
						<div class="box">
							<div class="date-display"></div>
							<div class="calendar-tags">
							</div>
						</div>
					</div>
					<div class="calendar-right">
						<div class="box position-relative">
							<div class="time-off">
								<div class="tab-title d-flex align-items-center justify-content-between">
									<h2>Set up availability</h2>

								</div>
								<div class="row">
									<form method="post" id="availability_schedule_form">
										<input type="hidden" name="student_no_a" value="<?php echo $getId; ?>" id="student_no_a">
										<div class="col-lg-12">
											<div id="availability_msgSchedule"></div>
											<div class="block-inp-wrap">
												<label for="">Starts</label>
												<div class="row">
													<div class="col-lg-8">
														<input type="datetime-local" class="block-inp" name="start_date_a" id="start_date_a" > 
													</div>
													<div class="col-lg-5"></div>
												</div>
											</div>

											<div class="block-inp-wrap">
												<label for="">Ends</label>
												<div class="row">
													<div class="col-lg-8">
														<input type="datetime-local" class="block-inp" name="end_date_a" id="end_date_a" >
													</div> 
												</div>
											</div>

											<div class="row">
												<div class="col-lg-6">
													<div class="block-inp-wrap">
														<label for="">Grade</label>
														<select class="block-inp" name="grade_a" id="grade_a" >
															<option value="">Select Grade</option>
															<?php 

															foreach ($teache_level as $teache_level_val) 
															{ 
																?>
																<option value="<?php echo $teache_level_val->id; ?>"><?php echo $teache_level_val->teaches_level; ?></option>
																<?php 
															}
															?>
														</select>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="block-inp-wrap">
														<label for="">Subject</label>
														<select class="block-inp" name="subject_a" id="subject_a" >
															<option value="">Select Subject</option>
															<?php 

															foreach ($subject as $subject_val) 
															{ 
																?>
																<option value="<?php echo $subject_val->id; ?>"><?php echo $subject_val->subject; ?></option>
																<?php 
															}
															?>
														</select>
													</div>
												</div>
											</div>

											<div class="block-inp-wrap">
												<label for="">Note</label>
												<textarea class="block-inp" name="note_a" id="note" placeholder="Enter Note"></textarea>
											</div>
											<hr>

											<div class="block-inp-wrap text-center"><button class="link-bdr" type="button" id="availability_schedule_form_btn">Schedule</button></div> 
										</div>
									</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


@include('/dashboard/common/footer') 
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/tilt.js@1.2.1/dest/tilt.jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{url('/')}}/public/fullcalendar/lib/moment.min.js"></script>
<script src="{{url('/')}}/public/fullcalendar/fullcalendar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://static.cloudflareinsights.com/beacon.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fecha/2.3.1/fecha.min.js"></script>

<style type="text/css">
	.disabled {
		background-color: red;
	}
</style>
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
			events: "{{url('/')}}/getcalendar/<?php echo $getId; ?>",
			dateClick: function(info) {
				

				$('.schedule-box-wrap').toggleClass('act'); 

				var startDateTime1 = info.dateStr;
				var newDateTime1 = moment(startDateTime1, "YYYY-MM-DD hh:mm A")
				.add(0, 'minute')
				.format('YYYY-MM-DD HH:mm');

				var startDateTime = info.dateStr;
				var newDateTime = moment(startDateTime, "YYYY-MM-DD hh:mm A")
				.add(1, 'hours')
				.format('YYYY-MM-DD HH:mm');


				$("#start_date").val(newDateTime1);
				$("#end_date").val(newDateTime);			

			},
			select: function(info) { 
				
				$('#clickBTN').on('click',function () { 
					

					if($('#start_date').val() == "" || $('#end_date').val() =="" || $('#grade').val() =="" || $('#subject').val() ==""  || $('#note').val() ==""){
						alert('All field is require');
					}else{
						$.ajax({
							url:"{{url('/')}}/calendar",
							type:"POST",
							data:$("#formSche").serialize(),
							success:function(datas)
							{  
								calendar.refetchEvents(); 
								location.reload(true);
								$("#event-action-response").html("Event added Successfully");
								$("#event-action-response").show();
							}
						})
					} 
				}) 
			}, 
			eventClick: function (eventClickInfo, jsEvent, view) {  

				
				eventID = eventClickInfo.el.fcSeg.eventRange.def.publicId;
				if(eventID){

					$.ajax({
						url:"{{url('/')}}/get-event-by-id/"+eventID,
						type:"POST",
						headers: {
							'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
						}, 
						success:function(resource)
						{	
							if(resource.status =='time_off'){
								return false;
							}else{
								$('.schedule-box-wrap').toggleClass('act'); 
							}

							//subtract(15, 'minutes')
							var startDateTime = resource.start_date;
							var newDateTime = moment(startDateTime, "YYYY-MM-DD hh:mm A").format('YYYY-MM-DD HH:mm');

							var startDateTime1 = resource.end_date;
							var newDateTime1 = moment(startDateTime1, "YYYY-MM-DD hh:mm A").format('YYYY-MM-DD HH:mm');

							$('#note').val(resource.note);
							$('#id').val(resource.id);
							$('#start_date').val(newDateTime);
							$('#end_date').val(newDateTime1); 
							$('#grade').val(resource.grade).change();
							$('#subject').val(resource.subject).change();
						}
					}) 
				}

				$('#clickBTN').attr('id','editCal');

				if(eventID !=""){

					$('#editCal').on('click',function () {
						if($('#start_date').val() == "" || $('#end_date').val() =="" || $('#grade').val() =="" || $('#subject').val() ==""  || $('#note').val() ==""){
							alert('All field is require');
						}else{
							$.ajax({
								url:"{{url('/')}}/editcalendar",
								type:"POST",
								headers: {
									'X-CSRF-TOKEN': '<?php //echo csrf_token() ?>'
								},
								data:$("#formSche").serialize(),
								success:function(resource)
								{
									calendar.refetchEvents(); 
									$("#event-action-response").html("Event update Successfully");
									$("#event-action-response").show();
								}
							}) 
							//calendar.fullCalendar('unselect');
							location.reload(true);
							calendar.unselect(); 
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

	/*$(document).ready(function() {
		var calendar = $('#schedule-calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				 right: 'agendaDay,agendaFourDay'
			},
			defaultView: 'agendaFourDay',   
			groupByResource: true,
			events: "{{url('/')}}/getcalendar/<?php //echo $getId; ?>",
			editable:true, 
			selectable:true,  
			selectHelper: true,
			views: {
				agendaFourDay: {
					type: 'agenda',
					duration: { days: 4 }
				}
			},
			dateClick: function(id,start,end,info) {
				$('#formSche')[0].reset();
				console.log(start);
				$('#start_date').val($.fullCalendar.formatDate(start, "Y-MM-DD HH:MM"));  
				$('#end_date').val($.fullCalendar.formatDate(start, "Y-MM-DD HH:MM"));  

				$('#clickBTN').on('click',function () { 

					if($('#start_date').val() == "" || $('#end_date').val() =="" || $('#grade').val() =="" || $('#subject').val() ==""  || $('#note').val() ==""){
						alert('All field is require');
					}else{
						$.ajax({
							url:"{{url('/')}}/calendar",
							type:"POST",
							data:$("#formSche").serialize(),
							success:function(datas)
							{  
								calendar.fullCalendar('refetchEvents');
								$("#event-action-response").html("Event added Successfully");
								$("#event-action-response").show();
							}
						})
					} 
				})

			}, 
			eventClick: function (event, jsEvent, view) {  
				$('.schedule-box-wrap').toggleClass('act'); 
				$('#note').val(event.title);
				$('#id').val(event.id);
				$('#start_date').val(event.start.toISOString());
				$('#end_date').val(event.end.toISOString()); 
				$('#grade').val(event.grade).change();
				$('#subject').val(event.subject).change();

				$('#clickBTN').attr('id','editCal');


				if(event.title !=""){

					$('#editCal').on('click',function () {
						if($('#start_date').val() == "" || $('#end_date').val() =="" || $('#grade').val() =="" || $('#subject').val() ==""  || $('#note').val() ==""){
							alert('All field is require');
						}else{
							$.ajax({
								url:"{{url('/')}}/editcalendar",
								type:"POST",
								headers: {
									'X-CSRF-TOKEN': '<?php //echo csrf_token() ?>'
								},
								data:$("#formSche").serialize(),
								success:function(resource)
								{
									calendar.fullCalendar('refetchEvents');
									$("#event-action-response").html("Event update Successfully");
									$("#event-action-response").show();
								}
							}) 
							calendar.fullCalendar('unselect');
						}

					})
				}
			},

			dayClick: function(date, jsEvent, view) { 
					//$('#formSche')[0].reset();
					$('.schedule-box-wrap').toggleClass('act');
				}
			});
		}); */


		$('#schedule_form_btn').on('click',function () {
			if($('#note_s').val() == "" || $('#end_date_s').val() =="" || $('#note_s').val() ==""){
				alert('All field is require');
			}else{
				$.ajax({
					url:"{{url('/')}}/add-schedule",
					type:"POST",
					headers: {
						'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
					},
					data:$("#schedule_form").serialize(),
					success:function(resource)
					{ 
						if(resource == 'error'){
							
							$('#msgSchedule').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Schedule Already Set For This Time.<button type="button" class="btn-close" data-bs-dismiss="alert" ria-label="Close"></button></div>');
						}
						if(resource == 1){
							$('#schedule_form')[0].reset();
							$('#msgSchedule').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Schedule Add Successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" ria-label="Close"></button></div>');
						location.reload(true);
						}
					}
				}) 
			}
		})

		$('#availability_schedule_form_btn').on('click',function () {
			if($('#start_date_a').val() == "" || $('#grade_a').val() == "" || $('#subject_a').val() == "" || $('#end_date_a').val() =="" || $('#note_a').val() ==""){
				alert('All field is require');
			}else{
				$.ajax({
					url:"{{url('/')}}/add-availability-schedule",
					type:"POST",
					headers: {
						'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
					},
					data:$("#availability_schedule_form").serialize(),
					success:function(resource)
					{	
						//console.log(resource);
						if(resource == 'error'){
							
							$('#availability_msgSchedule').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Schedule Already Set For This Time.<button type="button" class="btn-close" data-bs-dismiss="alert" ria-label="Close"></button></div>');
						}
						if(resource == 1){

							$('#availability_schedule_form')[0].reset();
							$('#availability_msgSchedule').html('<div class="alert alert-success alert-dismissible fade show" role="alert">Schedule Add Successfully.<button type="button" class="btn-close" data-bs-dismiss="alert" ria-label="Close"></button></div>');
						location.reload(true);
						}
					}
				}) 
			}
		})

	</script>

	<script type="text/javascript"> 

  /*$('document').ready(function(){
    $('.edit').on('click', function(event) {
     event.preventDefault();
     var post_id = $(this).data('id'); 
     $.ajax({
      headers: {
        'X-CSRF-TOKEN': '<?php //echo csrf_token() ?>'
      },
      type : 'POST',
      url : "{{ url('/admin/spoken_language/get_spoken_language') }}",
      data : {'id': post_id},
      
      dataType : 'json',
      success : function(result){ 
        $('#data_check_update').val(result.spoken_language);
        $('#data_check_update_id').val(result.id);
      }
    });     
   });
});*/ 

</script>