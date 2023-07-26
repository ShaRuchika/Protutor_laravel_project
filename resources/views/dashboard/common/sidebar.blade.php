<?php $data = Session::get('userdata'); 
$parts = explode("/", $_SERVER['REQUEST_URI']);
$getVal =  end($parts); 
?>

<section class="side-bar">
  <ul>
    <li><a class="<?php echo ($getVal =='dashboard') ? 'active' : '' ?>" href="{{url('/dashboard')}}"><span><i class="fa-brands fa-hive"></i></span> <span>Home</span></a></li>
    <li><a class="<?php echo ($getVal =='profile') ? 'active' : '' ?>" href="{{url('/profile/about')}}"><span><i class="fa-solid fa-user"></i></span> <span>Profile</span></a></li>
    <?php if(isset($data->role) && $data->role ==4){ ?>
      <li><a href="{{url('/tutors')}}"><span><i class="fa-solid fa-user-group"></i></span> <span>Tutors</span></a></li>
    <?php }else{ ?>
    <?php } ?>
    <!-- <li><a href="library.html"><span><i class="fa-solid fa-book-bookmark"></i></span> <span>Library</span></a></li> -->
    <?php if(isset($data->role) && $data->role ==3){ ?>
      <li><a href="{{url('/calendar')}}" class="<?php echo ($getVal =='calendar') ? 'active' : '' ?>"><span><i class="fa-solid fa-calendar-days"></i></span> <span>Calendar</span></a></li>
    <?php } ?>

    <?php if(isset($data->role) && $data->role ==3){ ?>

    <li><a href="{{url('/teaching-orders')}}"><span><i class="fa-solid fa-chalkboard-user"></i></span> <span>Teaching Orders</span></a></li>

    <?php }else{ ?>

      <li><a href="{{url('/student-orders')}}"><span><i class="fa-solid fa-chalkboard-user"></i></span> <span>Teaching Orders</span></a></li>

    <?php } ?> 

    <!-- <li><a href="#"><span><i class="fa-solid fa-square-poll-horizontal"></i></span> <span>Quiz</span></a></li>
    
    <li><a href="#"><span><i class="fa-solid fa-message"></i></span> <span>Chat</span></a></li> -->
    <?php if(isset($data->role) && $data->role ==4){ ?>
    <!--   <li><a href="#"><span><i class="fa-solid fa-sack-dollar"></i></span> <span>Spendings</span></a></li> -->
    <?php }else{ ?>
      <!-- <li><a href="#"><span><i class="fa-solid fa-sack-dollar"></i></span> <span>Earnings</span></a></li> -->
    <?php } ?>
  </ul>
  <hr>
  <ul>
   <li><a href="{{url('/support')}}"><span><i class="fa-solid fa-circle-question"></i></span> <span>Support</span></a></li>
   <li><a href="{{url('/settings')}}"><span><i class="fa-solid fa-gear"></i></span> <span>Settings</span></a></li>
   <li><a href="{{url('/logout')}}"><span><i class="fa-solid fa-arrow-right-from-bracket"></i></span> <span>Logout</span></a></li>
  <!--  <li><a href="#"><span><i class="fa-solid fa-circle-info"></i></span> <span>Info</span></a></li> -->
 </ul>
</section>
