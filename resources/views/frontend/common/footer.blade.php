  <footer class="site-footer">
   <div class="container">
    <div class="footer-top">
      <div class="row">
        <?php
        $Footerdata =  DB::select('SELECT icon, title, email, contact, Copyright FROM `footer` where id=1;');
        $SocialPlatformrdata =  DB::select('SELECT title, url, user_status FROM `social_media_platform`;');
        ?>
        <div class="col-12 col-lg-3">
          <div class="footer-single first">
            <div class="footer-logo">
              <img src="{{url('/')}}/public/images/{{$Footerdata[0]->icon}}" alt="">
            </div>
            <div class="footer-txt">
              <p class="text-start">{{$Footerdata[0]->title}}</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="footer-single">
            <h3>ABOUT</h3>
            <ul>
              <li><a href="{{url('/')}}">Home</a></li>
              <li><a href="">About Us</a></li>
              <li><a href="">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-6 col-lg-3">
          <div class="footer-single">
            <h3>Help</h3>
            <ul>
              <li><a href="">About Us</a></li>
              <li><a href="">Legal warning</a></li>
              <li><a href="">Cookies policy</a></li>
              <li><a href="">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-lg-3">
          <div class="footer-single">
            <h3>Contact Us</h3>
            <ul>
              <li><a href="mailto:{{$Footerdata[0]->email}}">{{$Footerdata[0]->email}}</a></li>
              <li><a href="tel:{{$Footerdata[0]->contact}}">+{{$Footerdata[0]->contact}}</a></li>
              <?php 
              foreach($SocialPlatformrdata as $data){
                if($data->user_status == 1){
                  ?>
                <li><a href="{{$data->url}}" target="_blank">{{$data->title}}</a></li>
              <?php } } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>{{$Footerdata[0]->Copyright}}</p>
    </div>
  </div>
</footer>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/tilt.js@1.2.1/dest/tilt.jquery.min.js"></script>
<script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
<script src="{{url('/')}}/public/assets/frontpage_assets/js/custom.js"></script>  
<script src="{{url('/')}}/public/assets/frontpage_assets/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>




</body>
</html>

