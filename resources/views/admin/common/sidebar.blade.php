<?php 
$parts = explode("/", $_SERVER['REQUEST_URI']);
$getVal =  end($parts); 

?>
<div class="sidebar">
  <div class="accordion" id="sideNav">
    <div class="acc-item">
      <a class="full-link" href="{{url('/').'/admin/dashboard'}}"></a>
      <div class="acc-button" data-bs-toggle="collapse">
        <span class="nav-icon"><i class="fa-solid fa-box"></i></span>
        Dashboard
      </div>
    </div>

    <div class="acc-item">
      <div class="acc-button collapsed " data-bs-toggle="collapse" data-bs-target="#menu-1" aria-expanded="true">
        <span class="nav-icon"><i class="fa-solid fa-users"></i></span>
        Manage Users
      </div>
      <div id="menu-1" class="accordion-collapse collapse <?php echo ($getVal =='userlist' || $getVal =='studentlist' || $getVal =='teacherlist' || $getVal =='adminlist') ? 'show' : '' ?>" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="{{url('/').'/admin/userlist'}}" class="<?php echo ($getVal =='userlist') ? 'active' : '' ?>">Users</a></li>
            <li><a href="{{url('/').'/admin/studentlist'}}" class="<?php echo ($getVal =='studentlist') ? 'active' : '' ?>">Manage Students</a></li>
            <li><a href="{{url('/').'/admin/teacherlist'}}" class="<?php echo ($getVal =='teacherlist') ? 'active' : '' ?>">Manage Tutors</a></li>
            <!--<li><a href="tutors-review.html">Tutors Review</a></li>-->
            <li><a href="{{url('/').'/admin/adminlist'}}" class="<?php echo ($getVal =='adminlist') ? 'active' : '' ?>">Manage Admin Users</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-15" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-people-group"></i></span>
        Pages
      </div>
      <div id="menu-15" class="accordion-collapse collapse <?php echo ($getVal =='1' || $getVal =='edit-become-a-tutor') ? 'show' : '' ?>" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="{{url('/').'/admin/edit-homepage/1'}}" class="<?php echo ($getVal =='1') ? 'active' : '' ?>">Home Page</a></li>
            <li><a href="{{url('/').'/admin/edit-become-a-tutor'}}" class="<?php echo ($getVal =='edit-become-a-tutor') ? 'active' : '' ?>">Become a tutor</a></li>
            <li><a href="{{url('/').'/admin/update_support'}}">Support</a></li>
            <li><a href="{{url('/').'/admin/update_footer'}}">Footer</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-14" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-people-group"></i></span>
        Student Testimonials
      </div>
      <div id="menu-14" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="{{url('/').'/admin/student-testimonials'}}">Testimonials</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-2" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-people-group"></i></span>
        Group Classes
      </div>
      <div id="menu-2" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="#">Group Classess</a></li>
            <li><a href="#">Package Classes</a></li>
            <li><a href="#">Quiz</a></li>
          </ul>
        </div>
      </div>
    </div> -->

    <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-3" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-file-lines"></i></span>
        Manage Orders
      </div>
      <div id="menu-3" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="{{url('/').'/admin/all_orders'}}">All Orders</a></li>
            <li><a href="{{url('/').'/admin/lesson_orders'}}">Lesson Orders</a></li>
            <!-- <li><a href="#">Subscription Orders</a></li>
            <li><a href="#">Classes Orders</a></li>
            <li><a href="#">Package Orders</a></li>
            <li><a href="#">Wallet Orders</a></li>
            <li><a href="#">Gift Card Orders</a></li> -->
          </ul>
        </div>
      </div>
    </div>

    <!-- <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-4" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-clipboard-list"></i></span>
        Report Logs
      </div>
      <div id="menu-4" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="#">Report Logs</a></li>
          </ul>
        </div>
      </div>
    </div> -->

    <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-5" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-user-shield"></i></span>
        Tutor Preferences
      </div>
      <div id="menu-5" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>

            <!-- <li><a href="#">Accents</a></li> -->
            <li><a href="{{url('/admin/teaches_level')}}">Teaches Level</a></li>
            <!-- <li><a href="#">Learner Ages</a></li> -->
            <!-- <li><a href="#">Lesson Includes</a></li> -->
            <li><a href="{{url('/admin/subject')}}">Subjects</a></li>
            <li><a href="{{url('/admin/hourly_rate')}}">Hourly Rate</a></li>
            <!-- <li><a href="#">Text Prepration</a></li> -->
            <li><a href="{{url('/admin/spoken_language')}}">Language</a></li>
            <!-- <li><a href="#">Teaching Language</a></li>
            <li><a href="#">Issues Report Option</a></li>
            <li><a href="#">Price Slabs</a></li> -->

          </ul>
        </div>
      </div>
    </div>

    <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-6" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-gear"></i></span>
        Settings
      </div>
      <div id="menu-6" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>

            <!-- <li><a href="#">General Settings</a></li>
            <li><a href="#">PWA Settings</a></li>
            <li><a href="#">Meetings Tools</a></li>
            <li><a href="#">Payment Methods</a></li> -->
            <li><a href="{{url('admin/social_platforms')}}">Social Platforms</a></li>
            <!-- <li><a href="{{url('admin/discount_coupon')}}">Discount Coupons</a></li> -->
            <li><a href="{{url('admin/commission_settings')}}">Commission Settings</a></li>
            <li><a href="{{url('admin/meeting_tools')}}">Meetings Tools</a></li>

            <!--<li><a href="#">Currency Management</a></li>
            <li><a href="#">Themes Management</a></li> -->
          </ul>
        </div>
      </div>
    </div>

    <!-- <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-7" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-layer-group"></i></span>
        Manage CMS
      </div>
      <div id="menu-7" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="#">Home Page Slide</a></li>
            <li><a href="#">Content Pages</a></li>
            <li><a href="#">Content Blocks</a></li>
            <li><a href="#">Navigation</a></li>
            <li><a href="#">Countries</a></li>
            <li><a href="#">Videos Content</a></li>
            <li><a href="#">Testimonials </a></li>
            <li><a href="#">Language Label</a></li>
            <li><a href="#">FAQs Categories</a></li>
            <li><a href="#">Manage FAQs</a></li>
            <li><a href="#">Email Templates</a></li>
          </ul>
        </div>
      </div>
    </div> -->

    <!-- <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-8" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-blog"></i></span>
        Manage Blogs
      </div>
      <div id="menu-8" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="#">Not Available</a></li>
          </ul>
        </div>
      </div>
    </div> -->

    <!-- <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-9" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-seedling"></i></span>
        Manage SEO
      </div>
      <div id="menu-9" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="#">Not Available</a></li>
          </ul>
        </div>
      </div>
    </div> -->

    <!-- <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-10" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-chart-pie"></i></span>
        Report Performance
      </div>
      <div id="menu-10" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="#">Lesson Top Subject</a></li>
            <li><a href="#">Classes Top Subject</a></li>
            <li><a href="#">Tutor Performance</a></li>
            <li><a href="#">Lesson Stats</a></li>
            <li><a href="#">Sales Report</a></li>
            <li><a href="#">Settlements </a></li>
          </ul>
        </div>
      </div>
    </div> -->

    <div class="acc-item">
      <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-11" aria-expanded="false">
        <span class="nav-icon"><i class="fa-solid fa-flask"></i></span>
        Request Logs
      </div>
      <div id="menu-11" class="accordion-collapse collapse" data-bs-parent="#sideNav">
        <div class="acc-body">
          <ul>
            <li><a href="{{url('/').'/admin/tutor-request'}}">Tutor Request</a></li>
            <!-- <li><a href="#">Withdrawal Request</a></li>
              <li><a href="#">GDPR Request</a></li> -->
            </ul>
          </div>
        </div>
      </div>

                <!-- <div class="acc-item">
                    <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-12" aria-expanded="false">
                      <span class="nav-icon"><i class="fa-solid fa-user-tie"></i></span>
                      Manage Admin
                    </div>
                    <div id="menu-12" class="accordion-collapse collapse" data-bs-parent="#sideNav">
                      <div class="acc-body">
                        <ul>
                          <li><a href="">Not Available</a></li>
                        </ul>
                      </div>
                    </div>
                  </div> -->

                 <!--  <div class="acc-item">
                    <div class="acc-button collapsed" data-bs-toggle="collapse" data-bs-target="#menu-13" aria-expanded="false">
                      <span class="nav-icon"><i class="fa-solid fa-bullhorn"></i></span>
                      Affiliates
                    </div>
                    <div id="menu-13" class="accordion-collapse collapse" data-bs-parent="#sideNav">
                      <div class="acc-body">
                        <ul>
                          <li><a href="#">Affiliates</a></li>
                        </ul>
                      </div>
                    </div>
                  </div> -->

                </div>
              </div>