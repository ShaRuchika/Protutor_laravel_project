@include('/admin/common/header')
@include('/admin/common/sidebar')
<!-- Container -->
<section class="wrapper">
  <div class="page-title">
    <h1>Home</h1>
  </div>
  <div class="main-wrapper">

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
    <div class="btn-bar">
      <!-- <a class="site-link small bdr grey" href="manage-admin-roles.html"><i class="fa-solid fa-gear"></i> Manage Admin Roles</a> -->
      <a class="site-link small" href="" data-bs-toggle="modal" id="clickI" data-bs-target="#modal-3"><i class="fa-solid fa-plus"></i> Create New Admin User</a>
    </div> 

    <div class="search-bar">
      <div class="inp-outer mt-0">
        <div class="inp-in icon-left">
          <input id="sarch-expand" class="input input-dark" type="text" placeholder="Search Users by Name, Email or Date">
          <span class="inp-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
        </div>
      </div>
      <div class="search-bar-group">
        <form {{url('admin/userlist')}} method="get">
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
                  <option value="">Select</option>
                  <option value="1" <?php echo ((isset($_GET['role']) && $_GET['role'] == 1) ? "selected" : ""); ?>>Super Admin</option>
                  <option value="2" <?php echo ((isset($_GET['role']) && $_GET['role'] == 2) ? "selected" : ""); ?>>Admin</option>
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
              <th>FULL NAME</th>
              <th>EMAIL</th>
              <th>ROLE</th>
              <th>DATE CREATED</th>
              <th>STATUS</th>
              <th class="text-center">ACTIONS</th>
            </tr>
          </thead>
          <tbody>
            <?php if(isset($adminAll) && !empty($adminAll)){ ?> 
              @php
              $i = 1; 
              @endphp
              @foreach($adminAll as $data)
              <tr> 
                <td>{{$data->first_name.' '.$data->last_name}}</td> 
                <td>{{$data->email}}</td>
                <td>
                  @php
                  if($data->role==1){
                  echo "Super Admin";
                }

                if($data->role==2){
                echo "Admin";
              }
              @endphp
            </td> 
            <td>
              @php
              echo date('M, jS Y h:i:s A',strtotime($data->created_at));
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
                   <li><a class=""  onclick="return confirm('Are you sure?')" href="{{ url('admin/delete-admin/'.$data->id) }}">Delete</a></li>
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
      if(count($adminAll) =="0"){
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
          echo $adminAll->appends($params)->render("pagination::bootstrap-4")  ;
          ?> 
        </th> 
      </tr>
    </tfoot> 
  </table>
</div>
</div>

</div>
</section>


<div class="modal theme-modal fade" id="modal-3">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-600">Create New Admin User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      

      <form action="{{url('admin/user_register_by_admin')}}" method="post" style="overflow: auto;">
        @csrf()
        <div class="modal-body pt-3 pb-3">
         <div class="ps-3 pe-3">
          <div class="inp-outer mt-0">
            <label for="">First Name</label>
            <input class="input" type="text" name="first_name" required>
            <span style="color: red;">@if($errors->has('first_name'))
              {{ $errors->first('first_name');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Last Name</label>
            <input class="input" name="last_name" type="text" placeholder="" required>
            <span style="color: red;">@if($errors->has('last_name'))
              {{ $errors->first('last_name');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Email Address</label>
            <input class="input" type="email" name="email" placeholder="" required="">
            <span style="color: red;">@if($errors->has('email'))
              {{ $errors->first('email');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Phone Number</label>
            <input class="input" type="text" minlength="10" maxlength="10"  name="phone_number" id="phone_number" required="">
            <span style="color: red;">@if($errors->has('phone_number'))
              {{ $errors->first('phone_number');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Create Password</label>
            <input class="input" type="password" name="password" placeholder="" required="">
            <span style="color: red;">@if($errors->has('password'))
              {{ $errors->first('password');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Date of Birth</label>
            <input class="input" type="date" name="dob" required="">
            <span style="color: red;">@if($errors->has('dob'))
              {{ $errors->first('dob');}} 
            @endif</span>
          </div>

          <div class="inp-outer">
            <label for="">Gender</label>
            <select class="input" name="gender" id="" required="">
              <option value="1">Male</option>
              <option value="2">Female</option>
            </select>
            <span style="color: red;">@if($errors->has('gender'))
              {{ $errors->first('gender');}} 
            @endif</span>
          </div>
          <div class="inp-outer">
            <label for="">Select Role</label>
            <select class="input" name="role" required="">
              <option value="1">Super Admin</option>
              <option value="2">Admin</option>
              <option value="3">Tutor</option>
              <option value="4">Student</option>
            </select>
          </div>
        </div>
      </div>

      <div class="modal-footer d-block">
        <div class="modal-btn-group m-0 p-0">
          <button type="submit" class="site-link sm">Create New User</button>
        </div>
      </div>

    </form>

  </div>
</div>
</div>
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  <!-- Container -->

  @include('/admin/common/footer')
  <script type="text/javascript">
    <?php  
  /*if(!empty($errors->any())){ ?> 
    $("#modal-3").addClass("show");
    $("#modal-3").css("display","block");
  <?php }*/
  ?>


  $('#phone_number').keyup(function(e)
  {
    if (/\D/g.test(this.value))
    { 
      this.value = this.value.replace(/\D/g, '');
    }
  });

</script>