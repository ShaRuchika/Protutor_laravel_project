@include('/admin/common/header')

<div class="dashboard-wrap">

 @include('/admin/common/sidebar')

 <div class="main-wrapper">
  <div class="search-bar">
    <div class="inp-outer mt-0">
      <div class="inp-in icon-left">
        <input id="sarch-expand" class="input input-dark" type="text" placeholder="Search Users by Name, Email or Date">
        <span class="inp-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
      </div>
    </div>
    <div class="search-bar-group">
      <form action="{{url('admin/lesson_orders')}}" method="get">
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <div class="inp-outer">
              <label for="">Name</label>
              <input class="input" type="text" placeholder="" name="name" value="<?php echo (isset($_GET['name']) ? $_GET['name'] : ""); ?>">
            </div>
          </div>      
          <div class="col-sm-6 col-lg-3">
            <div class="inp-outer">
              <label for="">Status</label>
                 <select class="input" name="status" >
                <option value="">Select</option>
                <option value="1" <?php echo ((isset($_GET['status']) && $_GET['status'] == 1) ? "selected" : ""); ?> >In Process</option>
                <option value="2" <?php echo ((isset($_GET['status']) && $_GET['status'] == 2) ? "selected" : ""); ?> >Completed</option>
                <option value="3" <?php echo ((isset($_GET['status']) && $_GET['status'] == 3) ? "selected" : ""); ?> >Cancelled</option>

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
              <a class="site-link bdr sm" href="{{url('admin/lesson_orders')}}">Clear</a>
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
            <th>ORDER ID</th>
            <th>USER NAME</th>
            <th>ITEMS</th>
            <th>TOTAL</th>
            <th>DISCOUNT</th>
            <th>NET TOTAL</th>
            <th>PAYMENT</th>
            <th>STATUS</th>
            <th>DATE</th>
            <th class="text-center">ACTIONS</th>
          </tr>
        </thead>

        <tbody>

          <?php if(isset($lesson_orders) && !empty($lesson_orders)){ ?> 
            @foreach($lesson_orders as $data)
            <tr>
              <td>{{$data->id}}</td>
              <td>{{$data->name}}</td>
              <td>{{$data->items}}</td>
              <td>${{$data->total}}</td>
              <td>{{$data->discount}}%</td>
              <td>${{$data->net_total}}</td>
              <td>${{$data->payment_status}}</td>
              <td><?php 
                    if(isset($data->status) && $data->status == 1){
                      echo "Pending";
                    }else if(isset($data->status) && $data->status == 2){
                      echo "Completed";
                    }else if(isset($data->status) && $data->status == 3){
                      echo "Cancelled";
                    }else{
                      echo "wrong status";
                    }
                ?></td>
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
                      <li><a class="" href="{{url('admin/order_details/'.$data->id)}}">View</a></li>
                      <li><a class="" href="{{url('admin/view-profile/'.$data->user_id)}}">View Profile</a></li>
                      <li><a class="" href="view-profile.html">Transactions</a></li>
                    </ul>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
            <?php 
          }
          if(count($lesson_orders) =="0"){
            echo "<tr><td>";
            echo "<h4>Record not found</h4>";
            echo "</td></tr>";
          }
          ?>
        </tbody>

        <tfoot>
         <!--  <tr>
            <th colspan="12">
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

@include('/admin/common/footer')