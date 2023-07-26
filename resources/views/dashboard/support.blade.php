@include('/dashboard/common/header')
@include('/dashboard/common/sidebar')

<section class="wrapper">
  <div class="page-title">
    <h1>Support</h1>
  </div>
  <div class="box">
    <div class="tab-title mb-0">
      <h2>Customer Srvice</h2>
      <h3>How we can help you?</h3>
    </div>

    <div class="general-tabs">
      <?php 
      $get_sup_data = $Supportdata[0]->support_sec1;
      $get_sup_datas = json_decode($get_sup_data);
      ?>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php 
        $sec_count=1; 
        foreach ($get_sup_datas as $key => $sup_value) {
          ?>
          <li class="nav-item" role="presentation">
            <button class="nav-link <?php echo ($sec_count==1) ? 'active' : ''; ?>" data-bs-toggle="tab" data-bs-target="#tab-{{$sec_count}}">{{$sup_value->title}}</button>
          </li>
          <?php $sec_count++; } ?>
        </ul>
        <div class="tab-content" id="myTabContent">
          <?php 
          $get_sup_data1 = $Supportdata[0]->support_sec1;
          $get_sup_datas1 = json_decode($get_sup_data1);
          ?>
          <?php 
          $sec1_count=1; 

          foreach ($get_sup_datas1 as $key => $sup_value1) {
            ?>
            <div class="tab-pane fade <?php echo ($sec1_count==1) ? 'show active' : '' ; ?>" id="tab-{{$sec1_count}}">
              <div class="support-block">
               <h5>{{$sup_value1->title}}</h5>
               <div class="support-block-in">
                <p>{{$sup_value1->description}}</p>
                <p><a href="{{$sup_value1->url}}">Read more about our Delivery Terms & Conditions.</a></p>
              </div>
            </div>

            <?php if($sec1_count==1){ ?>
              <div class="support-block pt-5 fade  <?php echo ($sup_value1->title == 'Delivery') ? 'show active' : '' ; ?>">
                <h5 class="pb-3">Frequently asked questions</h5>
                <div class="support-block-in">
                 <div class="general-accordion">
                  <div class="accordion" id="accordionExample">
                    <?php 
                    $get_sup_data2 = $Supportdata[0]->support_sec2;
                    $get_sup_datas2 = json_decode($get_sup_data2);
                    ?>
                    <?php 
                    $sec2_count=1; 
                    foreach ($get_sup_datas2 as $key => $sup_value2) {
                      ?>
                      <div class="accordion-main">
                        <h2 class="accordion-header">
                          <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$sec2_count}}" aria-expanded="true">
                            {{$sup_value2->title}}
                          </button>
                        </h2>
                        <div id="collapse-{{$sec2_count}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                          <div class="accordion-container">
                           <p>{{$sup_value2->description}}</p>
                         </div>
                       </div>
                     </div>
                     <?php $sec2_count++; } ?>
                   </div>
                 </div>
               </div>
             </div>

           <?php } ?>


         </div>

         <?php $sec1_count++; } ?>
       </div>
     </div>



   </div>

   <div class="support-info">
    <div class="row">
      <div class="col-lg-4">
        <div class="support-info-single">
          <h4>Live Chat</h4>
          <div style="cursor: pointer;" class="support-icon" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <a href="{{$Supportdata[0]->live_chat}}"><i class="fa-brands fa-rocketchat" style="color: white;"></a></i></div>
          </div>
        </div>
        <div class="col-lg-4">
          <?php 
          $get_data = $Supportdata[0]->call_us;
          $get_data_all = json_decode($get_data);
          foreach ($get_data_all as $key => $dataValue1) {
            ?>
            <div class="support-info-single">
              <h4>Call Us</h4>
              <div class="support-icon"><a href="{{$dataValue1->url}}"><i class="fa-solid fa-phone"  style="color: white;"></a></i></div>
              <p><strong>+{{$dataValue1->contact}}</strong></p>
              <p class="txt-green">{{$dataValue1->time}}</p>
            </div>
          <?php } ?>
        </div>
        <div class="col-lg-4">
          <div class="support-info-single">
            <h4>Write Us</h4>
            <div class="support-icon"><a href="mailto:{{$Supportdata[0]->mail}}"><i class="fa-solid fa-envelope" style="color: white;"></a></i></div>
            <p><strong><a style="color: black;" href="mailto:{{$Supportdata[0]->mail}}">{{$Supportdata[0]->mail}}</a></strong></p>
          </div>
        </div>  
      </div>
    </div>
  </section>
  <!-- Container -->

  <!-- Modal -->
  <div class="modal common-modal chatModal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tutors Online - Support Team - Live Chat</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="chat-right">

            <div class="chat-msg">
              <div class="msg-format-right">
                <div class="msg-format-in">
                 <div class="chat-list-img"><img src="https://images.pexels.com/photos/3586798/pexels-photo-3586798.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1260&amp;h=750&amp;dpr=1" alt=""></div>
                 <div class="msg-format-txt">
                   <p>Can you help me?</p>
                 </div>
               </div>
             </div>
             <div class="msg-format-left">
              <div class="msg-format-in">
               <div class="chat-list-img"><img src="https://images.pexels.com/photos/3586798/pexels-photo-3586798.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1260&amp;h=750&amp;dpr=1" alt=""></div>
               <div class="msg-format-txt">
                 <p>How may I help you?</p>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
     <div class="modal-footer">
      <div class="chat-right-bottom">
        <div class="chat-inp">
          <div class="chat-inp-left">
            <button class="chat-inp-btn first"><i class="fa-solid fa-paperclip"></i></button>
            <input type="text" placeholder="Type here to chat……….">
          </div>
          <div class="chat-inp-right">
            <button class="chat-inp-btn"><i class="fa-regular fa-face-smile"></i></button>
            <button class="chat-inp-btn last"><i class="fa-solid fa-microphone-lines"></i></button>
          </div>
        </div>
        <div class="chat-send"><i class="fa-solid fa-paper-plane"></i></div>
      </div>
    </div>
  </div>
</div>
</div>


@include('/dashboard/common/footer')  
