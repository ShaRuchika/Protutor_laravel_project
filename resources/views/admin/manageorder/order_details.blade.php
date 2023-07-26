@include('/admin/common/header')

<div class="dashboard-wrap">

 @include('/admin/common/sidebar')

 <div class="main-wrapper">
  <div class="profile-back">
    <a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
  </div>
  <h5 class="fw-700 pt-3">Order Details</h5>

  <div class="order-box">
    <div class="order-box-title">
      <h5>Customers Order Details</h5>
      <div class="profile-dropdown">
        <div class="dropdown">
          <div class="dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fa-solid fa-ellipsis-vertical"></i>
          </div>
          <ul class="dropdown-menu">
            <li><a class="" href="">Download</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="order-block">
      <div class="row">
        <div class="col-lg-4">
          <div class="order-block-single">
            <p><span>Order/Invoice ID:</span> {{$orders->id}}</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="order-block-single">
            <p><span>Payment Type:</span> Paypal</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="order-block-single">
            <p><span>Payment Status: </span> {{$orders->payment_status}}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="order-block">
      <div class="row">
        <div class="col-lg-4">
          <div class="order-block-single">
            <p><span>Order Total Amount: </span> ${{$orders->total}}</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="order-block-single">
            <p><span>Order Net Amount: </span> ${{$orders->net_total}}</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="order-block-single">
            <p><span>Order Discount: </span> {{$orders->discount}}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="order-block">
      <div class="row">
        <div class="col-lg-4">
          <div class="order-block-single">
            <p><span>Order Amount paid: </span> ${{$orders->net_total}}</p>
          </div>
        </div>
        <!-- <div class="col-lg-4">
          <div class="order-block-single">
            <p><span>Order amount pending:</span> $0.00</p>
          </div>
        </div> -->
        <div class="col-lg-4">
          <div class="order-block-single">
            <p><span>Order Status: </span>
              <?php 
              if(isset($orders->status) && $orders->status == 1){
                echo "Pending";
              }else if(isset($orders->status) && $orders->status == 2){
                echo "Completed";
              }else if(isset($orders->status) && $orders->status == 3){
                echo "Cancelled";
              }else{
                echo "wrong status";
              }
              ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-lg-4">
      <div class="order-box">
        <div class="order-box-title">
          <h5>User Details</h5>
        </div>
        <div class="order-block-single">
          <?php if(isset($users) && !empty($users)){ 
            foreach($users as $user) {
             ?>
             <p>
               <span>Name :</span> {{$user->first_name.' '.$user->last_name}}<br>
               <span>Email :</span> {{$user->email}} <br>
               <span>User ID :</span> {{$user->id}} <br>
             </p>
           <?php } } ?>
         </div>
       </div>
     </div>
     <div class="col-sm-6 col-lg-4">
      <div class="order-box">
        <div class="order-box-title">
          <h5>Order Details</h5>
        </div>
        <div class="order-block-single">
          <p>
            <span>Order Type :</span> {{$orders->order_type}} <br>
            <span>Order/Invoice ID :</span> {{$orders->id}} <br>
            <span>Order amount paid :</span> ${{$orders->net_total}} <br>
            <span>Order Date :</span> {{$orders->created_at}}
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-lg-4">
      <div class="order-box">
        <div class="order-box-title">
          <h5>Lessons Details</h5>
        </div>
        <div class="order-block-single">
          <p>
            <span>Tutor Name :</span>{{$teachers[0]->first_name.' '.$teachers[0]->last_name}}<br> 
            <span>Tutor Email :</span> {{$teachers[0]->email}}  <br>
            <span>Tutor ID :</span> {{$teachers[0]->id}} <br>
            <span>Lesson Type :</span> Regular <br>
            <span>No. Of Lessons :</span> 1Lesson  <br>
            <span>Duration :</span> 60 Mins/Per Lesson <br>
            <span>Lesson Price :</span> ${{$orders->total}}/Per Lesson <br>
            <span>Admin Commission (%) :</span> 15.00% <br>
            <span>Teach Subject :</span>
            <?php 
            foreach ($subjects as $key => $value) { 
              $medi_arr = explode(',', $teachers[0]->subject);  
              if(count($medi_arr) > 1){
                if(in_array($value->id, $medi_arr)){
                  echo '<span class="ms-1">'.$value->subject.'</span>';
                }
              }else{
                if($teachers[0]->subject==$value->id){
                  echo '<span class="ms-1">'.$value->subject.'</span>';
                }
              }
            }
            ?> 
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

</div>  

@include('/admin/common/footer')
