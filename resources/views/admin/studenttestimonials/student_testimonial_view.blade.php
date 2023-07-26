@include('/admin/common/header')

<div class="dashboard-wrap">
  @include('/admin/common/sidebar')

  <div class="main-wrapper">

    <div class="report-stat mt-0">
      <div class="report-stat-left">
        <p>The teacher will not be visible on the teacher listing if you deactivate or delete any preference from this section provided he has only that particular preference selected at his end</p>
      </div>
      <div class="report-stat-right">
        <a class="site-link small" href="" data-bs-toggle="modal" data-bs-target="#modal-4"><i class="fa-solid fa-plus"></i> Create New Testimonial</a>
      </div>
    </div>

    <div class="search-bar">
      <div class="inp-outer mt-0">
        <div class="inp-in icon-left">
          <input id="sarch-expand" class="input input-dark" type="text" placeholder="Search Users by Name, Email or Date">
          <span class="inp-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
        </div>
      </div>
      <div class="search-bar-group">
        <form action="{{url('admin/student-testimonials')}}" method="get">
          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="inp-outer">
                <label for="">Name</label>
                <input class="input" type="text" placeholder="" name="name" value="<?php echo (isset($_GET['name']) ? $_GET['name'] : ""); ?>">
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="inp-outer">
                <label for="">Reg Date From</label>
                <div class="inp-in">
                  <input class="input" type="date" placeholder="" name="register_from" value="<?php echo (isset($_GET['register_from']) ? $_GET['register_from'] : ""); ?>">
                  <span class="inp-icon"><i class="fa-solid fa-calendar-days"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="inp-outer">
                <label for="">Reg Date To</label>
                <div class="inp-in">
                  <input class="input" type="date" placeholder="" name="register_to" value="<?php echo (isset($_GET['register_to']) ? $_GET['register_to'] : ""); ?>">
                  <span class="inp-icon"><i class="fa-solid fa-calendar-days"></i></span>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="inp-outer">
                <label class="blank" for="">&nbsp;</label>
                <button class="site-link sm">Search</button>
                <a href="{{url('admin/student-testimonials')}}" class="site-link bdr sm">Clear</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="table-wrap">
      <span style="color: red;">
        @if(session('success_msg'))  
        <div class="alert alert-success alert-dismissible"> 
          {{session('success_msg')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert"><span aria-hidden="true"></span>
          </button>
        </div>
        @elseif(session('error_msg'))
        <div class="alert alert-danger alert-dismissible"> 
          {{session('error_msg')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert"><span aria-hidden="true"></span>
          </button>
        </div>
        @endif 
      </span>
      <div class="table-responsive">
        <table class="table theme-table">
          <thead>
            <tr>
              <th>SN</th>
              <th>Image</th>
              <th>Student Name</th>
              <th>Description</th>
              <th>Star Rating</th>
              <th>Status</th>
              <th>DATE</th>
              <th class="text-center">ACTIONS</th>
            </tr>
          </thead>

          <tbody>
            <?php if(isset($Alltestimonial) && !empty($Alltestimonial)){ ?> 
              @php
              $i = 1; 
              @endphp
              @foreach($Alltestimonial as $data)
              <tr>
                <td>{{$i}}</td>
                <td>
                  <img style="height: 75px;" src="{{url('/')}}/public/images/{{$data->student_image}}">
                </td>
                <td>{{$data->student_name}}</td>
                <td style="white-space: normal;">{{$data->student_desc}}</td>
                <td>{{$data->student_rating}}</td>
                <td>
                  <label class="switch testimonial_status_change"  data-id="{{$data->id}}">
                    <input type="checkbox" <?php echo ($data->user_status == 1 ? 'checked':"") ?> >
                    <span class="slider round"></span>
                  </label>
                </td>
                <td>
                  @php
                  echo date('M, jS Y h:i:s A',strtotime($data->created_at));
                  @endphp
                </td>
                <td class="text-center">
                  <div class="profile-dropdown">
                    <div class="dropdown">
                      <div class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                      </div>
                      <ul class="dropdown-menu">
                       <li><a class="edit" href="" data-id="{{$data->id}}" data-bs-target="#modal-3" data-bs-toggle="modal">Edit</a></li>
                       <li><a href="{{ url('admin/testimonial_delete/'.$data->id) }}" onclick="return confirm('Are you sure?')">Delete</a></li>
                     </ul>
                   </div>
                 </div>
               </td>
             </tr> 
             @php
             $i++;
             @endphp
             @endforeach
             <?php 
           }
           if(count($Alltestimonial) =="0"){
            echo "<tr><td>";
            echo "<h4>Record not found</h4>";
            echo "</td></tr>";
          }
          ?>
        </tbody>

        <tfoot>
          <tr>
            <th colspan="9">   
              <?php 
              echo $Alltestimonial->appends($params)->render("pagination::bootstrap-4")  ;
              ?> 
            </th> 
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

</div>
</div>

</div>  

<div class="modal theme-modal fade" id="modal-4">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-500">Student Testimonial Setup</h5>
        <div class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
      </div>
      <form method="post" action="{{url('admin/create_testimonial')}}" enctype="multipart/form-data" >
        @csrf
        <div class="modal-body ps-5 pe-5">
          <div class="inp-outer">
            <label for="">Student Name</label>
            <input class="input" type="text" name="name" placeholder="">
          </div>
          <div class="inp-outer">
                <label for="">Star Rating</label>
                <select class="input" name="star_rating" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
          </div>
          <div class="inp-outer">
            <label for="">Description</label>
            <textarea rows="5" cols="25" name="description"></textarea>
          </div>

          <div class="inp-outer">
            <label for="">Image</label>
            <input type="file" name="image">
          </div>
          
          <div class="modal-btn-group">
            <button class="site-link sm" data-bs-dismiss="modal" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>  


<div class="modal theme-modal fade" id="modal-3">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-500">Edit Student Testimonial</h5>
        <div class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
      </div>
      <form method="post" action="{{url('admin/update_testimonial')}}" enctype="multipart/form-data">
        @csrf
        <div id="result_data"></div>
      </form>
    </div>
  </div>
</div>  

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>    

<script type="text/javascript">
  $('document').ready(function(){
    $('.edit').on('click', function(event) {
     event.preventDefault();
     var post_id = $(this).data('id'); 
     $.ajax({
      headers: {
        'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
      },
      type : 'POST',
      url : "{{ url('/admin/edit_testimonial') }}",
      data : {'id': post_id},
       
      success : function(result){  
        $('#result_data').html(result);
        //$('#data_check_update_id').val(result.id);
      }
    });     
   });
  });
  $( document ).ready(function() {
    $('.testimonial_status_change').change(function() {
     var status = $(this).prop('checked') == true ? 1 : 0;
     var id = $(this).attr('data-id');
     $.ajax({
      headers: {
        'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
      },
      url : "{{ url('admin/testimonial_status_update') }}",
      data : {'status': status, 'id': id},
      type : 'GET',
      dataType : 'json',
      success : function(result){
        console.log(result);
        //location.reload(); 
      }
    });

   })
  });

</script>


@include('/admin/common/footer')
