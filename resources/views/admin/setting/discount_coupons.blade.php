@include('/admin/common/header')

<div class="dashboard-wrap">

  @include('/admin/common/sidebar')

  <div class="main-wrapper">
    <div class="report-stat mt-0">
      <div class="report-stat-left">
        <p>
         <span class="fw-600">Manage Coupons</span> <br>
         Home / Coupons
       </p>
     </div>
     <div class="report-stat-right">
      <a class="site-link small" href="" data-bs-toggle="modal" data-bs-target="#modal-4"><i class="fa-solid fa-plus"></i> Create New Coupon</a>
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
     <form action="{{url('admin/discount_coupon')}}" method="get">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="inp-outer">
            <label for="">Coupon Identifier</label>
            <input class="input" type="text" placeholder="" name="identifer" value="<?php echo (isset($_GET['identifer']) ? $_GET['identifer'] : ""); ?>">
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="inp-outer">
            <label for="">Starts Date</label>
            <div class="inp-in">
              <input class="input" type="date" placeholder="" name="starts_from" value="<?php echo (isset($_GET['starts_from']) ? $_GET['starts_from'] : ""); ?>">
              <span class="inp-icon"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="inp-outer">
            <label for="">End Date</label>
            <div class="inp-in">
              <input class="input" type="date" placeholder="" name="ends_to" value="<?php echo (isset($_GET['ends_to']) ? $_GET['ends_to'] : ""); ?>">
              <span class="inp-icon"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="inp-outer">
            <label for="">Status</label>
            <select class="input" name="status" >
              <option value="">Select</option>
              <option value="1" <?php echo ((isset($_GET['status']) && $_GET['status'] == 1) ? "selected" : ""); ?> >Active</option>
              <option value="0" <?php echo ((isset($_GET['status']) && $_GET['status'] == 0) ? "selected" : ""); ?> >Inactive</option>
            </select>
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
          <th>Title</th>
          <th>Code</th>
          <th>DISCOUNT</th>
          <th>Available</th>
          <th>Status</th>
          <th class="text-center">ACTIONS</th>
        </tr>
      </thead>
      <tbody>
       <?php if(isset($Discount_coupons) && !empty($Discount_coupons)){ ?> 
        @php
        $i = 1; 
        @endphp
        @foreach($Discount_coupons as $data)
        <tr>
          <td>{{$i}}</td>
          <td>{{$data->coupon_identifier}}</td>
          <td>{{$data->coupon_code}}</td>
          <td>{{$data->discount}}%</td>
          <td>{{$data->start_date.' - '.$data->end_date}}</td>
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
                  <li><a class="edit" href="" data-id="{{$data->id}}" data-bs-target="#modal-3" data-bs-toggle="modal">Edit</a></li>
                  <li><a href="{{ url('admin/discount_coupon/delete_coupon/'.$data->id) }}" onclick="return confirm('Are you sure?')">Delete</a></li>
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
      if(count($Discount_coupons) =="0"){
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
        echo $Discount_coupons->appends($params)->render("pagination::bootstrap-4")  ;
        ?> 
      </th> 
    </tr>
    </tfoot>
  </table>
</div>
</div>
</div>
</div>  

<div class="modal theme-modal fade" id="modal-4">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-500">Meeting Tool Setup</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('admin/discount_coupon/create_coupon')}}" method="post" style="overflow: auto;">
        @csrf()
        <div class="modal-body pt-3 pb-3">
         <div class="ps-3 pe-3">
          <div class="inp-outer mt-0">
            <label for="">Coupon Identifier</label>
            <input class="input" type="text" name="identifier" required>
            <span style="color: red;">@if($errors->has('identifier'))
              {{ $errors->first('identifier');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Coupon Code</label>
            <input class="input" name="code" type="text" placeholder="" required>
            <span style="color: red;">@if($errors->has('code'))
              {{ $errors->first('code');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Discount(%)</label>
            <input class="input" type="number" name="discount" placeholder="" required="">
            <span style="color: red;">@if($errors->has('discount'))
              {{ $errors->first('discount');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Start From</label>
            <input class="input" name="start_date" type="date" placeholder="" required>
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
            <span style="color: red;">@if($errors->has('phone_number'))
              {{ $errors->first('phone_number');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Date Till</label>
            <input class="input" name="end_date" type="date" placeholder="" required>
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
            <span style="color: red;">@if($errors->has('password'))
              {{ $errors->first('password');}} 
            @endif</span>
          </div>
        </div>
      </div>

      <div class="modal-footer d-block">
        <div class="modal-btn-group m-0 p-0">
          <button type="submit" class="site-link sm">Save</button>
        </div>
      </div>

    </form>
  </div>
</div>
</div>

<div class="modal theme-modal fade" id="modal-3">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-500">Meeting Tool Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url('admin/discount_coupon/edit_coupon')}}" method="post" style="overflow: auto;">
        @csrf()
        <div class="modal-body pt-3 pb-3">
          <input type="hidden" name="id" value="id" class="data_id" id="data_check_update_id">
          <div class="ps-3 pe-3">
            <div class="inp-outer mt-0">
              <label for="">Coupon Identifier</label>
              <input class="input" type="text" name="identifier" id="identifier" required>
            </div>
            <div class="inp-outer">
              <label for="">Coupon Code</label>
              <input class="input" name="code" type="text" id="code" required>
            </div>
            <div class="inp-outer">
              <label for="">Discount(%)</label>
              <input class="input" type="number" name="discount" id="discount" required="">
            </div>
            <div class="inp-outer">
              <label for="">Start From</label>
              <input class="input" name="start_date" id="start_date" type="date" required>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
            <div class="inp-outer">
              <label for="">Date Till</label>
              <input class="input" name="end_date" id="end_date" type="date" required>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
        </div>

        <div class="modal-footer d-block">
          <div class="modal-btn-group m-0 p-0">
            <button type="submit" class="site-link sm">Save</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

@include('/admin/common/footer')

<script>
  $(function () {
    $('#datetimepicker1').datetimepicker();
  });
</script>
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
      url : "{{ url('admin/discount_coupon/get_coupon') }}",
      data : {'id': post_id},
      
      dataType : 'json',
      success : function(result){ 
        $('#identifier').val(result.coupon_identifier);
        $('#code').val(result.coupon_code);
        $('#discount').val(result.discount);
        $('#start_date').val(result.start_date);
        $('#end_date').val(result.end_date);
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
      url : "{{ url('admin/discount_coupon/status_update') }}",
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