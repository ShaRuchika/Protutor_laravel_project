@include('/admin/common/header')

<div class="dashboard-wrap">

 @include('/admin/common/sidebar')

 <div class="main-wrapper">

  <div class="report-stat mt-0">
    <div>
      <p>
        <span class="fw-600">Manage Commission Settings</span> <br>
        Home / Payment Method
      </p>
    </div>
  </div>

<!--   <div class="search-bar">
    <div class="inp-outer mt-0">
      <div class="inp-in icon-left">
        <input id="sarch-expand" class="input input-dark" type="text" placeholder="Search Users by Name, Email or Date">
        <span class="inp-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
      </div>
    </div>
    <div class="search-bar-group">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="inp-outer">
            <label for="">Name or Email</label>
            <input class="input" type="text" placeholder="">
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="inp-outer">
            <label for="">Status</label>
            <select class="input" name="" id="">
              <option value="">Select</option>
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
    </div>
  </div> -->

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
            <th>TUTOR</th>
            <th>Lesson Fees</th>
            <th>Class Fee</th>
            <th class="text-center">ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <?php if(isset($commissionType) && !empty($commissionType)){ ?> 
          @php
          $i = 1; 
          @endphp
          @foreach($commissionType as $data)
          <tr>
            <td>{{$i}}</td>
            <td>{{$data->transaction_type}}</td>
            <td>{{$data->lesson_fees}}</td>
            <td>{{$data->class_fees}}</td>
            <td class="text-center">
              <div class="profile-dropdown">
                <div class="dropdown">
                  <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                  </div>
                  <ul class="dropdown-menu">
                    <li><a class="edit" href="" data-id="{{$data->id}}" data-bs-target="#modal-1" data-bs-toggle="modal">Edit</a></li>
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
        } ?>
      </tbody>
      <tfoot>
        <!-- <tr>
          <th colspan="7">
            <span>Showing 1 to 20 of 2451 Entries</span>
            <span class="table-nav">
              <a href=""><i class="fa-solid fa-arrow-right"></i></a>
              <span>1</span>
              <a href=""><i class="fa-solid fa-arrow-left"></i></a>
            </span>
          </th>
        </tr> -->
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
        <h5 class="fw-500">Commission Setup</h5>
        <div class="btn-close" data-bs-dismiss="modal" aria-label="Close"></div>
      </div>
      <form method="post" action="{{url('admin/commission_settings/edit_commission')}}">
        @csrf
        <input type="hidden" name="id" value="id" class="data_id" id="data_check_update_id">
        <div class="modal-body ps-5 pe-5">
          <div class="inp-outer mt-0">
            <label for="">Transaction Type</label>
            <input class="input" id="check_transaction" type="text" name="transaction_type" readonly>
          </div>
          <div class="inp-outer">
            <label for="">Lesson Commission Fees [%]<span>*</span></label>
            <input class="input" id="check_lesson" name="lesson_fees" type="text" placeholder="">
          </div>
          <div class="inp-outer">
            <label for="">Class Commission Fees [%]<span>*</span></label>
            <input class="input" id="check_class" name="class_fees" type="text" placeholder="">
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
      url : "{{ url('admin/commission_settings/get_commission') }}",
      data : {'id': post_id},
      
      dataType : 'json',
      success : function(result){ 

        console.log(result);
        $('#check_transaction').val(result.transaction_type);
        $('#check_lesson').val(result.lesson_fees);
        $('#check_class').val(result.class_fees);
        $('#data_check_update_id').val(result.id);
      }
    });     
   });
  });
</script>

@include('/admin/common/footer')
