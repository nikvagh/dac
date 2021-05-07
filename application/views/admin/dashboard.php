<div class="row">

    <div class="col-3">
        <div class="card bg-gradient-success">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase mb-0">Total Customer</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $customerTotal; ?></span>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                    <a href="<?php echo base_url(ADMIN.'customer'); ?>" class="text-white"> View</a>
                    <!-- <span class="text-nowrap">Since last month</span> -->
                </p>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card bg-gradient-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase mb-0">Total Jobs</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $appointmentTotal; ?></span>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                    <a href="<?php echo base_url(ADMIN.'appointment'); ?>" class="text-white"> View</a>
                    <!-- <span class="text-nowrap">Since last month</span> -->
                </p>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card bg-gradient-info">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase mb-0">Total Pending Jobs</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $appointmentPendingTotal; ?></span>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                    <a href="<?php echo base_url(ADMIN.'dispatch'); ?>" class="text-white"> View</a>
                    <!-- <span class="text-nowrap">Since last month</span> -->
                </p>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card bg-gradient-warning">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase mb-0">Total Success Jobs</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $appointmentSuccessTotal; ?></span>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                    <a href="<?php echo base_url(ADMIN.'appointment'); ?>" class="text-white"> View</a>
                <!-- <span class="text-nowrap">Since last month</span> -->
                </p>
            </div>
        </div>
    </div>

    <!-- <div class="col-3">
        <div class="card bg-gradient-dark">

            <div class="card-body">
                <div class="col">
                    <h6 class="text-light text-uppercase ls-1 mb-1">Total</h6>
                    <h5 class="h3 text-white mb-0">Sales value</h5>
                </div>
            </div>

        </div>
    </div>

    <div class="col-3">
        <div class="card bg-primary">

            <div class="card-body">
                <div class="col">
                    <h6 class="text-light text-uppercase ls-1 mb-1">Total</h6>
                    <h5 class="h3 text-white mb-0">Sales value</h5>
                </div>
            </div>

        </div>
    </div> -->

    <div class="col-xl-8">
        <div class="card bg-default">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                        <h5 class="h3 text-white mb-0">Sales value</h5>
                    </div>
                    <div class="col">
                        <ul class="nav nav-pills justify-content-end">
                            <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[88,1,0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                                <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                    <span class="d-none d-md-block">Month</span>
                                    <span class="d-md-none">M</span>
                                </a>
                            </li>
                            <li class="nav-item" data-toggle="chart" data-target="#chart-sales-dark" data-update='{"data":{"datasets":[{"data":[5,0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                                <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                    <span class="d-none d-md-block">Week</span>
                                    <span class="d-md-none">W</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <!-- Chart wrapper -->
                    <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                        <h5 class="h3 mb-0">Total orders</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                    <canvas id="chart-bars" class="chart-canvas"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>