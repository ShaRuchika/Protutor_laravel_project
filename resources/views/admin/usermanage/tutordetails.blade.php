@include('/admin/common/header')
@include('/admin/common/sidebar')
<div class="main-wrapper">
  <div class="profile-back">
    <a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
  </div>

  <h4 class="fw-700 mt-3">User Profile</h4>

  <div class="user-bar">
    <div class="user-bar-left">

      <div class="user-bar-profile"><img src="{{ url('/') }}/public/images/{{$userdata[0]->profile_img}}" alt=""></div>
      <div class="user-bar-txt">
        <h5>{{$userdata[0]->first_name.' '.$userdata[0]->last_name}} - {{$userdata[0]->user_id}}</h5>
        <p>@php
          if($userdata[0]->role==1){
            echo "Super Admin";
          }

          if($userdata[0]->role==2){
            echo "Admin";
          }

          if($userdata[0]->role==3){
            echo "Tutor";
          }

          if($userdata[0]->role==4){
            echo "Student";
          }

        @endphp</p>
      </div>
    </div>
  </div>

  <div class="cont-block">
    <div class="cont-block-title">Request Information</div>
    <div class="cont-block-list">
      <ul>
        <li><span class="fw-600">Reference Number:</span> {{$userdata[0]->user_id}}</li>
        <li><span class="fw-600">Request on:</span>  @php echo date('M, jS Y h:i:s A',strtotime($userdata[0]->created_at));@endphp</li>
        <li><span class="fw-600">Status :</span> @php
          if($userdata[0]->profile_verified==1){
            echo "Completed";
          }

          if($userdata[0]->profile_verified==0){
            echo "Pendding";
          }
        @endphp</li>
      </ul>
    </div>
  </div>

  <div class="cont-block">
    <div class="cont-block-title">Profile Information</div>
    <div class="cont-block-list">
      <ul>
        <li>
          <span class="list-gap"><span class="fw-600">First Name:</span> {{$userdata[0]->first_name}}</span>
          <span class="list-gap"><span class="fw-600">Last Name:</span> {{$userdata[0]->last_name}}</span>
          <span class="list-gap"><span class="fw-600">Phone:</span> 
          <?php 
          if(isset($userdata[0]->phone_number) and !empty($userdata[0]->phone_number)){
            echo $userdata[0]->phone_number; 
          }else{
            echo $userdata[0]->phone; 
          }
          ?>
          
        </span>
      </li>
      <li>
        <span class="list-gap"><span class="fw-600">Gender:</span> @php
        if($userdata[0]->gender==1){
          echo "Male";
        }

        if($userdata[0]->gender==2){
          echo "Female";
        }
      @endphp</span>
      <span class="list-gap"><span class="fw-600">Video Links:</span> <a href="{{ url('/') }}/public/videos/{{$userdata[0]->video_link}}" target="_blank">Click Here</a></span>
    </li>
    <li><span class="fw-600">Teaching Subject :</span> 
      <?php 
      foreach ($subject as $key => $value) { 
        $medi_arr = explode(',', $userdata[0]->subject);  
        if(count($medi_arr) > 1){
          if(in_array($value->id, $medi_arr)){
            echo $value->subject.', ';

          }
        }else{
          if($userdata[0]->subject==$value->id){
            echo $value->subject.', ';
          }
        }
      }

      ?> 
    </li>
    <li>
      <span class="fw-600">Language :</span>
      <br>
      <span>Native: 
       <?php 
       foreach ($spoken_languages as $key => $value) { 

         if($userdata[0]->native_language==$value->id){
          echo $value->spoken_language.', ';
        }    
      }
      ?>
    </span>
    <br>
    <span>Advanced: 
     <?php 
     foreach ($spoken_languages as $key => $value) { 
      $medi_arr = explode(',', $userdata[0]->languages);  
      if(count($medi_arr) > 1){
        if(in_array($value->id, $medi_arr)){
          echo $value->spoken_language.', ';

        }
      }else{
        if($userdata[0]->languages==$value->id){
          echo $value->spoken_language.', ';
        }
      }      
    }
    ?>
  </span>  

</li>
</ul>
</div>
</div>

<div class="cont-block">
  <div class="cont-block-title">Bio</div>
  <div class="cont-block-list">
    <ul>
      <li>{{$userdata[0]->desc_about}}</li>
    </ul>
  </div>
</div>

<div class="cont-block">
  <div class="cont-block-title bdr">Education Files and Documents</div>
  <div class="cont-block-list">
    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <th>University</th>
          <th>Degree</th>
          <th>Degree Type</th>
          <th>Specialization</th>
          <th>Year of Study</th>
          <th>Action</th>
        </tr>
        <?php 
        if(isset($getEgducation) && $getEgducation !=""){
          foreach ($getEgducation as $key => $value) { ?>
            <tr>
              <td><?php echo $value->university_name ?></td>
              <td><?php echo $value->degree_name ?></td>
              <td><?php echo $value->degree_type ?></td>
              <td><?php echo $value->specialization ?></td>
              <td><?php echo $value->year_of_study ?></td>
              <td>
               <a class="site-link small bdr" href="{{url('/')}}/public/educations/{{$value->degree_verification_pic}}" download><i class="fa-regular fa-eye"></i> View</a>
             </td>
           </tr>
         <?php }
       }
       ?> 
     </table>
   </div>
 </div>
</div>


<div class="cont-block">
  <div class="cont-block-title bdr">Certificate Files and Documents</div>
  <div class="cont-block-list">
    <div class="table-responsive">
     <table class="table table-striped">
      <tr>
        <th>Certificate Name</th>
        <th>Description</th> 
        <th>Issued By</th> 
        <th>Year of Study</th> 
        <th>Action</th>
      </tr>
      <?php 
      if(isset($getCertificate) && $getCertificate !=""){
        foreach ($getCertificate as $key => $value) { ?>
          <tr>
            <td><?php echo $value->certificate_name ?></td>
            <td><?php echo $value->description ?></td> 
            <td><?php echo $value->issued_by ?></td> 
            <td><?php echo $value->year_of_study ?></td> 
            <td> 
              <a class="site-link small bdr" href="{{url('/')}}/public/certificates/{{$value->certificate_verified_pic}}" download><i class="fa-regular fa-eye"></i> View</a>
            </td>
          </tr>
        <?php }
      }
      ?> 
    </table>
  </div>
</div>
</div>

<div class="cont-block">
  <div class="cont-block-title bdr">Identity Verification Files and Documents</div>
  <div class="cont-block-list">
    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <th>Issued by Country</th>
          <th>Type of Document</th>
          <th>Document identification number</th>
          <th>Document expiry date</th>
          <th>Action</th>
        </tr>
        <?php 
        if(isset($getIdentification) && $getIdentification !=""){
          foreach ($getIdentification as $key => $value) { ?>
            <tr>
              <td><?php echo $value->issued_by_country ?></td>
              <td><?php echo $value->type_of_document ?></td>
              <td><?php echo $value->identification_number ?></td>
              <td><?php echo $value->expiry_date ?></td>
              <td>
                <a class="site-link small bdr" href="{{url('/')}}/public/identity/{{$value->identity_document_front}}" download><i class="fa-regular fa-eye"></i>Front View</a>
                <a class="site-link small bdr" href="{{url('/')}}/public/identity/{{$value->identity_document_back}}" download><i class="fa-regular fa-eye"></i>back View</a>
              </td>
            </tr>
          <?php }
        }
        ?> 
      </table>
    </div>
  </div>
</div>


<div class="cont-block">
  <div class="cont-block-title bdr">Experience Files and Documents</div>
  <div class="cont-block-list">
    <div class="table-responsive">
      <table class="table table-striped">
        <tr>
          <th>Company Name</th>
          <th>Position</th>
          <th>Period of Employment</th> 
        </tr>
        <?php 
        if(isset($getExperience) && $getExperience !=""){
          foreach ($getExperience as $key => $value) { ?>
            <tr>
              <td><?php echo $value->company_name ?></td>
              <td><?php echo $value->position ?></td> 
              <td><?php echo $value->period_of_employment ?></td> 
            </tr>
          <?php }
        }
        ?> 
      </table>
    </div>
  </div>
</div>



<div class="row justify-content-center">
 <form action="{{url('admin/admin_apporove_profile')}}" method="post">
  @csrf()
  <div class="col-lg-4">
    <div class="inp-outer">
      <label for="">Status</label>
      <select class="input" name="status" id="status">
        <option value="0" <?php if($userdata[0]->profile_verified=='0'){ echo 'selected'; } ?>>Cancelled</option>
        <option value="1" <?php if($userdata[0]->profile_verified=='1'){ echo 'selected'; } ?>>Approved</option>
      </select>
    </div>

    <div class="inp-outer mt-0" id="rejected_msg" <?php if($userdata[0]->profile_verified=='1'){ echo 'style="display: none;"'; } ?>>
      <label for="">Reason for rejecting this Turor</label>
      <textarea class="input" name="reject_reason"></textarea>
    </div>

    <div class="inp-outer">
      <input type="hidden" name="userrealid" value="{{$userdata[0]->user_id}}">
      <button type="submit" class="site-link small">Update</button>
    </div>
  </div>


</form>
</div>

</div>

</div>

</div>  



<div class="modal theme-modal fade" id="modal-3">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-600">CAC Document - Memert</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-3">
        <div class="text-center">
          <img src="{{url('/')}}/public/assets/images/pdf.png" alt="">
        </div>
      </div>

      <div class="modal-footer d-block text-center">
        <div class="modal-btn-group mt-0">
          <a class="site-link sm green" href="" data-bs-dismiss="modal"><i class="fa-solid fa-download"></i> Download File</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal theme-modal fade" id="modal-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="fw-600">Reject Tutor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="ps-4 pe-4">
          <div class="inp-outer mt-0">
            <label for="">Reason for rejecting this Turor</label>
            <textarea class="input" name="" id=""></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer d-block text-center">
        <div class="modal-btn-group mt-0">
          <a class="site-link sm red" href="" data-bs-toggle="modal" data-bs-target="#modal-2">Reject Dispute</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal theme-modal fade" id="modal-2">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
       <div class="text-center">
        <div class="success-icon green mb-3"><i class="fa-solid fa-check"></i></div>
        <h5 class="fw-600">Successful</h5>
        <p> Class has been canceld</p>
      </div>
      <div class="modal-btn-group">
        <a class="site-link sm bdr grey" href="" data-bs-dismiss="modal">Okay</a>
      </div>
    </div>
  </div>
</div>
</div>
@include('/admin/common/footer')

<script>
  $(document).ready(function(){
    $("#status").change(function(){
      var status = this.value;
      if(status=='1'){
        $("#rejected_msg").css("display", "none");
      }else{
        $("#rejected_msg").css("display", "block");
      }
    });
  });
</script>