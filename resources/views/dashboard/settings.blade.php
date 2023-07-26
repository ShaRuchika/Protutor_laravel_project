@include('/dashboard/common/header')
@include('/dashboard/common/sidebar')

<section class="wrapper">
  <div class="page-title">
    <h1>Settings</h1>
  </div>

  <div>
    <ul class="nav tab-nav"> 
      <li class="nav-item">
        <button class="active" data-bs-toggle="tab" data-bs-target="#tab-1">
          <span><i class="fa-solid fa-calendar-days"></i></span> Calendar
        </button>
      </li>

      <li class="nav-item">
        <button data-bs-toggle="tab" data-bs-target="#tab-2">
          <span><i class="fa-solid fa-bell"></i></span> Notifications
        </button>
      </li>
      <li class="nav-item">
        <button data-bs-toggle="tab" data-bs-target="#tab-3">
          <span><i class="fa-solid fa-key"></i></span> Password
        </button>
      </li>
      <li class="nav-item">
        <button data-bs-toggle="tab" data-bs-target="#tab-4">
          <span><i class="fa-solid fa-wallet"></i></span> Payment
        </button>
      </li>
    </ul>

    <div class="tab-content pt-3">

      <div class="tab-pane fade show active" id="tab-1">
        <div class="box settings-box">
          <div class="row">
            <div class="col-lg-6">
              <div class="settings-left">
                <h2>Lesson Booking Settings</h2>
                <h3 class="pt-3">The minimum amount of time you wish to have between when a student books their first lesson and the lesson start time.</h3>
                <p>Tip: Most students like to schedule their first lesson within 2 days of the date they send the request on. If you wish to receive more students, please choose the minimum amount of time between these two dates. (This only applies to new students. Existing students may book a lesson with only 2 hours prior notice if your availability allows it).</p>
                <h3 class="pt-3">How far in advance can students book?</h3>
                <p>Tip: Tutors can keep their calendars available up to 2 months ahead.</p>
                <h2 class="pt-5">Calendar Settings</h2>
                <h3 class="pt-3">Time zone and calendar view</h3>
                <p>Choose your current time zone to avoid time zone confusion with your students. Customize calendar view the way it suits you.</p>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="settings-right">
                <div class="block-inp-wrap">
                  <label for="">Advance Notice</label>
                  <select class="block-inp" name="" id="">
                    <option value="">At least 12 hours notice</option>
                  </select>
                </div>
                <div class="block-inp-wrap">
                  <label for="">Booking Window</label>
                  <select class="block-inp" name="" id="">
                    <option value="">2 weeks in advance</option>
                  </select>
                </div>
                <div class="block-inp-wrap">
                  <label for="">Week Starts on</label>
                  <select class="block-inp" name="" id="">
                    <option value="">Monday</option>
                  </select>
                </div>
                <div class="block-inp-wrap">
                  <label for="">Date Format</label>
                  <select class="block-inp" name="" id="">
                    <option value="">DD - MM - YYYY</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="save-changes">
            <button>Save Changes</button>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="tab-2">
        <div class="box settings-box">
          <div class="row">
            <div class="col-lg-6">
              <div class="settings-left">
                <h2>Notification Center</h2>
                <h3 class="txt-orange pt-3">Email Notifications</h3>

                <div class="switch-single">
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div>
                    <p><strong>Lessons and messages</strong> <br> <span>Alerts about new lessons, new requests and student messages.</span></p>
                  </div>
                </div>

                <div class="switch-single">
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div>
                    <p><strong>General reminders</strong> <br> <span>Notifications about pending requests, new lessons, reviews and payments.</span></p>
                  </div>
                </div>

                <div class="switch-single">
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div>
                    <p><strong>Updates, tips and offers</strong> <br> <span>Stay connected with product updates, helpful tips and special offers.</span></p>
                  </div>
                </div>

                <div class="switch-single">
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div>
                    <p><strong>Tutors Online Blog</strong> <br> <span>Occasional newsletter with the latest posts.</span></p>
                  </div>
                </div>

                <div class="switch-single">
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div>
                    <p><strong>Question and Answers section</strong> <br> <span>Notices about new questions and postings for your subjects.</span></p>
                  </div>
                </div>

                <div class="switch-single">
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div>
                    <p><strong>New tutoring opportunities</strong> <br> <span>Daily announcements of new student postings for your subjects</span></p>
                  </div>
                </div>


                <h3 class="txt-orange pt-4">SMS Notifications</h3>

                <div class="switch-single">
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div>
                    <p><strong>Lessons and messages</strong> <br> <span>SMS alerts about new lessons, upcoming lessons, new requests and student messages.</span></p>
                  </div>
                </div>

                <h3 class="txt-orange pt-4">Tutors Online Insights</h3>

                <div class="switch-single">
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div>
                    <p><strong>Allow Tutors Online team to contact me for product improvements</strong> <br> <span>Product improvements, research and beta testing</span></p>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-lg-6">
              <div class="settings-right">

                <h3 class="txt-orange pt-3">Profile Promotion</h3>

                <div class="switch-single">
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div>
                    <p><strong>Allow Tutors Online to promote details from my profile in ads</strong> <br> <span>To help you reach more students. Tutors online can promote your profile photo, video and/or other publicly available details from your tutor profile in advertisements.</span></p>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="save-changes">
            <button>Save Changes</button>
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="tab-3">
        <div class="box settings-box">
          <form method="POST" action="{{url('/change_password')}}">
            @csrf
            <div class="row">
              <div class="col-lg-6">
                <div class="settings-left">
                  <h2>Change Password</h2>
                  <div class="block-inp-wrap">
                    <label for="">Current password</label>
                    <input class="block-inp" type="password" name="Curr_pswd" placeholder="Current Password" required>
                  </div>

                  <div class="block-inp-wrap">
                    <label for="">New password</label>
                    <input class="block-inp" type="password" name="new_pswd" placeholder="New Password" required>
                    <div class="pass-strength">
                      <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>
                    </div>
                  </div>

                  <div class="block-inp-wrap">
                    <label for="">Verify password</label>
                    <input class="block-inp" type="password" name="confirm_pswd" placeholder="Confirm Password" required>
                    <div class="pass-strength">
                      <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="settings-right">
                  <h2>Tips for secure and strong password</h2>
                  <div class="photo-list-txt">
                    <ul>
                      <li>Choose between 8 to 16 characters long password</li>
                      <li>Use at least one alpha, numeric and special character</li>
                      <li>Allowed special characters ! @ # $ % & * ?</li>
                      <li>Never share username and password with anyone</li>
                      <li>Immediately change the password if compromised</li>
                      <li>Try to keep changing password after 3 months</li>
                    </ul>
                  </div>

                  <h2 class="pt-5">Password Indicator</h2>
                  <div class="photo-list-txt">
                    <ul>
                      <li>You will always see an indicator under password field which help to choose secure and strong password</li>
                    </ul>
                  </div>
                  <div class="pass-strength">
                    <ul>
                      <li class="poor"></li>
                      <li class="poor"></li>
                      <li class="poor"></li>
                      <li class="poor"></li>
                      <li class="mid"></li>
                      <li class="mid"></li>
                      <li class="mid"></li>
                      <li class="mid"></li>
                      <li class="excelent"></li>
                      <li class="excelent"></li>
                    </ul>
                  </div>
                  <div class="pass-strength-txt">
                    <div class="pass-strength-red">
                      <p>Poor</p>
                    </div>
                    <div class="pass-strength-yellow">
                      <p>Medium</p>
                    </div>
                    <div class="pass-strength-green">
                      <p>Excellent</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="save-changes">
              <button name="submit">Save Changes</button>
            </div>
          </form>
        </div>
      </div>

      <div class="tab-pane fade" id="tab-4">
        <div class="box pay-step-1">
          <div class="tab-title">
            <h2>Manage Payment Methods</h2>
            <h3>Add, update, or remove your billing methods</h3>
          </div>
          <div class="add-payment-method-btn">
            <button class="fancy-btn step-1" href=""><span><i class="fa-solid fa-wallet"></i></span> Add Payment Method</button>
          </div>
        </div>

        <div class="box pay-step-2">
          <div class="tab-title d-flex">
            <div>
              <h2>Add a Payment Method</h2>
              <h3>Your primary billing method is used for all payments</h3>
            </div>
            <div>
              <button class="fancy-btn pay-back" href=""><span><i class="fa-solid fa-xmark"></i></span> Back</button>
            </div>
          </div>

          <div class="add-payment-method-btn d-block">

            <div class="payment-accordion">
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      <div class="btn-left">
                        <div class="button-circle"></div>
                        <span class="button-title">Payment Card</span>
                        <span class="button-img"><img src="./assets/images/cards.png" alt=""></span>
                        <span class="button-info">Visa, Mastercard, American Express, Discover, Diners</span>
                      </div>
                      <div class="btn-right"><i class="fa-solid fa-lock"></i></div>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="block-inp-wrap mt-0">
                        <label for="">Card Number</label>
                        <div class="card-field">
                          <span class="card-field-left"><i class="fa-solid fa-credit-card"></i></span>
                          <input class="block-inp" type="text" placeholder="XXXX XXXX XXXX XXXX">
                          <span class="card-field-right"><i class="fa-solid fa-lock"></i> Securely Stored</span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-6">
                          <div class="block-inp-wrap">
                            <label for="">First Name</label>
                            <input class="block-inp" type="text" placeholder="First Name">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="block-inp-wrap">
                            <label for="">Last Name</label>
                            <input class="block-inp" type="text" placeholder="Last Name">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-6">
                          <div class="block-inp-wrap">
                            <label for="">Expires on</label>
                            <div class="row">
                              <div class="col-6"><input class="block-inp" type="text" placeholder="MM"></div>
                              <div class="col-6"><input class="block-inp" type="text" placeholder="YY"></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="block-inp-wrap">
                            <label for="">Security Code <span>The 3-digit number located on the back right side of your card</span></label>
                            <input class="block-inp" type="text" placeholder="Last Name">
                          </div>
                        </div>
                      </div>

                      <h4 class="pt-5"><strong>Billing Address</strong></h4>

                      <div class="row">
                        <div class="col-lg-6">
                          <div class="block-inp-wrap">
                            <label for="">Country</label>
                            <select class="block-inp" name="" id="">
                              <option value="">Select Country</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="block-inp-wrap">
                        <label for="">Address</label>
                        <input class="block-inp" type="text" placeholder="Address Line 1">
                        <input class="block-inp mt-3" type="text" placeholder="Address Line 2">
                      </div>

                      <div class="block-inp-wrap">
                        <label for="">City</label>
                        <input class="block-inp" type="text" placeholder="City">
                      </div>

                      <div class="row">
                        <div class="col-lg-6">
                          <div class="block-inp-wrap">
                            <label for="">Postal Code <span>Optional</span></label>
                            <input class="block-inp" type="text" placeholder="Postal Code">
                          </div>
                        </div>
                      </div>

                      <div class="save-changes text-end">
                        <button class="green">Save</button>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      <div class="btn-left">
                        <div class="button-circle"></div>
                        <span class="button-img"><img src="./assets/images/paypal.png" alt=""></span>
                      </div>
                      <div class="btn-right"><i class="fa-solid fa-lock"></i></div>
                    </button>
                  </h2>
                    <!-- <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <div class="block-inp-wrap mt-0">
                          <label for="">Card Number</label>
                          <div class="card-field">
                            <span class="card-field-left"><i class="fa-solid fa-credit-card"></i></span>
                            <input class="block-inp" type="text" placeholder="XXXX XXXX XXXX XXXX">
                            <span class="card-field-right"><i class="fa-solid fa-lock"></i> Securely Stored</span>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="block-inp-wrap">
                              <label for="">First Name</label>
                              <input class="block-inp" type="text" placeholder="First Name">
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="block-inp-wrap">
                              <label for="">Last Name</label>
                              <input class="block-inp" type="text" placeholder="Last Name">
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="block-inp-wrap">
                              <label for="">Expires on</label>
                              <div class="row">
                                <div class="col-6"><input class="block-inp" type="text" placeholder="MM"></div>
                                <div class="col-6"><input class="block-inp" type="text" placeholder="YY"></div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="block-inp-wrap">
                              <label for="">Security Code <span>The 3-digit number located on the back right side of your card</span></label>
                              <input class="block-inp" type="text" placeholder="Last Name">
                            </div>
                          </div>
                        </div>
  
                        <h4 class="pt-5"><strong>Billing Address</strong></h4>
  
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="block-inp-wrap">
                              <label for="">Country</label>
                              <select class="block-inp" name="" id="">
                                <option value="">Select Country</option>
                              </select>
                            </div>
                          </div>
                        </div>
  
                        <div class="block-inp-wrap">
                          <label for="">Address</label>
                          <input class="block-inp" type="text" placeholder="Address Line 1">
                          <input class="block-inp mt-3" type="text" placeholder="Address Line 2">
                        </div>
  
                        <div class="block-inp-wrap">
                          <label for="">City</label>
                          <input class="block-inp" type="text" placeholder="City">
                        </div>
  
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="block-inp-wrap">
                              <label for="">Postal Code <span>Optional</span></label>
                              <input class="block-inp" type="text" placeholder="Postal Code">
                            </div>
                          </div>
                        </div>
  
                        <div class="save-changes text-end">
                          <button class="green">Save</button>
                        </div>
  
                      </div>
                    </div> -->
                  </div>
                </div>
              </div>

            </div>

          </div>


          <div class="box pay-step-3">
            <div class="tab-title d-flex">
              <div>
                <h2>Add a Payment Method</h2>
                <h3>Your primary billing method is used for all payments</h3>
              </div>
              <div>
                <button class="fancy-btn" href=""><span><i class="fa-solid fa-wallet"></i></span> Add Payment Method</button>
              </div>
            </div>
            <div class="add-payment-method-btn d-block">
             <div class="payment-group">
               <h2>Primary Payment Method</h2>
               <h3>Your primary billing method is used for all payments</h3>
               <div class="payment-group-box">
                <div class="group-box-left">
                  <img src="./assets/images/master.png" alt="">
                  <span class="ps-3">MasterCard ending in 2120</span>
                </div>
                <div class="group-box-right">
                  <a class="txt-green" href="">Edit</a>
                  <span>|</span>
                  <a class="txt-red" href="">Remove</a>
                </div>
              </div>
            </div>

            <div class="payment-group pt-4">
              <h2>Secondary Payment Method</h2>
              <h3>This payment method will be charged if there is any problem with your primary payment method</h3>
              <div class="payment-group-box">
               <div class="group-box-left">
                 <img src="./assets/images/paypal.png" alt="">
                 <span class="ps-3">xyz@domainname.com</span>
               </div>
               <div class="group-box-right">
                 <a class="txt-green" href="">Edit</a>
                 <span>|</span>
                 <a class="txt-red" href="">Remove</a>
               </div>
             </div>
           </div>
         </div>
       </div>

     </div>

   </div>
 </div>

</section>
@include('/dashboard/common/footer')  

