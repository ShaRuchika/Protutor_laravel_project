@include('/admin/common/header')

<div class="dashboard-wrap">

 @include('/admin/common/sidebar')

 <div class="main-wrapper">

  <div class="report-stat mt-0">
    <p>
     <span class="fw-600">Manage Meeting Tools</span> <br>
     Home / Meeting Tools
   </p>
 </div>

<!--  <div class="search-bar">
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
        <th>CODE</th>
        <th>INFO</th>
        <th class="text-center">ACTIONS</th>
      </tr>
    </thead>
    <tbody>
     <?php if(isset($ToolsAll) && !empty($ToolsAll)){ ?> 
      @php
      $i = 1; 
      @endphp
      @foreach($ToolsAll as $data)
      <tr>
        <td>{{$i}}</td>
        <td>{{$data->code}}</td>
        <td class="wrap">
          <span class="txt-width">{{$data->info}}</span>
        </td>
        <td class="text-center"><a class="edit" href="" data-id="{{$data->id}}" data-bs-target="#modal-1" data-bs-toggle="modal">Edit</a></td>
      </tr>
      @php
      $i++;
      @endphp
      @endforeach
      <?php 
    } ?>
  </tbody>
      <!-- <tfoot>
        <tr>
          <th colspan="9">
            <span>Showing 1 to 20 of 2451 Entries</span>
            <span class="table-nav">
              <a href=""><i class="fa-solid fa-arrow-right"></i></a>
              <span>1</span>
              <a href=""><i class="fa-solid fa-arrow-left"></i></a>
            </span>
          </th>
        </tr>
      </tfoot> -->
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
      <form method="post" action="{{url('admin/meeting_tools/edit_tools')}}">
        @csrf
        <input type="hidden" name="id" value="id" class="data_id" id="data_check_update_id">
        <div class="modal-body ps-5 pe-5">
          <div class="inp-outer">
            <label for="">Code</label>
            <input class="input" id="check_code" type="text" name="code" value="" readonly>
          </div>
          <div class="inp-outer">
            <label for="">API Key</label>
            <input class="input" id="check_key" type="text" name="api_key" placeholder="">
          </div>
          <div class="inp-outer">
            <label for="">API ID</label>
            <input class="input" id="check_id" type="text" name="api_id" placeholder="">
          </div>
          <div class="inp-outer">
            <label for="">API Script</label>
            <input class="input" id="check_script" type="text" name="api_script" placeholder="">
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
      url : "{{ url('admin/meeting_tools/get_tools') }}",
      data : {'id': post_id},
      
      dataType : 'json',
      success : function(result){ 

        /*console.log(result);*/
        $('#check_code').val(result.code);
        $('#check_key').val(result.api_key);
        $('#check_id').val(result.api_id);
        $('#check_script').val(result.api_script);
        $('#data_check_update_id').val(result.id);
      }
    });     
   });
  });
</script>
@include('/admin/common/footer')

