<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="<?php echo $this->assets; ?>img/logo.png" class="navbar-brand-img" alt="..." width="100">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <?php $activeTab = $this->uri->segment(2); ?>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">
                            <i class="fa fa-home"></i>
                            <span class="nav-link-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'dashboard'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'dashboard'); ?>">
                            <i class="ni ni-tv-2"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'membership'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'membership'); ?>">
                            <i class="fas fa-id-card"></i>
                            <span class="nav-link-text">Membership</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'vehicle'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'vehicle'); ?>">
                            <i class="fas fa-car"></i>
                            <span class="nav-link-text">Vehicle</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'payment'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'payment'); ?>">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span class="nav-link-text">Payment</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'refer'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'refer'); ?>">
                            <i class="ni ni-ui-04"></i>
                            <span class="nav-link-text">Refer Friend</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'settings'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'settings'); ?>">
                            <i class="ni ni-settings-gear-65 text-dark"></i>
                            <span class="nav-link-text">Settings</span>
                        </a>
                    </li> -->
                </ul>
                
            </div>
        </div>
    </div>
</nav>