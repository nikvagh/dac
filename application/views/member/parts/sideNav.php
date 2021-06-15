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
                <?php $activeTab3 = $this->uri->segment(3); ?>
                <?php $activeTab4 = $this->uri->segment(4); ?>

                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">
                            <i class="fa fa-home"></i>
                            <span class="nav-link-text">Home</span>
                        </a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'dashboard'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'dashboard'); ?>">
                            <i class="ni ni-tv-2"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'membership'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'membership'); ?>">
                            <i class="fas fa-id-card"></i>
                            <span class="nav-link-text">My Memberships</span>
                        </a>
                    </li>

                    <?php
                        $crm_t = false;
                        if($activeTab == 'booking' || $activeTab == 'booking'){ $crm_t = true; }
                    ?>
                    <li class="nav-item menu-is-opening menu-open">
                        <a class="nav-link <?php if($crm_t){ echo 'active'; }else{ echo "collapsed"; } ?>" href="#" data-toggle="collapse" data-target="#bookingMenu" class="collapsed">
                            <i class="ni ni-active-40"></i>
                            <span class="nav-link-text">Bookings</span>
                        </a>
                        <ul class="nav nav-treeView sub-menu collapse <?php if($crm_t){ echo 'show'; } ?>" id="bookingMenu">
                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'booking' && $activeTab3 == ''){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'booking'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'booking' && $activeTab3 == ''){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Service Bookings</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'booking' && $activeTab3 == 'book_now'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'booking/book_now'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab3 == 'book_now'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Book Now</span>
                                </a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'booking' && $activeTab3 == 'book_schedule'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'booking/book_schedule'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab3 == 'book_schedule'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Schedule Service</span>
                                </a>
                            </li> -->
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'vehicle'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'vehicle'); ?>">
                            <i class="fas fa-car"></i>
                            <span class="nav-link-text">My Vehicles</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'payment'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'payment'); ?>">
                            <i class="fas fa-file-invoice-dollar"></i>
                            <span class="nav-link-text">My Payments</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'refer'){ echo 'active'; } ?>" href="<?php echo base_url(MEMBER.'refer'); ?>">
                            <i class="ni ni-ui-04"></i>
                            <span class="nav-link-text">Refer A Friends</span>
                        </a>
                    </li>

                    

                </ul>
                
            </div>
        </div>
    </div>
</nav>