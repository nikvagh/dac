<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-3 col-3">
                    <h6 class="h2 text-white d-inline-block mb-0"><?php echo $title; ?></h6>
                </div>
                <div class="col-lg-6 col-6">
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-default mb-0 fadeOut">
                            <button class="close" data-dismiss="alert">×</button>
                            <i class="fa-fw fa fa-check"></i>
                            <strong>Success</strong> <?php echo $this->session->flashdata('success');?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger mb-0 fadeOut">
                            <button class="close" data-dismiss="alert">×</button>
                            <i class="fa-fw fa fa-times"></i>
                            <strong>Error!</strong> <?php echo $this->session->flashdata('error');?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3 col-3 text-right">
                    <?php if($page == 'vehicle_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'vehicle/add'); ?>" class="btn btn-sm btn-neutral">New</a>
                        <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
                    <?php } ?>
                    <?php if($page == 'payment_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'payment/addCard'); ?>" class="btn btn-sm btn-neutral">New Card</a>
                    <?php } ?>
                    <?php if($page == 'membership_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'membership/add'); ?>" class="btn btn-sm btn-neutral">New Package</a>
                    <?php } ?>
                    <?php if($page == 'booking_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'booking/book_now'); ?>" class="btn btn-sm btn-neutral">Book Now</a>
                        <a href="<?php echo base_url(MEMBER.'booking/add'); ?>" class="btn btn-sm btn-neutral">Schedule Service</a>
                    <?php } ?>

                    
                    <?php if($page == 'offer_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'offer/add'); ?>" class="btn btn-sm btn-neutral">New</a>
                    <?php } ?>
                    <?php if($page == 'appointment_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'appointment/add'); ?>" class="btn btn-sm btn-neutral">New</a>
                    <?php } ?>
                    <?php if($page == 'adminUser_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'adminUser/add'); ?>" class="btn btn-sm btn-neutral">New</a>
                    <?php } ?>
                    <?php if($page == 'customer_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'customer/add'); ?>" class="btn btn-sm btn-neutral">New</a>
                    <?php } ?>
                    <?php if($page == 'faq_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'faq/add'); ?>" class="btn btn-sm btn-neutral">New</a>
                    <?php } ?>
                    <?php if($page == 'role_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'role/add'); ?>" class="btn btn-sm btn-neutral">New</a>
                    <?php } ?>
                    <?php if($page == 'package_list'){ ?>
                        <a href="<?php echo base_url(MEMBER.'package/add'); ?>" class="btn btn-sm btn-neutral">New</a>
                    <?php } ?>
                    
                </div>
            </div>

            <?php if($page == 'dashboard'){ ?>
                <!-- <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total traffic</h5>
                                        <span class="h2 font-weight-bold mb-0">350,897</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-active-40"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                                        <span class="h2 font-weight-bold mb-0">2,356</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="ni ni-chart-pie-35"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                                        <span class="h2 font-weight-bold mb-0">924</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-money-coins"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                                        <span class="h2 font-weight-bold mb-0">49,65%</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-chart-bar-32"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div> -->
            <?php } ?>

        </div>
    </div>
</div>