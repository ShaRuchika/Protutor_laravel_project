@include('/dashboard/common/header')
@include('/dashboard/common/sidebar')
<!-- Container -->
<section class="wrapper">
  <div class="page-title">
    <h1>Home</h1>
  </div>

  <span style="color: red;">
    @if(session('success_msg'))  
    <div class="alert alert-success alert-dismissible"> 
      {{session('success_msg')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert"><span aria-hidden="true"></span>
      </button>
    </div>
    @elseif(session('error_msg'))
    <div class="alert alert-danger alert-dismissible"> 
      {{session('error_msg')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert"><span aria-hidden="true"></span>
      </button>
    </div>
    @endif 
  </span>

  <div class="home-section">
    <div class="home-left">
      <div class="row">
        <div class="col-lg-6">
          <div class="box stat-link">
            <ul>
              <li>
                <a href="">
                  <div class="stat-icon"><i class="fa-solid fa-book-open"></i></div>
                  <h5>Scheduled Lessons</h5>
                </a>
              </li>
              <li>
                <a href="">
                  <div class="stat-icon"><i class="fa-solid fa-book-tanakh"></i></div>
                  <h5>Saved Lessons</h5>
                </a>
              </li>
              <li>
                <a href="">
                  <div class="stat-icon"><i class="fa-solid fa-comment-dots"></i></div>
                  <h5>Teachers Comments</h5>
                </a>
              </li>
              <li>
                <a href="">
                  <div class="stat-icon"><i class="fa-solid fa-file-video"></i></div>
                  <h5>Saved Lesson Videos</h5>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="box coming-clock">
            <h2>Next Coming Session in</h2>
            <div class="clock">
              <p>2D <span>:</span> 24H <span>:</span> 3M <span>:</span> 4S</p>
            </div>
          </div>
        </div>
      </div>

      <div class="box home-quiz">
       <div class="box-title">
        <div class="box-title-left">
          <h2>Quiz</h2>
          <h3>All Quiz</h3>
        </div> 
        <div class="box-title-right">
          <div class="filter-select">
            <div class="dropdown">
              <div class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>Filters</span>
                <i class="fa-solid fa-filter"></i>
              </div>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Filter-1</a></li>
                <li><a class="dropdown-item" href="#">Filter-2</a></li>
                <li><a class="dropdown-item" href="#">Filter-3</a></li>
              </ul>
            </div>
          </div>
        </div> 
      </div> 
      <div class="quiz-table">
        <div class="table-responsive">
          <table class="table theme-table">
            <tr>
              <td>Quiz Title</td>
              <td>Class / Grade</td>
              <td>Course</td>
              <td>Quiz Type</td>
              <td>Start Date & Time</td>
              <td>End Date & Time</td>
              <td><span class="table-link" href="">Upcoming</span></td>
            </tr>
            <tr>
              <td>Quiz Title</td>
              <td>Class / Grade</td>
              <td>Course</td>
              <td>Quiz Type</td>
              <td>Start Date & Time</td>
              <td>End Date & Time</td>
              <td><span class="table-link" href="">Upcoming</span></td>
            </tr>
            <tr>
              <td>Quiz Title</td>
              <td>Class / Grade</td>
              <td>Course</td>
              <td>Quiz Type</td>
              <td>Start Date & Time</td>
              <td>End Date & Time</td>
              <td><span class="table-link completed" href="">completed</span></td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="box home-quiz">
      <div class="box-title">
        <div class="box-title-left">
          <h2>Accounting</h2>
          <h3>Overall Earnings</h3>
        </div> 
        <div class="box-title-right">
          <span class="tag-sort">Sort by:</span>
          <div class="filter-select">
            <select class="simple" name="" id="">
              <option value="">Monthly</option>
              <option value="">Yearly</option>
              <option value="">Weekly</option>
            </select>
          </div>
        </div> 
      </div> 

      <div class="year-chart">
        <canvas id="myChart2"></canvas>
      </div>

    </div>

  </div>
  <div class="home-right">
    <div class="box inbox">
      <div class="box-title">
        <div class="box-title-left">
          <h2 class="small">Inbox</h2>
        </div>
        <div class="box-title-right">
          <a class="link" href="chat.html">View All</a>
        </div>
      </div> 
      <div class="inbox-list">
        <ul>
          <li>
            <a href="">
              <h5>Contact Name</h5>
              <h6><span>Message</span> <span>10:22 AM</span></h6>
            </a>
          </li>
          <li>
            <a href="">
              <h5>Contact Name</h5>
              <h6><span>Message</span> <span>10:22 AM</span></h6>
            </a>
          </li>
          <li>
            <a href="">
              <h5>Contact Name</h5>
              <h6><span>Message</span> <span>10:22 AM</span></h6>
            </a>
          </li>
          <li>
            <a href="">
              <h5>Contact Name</h5>
              <h6><span>Message</span> <span>10:22 AM</span></h6>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="box today">
      <div class="box-title">
        <div class="box-title-left">
          <h2 class="small">Today | Sep 22, 2021</h2>
        </div>
      </div>
      <div class="date-scroll">
        <ul>
          <li>
            <div class="date-scroll-single">
              <h5>20</h5>
              <h6>Mon</h6>
            </div>
          </li>
          <li>
            <div class="date-scroll-single">
              <h5>21</h5>
              <h6>Tue</h6>
            </div>
          </li>
          <li>
            <div class="date-scroll-single active">
              <h5>22</h5>
              <h6>Wed</h6>
            </div>
          </li>
          <li>
            <div class="date-scroll-single">
              <h5>23</h5>
              <h6>Thu</h6>
            </div>
          </li>
          <li>
            <div class="date-scroll-single">
              <h5>24</h5>
              <h6>Fri</h6>
            </div>
          </li>
        </ul>
      </div>

      <div class="date-list">
        <div class="date-list-single">
          <div class="date-list-left">08 AM</div>
          <div class="date-list-right">
          </div>
        </div>
        <div class="date-list-single">
          <div class="date-list-left">09 AM</div>
          <div class="date-list-right">
          </div>
        </div>
        <div class="date-list-single">
          <div class="date-list-left">10 AM</div>
          <div class="date-list-right">
          </div>
        </div>
        <div class="date-list-single">
          <div class="date-list-left">11 AM</div>
          <div class="date-list-right">
            <div class="date-invite">
              <span><i class="fa-solid fa-video"></i></span>
              <p>Video Session With Malik Start 10 AM - End 11 AM</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<!-- Container -->
@include('/dashboard/common/footer')
