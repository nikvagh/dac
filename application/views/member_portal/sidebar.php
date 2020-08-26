<aside id="left-panel">

  <!-- User info -->
  <div class="login-info">
    <span>
      <!-- User image size is adjusted inside CSS, it should stay as it -->

      <a href="javascript:void(0);" id="show-shortcut">
       <?php
          if(file_exists(PROFILE_PATH.$_SESSION['loginData']->profile)){
            $profile_pic_thumb = base_url().PROFILE_PATH.'thumb/120x120_'.$_SESSION['loginData']->profile;
          }else{
            $profile_pic_thumb = $this->assets.'img/avatars/male.png';
          }
        ?>
                          
        <img src="<?php echo $profile_pic_thumb; ?>" alt="me" class="online" />
        <span><?php echo $this->member->loginData->firstname.' '.$this->member->loginData->lastname; ?></span>
        <!-- <i class="fa fa-angle-down"></i> -->
      </a>

    </span>
  </div>
  <!-- end user info -->

  <nav>
    <!-- 
				NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional href="" links. See documentation for details.
				-->
    <?php
      // echo $this->uri->segment(1); 
      $page_s = $this->uri->segment(2); 
      $page_s1 = $this->uri->segment(3); 
    ?>
    <ul>
      <li class="<?php if($page_s == "dashboard" || $page_s == ""){ echo 'active'; } ?>">
        <a href="<?php echo base_url().MEMBERPATH; ?>dashboard" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
        <!-- <ul>
          <li>
            <a href="index.html" title="Dashboard"><span class="menu-item-parent">Analytics Dashboard</span></a>
          </li>
          <li class="active">
            <a href="dashboard-social.html" title="Dashboard"><span class="menu-item-parent">Social Wall</span></a>
          </li>
        </ul> -->
      </li>
      <li class="<?php if($page_s == "membership"){ echo 'active'; } ?>"><a href="<?php echo base_url().MEMBERPATH; ?>membership"><i class="fa fa-lg fa-fw fa-id-card"></i> <span class="menu-item-parent">Membership</span></a></li>
          
      <!-- class="" -->
      <li class="<?php if($page_s == "job"){ echo 'active open'; } ?>">
          <a href="#"><i class="fa fa-envelope"></i> <span class="menu-item-parent">Services</span></a>
          <ul>
            <li class="<?php if($page_s == "job" && ($page_s1 == "" || $page_s1 == "invoice") ){ echo 'active'; } ?>"><a href="<?php echo base_url().MEMBERPATH; ?>job"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent">Service Rrequests</span></a></li>
            <li class="<?php if($page_s == "job" && $page_s1 == "add"){ echo 'active'; } ?>"><a href="<?php echo base_url().MEMBERPATH;?>job/add" class="active"><i class="fa fa-lg fa-fw fa-calendar"></i> <span class="menu-item-parent">Book Now</span></a></li>
            <li class="<?php if($page_s == "job" && $page_s1 == "schedule_service"){ echo 'active'; } ?>"><a href="<?php echo base_url().MEMBERPATH;?>job/schedule_service"><i class="fa fa-lg fa-fw fa-calendar"></i> <span class="menu-item-parent">Schedule service</span></a></li>
          </ul>
      </li>
      
      <li class="<?php if($page_s == "paymenthistory"){ echo 'active'; } ?>"><a href="<?php echo base_url().MEMBERPATH; ?>paymenthistory"><i class="fa fa-dollar"></i> <span class="menu-item-parent">Payment Hostory</span></a></li>
      <li class="<?php if($page_s == "profile"){ echo 'active'; } ?>"><a href="<?php echo base_url().MEMBERPATH; ?>profile"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Edit Profile</span></a></li>
      <li class="<?php if($page_s == "paymentcard"){ echo 'active'; } ?>"><a href="<?php echo base_url().MEMBERPATH; ?>paymentcard"><i class="fa fa-lg fa-fw fa-credit-card"></i> <span class="menu-item-parent">Payment</span></a></li>
    </ul>
  </nav>

  <span class="minifyme" data-action="minifyMenu">
    <i class="fa fa-arrow-circle-left hit"></i>
  </span>

</aside>