@include('/admin/common/header')

<div class="dashboard-wrap">
    @include('/admin/common/sidebar')

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
        <div class="dashboard-head">
            <h5 class="fw-600">ACCOUNT OVERVIEW</h5>
            <div class="dashboard-toggle">
                <span>Show Dashboard Values</span>
                <label class="switch ms-1">
                    <input type="checkbox" id="value-check">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>
        <div class="class-sort mt-3 mb-0">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <div class="inp-outer m-0">
                        <select class="input" name="" id="">
                          <option value="">Sort from</option>
                      </select>
                  </div>
              </div>
              <div class="col-6 col-lg-3">
                <div class="inp-outer m-0">
                    <select class="input" name="" id="">
                      <option value="">To</option>
                  </select>
              </div>
          </div>
      </div>
  </div>

  <div class="dash-stats">
    <div class="row">
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Lesson Revenue</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">20,000</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-chart-line"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Classes Revenue </h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">10,000</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-chart-line"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Admin Earnings</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">20,500</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-dollar-sign"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Total Lesson</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">20,800</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-regular fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Total Classes</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">3,000</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-file-pen"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Canceled Lessons</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">500</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-regular fa-calendar-xmark"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Completed Lessons</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">3000</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-file-shield"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Unscheduled Lessons</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">07</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-calendar-days"></i></div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Completed Classes</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">20,000</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-business-time"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Canceled Classes</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">20,000</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-plug-circle-xmark"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Canceled Lessons</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">20,000</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-folder-minus"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>No of Quiz Created</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">577</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-trophy"></i></div>
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Total Number of users</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">21,456</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-users"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Total Number of Students</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">20,000</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-user-tie"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Total Number of Tutors</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">1,456</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-user-graduate"></i></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="dash-stats-single">
                <h5>Total Number of Tutors Request</h5>
                <div class="dash-stats-txt">
                    <div>
                        <span class="val">700</span>
                        <span class="hid">******</span>
                    </div>
                    <div><i class="fa-solid fa-tower-observation"></i></div>
                </div>
            </div>
        </div>

    </div>

    <div class="stat-more text-center mt-5">
        <button class="site-link small">View All User</button>
    </div>

    <div class="statics">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#tabs-1">Commission from Lesson</button>
          </li>
          <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#tabs-2">Commission from Classes</button>
          </li>
          <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#tabs-3">Total Sign Ups</button>
          </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tabs-1">
            <div class="chart-area">
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="tab-pane fade" id="tabs-2">
          <div class="chart-area">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
    <div class="tab-pane fade" id="tabs-3">
      <div class="chart-area">
        <canvas id="myChart3"></canvas>
    </div>
</div>
</div>
</div>

<div class="subject-search">
  <div class="row">
    <div class="col-sm-6">
      <div class="class-sort mt-5 mb-0">
        <div class="row">
            <div class="col-6 col-lg-4">
                <div class="inp-outer m-0">
                    <select class="input" name="" id="">
                      <option value="">Sort from</option>
                  </select>
              </div>
          </div>
          <div class="col-6 col-lg-4">
            <div class="inp-outer m-0">
                <select class="input" name="" id="">
                  <option value="">To</option>
              </select>
          </div>
      </div>
  </div>
</div>
<div class="subject-search-single">
    <h3>Top Class Subjects (All)</h3>
    <p>No record found.</p>
</div>
</div>
<div class="col-sm-6">
  <div class="class-sort mt-5 mb-0">
    <div class="row">
        <div class="col-6 col-lg-4">
            <div class="inp-outer m-0">
                <select class="input" name="" id="">
                  <option value="">Sort from</option>
              </select>
          </div>
      </div>
      <div class="col-6 col-lg-4">
        <div class="inp-outer m-0">
            <select class="input" name="" id="">
              <option value="">To</option>
          </select>
      </div>
  </div>
</div>
</div>
<div class="subject-search-single">
    <h3>Top Lesson Subjects (All)</h3>
    <ul>
      <li>History <span>31 sold</span></li>
      <li>Physics <span>8 sold</span></li>
      <li>Maths <span>6 sold</span></li>
      <li>English <span>5 sold</span></li>
      <li>Accounting <span>4 sold</span></li>
      <li>Algebra <span>3 sold</span></li>
      <li>Arabic <span>3 sold</span></li>
      <li>Marketing <span>2 sold</span></li>
      <li>Geography <span>2 sold</span></li>
      <li>Business English <span>1 sold</span></li>
      <li>Spanish <span>1 sold</span></li>
      <li>French <span>1 sold</span></li>
      <li>Art <span>1 sold</span></li>
  </ul>
</div>
</div>
</div>
</div>


<div class="subject-search">
  <div class="row">
    <div class="col-sm-6">
      <div class="class-sort mt-5 mb-0">
        <div class="row">
            <div class="col-6 col-lg-4">
                <div class="inp-outer m-0">
                    <select class="input" name="" id="">
                      <option value="">Sort from</option>
                  </select>
              </div>
          </div>
          <div class="col-6 col-lg-4">
            <div class="inp-outer m-0">
                <select class="input" name="" id="">
                  <option value="">To</option>
              </select>
          </div>
      </div>
  </div>
</div>
<div class="subject-search-single">
    <h3>Visitors Statistics</h3>
    <p>No record found.</p>
</div>
</div>
<div class="col-sm-6">
  <div class="class-sort mt-5 mb-0">
    <div class="row">
        <div class="col-6 col-lg-4">
            <div class="inp-outer m-0">
                <select class="input" name="" id="">
                  <option value="">Sort from</option>
              </select>
          </div>
      </div>
      <div class="col-6 col-lg-4">
        <div class="inp-outer m-0">
            <select class="input" name="" id="">
              <option value="">To</option>
          </select>
      </div>
  </div>
</div>
</div>
<div class="subject-search-single">
    <h3>Traffic(All)</h3>
    <p>No record found.</p>
</div>
</div>
</div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="chart-outer">
      <h3>Age Groups</h3>
      <div class="pie-wrap">
        <canvas id="myChart4"></canvas>
    </div>
</div>
</div>
<div class="col-sm-6">
    <div class="chart-outer">
      <h3>Gender</h3>
      <div class="pie-wrap">
        <canvas id="myChart5"></canvas>
    </div>
</div>
</div>
</div>

</div>

</div>

</div>

</div>  
@include('/admin/common/footer')