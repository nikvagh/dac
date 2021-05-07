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
                        <a class="nav-link <?php if($activeTab == 'dashboard'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'dashboard'); ?>">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'category'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'category'); ?>">
                            <i class="fas fa-paste text-danger"></i>
                            <span class="nav-link-text">Category</span>
                        </a>
                    </li>

                    <?php 
                        $serviceProvider_t = false;
                        if($activeTab == 'serviceProvider' || $activeTab == 'coWorker'){ $serviceProvider_t = true; } 
                    ?>
                    <li class="nav-item menu-is-opening menu-open">
                        <a class="nav-link <?php if($serviceProvider_t){ echo 'active'; }else{ echo "collapsed"; } ?>" href="#" data-toggle="collapse" data-target="#serviceProviderMenu" class="collapsed">
                            <i class="fas fa-building text-pink"></i>
                            <span class="nav-link-text">Service Provider</span>
                        </a>
                        <ul class="nav nav-treeView sub-menu collapse <?php if($serviceProvider_t){ echo 'show'; } ?>" id="serviceProviderMenu">
                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'serviceProvider'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'serviceProvider'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'serviceProvider'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Service Provider</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'coWorker'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'coWorker'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'coWorker'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Co-Workers</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'service'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'service'); ?>">
                            <i class="fas fa-concierge-bell text-dark"></i>
                            <span class="nav-link-text">Service</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'offer'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'offer'); ?>">
                            <i class="fas fa-percentage text-warning"></i>
                            <span class="nav-link-text">Offer</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'appointment'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'appointment'); ?>">
                            <i class="ni ni-watch-time text-success"></i>
                            <span class="nav-link-text">Appointment</span>
                        </a>
                    </li> -->

                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'calendar'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'calendar'); ?>">
                            <i class="ni ni-calendar-grid-58 text-indigo"></i>
                            <span class="nav-link-text">Calendar</span>
                        </a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'notification'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'notification'); ?>">
                            <i class="ni ni-notification-70 text-yellow"></i>
                            <span class="nav-link-text">Notification</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'notificationTemplate'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'notificationTemplate'); ?>">
                            <i class="ni ni-ruler-pencil text-warning"></i>
                            <span class="nav-link-text">Notification Template</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'adminUser'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'adminUser'); ?>">
                            <i class="ni ni-active-40 text-gray"></i>
                            <span class="nav-link-text">Admin</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'customer'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'customer'); ?>">
                            <i class="ni ni-single-02 text-primary"></i>
                            <span class="nav-link-text">Customer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'faq'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'faq'); ?>">
                            <i class="ni ni-like-2 text-dark"></i>
                            <span class="nav-link-text">FAQ</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'role'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'role'); ?>">
                            <i class="ni ni-circle-08 text-pink"></i>
                            <span class="nav-link-text">Role</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'settings'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'settings'); ?>">
                            <i class="ni ni-settings-gear-65 text-dark"></i>
                            <span class="nav-link-text">Settings</span>
                        </a>
                    </li>

                    <?php 
                        $crm_t = false;
                        if($activeTab == 'package' || $activeTab == 'membership' || $activeTab == 'appointment' || $activeTab == 'calendar' || $activeTab == 'dispatch'){ $crm_t = true; }
                    ?>
                    <li class="nav-item menu-is-opening menu-open">
                        <a class="nav-link <?php if($crm_t){ echo 'active'; }else{ echo "collapsed"; } ?>" href="#" data-toggle="collapse" data-target="#crmMenu" class="collapsed">
                            <i class="ni ni-planet text-primary"></i>
                            <span class="nav-link-text">CRM</span>
                        </a>
                        <ul class="nav nav-treeView sub-menu collapse <?php if($crm_t){ echo 'show'; } ?>" id="crmMenu">
                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'package'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'package'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'package'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Package</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'membership'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'membership'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'membership'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Membership</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'appointment'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'appointment'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'appointment'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">All Appointment</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'dispatch'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'dispatch'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'dispatch'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Dispatch New Job</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'calendar'){ echo 'active'; } ?>" href="<?php echo base_url(ADMIN.'calendar'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'calendar'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Calendar</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
                <!-- Navigation -->
                <!-- <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html" target="_blank">
                            <i class="ni ni-spaceship"></i>
                            <span class="nav-link-text">Getting started</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank">
                            <i class="ni ni-palette"></i>
                            <span class="nav-link-text">Foundation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html" target="_blank">
                            <i class="ni ni-ui-04"></i>
                            <span class="nav-link-text">Components</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html" target="_blank">
                            <i class="ni ni-chart-pie-35"></i>
                            <span class="nav-link-text">Plugins</span>
                        </a>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>
</nav>