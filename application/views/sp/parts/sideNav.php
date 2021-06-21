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
                        <a class="nav-link <?php if($activeTab == 'dashboard'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'dashboard'); ?>">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'category'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'category'); ?>">
                            <i class="fas fa-paste text-danger"></i>
                            <span class="nav-link-text">Category</span>
                        </a>
                    </li> -->

                    <?php
                        $crm_t = false;
                        if($activeTab == 'package' || $activeTab == 'addOn' || $activeTab == 'membership' || $activeTab == 'appointment' || $activeTab == 'calendar' || $activeTab == 'dispatch' || 
                            $activeTab == 'payment' || $activeTab == 'report' || $activeTab == 'service' || $activeTab == 'offer'){ $crm_t = true; }
                    ?>
                    <li class="nav-item menu-is-opening menu-open">
                        <a class="nav-link <?php if($crm_t){ echo 'active'; }else{ echo "collapsed"; } ?>" href="#" data-toggle="collapse" data-target="#crmMenu" class="collapsed">
                            <i class="ni ni-planet text-primary"></i>
                            <span class="nav-link-text">CRM</span>
                        </a>
                        <ul class="nav nav-treeView sub-menu collapse <?php if($crm_t){ echo 'show'; } ?>" id="crmMenu">
                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'package'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'package'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'package'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Packages</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'service'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'service'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'service'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Services</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'offer'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'offer'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'offer'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Coupons</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'addOn'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'addOn'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'addOn'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Add-On</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'membership'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'membership'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'membership'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Memberships</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'appointment'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'appointment'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'appointment'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Bookings</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'dispatch'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'dispatch'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'dispatch'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Dispatch New Job</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'calendar'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'calendar'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'calendar'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Calendar</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'payment'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'payment'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'payment'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Payments</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'report'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'report'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'report'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Reports</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'customer'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'customer'); ?>">
                            <i class="ni ni-single-02 text-primary"></i>
                            <span class="nav-link-text">Members</span>
                        </a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'coWorker'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'coWorker'); ?>">
                            <i class="ni ni-single-02 text-primary"></i>
                            <span class="nav-link-text">Co-Workers</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'appointment'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'appointment'); ?>">
                            <i class="ni ni-watch-time text-success"></i>
                            <span class="nav-link-text">Appointment</span>
                        </a>
                    </li> -->

                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'calendar'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'calendar'); ?>">
                            <i class="ni ni-calendar-grid-58 text-indigo"></i>
                            <span class="nav-link-text">Calendar</span>
                        </a>
                    </li> -->

                    <?php 
                        $notification_t = false;
                        if($activeTab == 'notificationTemplate' || $activeTab == 'notification'){ $notification_t = true; } 
                    ?>
                    <li class="nav-item menu-is-opening menu-open">
                        <a class="nav-link <?php if($notification_t){ echo 'active'; }else{ echo "collapsed"; } ?>" href="#" data-toggle="collapse" data-target="#notificationMenu" class="collapsed">
                            <i class="ni ni-notification-70 text-yellow"></i>
                            <span class="nav-link-text">Notifications</span>
                        </a>
                        <ul class="nav nav-treeView sub-menu collapse <?php if($notification_t){ echo 'show'; } ?>" id="notificationMenu">
                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'notificationTemplate'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'notificationTemplate'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'notificationTemplate'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Template</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'notification'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'notification'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'notification'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Send Notification</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'faq'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'faq'); ?>">
                            <i class="ni ni-like-2 text-dark"></i>
                            <span class="nav-link-text">Manage FAQ's</span>
                        </a>
                    </li>

                    <?php 
                        $user_t = false;
                        if($activeTab == 'adminUser' || $activeTab == 'role'){ $user_t = true; } 
                    ?>
                    <li class="nav-item menu-is-opening menu-open">
                        <a class="nav-link <?php if($user_t){ echo 'active'; }else{ echo "collapsed"; } ?>" href="#" data-toggle="collapse" data-target="#userMenu" class="collapsed">
                            <i class="ni ni-active-40 text-gray"></i>
                            <span class="nav-link-text">Users</span>
                        </a>
                        <ul class="nav nav-treeView sub-menu collapse <?php if($user_t){ echo 'show'; } ?>" id="userMenu">
                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'adminUser'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'adminUser'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'adminUser'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">Admin Users</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if($activeTab == 'role'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'role'); ?>">
                                    <i class="fas fa-dot-circle <?php if($activeTab == 'role'){ echo 'text-dark'; }else{ echo "text-yellow"; } ?>"></i>
                                    <span class="nav-link-text">User Roles</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'adminUser'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'adminUser'); ?>">
                            <i class="ni ni-active-40 text-gray"></i>
                            <span class="nav-link-text">Admin</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'role'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'role'); ?>">
                            <i class="ni ni-circle-08 text-pink"></i>
                            <span class="nav-link-text">Role</span>
                        </a>
                    </li> -->


                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'notificationTemplate'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'notificationTemplate'); ?>">
                            <i class="ni ni-ruler-pencil text-warning"></i>
                            <span class="nav-link-text">Notification Template</span>
                        </a>
                    </li> -->

                    <!-- <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'notification'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'notification'); ?>">
                            <i class="ni ni-notification-70 text-yellow"></i>
                            <span class="nav-link-text">Notification</span>
                        </a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link <?php if($activeTab == 'settings'){ echo 'active'; } ?>" href="<?php echo base_url(SP.'settings'); ?>">
                            <i class="ni ni-settings-gear-65 text-dark"></i>
                            <span class="nav-link-text">Settings</span>
                        </a>
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