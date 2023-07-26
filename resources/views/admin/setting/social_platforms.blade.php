@include('/admin/common/header')

<div class="dashboard-wrap">

  @include('/admin/common/sidebar')
  <div class="main-wrapper">
    <div class="report-stat mt-0">
      <div>
        <p>
          <span class="fw-600">Manage Social Platforms</span> <br>
          Home / Social Platform
        </p>
      </div>
      <div><a href="" class="site-link small" data-bs-toggle="modal" data-bs-target="#modal-1"><i class="fa-solid fa-plus"></i> Create New  User</a></div>
    </div>

    <div class="table-wrap">
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
    <div class="table-responsive">
      <table class="table theme-table">
        <thead>
          <tr>
            <th>SN</th>
            <th>TITLE</th>
            <th>URL</th>
            <th>Status</th>
            <th class="text-center">ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <?php if(isset($platformAll) && !empty($platformAll)){ ?> 
            @php
            $i = 1; 
            @endphp
            @foreach($platformAll as $data)
            <tr>
              <td>{{$i}}</td>
              <td>{{$data->title}}</td>
              <td><a href="{{$data->url}}" target="_blank">{{$data->url}}</a></td>
              <td>
                <label class="switch platform_status_change"  data-id="{{$data->id}}">
                    <input type="checkbox" <?php echo ($data->user_status == 1 ? 'checked':"") ?> >
                    <span class="slider round"></span>
                  </label>
              </td>
              <td class="text-center">
                <div class="profile-dropdown">
                  <div class="dropdown">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa-solid fa-ellipsis-vertical"></i>
                    </div>
                    <ul class="dropdown-menu">
                      <li><a class="edit" href="" data-id="{{$data->id}}" data-bs-target="#modal-2" data-bs-toggle="modal">Edit</a></li>
                       <li><a href="{{ url('admin/social_platform/delete_platform/'.$data->id) }}" onclick="return confirm('Are you sure?')">Delete</a></li>
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
           if(count($platformAll) =="0"){
            echo "<tr><td>";
            echo "<h4>Record not found</h4>";
            echo "</td></tr>";
          }
          ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="5">   
              <?php 
              echo $platformAll->render("pagination::bootstrap-4")  ;
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


<div class="modal theme-modal fade" id="modal-1">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-500">Meeting Tool Setup</h5>
        <div class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
      </div>
      <form method="post" action="{{url('admin/social_platform/create_platform')}}">
        @csrf
        <div class="modal-body ps-5 pe-5">
          <div class="inp-outer mt-0">
            <label for="">Identifier</label>
            <input class="input" type="text" name="create_identifier" value="">
          </div>
          <div class="inp-outer">
            <label for="">Link</label>
            <input class="input" type="text" name="create_link" placeholder="">
          </div>
        </div>
        <div class="modal-footer d-block">
          <div class="modal-btn-group mt-0 text-center">
           <button class="site-link sm" data-bs-dismiss="modal" type="submit">Save</button>
         </div>
       </div>
     </form>
   </div>
 </div>
</div>  
<div class="modal theme-modal fade" id="modal-2">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-500">Meeting Tool Setup</h5>
        <div class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
      </div>
      <form method="post" action="{{url('admin/social_platform/edit_platform')}}">
        @csrf
        <input type="hidden" name="id" value="id" class="data_id" id="data_check_update_id">
        <div class="modal-body ps-5 pe-5">
          <div class="inp-outer mt-0">
            <label for="">Identifier</label>
            <input class="input" id="check_title" name="title" type="text">
          </div>
          <div class="inp-outer">
            <label for="">Link</label>
            <input class="input" id="check_url" name="url" type="text">
          </div>
        </div>
        <div class="modal-footer d-block">
          <div class="modal-btn-group mt-0 text-center">
             <button class="site-link sm" data-bs-dismiss="modal" type="submit">Save</button>
          </div>
        </div>
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
     console.log(post_id);
     $.ajax({
      headers: {
        'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
      },
      type : 'POST',
      url : "{{ url('/admin/social_platform/get_platform') }}",
      data : {'id': post_id},
      
      dataType : 'json',
      success : function(result){ 
        $('#check_title').val(result.title);
        $('#check_url').val(result.url);
        $('#data_check_update_id').val(result.id);
      }
    });     
   });
  });
  $( document ).ready(function() {
    $('.platform_status_change').change(function() {
     var status = $(this).prop('checked') == true ? 1 : 0;
     var id = $(this).attr('data-id');
     $.ajax({
      headers: {
        'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
      },
      url : "{{ url('admin/social_platform/platform_status_update') }}",
      data : {'status': status, 'id': id},
      type : 'GET',
      dataType : 'json',
      success : function(result){
        console.log(result);
      }
    });

   })
  });
</script>

@include('/admin/common/footer')
