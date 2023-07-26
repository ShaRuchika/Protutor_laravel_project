@include('/admin/common/header')

<div class="dashboard-wrap">
 @include('/admin/common/sidebar')

 <div class="main-wrapper">

  <div class="report-stat mt-0">
    <div class="report-stat-left">
      <p>The teacher will not be visible on the teacher listing if you deactivate or delete any preference from this section provided he has only that particular preference selected at his end</p>
    </div>
    <div class="report-stat-right">
      <a class="site-link small" href="" data-bs-toggle="modal" data-bs-target="#modal-4"><i class="fa-solid fa-plus"></i> Create New  User</a>
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
        <form action="{{url('admin/hourly_rate')}}" method="get">
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
                <button class="site-link bdr sm">Clear</button>
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
            <th>HOURLY RATE</th>
            <th>DATE</th>
            <th class="text-center">ACTIONS</th>
          </tr>
        </thead>

        <tbody>
         <?php if(isset($rateAll) && !empty($rateAll)){ ?> 
          @php
          $i = 1; 
          @endphp
          @foreach($rateAll as $data)
          <tr>
            <td>{{$i}}</td>
            <td>{{$data-> hourly_rate}}</td>
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
                    <li><a href="{{ url('admin/hourly_rate/delete_rate/'.$data->id) }}" onclick="return confirm('Are you sure?')">Delete</a></li>
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
        if(count($rateAll) =="0"){
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
            echo $rateAll->appends($params)->render("pagination::bootstrap-4")  ;
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
        <h5 class="fw-500">Hourly Rate Setup</h5>
        <div class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
      </div>
      <form method="post" action="{{url('admin/hourly_rate/create_rate')}}">
        @csrf
        <div class="modal-body ps-5 pe-5">
          <div class="inp-outer">
            <label for="">Hourly Rate</label>
            <input class="input" type="text" name="hourly_rate" placeholder="">
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
        <h5 class="fw-500">Edit Hourly Rate</h5>
        <div class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
      </div>
      <form method="post" action="{{url('admin/hourly_rate/update_rate')}}">
        @csrf
        <div class="modal-body ps-5 pe-5">
          <input type="hidden" name="id" value="id" class="data_id" id="data_check_update_id">
          <div class="inp-outer">
            <label for="">Hourly Rate</label>
            <input class="input" id="data_check_update" type="text" name="hourly_rate" placeholder=""  >
          </div>
          <div class="modal-btn-group">
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
     $.ajax({
      headers: {
        'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
      },
      type : 'POST',
      url : "{{ url('/admin/hourly_rate/get_rate') }}",
      data : {'id': post_id},
      
      dataType : 'json',
      success : function(result){ 
        $('#data_check_update').val(result.hourly_rate);
        $('#data_check_update_id').val(result.id);
      }
    });     
   });
  });

</script>
@include('/admin/common/footer')