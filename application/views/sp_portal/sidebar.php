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
        <span><?php echo $this->sp->loginData->company_name; ?></span>
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
      $page_s = $this->uri->segment(2); 
      $page_s_sub = $this->uri->segment(3); 
    ?>
    <ul>
      <li class="<?php if($page_s == "dashboard" || $page_s == ""){ echo 'active'; } ?>">
        <a href="<?php echo base_url().SPPATH; ?>dashboard" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
      </li>
      <li class="<?php if($page_s_sub == "profile_edit"){ echo 'active'; } ?>">
        <a href="<?php echo base_url().SPPATH; ?>profile/profile_edit" title="Company"><i class="fa fa-lg fa-building"></i> <span class="menu-item-parent">Company Info</span></a>
      </li>
      <!-- <li class="<?php if($page_s == "document"){ echo 'active open'; } ?>"><a href="#"><i class="fa fa-lg fa-file"></i> <span class="menu-item-parent">Company Documents</span></a>
          <ul>
            <li class="<?php if($page_s_sub == "document"){ echo 'active'; } ?>">
              <a href="<?php echo base_url().SPPATH; ?>document/document" title="Dashboard"><span class="menu-item-parent">Documents</span></a>
            </li>
            <li class="<?php if($page_s_sub == "coi"){ echo 'active'; } ?>">
              <a href="<?php echo base_url().SPPATH; ?>document/coi" title="Dashboard"><span class="menu-item-parent">Certificate of Insurance</span></a>
            </li>
          </ul>
      </li> -->
      <li class="<?php if($page_s == "job"){ echo 'active'; } ?>"><a href="<?php echo base_url().SPPATH; ?>job"><i class="fa fa-envelope"></i> <span class="menu-item-parent">Service Requests </span></a></li>
      <!-- <li><a href="#"><i class="fa fa-lg fa-car fa-list-alt"></i> <span class="menu-item-parent">Service History</span></a></li> -->
      <li class="<?php if(($page_s == "profile" && $page_s_sub == "")){ echo 'active'; } ?>"><a href="<?php echo base_url().SPPATH; ?>profile"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Edit Profile</span></a></li>
    </ul>
  </nav>

  <span class="minifyme" data-action="minifyMenu">
    <i class="fa fa-arrow-circle-left hit"></i>
  </span>

</aside>