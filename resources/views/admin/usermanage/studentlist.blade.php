@include('/admin/common/header')
@include('/admin/common/sidebar')
<!-- Container -->
<section class="wrapper">
  <div class="page-title">
    <h1>Home</h1>
  </div>
  <div class="main-wrapper">
    <div class="search-bar">
      <div class="inp-outer mt-0">
        <div class="inp-in icon-left">
          <input id="sarch-expand" class="input input-dark" type="text" placeholder="Search Users by Name, Email or Date">
          <span class="inp-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
        </div>
      </div>
      <div class="search-bar-group">
        <form {{url('admin/studentlist')}} method="get">
          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="inp-outer">
                <label for="">Name or Email</label>
                <input class="input" type="text" placeholder="" name="name_email" value="<?php echo (isset($_GET['name_email']) ? $_GET['name_email'] : ""); ?>">
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="inp-outer">
                <label for="">User Type</label>
                <select class="input" name="role">
                  <option value="4">Student</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="inp-outer">
                <label for="">Email Verified</label>
                <select class="input" name="email_veri">
                  <option value="">Select</option>
                  <option value="1" <?php echo ((isset($_GET['email_veri']) && $_GET['email_veri'] == 1) ? "selected" : ""); ?> >Verified</option>
                  <option value="0" <?php echo ((isset($_GET['email_veri']) && $_GET['email_veri'] == 0) ? "selected" : ""); ?> >Unverified</option>
                </select>
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
      <div class="table-responsive">
        <table class="table theme-table">
          <thead>
            <tr>
              <th>SN</th>
              <th>NAME</th>
              <th>USER ID</th>
              <th>EMAIL</th>
              <th>DATE</th>
              <th>TYPE</th>
              <th>VERIFIED</th>
              <th>STATUS</th>
              <th class="text-center">ACTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php if(isset($studentAll) && !empty($studentAll)){ ?> 
              @php
              $i = 1; 
              @endphp
              @foreach($studentAll as $data)
              <tr>
                <td>{{$i}}</td>
                <td>{{$data->first_name.' '.$data->last_name}}</td>
                <td>User ID: {{$data->id}}</td>
                <td>{{$data->email}}</td>
                <td>
                  @php
                  echo date('M, jS Y h:i:s A',strtotime($data->created_at));
                  @endphp
                </td>
                <td>
                  @php
                  if($data->role==3){
                  echo "Teacher";
                }

                if($data->role==4){
                echo "Student";
              }
              @endphp
            </td>
            <td>
              @php
              if($data->email_verify==1){
              echo "Yes";
            }

            if($data->email_verify==0){
            echo "No";
          }
          @endphp
        </td>
        <td>
         <label class="switch status_change" data='<?php echo $data->id ?>'>
          <input type="checkbox" <?php echo ($data->user_status == 1 ? 'checked':"") ?>>
          <span class="slider round"></span>
        </label>
      </td>
      <td class="text-center">
        <div class="profile-dropdown">
          <div class="dropdown">
            <div class="dropdown-toggle" data-bs-toggle="dropdown">
              <i class="fa-solid fa-ellipsis-vertical"></i>
            </div>
            <ul class="dropdown-menu">
              <li><a class="" href="{{ url('admin/view-profile/'.$data->id) }}">View Profile</a></li>
              <li><a class=""  onclick="return confirm('Are you sure?')" href="{{ url('admin/delete-student/'.$data->id) }}">Delete</a></li>
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
  if(count($studentAll) =="0"){
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
      echo $studentAll->appends($params)->render("pagination::bootstrap-4")  ;

      ?>
      <!-- @if(count($studentAll)>0) -->
      <!-- {{$studentAll->appends($params)->render("pagination::bootstrap-4")}} -->
      <!-- {{ $studentAll->links() }}    -->
      <!-- @endif -->
    </th> 
  </tr>
</tfoot> 
</table>

</div>
</div>

</div>
</section>
<!-- Container -->
@include('/admin/common/footer')
