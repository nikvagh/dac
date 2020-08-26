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
    ?>

    <ul>
      <li class="<?php if($page_s == "dashboard" || $page_s == ""){ echo 'active'; } ?>">
        <a href="<?php echo base_url().ADMINPATH; ?>dashboard" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
        <!-- <ul>
          <li>
            <a href="index.html" title="Dashboard"><span class="menu-item-parent">Analytics Dashboard</span></a>
          </li>
          <li class="active">
            <a href="dashboard-social.html" title="Dashboard"><span class="menu-item-parent">Social Wall</span></a>
          </li>
        </ul> -->
      </li>
      <li class="<?php if($page_s == "membership"){ echo 'active'; } ?>"><a href="<?php echo base_url().ADMINPATH; ?>membership"><i class="fa fa-lg fa-fw fa-id-card"></i> <span class="menu-item-parent">Membership</span></a></li>
      <li class="<?php if($page_s == "job"){ echo 'active'; } ?>"><a href="<?php echo base_url().ADMINPATH; ?>job"><i class="fa fa-envelope"></i> <span class="menu-item-parent">Service Requests </span></a></li>
      <li class="<?php if($page_s == "service"){ echo 'active'; } ?>"><a href="<?php echo base_url().ADMINPATH; ?>service"><i class="fa fa-list-ul"></i> <span class="menu-item-parent">Services</span></a></li>
      <li class="<?php if($page_s == "serviceupgrade"){ echo 'active'; } ?>"><a href="<?php echo base_url().ADMINPATH; ?>serviceupgrade"><i class="fa fa-list-ul"></i> <span class="menu-item-parent">Service Upgrade </span></a></li>
      <li class="<?php if($page_s == "serviceprovider"){ echo 'active'; } ?>"><a href="<?php echo base_url().ADMINPATH; ?>serviceprovider"><i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">Service Provider</span></a></li>
      <li class="<?php if($page_s == "report"){ echo 'active'; } ?>"><a href="<?php echo base_url().ADMINPATH; ?>report"><i class="fa fa-lg fa-fw fa-file-alt"></i> <span class="menu-item-parent">Reports</span></a></li>
      <li class="<?php if($page_s == "profile"){ echo 'active'; } ?>"><a href="<?php echo base_url().ADMINPATH; ?>profile"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Edit Profile</span></a></li>
      <li class="<?php if($page_s == "settings"){ echo 'active'; } ?>"><a href="<?php echo base_url().ADMINPATH; ?>settings"><i class="fa fa-lg fa-cog"></i> <span class="menu-item-parent">Settings</span></a></li>
    </ul>
  </nav>

  <span class="minifyme" data-action="minifyMenu">
    <i class="fa fa-arrow-circle-left hit"></i>
  </span>

</aside>